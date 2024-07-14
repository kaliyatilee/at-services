<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="providers"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dry Cleaning > Providers"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-4 pb-2">

                           
                                <form class="" id="form" method='POST' action='{{ route('api_service_provider_store') }}'>
                            @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Provider Name</label>
                                        <input type="text" name="provider" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Provider Name is required"
                                            value='{{ old('provider') }}'>
                                            @if ($errors->has('provider'))
                                            <small class="mt-2 text-sm text-danger">{{ $errors->first('provider') }}</small>
                                        @endif
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="description" class="form-control border border-2 p-2"
                                            value='{{ old('description') }}'>
                                            @if ($errors->has('description'))
                                            <small class="mt-2 text-sm text-danger">{{ $errors->first('description') }}</small>
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Phone</label>
                                        <input
                                        class="form-control border border-2 p-2"
                                        data-parsley-trigger="focusout" required data-parsley-required-message="Phone is required"
                                        type="tel"
                                        pattern="2637[0-9]{8}"
                                        title="Must start with 2637 and follow format: 2637*********"
                                        placeholder="Format: 2637*********"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        oninput="this.setCustomValidity('')"
                                        oninvalid="this.setCustomValidity('Invalid phone number. Must start with 2637 and follow format: 2637*********')"
                                    />
                                    <div id="phone_success_error_message" class="text-danger text-xs"></div>
                                    @if ($errors->has('phone'))
                                            <small class="mt-2 text-sm text-danger">{{ $errors->first('phone') }}</small>
                                        @endif
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control border border-2 p-2" data-parsley-trigger="focusout" required data-parsley-required-message="Address is required"
                                            value='{{ old('address') }}'>
                                            @if ($errors->has('address'))
                                            <small class="mt-2 text-sm text-danger">{{ $errors->first('address') }}</small>
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
                                            Provider Name
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Description
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Phone
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Address
                                        </th>

                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($serviceProviders as $provider)
                                        <tr>

                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $provider->provider }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $provider->description }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $provider->phone }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $provider->address }}</p>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
												href="{{ route("api_service_provider_edit", $provider->id) }}" data-original-title=""
                                                   title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>

                                                <form action="{{ route('api_service_provider_delete', $provider->id) }}" method="post" style="display:inline">
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