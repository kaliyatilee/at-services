<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="clients"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Client Credit Authorized"></x-navbars.navs.auth>
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
										<p>ID Number</p>
										<hr>
										{{ $client->id_number }}
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Name</p>
										<hr>
										{{ $client->name }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Phone 1</p>
										<hr>
										{{ $client->phone1 }}
										</div>
									</div>
                                </div>
								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Phone 2</p>
										<hr>
										{{ $client->phone2 }}
										</div>
									</div>
                                </div>
                                <div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Collateral</p>
										<hr>
										{{ $client->collateral }}
										</div>
									</div>
                                </div>

                                <div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Guarantor Name</p>
										<hr>
										{{ $client->guarantor_name }}
										</div>
									</div>
                                </div>

                                <div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>National Identification</p>
										<hr>
                                        <img class="w-60 h-auto img-circle" src="{{ asset('uploads/'.$client->national_id)}}">
										</div>
									</div>
                                </div>

                                <div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Proof of Residence</p>
										<hr>
                                        <img class="w-60 h-auto img-circle" src="{{ asset('uploads/'.$client->proof_of_residence)}}">
										</div>
									</div>
                                </div>

								<div class="mb-3 col-md-6">
									<div class="card card-frame">
										<div class="card-body">
										<p>Added By</p>
										<hr>
										{{ $client->createdBy()->name }}
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

