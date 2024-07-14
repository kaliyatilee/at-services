<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="vehicle_licence_transactions"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Vehicle Licence Transaction"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <h5>Vehicle Licence Transaction Details</h5>
                        <dl class="row">
                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-9">{{ $transaction->name }}</dd>

                            <dt class="col-sm-3">Phone</dt>
                            <dd class="col-sm-9">{{ $transaction->phone }}</dd>

                            <dt class="col-sm-3">Currency</dt>
                            <dd class="col-sm-9">{{ $transaction->currency->name }}</dd>

                            <dt class="col-sm-3">Rate</dt>
                            <dd class="col-sm-9">{{ $transaction->rate }}</dd>

                            <dt class="col-sm-3">Registration Number</dt>
                            <dd class="col-sm-9">{{ $transaction->registration_number }}</dd>

                            <dt class="col-sm-3">Expiry Date</dt>
                            <dd class="col-sm-9">{{ $transaction->expiry_date }}</dd>

                            <dt class="col-sm-3">Transaction Type</dt>
                            <dd class="col-sm-9">{{ $transaction->transaction_type->name }}</dd>

                            <dt class="col-sm-3">Vehicle Class</dt>
                            <dd class="col-sm-9">{{ $transaction->vehicle_class }}</dd>

                            <dt class="col-sm-3">Amount Paid ZIG</dt>
                            <dd class="col-sm-9">{{ $transaction->amount_paid_zig }}</dd>

                            <dt class="col-sm-3">Amount Paid USD</dt>
                            <dd class="col-sm-9">{{ $transaction->amount_paid_usd }}</dd>

                            <dt class="col-sm-3">Expected Amount ZIG</dt>
                            <dd class="col-sm-9">{{ $transaction->expected_amount_zig }}</dd>

                            <dt class="col-sm-3">Expected Amount USD</dt>
                            <dd class="col-sm-9">{{ $transaction->expected_amount_usd }}</dd>

                            <dt class="col-sm-3">Created By</dt>
                            <dd class="col-sm-9">{{ $transaction->created_by }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
