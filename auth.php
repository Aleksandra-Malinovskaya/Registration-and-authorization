<?php

namespace nameee;

if (isset($_SERVER['X-REQUESTED-WITH']) AND $_SERVER['X-REQUESTED-WITH'] !== 'XMLHttpRequest') {
    die('XHR only.');
}


class User_auth{

    public static $name_user;
    public $login_a, $password_a;

    function __construct($login_a, $password_a)
    {
        $this->login_a = $login_a;
        $this->password_a = $password_a;
    }
    function auth(){
        if (file_exists('name.json')) {
            $json = file_get_contents('name.json');
            $jsonArray = json_decode($json, true);
            foreach ($jsonArray as $key_first => $key_second) {
                foreach ($key_second as $key => $value) {
                    if ($key == "login_r" && $value == $this->login_a){
                        $key_third = $jsonArray[$key_first];
                        $pass =$this->encryption_pas("qazxsw12");
                        if($key_third["password_r"] == $pass){
                            $name_cook = $key_third["name_r"];
                            setcookie("name", $name_cook, time() + 3600);
                        header('Location: http://localhost/Project%20php/enter.php');
                        exit();
                        }
                        else {
                            echo 'password is not correct';
                            exit();
                        }

                    }
                }
            }
            echo 'login is not correct';
        }
    }

    function encryption_pas($salt){
        $this->password_a = md5($this->password_a.$salt);
        return $this->password_a;
    }
}
$user_auth = new User_auth($_POST['login_a'], $_POST['password_a']);
$user_auth->auth();



?>