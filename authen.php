<?php   
	require_once("db/connection.php"); 	
	$user = mysql_real_escape_string(@$_POST['username']);
	$pass = mysql_real_escape_string(@$_POST['password']);
	$ip = @$_POST['show_ip'];
	$os = @$_POST['user_os'];
	$browser = @$_POST['user_browser'];
	$timezone = "Asia/Bangkok";
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	$thistime = date("Y-m-d H:i:s");

	$sql = "SELECT 
		*
		FROM employee
		WHERE username ='$user' AND passw ='$pass' ";	// Download data
	$resultd = mysqli_query($conn,$sql) or die(mysql_error()); 
    $rsd=mysqli_fetch_array ($resultd, MYSQL_ASSOC );  
	
	if (!empty($rsd['idcard'])) {
		$status = "Success";
		// $web_login = "_e-HYcenter_";
		$idcard = $rsd['idcard'];
		$name = $rsd['name'];
		// $hn = $rsd['hn'];

		if(!isset($_SESSION)) {  
            session_start();  
        }
        // $_SESSION['sess_userid']=session_id().$web_login.$rsd['idcard'];
        // $_SESSION['web_login']=$web_login;
        $_SESSION['sess_log_time']=$thistime;
		// $_SESSION['hn'] = $hn;
		$_SESSION['username']  = $rsd['username'];
		$_SESSION['name'] =$rsd['name'];
		$_SESSION['ip'] =$ip;
		$_SESSION['os'] =$os;
		$_SESSION['browser'] =$browser;
		// $_SESSION['privilage'] =$rsd['hisgroup_priv'];
		
	// Record Authen Satus
	$sql2 = "insert into sys_log_login 
	     value (null,'$name','$idcard',null,'$ip','$os','$browser','$thistime','$status',null,null,null)" ;
	$result2 = mysqli_query($conn,$sql2);
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=sys_admin.php\">";
	}
	else {
		$status = "มีปัญหาในการ ล็อคอิน ";
		$web_login = "_e-Hycenter_";
		$loginname = $user;
		//Record Authen Satus
	    $sql2 = "insert into sys_log_login 
			value (null,'$name','$idcard',null,'$ip','$os','$browser','$thistime','$status',null,null,null)" ;
	   $result2 = mysqli_query($conn,$sql2);
		$message = "Login Fail<br>โปรดลองใหม่อีกครั้ง";
		echo "<meta http-equiv=\"refresh\" content=\"0;URL=./error.php?message=$message\">";
	}
		mysqli_close($conn);
?>