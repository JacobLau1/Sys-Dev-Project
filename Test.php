<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Object Injection</title>
</head>
<body>
<h1>PHP Object Injection</h1>

<h2>User Registration</h2>
<form id="registration-form" action="" method="post">
    <label for="position">Position:</label><br>
    <select id="position" name="position">
        <option value="waiter">Waiter</option>
        <option value="manager">Manager</option>
        <option value="admin">Admin</option>
    </select><br>
    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name"><br>
    <label for="last_name">Last Name:</label><br>
    <input type="text" id="last_name" name="full_name"><br>
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <label for="enable2fa">Enable 2-FA?</label>
    <input type="checkbox" id="enable2fa" name="enable2fa" value="1"><br><br>
    <input type="submit" value="Register">
</form>
<script src="SerializeRegistration.js"></script>
<?php

class UserCreate
{

    private $user;

    function __construct($user)
    {

        $this->user = $user;

        if ($this->user->getEnabled2FA()) {

            if ($this->user->login()) {

                $this->user->getMembershipProvider()->login();

                header("location: http://localhost/Sys-Dev-Project/index.php?resource=user&action=setuptwofa");

            }
        }
    }
}

?>
</body>
</html>

