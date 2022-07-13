<?php ob_start();
      include("db.php"); 
    if(!isset($_SESSION['email'])) {
        header("Location: sign");  
    }
    $email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Vdofy</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.pngs" type="image/png" />
	<!-- Vector CSS -->
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&amp;family=Roboto&amp;display=swap" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/css/app.css" />
	
	
	<link href="assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
	<link href="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	
	<!-- Chunk upload starts --->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.2/plupload.full.min.js" integrity="sha512-+F2bTlYeSZrUs0uNo8OsYlE4tbdEoGp3Hhur4V+4o4nmsljKKDgCexLpqc5mERevdiOqthT4SVL+SHhz4lyfcA==" crossorigin="anonymous"></script>
    <!-- Chunk upload ends --->

<style>
.notification {
    display:none;
    position: fixed;
    top: 90%;
    left: 55%;
    transform: translate(-55%, 90%);
    background: #C86E3E;
    padding: 5px 10px;
    border-radius: 7px;
}

#filelist > div > b > span {
    float:right;
}
</style>	
	
</head>
