<?php namespace views; ?>

<html>
<head>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <script src="https://kit.fontawesome.com/99c47d5f92.js" crossorigin="anonymous"></script>
</head>
<body class="w3-theme-d5">
<?php

class DrinkLocation
{
    private $user;
    private $drink;

    public function __construct($user, $drink)
    {
        $this->user = $user;
        $this->drink = $drink;
    }

    public function render($location, $drink)
    {
        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu selection</a>';
        echo '</div>';
        echo '</nav>';

        /* Location and Drink Details */
        $html = '';
        $html .= '<div class="w3-container w3-center w3-round" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">Location Details</h1>';
        $html .= '<section class="w3-card w3-white">';
        $html .= '<table class="w3-table w3-striped w3-text-black">';
        $html .= '<tr class="w3-theme-d3">';
        $html .= '<th>Location ID</th>';
        $html .= '<th>Room</th>';
        $html .= '<th>Storage No</th>';
        $html .= '<th>Last Moved By</th>';
        $html .= '<th>Last Moved At</th>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>' . $location['location_id'] . '</td>';
        $html .= '<td>' . $location['room'] . '</td>';
        $html .= '<td>' . $location['storage_no'] . '</td>';
        $html .= '<td>' . $drink['last_moved_by_name'] . '</td>';
        $html .= '<td>' . $drink['last_moved_at'] . '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '</section>';
        $html .= '</div>';

        echo $html;
    }
}

?>
</body>
</html>
