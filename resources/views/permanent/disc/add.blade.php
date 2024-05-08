<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="company_registration_add"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add Permanant Disc"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <form id="add_permanent_disc_form" method='POST' action='{{ route('api_create_permanent_disc') }}'>
                            @csrf
                            <div class="row">
                            <div class="mb-3 col-md-6">
                                    <label class="form-label">Search Client</label>
                                    <input type="text" id="name" name="name" class="form-control border border-2 p-2"
                                           value='{{ old('name') }}'>
                                    <div id="suggestionsPopup" class="form-control border border-2 p-2" style="z-index: 1"></div>
                                    <input type="hidden" name="user_id" id="user_id" value="{{ old('user_id') }}" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control border border-2 p-2"
                                           value='{{ old('phone') }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Currency</label>
                                    <select class="form-control border border-2 p-2" name="currency_id">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Cash Paid</label>
                                    <input type="text" name="cash_paid" class="form-control border border-2 p-2"
                                           value='{{ old('cash_paid') }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Quantity Sold</label>
                                    <input type="text" name="quantity_sold" class="form-control border border-2 p-2"
                                           value='{{ old('quantity_sold') }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Quantity Received</label>
                                    <input type="text" name="quantity_received" class="form-control border border-2 p-2"
                                           value='{{ old('quantity_received') }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Order Price</label>
                                    <input type="text" name="order_price" class="form-control border border-2 p-2"
                                           value='{{ old('order_price') }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Notes</label>
                                    <input type="text" name="notes" class="form-control border border-2 p-2"
                                           value='{{ old('notes') }}'>
                                </div>

                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                            <div class='' id="success_error_message"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>

<script type="text/javascript">
    $(document).ready(function () {

        $('#add_permanent_disc_form').submit(function (e) {
            $('#success_error_message').html('');

            e.preventDefault();
            var formData = new FormData(this)
            console.log(formData)
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log(result);
                    $('#success_error_message').append('<div class="text-success" style="font-size: larger">' + result.message + '</div');
                },
                error: function (xhr, status, err) {
                    console.log(xhr);
                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + value + '</div');
                        });

                    } else if (xhr.status === 500) {
                        $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.responseJSON.message + '</div');
                    } else {
                        $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.statusText + '</div');
                    }
                }
            });
        });
    });
</script>
