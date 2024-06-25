<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="dstv/edit"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Permanent Disc"></x-navbars.navs.auth>
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
										<p>Client Name</p>
										<hr>
										{{ $permanent_disc->name }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Phone</p>
										<hr>
										{{ $permanent_disc->phone }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Cash Paid</p>
										<hr>
										{{ $permanent_disc->currency()->name }}{{ $permanent_disc->cash_paid }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Quantity Sold</p>
										<hr>
										{{ $permanent_disc->quantity_sold }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Quantity Received</p>
										<hr>
										{{ $permanent_disc->quantity_received }}
										</div>
									</div>
                                </div>
								
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Order Price</p>
										<hr>
										{{ $permanent_disc->currency()->name }}{{ $permanent_disc->order_price }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Created By</p>
										<hr>
										{{ $permanent_disc->createdBy()->name }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Transaction Date</p>
										<hr>
										{{ $permanent_disc->transaction_date }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Notes</p>
										<hr>
										{{ $permanent_disc->notes }}
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

