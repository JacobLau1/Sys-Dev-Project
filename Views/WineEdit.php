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
            <td>".$wine['id']."</td>
            <td>".$wine['saq_code']."</td>
            <td>".$wine['type']."</td>
            <td>".$wine['name']."</td>
            <td>".$wine['format']."</td>
            <td>".$wine['price']."</td>
        </tr>";

        $html .= "</table>";

        // Form to edit the wine
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$wine['id'].'"><br>';
        $html .= '<input type="hidden" id="saq_code" name="saq_code" value="'.$wine['saq_code'].'"><br>';
        $html .= '<label for="type">Type:</label><br>';
        $html .= '<input type="text" id="type" name="type" value="'.$wine['type'].'"><br>';
        $html .= '<label for="name">Name:</label><br>';
        $html .= '<input type="text" id="name" name="name" value="'.$wine['name'].'"><br>';
        $html .= '<label for="format">Format:</label><br>';
        $html .= '<input type="text" id="format" name="format" value="'.$wine['format'].'"><br>';
        $html .= '<label for="price">Price:</label><br>';
        $html .= '<input type="text" id="price" name="price" value="'.$wine['price'].'"><br>';
        $html .= '<input type="submit" value="Submit">';
        $html .= '</form>';
        

        $html .= '</section>';


        echo $html;
    }

}

?>
</body>
</html>
