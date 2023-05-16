<?php
namespace views;

class UserSetupTwofa{

    private $user;

    function __construct($user)
    {

        $this->user = $user;

        $this->render();

    }

    function render(){

        $qrcodeimageURL= \TokenAuth6238::getBarCodeUrl($this->user->getUsername(), 'localhost', $this->user->getOTPsecretkey(), 'Sys-Dev-Projectvie');

        echo 'Download and sent this page to the employee.';
        echo '</br>';

        echo 'Download the authenticator app:';
        echo '</br>';
        echo 'Either the Google authenticator app';
        echo '</br>';
        echo 'https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en_CA&gl=US&pli=1';
        echo '</br>';
        echo 'or the Microsoft Authenticator app';
        echo '</br>';
        echo 'https://apps.apple.com/us/app/microsoft-authenticator/id983156458';
        echo '</br>';

        $html = '<img src="'.$qrcodeimageURL.'"alt="QR Code" />';

        echo $html;

        echo '</br>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=login">Continue</a>';

    }
}
?>