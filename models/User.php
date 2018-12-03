<?php
/**
 * Created by PhpStorm.
 * User: Виктор
 * Date: 27.06.2018
 * Time: 16:32
 */

class User
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = ConnectDatabase::ConnectDB();
    }

    public function getUserData($login)
    {
        $sql = "SELECT * FROM Users WHERE Login = :login";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':login' => $login));
        $userdata = $statement->fetch(PDO::FETCH_ASSOC);
        return $userdata;
    }

    public function checkUser()
    {
        $sql = "SELECT * FROM Users WHERE Login = :login AND Pass = :pass";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':login' => $_POST['username'], ':pass' => hash('whirlpool', $_POST['pass'])));
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            if ($user['ID'] == $_SESSION['logged_user']) {
                return 2;
            } else {
                return 1;
            }
        } else {
            return 0;
        }
    }
}