<x-layout bodyClass="g-sidenav-show  bg-gray-200">
 
    <x-navbars.sidebar activePage="remittances"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dry Cleaning > Add Remittence"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center p-2">
                        <div class="fs-4 fw-normal">{{DB::table('dry_cleaning_services_providers')->find($id)->provider}}</div>
                        <div class="fw-bold fs-2"> {{$remittanceBalance}}  </div>
                      </div>
                    <div class="card my-4">
                        <div class="card-body px-4 pb-2">
                            
                                <form class="" id="form" method='POST' action='{{route('api_remittances_store',['id' => $id])}}'>
                                    @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Remittence Date</label>
                                        <input type="date" name="remittance_date" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Date is required"
                                            value='{{ old('remittance_date') }}'>
                                            @if ($errors->has('remittance_date'))
                                            <small class="mt-2 text-sm text-danger">{{ $errors->first('remittance_date') }}</small>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Method</label>
                                        <input type="text" name="remittance_method" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Method is required"
                                        value='{{ old('remittance_method') }}'>
                                        @if ($errors->has('remittance_method'))
                                        <small class="mt-2 text-sm text-danger">{{ $errors->first('remittance_method') }}</small>
                                    @endif
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Remitted Amount</label>
                                        <input type="number" step="0.1" name="amount_remitted" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Remittence amount is required"
                                            value='{{ old('amount_remitted') }}'>
                                            @if ($errors->has('amount_remitted'))
                                            <small class="mt-2 text-sm text-danger">{{ $errors->first('amount_remitted') }}</small>
                                        @endif
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn bg-gradient-dark">Submit</button>
                                <div class='' id="success_error_message"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="dt-nested-object">
                                    <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Remittence Date
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Remittence Method
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Amount Remitted
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Balance
                                        </th>
                                        
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($remittanceHistory as $history)
                                        <tr>
                                            
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $history->remittance_date }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $history->remittance_method }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $history->amount_remitted }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $history->account_balance }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('api_remittances_delete', $history->id) }}" method="post" style="display:inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-link">
                                                        <i class="material-icons">close</i>
                                                        <div class="ripple-container"></div>
                                                    </button>
                                                </form>
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
<script type="text/javascript">
    $(document).ready(function () {

        $('#form').submit(function (e) {
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