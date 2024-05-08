<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="dstv"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="DSTV Subscriptions"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route("dstv_subscription_add") }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Subscription</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Subscription REF
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Client ID No
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Package
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Amount Paid
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created By
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created At
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dstv_transactions as $subscription)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $subscription->id }}</h6> 
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $subscription->getUser()->name }} ({{ $subscription->getUser()->phone1 }})</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $subscription->package_id }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $subscription->package_id }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $subscription->created_by }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $subscription->created_at }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="" data-original-title=""
                                                   title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-link"
                                                        data-original-title="" title="">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>
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
