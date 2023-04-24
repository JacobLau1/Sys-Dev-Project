<?php
namespace controllers;

require(dirname(__DIR__)."/Models/User.php");

class UserController {

    private $user;

    public function __construct() {
        if(!isset($_GET['action'])) {
            return;
        }

        $action = $_GET['action'];

        $viewClass = "\\Views\\" . "User" . ucfirst($action);

        if(!class_exists($viewClass)) {
            return;
        }

        $this->user = new \Models\User();

        if(isset($_POST)) {
            switch($action) {
                case 'login':
                    $this->handleLogin();
                    break;
                case 'create':
                    $this->handleCreate();
                    break;
                case 'setuptwofa':
                    $this->handleSetUpTwoFA();
                    break;
                case 'validatecode':
                    $this->handleValidateCode();
                    break;
                case 'menuselection':
                    $this->handleMenuSelection();
                    break;
                case 'logout':
                    $this->handleLogout();
                    break;
                case 'management':
                    $this->handleUserManagement();
                    break;
                case 'list':
                    $this->handleUserList();
                    break;
            }
        }

        $view = new $viewClass($this->user);
    }

    private function handleLogin() {
        if(isset($_POST['username'], $_POST['password'])) {
            $this->user->setUsername($_POST['username']);
            $this->user = $this->user->getUserByUsername($_POST['username'])[0];
            $this->user->setPassword($_POST['password']);

            if(isset($_POST['enable2fa'])) {
                $this->user->setEnabled2FA($_POST['enable2fa'] == 'true');
            }

            $this->user->login();
        }
    }

    private function handleCreate() {
        if(isset($_POST['position'], $_POST['username'], $_POST['password'])) {
            $this->user->setPosition($_POST['position']);
            $this->user->setUsername($_POST['username']);
            $this->user->setPassword($_POST['password']);

            if(isset($_POST['enable2fa'])) {
                $this->user->setEnabled2FA($_POST['enable2fa'] == 'true');
            }

            $this->user->create();
        }
    }

    private function handleSetUpTwoFA() {
        if(isset($_COOKIE['hrappuser'])) {
            $username = $_COOKIE['hrappuser'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }

        $this->user->setuptwofa();
    }

    private function handleValidateCode() {
        if(isset($_COOKIE['hrappuser'])) {
            $username = $_COOKIE['hrappuser'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }

        if(isset($_POST['twofacode'])) {
            $twofacode = $_POST['twofacode'];
            $this->user->validatecode($twofacode);
        }
    }

    private function handleMenuSelection() {
        if(isset($_COOKIE['hrappuser'])) {
            $username = $_COOKIE['hrappuser'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }
    }

    private function handleUserManagement() {
        if(isset($_COOKIE['hrappuser'])) {
            $username = $_COOKIE['hrappuser'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }
    }

    private function handleUserList() {
        if(isset($_COOKIE['hrappuser'])) {
            $username = $_COOKIE['hrappuser'];
            $this->user = $this->user->getUserByUsername($username)[0];

            $userModel = new \Models\User();
            $users = $userModel->getAll();

            $viewClass = "\\views\\" . "UserList";
            if(class_exists($viewClass)) {
                $view = new $viewClass($this->user);
                $view->render($users);
            }
        }
    }

}

?>
