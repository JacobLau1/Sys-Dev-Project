<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set("auto_detect_line_endings", true);

error_reporting(E_ALL);

/*
spl_autoload_register(function ($class) {
    if ($class === 'WineMenu') {
        require_once 'Views/WineMenu.php';
    } else if ($class === 'WineDisplay') {
        require_once 'Views/WineDisplay.php';
    } else {
        require($class . ".php");
    }
});
*/

spl_autoload_register(function ($class) {
    require_once __DIR__ . '/vendor/autoload.php';
    require_once 'logger.php';
    if ($class === 'WineMenu') {
        require_once 'Views' . DIRECTORY_SEPARATOR . 'WineMenu.php';
    } else if ($class === 'BeerMenu') {
        require_once 'Views' . DIRECTORY_SEPARATOR . 'BeerMenu.php';
    }else if ($class === 'SpiritMenu') {
        require_once 'Views' . DIRECTORY_SEPARATOR . 'SpiritMenu.php';
    }else if ($class === 'DrinkMenu') {
        require_once 'Views' . DIRECTORY_SEPARATOR . 'DrinkMenu.php';
    } else {
        $class_file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        require_once $class_file;
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