<?php namespace views; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <style>
        body {
            background-color: #18332B;
        }

        h1 {
            text-align: center;
            color: #eeeeee;
        }

        a {
            color: #eeeeee;
            text-decoration: none;
        }

        a:hover {
            color: #eeeeee;
            text-decoration: underline;
        }

        div a {
            /* Aligned center */
            display: block;
            margin: auto;

            /* Background color */
            background-color: #113E30;

            height: 10vw;
            width: 30vw;

            text-align: center;

            /*centers the text vertically*/
            line-height: 10vw;
        }

        div a:hover {
            background-color: #0B1F17;
        }

    </style>
</head>
<body>
<?php

class UserManagement
{
    private $user;

    public function __construct($user)
    {

        $this->user = $user;

        $membershipProvider = $this->user->getMembershipProvider();

        if ($membershipProvider->isLoggedIn()) {
            $html = "";
            $html .= "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";
            $html .= "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection'>Back to menu selection</a>";

            //if the position is admin, display admin
            if ($this->user->getPosition() == 'admin') {
                $html .= "</br>";
                $html .= "<h1>User Management Page</h1>";
                $html .= "<div>";
                $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=list'>Display</a>";
                $html .= "</br>";
                $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=create'>Add</a>";
                $html .= "</br>";
                $html .= "</div>";
                //  $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=delete'>Delete</a>";
            }

            echo $html;
        } else {//user not logged in
            echo "not logged in";
            header('HTTP/1.1 401 Unauthorized');
            header('Location: http://localhost/Sys-Dev-Project/index.php?resource=user&action=login');

        }
    }
}

?>
</body>
</html>