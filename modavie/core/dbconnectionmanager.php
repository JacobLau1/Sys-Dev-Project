<?php

namespace database;

class DBConnectionManager{

    private $username;
    private $password;
    private $server; //Host
    private $dbname;

    private $dbConnection;

    // In PHP supporting multiple constructors is not out of the box
    // you would implement the default constructor with variable number of parameters
    // then you call the specific constructor based on the receives parameters
/*
    function __construct(...$params){

            // check the $params
            // call the specific parametrized constructor

    }

    DBConnectionManager(){


    }

    DBConnectionManager($username){

    }

*/

    function __construct(){

        // TODO: Set credentials as environment variables
        // Normally we do not set the username and password directly here
        // for security reasons
        $this->username = "root"; //NOTE: usually you do not use the root account you create another user
        $this->password = "";
        $this->server = "localhost";
        $this->dbname = "modavie";

        // There two libraries to use for database connection: MySQLi and PDO
        // PDO supports the connection to databases other than MySQL
        // Which one to choose is specific to the appllication beeing developed

        // We have a high risk of failure, it is good to use a try{} ctach statement
        try{
        
            $this->dbConnection = new \PDO("mysql:host=$this->server;dbname=$this->dbname", $this->username, $this->password);

        }catch(\PDOException $e){

            //TODO: Use logging
            // It is not a good practice to just output the error message to the user
            // The errors must be logged, and a user friednly message displayed
            // giving the user options on what to do as an alternative
            print "Error!: " . $e->getMessage() . "<br/>";

        }


    }// End constructor

    function getConnection(){

        return $this->dbConnection;

    }


}

?>