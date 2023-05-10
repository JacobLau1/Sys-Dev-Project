<?php namespace views; ?>

<html>
<head>
    <style>

        header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            background-color: #113E30;
            color: white;
            padding: 4vh;
        }

        header a {
            color: white;
            text-decoration: none;

            /* When hovered turn the background red */
            transition: background-color 0.5s ease;
        }

        body {
            background-color: #18332B;
            display: flex;
            flex-direction: column;
            width: 100vw;
            height: 100vh;
            margin: 0;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: #eeeeee;
            text-decoration: underline;
        }

        section {
            background-color: #eeeeee;

            /* Centers the section */
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #eeeeee;
        }

        #employeesTable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #employeesTable td, #employeesTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #employeesTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #employeesTable tr:hover {
            background-color: #ddd;
        }

        #employeesTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
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
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection'>Back to menu selection</a>";
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";

        echo '<br/>';

        echo '<br/>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=add'>Add bottle</a>";
        echo '</header>';

        echo '<section>';
        $html = '<table id="employeesTable">';
        $html .= "<th>ID</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            <th>Edit</th>
            ";

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
