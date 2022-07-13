<?php
    include('../db.php'); 

    $files=($_FILES['files']['name']);
    $filesCount = count($_FILES['files']['name']);
    
    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $date2 = date("Y-m-d H:i:s");  
    $time_stamp =  $date->getTimestamp();
    
    $parent= $_POST["parent_folder"];
    $full_url = $_POST["full_url"];
    $sub_id = $_POST["sub_id"];

    if($parent == '') {
        $parent_id = 0;
    } else {
        $parent_id = $parent;
	}

    $target_dir = "../files/";
    
    for ($x = 0; $x < $filesCount; $x++) {	
        
        $fileSizeInBytes = $_FILES['files']['size'][$x];
        $time_stamp = $time_stamp+$x;
        
    	$target_file = $target_dir . basename($_FILES["files"]["name"][$x]);
        $uploadOk = 1;
        $imageFileType = ucfirst(strtolower(pathinfo($target_file,PATHINFO_EXTENSION)));
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            $temp = explode(".", $_FILES["files"]["name"][$x]);
            $file_name = $_FILES["files"]["name"][$x];
            $newfilename = $time_stamp.'-'.($_FILES["files"]["name"][$x]);
            if (move_uploaded_file($_FILES["files"]["tmp_name"][$x], $target_dir .$newfilename)) {
                
                 $sql1 = "INSERT INTO items (name, type, file_name, parent, state, size, bywhom, timestamp, date)
                 VALUES ('$file_name', '$imageFileType', '$newfilename', '$parent_id', 'Live', '$fileSizeInBytes', '$sub_id', '$time_stamp', '$date2')";
                 if ($con->query($sql1) === TRUE) { 

                 } else { echo "ERROR" . $sql1 . "<br>" . $conn->error; }
                
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }
    
    
    header("Location: $full_url");

?>