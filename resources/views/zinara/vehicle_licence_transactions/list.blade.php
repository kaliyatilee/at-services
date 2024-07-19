<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="vehicle_licence_transactions"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Vehicle Licence Transactions"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="me-3 my-3 text-end">
                           
                            <a class="btn bg-gradient-dark mb-0" href="{{ route("create_zinara_vehicle") }}">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                            </a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="dt-nested-object">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                            <th style="display: none;" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date of Transaction</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                                            <th style="display: none;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Currency</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rate</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registration Number</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expiry Date</th>
                                            <th style="display: none;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Transaction Type</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vehicle Class</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount Paid ZIG</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount Paid USD</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expected Amount ZIG</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expected Amount USD</th>
                                            <th style="display: none;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created By</th>
                                            <th class="text-secondary opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td style="display: none;">{{ optional($transaction->date_of_transaction)->format('Y-m-d') }}</td>
                                                <td>{{ $transaction->name }}</td>
                                                <td>{{ $transaction->phone }}</td>
                                                <td style="display: none;">{{ $transaction->currency }}</td>
                                                <td>{{ $transaction->rate }}</td>
                                                <td>{{ $transaction->reg_no }}</td>
                                                <td>{{ optional($transaction->expiry_date)->format('Y-m-d') }}</td>
                                                <td style="display: none;">{{ $transaction->transaction_type }}</td>
                                                <td>{{ optional($transaction->getVehicleClass())->name }}</td>
                                                <td>{{ $transaction->amount_paid_zig }}</td>
                                                <td>{{ $transaction->amount_paid }}</td>
                                                <td>{{ $transaction->expected_amount_zig }}</td>
                                                <td>{{ $transaction->expected_amount }}</td>
                                                <td style="display: none;">{{ optional($transaction->createdBy)->name }}</td>
                                                <td>
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('api_edit_zinara', $transaction->id) }}">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    <a rel="tooltip" class="btn btn-primary btn-link" href="{{ route('api_detail_zinara', $transaction->id) }}">
                                                        <i class="material-icons">view_module</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    <a class="btn btn-danger btn-link delete-button"
                                                       href="{{ route('api_delete_zinara', $transaction->id) }}"
                                                       data-transaction-id="{{ $transaction->id }}">
                                                        <i class="material-icons">close</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="16" class="text-center">No transactions found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
