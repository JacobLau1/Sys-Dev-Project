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
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <label for="enable2fa">Enable 2-FA?</label>
    <input type="checkbox" id="enable2fa" name="enable2fa" value="1"><br><br>
    <input type="submit" value="Register">
</form>


<?php

class UserCreate{

    private $user;

    function __construct($user){

        $this->user = $user;
        $enable2fa = isset($_POST['enable2fa']) && $_POST['enable2fa'] === 'true';
        //if there is no post for enable2fa, then post enable2fa = false
        if(isset($_POST['enable2fa'])){
            echo "enable2fa is false";
        }


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