<?php

namespace models;

require_once(dirname(__DIR__) . "/core/DBConnectionManager.php");

require(dirname(__DIR__) . "/core/membershipprovider.php");

class User
{

    private $id;
    private $position;
    private $username;
    private $password;
    private $enabled2fa = false;
    private $otpsecretkey;

    private $otpcodeisvalid;

    private $dbConnection;

    private $membershipProvider;

    function __construct()
    {

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        $this->membershipProvider = new \membershipprovider\MembershipProvider($this);

    }

    function create()
    {
        $query = "INSERT INTO users (position, username, password, enabled2fa) VALUES(:position, :username, :password, :enabled2fa)";
        $statement = $this->dbConnection->prepare($query);
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        return $statement->execute(['position' => $this->position, 'username' => $this->username, 'password' => $hashedPassword, 'enabled2fa' => $this->enabled2fa]);
    }

    function login()
    {

        // Get the password from the DB
        $verified = false;
        $dbPassword = $this->getPasswordByUsername();

        if (password_verify($this->password, $dbPassword)) {
            $verified = true;
        }

        return $verified;

    }

    function logout()
    {

        $this->membershipProvider->logout();

    }

    function menuselection()
    {
        return $this;
    }


    function getPasswordByUsername()
    {

        $query = "SELECT password FROM users WHERE username = :username";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['username' => $this->username]);

        return $statement->fetchColumn(0);

    }

    function getUserByUsername($username)
    {

        $query = "SELECT * FROM users WHERE username = :username";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['username' => $username]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, User::class);

    }

    public function setuptwofa()
    {

        $this->otpsecretkey = $this->membershipProvider->generateSecretKey();

        $this->saveotpSecretKey();

    }

    private function saveotpSecretKey()
    {

        $query = "UPDATE users SET otpsecretkey = :otpsecretkey WHERE id = :id";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['otpsecretkey' => $this->otpsecretkey, 'id' => $this->id]);

    }

    public function validatecode($twofacode)
    {

        $this->otpcodeisvalid = $this->membershipProvider->verifyCode($this->otpsecretkey, $twofacode);

    }

    public function getid()
    {

        return $this->id;

    }

    public function setid($id)
    {

        $this->id = $id;

    }

    public function getPosition()
    {

        return $this->position;

    }

    public function setPosition($position)
    {

        $this->position = $position;

    }

    public function setUsername($username)
    {

        $this->username = $username;

    }

    public function getUsername()
    {

        return $this->username;

    }


    public function getPassword()
    {

        return $this->password;

    }

    public function setPassword($password)
    {

        $this->password = $password;

    }

    public function getMembershipProvider()
    {

        return $this->membershipProvider;

    }

    public function setEnabled2FA($enabled2fa)
    {
        $this->enabled2fa = $enabled2fa;
    }

    public function getEnabled2FA()
    {
        return $this->enabled2fa;
    }

    public function getOTPsecretkey()
    {

        return $this->otpsecretkey;

    }

    public function getOTPcodeisvalid()
    {

        return $this->otpcodeisvalid;

    }

    function getAll()
    {

        $query = "select * from users";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    function update(){

            $query = "UPDATE users SET position = :position, username = :username, password = :password, enabled2fa = :enabled2fa WHERE id = :id";

            $statement = $this->dbConnection->prepare($query);

            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

            return $statement->execute(['position' => $this->position, 'username' => $this->username, 'password' => $hashedPassword, 'enabled2fa' => $this->enabled2fa, 'id' => $this->id]);

    }

    public function getUserByID($id)
    {

            $query = "SELECT * FROM users WHERE id = :id";

            $statement = $this->dbConnection->prepare($query);

            $statement->execute(['id' => $id]);

            return $statement->fetchAll(\PDO::FETCH_CLASS, User::class);

    }

}

?>