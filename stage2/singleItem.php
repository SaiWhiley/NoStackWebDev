<!-- xss cleansing function from https://stackoverflow.com/questions/1996122/how-to-prevent-xss-with-html-php -->

<?php
function xss_clean($data) {
  // Fix &entity\n;
  $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
  $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
  $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
  $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

  // Remove any attribute starting with "on" or xmlns
  $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

  // Remove javascript: and vbscript: protocols
  $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
  $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
  $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

  // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
  $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
  $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
  $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

  // Remove namespaced elements (we do not need them)
  $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

  do
  {
      // Remove really unwanted tags
      $old_data = $data;
      $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
  }
  while ($old_data !== $data);

  // we are done...
  return $data;
}

  include_once "includes/PDO.php";
  //include_once "login_session.inc";
  if (/*isset($_SESSION['username']) && */isset($_POST['comments'])) {
    try {
      $date = date("Y-m-d");
      $stmtIns = $pdo->prepare('INSERT INTO reviews (Username, Rating, Comments, parkID, DateLeft) VALUES ( "testusername" , :rating , :comments, :id, :dateleft);');
      //$stmtIns->bindValue(':username', $_SESSION['username']);
      $stmtIns->bindValue(':rating', $_POST['rating']);
      $comment = xss_clean($_POST['comments']);
      $stmtIns->bindValue(':comments', $comment);
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
