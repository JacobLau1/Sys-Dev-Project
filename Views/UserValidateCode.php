<?php namespace views;?>
    <html>
    <body>
    <h1>Enter your 2FA OTP code</h1>
    <form action="" method="post">
        <label for="twofacode">Code:</label><br>
        <input type="text" id="twofacode" name="twofacode"><br>
        <input type="submit" value="Submit">
    </form>
    </body>
    </html>

    <?php

class UserValidatecode{

    private $user;

    function __construct($user){

        $this->user = $user;
     //   echo "Username in user object: " . $this->user->getUsername() . "<br>";

        if(isset($_POST['twofacode'])){
            if($this->user->getOTPcodeisvalid()){
                $userMenu = new UserMenuselection($user);

                header('Location: http://localhost/Sys-Dev-Projectt/index.php?resource=user&action=menuselection');

            }else
                echo 'Invalid 2FA code, please try again.';
        }

    }

}

?>