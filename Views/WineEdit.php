<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
</head>
<body class="w3-theme-d5">
<?php

class WineEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($wine = null) {
        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=wine&action=menu" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu</a>';
        echo '</div>';
        echo '</nav>';


        if ($wine === null) {
            echo 'No wine to display.';
            return;
        }

        /* Table */
        $html = '';
        $html .= '<div class="w3-container w3-center" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">Wine Menu</h1>';
        $html .= '<section class="w3-card w3-white">';
        $html .= '<table id="employeesTable" class="w3-table w3-hoverable w3-text-black"><form action="" method="post">';
        $html .= '<tr>';
        $html .= '<td class="w3-theme-d3"><label class="w3-theme-d3"for="id">ID:</label></td>';
        $html .= '<td><input type="text" id="id" name="id" value="'.$wine['id'].'"></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td class="w3-theme-d3"><label for="type">Type:</label></td>';
        $html .= '<td><input type="text" id="type" name="type" value="'.$wine['type'].'"></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td class="w3-theme-d3"><label for="name">Name:</label></td>';
        $html .= '<td><input type="text" id="name" name="name" value="'.$wine['name'].'"></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td class="w3-theme-d3"><label for="format">Format:</label></td>';
        $html .= '<td><input type="text" id="format" name="format" value="'.$wine['format'].'"></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td class="w3-theme-d3"><label for="price">Price:</label></td>';
        $html .= '<td><input type="text" id="price" name="price" value="'.$wine['price'].'"></td>';
        $html .= '</tr>';
        $html .= '<tr class="w3-theme-d2">';
        $html .= '<td><input type="submit" value="Submit"></td>';
        $html .= '<td class="w3-theme-d2></td>';
        $html .= '</tr>';
        $html .= '</form></table>';


        // Button to delete the wine
        $html .= '<form action="http://localhost/Sys-Dev-Project/index.php?resource=wine&action=delete" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$wine['id'].'"><br>';
        $html .= '<input type="submit" value="Delete Wine">';
        $html .= '</form>';

        $html .= '</section>';



        echo $html;
    }

}

?>
</body>
</html>
