<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="airtime-sales-record"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Sale"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                            <form class="" id="form" method='POST' action='{{route('airtime_sales_record_update',['id' => $salesRecord->id])}}'>
                                @csrf
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="full_name" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Full Name is required"
                                           value='{{ $salesRecord->full_name }}'>
                                           @if ($errors->has('full_name'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('full_name') }}</small>
                                    @endif
                                </div>

								<div class="mb-3 col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input
                                        class="form-control border border-2 p-2"
                                        type="tel"
                                        data-parsley-trigger="focusout" required data-parsley-required-message="Phoneis required"
                                        pattern="2637[0-9]{8}"
                                        title="Must start with 2637 and follow format: 2637*********"
                                        placeholder="Format: 2637*********"
                                        name="phone"
                                        value="{{ $salesRecord->phone }}"
                                        oninput="this.setCustomValidity('')"
                                        oninvalid="this.setCustomValidity('Invalid phone number. Must start with 2637 and follow format: 2637*********')"
                                    />
                                    <div id="phone_success_error_message" class="text-danger text-xs"></div>
                                    @if ($errors->has('phone'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('phone') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Description</label>
                                    <input type="text" name="description" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Description is required"
                                           value='{{ $salesRecord->description }}'>
                                           @if ($errors->has('description'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Paid</label>
                                    <input type="number" step=".01" name="amount_paid" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Amount is required"
                                           value='{{ $salesRecord->amount_paid }}'>
                                           @if ($errors->has('amount_paid'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('amount_paid') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Currency</label>
                                    <select class="form-control border border-2 p-2" name="currency" data-parsley-trigger="focusout" required data-parsley-required-message="Currency is required">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}" {{ $currency->id == old('currency', $currency->id) ? 'selected' : '' }}>
                                                {{ $currency->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('currency'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('currency') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Rate</label>
                                    <input type="number" step=".01" name="rate" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Rate is required"
                                           value='{{ $salesRecord->rate }}'>
                                           @if ($errors->has('rate'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('rate') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Payment Type</label>
                                    <select class="form-control border border-2 p-2" name="payment_type" data-parsley-trigger="focusout" required data-parsley-required-message="Payment type is required">
                                        <option value="">Select Payment Type</option>
                                        <option value="Given" {{ $salesRecord->payment_type === 'Given'? 'selected' : '' }}>Given</option>
                                        <option value="Received" {{ $salesRecord->payment_type === 'Received'? 'selected' : '' }}>Received</option>
                                    </select>
                                           @if ($errors->has('payment_type'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('payment_type') }}</small>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Percentage</label>
                                    <input type="number" step=".01" name="percentage" max="100" min="0" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Commission percentage is required"
                                           value='{{ $salesRecord->percentage }}'>
                                           @if ($errors->has('percentage'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('percentage') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Transaction Date</label>
                                    <input type="date" name="transaction_date" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Transaction date is required"
                                           value='{{ $salesRecord->transaction_date }}'>
                                           @if ($errors->has('transaction_date'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('transaction_date') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Notes</label>
                                    <input type="text" name="notes" class="form-control border border-2 p-2"
                                           value='{{ $salesRecord->notes }}'>
                                           @if ($errors->has('notes'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('notes') }}</small>
                                    @endif
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

        $('#form').submit(function (e) {
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
