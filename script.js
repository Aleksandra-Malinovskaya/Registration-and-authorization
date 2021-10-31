$(document).ready(function() {
    document.querySelector('.form1').style.display = 'block';
    document.querySelector('.form2').style.display = 'block';

    function error(atr, message) {
        $(`.${atr}`).append(`<p>${message} is incorrect</p>`);
        setTimeout(function(){
            location.reload();
        }, 3000);
        return false;
    }

    function password(inpval) {

        var letmatch = inpval.match(/[a-z]/g);
        var letmatch_big = inpval.match(/[A-Z]/g);
        var digmatch = inpval.match(/[0-9]/g);

        if (digmatch && (letmatch || letmatch_big)) {
            return true;
        }
        return false;
    }

    $('#button_r').on("click", async function () {
        let login_r = $("#login_r").val().trim(),
            password_r = $("#password_r").val().trim(),
            confirm_password = $("#confirm_password").val().trim(),
            email = $("#email").val().trim(),
            name = $("#name").val().trim();

        if (login_r.length < 6 || login_r == '') {
            error('login_r', 'login');
        }
        if (password_r.length < 6 || !password(password_r) || password_r == '') {
            error('password_r', 'password');
        }
        if (confirm_password == '' || password_r != confirm_password) {
            error('confirm_password', 'confirm password');
        }
        if (email == '' || email.includes('mail') != true) {
            error('email', 'email');
        }
        if (name.length < 2 || name == '') {
            error('name', 'name');
        }

        $.ajax({
            url: 'display.php',
            type: 'POST',
            cache: false,
            data: {
                'login_r': login_r,
                'password_r': password_r,
                'confirm_password': confirm_password,
                'email': email,
                'name': name
            },
            dataType: 'html',
            beforeSend: function () {
                $('#button_r').prop("disabled", true);
            },
            success: function (data) {
                alert(data);
                $('#button_r').prop("disabled", false);
                $('.form1').trigger("reset");
            }
        });
    });
    $('#button_a').on("click", function () {
        let login_a = $("#login_a").val().trim(),
            password_a = $("#password_a").val().trim();
        $.ajax({
            url: 'auth.php',
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
                document.write(data);
            }
        });

    });
});