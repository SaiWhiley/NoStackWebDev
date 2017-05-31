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
    <p>Limiting results to 100</p>
    <table id="resultsTable"><br>
      <?php
        include "includes/load100.php";
        
      ?>
    </table>
  </div> <!-- END SEARCH RESULTS -->
  <?php include "includes/footer.php"; ?>
</body>
