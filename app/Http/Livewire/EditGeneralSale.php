<?php

namespace App\Http\Livewire;

use App\Models\Currency;
use App\Models\DSTVPayment;
use App\Models\DSTVTransaction;
use App\Models\Ecocash\Ecocash;
use App\Models\Egg;
use App\Models\GeneralSales\GeneralSale;
use App\Models\InsurancePayment;
use App\Models\InsuranceTransaction;
use App\Models\LoanDisbursed;
use App\Models\LoanPayment;
use App\Models\PermanentDisc;
use App\Models\RTGS\RTGs;
use App\Models\SalesTransactionType;
use DateTime;
use Illuminate\Validation\Rule;

class EditGeneralSale extends Component
{
    public $transaction;

    public $transactionTypes = [];

    public $currencies = [];

    public $type = 'general-sale';

    public $name = '';
    public $phone = '';
    public $currency = '';
    public $transaction_type = '';
    public $amount = '';
    public $notes = '';
    public $transaction_date = '';
    public $classification = '';

    public $disk_payment = '';

    public $dstv_transaction = '';

    public $ecocash_payment = '';

    public $eggs_payment = '';

    public $insurance_transaction = '';

    public $loan_id = '';

    public $diskPayments = [];

    public $dstvTransactions = [];

    public $ecoCashPayments = [];

    public $eggsPayments = [];

    public $insuranceTransactions = [];

    public $loansDisbursed = [];

    public function mount($saleId)
    {
        $this->transaction = GeneralSale::findOrFail($saleId);
        $this->transactionTypes = SalesTransactionType::all();
        $this->currencies = Currency::all();
        $this->diskPayments = PermanentDisc::all();
        $this->dstvTransactions = DSTVTransaction::all();
        $this->ecoCashPayments = Ecocash::all();
        $this->eggsPayments = Egg::all();
        $this->insuranceTransactions = InsuranceTransaction::whereNull('payment_date')->get();
        $this->loansDisbursed = LoanDisbursed::all();

        $this->name = $this->transaction->name;
        $this->phone = $this->transaction->phone;
        $this->currency = $this->transaction->currency;
        $this->transaction_type = $this->transaction->transaction_type;
        $this->amount = $this->transaction->amount;
        $this->notes = $this->transaction->notes;
        $this->transaction_date = $this->transaction->transaction_date;
        $this->type = 'general-sale';
    }

    public function editGeneralSale()
    {
        $validated = $this->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'currency' => ['required', 'numeric', Rule::exists('currency', 'id')],
            'transaction_type' => ['required', 'string', Rule::exists('sales_transaction_types', 'sale_transaction_type_id')],
            'amount' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
            'transaction_date' => 'nullable',
            'type' => 'nullable'
        ]);

        $original = GeneralSale::findOrFail($this->transaction->id);

        if (!$validated['transaction_date']){
            $validated['transaction_date'] = $original->created_at;
        }

        $original->update([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'currency' => $validated['currency'],
            'transaction_type' => $validated['transaction_type'],
            'amount' => $validated['amount'],
            'notes' => $validated['notes'],
            'transaction_date' => $validated['transaction_date']
        ]);

        if ($this->type == 'disk') {
            $diskPayment = PermanentDisc::findOrFail($this->disk_payment);
            $diskPayment->update([
                'cash_paid' => $original->amount,
            ]);
        }

        if ($this->type == 'dstv') {
            $dstvTransaction = DSTVTransaction::findOrFail($this->dstv_transaction);
            DSTVPayment::create([
                'currency' => $original->currency,
                'dstv_transaction_id' => $dstvTransaction->id,
                'amount' => $original->amount,
                'amount_before' => 0,
                'amount_after' => 0,
                'created_by' => auth()->user()->id
            ]);
            $dstvTransaction->update([
                'balance' => $dstvTransaction->balance - $original->amount,
            ]);
        }

        if ($this->type == 'ecocash') {
            $ecoCashPayment = Ecocash::findOrFail($this->ecocash_payment);
            $ecoCashPayment->update([
                'amount_paid' => $original->amount,
            ]);
        }

        if ($this->type == 'eggs') {
            $eggPayment = Egg::findOrFail($this->eggs_payment);
            $eggPayment->update([
                'cash_paid' => $original->amount,
            ]);
        }

        if ($this->type == 'insurance') {
            $insuranceTransaction = InsuranceTransaction::findOrFail($this->insurance_transaction);
            InsurancePayment::create([
                'insurance_transaction_id' => $insuranceTransaction->id,
                'amount' => $original->amount,
                'amount_before' => 0,
                'amount_after' => 0,
                'created_by' => $original->created_by
            ]);
            $insuranceTransaction->update([
                'payment_date' => (new DateTime())->format('Y-m-d'),
            ]);
        }

        if ($this->type == 'loan') {
            $loan = LoanDisbursed::findOrFail($this->loan_id);
            LoanPayment::create([
                'loan_id' => $loan->id,
                'amount' => $original->amount,
                'amount_before' => 0,
                'amount_after' => 0,
                'created_by' => auth()->user()->id
            ]);
            $loan->update([
                'balance' => $loan->balance - $original->amount,
            ]);
        }

        if ($this->type == 'rtgs') {
            $type = $this->transaction->type->effect == 'adds' ? 1 : 2;
            RTGs::create([
                'type' => $type,
                'amount' => $original->amount,
                'name' => $original->name,
                'phone' => $original->phone,
                'notes' => $original->notes,
                'created_by' => auth()->user()->id
            ]);
        }

        if ($this->type != 'general-sale'){
            $original->delete();
        }

        return redirect()->route('general-sales')->with('success', 'Transaction updated successfully');
    }

    public function render()
    {
        return view('livewire.edit-general-sale')->layout('components.layout');
    }
}
