<?php namespace views;?>

<html>
  <head>
  </head>

  <body>
    <?php

    class WineDisplay{
      private $wine;

      public function __construct($wine){
          $this->wine = $wine;
      }
      
      function render(...$data){
        echo '<br/>';
        echo '<a href="http://localhost/modavie/index.php?resource=user&action=logout">Logout</a>';
        echo '<br/>';

        $wine = $data[0];

        $html = '<table id="wineTable">';
        $html .= "<th>Name</th>
                    <th>Type</th>
                    <th>Format</th>
                    <th>Price</th>";

        foreach($wine as $e){
            $html .=  "<tr>
                        <td>".$e['name']."</td>
                        <td>".$e['type']."</td>
                        <td>".$e['format']."</td>
                        <td>".$e['price']."</td>
                        </tr>";
        }

        $html .= "</table>";

        echo $html;
      }  

    }
    ?>
  </body>
</html>