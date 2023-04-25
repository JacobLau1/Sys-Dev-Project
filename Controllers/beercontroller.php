<?php namespace controllers;

require(dirname(__DIR__)."/models/beer.php");

class BeerController{
    function __construct(){
        if(isset($_GET)){
            if(isset($_GET['action'])){
                $action = $_GET['action'];
                $viewClass = "\\views\\"."Beer".ucfirst($action);
                $beer = new \models\Wine();
                $beers = $beer->getAll();
               
                if(class_exists($viewClass)){
                    $view = new $viewClass($beers);
                    $view->render();
                }
            }
        }
    }
}
?>