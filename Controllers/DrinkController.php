<?php

namespace controllers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require(dirname(__DIR__). DIRECTORY_SEPARATOR ."Models" . DIRECTORY_SEPARATOR ."Drink.php");


class DrinkController{

    private $user;
    private $drink;
    private $log;

    function __construct(){
        $this->log = new Logger('user_login');
        $this->log->pushHandler(new StreamHandler('drinks.log', Logger::INFO));
        if(!isset($_GET['action'])) {
            return;
        }


        $action = $_GET['action'];

        $viewClass = "\\Views\\" . "Drink" . ucfirst($action);

        if(!class_exists($viewClass)) {
            return;
        }

        //  $this->user = new \models\User();
        $this->drink = new \models\Drink();

        if(isset($_POST)) {
            switch($action) {
                case 'menu':
                    $this->handleMenu();
                    break;
                case 'add':
                    $this->handleAdd();
                    break;
                case 'edit':
                    $this->handleEdit();
                    break;
                case 'delete':
                    $this->handleDelete();
                    break;
                case 'location':
                    $this->handleLocation();
                    break;
                case 'edit':
                    $this->handleLocationEdit();
                    break;
            }
        }


    }

    function handleMenu()
    {
        // Instantiate the Drink model
        $this->drink = new \Models\Drink();

        // Retrieve the drink_id from the POST data if it exists
        $drink_id = isset($_POST['drink_id']) ? $_POST['drink_id'] : null;

        // Retrieve the drink_type from the GET data if it exists
        $type = isset($_GET['type']) ? $_GET['type'] : null;

        // Initialize the $drinks variable
        $drinks = null;

        // If a drink_id is provided, get that specific drink
        if (isset($drink_id)) {
            $drinks = $this->drink->getDrinkByDrinkID($drink_id);
        } elseif (isset($type)) { // If a type is provided, get drinks of that type
            if ($type === 'wine') {
                $drinks = $this->drink->getWines();
            } elseif ($type === 'beer') {
                $drinks = $this->drink->getBeers();
            } elseif ($type === 'spirit') {
                $drinks = $this->drink->getSpirits();
            }
        } else { // If no parameters are provided, get all drinks
            $drinks = $this->drink->getAll();
        }

        // Define the view class based on the model
        $viewClass = "\\Views\\" . "DrinkMenu";
        if (class_exists($viewClass)) {
            // Instantiate the view and render it
            $view = new $viewClass($this->drink);
            $view->render($drinks);
        }
    }




    function handleEdit() {
        //check if the form has been submitted
        if (isset($_POST['Save'])) {

            // get the drink properties from the form
            $name = $_POST['name'];
            $subtype = $_POST['subtype'];
            $format = $_POST['format'];
            $price = $_POST['price'];
            $alcohol_type = $_POST['alcohol_type'];
            $saq_code = $_POST['saq_code'];
            $inventory_id = $_POST['inventory_id'];
            $current_location = $_POST['current_location'];
            $last_moved_by = $_POST['last_moved_by'];
            $last_moved_at = $_POST['last_moved_at'];
            $image = $_POST['image'];

            // Update the drink object properties
            $this->drink->setName($name);
            $this->drink->setSubtype($subtype);
            $this->drink->setFormat($format);
            $this->drink->setPrice($price);
            $this->drink->setAlcoholType($alcohol_type);
            $this->drink->setSaqCode($saq_code);
            $this->drink->setInventoryId($inventory_id);
            $this->drink->setCurrentLocation($current_location);
            $this->drink->setLastMovedBy($last_moved_by);
            $this->drink->setLastMovedAt($last_moved_at);
            $this->drink->setImage($image);

            //update the drink in the database
            $success = $this->drink->update();

            //if the update was successful, redirect to the drink menu
            if ($success) {
                header("Location: index.php?resource=drink&action=menu");
                exit;
            } else {
                //if the update failed, display an error message
                echo "Update failed";
            }
        } else {
            //if the form has not been submitted, render the edit view
            $drink_id = $_GET['id'];
            $drinkModel = new \Models\Drink();
            $drink = $drinkModel->getDrinkByDrinkID($drink_id);

            $this->drink->setName($drink['name']);
            $this->drink->setSubtype($drink['subtype']);
            $this->drink->setFormat($drink['format']);
            $this->drink->setPrice($drink['price']);
            $this->drink->setAlcoholType($drink['alcohol_type']);
            $this->drink->setSaqCode($drink['saq_code']);
            $this->drink->setInventoryID($drink['inventory_id']);
            $this->drink->setCurrentLocation($drink['current_location']);
            $this->drink->setLastMovedBy($drink['last_moved_by']);
            $this->drink->setLastMovedAt($drink['last_moved_at']);
            $this->drink->setImage($drink['image']);


            $viewClass = "\\views\\" . "DrinkEdit";
            $view = new $viewClass($user);
            $view->render($drink);
        }
    }



    public function handleAdd() {
        // Check if the form has been submitted
        if(isset($_POST['submit'])) {
            // Retrieve the submitted values
            $name = $_POST['name'];
            $subtype = $_POST['subtype'];
            $format = $_POST['format'];
            $price = $_POST['price'];
            $alcohol_type = $_POST['alcohol_type'];
            $saq_code = $_POST['saq_code'];
            $current_location = $_POST['current_location'];
            $image = $_POST['image'];

            // Create a new drink object and save it to the database
            $this->drink = new \models\Drink();

            $this->drink->setName($name);
            $this->drink->setSubtype($subtype);
            $this->drink->setFormat($format);
            $this->drink->setPrice($price);
            $this->drink->setAlcoholType($alcohol_type);
            $this->drink->setSaqCode($saq_code);
            $this->drink->setCurrentLocation($current_location);
            $this->drink->setImage($image);
            $this->drink->create();

            header("Location: index.php?resource=drink&action=menu");
            exit;

        } else {
            // display the add form
            $viewClass = "\\views\\" . "DrinkAdd";
            if(class_exists($viewClass)) {
                $view = new $viewClass($this->drink);
                $view->render();
            }
        }
    }


    private function handleDelete()
    {
        //get the id of the drink to delete
        $drink_id = $_POST['drink_id'];

        //delete the drink from the database
        $success = $this->drink->delete($drink_id);

        //if the delete was successful, redirect to the drink list
        if ($success) {
            header("Location: index.php?resource=drink&action=menu");
            exit;
        }
    }


    private function handleLocation()
    {
        // Check if the drink_id is provided in the URL
        if (isset($_GET['id'])) {
            $drink_id = $_GET['id'];

            // Retrieve the drink from the database
            $drink = $this->drink->getDrinkByDrinkID($drink_id);

            if ($drink) {
                $locationModel = new \Models\Location();
                $location = $locationModel->getLocationByID($drink['current_location']);

                // If the location exists, render the location page
                if ($location) {
                    $viewClass = "\\Views\\" . "DrinkLocation";
                    if (class_exists($viewClass)) {
                        $view = new $viewClass($this->user, $this->drink);
                        $view->render($location, $drink);
                    }
                } else {
                    // If the location doesn't exist, display an error message
                    echo "Location not found.";
                }
            } else {
                // If the drink doesn't exist, display an error message
                echo "Drink not found.";
            }
        } else {
            // If the drink_id is not provided, display an error message
            echo "Drink ID not provided.";
        }
    }




}

?>
