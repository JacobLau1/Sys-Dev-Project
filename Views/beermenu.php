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

class BeerMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($beers) {

        echo '<br/>';

        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection'>Back to menu selection</a>";
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";

        echo '<br/>';

        echo '<br/>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=beer&action=add'>Add bottle</a>";

        $html = '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            <th>Edit</th>
            ";

        // Loop and fill the table with data from the database
        foreach ($beers as $beer) {
            $html .=  "<tr>
                <td>".$beer['id']."</td>
                <td>".$beer['type']."</td>
                <td>".$beer['name']."</td>
                <td>".$beer['format']."</td>
                <td>".$beer['price']."</td>
                <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=beer&action=edit&id=".$beer['id']."'>Edit</a></td>
            </tr>";
        }

        $html .= "</table>";

        echo $html;
    }
}

?>
</body>
</html>
