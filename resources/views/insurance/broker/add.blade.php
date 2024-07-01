<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="add_insurance_broker"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add Insurance Broker"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <form id="add_insurance_broker_form" method='POST' action='{{ route('api_create_insurance_broker') }}'>
                        @csrf
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control border border-2 p-2"
                                           value='{{$insurance_broker->name }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Commission</label>
                                    <input type="text" name="commission" class="form-control border border-2 p-2"
                                           value='{{$insurance_broker->commission }}'>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Notes</label>
                                    <input type="text" name="notes" class="form-control border border-2 p-2"
                                           value='{{$insurance_broker->notes }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Date of Remittance</label>
                                    <input type="date" name="date_of_remittance" class="form-control border border-2 p-2"
                                           value='{{$insurance_broker->date_of_remittance }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Method of Remittance</label>
                                    <input type="text" name="method_of_remittance" class="form-control border border-2 p-2"
                                           value='{{$insurance_broker->method_of_remittance }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Amount Remitted</label>
                                    <input type="text" name="amount_remitted" required="true" id="amount_remitted" class="form-control border border-2 p-2"
                                           value='{{$insurance_broker->amount_remitted }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Account Balance</label>
                                    <input type="text" name="account_balance" id="account_balance" class="form-control border border-2 p-2"
                                           value='{{$insurance_broker->account_balance }}'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Total Remittance</label>
                                    <input type="text" name="total_remittance" id="total_remittance" class="form-control border border-2 p-2"
                                           value='{{$insurance_broker->total_remittance }}'>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        function calculateAccountBalance() {
                    var totalRemittance = parseFloat(document.getElementById('total_remittance').value) || 0;
                    var amountRemitted = parseFloat(document.getElementById('amount_remitted').value) || 0;

                    var accountBalance = totalRemittance - amountRemitted;
                    document.getElementById('account_balance').value = accountBalance.toFixed(2);
        }
        $('#amount_remitted').on('input', calculateAccountBalance);
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
  
    document.getElementById('total_remittance').value = 0;
    document.getElementById('amount_remitted').value = 0;
    document.getElementById('account_balance').value = 0;
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $('#add_insurance_broker_form').submit(function (e) {
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
