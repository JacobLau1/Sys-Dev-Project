<?php

namespace database;

class DBConnectionManager{

    private $username;
    private $password;
    private $server; //Host
    private $dbname;

    private $dbConnection;

    function __construct(){

        // TODO: Set credentials as environment variables
        $this->username = "root";
        $this->password = "";
        $this->server = "localhost";
        $this->dbname = "modavie";

        try{

            $this->dbConnection = new \PDO("mysql:host=$this->server;dbname=$this->dbname", $this->username, $this->password);

        }catch(\PDOException $e){

            //TODO: Use logging
            // It is not a good practice to just output the error message to the user
            // The errors must be logged, and a user friednly message displayed
            // giving the user options on what to do as an alternative
            print "Error!: " . $e->getMessage() . "<br/>";

        }


    }

    function getConnection(){
        return $this->dbConnection;
    }


}

?>