<?php namespace views; ?>
<html>
<head>
	<title>User Login</title>
	<style>
		body {
			background-image: url('login.png');
			background-size: cover;
            font-family: Arial, sans-serif;
		}
		h1 {
			text-align: center;
			margin-top: 100px;
			margin-bottom: 50px;
			font-size: 48px;
			color: #fff;
			text-shadow: 1px 1px 1px #000;
		}
		.box {
			background-color: rgba(255, 255, 255, 0.7);
			padding: 20px;
			width: 400px;
			margin: auto;
			border-radius: 10px;
			box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
		}
		h2 {
			text-align: center;
			margin-bottom: 20px;
			font-size: 24px;
			color: #000;
			text-shadow: 1px 1px 1px #000;
		}
		label {
			display: block;
			margin-bottom: 10px;
			font-size: 18px;
			color: #333;
		}
		input[type="text"], input[type="password"] {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
			border: none;
			background-color: #f2f2f2;
			font-size: 18px;
			color: #333;
		}
		input[type="submit"] {
			display: block;
			margin: auto;
			padding: 10px 20px;
			background-color: #fff;
			color: #888;
			border: none;
			border-radius: 5px;
			font-size: 18px;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #eee;
		}
	</style>
    </head>

<body>
<h1>MODAVIE</h1>
<div class="box">

<h2>Welcome!</h2>
<form action="" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>
</div>

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
            if ($this->user->getMembershipProvider()->isLoggedIn()) {
                if ($this->user->getEnabled2FA()) {
                    header('Location: index.php?resource=user&action=validatecode');
                    //   exit();
                } else {
                       header('Location: index.php?resource=user&action=menuselection');
                    //   exit();
                }
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