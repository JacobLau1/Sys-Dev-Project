<?php namespace views; ?>

<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <title>User Create</title>
</head>
<body class="w3-theme-d5">

<nav>
    <div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">
        <a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=login" class="w3-bar-item w3-button w3-theme-d3">Logout</a>
        <a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=management" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to user management</a>
    </div>
</nav>

<div class="w3-container w3-center" style="padding: 4rem" id="main">
    <h2 class="center white-text">User Registration</h2>
    <section class="w3-card w3-white">
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
    </section>
</div>

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
