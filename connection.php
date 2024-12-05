<?php
// $host = "192.168.99.15";
$host = "localhost";

$user = "root"; // MySql Username
$pass = ""; // MySql Password
$dbname = "e_hycenter"; // Database Name

$conn = mysqli_connect($host, $user, $pass,$dbname) or die("Error: " . mysqli_error($con)); // เชื่อมต่อ ฐานข้อมูล
        mysqli_query($conn, "SET NAMES 'utf8' ");
		error_reporting( error_reporting() & ~E_NOTICE );
		date_default_timezone_set('Asia/Bangkok');
if(!$conn) {
	exit('Connect Error (' . mysqli_connect_errno() . ') '
    . mysqli_connect_error());
}
