<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <title>Drink Edit</title>
</head>
<body class="w3-theme-d5">
<?php

class DrinkEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function render($drink = null) {
        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=drink&action=menu" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu</a>';
        echo '</div>';
        echo '</nav>';

        if ($drink === null) {
            echo 'No drink to display.';
            return;
        }

        /* Form */
        $html = '';
        $html .= '<div class="w3-container w3-center" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">Drink Edit</h1>';
        $html .= '<section class="w3-card w3-white">';

        // Form to edit the drink
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$drink['drink_id'].'"><br>';


        $html .= '<label for="name">Name:</label><br>';
        $html .= '<input type="text" id="name" name="name" value="'.$drink['name'].'"><br>';
        $html .= '<label for="subtype">Subtype:</label><br>';
        $html .= '<input type="text" id="subtype" name="subtype" value="'.$drink['subtype'].'"><br>';
        $html .= '<label for="format">Format:</label><br>';
        $html .= '<input type="text" id="format" name="format" value="'.$drink['format'].'"><br>';
        $html .= '<label for="price">Price:</label><br>';
        $html .= '<input type="text" id="price" name="price" value="'.$drink['price'].'"><br>';
        $html .= '<label for="alcohol_type">Alcohol Type:</label><br>';
        $html .= '<input type="text" id="alcohol_type" name="alcohol_type" value="'.$drink['alcohol_type'].'"><br>';
        $html .= '<label for="saq_code">SAQ Code:</label><br>';
        $html .= '<input type="text" id="saq_code" name="saq_code" value="'.$drink['saq_code'].'"><br>';
        $html .= '<label for="inventory_id">Inventory ID:</label><br>';
        $html .= '<input type="text" id="inventory_id" name="inventory_id" value="'.$drink['inventory_id'].'"><br>';
        $html .= '<label for="current_location">Current Location:</label><br>';
        $html .= '<input type="text" id="current_location" name="current_location" value="'.$drink['current_location'].'"><br>';
        $html .= '<label for="last_moved_by">Last Moved By:</label><br>';
        $html .= '<input type="text" id="last_moved_by" name="last_moved_by" value="'.$drink['last_moved_by'].'"><br>';
        $html .= '<label for="last_moved_at">Last Moved At:</label><br>';
        $html .= '<input type="datetime-local" id="last_moved_at" name="last_moved_at" value="'.$drink['last_moved_at'].'"><br>';
        $html .= '<label for="image">Image:</label><br>';
        $html .= '<input type="file" name="image" accept="image/*"><br/><br/>';
        $html .= '<input type="submit" value="Save">';
        $html .= '</form>';

        $html .= '</section>';

        echo $html;
    }

}

?>
</body>
</html>
