$(document).ready(function() {
    document.querySelector('.form2').style.display = 'block';

    $('.form2 button').on("click", function () {
        let login_a = $("#login_a").val().trim(),
            password_a = $("#password_a").val().trim();
        $.ajax({
            url: 'enter.php',
            type: 'POST',
            cache: false,
            data: {
                'login_a': login_a,
                'password_a': password_a
            },
            dataType: 'html',
            beforeSend: function () {
                $('#button_a').prop("disabled", true);
            },
            success: function (data) {
                $('#button_a').prop("disabled", false);
                $('.form2').trigger("reset");
                data;
            }
        });

    });
});