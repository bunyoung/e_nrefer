<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"> </script>
</head>
<?php   
	require_once("db/connection.php"); 	
	require_once("db/check_client.php"); 	
	$sip=@$_SERVER['REMOTE_ADDR'];
?>
<?php
$os        		=   getOS(); 
$browser    =   getBrowser();
// $show_ip   =   $_SERVER['REMOTE_ADDR'];
$user =$_POST['username'];
$pass =MD5($_POST['password']);
$ip = @$_POST['show_ip'];
$os = @$_POST['user_os'];
$timezone = "Asia/Bangkok";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$thistime = date("Y-m-d H:i:s");
?>

<body>
    <?php
	$sql = "SELECT * FROM v_view_users WHERE user ='$user' AND pass ='$pass' ";
	$resultd = mysqli_query($conn,$sql);
	$rsd=mysqli_fetch_array ($resultd);
	$hcode = $rsd['hcode'];
	if (!empty($rsd['hcode'])) {
	$status = "Success";
	$hcode = $rsd['hcode'];
	
	$db_database =$rsd['hisdatabase'];
	$db_host=$rsd['hisip'];
	$db_username=$rsd['hisuser'];
	$db_upassword=$rsd['hispassword'];
	$db_hisprogram=$rsd['hisprogram'];
	
	if(!isset($_SESSION)) {
	session_start();
	}
	$_SESSION['sess_log_time']=$thistime;
	$_SESSION['username'] = $rsd['user'];
	$_SESSION['hcode'] =$rsd['hcode'];
	$_SESSION['hosname'] =$rsd['hosname'];
	$_SESSION['ip'] =$ip;
	$_SESSION['db'] =$os;
	$_SESSION['browser'] =$browser;
	$_SESSION['dtem']='1';
	// ใช้ในส่วนการเชื่อมต่อ Database ต่าง ๆ
	$_SESSION['db_name'] =$rsd['dbname'];
	$_SESSION['db_host']=$rsd['hisip'];
	$_SESSION['db_user']=$rsd['hisuser'];
	$_SESSION['db_pass']=$rsd['hispassword'];
	$_SESSION['db_hisp']=$rsd['hisprogram'];
	$sql2 = "insert into rf_log_login (hcode,ipaddress,logintime,status,logouttime,loginout,login,logout,browser,os)
	values ('$hcode','$sip','$thistime','$status',null,'1','Login',null,'$browser','$os')" ;
	$result2 = mysqli_query($conn,$sql2);
	echo "
	<meta http-equiv=\"refresh\" content=\"0;URL=main_center_refer.php\">";
	}else{
	$status = "มีปัญหาในการ ล็อคอิน";
	$sql2 = "insert into rf_log_login (hcode,ipaddress,logintime,status,logouttime,loginout,login,logout,browser,os)
	values ('$hcode','$sip','$thistime','$status',null,'1','Login',null,'$browser','$os')" ;
	$result2 = mysqli_query($conn,$sql2);
	echo '<script type="text/javascript">
			       swal("Warning", "รหัสผู้ใช้านหรือรหัสผ่านไม่ตรงกับที่กำนหนด ไม่สามารถดำเนินการต่อได้ !!", "error");
	         </script>';
	}
	echo "<meta http-equiv=\"refresh\" content=\"4;URL=dashboard.php\">";
	?>
</body>
<?php
	mysqli_close($conn);
 ?>

</html>