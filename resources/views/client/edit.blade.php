<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="clients"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Client"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
					<form id="edit_client_form" method='POST' action='{{ route('api_update_client', ['id' => $client->id]) }}'>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">ID Number</label>
                                    <input type="text" name="id_number" class="form-control border border-2 p-2"
                                           value='{{ $client->id_number }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border border-2 p-2"
                                           value='{{ $client->name }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone 1</label>
                                    <input
                                        class="form-control border border-2 p-2"
                                        type="tel"
                                        pattern="2637[0-9]{8}"
                                        title="Must start with 2637 and follow format: 2637*********"
                                        placeholder="Format: 2637*********"
                                        name="phone1"
                                        value="{{ $client->phone1 }}"
                                        oninput="this.setCustomValidity('')"
                                        oninvalid="this.setCustomValidity('Invalid phone number. Must start with 2637 and follow format: 2637*********')"
                                    />
                                    <div id="phone_success_error_message" class="text-danger text-xs"></div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone 2</label>
                                    <input
                                        class="form-control border border-2 p-2"
                                        type="tel"
                                        pattern="2637[0-9]{8}"
                                        title="Must start with 2637 and follow format: 2637*********"
                                        placeholder="Format: 2637*********"
                                        name="phone2"
                                        value="{{ $client->phone2 }}"
                                        oninput="this.setCustomValidity('')"
                                        oninvalid="this.setCustomValidity('Invalid phone number. Must start with 2637 and follow format: 2637*********')"
                                    />
                                    <div id="phone_success_error_message" class="text-danger text-xs"></div>

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
        $('#edit_client_form').submit(function (e) {
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

                    }  else if (xhr.status === 500) {
                        $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.responseJSON.message + '</div');
                    } else {
                        $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.statusText + '</div');
                    }
                }
            });
        });
    });
</script>
