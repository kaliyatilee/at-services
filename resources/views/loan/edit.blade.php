<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Loan Disbursed"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <div class="card-body px-0 pb-2">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Loan Information</button>
                                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Loan Payments</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                    <div class="py-4">

                                        <div class="table-responsive p-0 border mb-6">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr class="bg-secondary text-white">
                                                    <th
                                                        class="text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Client
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Amount Disbursed
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Total Paid
                                                    </th>
                                                    
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Balance
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Collateral
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Total Expense
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Rate per Week
                                                    </th>
                                                    <th
                                                    class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Commission
                                                    </th>
                                                    <th
                                                    class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Commission USD
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Repayment Date
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Notes
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Created By
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Transaction Date
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <p class="mb-0 text-sm">{{ $loan->name.' - '.$loan->phone }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loan->currency()->name }}{{ $loan->amount }}</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loan->currency()->name.$installments }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loan->currency()->name }}{{ $loan->getBalance() }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loan->collateral }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $total_expenses ?? '0.00' }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loan->rate_per_week }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ number_format($commission, 2) ?? '0.00' }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ number_format($commission_usd, 2) ?? '0.00' }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loan->repayment_date }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loan->notes ?? '---'}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loan->createdBy()->name }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $loan->transaction_date }}</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <form id="edit_loan_form" method='POST' action='{{ route('api_update_loan_disbursed', ['id' => $loan->id]) }}'>
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Search Client</label>
                                                    <input type="text" id="name" name="name" class="form-control border border-2 p-2"
                                                        value='{{ $loan->name }}'>
                                                    <div id="suggestionsPopup" class="form-control border border-2 p-2" style="z-index: 1"></div>
                                                    <input type="hidden" name="user_id" id="user_id" value="{{ $loan->user_id }}" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Phone Number</label>
                                                    <input type="text" name="phone" class="form-control border border-2 p-2"
                                                        value='{{ $loan->phone }}'>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Currency</label>
                                                    <select class="form-control border border-2 p-2" name="currency_id">
                                                        @foreach($currencies as $currency)
                                                        <option value="{{ $currency->id }}" {{ $currency->id == $loan->currency_id ? 'selected' : '' }}>
                                                                {{ $currency->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Amount</label>
                                                    <input type="number" name="amount" class="form-control border border-2 p-2"
                                                        value='{{ $loan->amount }}'>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Rate per Week</label>
                                                    <input type="number" name="rate_per_week" class="form-control border border-2 p-2"
                                                        value='{{ $loan->rate_per_week }}'>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Repayment Date</label>
                                                    <input type="date" name="repayment_date" class="form-control border border-2 p-2"
                                                        value='{{ $loan->repayment_date->format("Y-m-d") }}'>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Collateral</label>
                                                    <input type="text" name="collateral" class="form-control border border-2 p-2"
                                                        value='{{ $loan->collateral }}'>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Transaction Date</label>
                                                    <input type="date" name="transaction_date" class="form-control border border-2 p-2"
                                                    value='{{ isset($loan->transaction_date) ? \Carbon\Carbon::parse($loan->transaction_date)->format("Y-m-d") : "" }}'>
                                                </div>

                                                <div class="mb-3 col-12">
                                                    <label class="form-label">Notes</label>
                                                    <textarea rows="3" type="text" name="notes" class="form-control border border-2 p-2">{{$loan->notes}}</textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <button type="submit" class="btn bg-gradient-dark text-white">Update Loan</button>
                                            <div class='' id="success_error_message"></div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                    <div class="py-4">
                                        <div class="table-responsive p-0 border mb-6">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr class="bg-secondary text-white">
                                                    <th
                                                        class="text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Installment Pay Date
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Amount Before
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Amount After
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Installment Amount Paid
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Currency Rate
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Expense
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">
                                                        Expense Amount
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($payments as $payment)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <p class="mb-0 text-sm">{{$payment->installment_payment_date}}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $payment->amount_before }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{$payment->amount_after }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $payment->installment_amount_paid }}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $payment->currency_rate ?? '0.00'}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $payment->expense ?? '---'}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $payment->expense_amount ?? '0.00'}}</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <form id="loan_payment_form" method='POST' action='{{ route('api_create_loan_payment') }}'>
                                            @csrf
                                            <div class="row">

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Installment Payment Date </label>
                                                    <input type="date" name="installment_payment_date" class="form-control border border-2 p-2"
                                                    value='{{old('installment_payment_date')}}'>
                                                </div>
                                                <div class="mb-3 col-md-6 row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Installment Amount Paid</label>
                                                        <input type="number" step="0.5" placeholder="$0.00" name="installment_amount_paid" class="form-control border border-2 p-2"
                                                        value='{{old('installment_amount_paid')}}'>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Currency Rate</label>
                                                        <input type="number" placeholder="0.00" step="0.1" name="currency_rate" class="form-control border border-2 p-2"
                                                        value='{{old('currency_rate')}}'>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Expense</label>
                                                    <input type="text" placeholder="E.g. Litigation Expenses" name="expense" class="form-control border border-2 p-2"
                                                    value='{{ old('expense') }}'>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Expense Amount</label>
                                                    <input type="number" step="0.5" placeholder="$0.00" name="expense_amount" class="form-control border border-2 p-2"
                                                    value='{{old('expense_amount') }}'>
                                                </div>
                                                <div class="mb-3 col-12">
                                                    <label class="form-label">Notes</label>
                                                    <input type="text" name="notes" class="form-control border border-2 p-2"
                                                    value='{{old('notes')}}'>
                                                </div>
                                                <input type="number" name="loan_id" class="text-white form-control hidden" value='{{$loan->id}}'>
                                                <div class="mb-3 col-3">
                                                    <button type="submit" class="btn bg-gradient-dark">Submit Payment</button>
                                                    <div class='' id="success_error_message_"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>

<script type="text/javascript">
    $(document).ready(function () {

        var searchInput = document.getElementById('client_name');
        var suggestionsPopup = document.getElementById('suggestionsPopup');

        $('#client_name').on('input', function () {
            // Get the input value
            var inputValue = $(this).val();

            if(inputValue.length >= 2){

                $.ajax({
                    url: '{{ route("api_search_clients","") }}/' + inputValue, // Replace with your server endpoint
                    type: 'GET', // Specify the HTTP method as GET
                    data: {search: inputValue}, // Send data to the server
                    success: function (response) {
                        // Handle the success response from the server
                        console.log(response);

                        displaySuggestionsPopup(response.data)
                    },
                    error: function (error) {
                        // Handle any errors that occur during the AJAX request
                        console.error('AJAX Error:', error);
                    }
                });
            }
        })

        function displaySuggestionsPopup(clients) {
            // Clear previous suggestions
            suggestionsPopup.innerHTML = '';

            if (clients.length === 0) {
                hideSuggestionsPopup();
                return;
            }

            // Create and append suggestion elements to the popup
            var ul = document.createElement('ul');
            clients.forEach(function (client) {
                var li = document.createElement('li');
                var jsonData = JSON.parse(client);
                li.textContent = jsonData.name + " - " + jsonData.phone1 + " - " + jsonData.id_number;
                li.addEventListener('click', function () {
                    // Handle suggestion selection (e.g., fill input with suggestion)
                    searchInput.value = jsonData.name + " - " + jsonData.phone1;
                    $("#user_id").val(jsonData.id_number);
                    hideSuggestionsPopup();
                });
                ul.appendChild(li);
            });

            suggestionsPopup.appendChild(ul);

            // Position the popup under the input
            var rect = searchInput.getBoundingClientRect();
            //        suggestionsPopup.style.left = rect.left + 'px';
            //      suggestionsPopup.style.top = rect.bottom + 'px';

            // Show the popup
            suggestionsPopup.style.display = 'block';
        }

        function hideSuggestionsPopup() {
            suggestionsPopup.style.display = 'none';
        }

        $('#edit_loan_form').submit(function (e) {
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

        $('#loan_payment_form').submit(function (e) {
            $('#success_error_message_').html('');

            e.preventDefault();
            var formData2 = new FormData(this)
            console.log(formData2)
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData2,
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log(result);
                    $('#loan_payment_form')[0].reset();
                    $('#success_error_message_').append('<div class="text-success" style="font-size: larger">' + result.message + '</div');
                },
                error: function (xhr, status, err) {
                    console.log(xhr);
                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#success_error_message_').append('<div class="text-danger" style="font-size: larger">' + value + '</div');
                        });

                    } else if (xhr.status === 500) {
                        $('#success_error_message_').append('<div class="text-danger" style="font-size: larger">' + xhr.responseJSON.message + '</div');
                    } else {
                        $('#success_error_message_').append('<div class="text-danger" style="font-size: larger">' + xhr.statusText + '</div');
                    }
                }
            });
        });
    });
</script>
