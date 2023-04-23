<?php
namespace models;

    require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

class Waiter{

    private $id;
    private $name;
    private $phone;
    private $email;

    private $dbConnection;

    function __construct(){

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

    }

    function getAll(){

        $query = "select * from waiters";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

}



?>