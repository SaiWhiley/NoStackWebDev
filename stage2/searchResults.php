<html>
<head>
    <title>Brisbane Parks</title>
    <link href="globalStyles.css" rel="stylesheet" type="text/css">
    <link hrek="searchResultsStyles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include "includes/header.php";
            include "includes/search.php";
            include "includes/map.php"; ?>
    <div id="searchResults">
        <?php
            function distance($lat1, $lon1, $lat2, $lon2) {
			$R = 6371; // km
			$lat1 = floatval($lat1);
			$lon1 = floatval($lon1);
			$lat2 = floatval($lat2);
			$lon2 = floatval($lon2);
			$dLat = deg2rad($lat2-$lat1);
			$dLon = deg2rad($lon2-$lon1);
			$lat1 = deg2rad($lat1);
			$lat2 = deg2rad($lat2);
			$a = sin($dLat/2) * sin($dLat/2) +
					sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2);
			$c = 2 * atan2(sqrt($a), sqrt(1-$a));
			$d = $R * $c;
			return $d;
		  }

      if(isset($_POST['sort'])){
          try{
              $sortQuery='';
          }
          catch(PDOException $e){
              echo '<script> window.alert ("Something went wrong. See the console for technical details"); </script>';
          }
      }  