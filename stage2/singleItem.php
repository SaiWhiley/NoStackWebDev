<?php
  include_once "includes/PDO.php";
  //include_once "login_session.inc";
  if (/*isset($_SESSION['username']) && */isset($_POST['comments'])) {
    try {
      $date = date("Y-m-d");
      $stmtIns = $pdo->prepare('INSERT INTO reviews (Username, Rating, Comments, parkID, DateLeft) VALUES ( "testusername" , :rating , :comments, :id, :dateleft);');
      //$stmtIns->bindValue(':username', $_SESSION['username']);
      $stmtIns->bindValue(':rating', $_POST['rating']);
      $stmtIns->bindValue(':comments', $_POST['comments']);
	    $stmtIns->bindValue(':id', $_GET['id']);
      $stmtIns->bindValue(':dateleft', $date);
      $stmtIns->execute();
      }
      catch (PDOException $e){
        echo 'something went wrong';
        echo $e->getMessage();
    }
  }
?>

<html>
<head>
  <title>Brisbane Parks</title>
  <link href="globalStyles.css" rel="stylesheet" type="text/css">
  <link href="singleItemStyles.css" rel="stylesheet" type="text/css">
  <?php include "includes/metaData.php"; ?>
</head>
<body>
    <?php
        include "includes/header.php";
        echo "<br>";
        include "includes/search.php";
    ?>
    <div id = "item">
    <?php
    global $parkResults, $reviewResults;
    try{
        $stmtTWO = $pdo->prepare('SELECT * FROM reviews WHERE parkID = :id');
        $stmtTWO->bindValue(':id', $_GET['id']);
        $stmtTWO->execute();
        $reviewResults = $stmtTWO->fetchall();

        $stmt = $pdo->prepare('SELECT * FROM parks WHERE id = :id');
        $stmt->bindValue(':id', $_GET['id']);
        $stmt->execute();
        $parkResults = $stmt->fetch();
        echo '<h2>'.$parkResults['Name'].'</h2>';
        echo '<h4>Rating: '.$parkResults['Rating'].'</h4>';
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

    include "includes/map.php";
    echo '<script>addMarker("'.$parkResults['id'].'","'.$parkResults['Name'].'",'.$parkResults['Latitude'].','.$parkResults['Longitude'].');</script>';
    ?>
    <div id="writeComment">
        <form method="post">
            <p>Leave a Review:</p>
            <p>Rating:
              <select id="rating" name="rating" value="">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </p>
            <textarea name="comments" rows = "3" cols="89" placeholder="Comments:"></textarea>
            <button type="submit">Leave Review</button>
        </form>
    </div>
    <div id="reviews">
      <table>
        <?php
          foreach ($reviewResults as $data) {
            echo '<tr><td><h4>'.$data['Rating'].'/5 '.$data['Username'].' said:</h4><p>'.$data['Comments'].'</p></td></tr>';
          }
        ?>
      </table>
    </div>
    </div>
    <?php include "includes/footer.php";?>
</body>
</html>
