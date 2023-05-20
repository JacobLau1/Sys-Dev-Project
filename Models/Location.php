<?php
namespace models;


require_once(dirname(__DIR__). DIRECTORY_SEPARATOR ."Core" . DIRECTORY_SEPARATOR ."DBConnectionManager.php");

class Location {

    private $location_id;
    private $room;
    private $storage_no;

    private $dbConnection;

    public function __construct() {
        $conManager = new \database\DBConnectionManager();
        $this->dbConnection = $conManager->getConnection();
    }

    public function getLocationByID($location_id) {
        $query = "SELECT * FROM location WHERE location_id = :location_id";
        $statement = $this->dbConnection->prepare($query);
        $statement->bindParam(":location_id", $location_id);
        $statement->execute();
        return $statement->fetch();
    }

    // Additional methods can be added as per your requirements

    // Setter methods
    public function setLocationID($location_id) {
        $this->location_id = $location_id;
    }

    public function setRoom($room) {
        $this->room = $room;
    }

    public function setStorageNo($storage_no) {
        $this->storage_no = $storage_no;
    }

    // Getter methods
    public function getLocationID() {
        return $this->location_id;
    }

    public function getRoom() {
        return $this->room;
    }

    public function getStorageNo() {
        return $this->storage_no;
    }
}
?>
