<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="./Styles/Menu.css">
</head>
<body>
<?php

class SpiritMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($spirits) {

        echo '<br/>';

        echo '<header>';
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection'>Back to menu selection</a>";

        echo '<br/>';

        echo '<br/>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=add'>Add bottle</a>";

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
