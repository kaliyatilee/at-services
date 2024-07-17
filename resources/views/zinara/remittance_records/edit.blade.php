<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="remittance_records"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Remittance Record"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <form id="edit_remittance_form" method="POST" action="{{ route('remittance_records.update', $remittance->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Form fields for Remittance Records -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" class="form-control border border-2 p-2" value="{{ isset($remittance->date) ? \Carbon\Carbon::parse($remittance->date)->format('Y-m-d') : '' }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border border-2 p-2" value="{{ $remittance->name }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control border border-2 p-2" value="{{ $remittance->phone }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount ZIG</label>
                                    <input type="text" name="amount_zig" class="form-control border border-2 p-2" value="{{ $remittance->amount_zig }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount USD</label>
                                    <input type="text" name="amount_usd" class="form-control border border-2 p-2" value="{{ $remittance->amount_usd }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Reference Number</label>
                                    <input type="text" name="reference_number" class="form-control border border-2 p-2" value="{{ $remittance->reference_number }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Transaction Type</label>
                                    <input type="text" name="transaction_type" class="form-control border border-2 p-2" value="{{ $remittance->transaction_type }}">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Created By</label>
                                    <input type="text" name="created_by" class="form-control border border-2 p-2" value="{{ $remittance->created_by }}">
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Update</button>
                            <div class="mt-3" id="success_error_message"></div>
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
        $('#edit_remittance_form').submit(function (e) {
            $('#success_error_message').html('');

            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    $('#success_error_message').append('<div class="text-success" style="font-size: larger">' + result.message + '</div>');
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + value + '</div>');
                        });
                    } else if (xhr.status === 500) {
                        $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.responseJSON.message + '</div>');
                    } else {
                        $('#success_error_message').append('<div class="text-danger" style="font-size: larger">' + xhr.statusText + '</div>');
                    }
                }
            });
        });
    });
</script>
