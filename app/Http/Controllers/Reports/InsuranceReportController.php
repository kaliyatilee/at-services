<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\DSTVPackage;
use App\Models\DSTVTransaction;
use App\Models\InsuranceBroker;
use App\Models\InsuranceTransaction;
use Illuminate\Http\Request;

class InsuranceReportController extends Controller
{
    public function view(Request $request)
    {
//        $start_date = "2024-01-01 00:00:00";
//        $end_date = "2025-01-01 00:00:00";

        $start_date = $request->input("start_date");
        $end_date = $request->input("end_date");

        if ($start_date == null) {
            //set date to today
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
        }

        $INSURANCE_TRANSACTIONS = InsuranceTransaction::whereBetween('transaction_date', [$start_date . " 00:00:00", $end_date . " 23:59:59"])->get();
        $INSURANCE_BROKERS = InsuranceBroker::all();

        $INSURANCE_BROKERS_TITLES = [];
        foreach ($INSURANCE_BROKERS as $BROKER) {
            $INSURANCE_BROKERS_TITLES[$BROKER->id] = $BROKER->name;
        }

        //number of transactions
        $num_of_transactions = $INSURANCE_TRANSACTIONS->count();

        $commissions = 0;
        $amount_paid = 0;
        $amount_not_paid = 0;
        $num_of_subs_per_package = [];
        $subscriptions_per_package = [];
        foreach ($INSURANCE_TRANSACTIONS as $transaction) {
            $package_id = $transaction->insurance_broker;
            //process number of subs per package

            if (isset($num_of_subs_per_package[$package_id])) {
                $num_of_subs_per_package[$package_id]++;
            } else {
                $num_of_subs_per_package[$package_id] = 1;
            }

            //commission
            // $commissions += $transaction->commission;
			$commissions += $transaction->getInsuranceBroker()->commission;

            //amount paid
            // $amount_paid += $transaction->getAmountPaid();
			$amount_paid += $transaction->amount_paid;

            //amount not paid
            $amount_not_paid += $transaction->balance;

            //subscription details
            if (!isset($subscriptions_per_package[$package_id])) {
                //first time
                $subscriptions_per_package[$package_id]['name'] = $INSURANCE_BROKERS_TITLES[$package_id];
                $subscriptions_per_package[$package_id]['count'] = 1;
                $subscriptions_per_package[$package_id]['commissions'] = $transaction->commission;
            } else {
                $subscriptions_per_package[$package_id]['count']++;
                $subscriptions_per_package[$package_id]['commissions'] += $transaction->commission;
            }
        }

        foreach ($subscriptions_per_package as $package_id => $sub_package) {
            if ($sub_package['commissions'] == 0 || $commissions == 0) {
                $percentage = 0;
            } else {
                $percentage = ($sub_package['commissions'] / $commissions) * 100;
            }
            $percentage = round($percentage);
            $subscriptions_per_package[$package_id]['percentage'] = $percentage;
        }

        $data['INSURANCE_TRANSACTIONS'] = $INSURANCE_TRANSACTIONS;
        $data['INSURANCE_BROKERS'] = $INSURANCE_BROKERS;
        $data['number_of_transactions'] = $num_of_transactions;
        $data['number_of_transactions_per_package'] = $num_of_subs_per_package;
        $data['amount_not_paid'] = $amount_not_paid;
        $data['amount_paid'] = $amount_paid;
        $data['commissions'] = $commissions;
        $data['subscriptions_by_package'] = $subscriptions_per_package;

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        return view('report.insurance', $data);
    }
}
