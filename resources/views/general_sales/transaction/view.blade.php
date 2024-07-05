<div>
    <x-layout bodyClass="g-sidenav-show  bg-gray-200">

        <x-navbars.sidebar activePage="rtgs_add"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Add  ZIG Transaction"></x-navbars.navs.auth>
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
                                    <label class="form-label">Transaction Type</label>
                                    <select class="form-control border border-2 p-2">
                                        <option value="{{ $transaction->transaction_type }}">{{ $transaction->type->name }}</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Currency</label>
                                    <select class="form-control border border-2 p-2">
                                        <option value="{{ $transaction->currency }}">{{ $transaction->curr->name }}</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Client Name</label>
                                    <input type="text" class="form-control border border-2 p-2" value='{{ $transaction->name }}' placeholder="{{ $transaction->name }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control border border-2 p-2" value='{{ $transaction->phone }}' placeholder="{{ $transaction->phone }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount</label>
                                    <input type="number" class="form-control border border-2 p-2" value='{{ number_format($transaction->amount, 2) }}' placeholder="{{ number_format($transaction->amount, 2) }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Transaction Date ({{ (new DateTime($transaction->transaction_date))->format('d M Y') }})</label>
                                    <input type="text" class="form-control border border-2 p-2" value='{{ $transaction->transaction_date }}' placeholder="{{ $transaction->transaction_date }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Notes</label>
                                    <input type="text" class="form-control border border-2 p-2" value='{{ $transaction->notes }}' placeholder="{{ $transaction->notes }}">
                                </div>
                            </div>
                            @if($del == 1)
                                <a href="{{ route('delete-general-sale', ['saleId' => $transaction->id]) }}" type="submit" class="btn bg-danger" style="color: white">Confirm Delete</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <x-plugins></x-plugins>

    </x-layout>

</div>
