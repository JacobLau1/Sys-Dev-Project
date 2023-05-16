<?php

namespace models;

use Delight\Auth\AuthError;
use Delight\Auth\DuplicateUsernameException;

require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "DBConnectionManager.php");

require(dirname(__DIR__) . DIRECTORY_SEPARATOR . "Core" . DIRECTORY_SEPARATOR . "MembershipProvider.php");


class User
{

    private $id;
    private $position;
    private $first_name;
    private $last_name;
    private $last_seen;
    private $date_fired;
    private $date_hired;
    private $working_status;
    private $termination_reason;
    private $username;
    private $password;
    private $enabled2fa = false;
    private $otpsecretkey;

    private $otpcodeisvalid;

    private $dbConnection;

    private $membershipProvider;
    private $email;

    function __construct()
    {

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        $this->membershipProvider = new \membershipprovider\MembershipProvider($this);

    }

    function create()
    {


        $query = "INSERT INTO users (
                        position, first_name, last_name, last_seen, date_fired, date_hired,
                        working_status, termination_reason, username, password, enabled2fa) 
                    VALUES (
                        :position, :first_name, :last_name, :last_seen, :date_fired, :date_hired,
                        :working_status, :termination_reason, :username, :password, :enabled2fa)";
        $statement = $this->dbConnection->prepare($query);
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        return $statement->execute([
            'position' => $this->position, 'first_name' => $this->first_name,
            'last_name' => $this->last_name, 'last_seen' => $this->last_seen,
            'date_fired' => $this->date_fired, 'date_hired' => $this->date_hired,
            'working_status' => $this->working_status, 'termination_reason' => $this->termination_reason,
            'username' => $this->username, 'password' => $hashedPassword, 'enabled2fa' => $this->enabled2fa]);
        
    }

    function login()
    {
      //  echo "User Class Login Function Called <br/>";

        // Get the password from the DB
        $verified = false;
        $dbPassword = $this->getPasswordByUsername();

      //  echo "DB Password: " . $dbPassword . "<br/>";
      //  echo "Password: " . $this->password . "<br/>";
        $info = password_get_info($dbPassword);
     //   echo "Password Info: <br/>";
      //  echo "<br/>";
      //  var_dump($info);
      // echo "<br/>";
      //  echo "<br/>";
        $info = password_get_info($dbPassword);
      //  echo "Hashing algorithm: " . $info['algo'] . "<br>";

        if (password_verify($this->password, $dbPassword)) {
      //      echo "Password Verified <br/>";
            $verified = true;
        } else {
      //      echo "Password NOT Verified <br/>";
        }

        // use the bcrypt algorithm to hash the password with a cost of 10
        $hash = password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 10]);
      //  echo "Hash: " . $hash . "<br/>";

        ////// remove the = true later
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

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastSeen($lastSeen)
    {
        $this->last_seen = $lastSeen;
    }

    public function getLastSeen()
    {
        return $this->last_seen;
    }

    public function setDateFired($dateFired)
    {
        $this->date_fired = $dateFired;
    }

    public function getDateFired()
    {
        return $this->date_fired;
    }

    public function setDateHired($dateHired)
    {
        $this->date_hired = $dateHired;
    }

    public function getDateHired()
    {
        return $this->date_hired;
    }

    public function setWorkingStatus($workingStatus)
    {
        $this->working_status = $workingStatus;
    }

    public function getWorkingStatus()
    {
        return $this->working_status;
    }

    public function setTerminationReason($terminationReason)
    {
        $this->termination_reason = $terminationReason;
    }

    public function getTerminationReason()
    {
        return $this->termination_reason;
    }

    public function getEmail()
    {
        return $this->email;
    }

    function getAll()
    {

        $query = "select * from users";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    function update()
    {

        $query = "UPDATE users SET position = :position, email = :email ,username = :username, password = :password, enabled2fa = :enabled2fa WHERE id = :id";

        $statement = $this->dbConnection->prepare($query);

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        return $statement->execute(['position' => $this->position, 'email' => $this->email,'username' => $this->username, 'password' => $hashedPassword, 'enabled2fa' => $this->enabled2fa, 'id' => $this->id]);

    }

    public function getUserByID($id)
    {

        $query = "SELECT * FROM users WHERE id = :id";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['id' => $id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, User::class);

    }

    public function delete($id)
    {

        $query = "DELETE FROM users WHERE id = :id";

        $statement = $this->dbConnection->prepare($query);

        return $statement->execute(['id' => $id]);
    }

    public function serialize()
    {
        return json_encode([
            'id' => $this->id,
            'position' => $this->position,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'enabled2fa' => $this->enabled2fa,
            'otpsecretkey' => $this->otpsecretkey,
            'otpcodeisvalid' => $this->otpcodeisvalid
        ]);
    }


}

?>