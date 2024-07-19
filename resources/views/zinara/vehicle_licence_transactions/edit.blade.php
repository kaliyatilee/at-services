<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="vehicle_licence_transactions"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Vehicle Licence Transaction"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <form id="edit_vehicle_form" method="POST" action="{{ route('api_update_zinara', $zinara_transaction->id) }}">
                            @csrf
                        
                            <div class="row">
                               
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border border-2 p-2" value="{{ $zinara_transaction->name }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control border border-2 p-2" value="{{ $zinara_transaction->phone }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Currency</label>
                                    <select class="form-control border border-2 p-2" name="currency">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}" {{ $zinara_transaction->currency_id == $currency->id ? 'selected' : '' }}>{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Rate</label>
                                    <input type="text" name="rate" class="form-control border border-2 p-2" value="{{ $zinara_transaction->rate }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Registration Number</label>
                                    <input type="text" name="reg_no" class="form-control border border-2 p-2" value="{{ $zinara_transaction->reg_no }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="date" name="expiry_date" class="form-control border border-2 p-2" value="{{ isset($zinara_transaction->expiry_date) ? \Carbon\Carbon::parse($zinara_transaction->expiry_date)->format('Y-m-d') : '' }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Transaction Type</label>
                                    <select class="form-control border border-2 p-2" name="transaction_type">
                                        @foreach($transaction_types as $transaction_type)
                                            <option value="{{ $transaction_type->id }}" {{ $zinara_transaction->transaction_type_id == $transaction_type->id ? 'selected' : '' }}>{{ $transaction_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Vehicle Class</label>
                                    <input type="text" name="vehicle_class" class="form-control border border-2 p-2" value="{{ $zinara_transaction->vehicle_class }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Paid ZIG</label>
                                    <input type="text" name="amount_paid_zig" class="form-control border border-2 p-2" value="{{ $zinara_transaction->amount_paid_zig }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Paid USD</label>
                                    <input type="text" name="amount_paid" class="form-control border border-2 p-2" value="{{ $zinara_transaction->amount_paid }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Expected Amount ZIG</label>
                                    <input type="text" name="expected_amount_zig" class="form-control border border-2 p-2" value="{{ $zinara_transaction->expected_amount_zig }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Expected Amount USD</label>
                                    <input type="text" name="expected_amount" class="form-control border border-2 p-2" value="{{ $zinara_transaction->expected_amount }}">
                                </div>

                               
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Update</button>
                            <div class="mt-3" id="success_error_message"></div>
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
        $('#edit_vehicle_form').submit(function (e) {
            $('#success_error_message').html('');

            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    $('#success_error_message').append('<div class="text-success" style="font-size: larger">' + result.message + '</div>');
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + value + '</div>');
                        });
                    } else if (xhr.status === 500) {
                        $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.responseJSON.message + '</div>');
                    } else {
                        $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.statusText + '</div>');
                    }
                }
            });
        });
    });
</script>
