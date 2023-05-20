<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
</head>
<body class="w3-theme-d5">
<?php

class DrinkAdd {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render() {

        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=drink&action=menu" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu</a>';
        echo '</div>';
        echo '</nav><br>';



        echo '<div class="w3-container w3-center" style="padding: 4rem" id="main">';

        echo '<h1>Add Drink</h1>';
        echo '<section class="w3-card w3-white">';
        $html = '<form method="POST" action="http://localhost/Sys-Dev-Project/index.php?resource=drink&action=add">';
        
        $html .= '<label for="alcohol_type">Alcohol Type:</label><br/>';
        $html .= '<select name="alcohol_type" required>';
        $html .= '<option value="wine">Wine</option>';
        $html .= '<option value="beer">Beer</option>';
        $html .= '<option value="spirit">Spirit</option>';
        $html .= '</select><br/><br/>';
        
        $html .= '<label for="saq_code">SAQ Code:</label><br/>';
        $html .= '<input type="text" name="saq_code" required><br/><br/>';

        $html .= '<label for="subtype">Subtype:</label><br/>';
        $html .= '<input type="text" name="subtype" required><br/><br/>';

        $html .= '<label for="name">Name:</label><br/>';
        $html .= '<input type="text" name="name" required><br/><br/>';

        $html .= '<label for="format">Format:</label><br/>';
        $html .= '<input type="text" name="format" required><br/><br/>';

        $html .= '<label for="price">Price:</label><br/>';
        $html .= '<input type="number" name="price" min="0" step="0.01" required><br/><br/>';


        $html .= '<input type="hidden" name="inventory_id" value="1">';


        $html .= '<label for="current_location">Current Location:</label><br/>';
        $html .= '<select name="current_location" required>';
        $html .= '<option value="1">1 - bar1</option>';
        $html .= '<option value="2">2 - bar2</option>';
        $html .= '<option value="3">3 - upstairs</option>';
        $html .= '<option value="4">4 - cellar</option>';
        $html .= '<option value="5">5 - fridge</option>';
        $html .= '</select><br/><br/>';

        $html .= '<label for="image">Image:</label><br/>';
        $html .= '<img src="wine.png" alt="Default Image" height="100" width="100"><br/>';
        $html .= '<input type="file" name="image" accept="image/*"><br/><br/>';
       
        
        
        $html .= '<input type="submit" name="submit" value="Add"><br/><br/>';
        $html .= "</form>";
        $html .= '</section>';
        $html .= '</div>';


        echo $html;
    }
}

?>
</body>
</html>
