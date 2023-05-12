<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="./Styles/Menu.css">
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
