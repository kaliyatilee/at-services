<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="dstv/edit"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View DStv Subscription"></x-navbars.navs.auth>
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
                                <label class="form-label">Search Client</label>
                                <input type="text" id="name" name="name" class="form-control border border-2 p-2"
                                       value='{{ $dstv_transaction->name }}'>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input
                                    class="form-control border border-2 p-2"
                                    type="tel"
                                    pattern="2637[0-9]{8}"
                                    title="Must start with 2637 and follow format: 2637*********"
                                    placeholder="Format: 2637*********"
                                    name="phone"
                                    value="{{ $dstv_transaction->phone }}"
                                    oninput="this.setCustomValidity('')"
                                    oninvalid="this.setCustomValidity('Invalid phone number. Must start with 2637 and follow format: 2637*********')"
                                />
                                <div id="phone_success_error_message" class="text-danger text-xs"></div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Account Number</label>
                                <input type="text" name="dstv_account_number"
                                       class="form-control border border-2 p-2"
                                       value='{{ $dstv_transaction->dstv_account_number }}'>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Description</label>
                                <input type="text" name="description" class="form-control border border-2 p-2"
                                       value='{{ $dstv_transaction->description }}'>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">System Charge</label>
                                <select class="form-control border border-2 p-2" name="system_charges" required>
                                    @foreach($system_charges as $charges)
                                    <option value="{{ $charges->id }}" {{ $charges->id == $dstv_transaction->system_charges ? 'selected' : '' }}>{{ $charges->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Charge Amount</label>
                                <input type="number" step=".1" name="system_charge_amount"
                                       class="form-control border border-2 p-2"
                                       value='{{ $dstv_transaction->system_charge_amount }}'>
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
                                <label class="form-label">Amount Paid</label>
                                <input type="text" name="amount_paid" class="form-control border border-2 p-2"
                                       value='{{ $dstv_transaction->amount_paid }}'>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Rate</label>
                                <input type="number" step=".1" name="rate" class="form-control border border-2 p-2"
                                       value='{{ $dstv_transaction->rate }}'>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Transaction Date</label>
                                <input type="date" name="transaction_date" class="form-control border border-2 p-2"
                                value='{{ isset($dstv_transaction->transaction_date) ? \Carbon\Carbon::parse($dstv_transaction->transaction_date)->format("Y-m-d") : "" }}'>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Notes (Optional)</label>
                                <input type="text" name="notes" class="form-control border border-2 p-2"
                                       value='{{ $dstv_transaction->notes }}'>
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>

