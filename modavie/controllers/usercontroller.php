<?php
namespace controllers;

require(dirname(__DIR__)."/models/user.php");

class UserController{

    private $user;

    function __construct(){

        if(isset($_GET)){
            if(isset($_GET['action'])){

                $action = $_GET['action'];

                $viewClass = "\\views\\"."User".ucfirst($action);

                // Read the user information from the request
                // and setup a user model object
                $this->user = new \models\User();                 

                if(isset($_POST)){

                    if($action == 'login'){
                        if(isset($_POST['username']) && isset($_POST['password']) ){

                            $this->user->setUsername($_POST['username']);

                            $this->user = $this->user->getUserByUsername($_POST['username'])[0];

                            $this->user->setPassword($_POST['password']);

                            if(isset($_POST['enable2fa']))
                                $this->user->setEnabled2FA($_POST['enable2fa'] == 'true' ? true : false);

                            // Based on the action determine which Model function to call
                            // We have two options:
                            // 1-
                            // Either the name of the URL parameter needs to match the function in the model 
                            //2-
                            // OR we will have to do a conditional logic to check what the action is and call
                            // the appropriate function in the model
                            $this->user->$action();
                        }
                    }else if($action == 'create'){
                        if(isset($_POST['username']) && isset($_POST['password']) ){

                            $this->user->setUsername($_POST['username']);

                            $this->user->setPassword($_POST['password']);

                            if(isset($_POST['enable2fa']))
                                $this->user->setEnabled2FA($_POST['enable2fa'] == 'true' ? true : false);

                            // Based on the action determine which Model function to call
                            // We have two options:
                            // 1-
                            // Either the name of the URL parameter needs to match the function in the model 
                            //2-
                            // OR we will have to do a conditional logic to check what the action is and call
                            // the appropriate function in the model
                            $this->user->$action();
                        }
                    }
                    else if($action == 'setuptwofa'){

                        if(isset($_COOKIE['hrappuser'])){
                            $username = $_COOKIE['hrappuser'];

                            $this->user = $this->user->getUserByUsername($username)[0];
                        }
                        $this->user->$action();
                    }else if($action == 'validatecode'){

                        if(isset($_COOKIE['hrappuser'])){
                            $username = $_COOKIE['hrappuser'];

                            $this->user = $this->user->getUserByUsername($username)[0];
                        }

                        if(isset($_POST['twofacode'])){
                            $twofacode = $_POST['twofacode'];

                            $this->user->$action($twofacode);
                        }
                    }
                }

                if(class_exists($viewClass)){

                    $view = new $viewClass($this->user);

                }
            }
        }
    }
}

?>