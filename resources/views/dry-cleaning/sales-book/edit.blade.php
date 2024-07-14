<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="sales-book"></x-navbars.sidebar>
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
                        <form id="form" method="post" action="{{route('api_sales_book_update',['id' => $salesBook->id])}}" accept-charset="UTF-8" id="form"
                            enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Search Provider</label>
                                    <select class="form-control border border-2 p-2" name="provider" data-parsley-trigger="focusout" required data-parsley-required-message="Provider is required">
                                        <option value="">Select Provider</option>
                                        @foreach($serviceProviders as $provider)
                                            <option value="{{ $provider->id }}" {{ $provider->id == old('provider', $provider->id) ? 'selected' : '' }}>
                                                {{ $provider->provider }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('provider'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('provider') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="full_name" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Full Name is required"
                                           value='{{ $salesBook->full_name }}'>
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
                                        value="{{ $salesBook->phone }}" 
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
                                           value='{{ $salesBook->description }}'>
                                           @if ($errors->has('description'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Paid</label>
                                    <input type="number" name="amount_paid" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Amount is required"
                                           value='{{ $salesBook->amount_paid }}'>
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
                                    <input type="number" step="0.1" name="rate" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Rate is required"
                                           value='{{ $salesBook->rate }}'>
                                           @if ($errors->has('rate'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('rate') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Payment Type</label>
                                    <input type="text" name="payment_type" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Payment type is required"
                                           value='{{ $salesBook->payment_type }}'>
                                           @if ($errors->has('payment_type'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('payment_type') }}</small>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Expense Name</label>
                                    <input type="text" name="expense_name" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Expense name is required"
                                           value='{{ $salesBook->expense_name }}'>
                                           @if ($errors->has('expense_name'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('expense_name') }}</small>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Expense Amount</label>
                                    <input type="number" step="0.1" name="expense_amount" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Expense amount is required"
                                           value='{{ $salesBook->expense_amount }}'>
                                           @if ($errors->has('expense_amount'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('expense_amount') }}</small>
                                    @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Commission %age</label>
                                    <input type="number" step="0.1" name="commission_percentage" max="100" min="0" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Commission percentage is required"
                                           value='{{ $salesBook->commission_percentage }}'>
                                           @if ($errors->has('commission_percentage'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('commission_percentage') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Transaction Date</label>
                                    <input type="date" name="transaction_date" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Transaction date is required"
                                           value='{{ $salesBook->transaction_date }}'>
                                           @if ($errors->has('transaction_date'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('transaction_date') }}</small>
                                    @endif
                                </div>
                                
                                <div class="mb-3 col-12">
                                    <label class="form-label">Notes</label>
                                    <input type="text" name="notes" class="form-control border border-2 p-2"
                                           value='{{ $salesBook->notes }}'>
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

        $('#update_sale_form').submit(function (e) {
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
