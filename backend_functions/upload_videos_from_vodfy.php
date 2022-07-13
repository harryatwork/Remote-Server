<?php include("../db.php"); 

    $parent_id = 1028;

    $o_id = $_POST["o_id"];
    $q_id = $_POST["q_id"];
    $order_name = 'QR00'.$o_id;
    $asin_id = $_POST["asin_id"];
    $asin_name = $_POST["asin_name"];
    $user_id = $_POST["user_id"];
    $video_type = $_POST["video_type"];
    $sub_id = $_POST["sub_admin"];
    
    $type = $_POST["type"];
    $feedback = $_POST["feedback"];
    
    if($asin_name == '') {
        $asin_folder_name = 'ASIN: '.$asin_id;
    } else {
        $asin_folder_name = 'ASIN: '.$asin_name;
    }
    
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $time_stamp =  $date->getTimestamp();
    $date2 = date("Y-m-d H:i:s");


    $video = ($_FILES['video']['name']);
    
    $thumbnail = ($_FILES['thumbnail']['name']);
    $thumbnailCount = count($_FILES['thumbnail']['name']);
    
    $folder = ($_FILES['folder']['name']);
    $folderCount = count($_FILES['folder']['name']);
    
    $target_dir = "../files/";

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
	
	
	$sql_folders_q_type = "SELECT * FROM items WHERE o_id = '$o_id' AND q_id = '$q_id' AND state = 'Live' AND type = 'Folder'";
	$result_folders_q_type = $conn->query($sql_folders_q_type);
	if ($result_folders_q_type->num_rows > 0) {   
	while($row_folders_q_type = $result_folders_q_type->fetch_assoc()) {
		$folders_q_type_id = $row_folders_q_type["id"];
		
	} } else { 
	   $time_stamp = $time_stamp + rand(1,50); 
	         $sql_folders_q_type_create = "INSERT INTO items (name, o_id, q_id, type, parent, state, bywhom, timestamp, date)
             VALUES ('$video_type', '$o_id', '$q_id', 'Folder', '$folders_order_id', 'Live', '$sub_id', '$time_stamp', '$date2')";
             if ($con->query($sql_folders_q_type_create) === TRUE) { 
                $folders_q_type_id = $con->insert_id; 
             } else { echo "ERROR" . $sql_folders_q_type_create . "<br>" . $conn->error; } 
	}
	
	
	$sql_folders_user_uploads = "SELECT * FROM items WHERE o_id = '$o_id' AND name = 'User_Uploads' AND state = 'Live' AND type = 'Folder'";
	$result_folders_user_uploads = $conn->query($sql_folders_user_uploads);
	if ($result_folders_user_uploads->num_rows > 0) {   
	while($row_folders_user_uploads = $result_folders_user_uploads->fetch_assoc()) {
		$folders_user_uploads_id = $row_folders_user_uploads["id"];
		
	} } else { 
	   $time_stamp = $time_stamp + rand(1,50); 
	         $sql_folders_user_uploads_create = "INSERT INTO items (name, o_id, type, parent, state, bywhom, timestamp, date)
             VALUES ('User_Uploads', '$o_id', 'Folder', '$folders_order_id', 'Live', '$sub_id', '$time_stamp', '$date2')";
             if ($con->query($sql_folders_user_uploads_create) === TRUE) { 
                $folders_user_uploads_id = $con->insert_id; 
             } else { echo "ERROR" . $sql_folders_user_uploads_create . "<br>" . $conn->error; } 
	}
	
	
	$sql_folders_asin = "SELECT * FROM items WHERE o_id = '$o_id' AND q_id = '$q_id' AND asin_id = '$asin_id' AND state = 'Live' AND type = 'Folder'";
	$result_folders_asin = $conn->query($sql_folders_asin);
	if ($result_folders_asin->num_rows > 0) {   
	while($row_folders_asin = $result_folders_asin->fetch_assoc()) {
		$folders_asin_id = $row_folders_asin["id"];
		$new_time_stamp = $row_folders_asin["timestamp"];
		
		$sql12 = "DELETE FROM items WHERE o_id = '$o_id' AND q_id = '$q_id' AND asin_id = '$asin_id' AND state = 'Live' AND type != 'Folder'";
        if ($conn->query($sql12) === TRUE) {
        } else { echo "ERROR" . $sql12 . "<br>" . $conn->error; }
		
	} } else { 
	   $new_time_stamp = $time_stamp + rand(1,50); 
	   $sql_folders_asin_create = "INSERT INTO items (name, o_id, q_id, asin_id, type, parent, state, bywhom, timestamp, date)
             VALUES ('$asin_folder_name', '$o_id', '$q_id', '$asin_id', 'Folder', '$folders_q_type_id', 'Live', '$sub_id', '$new_time_stamp', '$date2')";
             if ($con->query($sql_folders_asin_create) === TRUE) { 
                $folders_asin_id = $con->insert_id; 
             } else { echo "ERROR" . $sql_folders_asin_create . "<br>" . $conn->error; } 
	}





        $fileSizeInBytes = $_FILES['video']['size'];
        $time_stamp = $time_stamp;

        $target_file = $target_dir . basename($_FILES["files"]["name"]);
        $uploadOk = 1;
        $imageFileType = ucfirst(strtolower(pathinfo($target_file,PATHINFO_EXTENSION)));
        
        if($imageFileType == '') {
            $imageFileType = 'Mp4';
        }
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            $time_stamp = $time_stamp + rand(1,50);
            $temp = explode(".", $_FILES["video"]["name"]);
            $file_name = $_FILES["video"]["name"];
            $newfilename = $time_stamp.'-'.($_FILES["video"]["name"]);
            if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_dir .$newfilename)) {
                
                 $sql1 = "INSERT INTO items (name, o_id, q_id, asin_id, type, file_name, parent, state, size, bywhom, timestamp, date)
                 VALUES ('$file_name', '$o_id', '$q_id', '$asin_id', '$imageFileType', '$newfilename', '$folders_asin_id', 'Live', '$fileSizeInBytes', '$sub_id', '$time_stamp', '$date2')";
                 if ($con->query($sql1) === TRUE) { 
                    $video_id = $con->insert_id;
                    $link_file_name = 'https://vdofyfilex.com/files/'.$newfilename;
                 } else { echo "ERROR" . $sql1 . "<br>" . $conn->error; }
                
            } else { }
        }


    for ($x = 0; $x < $thumbnailCount; $x++) {	
        
        $fileSizeInBytes = $_FILES['thumbnail']['size'][$x];
        $time_stamp = $time_stamp+$x;
        
    	$target_file = $target_dir . basename($_FILES["thumbnail"]["name"][$x]);
        $uploadOk = 1;
        $imageFileType = ucfirst(strtolower(pathinfo($target_file,PATHINFO_EXTENSION)));
        if($imageFileType == '') {
            $imageFileType = 'Mp4';
        }
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            $time_stamp = $time_stamp + rand(1,50);
            $temp = explode(".", $_FILES["thumbnail"]["name"][$x]);
            $file_name = $_FILES["thumbnail"]["name"][$x];
            $newfilename = $time_stamp.'-'.($_FILES["thumbnail"]["name"][$x]);
            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"][$x], $target_dir .$newfilename)) {
                
                 $sql1 = "INSERT INTO items (name, o_id, q_id, asin_id, type, file_name, parent, state, size, bywhom, timestamp, date)
                 VALUES ('$file_name', '$o_id', '$q_id', '$asin_id', '$imageFileType', '$newfilename', '$folders_asin_id', 'Live', '$fileSizeInBytes', '$sub_id', '$time_stamp', '$date2')";
                 if ($con->query($sql1) === TRUE) { 

                 } else { echo "ERROR" . $sql1 . "<br>" . $conn->error; }
                
            } else { }
        }

    }
    
    
    for ($y = 0; $y < $folderCount; $y++) {	
        
        $fileSizeInBytes = $_FILES['folder']['size'][$y];
        $time_stamp = $time_stamp+$y;
        
    	$target_file = $target_dir . basename($_FILES["folder"]["name"][$y]);
        $uploadOk = 1;
        $imageFileType = ucfirst(strtolower(pathinfo($target_file,PATHINFO_EXTENSION)));
        if($imageFileType == '') {
            $imageFileType = 'Mp4';
        }
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            $time_stamp = $time_stamp + rand(1,50);
            $temp = explode(".", $_FILES["folder"]["name"][$y]);
            $file_name = $_FILES["folder"]["name"][$y];
            $newfilename = $time_stamp.'-'.($_FILES["folder"]["name"][$y]);
            if (move_uploaded_file($_FILES["folder"]["tmp_name"][$y], $target_dir .$newfilename)) {
                
                 $sql1 = "INSERT INTO items (name, o_id, q_id, asin_id, type, file_name, parent, state, size, bywhom, timestamp, date)
                 VALUES ('$file_name', '$o_id', '$q_id', '$asin_id', '$imageFileType', '$newfilename', '$folders_asin_id', 'Live', '$fileSizeInBytes', '$sub_id', '$time_stamp', '$date2')";
                 if ($con->query($sql1) === TRUE) { 
                    $item_last_id = $con->insert_id;
                 } else { echo "ERROR" . $sql1 . "<br>" . $con->error; }
                
            } else { }
        }

    }


    header("Location: https://vdofy.com/studio/updatelink_after_drive_upload.php?o_id=$o_id&v_id=$asin_id&editor=$sub_id&u_id=$user_id&feedback=$feedback&type=$type&link_id=$link_file_name&folder_timestamp=$new_time_stamp&item_id=$item_last_id");


?>