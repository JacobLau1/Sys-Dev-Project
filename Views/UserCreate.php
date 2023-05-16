<?php namespace views;?>
<html>
<head>
    <title>User Create</title>
    <style>
body, a, h1, #employeesTable td, #employeesTable th {
    color: white;
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

<!--
<h1>User Registration</h1>
<form action="" method="post">
    <label for="position">Position:</label><br>
    <select id="position" name="position">
        <option value="waiter">Waiter</option>
        <option value="manager">Manager</option>
        <option value="admin">Admin</option>
    </select><br>
    <label for="username">username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <label for="enable2fa"> Enable 2-FA?</label>
    <input type="checkbox" id="enable2fa" name="enable2fa" value="true"><br><br>
    <input type="submit" value="Register">
</form>
-->

<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>
<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=management'>Back to user management</a>

<h2>User Registration</h2>
<form id="registration-form" action="" method="POST">
    <label for="position">Position:</label><br>
    <select id="position" name="position">
        <option value="waiter">Waiter</option>
        <option value="manager">Manager</option>
        <option value="admin">Admin</option>
    </select><br>
    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name"><br>
    <label for="last_name">Last Name:</label><br>
    <input type="text" id="last_name" name="last_name"><br>
    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email"><br>
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <label for="enable2fa">Enable 2-FA?</label>
    <input type="checkbox" id="enable2fa" name="enable2fa" value="1"><br><br>
    <input type="submit" value="Register" name="submit" id="submit-button">
</form>
<script src="./SerializeRegistration.js"></script>


<?php

class UserCreate{

    private $user;

    function __construct($user){

        $this->user = $user;

        if($this->user->getEnabled2FA()){

            if($this->user->login()){

                $this->user->getMembershipProvider()->login();

                header("location: http://localhost/Sys-Dev-Project/index.php?resource=user&action=setuptwofa");

            }
        }
    }
}

?>

</body>
</html>