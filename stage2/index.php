<head>
  <title>Brisbane Parks</title>
  <link href="globalStyles.css" rel="stylesheet" type="text/css">
  <link href="indexStyles.css" rel="stylesheet" type="text/css">
</head>

<?php
    include "includes/header.php";
    echo "<br>";
    include "includes/search.php";
    echo '<p id = "status"></p>';
    echo '<h4 id="mapTitle">Parks in Brisbane near you:</h4>';
    echo '<div id="mapholder"></div><br>';
    include "includes/map.php";
    include "includes/footer.php";
?>
