<?php include("../db.php"); 
    
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $time_stamp =  $date->getTimestamp();
    $date2 = date("Y-m-d H:i:s");

    $item_id = $_POST["item_id"];
    $item_parent_id = $_POST["item_drop_id"];

        $sql = "UPDATE items SET parent = '$item_parent_id'
	            WHERE id = '$item_id'";
    
        if ($con->query($sql) === TRUE) {
          echo 1;
        } else { 
            echo 0;
        }
        
?>