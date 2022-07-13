<?php include("../db.php"); 
    
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $time_stamp =  $date->getTimestamp();
    $date2 = date("Y-m-d H:i:s");

    $item_id = $_POST["item_id"];
    $sub_id = $_POST["sub_id"];
    $item_name = $_POST["item_name"];

        $sql = "UPDATE items SET name = '$item_name'
	            WHERE id = '$item_id'";
	            if ($con->query($sql) === TRUE) {
	            
	         $sql1 = "INSERT INTO activity (sub_id, action, to_who, to_what, date)
             VALUES ('$sub_id', 'Renamed', '$item_id', '$item_name', '$date2')";
             if ($con->query($sql1) === TRUE) { 
                 echo 1;
             } else { 
                 echo 0;
             }
    
        } else { }
        
?>