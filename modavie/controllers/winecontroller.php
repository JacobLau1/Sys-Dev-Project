<?php namespace controllers;

require(dirname(__DIR__)."/models/wine.php");

class WineController{

    function __construct(){
        if(isset($_GET)){
            if(isset($_GET['action'])){
                $action = $_GET['action'];

                $viewClass = "\\views\\"."Wine".ucfirst($action);

                $wine = new \models\Wine();

                $wines = $wine->getAll();
               
                if(class_exists($viewClass)){
                    $view = new $viewClass($wines);

                    $view->render();
                }
            }
        }
    }
}
?>