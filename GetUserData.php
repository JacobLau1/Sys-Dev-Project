<?php


//create a new user
$user = new User('admin', 'admin');

//serialize the user object
$userData = $user->serialize();

// Set the content type to JSON
header('Content-Type: application/json');

// Output the serialized user data as JSON
echo $userData;