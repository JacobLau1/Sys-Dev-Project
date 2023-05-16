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
        $this->drink = new \Models\Drink();

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
            }
        }


    }

    function handleMenu(){

        $this->drink = new \Models\Drink();
        $drink_id = isset($_POST['drink_id']) ? $_POST['drink_id'] : null;
        $drinks = null;
        if(isset($drink_id)){
            $drinks = $this->drink->getDrinkByDrinkID($drink_id);
        }else{
            $drinks = $this->drink->getAll();
        }

        $viewClass = "\\Views\\" . "DrinkMenu";
        if(class_exists($viewClass)) {
            $view = new $viewClass($this->drink);
            $view->render($drinks);
        }
    }

    function handleEdit() {
        //check if the form has been submitted
        if (isset($_POST['drink_id']) && isset($_POST['alcohol_type']) &&
        isset($_POST['saq_code']) &&
        isset($_POST['inventory_id']) && isset($_POST['current_location']) &&
        isset($_POST['last_moved_by']) && isset($_POST['last_moved_at']) && isset($_POST['image'])) {
    
        // get the drink properties from the form
        $drink_id = $_POST['drink_id'];
        $alcohol_type = $_POST['alcohol_type'];
        $saq_code = $_POST['saq_code'];
        $inventory_id = $_POST['inventory_id'];
        $current_location = $_POST['current_location'];
        $last_moved_by = $_POST['last_moved_by'];
        $last_moved_at = $_POST['last_moved_at'];
        $image = $_POST['image'];

        // Update the drink object properties
        $this->drink->setDrinkID($drink_id);
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
        $drink_id = $_GET['drink_id'];
        $drinkModel = new \Models\Drink();
        $drink = $drinkModel->getDrinkByDrinkID($drink_id);

        $this->drink->setDrinkID($drink['drink_id']);
        $this->drink->setAlcoholType($drink['alcohol_type']);
        $this->drink->setSaqCode($drink['saq_code']);
        $this->drink->setInventoryID($drink['inventory_id']);
        $this->drink->setCurrentLocation($drink['current_location']);
        $this->drink->setLastMovedBy($drink['last_moved_by']);
        $this->drink->setLastMovedAt($drink['last_moved_at']);
        $this->drink->setImage($drink['image']);


        $viewClass = "\\views\\" . "DrinkEdit";
        $view = new $viewClass($this->drink);
        $view->render($drink);
    }
    }

    
    
    public function handleAdd() {
        // Check if the form has been submitted
        if(isset($_POST['submit'])) {
            // Retrieve the submitted values
            $drink_id = $_POST['drink_id'];
            $alcohol_type = $_POST['alcohol_type'];
            $saq_code = $_POST['saq_code'];
            $inventory_id = $_POST['inventory_id'];
            $current_location = $_POST['current_location'];
            $last_moved_by = $_POST['last_moved_by'];
            $last_moved_at = $_POST['last_moved_at'];
            $image = $_POST['image'];
    
            // Create a new drink object and save it to the database
            $this->drink = new \models\Drink();
            $this->drink->setDrinkID($drink_id);
            $this->drink->setAlcoholType($alcohol_type);
            $this->drink->setSaqCode($saq_code);
            $this->drink->setInventoryId($inventory_id);
            $this->drink->setCurrentLocation($current_location);
            $this->drink->setLastMovedBy($last_moved_by);
            $this->drink->setLastMovedAt($last_moved_at);
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


}

?>