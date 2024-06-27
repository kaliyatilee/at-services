<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="edit_insurance_transaction"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Insurance Transaction"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <form id="edit_insurance_transaction_form" method='POST' action='{{ route('api_update_insurance_transaction', $insurance_transaction->id) }}'>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Search Client</label>
                                    <input type="text" id="name" name="name" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->name }}'>
                                    <div id="suggestionsPopup" class="form-control border border-2 p-2" style="z-index: 1"></div>
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $insurance_transaction->user_id }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->phone }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Vehicle Class</label>
                                    <select class="form-control border border-2 p-2" name="class">
                                        @foreach($vehicle_classes as $vehicle_class)
                                            <option value="{{ $vehicle_class->id }}">{{ $vehicle_class->name }} - {{ $vehicle_class->currency()->name }}{{ $vehicle_class->amount }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Vehicle Type</label>
                                    <input type="text" name="vehicle_type" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->vehicle_type }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Insurance Broker</label>
                                    <select class="form-control border border-2 p-2" name="insurance_broker">
                                        @foreach($insurance_brokers as $insurance_broker)
                                            <option value="{{ $insurance_broker->id }}">{{ $insurance_broker->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Vehicle Reg Number</label>
                                    <input type="text" name="reg_no" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->reg_no }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="date" name="expiry_date" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->expiry_date->format("Y-m-d")}}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Exchange Rate</label>
                                    <input type="text" name="rate" id="rate" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->rate }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Currency</label>
                                    <select class="form-control border border-2 p-2" name="currency_id">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Expected Amount (ZIG)</label>
                                    <input type="text" name="expected_amount_zig" id="expected_amount_zig" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->expected_amount_zig }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Expected Amount (USD)</label>
                                    <input type="text" name="expected_amount_usd" id="expected_amount_usd" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->expected_amount }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Transaction Date</label>
                                    <input type="date" name="transaction_date" class="form-control border border-2 p-2"
                                           value='{{ isset($insurance_transaction->transaction_date) ? \Carbon\Carbon::parse($insurance_transaction->transaction_date)->format("Y-m-d") : "" }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Received Date</label>
                                    <input type="date" name="received_date" class="form-control border border-2 p-2"
                                           value='{{ isset($insurance_transaction->received_date) ? \Carbon\Carbon::parse($insurance_transaction->received_date)->format("Y-m-d") : "" }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Commission Amount</label>
                                    <input type="text" name="commission_amount" id="commission_amount" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->commission_amount }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Received (ZIG)</label>
                                    <input type="text" name="amount_received_zig" id="amount_received_zig" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->amount_received_zig }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Received (USD)</label>
                                    <input type="text" name="amount_received_usd" id="amount_received_usd" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->amount_received_usd }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Paid (USD)</label>
                                    <input type="text" name="amount_paid" id="amount_paid_usd" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->amount_paid }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Paid (ZIG)</label>
                                    <input type="text" name="amount_paid_zig" id="amount_paid_zig" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->amount_paid_zig }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount to be Remitted (ZIG)</label>
                                    <input type="text" name="amount_remitted_zig" id="amount_remitted_zig" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->amount_remitted_zig }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount to be Remitted (USD)</label>
                                    <input type="text" name="amount_remitted_usd" id="amount_remitted_usd" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->amount_remitted_usd }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Commission (%)</label>
                                    <input type="text" name="commission_percentage" id="commission_percentage" class="form-control border border-2 p-2"
                                           value='{{ $insurance_broker->commission }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Notes</label>
                                    <input type="text" name="notes" class="form-control border border-2 p-2"
                                           value='{{ $insurance_transaction->notes }}'>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        function calculateCommissionAmount() {
            var expectedAmountZig = parseFloat(document.getElementById('expected_amount_zig').value) || 0;
            var expectedAmountUSD = parseFloat(document.getElementById('expected_amount_usd').value) || 0;
            var amountReceivedZig = parseFloat(document.getElementById('amount_received_zig').value) || 0;
            var amountReceivedUSD = parseFloat(document.getElementById('amount_received_usd').value) || 0;
            var amountPaidUSD = parseFloat(document.getElementById('amount_paid_usd').value) || 0;
            var commissionPercentage = parseFloat(document.getElementById('commission_percentage').value) || 0;
            var rate = parseFloat(document.getElementById('rate').value) || 1;

            console.log("expectedAmountZig:", expectedAmountZig);
            console.log("amountReceivedZig:", amountReceivedZig);
            console.log("commissionPercentage:", commissionPercentage);
            console.log("rate:", rate);

            if (expectedAmountZig > 0 && amountReceivedZig > 0) {
            document.getElementById('amount_remitted_usd').value = 0;
            var commissionAmount = (amountReceivedZig - (expectedAmountZig * (commissionPercentage / 100))) / rate;
            var remittedAmountUSD = (expectedAmountUSD * (commissionPercentage / 100));
            var remittedAmountZig = (expectedAmountZig * (commissionPercentage / 100));
            document.getElementById('amount_remitted_zig').value = commissionAmount.toFixed(2);
            document.getElementById('amount_remitted_usd').value = commissionAmount.toFixed(2);
            document.getElementById('commission_amount').value = commissionAmount.toFixed(2);

            console.log("commission amount:", commissionAmount);
            } 
            else if (expectedAmountZig > 0 && amountReceivedUSD > 0) {
                console.log("2nd")
            amountReceivedZig = amountReceivedUSD * rate
            //document.getElementById('amount_receieved_usd').value = amountReceivedZig.toFixed(2);
            var commissionAmount = (amountReceivedZig - (expectedAmountZig * (commissionPercentage / 100))) / rate;
            var remittedAmountUSD = (expectedAmountUSD * (commissionPercentage / 100));
            var remittedAmountZig = (expectedAmountZig * (commissionPercentage / 100));
            document.getElementById('amount_remitted_zig').value = commissionAmount.toFixed(2);
            document.getElementById('amount_remitted_usd').value = commissionAmount.toFixed(2);
            document.getElementById('commission_amount').value = commissionAmount.toFixed(2);
            }

            else if (expectedAmountUSD > 0 && amountReceivedUSD > 0) {
                console.log("3rd")
            
            //document.getElementById('amount_receieved_usd').value = amountReceivedZig.toFixed(2);
            var commissionAmount = (amountReceivedUSD - (expectedAmountUSD * (commissionPercentage / 100)));
            var remittedAmountUSD = (expectedAmountUSD * (commissionPercentage / 100));
            var remittedAmountZig = (expectedAmountZig * (commissionPercentage / 100));
            document.getElementById('amount_remitted_zig').value = commissionAmount.toFixed(2);
            document.getElementById('amount_remitted_usd').value = commissionAmount.toFixed(2);
            document.getElementById('commission_amount').value = commissionAmount.toFixed(2);
            }

            else if (expectedAmountUSD > 0 && amountReceivedZig > 0) {
                console.log("4th")
                amountReceivedUSD = amountReceivedZig * rate
            //document.getElementById('amount_receieved_usd').value = amountReceivedZig.toFixed(2);
            var commissionAmount = (amountReceivedUSD - (expectedAmountUSD * (commissionPercentage / 100)));
            var remittedAmountUSD = (expectedAmountUSD * (commissionPercentage / 100));
            var remittedAmountZig = (expectedAmountZig * (commissionPercentage / 100));
            document.getElementById('amount_remitted_zig').value = commissionAmount.toFixed(2);
            document.getElementById('amount_remitted_usd').value = commissionAmount.toFixed(2);
            document.getElementById('commission_amount').value = commissionAmount.toFixed(2);
            }

            else {
                document.getElementById('commission_amount').value = 0;
            }
        }

        //disable or enable Zig fields when usig USD
        function enableExpectedAmountUSD() {
            document.getElementById('expected_amount_usd').disabled = false;
        }
        function disableExpectedAmountUSD() {
            document.getElementById('expected_amount_usd').disabled = true;
        }

        function enableAmountReceivedUSD() {
            document.getElementById('amount_received_usd').disabled = false;
        }
        function disableAmountReceivedUSD() {
            document.getElementById('amount_received_usd').disabled = true;
        }

                //disable or enable USD fields when usig Zig
                function enableExpectedAmountZig() {
            document.getElementById('expected_amount_zig').disabled = false;
        }
        function disableExpectedAmountZig() {
            document.getElementById('expected_amount_zig').disabled = true;
        }

        function enableAmountReceivedZig() {
            document.getElementById('amount_received_zig').disabled = false;
        }
        function disableAmountReceivedZig() {
            document.getElementById('amount_received_zig').disabled = true;
        }
        
        //Zig
         $('#expected_amount_usd').on('mouseenter', enableExpectedAmountUSD);
         $('#expected_amount_zig').on('input', disableExpectedAmountUSD);
         $('#amount_received_usd').on('mouseenter', enableAmountReceivedUSD);
         $('#amount_received_zig').on('input', disableAmountReceivedUSD);

         //USD
         $('#expected_amount_zig').on('mouseenter', enableExpectedAmountZig);
         $('#expected_amount_usd').on('input', disableExpectedAmountZig);
         $('#amount_received_zig').on('mouseenter', enableAmountReceivedZig);
         $('#amount_received_usd').on('input', disableAmountReceivedZig);
        $('#expected_amount_zig, #expected_amount_usd, #amount_received_zig, #amount_received_usd, #amount_paid_usd, #commission_percentage, #rate').on('input', calculateCommissionAmount);
    });
</script>
