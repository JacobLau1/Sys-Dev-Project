<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <title>User Edit</title>
</head>
<body class="w3-theme-d5">
<?php

class UserEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function render($userModel = null) {
        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">UserEdit</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=list" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to list</a>';
        echo '</div>';
        echo '</nav>';

        if ($userModel === null) {
            echo 'No user to display.';
            return;
        }

        /* Form */
        $html = '';
        $html .= '<div class="w3-container w3-center" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">User Edit</h1>';
        $html .= '<section class="w3-card w3-white">';
        $html .= '<table id="employeesTable">';

        $html .= "<th>ID</th>
                <th>Position</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Last Seen</th>
                <th>Date Hired</th>
                <th>Date Fired</th>
                <th>Working Status</th>
                <th>Termination Reason</th>
                <th>2FA Enabled</th>";

        $html .= "<tr>
                <td>".$userModel->getID()."</td>
                <td>".$userModel->getPosition()."</td>
                <td>".$userModel->getFirstName()."</td>
                <td>".$userModel->getLastName()."</td>
                <td>".$userModel->getUsername()."</td>
                <td>".$userModel->getLastSeen()."</td>
                <td>".$userModel->getDateHired()."</td>
                <td>".$userModel->getDateFired()."</td>
                <td>".$userModel->getWorkingStatus()."</td>
                <td>".$userModel->getTerminationReason()."</td>
                <td>".$userModel->getEnabled2FA()."</td>
                </tr>";
        $html .= "</table>";

        // Form to edit the user
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$userModel->getID().'"><br>';
        $html .= '
                <label for="position">Position:</label><br>
                    <select id="position" name="position">
                        <option value="waiter">Waiter</option>
                        <option value="manager">Manager</option>
                        <option value="admin">Admin</option>
                    </select><br>';
        $html .= '<label for="first_name">First Name:</label><br>';
        $html .= '<input type="text" id="first_name" name="first_name" value="'.$userModel->getFirstName().'"><br>';
        $html .= '<label for="last_name">Last Name:</label><br>';
        $html .= '<input type="text" id="last_name" name="last_name" value="'.$userModel->getLastName().'"><br>';
        $html .= '<label for="username">Username:</label><br>';
        $html .= '<input type="text" id="username" name="username" value="'.$userModel->getUsername().'"><br>';
        $html .= '<input type="hidden" id="last_seen" name="last_seen" value="'.$userModel->getLastSeen().'"><br>';
        $html .= '<input type="hidden" id="date_hired" name="date_hired" value="'.$userModel->getDateHired().'"><br>';
        $html .= '<label for="date_fired">Date Fired:</label><br>';
        $html .= '<input type="date" id="date_fired" name="date_fired" value="'.$userModel->getDateFired().'"><br>';
        $html .= '<label for="working_status">Working Status:</label><br>';
        $html .= '<select id="working_status" name="working_status">';
        $html .= '<option value="0" '.($userModel->getWorkingStatus() == 0 ? 'selected' : '').'>Not Working</option>';
        $html .= '<option value="1" '.($userModel->getWorkingStatus() == 1 ? 'selected' : '').'>Working</option>';
        $html .= '</select><br>';
        $html .= '<label for="termination_reason">Termination Reason:</label><br>';
        $html .= '<input type="text" id="termination_reason" name="termination_reason" value="'.$userModel->getTerminationReason().'"><br>';
        $html .= '<label for="enable2fa">Enable 2-FA?</label>';
        $html .= '<input type="checkbox" id="enable2fa" name="enable2fa" value="true" '.($userModel->getEnabled2FA() ? 'checked' : '').'><br><br>';

        $html .= '<input type="submit" value="Submit">';
        $html .= '</form>';

        $html .= '</section>';

        echo $html;

    }

}

?>
</body>
</html>
