<?php include("../db.php"); 
    $date = new DateTime();
    $time_stamp = $date->getTimestamp();

    $files = array();
    
    $folder_id = $_GET["folder"];
    
    $folder_name_main = '';
    $sql_folders_main = "SELECT * FROM items WHERE id = '$folder_id'";
	$result_folders_main = $conn->query($sql_folders_main);
	if ($result_folders_main->num_rows > 0) {   
	while($row_folders_main = $result_folders_main->fetch_assoc()) {
		$folder_name_main = $row_folders_main["name"];
	} } else { } 
    
    $sql_folders = "SELECT * FROM items WHERE parent = '$folder_id'";
	$result_folders = $conn->query($sql_folders);
	if ($result_folders->num_rows > 0) {   
	while($row_folders = $result_folders->fetch_assoc()) {
		$sub_folders_id = $row_folders["id"];
		$sub_folders_type = $row_folders["type"];
		$sub_folders_file = $row_folders["file_name"];
		$sub_folders_file = '../files/'.$sub_folders_file;
		
		if($sub_folders_type == 'Folder') {
		    
		    
		    
		    $sql_folders_2 = "SELECT * FROM items WHERE parent = '$sub_folders_id'";
        	$result_folders_2 = $conn->query($sql_folders_2);
        	if ($result_folders_2->num_rows > 0) {   
        	while($row_folders_2 = $result_folders_2->fetch_assoc()) {
        		$sub_folders_id_2 = $row_folders_2["id"];
        		$sub_folders_type_2 = $row_folders_2["type"];
        		$sub_folders_file_2 = $row_folders_2["file_name"];
        		$sub_folders_file_2 = '../files/'.$sub_folders_file_2;
        		
        		if($sub_folders_type_2 == 'Folder') {
        		    
        		    
        		    $sql_folders_3 = "SELECT * FROM items WHERE parent = '$sub_folders_id_2'";
                	$result_folders_3 = $conn->query($sql_folders_3);
                	if ($result_folders_3->num_rows > 0) {   
                	while($row_folders_3 = $result_folders_3->fetch_assoc()) {
                		$sub_folders_id_3 = $row_folders_3["id"];
                		$sub_folders_type_3 = $row_folders_3["type"];
                		$sub_folders_file_3 = $row_folders_3["file_name"];
                		$sub_folders_file_3 = '../files/'.$sub_folders_file_3;
                		
                		if($sub_folders_type_3 == 'Folder') {
                		    
                		    
                		    
                		    
                		    
                		} else { 
                		  //  $files = '"'.$sub_folders_file_3.'", '.$files;
                		    array_push($files, $sub_folders_file_3);
                		}
                		
                	} } else { } 
        		    
        		    
        		} else { 
        		  //  $files = '"'.$sub_folders_file_2.'", '.$files;
        		    array_push($files, $sub_folders_file_2);
        		}
        		
        	} } else { } 
        	
        	
		    
		} else { 
		  //  $files = '"'.$sub_folders_file.'", '.$files;
		    array_push($files, $sub_folders_file);
		}
		
	} } else { } 
	
    $zipname = '../zips/'.$time_stamp.'.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    foreach ($files as $file) {
      $zip->addFile($file);
    }
    $zip->close();
    
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename='.$folder_name_main.'.zip');
    header('Content-Length: ' . filesize($zipfilename));
    readfile($zipname);
?>