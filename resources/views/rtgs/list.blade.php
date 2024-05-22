<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="rtgs"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Zig"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route("rtgs_add") }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Zig Transaction</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="dt-nested-object">
                                    <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name / Phone
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Amount
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Transaction Type
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created By
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Transaction Date
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rtgss as $rtgs)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $rtgs->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $rtgs->name }} / {{ $rtgs->phone }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $rtgs->amount }}</p>
                                                </div>
                                            </td>
											<td class="align-middle text-center">
												<div class="d-flex flex-column justify-content-center">
													<p class="mb-0 text-sm">
														{{ $rtgs->transaction_type == 1 ? 'Amount In' : 'Amount Out' }}
													</p>
												</div>
											</td>
                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $rtgs->createdBy()->name }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $rtgs->transaction_date }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle">
											<a rel="tooltip" class="btn btn-success btn-link"
													href="{{ route("api_edit_rtgs", $rtgs->id) }}" data-original-title=""
                                                   title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>

												<a class="btn btn-danger btn-link delete-button"
													href="{{ route("api_delete_rtgs", ['id' => $rtgs->id]) }}"
													data-rtgs-id="{{ $rtgs->id }}"
													data-original-title=""
													title="">
														<i class="material-icons">close</i>
														<div class="ripple-container"></div>
												</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
