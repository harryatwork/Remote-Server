<?php
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "remote_server";
	$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    define('HOST','localhost');
	define('USERNAME', 'root');
	define('PASSWORD','');
	define('DB','remote_server');
	$con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
	$con->set_charset('utf8mb4');
	$db = new PDO('mysql:host=localhost;dbname=remote_server','root','');

	session_start();
?>