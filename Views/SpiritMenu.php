<?php namespace views; ?>

<html>
<head>
    <title>Spirit Menu</title>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
    <script src="https://kit.fontawesome.com/99c47d5f92.js" crossorigin="anonymous"></script>
</head>
<body class="w3-theme-d5">
<?php

class SpiritMenu {
    private $user;

    public function __construct($user) {
        $this->user = $user;

    }

    public function render($spirits) {

        $deleteModalFunction = 'document.getElementById("id01").style.display="block"';

        /* Nav Bar */
        echo '<nav>';
        echo '<div class="w3-bar w3-theme-d4 w3-top w3-left-align w3-large">';
        echo '<a href="" class="w3-bar-item w3-button w3-theme-d3">Modavie</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=user&action=menuselection" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Back to menu selection</a>';
        echo '<a href="http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=add" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add bottle</a>';
        echo '</div>';
        echo '</nav>';

        /* Table */
        $html = '';
        $html .= '<div class="w3-container w3-center w3-round" style="padding: 4rem" id="main">';
        $html .= '<h1 class="center white-text">Spirit Menu</h1>';
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
        $html .=     '<form method="post" action="http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=menu">';
        $html .= '<input type="text" name="name" placeholder="Search by spirit name...">';
        $html .= '<input type="hidden" name="resource" value="spirit">';
        $html .= '<input type="hidden" name="action" value="menu">';
        $html .= '<input type="submit" value="Search">';
        $html .= '</form>';

        // Loop and fill the table with data from the database
        foreach ($spirits as $spirit) {
            $html .= "<tr>
            <td>" . $spirit['id'] . "</td>
            <td>" . $spirit['saq_code'] . "</td>
            <td>" . $spirit['type'] . "</td>
            <td>" . $spirit['name'] . "</td>
            <td>" . $spirit['format'] . "</td>
            <td>" . $spirit['price'] . "</td>
            <td>
                <a class='w3-button w3-hover-blue-gray w3-round' href='http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=edit&id=" . $spirit['id'] . "'>
                    <i class='fas fa-pen-fancy'></i>
                </a>
                <button onclick='openDeleteModal(" . $spirit['id'] . ")' class='w3-button w3-hover-blue-gray w3-round spirit-deletion'>
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

            <p>Are you sure you want to delete Spirit ID: <span id="spiritIdSpan"></span>?</p>
            <form action="http://localhost/Sys-Dev-Project/index.php?resource=spirit&action=delete" method="post">
                <input type="hidden" name="id" id="spirit_deletion" value="spirit_id_value"><br>
                <input type="submit" value="Delete Spirit">
            </form>

            <button class="w3-button w3-round w3-theme-d4" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
        </div>
    </div>
</div>
<script>
    function openDeleteModal(spiritId) {
        var modal = document.getElementById('id01');
        modal.style.display = 'block';

        var spiritIdSpan = document.getElementById('spiritIdSpan');
        spiritIdSpan.textContent = spiritId;

        var spiritIdVal = document.getElementById('spirit_deletion');
        spiritIdVal.value = spiritId;

    }
</script>
</body>
</html>
