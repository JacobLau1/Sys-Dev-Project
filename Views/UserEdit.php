<?php namespace views; ?>

<html>
<head>
    <style>
        #employeesTable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #employeesTable td, #employeesTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #employeesTable tr:nth-child(even){background-color: #f2f2f2;}

        #employeesTable tr:hover {background-color: #ddd;}

        #employeesTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
<?php

class UserEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($userModel = null) {
        echo '<br/>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=logout">Logout</a>';
        echo '<br/>';

        if ($userModel === null) {
            echo 'No user to display.';
            return;
        }

        //echo out the user id
        echo "User ID: " . $userModel->getUsername() . "<br>";

        //
        $html = '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>Position</th>
            <th>Username</th>
            ";

        $html .=  "<tr>
            <td>".$userModel->getID()."</td>
            <td>".$userModel->getPosition()."</td>
            <td>".$userModel->getUsername()."</td>
        </tr>";

        $html .= "</table>";

        // Form to edit the user
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$userModel->getID().'"><br>';
        $html .= '<label for="type">Type:</label><br>';
        $html .= '<input type="text" id="type" name="type" value="'.$userModel->getPosition().'"><br>';
        $html .= '<label for="name">Name:</label><br>';
        $html .= '<input type="text" id="name" name="name" value="'.$userModel->getUsername().'"><br>';

        $html .= '<input type="submit" value="Submit">';
        $html .= '</form>';

        // Button to delete the user
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$userModel->getID().'"><br>';
        $html .= '<input type="submit" value="Terminate User">';


        echo $html;
    }

}

?>
</body>
</html>
