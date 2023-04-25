<?php namespace views;?>
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

class UserList{

    private $user;

    private $welcomeMessage;

    public function __construct($user){

        $this->user = $user;

    }

    public function render($users) {

        echo '<br/>';

        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=logout">Logout</a>';

        echo '<br/>';

        $html = '<table id="employeesTable">';
        $html .= "<th>ID</th>
              <th>Position</th>
              <th>Username</th>
              <th>2FA Enabled</th>
      ";

        // Loop and fill the table with data from the database
        foreach ($users as $user) {
            $html .=  "<tr>
            <td>".$user['id']."</td>
            <td>".$user['position']."</td>
            <td>".$user['username']."</td>
            <td>".$user['enabled2fa']."</td>
        </tr>";
        }

        $html .= "</table>";

        echo $html;
    }


}



?>

</body>
</html>