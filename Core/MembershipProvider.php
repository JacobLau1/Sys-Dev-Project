<?php
namespace membershipprovider;

require(dirname(__DIR__)."/Vendor/phpotp/code/rfc6238.php");

class MembershipProvider{

    private $user;

    function __construct($user){

        $this->user = $user;

    }

    function login(){

        session_name("UserSession");

        session_start();

        $_SESSION['username'] = $this->user->getUsername();

        setcookie('UserSessionUser', $this->user->getUsername(), time()+3600);

    }

    function isLoggedIn(){

        session_name("UserSession");

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
        session_name("UserSession");

        session_start();
        $_SESSION = array();
        session_destroy();
        setcookie('UserSession', '', time() - 3600, '/');
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