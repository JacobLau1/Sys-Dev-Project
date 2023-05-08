<?php
namespace controllers;

require(dirname(__DIR__) . "/Models/User.php");

class UserController
{

    private $user;
    private $userModel;

    public function __construct()
    {
        if (!isset($_GET['action'])) {
            return;
        }

        $action = $_GET['action'];

        $viewClass = "\\Views\\" . "User" . ucfirst($action);

        if (!class_exists($viewClass)) {
            return;
        }

        $this->user = new \Models\User();

        if (isset($_POST)) {
            switch ($action) {
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
                case 'delete':
                    $this->handleDelete();
                    break;
                case 'edit':
                    $this->handleEdit();
                    break;
            }
        }

        $view = new $viewClass($this->user);
    }
/*
    private function handleLogin()
    {
        if (isset($_POST['username'], $_POST['password'])) {
            $this->user->setUsername($_POST['username']);
            $this->user = $this->user->getUserByUsername($_POST['username'])[0];
            $this->user->setPassword($_POST['password']);

            if (isset($_POST['enable2fa'])) {
                $this->user->setEnabled2FA($_POST['enable2fa'] == 'true');
            }

            $this->user->login();
        }
    }
*/

private function handleLogin()
    {
        if (isset($_POST['username'], $_POST['password'])) {
            $this->user->setUsername($_POST['username']);
            $this->user = $this->user->getUserByUsername($_POST['username'])[0];
            $this->user->setPassword($_POST['password']);

            // Set the new properties from the POST data
            if (isset($_POST['position'], $_POST['first_name'], $_POST['full_name'], 
            $_POST['last_seen'], $_POST['date_fired'], $_POST['date_hired'], 
            $_POST['working_status'], $_POST['termination_reason'])) {
                $this->user->setPosition($_POST['position']);
                $this->user->setFirstName($_POST['first_name']);
                $this->user->setFullName($_POST['full_name']);
                $this->user->setLastSeen($_POST['last_seen']);
                $this->user->setDateFired($_POST['date_fired']);
                $this->user->setDateHired($_POST['date_hired']);
                $this->user->setWorkingStatus($_POST['working_status']);
                $this->user->setTerminationReason($_POST['termination_reason']);
            }

            if (isset($_POST['enable2fa'])) {
                $this->user->setEnabled2FA($_POST['enable2fa'] == 'true');
            }

            $this->user->login();
        }
    }

private function handleCreate()
{
    if (isset($_POST['position'], $_POST['first_name'], $_POST['full_name'], $_POST['last_seen'], $_POST['date_fired'], $_POST['date_hired'], $_POST['working_status'], $_POST['termination_reason'], $_POST['username'], $_POST['password'])) {
        $this->user->setPosition($_POST['position']);
        $this->user->setFirstName($_POST['first_name']);
        $this->user->setFullName($_POST['full_name']);
        $this->user->setLastSeen($_POST['last_seen']);
        $this->user->setDateFired($_POST['date_fired']);
        $this->user->setDateHired($_POST['date_hired']);
        $this->user->setWorkingStatus($_POST['working_status']);
        $this->user->setTerminationReason($_POST['termination_reason']);
        $this->user->setUsername($_POST['username']);
        $this->user->setPassword($_POST['password']);

        if (isset($_POST['enable2fa'])) {
            $this->user->setEnabled2FA($_POST['enable2fa'] == 'true');
        }

        $this->user->create();
    }
}

    private function handleSetUpTwoFA()
    {
        if (isset($_COOKIE['UserSession'])) {
            $username = $_COOKIE['UserSession'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }

        $this->user->setuptwofa();
    }

    private function handleValidateCode()
    {
        if (isset($_COOKIE['UserSession'])) {
            $username = $_COOKIE['UserSession'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }

        if (isset($_POST['twofacode'])) {
            $twofacode = $_POST['twofacode'];
            $this->user->validatecode($twofacode);
        }
    }

    private function handleMenuSelection()
    {
        if (isset($_COOKIE['UserSession'])) {
            $username = $_COOKIE['UserSession'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }
    }

    private function handleUserManagement()
    {
        if (isset($_COOKIE['UserSession'])) {
            $username = $_COOKIE['UserSession'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }
    }

    private function handleUserList()
    {
        if (isset($_COOKIE['UserSession'])) {
            $username = $_COOKIE['UserSession'];
            $this->user = $this->user->getUserByUsername($username)[0];

            $userModel = new \Models\User();
            $users = $userModel->getAll();

            $viewClass = "\\views\\" . "UserList";
            if (class_exists($viewClass)) {
                $view = new $viewClass($this->user);
                $view->render($users);
            }
        }
    }

    private function handleLogout()
    {
        echo "logout";
        $this->user->logout();
    }

private function handleEdit()
{
    if (isset($_POST['id'], $_POST['position'], $_POST['first_name'], $_POST['full_name'], $_POST['last_seen'], $_POST['date_fired'], $_POST['date_hired'], $_POST['working_status'], $_POST['termination_reason'], $_POST['username'])) {
        $id = $_POST['id'];
        $userModel = (new \Models\User())->getUserByID($id)[0];

        $userModel->setPosition($_POST['position']);
        $userModel->setFirstName($_POST['first_name']);
        $userModel->setFullName($_POST['full_name']);
        $userModel->setLastSeen($_POST['last_seen']);
        $userModel->setDateFired($_POST['date_fired']);
        $userModel->setDateHired($_POST['date_hired']);
        $userModel->setWorkingStatus($_POST['working_status']);
        $userModel->setTerminationReason($_POST['termination_reason']);
        $userModel->setUsername($_POST['username']);

        if (isset($_POST['enable2fa'])) {
            $userModel->setEnabled2FA($_POST['enable2fa'] == 'true');
        }

        $success = $userModel->update();

        if ($success) {
            header("Location: index.php?resource=user&action=list");
            exit;
        } else {
            echo "Update failed";
        }
    } else {
        $id = $_GET['id'];
        $userModel = (new \Models\User())->getUserByID($id)[0];

        $userModel->setPosition($userModel->getPosition());
        $userModel->setFirstName($userModel->getFirstName());
        $userModel->setFullName($userModel->getFullName());
        $userModel->setLastSeen($userModel->getLastSeen());
        $userModel->setDateFired($userModel->getDateFired());
        $userModel->setDateHired($userModel->getDateHired());
        $userModel->setWorkingStatus($userModel->getWorkingStatus());
        $userModel->setTerminationReason($userModel->getTerminationReason());
        $userModel->setUsername($userModel->getUsername());
        $userModel->setPassword($userModel->getPassword());
        $userModel->setEnabled2FA($userModel->getEnabled2FA());

        $viewClass = "\\Views\\" . "UserEdit";
        $view = new $viewClass($this->user);
        $view->render($userModel);
    }
}


    private function handleDelete()
    {

        //get the id of the user to delete
        $id = $_GET['id'];

        //delete the user from the database
        $success = $this->user->delete($id);

        //if the delete was successful, redirect to the user list
        if ($success) {
            header("Location: index.php?resource=user&action=menu");
            exit;
        } else {
            //if the delete failed, display an error message
            echo "Delete failed";
        }
    }

}

?>
