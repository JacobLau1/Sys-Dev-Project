<?php namespace views; ?>

<html>
<head>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <script src="https://kit.fontawesome.com/99c47d5f92.js" crossorigin="anonymous"></script>
    <title>Wine Menu</title>
    <link rel="icon" type="image/x-icon" href="./favicon.ico" />
</head>
<body class="w3-theme-d5">
<?php
Class UserMenuselection{
    private $user;

    private $welcomeMessage;

    public function __construct($user){

        $this->user = $user;

        $membershipProvider = $this->user->getMembershipProvider();


        if($membershipProvider->isLoggedIn()){
            $this->welcomeMessage = 'Welcome '.$this->user->getUsername();

            $html = '<nav>';
            $html .= '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
            $html .= '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
            if($this->user->getPosition() == 'admin' || $this->user->getPosition() == 'manager'){
                $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=management'  class='w3-bar-item w3-button w3-hide-small w3-hover-white'>Waiter Registration</a>";
            }
            $html .= "<a class='w3-bar-item w3-button' href='http://localhost/Sys-Dev-Project/index.php?resource=drink&action=menu'>Drinks</a>";
            $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login' class='w3-bar-item w3-button w3-hide-small w3-hover-white'>Logout</a>";
            $html .= '</div>';
            $html .= '</nav>';
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<br>";
            $html .= "<div class='w3-container w3-center'>";
            $html .= "<h1>Menu Selection</h1>";
            $html .= "<br>";
            $html .= "<h2>$this->welcomeMessage</h2>";
            $html .= "</div>";

            //if the position is admin, display admin

            echo $html;

        } else { // user not logged in
            echo "Not logged in";

            header('HTTP/1.1 401 Unauthorized');
            header('Location: http://localhost/Sys-Dev-Project/index.php?resource=user&action=login');
            exit();
        }
    }
}
?>
</body>
</html>
