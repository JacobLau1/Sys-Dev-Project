<?php namespace views;?>
<html>
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

<h1>User Registration</h1>
<form action="" method="post">
    <label for="position">Position:</label><br>
    <select id="position" name="position">
        <option value="waiter">Waiter</option>
        <option value="manager">Manager</option>
        <option value="admin">Admin</option>
    </select><br>
    <label for="first_name">First Name:</label><br>
    <input type="text" id="first_name" name="first_name"><br>
    <label for="full_name">Full Name:</label><br>
    <input type="text" id="full_name" name="full_name"><br>
    <label for="last_seen">Last Seen:</label><br>
    <input type="datetime-local" id="last_seen" name="last_seen"><br>
    <label for="date_fired">Date Fired:</label><br>
    <input type="date" id="date_fired" name="date_fired"><br>
    <label for="date_hired">Date Hired:</label><br>
    <input type="date" id="date_hired" name="date_hired"><br>
    <label for="working_status">Working Status:</label><br>
    <input type="text" id="working_status" name="working_status"><br>
    <label for="termination_reason">Termination Reason:</label><br>
    <input type="text" id="termination_reason" name="termination_reason"><br>
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <label for="enable2fa">Enable 2-FA?</label>
    <input type="checkbox" id="enable2fa" name="enable2fa" value="true"><br><br>
    <input type="submit" value="Register">
</form>

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