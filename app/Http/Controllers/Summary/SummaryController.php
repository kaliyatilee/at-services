<?php

namespace App\Http\Controllers\Summary;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyRegistration;
use App\Models\DSTVTransaction;
use App\Models\Ecocash\Ecocash;
use App\Models\GeneralSales\GeneralSale;
use App\Models\InsuranceTransaction;
use App\Models\LoanDisbursed;
use App\Models\RTGS\RTGs;
use App\Models\Zinara\ZinaraTransaction;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function summary(Request $request, $user_id, $start_date, $end_date)
    {

        $start_date = date('Y-m-d H:i:s', strtotime($start_date . " 00:00:00"));
        $end_date = date('Y-m-d H:i:s', strtotime($end_date . " 23:59:59"));

        $ecocash = Ecocash::query()->whereBetween("created_at", [$start_date, $end_date])->where("created_by", $user_id)->get();
        $rtgs = RTGs::query()->whereBetween("created_at", [$start_date, $end_date])->where("created_by", $user_id)->get();
        $insuranceTransaction = InsuranceTransaction::query()->whereBetween("created_at", [$start_date, $end_date])->where("created_by", $user_id)->get();
        $zinaraTransaction = ZinaraTransaction::query()->whereBetween("created_at", [$start_date, $end_date])->where("created_by", $user_id)->get();
        $generalSale = GeneralSale::query()->whereBetween("created_at", [$start_date, $end_date])->where("created_by", $user_id)->get();
        $loanDisbursed = LoanDisbursed::query()->whereBetween("created_at", [$start_date, $end_date])->where("created_by", $user_id)->get();
        $dstvTransaction = DSTVTransaction::query()->whereBetween("created_at", [$start_date, $end_date])->where("created_by", $user_id)->get();
        $companyRegistration = CompanyRegistration::query()->whereBetween("created_at", [$start_date, $end_date])->where("created_by", $user_id)->get();

        $data['ecocash']['data'] = $ecocash;
        $data['ecocash']['count'] = $ecocash->count();

        foreach ($ecocash as $eco){
            $currency = $eco->currency;

            if(isset($data['ecocash']['amount_paid'][$currency])){
                $data['ecocash']['amount_paid'][$currency] = $data['ecocash']['amount_paid'][$currency] + $eco->amount_paid;
            }else{
                $data['ecocash']['amount_paid'][$currency] = $eco->amount_paid;
            }
        }

        $data['rtgs']['data'] = $rtgs;
        $data['rtgs']['count'] = $rtgs->count();

        foreach ($rtgs as $rtg){
            $transaction_type = $rtg->transaction_type;

            if(isset($data['rtgs']['amount_paid'][$transaction_type])){
                $data['rtgs']['amount_paid'][$transaction_type] = $data['rtgs']['amount_paid'][$transaction_type] + $rtg->amount;
            }else{
                $data['rtgs']['amount_paid'][$transaction_type] = $rtg->amount;
            }
        }

        $data['insurance']['data'] = $insuranceTransaction;
        $data['insurance']['count'] = $insuranceTransaction->count();

        foreach ($insuranceTransaction as $insurance){
            $currency = $insurance->currency_id;

            if(isset($data['insurance']['amount_paid'][$currency])){
                $data['insurance']['amount_paid'][$currency] = $data['insurance']['amount_paid'][$currency] + $insurance->amount_paid;
            }else{
                $data['insurance']['amount_paid'][$currency] = $insurance->amount_paid;
            }
        }

        $data['zinara']['data'] = $zinaraTransaction;
        $data['zinara']['count'] = $zinaraTransaction->count();

        foreach ($zinaraTransaction as $zinara){
            $class = $zinara->class;

            if(isset($data['zinara']['amount_paid'][$class])){
                $data['zinara']['amount_paid'][$class] = $data['zinara']['amount_paid'][$class] + $zinara->amount_paid;
            }else{
                $data['zinara']['amount_paid'][$class] = $zinara->amount_paid;
            }
        }

        $data['general_sale']['data'] = $generalSale;
        $data['general_sale']['count'] = $generalSale->count();

        foreach ($generalSale as $general){
            $currency = $general->currency;

            if(isset($data['general_sale']['amount_paid'][$currency])){
                $data['general_sale']['amount_paid'][$currency] = $data['general_sale']['amount_paid'][$currency] + $general->amount;
            }else{
                $data['general_sale']['amount_paid'][$currency] = $general->amount;
            }
        }

        $data['loan']['data'] = $loanDisbursed;
        $data['loan']['count'] = $loanDisbursed->count();

        foreach ($loanDisbursed as $general){
            $currency = $general->currency_id;

            if(isset($data['loan']['amount_paid'][$currency])){
                $data['loan']['amount_paid'][$currency] = $data['loan']['amount_paid'][$currency] + $general->amount;
            }else{
                $data['loan']['amount_paid'][$currency] = $general->amount;
            }
        }

        $data['dstv']['data'] = $dstvTransaction;
        $data['dstv']['count'] = $dstvTransaction->count();

        foreach ($dstvTransaction as $dstv){
            $currency = $dstv->currency_id;

            if(isset($data['dstv']['amount_paid'][$currency])){
                $data['dstv']['amount_paid'][$currency] = $data['dstv']['amount_paid'][$currency] + $dstv->amount_paid;
            }else{
                $data['dstv']['amount_paid'][$currency] = $dstv->amount_paid;
            }
        }

        $data['company']['data'] = $companyRegistration;
        $data['company']['count'] = $companyRegistration->count();

        foreach ($companyRegistration as $company){
            $currency = $company->currency_id;

            if(isset($data['company']['amount_paid'][$currency])){
                $data['company']['amount_paid'][$currency] = $data['company']['amount_paid'][$currency] + $company->amount_paid;
            }else{
                $data['company']['amount_paid'][$currency] = $company->amount_paid;
            }
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }
}
