<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
</head>
<body class="w3-theme-d5">
<?php

class BeerMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($beers) {

        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu selection</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=beer&action=add" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add bottle</a>';
        echo '</div>';
        echo '</nav>';

        $html = '<h1>Beer Menu</h1>';
        $html .= '<section>';
        $html .= '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>SAQ Code</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            <th>Edit</th>
            ";

                // Add the search form
        $html .=     '<form method="post" action="http://localhost/Sys-Dev-Project/index.php?resource=beer&action=menu">';
            $html .= '<input type="text" name="name" placeholder="Search by beer name...">';
            $html .= '<input type="hidden" name="resource" value="beer">';
            $html .= '<input type="hidden" name="action" value="menu">';
            $html .= '<input type="submit" value="Search">';
            $html .= '</form>';
    

        // Loop and fill the table with data from the database
        foreach ($beers as $beer) {
            $html .=  "<tr>
                <td>".$beer['id']."</td>
                <td>".$beer['saq_code']."</td>
                <td>".$beer['type']."</td>
                <td>".$beer['name']."</td>
                <td>".$beer['format']."</td>
                <td>".$beer['price']."</td>
                <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=beer&action=edit&id=".$beer['id']."'>Edit</a></td>
            </tr>";
        }

        $html .= "</table>";
        $html .= '</section>';

        echo $html;
    }
}

?>
</body>
</html>
