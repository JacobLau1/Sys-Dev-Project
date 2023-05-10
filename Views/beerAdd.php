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

class BeerAdd {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render() {

        echo '<br/>';

        echo '<header>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=beer&action=menu'>Back to beer</a>";
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";

        echo '</header>';
        echo '<br/>';
        
        echo '<br/>';



        echo '<h1>Add Beer</h1>';
        echo '<section>';
        $html = '<form method="POST" action="http://localhost/Sys-Dev-Project/index.php?resource=beer&action=add">';
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
