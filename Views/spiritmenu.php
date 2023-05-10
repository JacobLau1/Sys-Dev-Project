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

class SpiritMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($spirits) {

        echo '<br/>';

        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection'>Back to menu selection</a>";
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";

        echo '<br/>';

        echo '<br/>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=add'>Add bottle</a>";

        $html = '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            <th>Edit</th>
            ";

        // Loop and fill the table with data from the database
        foreach ($spirits as $spirit) {
            $html .=  "<tr>
                <td>".$spirit['id']."</td>
                <td>".$spirit['type']."</td>
                <td>".$spirit['name']."</td>
                <td>".$spirit['format']."</td>
                <td>".$spirit['price']."</td>
                <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=edit&id=".$spirit['id']."'>Edit</a></td>
            </tr>";
        }

        $html .= "</table>";

        echo $html;
    }
}

?>
</body>
</html>
