<?php

spl_autoload_register(function ($class) {
    if ($class === 'WineMenu') {
        require_once 'Views/WineMenu.php';
    } else if ($class === 'WineDisplay') {
        require_once 'Views/WineDisplay.php';
    } else {
        require($class . ".php");
    }
});


class App
{
    function __construct()
    {
        //Read the resource to determine the controller that needs to be loaded
        if (isset($_GET)) {
            if (isset($_GET['resource'])) {
                $resource = $_GET['resource'];
                //We are adding a namespace to the class name to differentiate between controller and view classes
                $controllerClass = "\\Controllers\\" . ucfirst($resource) . "Controller";
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();
                }
            }
        }
    }
}

$app = new App();
?>