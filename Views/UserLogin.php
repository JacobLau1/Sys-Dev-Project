<?php namespace views; ?>
<html>
<body>

<h1>User Login</h1>
<form action="" method="post">
    <label for="username">username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>


<?php

class UserLogin
{
    private $user;
    private $userMessage;

    function __construct($user)
    {
        $this->user = $user;

        if ($this->user->login()) {
            $this->user->getMembershipProvider()->login();
            if ($this->user->getEnabled2FA()) {
                header('Location: index.php?resource=user&action=validatecode');
             //   exit();
            } else {
                header('Location: index.php?resource=user&action=menuselection');
             //   exit();
            }
        } else {
            $this->userMessage = 'You were not able to login, check your username and password and try again.';
            $this->render();
        }


    }

    function render(){
        if (($this->user->getUsername() !== null) && ($this->user->getPassword() !== null))
            echo $this->userMessage;
    }
}

?>


</body>
</html>