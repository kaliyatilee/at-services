<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="agents"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add Agent Transaction"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <form id="add_agent_transaction_form" method="POST" action="{{ route('api_create_agent_transaction') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Agent</label>
                                    <select name="agent_id" id="agent_id" class="form-control border border-2 p-2" required>
                                        <!-- Options will be dynamically populated -->
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                <label class="form-label">Agent Name</label>
                                <input type="text" name="name" class="form-control border border-2 p-2" value="{{ old('name') }}" required>
                            </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Paid</label>
                                    <input type="number" name="amount_paid" class="form-control border border-2 p-2" value="{{ old('amount_paid') }}" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Remitted</label>
                                    <input type="number" name="amount_remmited" class="form-control border border-2 p-2" value="{{ old('amount_remmited') }}" required>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                            <div id="success_error_message"></div>
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
        // Fetch agents and populate the dropdown
        $.ajax({
            url: "{{ route('api_get_agents') }}",
            type: 'GET',
            success: function (data) {
                var agentDropdown = $('#agent_id');
                agentDropdown.empty();
                $.each(data, function (key, agent) {
                    agentDropdown.append('<option value="' + agent.id + '">' + agent.name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Failed to fetch agents:', error);
            }
        });

        $('#add_agent_transaction_form').submit(function (e) {
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
