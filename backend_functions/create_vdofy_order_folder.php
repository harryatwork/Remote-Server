<?php include("../db.php"); 

    $parent_id = 1028;

    $o_id = $_GET["o_id"];
    $order_name = 'QR00'.$o_id;
    $user_id = $_GET["user_id"];
    $sub_id = $_GET["sub_admin"];
    $q_id_count = $_GET["q_id_count"];
    
    
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $time_stamp =  $date->getTimestamp();
    $date2 = date("Y-m-d H:i:s");
    

    $sql_folders_order = "SELECT * FROM items WHERE o_id = '$o_id' AND state = 'Live'";
	$result_folders_order = $conn->query($sql_folders_order);
	if ($result_folders_order->num_rows > 0) {   
	while($row_folders_order = $result_folders_order->fetch_assoc()) {
		$folders_order_id = $row_folders_order["id"];
		
	} } else { 
	    
	         $sql_folders_order_create = "INSERT INTO items (name, o_id, type, parent, state, bywhom, timestamp, date)
             VALUES ('$order_name', '$o_id', 'Folder', '$parent_id', 'Live', '$sub_id', '$time_stamp', '$date2')";
             if ($con->query($sql_folders_order_create) === TRUE) { 
                $folders_order_id = $con->insert_id; 
             } else { echo "ERROR" . $sql_folders_order_create . "<br>" . $conn->error; }
	} 
	
	
	for ($i = 1; $i < ($q_id_count+1); $i++) {

    	$q_id = $_GET["q_$i"];
    	$v_type = $_GET["v_type_$i"];
    	
    	$sql_folders_q_type = "SELECT * FROM items WHERE o_id = '$o_id' AND q_id = '$q_id' AND state = 'Live' AND type = 'Folder'";
    	$result_folders_q_type = $conn->query($sql_folders_q_type);
    	if ($result_folders_q_type->num_rows > 0) {   
    	while($row_folders_q_type = $result_folders_q_type->fetch_assoc()) {
    		$folders_q_type_id = $row_folders_q_type["id"];
    		
    	} } else { 
    	   $time_stamp = $time_stamp + rand(1,50); 
    	         $sql_folders_q_type_create = "INSERT INTO items (name, o_id, q_id, type, parent, state, bywhom, timestamp, date)
                 VALUES ('$v_type', '$o_id', '$q_id', 'Folder', '$folders_order_id', 'Live', '$sub_id', '$time_stamp', '$date2')";
                 if ($con->query($sql_folders_q_type_create) === TRUE) { 
                    $folders_q_type_id = $con->insert_id; 
                 } else { echo "ERROR" . $sql_folders_q_type_create . "<br>" . $conn->error; } 
    	}

	}
	
	
if($sub_id == 11) {

    header("Location: https://vdofy.com/admin/quotesdetail?id=$o_id&stater=Estimate Received&alert=productstatus");
    
} else {
    
    header("Location: https://vdofy.com/studio/quotesdetail?id=$o_id&stater=Estimate Received&alert=productstatus");
    
}



?>