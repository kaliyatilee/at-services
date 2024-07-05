<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="insurance_broker"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Insurance Broker"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route("insurance_broker_add") }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Insurance Broker</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="dt-nested-object">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Commission %
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Created By
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Created At
                                            </th>
                                            <th style="display: none;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date of Remittance
                                            </th>
                                            <th style="display: none;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Method of Remittance
                                            </th>
                                            <th style="display: none;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Amount Remitted
                                            </th>
                                            <th style="display: none;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Total Remittance
                                            </th>
                                            <th style="display: none;" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Account Balance
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($insurance_brokers as $insurance_broker)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $insurance_broker->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $insurance_broker->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $insurance_broker->commission }}%</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $insurance_broker->createdBy()->name }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $insurance_broker->created_at }}</p>
                                                </div>
                                            </td>
                                            <td style="display: none;" class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $insurance_broker->date_of_remittance ? (is_array($insurance_broker->date_of_remittance) ? $insurance_broker->date_of_remittance[count($insurance_broker->date_of_remittance)-1] : json_decode($insurance_broker->date_of_remittance, true)[count(json_decode($insurance_broker->date_of_remittance, true))-1]) : '0' }}</p>
                                                </div>
                                            </td>
                                            <td style="display: none;" class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $insurance_broker->method_of_remittance ? (is_array($insurance_broker->method_of_remittance) ? $insurance_broker->method_of_remittance[count($insurance_broker->method_of_remittance)-1] : json_decode($insurance_broker->method_of_remittance, true)[count(json_decode($insurance_broker->method_of_remittance, true))-1]) : '0' }}</p>
                                                </div>
                                            </td>
                                            <td style="display: none;" class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $insurance_broker->amount_remitted ? (is_array($insurance_broker->amount_remitted) ? $insurance_broker->amount_remitted[count($insurance_broker->amount_remitted)-1] : json_decode($insurance_broker->amount_remitted, true)[count(json_decode($insurance_broker->amount_remitted, true))-1]) : '0' }}</p>
                                                </div>
                                            </td>
                                            <td style="display: none;" class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $insurance_broker->total_remittance }}</p>
                                                </div>
                                            </td>
                                            <td style="display: none;" class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $insurance_broker->account_balance ? (is_array($insurance_broker->account_balance) ? $insurance_broker->account_balance[count($insurance_broker->account_balance)-1] : json_decode($insurance_broker->account_balance, true)[count(json_decode($insurance_broker->account_balance, true))-1]) : '0' }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{ route("insurance_broker_edit", ['id' => $insurance_broker->id]) }}"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>

                                                <a rel="tooltip" class="btn btn-primary btn-link"
                                                    href="{{ route("api_insurance_broker_view", ['id' => $insurance_broker->id]) }}"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">view_module</i>
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
