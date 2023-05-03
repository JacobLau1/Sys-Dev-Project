<?php namespace views; ?>

<html>
<head>
    <style>
        #employeesTable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #employeesTable td, #employeesTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #employeesTable tr:nth-child(even){background-color: #f2f2f2;}

        #employeesTable tr:hover {background-color: #ddd;}

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

class UserEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($userModel = null) {
        echo '<br/>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=logout">Logout</a>';
        echo '<br/>';

        if ($userModel === null) {
            echo 'No user to display.';
            return;
        }


        // $html = '<table id="employeesTable">';
        // $html .= "<th>ID</th>
        //     <th>Position</th>
        //     <th>Username</th>
        //     ";

        // $html .=  "<tr>
        //     <td>".$userModel->getID()."</td>
        //     <td>".$userModel->getPosition()."</td>
        //     <td>".$userModel->getUsername()."</td>
        // </tr>";

        // $html .= "</table>";

        // // Form to edit the user
        // $html .= '<form action="" method="post">';
        // $html .= '<input type="hidden" id="id" name="id" value="'.$userModel->getID().'"><br>';
        // $html .= '<label for="position">Position:</label><br>';
        // $html .= '<input type="text" id="position" name="position" value="'.$userModel->getPosition().'"><br>';
        // $html .= '<label for="username">Username:</label><br>';
        // $html .= '<input type="text" id="username" name="username" value="'.$userModel->getUsername().'"><br>';

        $html = '<table id="employeesTable">';

        $html .= "<th>ID</th>
                <th>Position</th>
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
        $html .= '<label for="position">Position:</label><br>';
        $html .= '<input type="text" id="position" name="position" value="'.$userModel->getPosition().'"><br>';
        $html .= '<label for="username">Username:</label><br>';
        $html .= '<input type="text" id="username" name="username" value="'.$userModel->getUsername().'"><br>';
        $html .= '<label for="last_seen">Last Seen:</label><br>';
        $html .= '<input type="text" id="last_seen" name="last_seen" value="'.$userModel->getLastSeen().'"><br>';
        $html .= '<label for="date_hired">Date Hired:</label><br>';
        $html .= '<input type="text" id="date_hired" name="date_hired" value="'.$userModel->getDateHired().'"><br>';
        $html .= '<label for="date_fired">Date Fired:</label><br>';
        $html .= '<input type="text" id="date_fired" name="date_fired" value="'.$userModel->getDateFired().'"><br>';
        $html .= '<label for="working_status">Working Status:</label><br>';
        $html .= '<input type="text" id="working_status" name="working_status" value="'.$userModel->getWorkingStatus().'"><br>';
        $html .= '<label for="termination_reason">Termination Reason:</label><br>';
        $html .= '<input type="text" id="termination_reason" name="termination_reason" value="'.$userModel->getTerminationReason().'"><br>';
        $html .= '<label for="enable2fa">Enable 2-FA?</label>';
        $html .= '<input type="checkbox" id="enable2fa" name="enable2fa" value="true" '.($userModel->getEnabled2FA() ? 'checked' : '').'><br><br>';

        $html .= '<input type="submit" value="Submit">';
        $html .= '</form>';

        // Button to delete the user
        $html .= '<form action="" method="post">';
        $html .= '<input type="hidden" id="id" name="id" value="'.$userModel->getID().'"><br>';
        $html .= '<input type="submit" value="Terminate User">';
        $html .= '</form>';

        echo $html;





    }

}

?>
</body>
</html>
