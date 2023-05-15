<?php

namespace controllers;

require(dirname(__DIR__). DIRECTORY_SEPARATOR ."Models" . DIRECTORY_SEPARATOR ."Wine.php");


class WineController{

    private $user;
    private $wine;

    function __construct(){
        if(!isset($_GET['action'])) {
            return;
        }


        $action = $_GET['action'];

        $viewClass = "\\Views\\" . "Wine" . ucfirst($action);

        if(!class_exists($viewClass)) {
            return;
        }

        //  $this->user = new \models\User();
        $this->wine = new \Models\Wine();

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

        $this->wine = new \Models\Wine();
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $wines = null;
        if(isset($name)){
            $wines = $this->wine->getWineByName($name);
        }else{
            $wines = $this->wine->getAll();
        }

        $viewClass = "\\Views\\" . "WineMenu";
        if(class_exists($viewClass)) {
            $view = new $viewClass($this->wine);
            $view->render($wines);
        }
    }

    function handleEdit() {
        //check if the form has been submitted
        if (isset($_POST['id'])&&isset($POST['saq_code'])&&
            isset($_POST['type'])&&isset($_POST['name'])&&
            isset($_POST['format'])&&isset($_POST['price'])) {
            //get the wine id from the form
            $id = $_POST['id'];
            //get the wine properties from the form
            $saq_code = $_POST['saq_code'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $format = $_POST['format'];
            $price = $_POST['price'];

            // Update the wine object properties
            $this->wine->setID($id);
            $this->wine->setSaqCode($saq_code);
            $this->wine->setType($type);
            $this->wine->setName($name);
            $this->wine->setFormat($format);
            $this->wine->setPrice($price);

            //update the wine in the database
            $success = $this->wine->update();

            //if the update was successful, redirect to the wine menu
            if ($success) {
                header("Location: index.php?resource=wine&action=menu");
                exit;
            } else {
                //if the update failed, display an error message
                echo "Update failed";
            }
        } else {
            //if the form has not been submitted, render the edit view
            $id = $_GET['id'];
            $wineModel = new \Models\Wine();
            $wine = $wineModel->getWineByID($id);
            $this->wine->setID($wine['id']);
            $this->wine->setSaqCode($wine['saq_code']);
            $this->wine->setType($wine['type']);
            $this->wine->setName($wine['name']);
            $this->wine->setFormat($wine['format']);
            $this->wine->setPrice($wine['price']);
            $viewClass = "\\views\\" . "WineEdit";
            $view = new $viewClass($this->wine);
            $view->render($wine);
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
    
            // Create a new wine object and save it to the database
            $this->wine = new \models\Wine();
            $this->wine->setSaqCode($saq_code);
            $this->wine->setType($type);
            $this->wine->setName($name);
            $this->wine->setFormat($format);
            $this->wine->setPrice($price);
            $this->wine->create();
    
            // Redirect to the wine menu after adding a new wine
            header("Location: index.php?resource=wine&action=menu");
            exit;
        } else {
            // display the add form
            $viewClass = "\\views\\" . "WineAdd";
            if(class_exists($viewClass)) {
                $view = new $viewClass($this->wine);
                $view->render();
            }
        }   
    }

    private function handleDelete()
    {
        //get the id of the wine to delete
        $id = $_POST['id'];

        //delete the wine from the database
        $success = $this->wine->delete($id);

        //if the delete was successful, redirect to the wine list
        if ($success) {
            header("Location: index.php?resource=wine&action=menu");
            exit;
        }
    }


}

?>