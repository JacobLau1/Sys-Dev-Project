<?php namespace views;?>

<html>
<head>
    <title>Menu Selection</title>
    <link rel="stylesheet" href="./Styles/MenuSelection.css">
</head>
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
            $html = "<header>";
            $html .= "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";
            if($this->user->getPosition() == 'admin'){
                $html .= "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=management'>Waiter Registration</a>";
            }
            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=drink&action=menu'>Drinks</a>";
            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=wine&action=menu'>Wine</a>";
            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=beer&action=menu'>Beer</a>";
            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=menu'>Spirits</a>";
            $html .= "</header>";
            $html .= "<br>";
            $html .= "<h1>Menu Selection</h1>";
            $html .= "<br>";
            $html .= "<h2>$this->welcomeMessage</h2>";




            //if the position is admin, display admin



            echo $html;

        }else{//user not logged in
            echo "not logged in";

            header('HTTP/1.1 401 Unauthorized');
            header('Location: http://localhost/Sys-Dev-Project/index.php?resource=user&action=login');
            exit();


        }

    }
}
?>

</body>
</html>