<?php
namespace membershipprovider;

require(dirname(__DIR__)."/Vendor/phpotp/code/rfc6238.php");

class MembershipProvider{

    private $user;

    function __construct($user){

        $this->user = $user;

    }

    function login(){

        session_name("hrapp");

        session_start();

        $_SESSION['username'] = $this->user->getUsername();

        setcookie('hrappuser', $this->user->getUsername(), time()+3600);

        echo 'You are logged in as: '.$this->user->getUsername();

    }

    function isLoggedIn(){

        session_name("hrapp");

        session_start();

        $isLoggedIn = false;

        if(isset($_SESSION)){
            if(isset($_SESSION['username'])){
                if($_SESSION['username'] == $this->user->getUsername()){
                    $isLoggedIn = true;
                }
            }

        }

        return $isLoggedIn;

    }

    function logout(){

        $_SESSION = array();

        session_destroy ();

        setcookie('hrappuser', $this->user->getUsername(), time()-3600);

    }

    function generateSecretKey(){

        // Generate a secret:

        $otpsecretKey = \TokenAuth6238::generateRandomClue();

        return $otpsecretKey;

    }

    function getCodeforKey($otpsecretkey){

        $otpcode =  \TokenAuth6238::getTokenCode($otpsecretkey);

        return $otpcode;

    }

    function verifyCode($otpsecretKey, $otpcode){

        return  \TokenAuth6238::verify($otpsecretKey, $otpcode);

    }

}


?>