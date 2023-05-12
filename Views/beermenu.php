<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="./Styles/Menu.css">
</head>
<body>
<?php

class BeerMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($beers) {

        echo '<br/>';

        echo '<header>';
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection'>Back to menu selection</a>";

        echo '<br/>';

        echo '<br/>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=beer&action=add'>Add bottle</a>";

        echo '</header>';
        $html = '<h1>Beer Menu</h1>';
        $html .= '<section>';
        $html .= '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            <th>Edit</th>
            ";

        // Loop and fill the table with data from the database
        foreach ($beers as $beer) {
            $html .=  "<tr>
                <td>".$beer['id']."</td>
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
