$(document).ready(function () {
    $('.delete-button').click(function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
            },
            success: function (result) {
                $('#success_error_message').html('<div class="text-success" style="font-size: larger">' + result.message + '</div>');
                window.location.reload();
            },
            error: function (xhr, status, err) {
                console.log(xhr);
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