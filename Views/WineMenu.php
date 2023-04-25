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

class WineMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($wines) {

        echo '<br/>';

        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=logout">Logout</a>';

        echo '<br/>';

        $html = '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            <th>Edit</th>
            ";

        // Loop and fill the table with data from the database
        foreach ($wines as $wine) {
            $html .=  "<tr>
                <td>".$wine['id']."</td>
                <td>".$wine['type']."</td>
                <td>".$wine['name']."</td>
                <td>".$wine['format']."</td>
                <td>".$wine['price']."</td>
                <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=wine&action=edit&id=".$wine['id']."'>Edit</a></td>
            </tr>";
        }

        $html .= "</table>";

        echo $html;
    }
}

?>
</body>
</html>