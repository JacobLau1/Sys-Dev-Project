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

class SpiritEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($spirit = null) {
        echo '<br/>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=menu'>Back to spirit</a>";
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";
        echo '<br/>';

        if ($spirit === null) {
            echo 'No spirit to display.';
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
            <td>".$spirit['id']."</td>
            <td>".$spirit['type']."</td>
            <td>".$spirit['name']."</td>
            <td>".$spirit['format']."</td>
            <td>".$spirit['price']."</td>
        </tr>";

        $html .= "</table>";

        // Form to edit the spirit
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$spirit['id'].'"><br>';
        $html .= '<label for="type">Type:</label><br>';
        $html .= '<input type="text" id="type" name="type" value="'.$spirit['type'].'"><br>';
        $html .= '<label for="name">Name:</label><br>';
        $html .= '<input type="text" id="name" name="name" value="'.$spirit['name'].'"><br>';
        $html .= '<label for="format">Format:</label><br>';
        $html .= '<input type="text" id="format" name="format" value="'.$spirit['format'].'"><br>';
        $html .= '<label for="price">Price:</label><br>';
        $html .= '<input type="text" id="price" name="price" value="'.$spirit['price'].'"><br>';
        $html .= '<input type="submit" value="Submit">';
        $html .= '</form>';

        // Button to delete the spirit
        $html .= '<form action="http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=delete" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$spirit['id'].'"><br>';
        $html .= '<input type="submit" value="Delete Spirit">';
        $html .= '</form>';

        $html .= '</section>';


        echo $html;
    }

}

?>
</body>
</html>
