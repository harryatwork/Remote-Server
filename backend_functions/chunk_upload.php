<?php include('../db.php');

$date = date_default_timezone_set('Asia/Kolkata');
$date = new DateTime();
$date2 = date("Y-m-d H:i:s");  
$time_stamp =  $date->getTimestamp();

$parent = $_COOKIE["parent_folder"];
$full_url = $_COOKIE["full_url"];
$sub_id = $_COOKIE["sub_id"];

if($parent == '') {
    $parent_id = 0;
} else {
    $parent_id = $parent;
}




// RESPONSE FUNCTION
function verbose($ok=1,$info=""){
  // THROW A 400 ERROR ON FAILURE
  if ($ok==0) { http_response_code(400); }
  die(json_encode(["ok"=>$ok, "info"=>$info]));
}
// INVALID UPLOAD
if (empty($_FILES) || $_FILES['file']['error']) {
  verbose(0, "Failed to move uploaded file.");
}
// THE UPLOAD DESITINATION - CHANGE THIS TO YOUR OWN
$filePath = __DIR__ . DIRECTORY_SEPARATOR . "../files";
if (!file_exists($filePath)) { 
  if (!mkdir($filePath, 0777, true)) {
    verbose(0, "Failed to create $filePath");
  }
}
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];
$imageFileType = ucfirst(strtolower(pathinfo($fileName,PATHINFO_EXTENSION)));
$fileSizeInBytes = $_FILES['file']['size'];
$fileName_new = $time_stamp.'-'.$fileName;
$filePath = $filePath . DIRECTORY_SEPARATOR . $fileName;
$filePath_2 = '/home2/vdofybzn/public_html/backend_functions/../files' . DIRECTORY_SEPARATOR . $fileName_new;
// DEAL WITH CHUNKS
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
if ($out) {
  $in = @fopen($_FILES['file']['tmp_name'], "rb");
  if ($in) {
    while ($buff = fread($in, 4096)) { fwrite($out, $buff); }
  } else {
    verbose(0, "Failed to open input stream");
  }
  @fclose($in);
  @fclose($out);
  @unlink($_FILES['file']['tmp_name']);
} else {
  verbose(0, "Failed to open output stream");
}
// CHECK IF FILE HAS BEEN UPLOADED
if (!$chunks || $chunk == $chunks - 1) {
  rename("{$filePath}.part", $filePath_2);
  
  $sql1 = "INSERT INTO items (name, type, file_name, parent, state, size, bywhom, timestamp, date)
  VALUES ('$fileName', '$imageFileType', '$fileName_new', '$parent_id', 'Live', '$fileSizeInBytes', '$sub_id', '$time_stamp', '$date2')";
  if ($con->query($sql1) === TRUE) { } else { echo "ERROR" . $sql1 . "<br>" . $conn->error; }
  
}
verbose(1, "Upload OK");



?>