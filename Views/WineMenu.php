<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="./Styles/Menu.css">
</head>
<body>
<?php

class WineMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($wines) {

        echo '<br/>';

        echo '<header>';
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection'>Back to menu selection</a>";

        echo '<br/>';

        echo '<br/>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=wine&action=add'>Add bottle</a>";

        echo '</header>';
        $html = '<h1>Wine Menu</h1>';
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
        foreach ($wines as $wine) {
            $html .=  "<tr>
                <td>".$wine['id']."</td>
                <td>".$wine['type']."</td>
                <td>".$wine['name']."</td>
                <td>".$wine['format']."</td>
                <td>".$wine['price']."</td>
                <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=wine&action=edit&id=".$wine['id']."'>Edit</a></td>
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
