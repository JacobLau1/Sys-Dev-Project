<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <title>User List</title>
</head>
<body class="w3-theme-d5">
<?php

class UserList
{

    private $user;

    private $welcomeMessage;

    public function __construct($user)
    {

        $this->user = $user;

    }

    public function render($users)
    {
        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">UserEdit</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=management" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to management</a>';
        echo '</div>';
        echo '</nav>';

        /* Table */

        $html = '<div class="w3-container w3-center w3-round" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">Wine Menu</h1>';
        $html .= '<section class="w3-card w3-white">';
        $html .= "<form method='post' action='http://localhost/Sys-Dev-Project/index.php?resource=user&action=list' class='w3-bar'>";
        $html .= "<input type='text' name='usernamesearch' placeholder='Search by username...' class='w3-bar-item w3-input w3-white w3-mobile'>";
        $html .= "<input type='hidden' name='resource' value='user'>";
        $html .= "<input type='hidden' name='action' value='list'>";
        $html .= "<input type='submit' value='Search' class='w3-bar-item w3-button w3-mobile'>";
        $html .= "</form>";
        $html .= "<table class='w3-table w3-striped w3-text-black'>";
        $html .= "<thead><tr>
            <th>ID</th>
            <th>Position</th>
            <th>Username</th>
            <th>2FA Enabled</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Last Seen</th>
            <th>Date Hired</th>
            <th>Working Status</th>
            <th>Date Fired</th>
            <th>Termination Reason</th>
            <th>Edit</th>
            </tr></thead>";

        // Add the search form


        foreach ($users as $user) {
            $html .= "<tr>
            <td>" . $user['id'] . "</td>
            <td>" . $user['position'] . "</td>
            <td>" . $user['username'] . "</td>
            <td>" . $user['enabled2fa'] . "</td>
            <td>" . $user['first_name'] . "</td>
            <td>" . $user['last_name'] . "</td>
            <td>" . $user['last_seen'] . "</td>
            <td>" . $user['date_hired'] . "</td>
            <td>" . $user['working_status'] . "</td>
            <td>" . $user['date_fired'] . "</td>
            <td>" . $user['termination_reason'] . "</td>
            <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=edit&id=" . $user['id'] . "' class='w3-button w3-small w3-theme-d3'>Edit</a></td>
            </tr>";
        }

        $html .= "</table>";
        $html .= '</section>';
        $html .= '</div>';
        echo $html;

    }

}
?>

</body>
</html>
