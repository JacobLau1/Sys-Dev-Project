<?php namespace views; ?>

<html>
<body>
<?php

class WineAdd {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render() {

        echo '<br/>';

        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=wine&action=menu'>Back to wine</a>";
        echo "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";

        echo '<br/>';
        
        echo '<br/>';



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
        

        echo $html;
    }
}

?>
</body>
</html>
