<head>
  <title>Brisbane Parks</title>
  <link href="globalStyles.css" rel="stylesheet" type="text/css">
  <link href="searchResultsStyles.css" rel="stylesheet" type="text/css">
	<?php // TODO include"metaData.inc";?>
</head>

<body>
  <?php include "includes/PDO.php"; ?>
  <?php include "includes/header.php"; ?>
  <br>
  <?php include "includes/search.php"; ?>
	<?php include "includes/map.php"; ?>
  <div id="searchResults">
    <table id="resultsTable"><br>
      <?php
        $count = 0;
        foreach($result as $locations) {
            echo '<script>addMarker("'.$locations['id'].'","'.$locations['Name'].'", '.$locations['Latitude'].','.$locations['Longitude'].');</script>';
            echo '<tr><td><a href="singleItem.php?id='.$locations['id'].'">'.$locations['Name'].'</a></td></tr>';
            $count = $count + 1;
            if($count == 100){
                break;
            }
        }
      ?>
    </table>
  </div> <!-- END SEARCH RESULTS -->
  <?php include "includes/footer.php"; ?>
</body>
