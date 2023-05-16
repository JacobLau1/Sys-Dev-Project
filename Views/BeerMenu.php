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

class BeerMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($beers)
    {
        $deleteModalFunction = 'document.getElementById("id01").style.display="block"';

        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu selection</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=beer&action=add" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add bottle</a>';
        echo '</div>';
        echo '</nav>';

        /* Table */
        $html = '';
        $html .= '<div class="w3-container w3-center w3-round" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">Beer Menu</h1>';
        $html .= '<section class="w3-card w3-white">';
        $html .= '<table id="employeesTable" class="w3-table w3-striped w3-text-black">';
        $html .= '<tr class="w3-theme-d3">';
        $html .= '<th class="">ID</th>
            <th>SAQ Code</th>
            <th>Type</th>
            <th>Name</th>
            <th>Format</th>
            <th>Price</th>
            <th>Actions</th>';
        $html .= '</tr>';

        // Add the search form
        $html .=     '<form method="post" action="http://localhost/Sys-Dev-Project/index.php?resource=beer&action=menu">';
        $html .= '<input type="text" name="name" placeholder="Search by beer name...">';
        $html .= '<input type="hidden" name="resource" value="beer">';
        $html .= '<input type="hidden" name="action" value="menu">';
        $html .= '<input type="submit" value="Search">';
        $html .= '</form>';


        // Loop and fill the table with data from the database
        foreach ($beers as $beer) {
            $html .= "<tr>
        <td>" . $beer['id'] . "</td>
        <td>" . $beer['saq_code'] . "</td>
        <td>" . $beer['type'] . "</td>
        <td>" . $beer['name'] . "</td>
        <td>" . $beer['format'] . "</td>
        <td>" . $beer['price'] . "</td>
        <td>
            <a class='w3-button w3-hover-blue-gray w3-round' href='http://localhost/Sys-Dev-Project/index.php?resource=beer&action=edit&id=" . $beer['id'] . "'>
                <i class='fas fa-pen-fancy'></i>
            </a>
            <button onclick='openDeleteModal(" . $beer['id'] . ")' class='w3-button w3-hover-blue-gray w3-round beer-deletion'>
                <i class='fas fa-trash'></i>
            </button>
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

            <p>Are you sure you want to delete Beer ID: <span id="beerIdSpan"></span>?</p>
            <form action="http://localhost/Sys-Dev-Project/index.php?resource=beer&action=delete" method="post">
                <input type="hidden" name="id" id="beer_deletion" value="beer_id_value"><br>
                <input type="submit" value="Delete">
            </form>

            <button class="w3-button w3-round w3-theme-d4" onclick="document.getElementById('id01').style.display='none'">Cancel</button>

        </div>
    </div>
</div>
<script>
    function openDeleteModal(beerId) {
        var modal = document.getElementById('id01');
        modal.style.display = 'block';

        var beerIdSpan = document.getElementById('beerIdSpan');
        beerIdSpan.textContent = beerId;

        var beerIdVal = document.getElementById('beer_deletion');
        beerIdVal.value = beerId;

    }
</script>

</body>
</html>
