<?php include("../db.php"); 

    $folder_id = $_GET["folder"];
    
    $sql_folders = "SELECT * FROM items WHERE id = '$folder_id'";
	$result_folders = $conn->query($sql_folders);
	if ($result_folders->num_rows > 0) {   
	while($row_folders = $result_folders->fetch_assoc()) {
		$file = $row_folders["file_name"];
		$file_name = $row_folders["name"];
	
    
    $file = '../files/'.$file;
    
    if(!file_exists($file)){ // file does not exist
        die('file not found');
    } else {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
    
        // read the file from disk
        readfile($file);
    }
    
	} } else { } 
?>