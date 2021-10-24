<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Forms</title>
</head>
<body>
    <div class="container">
        <div class="registration">
            <form class="form1">
                <p class="registration">Registration</p>
                <input type="text" id="login_r" name="login_r" placeholder="Login"><br>
                <p class="login_r"></p>
                <input type="password" id="password_r" name="password_r" placeholder="Password"><br>
                <p class="password_r"></p>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm_password"><br>
                <p class="confirm_password"></p>
                <input type="email" id="email" name="email" placeholder="Email"><br>
                <p class="email"></p>
                <input type="text" id="name" name="name" placeholder="Name"><br>
                <p class="name"></p>
                <button type="button" id="button_r" name="button_r">Registration</button><br>
            </form>
        </div>
        <div class="authorization">
            <form class="form2">
                <p class="authorization">Authorization</p>
                <input type="text" id="login_a" name="login_a" placeholder="Login"><br>
                <input type="password" id="password_a" name="password_a" placeholder="Password"><br>
                <button type="button" id="button_a" name="button_a">Authorization</button><br>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="script_auth.js"></script>
    <script src="script.js"></script>
</body>
</html>
<?php
?>
