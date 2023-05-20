<?php
namespace models;

require_once(dirname(__DIR__). DIRECTORY_SEPARATOR ."Core" . DIRECTORY_SEPARATOR ."DBConnectionManager.php");

require(dirname(__DIR__). DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "MembershipProvider.php");

class Drink{

    private $drink_id;
    private $name;
    private $alcohol_type;
    private $subtype;
    private $saq_code;
    private $inventory_id;
    private $current_location;
    private $last_moved_by;
    private $last_moved_by_name;
    private $last_moved_at;
    private $format;
    private $price;
    private $image;

    private $dbConnection;

    private $membershipProvider;

    function __construct(){

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        $this->membershipProvider = new \membershipprovider\MembershipProvider($this);

    }

    function create(){

        $query = "INSERT INTO drink (name, alcohol_type, subtype, saq_code, inventory_id, current_location, last_moved_by, last_moved_at, format, price, image) VALUES(:name, :alcohol_type, :subtype, :saq_code, :inventory_id, :current_location, :last_moved_by, :last_moved_at, :format, :price, :image)";

        $statement = $this->dbConnection->prepare($query);

        return $statement->execute([
            'name' => $this->name,
            'alcohol_type' => $this->alcohol_type,
            'subtype' => $this->subtype,
            'saq_code' => $this->saq_code,
            'inventory_id' => $this->inventory_id,
            'current_location' => $this->current_location,
            'last_moved_by' => $this->last_moved_by,
            'last_moved_at' => $this->last_moved_at,
            'format' => $this->format,
            'price' => $this->price,
            'image' => $this->image,
        ]);
    }

    function getDrinkByDrinkID($drink_id){
        $query = "SELECT d.*, CONCAT(u.first_name, ' ', u.last_name) AS last_moved_by_name FROM drink d LEFT JOIN users u ON d.last_moved_by = u.id WHERE drink_id = :drink_id";
        $statement = $this->dbConnection->prepare($query);

        $statement->bindParam(":drink_id", $drink_id);

        $statement->execute();

        $drink = $statement->fetch();

        $this->last_moved_by_name = $drink['last_moved_by_name'];

        return $drink;
    }

    public function getLastMovedByName() {
        return $this->last_moved_by_name;
    }
    
    function getAll(){

        $query = "select * from drink";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }
    // setter methods
    public function setDrinkID($drink_id) {
        $this->drink_id = $drink_id;
    }

    public function setAlcoholType($alcohol_type) {
        $this->alcohol_type = $alcohol_type;
    }

    public function setSaqCode($saq_code) {
        $this->saq_code = $saq_code;
    }

    public function setInventoryId($inventory_id) {
        $this->inventory_id = $inventory_id;
    }

    public function setCurrentLocation($current_location) {
        $this->current_location = $current_location;
    }

    public function setLastMovedBy($last_moved_by) {
        $this->last_moved_by = $last_moved_by;
    }

    public function setLastMovedAt($last_moved_at) {
        $this->last_moved_at = $last_moved_at;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    // getter methods
    public function getDrinkID() {
        return $this->drink_id;
    }

    public function getAlcoholType() {
        return $this->alcohol_type;
    }

    public function getSaqCode() {
        return $this->saq_code;
    }

    public function getInventoryId() {
        return $this->inventory_id;
    }

    public function getCurrentLocation() {
        return $this->current_location;
    }

    public function getLastMovedBy() {
        return $this->last_moved_by;
    }

    public function getLastMovedAt() {
        return $this->last_moved_at;
    }

    public function getImage() {
        return $this->image;
    }

    function update() {
        $query = "update drink set alcohol_type = :alcohol_type, saq_code = :saq_code, current_location = :current_location, last_moved_by = :last_moved_by, last_moved_at = :last_moved_at, image = :image where ID = :drink_id";
        $statement = $this->dbConnection->prepare($query);
        $statement->bindParam(":alcohol_type", $this->alcohol_type);
        $statement->bindParam(":saq_code", $this->saq_code);
        $statement->bindParam(":inventory_id", $this->inventory_id);
        $statement->bindParam(":current_location", $this->current_location);
        $statement->bindParam(":last_moved_by", $this->last_moved_by);
        $statement->bindParam(":last_moved_at", $this->last_moved_at);
        $statement->bindParam(":image", $this->image);
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
        echo "With parameters: drink_id={$this->drink_id}, alcohol_type={$this->alcohol_type},saq_code={$this->saq_code}, inventory_id={$this->inventory_id}, current_location={$this->current_location}, last_moved_by={$this->last_moved_by}, last_moved_at={$this->last_moved_at}, image={$this->image}, id={$this->id}<br/>";
    
        return $success;
    }
    

    public function delete($drink_id)
    {
        $query = "delete from drink where drink_id = :drink_id";
        $statement = $this->dbConnection->prepare($query);
        $statement->bindParam(":drink_id", $drink_id);
        try {
            $success = $statement->execute();
        } catch (PDOException $e) {
            // handle the error
            echo "Delete failed: " . $e->getMessage();
            return false;
        }
    
        // Print the executed SQL query
        echo "Executed query: " . $query . "<br/>";
        echo "With parameters: drink_id={$drink_id}<br/>";
    
        return $success;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setSubType($subtype) {
        $this->subtype = $subtype;
    }

    public function getSubType() {
        return $this->subtype;
    }

    public function setFormat($format) {
        $this->format = $format;
    }

    public function getFormat() {
        return $this->format;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }

    function getWines(){
        $query = "select * from drink where alcohol_type = 'wine'";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();
    }

    function getBeers(){
        $query = "select * from drink where alcohol_type = 'beer'";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();
    }

    function getSpirits(){
        $query = "select * from drink where alcohol_type = 'spirit'";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();
    }




    // function getDrinkByName($name){
    //     $query = "select * from drink where name = :name";

    //     $statement = $this->dbConnection->prepare($query);

    //     $statement->bindParam(":name", $name);

    //     $statement->execute();

    //     return $statement->fetchAll();
    // }

    // function getDrinkBySaqCode($saq_code){
    //     $query = "select * from drink where saq_code = :saq_code";

    //     $statement = $this->dbConnection->prepare($query);

    //     $statement->bindParam(":saq_code", $saq_code);

    //     $statement->execute();

    //     return $statement->fetchAll();
    // }

}

?>