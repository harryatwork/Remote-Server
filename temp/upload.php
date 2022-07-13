<?php
    include('../db.php'); 

    $files=($_FILES['files']['name']);

    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $date2 = date("Y-m-d H:i:s");  
    $time_stamp =  $date->getTimestamp();

    $target_dir = "../temp/";

    	$target_file = $target_dir . basename($_FILES["files"]["name"]);
        $uploadOk = 1;
        $imageFileType = ucfirst(strtolower(pathinfo($target_file,PATHINFO_EXTENSION)));
        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            $temp = explode(".", $_FILES["files"]["name"]);
            $file_name = $_FILES["files"]["name"];
            $newfilename = $time_stamp.'-'.($_FILES["files"]["name"]);
            if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_dir .$newfilename)) {
                
                echo 'done';
  
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }



?>