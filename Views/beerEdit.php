<?php namespace views; ?>

<html>
<head>
    <style>

        body {
            background-color: #18332B;
            display: flex;
            flex-direction: column;
            width: 100vw;
            height: 100vh;
            margin: 0;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: #eeeeee;
            text-decoration: underline;
        }

        section {
            background-color: #eeeeee;

            /* Centers the section */
            margin: auto;
            /* Centers the contents */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }

        h1 {
            text-align: center;
            color: #eeeeee;
        }

        #employeesTable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #employeesTable td, #employeesTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #employeesTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #employeesTable tr:hover {
            background-color: #ddd;
        }

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

class BeerEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($beer = null) {
        echo '<br/>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=beer&action=menu'>Back to beer</a>";
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";
        echo '<br/>';

        if ($beer === null) {
            echo 'No beer to display.';
            return;
        }

        $html = '<section>';
        $html .= '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            ";

        $html .=  "<tr>
            <td>".$beer['id']."</td>
            <td>".$beer['type']."</td>
            <td>".$beer['name']."</td>
            <td>".$beer['format']."</td>
            <td>".$beer['price']."</td>
        </tr>";

        $html .= "</table>";

        // Form to edit the beer
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$beer['id'].'"><br>';
        $html .= '<label for="type">Type:</label><br>';
        $html .= '<input type="text" id="type" name="type" value="'.$beer['type'].'"><br>';
        $html .= '<label for="name">Name:</label><br>';
        $html .= '<input type="text" id="name" name="name" value="'.$beer['name'].'"><br>';
        $html .= '<label for="format">Format:</label><br>';
        $html .= '<input type="text" id="format" name="format" value="'.$beer['format'].'"><br>';
        $html .= '<label for="price">Price:</label><br>';
        $html .= '<input type="text" id="price" name="price" value="'.$beer['price'].'"><br>';
        $html .= '<input type="submit" value="Submit">';
        $html .= '</form>';

        // Button to delete the beer
        $html .= '<form action="http://localhost/Sys-Dev-Project/index.php?resource=beer&action=delete" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$beer['id'].'"><br>';
        $html .= '<input type="submit" value="Delete Beer">';
        $html .= '</form>';

        $html .= '</section>';


        echo $html;
    }

}

?>
</body>
</html>
