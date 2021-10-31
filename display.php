<?php

if (isset($_SERVER['X-REQUESTED-WITH']) AND $_SERVER['X-REQUESTED-WITH'] !== 'XMLHttpRequest') {
    die('XHR only.');
}

class User{
    public $login_r, $password_r, $confirm_password, $email, $name;
    function __construct($login_r, $password_r, $confirm_password, $email, $name)
    {
        $this->login_r = $login_r;
        $this->password_r = $password_r;
        $this->confirm_password = $confirm_password;
        $this->email = $email;
        $this->name = $name;
    }

    function password () {

        $letmatch = preg_match('/[a-z]/', $this->password_r);
        $letmatch_big = preg_match('/[A-Z]/', $this->password_r);
        $digmatch = preg_match('/[0-9]/', $this->password_r);

        if ($digmatch && ($letmatch || $letmatch_big)) {
            return true;
        }
        return false;
    }

    function unique(){
        if (file_exists('database/name.json')) {
            $json = file_get_contents('database/name.json');
            $jsonArray = json_decode($json, true);
            foreach ($jsonArray as $key_first => $key_second) {
                foreach ($key_second as $key => $value) {
                    if (($key == "login_r" && $value == $this->login_r) || ($key == "email" && $value == $this->email)) {
                        echo "login or email have already been used";
                        return true;
                    }
                }
            }
        }
    }
    function validation(){
        if(!$this->login_r || iconv_strlen($this->login_r)<6 || $this->unique()){
            exit();
        }elseif(!$this->password_r || iconv_strlen($this->password_r)<6 || !$this->password()){
            exit();
        }elseif(!$this->confirm_password || $this->password_r != $this->confirm_password) {
            exit();
        }elseif(!$this->email || !preg_match('/(mail)/', $this->email)){
            exit();
        }elseif(!$this->name || iconv_strlen($this->name)<2){
            exit();
        }else
            return true;
    }

    function encryption_pas($salt){
        $this->password_r = md5($this->password_r.$salt);
        return $this->password_r;
    }

    function encryption_confirm_pas($salt){
        $this->confirm_password = md5($this->confirm_password.$salt);
        return $this->confirm_password;
    }
}

$user = new User($_POST['login_r'], $_POST['password_r'], $_POST['confirm_password'], $_POST['email'], $_POST['name']);


        //read file
        if (file_exists('database/name.json')) {
            $json = file_get_contents('database/name.json');
            $jsonArray = json_decode($json, true);
        }


        //write file
        if ($user->validation()) {
            $user->password_r = $user->encryption_pas("qazxsw12");
            $user->confirm_password = $user->encryption_confirm_pas("qazxsw12");
            $jsonArray[] = array("login_r" => $user->login_r, 'password_r' => $user->password_r, 'confirm_password' => $user->confirm_password, 'email' => $user->email, 'name' => $user->name);
            file_put_contents('database/name.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
            echo "registration completed successfully";
            header("Location:" . $_SERVER['HTTP_REFERER']);
        }

?>