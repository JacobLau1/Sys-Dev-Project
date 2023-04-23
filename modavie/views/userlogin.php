<?php namespace views;?>
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

<h2> Not registered?</h2>
<a href="http://localhost/modavie/index.php?resource=user&action=create">Register</a>

<?php

class UserLogin{

  private $user;

  private $userMessage;

  function __construct($user){

    $this->user = $user;

    if($this->user->login()){

      $this->user->getMembershipProvider()->login();

      // We could do an authorization check to validate that the user has access privileges to the resource or data

      if($this->user->getEnabled2FA())
       header('Location: http://localhost/modavie/index.php?resource=user&action=validatecode');
      else
        // We are assuming that the user has access to the employees list
        //header('Location: http://localhost/modavie/index.php?resource=employee&action=list'); old code
        header('Location: http://localhost/modavie/index.php?resource=user&action=menuselection');


        /*
          need to add if user and password belong to admin account, go to admin only page.



        */

    }else{

      $this->userMessage = 'You were not able to login, check your username and passowrd and try again.';

      $this->render();

    }
  }

  function render(){

    if(($this->user->getUsername() !== null) && ($this->user->getPassword() !== null))
      echo $this->userMessage;

  }
}

?>



</body>
</html>