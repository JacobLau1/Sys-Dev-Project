<?php

namespace controllers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require(dirname(__DIR__) . DIRECTORY_SEPARATOR. "Models" . DIRECTORY_SEPARATOR . "Spirit.php");


class SpiritController{

    private $user;
    private $spirit;
    private $log;

    function __construct(){
        $this->log = new Logger('spirit');
        $this->log->pushHandler(new StreamHandler('drinks.log', Logger::INFO));
        if(!isset($_GET['action'])) {
            return;
        }


        $action = $_GET['action'];

        $viewClass = "\\Views\\" . "Spirit" . ucfirst($action);

        if(!class_exists($viewClass)) {
            return;
        }

        //  $this->user = new \models\User();
        $this->spirit = new \Models\Spirit();

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
        $this->spirit = new \Models\Spirit();
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $spirits = null;
        if(isset($name)){
            $spirits = $this->spirit->getSpiritByName($name);
        }else{
            $spirits = $this->spirit->getAll();
        }

        $viewClass = "\\Views\\" . "SpiritMenu";
        if(class_exists($viewClass)) {
            $view = new $viewClass($this->spirit);
            $view->render($spirits);
        }
    }

    function handleEdit() {
        //check if the form has been submitted
        if (isset($_POST['id'])&&isset($_POST['saq_code'])&&
            isset($_POST['type'])&&isset($_POST['name'])&&
            isset($_POST['format'])&&isset($_POST['price'])) {
            //get the spirit id from the form
            $id = $_POST['id'];
            $this->log->info('Editing', ['Spirit ID' => $id]);
            //get the spirit properties from the form
            $saq_code = $_POST['saq_code'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $format = $_POST['format'];
            $price = $_POST['price'];

            // Update the spirit object properties
            $this->spirit->setID($id);
            $this->spirit->setSaqCode($saq_code);
            $this->spirit->setType($type);
            $this->spirit->setName($name);
            $this->spirit->setFormat($format);
            $this->spirit->setPrice($price);

            //update the spirit in the database
            $success = $this->spirit->update();

            //if the update was successful, redirect to the spirit menu
            if ($success) {
                header("Location: index.php?resource=spirit&action=menu");
                exit;
            } else {
                //if the update failed, display an error message
                echo "Update failed";
            }
        } else {
            //if the form has not been submitted, render the edit view
            $id = $_GET['id'];
            $spiritModel = new \Models\Spirit();
            $spirit = $spiritModel->getSpiritByID($id);
            $this->spirit->setID($spirit['id']);
            $this->spirit->setSaqCode($spirit['saq_code']);
            $this->spirit->setType($spirit['type']);
            $this->spirit->setName($spirit['name']);
            $this->spirit->setFormat($spirit['format']);
            $this->spirit->setPrice($spirit['price']);
            $viewClass = "\\views\\" . "SpiritEdit";
            $view = new $viewClass($this->spirit);
            $view->render($spirit);
        }
    }

    public function handleAdd() {       //handle add
        // Check if the form has been submitted
        if(isset($_POST['submit'])) {
            $this->log->info('Adding drink');
            // Retrieve the submitted values
            $id = $_POST['id'];
            $saq_code = $_POST['saq_code'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $format = $_POST['format'];
            $price = $_POST['price'];
    
            // Validate the submitted values (e.g. check if the price is a number)
    
            // Create a new spirit object and save it to the database
            $this->spirit = new \models\Spirit();
            $this->spirit->setID($id);
            $this->spirit->setSaqCode($saq_code);
            $this->spirit->setType($type);
            $this->spirit->setName($name);
            $this->spirit->setFormat($format);
            $this->spirit->setPrice($price);
            $this->spirit->create();
    
            // Redirect to the spirit menu after adding a new spirit
            header("Location: index.php?resource=spirit&action=menu");
            exit;
        } else {
            // display the add form
            $viewClass = "\\views\\" . "SpiritAdd";
            if(class_exists($viewClass)) {
                $view = new $viewClass($this->spirit);
                $view->render();
            }
        }   
    }

    private function handleDelete()
    {
        //get the id of the spirit to delete
        $id = $_POST['id'];
        $this->log->info('Deleting...', ['Spirit ID' => $id]);

        //delete the spirit from the database
        $success = $this->spirit->delete($id);

        //if the delete was successful, redirect to the spirit list
        if ($success) {
            $this->log->info('Deletion successful', ['Spirit ID' => $id]);
            header("Location: index.php?resource=spirit&action=menu");
            exit;
        }
    }


}

?>