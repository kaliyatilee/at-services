<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="expenses"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Expense"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3"> 
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Full Name</label>
                                <input readonly type="text" name="full_name" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Full Name is required"
                                        value='{{ $transaction->full_name }}'>
                                        @if ($errors->has('full_name'))
                                    <small class="mt-2 text-sm text-danger">{{ $errors->first('full_name') }}</small>
                                @endif
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input
                                    readonly
                                    class="form-control border border-2 p-2"
                                    type="tel"
                                    data-parsley-trigger="focusout" required data-parsley-required-message="Phoneis required"
                                    pattern="2637[0-9]{8}"
                                    title="Must start with 2637 and follow format: 2637*********"
                                    placeholder="Format: 2637*********"
                                    name="phone"
                                    value="{{ $transaction->phone }}" 
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
                                <input readonly type="text" name="description" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Description is required"
                                        value='{{ $transaction->description }}'>
                                        @if ($errors->has('description'))
                                    <small class="mt-2 text-sm text-danger">{{ $errors->first('description') }}</small>
                                @endif
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Amount Paid</label>
                                <input readonly type="number" step=".01" name="amount_paid" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Amount is required"
                                        value='{{ $transaction->amount_paid }}'>
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
                                <input readonly type="number" step=".01" name="rate" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Rate is required"
                                        value='{{ $transaction->rate }}'>
                                        @if ($errors->has('rate'))
                                    <small class="mt-2 text-sm text-danger">{{ $errors->first('rate') }}</small>
                                @endif
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Payment Type</label>
                                <select class="form-control border border-2 p-2" name="payment_type" data-parsley-trigger="focusout" required data-parsley-required-message="Payment type is required">
                                    <option value="">Select Payment Type</option>
                                    <option value="Given" {{ $transaction->payment_type === 'Given'? 'selected' : '' }}>Given</option>
                                    <option value="Received" {{ $transaction->payment_type === 'Received'? 'selected' : '' }}>Received</option>
                                </select>
                                        @if ($errors->has('payment_type'))
                                    <small class="mt-2 text-sm text-danger">{{ $errors->first('payment_type') }}</small>
                                @endif
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Transaction Date</label>
                                <input readonly type="date" name="transaction_date" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Transaction date is required"
                                        value='{{ $transaction->transaction_date }}'>
                                        @if ($errors->has('transaction_date'))
                                    <small class="mt-2 text-sm text-danger">{{ $errors->first('transaction_date') }}</small>
                                @endif
                            </div>
                            
                            <div class="mb-3 col-12">
                                <label class="form-label">Notes</label>
                                <input readonly type="text" name="notes" class="form-control border border-2 p-2"
                                        value='{{ $transaction->notes }}'>
                                        @if ($errors->has('notes'))
                                    <small class="mt-2 text-sm text-danger">{{ $errors->first('notes') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>