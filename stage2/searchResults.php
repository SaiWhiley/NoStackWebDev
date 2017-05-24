<?php 
	if (!isset($_POST['selectSearch']))
	{
		header("Location: index.php");
	}
	include "includes/PDO.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Brisbane Parks</title>
  <link href="globalStyles.css" rel="stylesheet" type="text/css">
  <link href="searchResultsStyles.css" rel="stylesheet" type="text/css">
	<?php // TODO include "includes/metaData.php"; ?>
</head>

<body>
  <?php include "includes/header.php"; ?>
  <br/>
  <?php include "includes/search.php"; ?>
	<?php include "includes/map.php"; ?>
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

		if (isset($_POST['sort']))
		{
			try{
				$sortQuery = '';
				if ($_POST['sort'] == "a-z")
				{
					$sortQuery = ' ORDER BY Name ASC';
				}
				if ($_POST['sort'] == "z-a")
				{
					$sortQuery = ' ORDER BY Name DESC';
				}
				if ($_POST['sort'] == "ratingH")
				{
					$sortQuery = ' ORDER BY Ratings DESC';
				}
				if ($_POST['sort'] == "ratingL")
				{
					$sortQuery = ' ORDER BY Ratings ASC';
				}


				if ($_POST['selectSearch'] == "suburb")
				{
					$sortQuery = 'SELECT id, Name, Street, Latitude, Longitude, Suburb FROM parks WHERE Suburb LIKE :query '. $sortQuery;
					$stmt = $pdo->prepare($sortQuery . ';');
					$stmt->bindValue(':query', '%'.$_POST['suburb'].'%');
				}
				else if ($_POST['selectSearch'] == "distance")
				{
					$sortQuery = 'SELECT * FROM parks ' . $sortQuery;
					$stmt = $pdo->prepare($sortQuery .';');
				}
				else if ($_POST['selectSearch'] == "name")
				{
					$sortQuery = 'SELECT id, Name, Street, Latitude, Longitude, Suburb FROM parks WHERE Name LIKE :query '. $sortQuery;
					$stmt = $pdo->prepare($sortQuery .';');
					$stmt->bindValue(':query', '%'.$_POST['query'].'%');
				}
				$stmt->execute();
				$res = $stmt->fetchAll();
				if ($_POST['selectSearch'] == "distance")
				{
					$final = array();
					if ($_POST['dist'] == "1")
					{
						//<1KM
						foreach($res as $result)
						{
							if (distance($_POST['lat'],$_POST['long'],$result['Latitude'],$result['Longitude']) < 1)
							{
								array_push($final, $result); // Add to array if distance < 1km
							}
						}
						$res = $final;
					}
				
					if ($_POST['dist'] == "2")
					{
						//<5KM
						foreach($res as $result)
						{
							if (distance($_POST['lat'],$_POST['long'],$result['Latitude'],$result['Longitude']) < 5)
							{
								array_push($final, $result); // Add to array if distance <5 KM
							}
						}
						$res = $final;
					}
					if ($_POST['dist'] == "3")
					{
						//<10KM
						foreach($res as $result)
						{
							if (distance($_POST['lat'],$_POST['long'],$result['Latitude'],$result['Longitude']) < 10)
							{
								array_push($final, $result); // Add to array if distance < 10km
							}
						}
						$res = $final;
					}
					if ($_POST['dist'] == "4")
					{
						//>10KM
						foreach($res as $result)
						{
							if (distance($_POST['lat'],$_POST['long'],$result['Latitude'],$result['Longitude']) > 10)
							{
								array_push($final, $result); // Add to array if distance > 10km
							}
						}
						$res = $final;
					}
				} //end distance section
				if ($_POST['sort'] == "closest")
				{
					$sorted = false;
					while (!$sorted) {
						$sorted = true;
						for ($i = 0; $i < count($res)-1; $i++)
						{
							if (distance($_POST['lat'],$_POST['long'],$res[$i]['Latitude'],$res[$i]['Longitude']) > distance($_POST['lat'],$_POST['long'],$res[$i+1]['Latitude'],$res[$i+1]['Longitude']))
								{
									$temp = $res[$i];
									$res[$i] = $res[$i+1];
									$res[$i+1] = $temp;
									$sorted = false;
								}
						}
					}
				}

				if ($_POST['sort'] == "furthest")
				{
					$sorted = false;
					while (!$sorted){
						$sorted = true;
						for ($i = 0; $i < count($res)-1; $i++)
						{
							if (distance($_POST['lat'],$_POST['long'],$res[$i]['Latitude'],$res[$i]['Longitude']) < distance($_POST['lat'],$_POST['long'],$final[$i+1]['Latitude'],$final[$i+1]['Longitude']))
								{
									$temp = $final[$i];
									$res[$i] = $res[$i+1];
									$res[$i+1] = $temp;
									$sorted = false;
								}
						}
					}
				}
			}
					
			catch(PDOException $e)
			{
				echo '<script> window.alert("UNKNOWN ERROR, WE DIDN\'NT ENCOUNTER THIS IN DEBUGGING"); </script>';
				echo $e->getMessage();
			}
			
		}
	  ?>
	<br>
    <table id="resultsTable">
		<?php
			if (isset($res))
			{
				foreach($res as $result)
				{
					echo '<script>addMarker("'.$result['id'].'","'.$result['Name'].'",'.$result['Latitude'].','.$result['Longitude'].');</script>';
					echo '<tr><td><a href="singleItem.php?id='.$result['id'].'">'.$result['Name'].'</a></td></tr>';
				}
			}
		?>
      
    </table>
  </div>
  <?php //include "footer.inc"; ?>
</body>
</html>
