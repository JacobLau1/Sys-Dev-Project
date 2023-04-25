<?php
namespace models;
    // __DIR__ -> this predefined constant gives the path to the current directory containing this file
    // __DIR__ -> c:\xampp\htdocs\modavie\models\

    // dirname() -> a predefined function in PHP that returns the parent directory path of the parameter

    // dirname(__DIR__) -> c:\xampp\htdocs\modavie

    require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

class Employee{

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

        $query = "select * from employees";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

}

// TDD: Test driven development
// Test the code before you continue

// TEST 
// $employee = new Employee();

// $employees = $employee->getAll();

// var_dump($employees);


?>