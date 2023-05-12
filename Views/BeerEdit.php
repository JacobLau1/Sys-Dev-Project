<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
</head>
<body class="w3-theme-d5">
<?php

class BeerEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($beer = null) {
        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=beer&action=menu" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu</a>';
        echo '</div>';
        echo '</nav>';


        if ($beer === null) {
            echo 'No beer to display.';
            return;
        }

        /* Table */
        $html = '';
        $html .= '<div class="w3-container w3-center" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">Wine Menu</h1>';
        $html .= '<section class="w3-card w3-white">';
        $html .= '<table id="employeesTable" class="w3-table w3-striped w3-hoverable w3-text-black">';
        $html .= '<tr class="w3-theme-d3">';
        $html .= '<th class="">ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            ';
        $html .= '</tr>';

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
