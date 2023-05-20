<?php namespace views; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <script src="https://kit.fontawesome.com/99c47d5f92.js" crossorigin="anonymous"></script>
    <title>Wine Menu</title>
    <link rel="icon" type="image/x-icon" href="./favicon.ico" />
    <style>
        .card {
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .card:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        }

        .card a {
            text-decoration: none;
            color: white;
        }

        .card a:hover {
            color: white;
        }
    </style>
</head>
<body class="w3-theme-d5">
<?php

class UserManagement
{
    private $user;

    public function __construct($user)
    {

        $this->user = $user;

        $membershipProvider = $this->user->getMembershipProvider();


        if ($membershipProvider->isLoggedIn()) {
            $html = '<nav>';
            $html .= '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
            $html .= '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
            if($this->user->getPosition() == 'admin' || $this->user->getPosition() == 'manager'){
            }

            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login' class='w3-bar-item w3-button w3-hide-small w3-hover-white'>Logout</a>";
            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection' class='w3-bar-item w3-button w3-hide-small w3-hover-white'>Back to menu selection</a>";
            $html .= '</div>';
            $html .= '</nav>';
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<div class='w3-container w3-center'>";
            //if the position is admin, display admin
            if ($this->user->getPosition() == 'admin' || $this->user->getPosition() == 'manager') {
                $html .= "<div class='w3-container w3-center'>";
                $html .= "<h1>User Management Page</h1>";
                $html .= "<div class='card w3-theme-d3 w3-text-white'><a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=list'>Display</a></div>";
                $html .= "<div class='card w3-theme-d3'><a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=create'>Add</a></div>";
                $html .= "</div>";
            }

            echo $html;
        } else {//user not logged in
            echo "Not logged in";
            header('HTTP/1.1 401 Unauthorized');
            header('Location: http://localhost/Sys-Dev-Project/index.php?resource=user&action=login');
            exit;
        }
    }
}

?>
</body
