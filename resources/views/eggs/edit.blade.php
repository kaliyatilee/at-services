<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="eggs_add"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Eggs"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
						<form id="edit_eggs_form" method='POST' action='{{ route('api_update_eggs') }}'>
                            @csrf
                            <div class="row">
							<div class="mb-3 col-md-6">
							<input type="hidden" name="id" value="{{$egg->id}}" />
                                    <label class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control border border-2 p-2"
                                           value='{{ $egg->name }}'>
									<input type="hidden" name="egg_id" value="{{ $egg->id }}">
                                    <div id="suggestionsPopup" class="form-control border border-2 p-2" style="z-index: 1"></div>
                                    <input type="hidden" name="user_id" id="user_id" value="{{ old('user_id') }}" />
                                </div>
								<div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control border border-2 p-2"
                                           value='{{ $egg->phone }}'>
                                </div>

								<div class="mb-3 col-md-6">
									<label class="form-label">Currency</label>
									<select class="form-control border border-2 p-2" name="currency_id">
										@foreach($currencies as $currency)
										<option value="{{ $currency->id }}" {{ $currency->id == $egg->currency_id ? 'selected' : '' }}>
												{{ $currency->name }}</option>
										@endforeach
									</select>
								</div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Cash Paid</label>
                                    <input type="text" name="cash_paid" class="form-control border border-2 p-2"
                                           value='{{ $egg->cash_paid }}'>
                                </div>
								<div class="mb-3 col-md-6">
                                    <label class="form-label">Breakages</label>
                                    <input type="number" name="breakages" class="form-control border border-2 p-2"
                                           value='{{ $egg->breakages }}'>
                                </div>
								<div class="mb-3 col-md-6">
                                    <label class="form-label">Quantity Sold</label>
                                    <input type="number" name="quantity_sold" class="form-control border border-2 p-2"
                                           value='{{ $egg->quantity_sold }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Quantity Received</label>
                                    <input type="number" name="quantity_received" class="form-control border border-2 p-2"
                                           value='{{ $egg->quantity_received }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Order Price</label>
                                    <input type="text" name="order_price" class="form-control border border-2 p-2"
                                           value='{{ $egg->order_price }}'>
                                </div>
								<div class="mb-3 col-md-6">
									<label class="form-label">Transaction Date</label>
									<input type="date" name="transaction_date" class="form-control border border-2 p-2"
									value='{{ isset($egg->transaction_date) ? \Carbon\Carbon::parse($egg->transaction_date)->format("Y-m-d") : "" }}'>
								</div>



                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Notes</label>
                                    <input type="text" name="notes" class="form-control border border-2 p-2"
                                           value='{{ $egg->notes }}'>
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
        $('#edit_eggs_form').submit(function (e) {
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
