<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
</head>
<body class="w3-theme-d5">
<?php

class SpiritEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($spirit = null) {
        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=menu" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu</a>';
        echo '</div>';
        echo '</nav>';


        if ($spirit === null) {
            echo 'No spirit to display.';
            return;
        }

        /* Table */
        $html = '';
        $html .= '<div class="w3-container w3-center" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">Spirit Menu</h1>';
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

        $html .= "</table>";

        // Form to edit the spirit
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$spirit['id'].'"><br>';
        $html .= '<input type="hidden" id="saq_code" name="saq_code" value="'.$spirit['saq_code'].'"><br>';
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

$html .= '</div>';





        $html .= '</section>';


        echo $html;
    }

}

?>
</body>
</html>
