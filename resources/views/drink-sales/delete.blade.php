<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage=""></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Delete Drink Sale"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <form method='POST' action='{{ route('confirm-delete-drink-sale') }}'>
                            @csrf
                            <input name="drink_id" value="{{ $drinkSale->drink_id }}" class="form-control border border-2 p-2" required readonly hidden>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Drink</label>
                                    <input value="{{ $drinkSale->item->name }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Name</label>
                                    <input value="{{ $drinkSale->name }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Phone</label>
                                    <input value="{{ $drinkSale->phone }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Quantity</label>
                                    <input value="{{ $drinkSale->quantity }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Currency</label>
                                    <input value="{{ $drinkSale->currency->name }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Amount Paid</label>
                                    <input value="{{ number_format($drinkSale->amount_paid, 2) }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Payment Type</label>
                                    <input value="{{ $drinkSale->type->name }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Date</label>
                                    <input value="{{ (new DateTime($drinkSale->date))->format('d M, Y') }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Description</label>
                                    <input value="{{ $drinkSale->description }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Notes</label>
                                    <input value="{{ $drinkSale->notes }}" class="form-control border border-2 p-2">
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Expense Name</label>
                                    <input value="{{ $drinkSale->expense_name }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Expense Amount</label>
                                    <input value="{{ number_format($drinkSale->expense_amount, 2) }}" class="form-control border border-2 p-2">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Commission</label>
                                    <input value="{{ number_format($drinkSale->commission_amount, 2) }}" class="form-control border border-2 p-2">
                                </div>
                            </div>
                            @if(Session::has('error'))
                                <div class='' id="success_error_message" style="color: red; margin-bottom: 10px">{{ Session::get('error') }}</div>
                            @endif
                            <button type="submit" class="btn bg-danger" style="color: white">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
