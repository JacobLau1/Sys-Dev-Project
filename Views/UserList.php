<?php namespace views; ?>
<html>
<head>
    <title>User List</title>
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

        echo '<br/>';

        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=login">Logout</a>';
        echo "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=management'>Back to user management</a>";
        echo '<br/>';

        echo '<h1>Employee List</h1>';

        //     $html = '<table id="employeesTable">';
        //     $html .= "<th>ID</th>
        //           <th>Position</th>
        //           <th>Username</th>
        //           <th>2FA Enabled</th>
        //           <th>Edit</th>
        //   ";

        //     // Loop and fill the table with data from the database
        //     foreach ($users as $user) {
        //         $html .=  "<tr>
        //         <td>".$user['id']."</td>
        //         <td>".$user['position']."</td>
        //         <td>".$user['username']."</td>
        //         <td>".$user['enabled2fa']."</td>
        //         <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=edit&id=".$user['id']."'>Edit</a></td>
        //     </tr>";
        //     }

        //     $html .= "</table>";

        //     echo $html;

        $html = '';
        $html .= '<section>';
        $html .= '<table id="employeesTable">';
        $html .= "<th>ID</th>
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
            <th>Edit</th>";

   // Add the search form
   $html .=     '<form method="post" action="http://localhost/Sys-Dev-Project/index.php?resource=user&action=list">';
    $html .= '<input type="text" name="usernamesearch" placeholder="Search by username...">';
    $html .= '<input type="hidden" name="resource" value="user">';
    $html .= '<input type="hidden" name="action" value="list">';
    $html .= '<input type="submit" value="Search">';
    $html .= '</form>';

// Loop and fill the table with data from the database

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
        <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=edit&id=" . $user['id'] . "'>Edit</a></td>
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