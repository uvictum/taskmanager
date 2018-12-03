<?php
/**
 * Created by PhpStorm.
 * User: Виктор
 * Date: 29.11.2018
 * Time: 11:55
 */
class Home
{
    public $TaskModel;
    public $tasks;
    public $page;
    public $lastPage;
    public $order;
    private $orderType = ['ID', 'Username', 'Email', 'Status'];

    public function __construct()
    {
        require_once(ROOT . '/models/Task.php');
        $this->TaskModel = new Task();
        $this->page = 1;
        if (isset($_GET['page'])) {
            $this->page = $_GET['page'];
        }
        if (isset($_SESSION['order_type'])){
            $this->order = $_SESSION['order_type'];
        } else {
            $this->order = 0;
        }
    }

    public function actionDisplay()
    {
        if (isset($_POST['task1'])) {
            for ($i = 1; $i < 4; $i++) {
                $res = json_decode($_POST['task'.$i]);
                $this->TaskModel->updateTask($res);
            }
        } else {
            $this->tasks = $this->TaskModel->getTasks($this->orderType[$this->order]);
            $this->checkPage();
            require_once(ROOT.'/views/homepage.php');
        }
    }

    public function actionSort()
    {
        if (isset($_GET['order_type'])) {
            $_SESSION['order_type'] = $_GET['order_type'];
            $this->tasks = $this->TaskModel->getTasks($this->orderType[$_GET['order_type']]);
            $this->checkPage();
            require_once (ROOT.'/views/tpls/all_tasks.tpl.php');
        }
    }

    private function checkPage()
    {
        $taskNum = count($this->tasks);
        $this->lastPage = ($taskNum % 3 == 0 ? intdiv($taskNum, 3) : intdiv($taskNum, 3) + 1);
        if ($this->page < 1 OR $this->page > $this->lastPage) {
            $this->page = 1;
        }
    }
}