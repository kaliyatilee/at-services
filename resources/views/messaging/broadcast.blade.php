<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="users"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Send Broadcast"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <form class="" id="broadcast_msg" method='POST' action='{{ route('send_broadcast') }}'>
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label">Broadcast Message</label>
                                    <textarea class="form-control block w-full w-100 border border-2 p-2" id="broadcast" type="text" name="message" rows="5" placeholder="Write message here..." required maxlength="160"></textarea>
                                    <p class="" id="char-count">Chars remaining: <span id="char-count-span">160</span></p>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">SEND BROADCAST</button>
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
        $('#broadcast_msg').submit(function (e) {
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
<script>
  const textarea = document.getElementById('broadcast');
  const charCountSpan = document.getElementById('char-count-span');

  textarea.addEventListener('input', () => {
    const charCount = textarea.value.length;
    charCountSpan.textContent = `${160 - charCount} `;
    if (charCount > 0 && charCount > 145) {
      p.classList.add('text-danger');
    } else {
      p.classList.remove('text-danger');
    }
  });
</script>
