<?php   
    $idletime= 1600;//after xx seconds the user gets logged out

    if ((time()-@$_SESSION['timestamp'])>$idletime){
     #update logout	
	require_once("db/connection.php");
	$session=@$_SESSION['ID'];
	$session_log_time=@$_SESSION['sess_log_time'];
	
	$timezone = "Asia/Bangkok";	
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	$thistime = date("Y-m-d H:i:s");
	$sql2 = "update sys_log_login 
			set logout='SessionExpire',
				logout_time='$thistime'
			WHERE session='$session' and log_time='$session_log_time' " ;
	$result2 = mysql_query($sql2, $conn); 	

	#KILL SESSION	  	
    session_destroy();
    session_unset();
    }else{
    @$_SESSION['timestamp']=time();
    }
	@$_SESSION['timestamp']=time();
?>