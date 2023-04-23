<?php
namespace models;

require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

require(dirname(__DIR__)."/core/membershipprovider.php");

class Wine{

    private $id;
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

        $query = "INSERT INTO wine (type, name, format, price) VALUES(:type, :name, :format, :price)";

        $statement = $this->dbConnection->prepare($query);

        return $statement->execute(['type' => $this->type,'name' => $this->name, 'format' => $this->format,'price' => $this->price]);

    }

    function getWineByID($id){
        $query = "SELECT * FROM wine WHERE id = :id";

        $statement = $this->dbConnection->prepare($query);
        
        $statement->execute(['id'=> $id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, Wine::class);

       
    }

    function getAll(){

        $query = "select * from wine";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    function display(){
        echo "hi";

        
    }

    
    function add(){
        
    }

    
    function edit(){
        
    }

    
    function delete(){
        
    }

}

?>