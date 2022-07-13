<?php include("../db.php"); 
    
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $time_stamp =  $date->getTimestamp();
    $date2 = date("Y-m-d H:i:s");

    $item_id= $_POST["item_id"];
    $item_state= $_POST["item_state"];

        $sql = "UPDATE items SET state = '$item_state'
	            WHERE id = '$item_id'";
    
        if ($con->query($sql) === TRUE) {
           
        } else { echo "ERROR" . $sql . "<br>" . $conn->error; }
        
?>