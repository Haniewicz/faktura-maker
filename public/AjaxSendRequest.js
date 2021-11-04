$(document).ready(function() {
    $("form").on('submit', function(e){
        if($(this).attr("data-ajax") == "true")
        e.preventDefault();

        form = $(this).serializeArray();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: form,
            dataType: 'json',
            success: function(data)
            {
                alert(data.success)
            },
            error: function(err)
            {
                if(err.status == 422)
                {
                    printErrorMsg(err.responseJSON.errors);
                }
            }
        });
    });

    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

});
