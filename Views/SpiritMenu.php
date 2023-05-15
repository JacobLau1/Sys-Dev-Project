<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
</head>
<body class="w3-theme-d5">
<?php

class SpiritMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($spirits) {

        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu selection</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=add" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add bottle</a>';
        echo '</div>';
        echo '</nav>';


        echo '</header>';
        $html = '<h1>Spirit Menu</h1>';
        $html .= '<section>';
        $html .= '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            <th>Edit</th>
            ";

        // Add the search form
        $html .=     '<form method="post" action="http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=menu">';
            $html .= '<input type="text" name="name" placeholder="Search by spirit name...">';
            $html .= '<input type="hidden" name="resource" value="spirit">';
            $html .= '<input type="hidden" name="action" value="menu">';
            $html .= '<input type="submit" value="Search">';
            $html .= '</form>';

        // Loop and fill the table with data from the database
        foreach ($spirits as $spirit) {
            $html .=  "<tr>
                <td>".$spirit['id']."</td>
                <td>".$spirit['type']."</td>
                <td>".$spirit['name']."</td>
                <td>".$spirit['format']."</td>
                <td>".$spirit['price']."</td>
                <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=edit&id=".$spirit['id']."'>Edit</a></td>
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
