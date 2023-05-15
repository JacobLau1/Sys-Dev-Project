<?php

namespace controllers;

require(dirname(__DIR__) . DIRECTORY_SEPARATOR . "Models" . DIRECTORY_SEPARATOR . "Beer.php");


class BeerController{

    private $user;
    private $beer;

    function __construct(){
        if(!isset($_GET['action'])) {
            return;
        }


        $action = $_GET['action'];

        $viewClass = "\\Views\\" . "Beer" . ucfirst($action);

        if(!class_exists($viewClass)) {
            return;
        }

        //  $this->user = new \models\User();
        $this->beer = new \Models\Beer();

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

        $this->beer = new \Models\Beer();
        //$beers = $this->beer->getAll();
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $beers = null;
        if(isset($name)){
            $beers = $this->beer->getBeerByName($name);
        }else{
            $beers = $this->beer->getAll();
        }

        $viewClass = "\\Views\\" . "BeerMenu";
        if(class_exists($viewClass)) {
            $view = new $viewClass($this->beer);
            $view->render($beers);
        }
    }

    function handleEdit() {
        //check if the form has been submitted
        if (isset($_POST['id'])&&isset($_POST['saq_code'])&&
            isset($_POST['type'])&&isset($_POST['name'])&&isset($_POST['format'])&&isset($_POST['price'])) {
            //get the beer id from the form
            $id = $_POST['id'];
            //get the beer properties from the form
            $saq_code = $_POST['saq_code'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $format = $_POST['format'];
            $price = $_POST['price'];

            // Update the beer object properties
            $this->beer->setID($id);
            $this->beer->setSaqCode($saq_code);
            $this->beer->setType($type);
            $this->beer->setName($name);
            $this->beer->setFormat($format);
            $this->beer->setPrice($price);

            //update the beer in the database
            $success = $this->beer->update();

            //if the update was successful, redirect to the beer menu
            if ($success) {
                header("Location: index.php?resource=beer&action=menu");
                exit;
            } else {
                //if the update failed, display an error message
                echo "Update failed";
            }
        } else {
            //if the form has not been submitted, render the edit view
            $id = $_GET['id'];
            $beerModel = new \Models\Beer();
            $beer = $beerModel->getBeerByID($id);
            $this->beer->setID($beer['id']);
            $this->beer->setSaqCode($beer['saq_code']);
            $this->beer->setType($beer['type']);
            $this->beer->setName($beer['name']);
            $this->beer->setFormat($beer['format']);
            $this->beer->setPrice($beer['price']);
            $viewClass = "\\views\\" . "BeerEdit";
            $view = new $viewClass($this->beer);
            $view->render($beer);
        }
    }

    public function handleAdd() {       //handle add
        // Check if the form has been submitted
        if(isset($_POST['submit'])) {
            // Retrieve the submitted values
            $saq_code = $_POST['saq_code'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $format = $_POST['format'];
            $price = $_POST['price'];
    
            // Validate the submitted values (e.g. check if the price is a number)
    
            // Create a new beer object and save it to the database
            $this->beer = new \models\Beer();
            $this->beer->setSaqCode($saq_code);
            $this->beer->setType($type);
            $this->beer->setName($name);
            $this->beer->setFormat($format);
            $this->beer->setPrice($price);
            $this->beer->create();
    
            // Redirect to the beer menu after adding a new beer
            header("Location: index.php?resource=beer&action=menu");
            exit;
        } else {
            // display the add form
            $viewClass = "\\views\\" . "BeerAdd";
            if(class_exists($viewClass)) {
                $view = new $viewClass($this->beer);
                $view->render();
            }
        }   
    }

    private function handleDelete()
    {
        //get the id of the beer to delete
        $id = $_POST['id'];

        //delete the beer from the database
        $success = $this->beer->delete($id);

        //if the delete was successful, redirect to the beer list
        if ($success) {
            header("Location: index.php?resource=beer&action=menu");
            exit;
        }
    }


}

?>