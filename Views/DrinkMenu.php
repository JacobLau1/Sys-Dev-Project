<?php namespace views; ?>

<html>
<head>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <script src="https://kit.fontawesome.com/99c47d5f92.js" crossorigin="anonymous"></script>
</head>
<body class="w3-theme-d5">
<?php

class DrinkMenu
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function render($drinks)
    {
        $deleteModalFunction = 'document.getElementById("id01").style.display="block"';

        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu selection</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=drink&action=add" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add bottle</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=drink&type=wine&action=menu" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Wine</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=drink&type=beer&action=menu" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Beer</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=drink&type=spirits&action=menu" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Spirits</a>';
        echo '</div>';
        echo '</nav>';

        /* Table */
        $html = '';
        $html .= '<div class="w3-container w3-center w3-round" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">Drink Menu</h1>';
        $html .= '<section class="w3-card w3-white">';
        $html .= '<table id="employeesTable" class="w3-table w3-striped w3-text-black">';
        $html .= '<tr class="w3-theme-d3">';
        $html .= '<th class="">Drink ID</th>
            <th>Alcohol Type</th>
            <th>Saq Code</th>
            <th>Subtype</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            <th>Current Location</th>
            <th>Image</th>
            <th>Actions</th>';
        $html .= '</tr>';




        // Add the search form
        $html .= '<form method="post" action="http://localhost/Sys-Dev-Project/index.php?resource=drink&action=menu">';
            $html .= '<input type="text" name="drink_id" placeholder="Search by drink ID...">';
            $html .= '<input type="hidden" name="resource" value="drink">';
            $html .= '<input type="hidden" name="action" value="menu">';
            $html .= '<input type="submit" value="Search">';
            $html .= '</form>';


// Loop and fill the table with data from the database
        foreach ($drinks as $drink) {
            $imageData = base64_encode($drink['image']);

            // Retrieve the room name from the location table based on the current_location ID
            $locationModel = new \Models\Location();
            $location = $locationModel->getLocationByID($drink['current_location']);
            $room = $location ? $location['room'] : '';

            $html .= "<tr>
        <td>" . $drink['drink_id'] . "</td>
        <td>" . $drink['alcohol_type'] . "</td>
        <td>" . $drink['saq_code'] . "</td>
        <td>" . $drink['subtype'] . "</td>
        <td>" . $drink['name'] . "</td>
        <td>" . $drink['format'] . "ml" . "</td>
        <td>" . $drink['price'] . "$" . "</td>
        <td><a href='http://localhost/Sys-Dev-Project/index.php?resource=drink&action=location&id=" . $drink['drink_id'] . "'>" . $room . "</a></td>
        <td><img src='data:image/jpeg;base64," . $imageData . "' style='width: 50%; height: 50%;'/></td>
        <td>
        <a class='w3-button w3-hover-blue-gray w3-round' href='http://localhost/Sys-Dev-Project/index.php?resource=drink&action=edit&id=" . $drink['drink_id'] . "'>
            <i class='fas fa-pen-fancy'></i>
        </a>
        <button onclick=$deleteModalFunction class='w3-button w3-hover-blue-gray w3-round drink-deletion'><i class='fas fa-trash'></i></button>
        </td>
    </tr>";
        }



        $html .= "</table>";
        $html .= '</section>';
        $html .= '</div>';

        echo $html;
    }
}

?>
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-theme-d3">
        <div class="w3-container">

            <p>Are you sure you want to delete Wine ID: <span id="wineIdSpan"></span>?</p>
            <form action="http://localhost/Sys-Dev-Project/index.php?resource=drink&action=delete" method="post">
                <input type="hidden" name="id" id="drink_deletion" value="drink_id_value"><br>
                <input type="submit" value="Delete Drink">
            </form>

            <button class="w3-button w3-round w3-theme-d4" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
        </div>
    </div>
</div>
<script>
    function openDeleteModal(drinkId) {
        const modal = document.getElementById('id01');
        modal.style.display = 'block';

        const drinkIdSpan = document.getElementById('drinkIdSpan');
        drinkIdSpan.textContent = drinkId;

        const drinkIdVal = document.getElementById('drink_deletion');
        drinkIdVal.value = drinkId;

    }
</script>
<!--<script src="./Modals.js"></script>-->
</body>
</html>
?>