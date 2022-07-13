<?php header('Access-Control-Allow-Origin: *'); ?>
<?php include("../db.php"); 


    $sub_id = $_POST["sub_id"];
    $chat_loader_whatsapp = $_POST["chat_loader_whatsapp"];
    $file = ($_FILES['file']['name']);

    $date = date_default_timezone_set('Asia/Kolkata');
    $date = new DateTime();
    $time_stamp =  $date->getTimestamp();
    $date2 = date("Y-m-d H:i:s");

    $target_dir = "../uploads_through_chat_module/";

    $sql_chat = "SELECT * FROM chats WHERE number = '$chat_loader_whatsapp'";
	$result_chat = $conn->query($sql_chat);
	if ($result_chat->num_rows > 0) {                               
	while($row_chat = $result_chat->fetch_assoc()) {
		$u_id = $row_chat["id"];
	} } else { } 

        $time_stamp = $time_stamp;

        $target_file = $target_dir . basename($_FILES["files"]["name"]);
        $uploadOk = 1;
        $imageFileType = ucfirst(strtolower(pathinfo($target_file,PATHINFO_EXTENSION)));

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            $time_stamp = $time_stamp + rand(1,50);
            $temp = explode(".", $_FILES["file"]["name"]);
            $file_name = $_FILES["file"]["name"];
            $newfilename = $time_stamp.'-'.($_FILES["file"]["name"]);
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir .$newfilename)) {
                
                 $link_file_name = 'https://vdofyfilex.com/uploads_through_chat_module/'.$newfilename;
                
                 $sql1 = "INSERT INTO chat_messages (u_id, message, type, by_whom, sub_id, status, date)
                 VALUES ('$u_id', '$link_file_name', 'file', 'studio', '$sub_id', 'viewed', '$time_stamp')";
                 if ($con->query($sql1) === TRUE) { 
                    $video_id = $con->insert_id;
                   
                   echo 'sent';
                   
                 } else { echo "ERROR" . $sql1 . "<br>" . $conn->error; }
                
            } else { }
        }


    // Whatsapp API - Chat-API
	$data2 = [
		'phone' =>	'91'.$chat_loader_whatsapp, 
		'body' => $link_file_name, 
		'filename' => $file_name,
		'metadata' => 'VDOfy',
	];
	$json2 = json_encode($data2); 
	$token2 = '2jrpj6v32qc0ncyv';
	$instanceId2 = '243079';
	
	$url2 = 'https://api.chat-api.com/instance'.$instanceId2.'/sendFile?token='.$token2;

	$options2 = stream_context_create(['http' => [
			'method'  => 'POST',
			'header'  => 'Content-type: application/json',
			'content' => $json2
		]
	]);
	$result2 = file_get_contents($url2, false, $options2);

?>