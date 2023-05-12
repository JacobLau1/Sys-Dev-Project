<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
</head>
<body class="w3-theme-d5">
<?php

class WineAdd {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render() {

        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=wine&action=menu" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu</a>';
        echo '</div>';
        echo '</nav>';




        echo '<h1>Add Wine</h1>';
        echo '<section>';
        $html = '<form method="POST" action="http://localhost/Sys-Dev-Project/index.php?resource=wine&action=add">';
        $html .= '<label for="type">Type:</label><br/>';
        $html .= '<input type="text" name="type" required><br/><br/>';
        
        $html .= '<label for="name">Name:</label><br/>';
        $html .= '<input type="text" name="name" required><br/><br/>';
        
        $html .= '<label for="format">Format:</label><br/>';
        $html .= '<input type="text" name="format" required><br/><br/>';
        
        $html .= '<label for="price">Price:</label><br/>';
        $html .= '<input type="number" name="price" min="0" step="0.01" required><br/><br/>';
        
        $html .= '<input type="submit" name="submit" value="Add"><br/><br/>';
        $html .= "</form>";
        $html .= '</section>';
        

        echo $html;
    }
}

?>
</body>
</html>
