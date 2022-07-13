<?php include("../db.php");

    $f = $_GET["f"];
    $folder_name = $_GET["folder_name"];
    $current_folder = explode("/", $folder_name);
    $current_folder = end($current_folder);
    

    $sql_file_size_update = "SELECT * FROM items WHERE state = 'Live'";
	$result_file_size_update = $conn->query($sql_file_size_update);
	if ($result_file_size_update->num_rows > 0) {   
	while($row_file_size_update = $result_file_size_update->fetch_assoc()) {
		$file_id = $row_file_size_update["id"];
		$file_name = $row_file_size_update["file_name"];
		
		$file_size = filesize("../files/".$file_name); 
		
        $sql = "UPDATE items SET size = '$file_size'
	            WHERE id = '$file_id'";
                if ($conn->query($sql) === TRUE) { } else { echo "ERROR" . $sql . "<br>" . $conn->error; }

	} } else { }
	
	header("Location: ../folder?f=$f&/$current_folder");
	
?>