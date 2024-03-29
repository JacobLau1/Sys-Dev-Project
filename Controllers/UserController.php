<?php
namespace controllers;

require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . "Models" . DIRECTORY_SEPARATOR . "User.php");
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class UserController
{

    private $log;
    private $user;
    private $userModel;




    public function __construct()
    {
        $this->log = new Logger('user');
        $this->log->pushHandler(new StreamHandler('user.log', Logger::INFO));

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

    private function handleLogin()
    {
        if (isset($_POST['username'], $_POST['password'])) {
            $this->user->setUsername($_POST['username']);
            $this->user = $this->user->getUserByUsername($_POST['username'])[0];
            $this->user->setPassword($_POST['password']);

            $this->log->info('Attempting login', ['username' => $_POST['username']]);

            if (isset($_POST['enable2fa'])) {
                $this->user->setEnabled2FA($_POST['enable2fa'] == 'true');
            }

            $this->user->login();
        }
    }

    private function handleCreate()
    {
        //echo "handleCreate called <br/>";
        //echo "Username: " . $_POST['username'] . "<br/>";
        $this->log->info('Attempting Registration');

        if (isset($_COOKIE['userRegistration'])) {
            $userRegistration = json_decode($_COOKIE['userRegistration'], true);
            $this->log->info('Registering', ['username' => $userRegistration['username']]);
            $this->user->setUsername($userRegistration['username']);
            $this->user->setPassword($userRegistration['password']);
            $this->user->setPosition($userRegistration['position']);
            $this->user->setFirstName($userRegistration['first_name']);
            $this->user->setLastName($userRegistration['last_name']);
            $this->user->setDateHired($userRegistration['date_hired']);
            $this->user->setWorkingStatus($userRegistration['working_status']);
            $this->user->setEnabled2FA($userRegistration['enable2fa']);
            $this->user->create();
            //delete the cookie
            setcookie('userRegistration', '', time() - 3600, DIRECTORY_SEPARATOR);
            // echo "User created <br/>";
        }





        /*
        // Use $_POST instead of reading raw data
        if (isset($_POST['username'], $_POST['password'], $_POST['position'], $_POST['first_name'], $_POST['last_name'])) {
            $this->user->setUsername($_POST['username']);
            $this->user->setPassword($_POST['password']);
            $this->user->setPosition($_POST['position']);
            $this->user->setFirstName($_POST['first_name']);
            $this->user->setlast_name($_POST['last_name']);
            $this->user->setEnabled2FA(isset($_POST['enable2fa']) && $_POST['enable2fa'] == '1');

            $this->user->create();
            echo "User created <br/>";
        }

        if (isset($_POST['username'])){
            echo "username is set <br/>";
        }
        */
    }



    private function handleSetUpTwoFA()
    {
        $this->log->info('Setting up 2fa');

        if (isset($_COOKIE['UserSessionUser'])) {
            $username = $_COOKIE['UserSessionUser'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }

        $this->user->setuptwofa();
    }

    private function handleValidateCode()
    {
        $this->log->info('Handling 2fa validation');
        if (isset($_COOKIE['UserSessionUser'])) {
            $username = $_COOKIE['UserSessionUser'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }

        if (isset($_POST['twofacode'])) {
            $twofacode = $_POST['twofacode'];
            $this->user->validatecode($twofacode);
        }
    }

    private function handleMenuSelection()
    {

        if (isset($_COOKIE['UserSessionUser'])) {
            $username = $_COOKIE['UserSessionUser'];
            $this->user = $this->user->getUserByUsername($username)[0];
        } else{
            echo "UserSession cookie not set";
        }
    }

    private function handleUserManagement()
    {
        if (isset($_COOKIE['UserSessionUser'])) {
            $username = $_COOKIE['UserSessionUser'];
            $this->user = $this->user->getUserByUsername($username)[0];
        }
    }

    private function handleUserList()
    {
        if (isset($_COOKIE['UserSessionUser'])) {


            $userModel = new \Models\User();

            if (isset($_POST['usernamesearch'])) {
                $usernamesearch = $_POST['usernamesearch'];
                $users = [$userModel->getUserByUsername($usernamesearch)[0]];
            } else {
                $users = $userModel->getAll();
            }
            $username = $_COOKIE['UserSessionUser'];
            $this->user = $userModel->getUserByUsername($username)[0];


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
        if (isset($_POST['id'], $_POST['position'],
            $_POST['first_name'], $_POST['last_name'],
            $_POST['last_seen'], $_POST['date_fired'],
            $_POST['date_hired'], $_POST['working_status'],
            $_POST['termination_reason'], $_POST['username'])) {

            $id = $_POST['id'];

            $this->log->info('Editing', ['UID' => $id]);

            //get the user properties from the form
            $position = $_POST['position'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $last_seen = $_POST['last_seen'];
            $date_fired = $_POST['date_fired'];
            $date_hired = $_POST['date_hired'];
            $working_status = $_POST['working_status'];
            $termination_reason = $_POST['termination_reason'];
            $username = $_POST['username'];

            $userModel = (new \Models\User())->getUserByID($id)[0];

            $userModel->setPosition($position);
            $userModel->setFirstName($first_name);
            $userModel->setLastName($last_name);
            $userModel->setLastSeen($last_seen);
            $userModel->setDateFired($date_fired);
            $userModel->setDateHired($date_hired);
            $userModel->setWorkingStatus($working_status);
            $userModel->setTerminationReason($termination_reason);
            $userModel->setUsername($username);

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
            $userModel->setLastName($userModel->getLastName());
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
        $this->log->info('Deleting', ['UID' => $id]);

        //delete the user from the database
        $success = $this->user->delete($id);

        //if the delete was successful, redirect to the user list
        if ($success) {
            $this->log->info('Deletion successful', ['UID' => $id]);
            header("Location: index.php?resource=user&action=menu");
            exit;
        } else {
            $this->log->info('Deletion failed', ['UID' => $id]);
            //if the delete failed, display an error message
            echo "Delete failed";
        }
    }

}

?>