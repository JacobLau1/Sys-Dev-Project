<?php namespace views; ?>

<html>
<head>
    <title>User Edit</title>
    <style>

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
            /* Centers the contents */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

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

class UserEdit {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($userModel = null) {
        echo '<br/>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=list">Back</a>';
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

        $html = '<section>';
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
        $html .= '<option value="0" '.($userModel->getWorkingStatus() == 0 ? 'selected' : '').'>0</option>';
        $html .= '<option value="1" '.($userModel->getWorkingStatus() == 1 ? 'selected' : '').'>1</option>';
        $html .= '</select><br>';
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
        $html .= '</section>';

        echo $html;

    }

}

?>
</body>
</html>
