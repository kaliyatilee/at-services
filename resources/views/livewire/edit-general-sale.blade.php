<div>
    <x-layout bodyClass="g-sidenav-show  bg-gray-200">

        <x-navbars.sidebar activePage="rtgs_add"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Add  ZIG Transaction"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid px-2 px-md-4">
                <div class="page-header min-height-300 border-radius-xl mt-4"
                     style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                    <span class="mask  bg-gradient-primary  opacity-6"></span>
                </div>
                <div class="card card-body mx-3 mx-md-4 mt-n6">
                    <div class="card card-plain h-100">
                        <div class="card-body p-3">
                            <form wire:submit.prevent="editGeneralSale" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Transaction Type</label>
                                        <select class="form-control border border-2 p-2" wire:model="transaction_type">
                                            <option value="{{ $transaction->transaction_type }}">{{ $transaction->type->name }}</option>
                                            @foreach($transactionTypes as $id => $transactionType)
                                                @if($transactionType->sale_transaction_type_id === $transaction->transaction_type)
                                                    @continue
                                                @endif
                                                <option value="{{ $transactionType->sale_transaction_type_id }}">{{ $transactionType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Currency</label>
                                        <select class="form-control border border-2 p-2" wire:model="currency">
                                            <option value="{{ $transaction->currency }}">{{ $transaction->curr->name }}</option>
                                            @foreach($currencies as $id => $currency)
                                                @if($currency->id === $transaction->currency)
                                                    @continue
                                                @endif
                                                <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Client Name</label>
                                        <input type="text" wire:model="name" class="form-control border border-2 p-2" value='{{ $transaction->name }}' placeholder="{{ $transaction->name }}">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" wire:model="phone" class="form-control border border-2 p-2" value='{{ $transaction->phone }}' placeholder="{{ $transaction->phone }}">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Amount</label>
                                        <input type="number" wire:model="amount" class="form-control border border-2 p-2" value='{{ $transaction->amount }}' placeholder="{{ $transaction->amount }}">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Transaction Date ({{ (new DateTime($transaction->created_at))->format('d M Y') }})</label>
                                        <input type="date" wire:model="transaction_date" class="form-control border border-2 p-2">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Notes</label>
                                        <input type="text" wire:model="notes" class="form-control border border-2 p-2" value='{{ $transaction->notes }}' placeholder="{{ $transaction->notes }}">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Classification</label>
                                        <select class="form-control border border-2 p-2" wire:model="type">
                                            <option value="general-sale">General Sales</option>
                                            <option value="dstv">DSTV</option>
                                            <option value="disk">Permanent Disk</option>
                                            <option value="ecocash">Ecocash</option>
                                            <option value="eggs">Eggs</option>
                                            <option value="insurance">Insurance</option>
                                            <option value="loan">Loan</option>
                                            <option value="rtgs">RTGS</option>
                                        </select>
                                    </div>

                                    @if($type == 'disk')
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Permanent Disk Payments</label>
                                            <select class="form-control border border-2 p-2" wire:model="disk_payment">
                                                <option value="">Pick Payment</option>
                                                @foreach($diskPayments as $diskPayment)
                                                    <option value="{{ $diskPayment->id }}">{{ $diskPayment->notes }} - {{$diskPayment->curr->name}} ({{ number_format($diskPayment->order_price, 2) }}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if($type == 'dstv')
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">DSTV Payments</label>
                                            <select class="form-control border border-2 p-2" wire:model="dstv_transaction">
                                                <option value="">Pick Payment</option>
                                                @foreach($dstvTransactions as $dstvTransaction)
                                                    <option value="{{ $dstvTransaction->id }}"> {{ $dstvTransaction->dstv_account_number }} ({{ number_format($dstvTransaction->balance, 2) }}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if($type == 'ecocash')
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Ecocash Payments</label>
                                            <select class="form-control border border-2 p-2" wire:model="ecocash_payment">
                                                <option value="">Pick Payment</option>
                                                @foreach($ecoCashPayments as $ecoCashPayment)
                                                    <option value="{{ $ecoCashPayment->id }}"> {{ $ecoCashPayment->name }} ({{ $ecoCashPayment->curr->name }} {{ number_format($ecoCashPayment->amount, 2) }}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if($type == 'eggs')
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Eggs Payments</label>
                                            <select class="form-control border border-2 p-2" wire:model="eggs_payment">
                                                <option value="">Pick Payment</option>
                                                @foreach($eggsPayments as $eggsPayment)
                                                    <option value="{{ $eggsPayment->id }}"> {{ $eggsPayment->notes }} ({{ $eggsPayment->curr->name }} {{ number_format($eggsPayment->order_price, 2) }}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if($type == 'insurance')
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Insurance Transactions</label>
                                            <select class="form-control border border-2 p-2" wire:model="insurance_transaction">
                                                <option value="">Pick Payment</option>
                                                @foreach($insuranceTransactions as $insuranceTransaction)
                                                    <option value="{{ $insuranceTransaction->id }}"> {{ $insuranceTransaction->reg_no }} {{ number_format($insuranceTransaction->amount, 2) }}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if($type == 'loan')
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Loans</label>
                                            <select class="form-control border border-2 p-2" wire:model="loan_id">
                                                <option value="">Pick Loan</option>
                                                @foreach($loansDisbursed as $loan)
                                                    <option value="{{ $loan->id }}"> {{ $loan->notes }} {{ number_format($loan->amount, 2) }}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                </div>
                                <button type="submit" class="btn bg-gradient-dark">Submit</button>
                                <div class='' id="success_error_message"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <x-plugins></x-plugins>

    </x-layout>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#add_rtgs_form').submit(function (e) {
                $('#success_error_message').html('');

                e.preventDefault();
                var formData = new FormData(this)
                console.log(formData)
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        console.log(result);
                        $('#success_error_message').append('<div class="text-success" style="font-size: larger">' + result.message + '</div');
                    },
                    error: function (xhr, status, err) {
                        console.log(xhr);
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + value + '</div');
                            });

                        } else if (xhr.status === 500) {
                            $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.responseJSON.message + '</div');
                        } else {
                            $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.statusText + '</div');
                        }
                    }
                });
            });
        });
    </script>

</div>
