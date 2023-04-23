<?php namespace controllers;

require(dirname(__DIR__)."/models/waiter.php");

class WaiterController{

    function __construct(){
        if(isset($_GET)){
            if(isset($_GET['action'])){
                $action = $_GET['action'];

                $viewClass = "\\views\\"."Waiter".ucfirst($action);

                $waiter = new \models\Waiter();

                $waiters = $waiter->getAll();
               
                if(class_exists($viewClass)){
                    $view = new $viewClass($waiters);

                    $view->render();
                }
            }
        }
    }
}
?>