<?php include("../db.php"); 
    
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $time_stamp =  $date->getTimestamp();
    $date2 = date("Y-m-d H:i:s");

    $sub_id = $_POST["sub_id"];
    $item_id = $_POST["item_id"];
    $status = $_POST["status"];

    if($status == 'add') {
         $sql1 = "INSERT INTO starred (sub_id, item_id, date)
         VALUES ('$sub_id', '$item_id', '$date2')";
         if ($con->query($sql1) === TRUE) { 
            echo 1;
         } else { 
            echo 0;
         }
    } elseif($status == 'remove') {
        
        $sql = "DELETE FROM starred WHERE sub_id = '$sub_id' AND item_id = '$item_id'";
        if ($con->query($sql) === TRUE) {
            echo 1;
        } else { 
            echo 0;
        }
        
	} else { 
	    echo 0;
	}
     
?>