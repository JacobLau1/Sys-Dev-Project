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

class WineEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($wine = null) {
        echo '<br/>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=logout">Logout</a>';
        echo '<br/>';

        if ($wine === null) {
            echo 'No wine to display.';
            return;
        }

        $html = '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            ";

        $html .=  "<tr>
            <td>".$wine['id']."</td>
            <td>".$wine['type']."</td>
            <td>".$wine['name']."</td>
            <td>".$wine['format']."</td>
            <td>".$wine['price']."</td>
        </tr>";

        $html .= "</table>";

        // Form to edit the wine
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$wine['id'].'"><br>';
        $html .= '<label for="type">Type:</label><br>';
        $html .= '<input type="text" id="type" name="type" value="'.$wine['type'].'"><br>';
        $html .= '<label for="name">Name:</label><br>';
        $html .= '<input type="text" id="name" name="name" value="'.$wine['name'].'"><br>';
        $html .= '<label for="format">Format:</label><br>';
        $html .= '<input type="text" id="format" name="format" value="'.$wine['format'].'"><br>';
        $html .= '<label for="price">Price:</label><br>';
        $html .= '<input type="text" id="price" name="price" value="'.$wine['price'].'"><br>';
        $html .= '<input type="submit" value="Submit">';
        $html .= '</form>';


        echo $html;
    }

}

?>
</body>
</html>
