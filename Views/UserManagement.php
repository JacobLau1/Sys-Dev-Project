<?php namespace views;?>

<html>
<body>
<?php
Class UserManagement{
    private $user;
    public function __construct($user){

        $this->user = $user;

        $membershipProvider = $this->user->getMembershipProvider();

        if($membershipProvider->isLoggedIn()){
            $html = "";
            $html .= "<a style='float:right' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=login'>Logout</a>";
            $html .= "<a style='float:left' href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection'>Back to menu selection</a>";

            //if the position is admin, display admin
            if($this->user->getPosition() == 'admin'){
                $html .= "</br>";
                $html .= "<h2>User Management Page</h2>";
                $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=list'>Display</a>";
                $html .= "</br>";
                $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=create'>Add</a>";
                //  $html .= "<a href='http://localhost/Sys-Dev-Project/index.php?resource=user&action=delete'>Delete</a>";
            }

            echo $html;
        }else{//user not logged in
            echo "not logged in";
            header('HTTP/1.1 401 Unauthorized');
            header('Location: http://localhost/Sys-Dev-Project/index.php?resource=user&action=login');

        }
    }
}
?>
</body>
</html>