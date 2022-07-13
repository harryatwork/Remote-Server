<?php include("../db.php"); 
    
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $time_stamp =  $date->getTimestamp();
    $date2 = date("Y-m-d H:i:s");

    $parent= $_GET["parent_folder"];
    $full_url = $_GET["full_url"];
    $folder_name = 'DropBox';
    $sub_id = $_GET["sub_id"];
    
    if($parent == '') {
        $parent_id = 0;
    } else {
        $parent_id = $parent;
	}
    
    
    $sql1 = "INSERT INTO items (name, type, parent, state, bywhom, timestamp, date)
             VALUES ('$folder_name', 'DropBox', '$parent_id', 'Live', '$sub_id', '$time_stamp', '$date2')";
             if ($con->query($sql1) === TRUE) { 
                 
                header("Location: $full_url");  
                 
             } else { echo "ERROR" . $sql1 . "<br>" . $conn->error; }

    
//     $output_dir = 'folders/';
//     if (!file_exists($output_dir . $folder_name))/* Check folder exists or not */
// 	{
// 		@mkdir($output_dir . $folder_name, 0777);/* Create folder by using mkdir function */
//         echo "Folder Created";/* Success Message */
// 	}
?>