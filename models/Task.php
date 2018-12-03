<?php

class Task
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = ConnectDatabase::ConnectDB();
    }

    public function getTasks($order)
    {
        $sql = "SELECT * FROM Tasks ORDER BY ".$order." DESC";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    public function updateTask($taskData)
    {
        if ($_SESSION['logged_user'] == 1) {
            $sql = "UPDATE Tasks SET Text= :Text , Status= :Status WHERE ID= :ID ";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':Text', $taskData->Text);
            $statement->bindValue(':Status', $taskData->Status, PDO::PARAM_BOOL);
            $statement->bindValue(':ID', $taskData->ID);
            $statement->execute();
        }
    }

    public function saveTask($fileDest)
    {
        if ($this->checkInputEmailName() == false) {
            return false;
        }
        $sql = "INSERT INTO Tasks (Username, Email, Text, ImageLink, Status, CreateDate)";
        $sql .= "VALUES (:Username, :Email, :Text, :ImageLink, b'0', :CreateDate)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(Array(':Username' => $_POST['Username'], ':Email' => $_POST['Email'],
            ':Text' => $_POST['Text'], ':ImageLink' => $fileDest, ':CreateDate' => date("Y-m-d H:i:s")));
    }

    private function checkInputText()
    {
        if (isset($_POST['Text']) && !empty($_POST['Text']) && strlen($_POST['Text']) <= 2000) {
            return true;
        }
                return false;
    }

    private function checkInputEmailName()
    {
        if (isset($_POST['Username']) && !empty($_POST['Username']) && strlen($_POST['Username']) <= 50) {
            if (isset($_POST['Email']) && !empty($_POST['Email']) && strlen($_POST['Email']) <= 100) {
                return true;
            }
        }
        return false;
    }
}