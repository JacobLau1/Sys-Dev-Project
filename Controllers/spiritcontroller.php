<?php namespace controllers;

require(dirname(__DIR__)."/models/spirit.php");

class SpiritController{
    function __construct(){
        if(isset($_GET)){
            if(isset($_GET['action'])){
                $action = $_GET['action'];
                $viewClass = "\\views\\"."Spirit".ucfirst($action);
                $spirit = new \models\Wine();
                $spirits = $spirit->getAll();
               
                if(class_exists($viewClass)){
                    $view = new $viewClass($spirits);
                    $view->render();
                }
            }
        }
    }
}
?>