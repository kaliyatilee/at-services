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
					<form id="edit_dstv_transaction_form" method="POST" action="{{ route('api_update_dstv_transaction', ['id' => $dstv_transaction->id]) }}">
                            <div class="row">
                                <div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p> Client Name</p>
										<hr>
										{{ $dstv_transaction->name }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Phone Number</p>
										<hr>
										{{ $dstv_transaction->phone }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Account Number</p>
										<hr>
										{{ $dstv_transaction->dstv_account_number }}
										</div>
									</div>
                                </div>


								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Package</p>
										<hr>
										{{$selected_dstv_package->name}}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Currency</p>
										<hr>
										{{$selected_currency->name}}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Expected Amount</p>
										<hr>
										{{ $dstv_transaction->expected_amount }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p> Amount Paid</p>
										<hr>
										{{ $dstv_transaction->amount_paid }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Notes</p>
										<hr>
										{{ $dstv_transaction->notes }}
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

