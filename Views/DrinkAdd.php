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
        echo '</nav>';




        echo '<h1>Add Drink</h1>';
        echo '<section>';
        $html = '<form method="POST" action="http://localhost/Sys-Dev-Project/index.php?resource=drink&action=add">';

        $html .= '<label for="drink_id">Drink ID:</label><br/>';
        $html .= '<input type="text" name="drink_id" required><br/><br/>';
        
        $html .= '<label for="alcohol_type">Alcohol Type:</label><br/>';
        $html .= '<select name="alcohol_type" required>';
        $html .= '<option value="wine">Wine</option>';
        $html .= '<option value="beer">Beer</option>';
        $html .= '<option value="spirit">Spirit</option>';
        $html .= '</select><br/><br/>';
        
        $html .= '<label for="inventory_id">Inventory ID:</label><br/>';
        $html .= '<input type="text" name="inventory_id" required><br/><br/>';
        
        $html .= '<label for="current_location">Current Location:</label><br/>';
        $html .= '<input type="text" name="current_location" required><br/><br/>';
        
        $html .= '<label for="last_moved_by">Last Moved By:</label><br/>';
        $html .= '<input type="text" name="last_moved_by" required><br/><br/>';
        
        $html .= '<label for="last_moved_at">Last Moved At:</label><br/>';
        $html .= '<input type="datetime-local" name="last_moved_at" required><br/><br/>';
        
        $html .= '<label for="image">Image:</label><br/>';
        $html .= '<img src="wine.png" alt="Default Image" height="100" width="100"><br/>';
        $html .= '<input type="file" name="image" accept="image/*"><br/><br/>';
       
        
        
        $html .= '<input type="submit" name="submit" value="Add"><br/><br/>';
        $html .= "</form>";
        $html .= '</section>';
        

        echo $html;
    }
}

?>
</body>
</html>
