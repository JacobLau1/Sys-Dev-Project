<?php namespace views;?>

<html>
<body>
<?php
Class UserMenuselection{
    private $user;

    private $welcomeMessage;

    public function __construct($user){

        $this->user = $user;

        $membershipProvider = $this->user->getMembershipProvider();

        if($membershipProvider->isLoggedIn()){
            $this->welcomeMessage = 'Welcome '.$this->user->getUsername();
            echo $this->welcomeMessage;
            $html = "";
            $html .= "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";

            //if the position is admin, display admin
            if($this->user->getPosition() == 'admin'){
                $html .= "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=management'>Waiter Registration</a>";
            }

            $html .= "<br>";
            $html .= "<h1>Menu Selection</h1>";
            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=wine&action=menu'>Wine</a>";
            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=beer&action=menu'>Beer</a>";
            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=menu'>Spirits</a>";
            $html .= "<br>";

            echo $html;
        }else{//user not logged in
            echo "not logged in";
            header('HTTP/1.1 401 Unauthorized');
            header('Location: http://localhost/Sys-Dev-Projectt/index.php?resource=user&action=login');

        }
    }
}
?>

</body>
</html>