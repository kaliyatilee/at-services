<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="insurance_broker"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Insuarence Broker"></x-navbars.navs.auth>
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
										<p> Name</p>
										<hr>
										{{ $insurance_broker->name }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Commission</p>
										<hr>
										{{ $insurance_broker->commission }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Notes</p>
										<hr>
										{{ $insurance_broker->notes }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Added By</p>
										<hr>
										{{ $insurance_broker->createdBy()->name }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Created On</p>
										<hr>
										{{ $insurance_broker->created_at }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Date of Remittance</p>
										<hr>
										{{ $insurance_broker->date_of_remittance }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Method of Remittance</p>
										<hr>
										{{ $insurance_broker->method_of_remittance }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Amount Remitted</p>
										<hr>
										{{ $insurance_broker->amount_remitted }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Account Balance</p>
										<hr>
										{{ $insurance_broker->account_balance }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Total Remittance</p>
										<hr>
										{{ $insurance_broker->total_remittance }}
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

