<?php
    spl_autoload_register(function ($class) {
        if ($class === 'WineMenu') {
            require_once 'view/WineMenu.php';
        } else if ($class === 'WineDisplay') {
            require_once 'view/WineDisplay.php';
        } else if ($class === 'BeerMenu') {
            require_once 'view/BeerMenu.php';
        }else if ($class === 'SpiritMenu') {
            require_once 'view/SpiritMenu.php';
        }else if ($class === 'WaiterRegistration') {
            require_once 'view/WaiterRegistration.php';
        }else if ($class === 'WaiterAdd') {
            require_once 'view/WaiterAdd.php';
        }else {
            require($class.".php");
        }
    });

    class App{
        function __construct(){
            if(isset($_GET)){
                if(isset($_GET['resource'])){
                    $resource = $_GET['resource'];

                    $controllerClass = "\\controllers\\".ucfirst($resource)."Controller";

                    if(class_exists($controllerClass)){
                        $controller = new $controllerClass();
                    }
                }
            }
        }
    }

    $app = new App();

    /* 
        Jacob notes 
        apr 19

        Added:
        - basic functionalities/screen flow for beer, wine, spirits, waiterregistration, 
        menuselection (crud links, back to menu selection, logout)
        - waiteradd form code
        - all the page implementations have been for basic waiter, no admin privalages yet
        (except waiterregistration)
        - renamed modavie
        - made modavie.sql (has user, employee and basic wine tables)
        - controller files for beer,wine,spirits (empty files)
        - made model files for beer,wine,spirits (empty files)
        - added winecontroller.php code
        - added wine.php code
        - started winedisplay (gets error of creating auth token twice when on wine page)

        Needs to be done:
        - logout function doesnt work, you can still access menu selection by copying url
        - need to make waiter registration page only accessible to admins
        - add crud and admins/waiters,wine,spirits,beer database tables
        - rename the employee/user naming schemes (+cookie/session)
            - resources: waiter/admin/beer/wine/spirit
            - actions: display/add/delete/edit/menu


        apr 23

        added: 
        - fixed the names of pages
        - implemented spirit,beer,waiter controllers 
        - added spirit,beer,waiter models 
        - fixed error of cannot declare tokenauth6238
        - updated url links to correct names
        - added display pages for beer, spirit, wine
        - removed employee controller, model, list, and table

        need:
        - correct attribute tables for wine,spirit,beer,waiter (possibly admins?)
        - display pages to actually display their respective table on the html page
        - waiterregistration only accessible to admins
        - make logout destroy your cookie so you can't copy url to log in
    */
?>