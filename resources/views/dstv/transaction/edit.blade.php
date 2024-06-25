<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="dstv/edit"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit DStv Subscription"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>

            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
					<form id="edit_dstv_transaction_form" method="POST" action="{{ route('api_update_dstv_transaction', ['id' => $dstv_transaction->id]) }}">
                            @csrf

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Search Client</label>
                                    <input type="text" id="name" name="name" class="form-control border border-2 p-2"
                                           value='{{ $dstv_transaction->name }}'>
                                    <div id="suggestionsPopup" class="form-control border border-2 p-2" style="z-index: 1"></div>
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $dstv_transaction->user_id }}" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control border border-2 p-2"
                                           value='{{ $dstv_transaction->phone }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Account Number</label>
                                    <input type="text" name="dstv_account_number"
                                           class="form-control border border-2 p-2"
                                           value='{{ $dstv_transaction->dstv_account_number }}'>
                                </div>

								<div class="mb-3 col-md-6">
									<label class="form-label">Select Package</label>
									<select class="form-control border border-2 p-2" name="package_id">
										@foreach($dstv_packages as $package)
											<option value="{{ $package->id }}" {{ $package->id == $dstv_transaction->package_id ? 'selected' : '' }}>
												{{ $package->name }} - R{{ $package->amount_rand }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="mb-3 col-md-6">
                                    <label class="form-label">Currency</label>
                                    <select class="form-control border border-2 p-2" name="currency_id">
                                        @foreach($currencies as $currency)
										<option value="{{ $currency->id }}" {{ $currency->id == $dstv_transaction->currency_id ? 'selected' : '' }}>
												{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Expected Amount</label>
                                    <input type="text" name="expected_amount" class="form-control border border-2 p-2"
                                           value='{{ $dstv_transaction->expected_amount }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Paid</label>
                                    <input type="text" name="amount_paid" class="form-control border border-2 p-2"
                                           value='{{ $dstv_transaction->amount_paid }}'>
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Notes (Optional)</label>
                                    <input type="text" name="notes" class="form-control border border-2 p-2"
                                           value='{{ $dstv_transaction->notes }}'>
                                </div>
								<div class="mb-3 col-md-6">
                                    <label class="form-label">Transaction Date</label>
                                    <input type="date" name="transaction_date" class="form-control border border-2 p-2"
									value='{{ isset($dstv_transaction->transaction_date) ? \Carbon\Carbon::parse($dstv_transaction->transaction_date)->format("Y-m-d") : "" }}'>
                                </div>
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

        $('#edit_dstv_transaction_form').submit(function (e) {
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
