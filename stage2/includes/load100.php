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