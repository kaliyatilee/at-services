<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="general-sales"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="General Sales"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="me-3 my-3" style="display: flex; justify-content: space-between">
                            <div style="margin-left: 20px">
                                @foreach($transactionTypes as $transactionType)
                                    @if(!array_key_exists($transactionType->sale_transaction_type_id, $totals))
                                        @continue
                                    @endif
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="mb-0 text-sm" style="font-weight: 600">
                                            Total {{ $transactionType->name }}: {{ number_format($totals[$transactionType->sale_transaction_type_id], 2) }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                            <a class="btn bg-gradient-dark mb-0" href="{{ route("create-general-sale") }}" style="height: fit-content"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New Transaction</a>
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
                                        @foreach($transactionTypes as $transactionType)
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                {{ $transactionType->name }}
                                            </th>
                                        @endforeach
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created By
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Transaction Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $transaction->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $transaction->name }} / {{ $transaction->phone }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $transaction->amount }}</p>
                                                </div>
                                            </td>
                                            @foreach($transactionTypes as $transactionType)
                                                @if($transactionType->sale_transaction_type_id == $transaction->transaction_type)
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">
                                                                {{ $transaction->amount }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                @else
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm"></p>
                                                        </div>
                                                    </td>
                                                @endif
                                            @endforeach
                                            <td class="align-middle text-center text-sm">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $transaction->createdBy()->name }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ (new DateTime($transaction->transaction_date))->format('d M Y') }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="{{ route('edit-general-sale', ['saleId' => $transaction->id]) }}" class="mb-0 text-sm">Edit</a>
                                                </div>
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
