<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="Agent Transactions"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Agent Transactions"></x-navbars.navs.auth>
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
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Name</p>
                                        <hr>
                                        {{ $agent->name }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Phone </p>
                                        <hr>
                                        {{ $agent->phone }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="card card-frame">
                                    <div class="card-body">
                                        <p>Account Balance</p>
                                        <hr>
                                        {{ $accountBalance }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h2>Transactions</h2>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount Remitted</th>
                                <th>Account Balance</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->name }}</td>
                                    <td>{{ $transaction->amount_remmited }}</td>
                                    <td>{{ $transaction->account_balance }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
