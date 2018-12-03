<?php

class Login
{
    private $user;

    public function __construct()
    {
        include_once(ROOT . '/models/User.php');
        $this->user = new User();
    }

    public function actionSignin()
    {
         if (isset($_POST['submit'])) {
                if ($this->authUser()) {
                    echo "Login successful";
                    header("Refresh: 2; url=../");
                }
         } else {
             include_once(ROOT . '/views/signin.php');
         }
    }

    public function actionLogout()
    {
        if ($_SESSION && isset($_SESSION['logged_user'])) {
            unset($_SESSION['logged_user']);
            unset($_SESSION['login']);
            session_destroy();
        }
        header("Refresh: 1; url=../");
    }

    public function authUser()
    {
        $res = $this->user->checkUser();
        if ($res == 1) {
            $userdata = $this->user->getUserData($_POST['username']);
            $_SESSION['logged_user'] = $userdata['ID'];
            $_SESSION['login'] = $userdata['Login'];
            return 1;
        } elseif ($res == 2) {
            echo "<br> User was already logged in </br>";
            header("Refresh: 2; url=../");
            return 0;
        } else {
            echo "<br> Wrong password or login </br>";
            return 0;
        }
    }

}