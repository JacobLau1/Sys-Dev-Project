<?php namespace views;?>

<html>
    <body>
        <a style="float:right" href="http://localhost/modavie/index.php?resource=user&action=login">Logout</a>
        <a style="float:left" href="http://localhost/modavie/index.php?resource=waiter&action=registration">Back to waiter registration</a>  
        <br>
        <h2>Waiter Add Page</h2>
        <form action="" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password"><br>
            <label for="fname">First Name:</label><br>
            <input type="text" id="fname" name="fname"><br>
            <label for="lname">Last name:</label><br>
            <input type="text" id="lname" name="lname"><br>
            <label for="position">Position:</label><br>
            <input type="text" id="position" name="position"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>