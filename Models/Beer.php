<?php
namespace models;

require_once(dirname(__DIR__). DIRECTORY_SEPARATOR . "Core". DIRECTORY_SEPARATOR ."DBConnectionManager.php");

require(dirname(__DIR__). DIRECTORY_SEPARATOR  ."Core" . DIRECTORY_SEPARATOR . "MembershipProvider.php");

class Beer{

    private $id;
    private $saq_code;
    private $type;
    private $name;
    private $format;
    private $price;

    private $dbConnection;

    private $membershipProvider;

    function __construct(){

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        $this->membershipProvider = new \membershipprovider\MembershipProvider($this);

    }

    function create(){

        $query = "INSERT INTO beer (id, saq_code, type, name, format, price) VALUES(:id ,:saq_code, :type, :name, :format, :price)";

        $statement = $this->dbConnection->prepare($query);

        return $statement->execute(['id' => $this->id,'saq_code' => $this->saq_code,'type' => $this->type,'name' => $this->name, 'format' => $this->format,'price' => $this->price]);

    }

    function getBeerByID($id){
        $query = "select * from beer where ID = :id";

        $statement = $this->dbConnection->prepare($query);

        $statement->bindParam(":id", $id);

        $statement->execute();

        return $statement->fetch();
    }

    function getAll(){

        $query = "select * from beer";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    function setID($id){
        $this->id = $id;
    }

    function setType($type){
        $this->type = $type;
    }

    function setName($name){
        $this->name = $name;
    }

    function setFormat($format){
        $this->format = $format;
    }

    function setPrice($price){
        $this->price = $price;
    }

    function setSaqCode($saq_code){
        $this->saq_code = $saq_code;
    }

    function getID(){
        return $this->id;
    }

    function getType(){
        return $this->type;
    }

    function getName(){
        return $this->name;
    }

    function getFormat(){
        return $this->format;
    }

    function getPrice(){
        return $this->price;
    }

    function getSaqCode(){
        return $this->saq_code;
    }

    function update() {
        $query = "update beer set saq_code = :saq_code, type = :type, name = :name, format = :format, price = :price where ID = :id";
        $statement = $this->dbConnection->prepare($query);
        $statement->bindParam(":saq_code", $this->saq_code);
        $statement->bindParam(":type", $this->type);
        $statement->bindParam(":name", $this->name);
        $statement->bindParam(":format", $this->format);
        $statement->bindParam(":price", $this->price);
        $statement->bindParam(":id", $this->id);
        try {
            $success = $statement->execute();
        } catch (PDOException $e) {
            // handle the error
            echo "Update failed: " . $e->getMessage();
            return false;
        }

        // Print the executed SQL query
        echo "Executed query: " . $query . "<br/>";
        echo "With parameters: saq_code={$this->saq_code} ,type={$this->type}, name={$this->name}, format={$this->format}, price={$this->price}, id={$this->id}<br/>";

        return $success;
    }

    public function delete($id)
    {
        $query = "delete from beer where ID = :id";
        $statement = $this->dbConnection->prepare($query);
        $statement->bindParam(":id", $id);
        try {
            $success = $statement->execute();
        } catch (PDOException $e) {
            // handle the error
            echo "Delete failed: " . $e->getMessage();
            return false;
        }

        // Print the executed SQL query
        echo "Executed query: " . $query . "<br/>";
        echo "With parameters: id={$id}<br/>";

        return $success;
    }

    function getBeerByName($name){
        $query = "select * from beer where name = :name";

        $statement = $this->dbConnection->prepare($query);

        $statement->bindParam(":name", $name);

        $statement->execute();

        return $statement->fetchAll();
    }


}

?>