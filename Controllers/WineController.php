<?php

namespace controllers;

require(dirname(__DIR__)."/Models/Wine.php");


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

        $wineModel = new \Models\Wine();
        $wines = $wineModel->getAll();

        $viewClass = "\\Views\\" . "WineMenu";
        if(class_exists($viewClass)) {
            $view = new $viewClass($this->wine);
            $view->render($wines);
        }
    }

    function handleEdit() {
        //check if the form has been submitted
        if (isset($_POST['submit'])) {
            //get the wine id from the form
            $id = $_POST['id'];
            //get the wine properties from the form
            $type = $_POST['type'];
            $name = $_POST['name'];
            $format = $_POST['format'];
            $price = $_POST['price'];

            // Update the wine object properties
            $this->wine->setID($id);
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
            $this->wine->setType($wine['type']);
            $this->wine->setName($wine['name']);
            $this->wine->setFormat($wine['format']);
            $this->wine->setPrice($wine['price']);
            $viewClass = "\\views\\" . "WineEdit";
            $view = new $viewClass($this->wine);
            $view->render($wine);
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