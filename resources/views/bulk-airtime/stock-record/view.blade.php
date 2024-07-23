<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="airtime-stock-record"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="View Sale"></x-navbars.navs.auth>
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
                                    <label class="form-label">Transaction Date</label>
                                    <input readonly type="date" name="transaction_date" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Transaction date is required"
                                            value='{{ $stockRecord->transaction_date }}'>
                                            @if ($errors->has('transaction_date'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('transaction_date') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Description</label>
                                    <input readonly type="text" name="description" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Description is required"
                                            value='{{ $stockRecord->description }}'>
                                            @if ($errors->has('description'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('description') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">In</label>
                                    <input readonly type="text" name="in" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Description is required"
                                            value='{{ $stockRecord->in }}'>
                                            @if ($errors->has('in'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('in') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Out</label>
                                    <input readonly type="text" name="out" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Description is required"
                                            value='{{ $stockRecord->out }}'>
                                            @if ($errors->has('out'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('out') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Shortages</label>
                                    <input readonly type="text" name="shortages" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Description is required"
                                            value='{{ $stockRecord->shortages }}'>
                                            @if ($errors->has('shortages'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('shortages') }}</small>
                                    @endif
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Balance</label>
                                    <input readonly type="text" name="balance" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Description is required"
                                            value='{{ $stockRecord->balance }}'>
                                            @if ($errors->has('balance'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('balance') }}</small>
                                    @endif
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
