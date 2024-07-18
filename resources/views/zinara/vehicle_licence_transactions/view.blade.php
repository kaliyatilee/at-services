<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="dstv/edit"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Insurance Transaction"></x-navbars.navs.auth>
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
										<p> Client Name</p>
										<hr>
										{{ $zinara_transaction->name }} / {{ $zinara_transaction->phone }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Vehicle Class</p>
										<hr>
										{{ $zinara_transaction->getVehicleClass()->name }}
										</div>
									</div>
                                </div>


								


								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Registration Number</p>
										<hr>
										{{ $zinara_transaction->reg_no }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Expiry Date</p>
										<hr>
										{{ $zinara_transaction->expiry_date }}
										</div>
									</div>
                                </div>

							

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Transaction Date</p>
										<hr>
										{{ $zinara_transaction->transaction_date }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Notes</p>
										<hr>
										{{ $zinara_transaction->notes }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Received Date</p>
										<hr>
										{{ $zinara_transaction->received_date }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Expected Amount(ZIG)</p>
										<hr>
										{{ $zinara_transaction->expected_amount_zig }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Expected Amount(USD)</p>
										<hr>
										{{ $zinara_transaction->expected_amount }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Amount Received(USD)</p>
										<hr>
										{{ $zinara_transaction->amount_received_usd }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Commission(%)</p>
										<hr>
										{{ $zinara_transaction->commission_percentage }}%
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Commission Amount</p>
										<hr>
										{{ $zinara_transaction->commission_amount }} 
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Phone</p>
										<hr>
										{{ $zinara_transaction->phone }} 
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Exchange Rate</p>
										<hr>
										{{ $zinara_transaction->rate }} 
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Amount Received(ZIG)</p>
										<hr>
										{{ $zinara_transaction->amount_received_zig }} 
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Amount to be Remitted (ZIG)</p>
										<hr>
										{{ $zinara_transaction->amount_remitted_zig }} 
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Amount to be Remitted(USD)</p>
										<hr>
										{{ $zinara_transaction->amount_remitted_usd }} 
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

