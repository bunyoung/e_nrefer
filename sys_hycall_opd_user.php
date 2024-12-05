<?php session_start();
include('main_script.php');

$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
$user_idx=$_SESSION['user_idx'];

if ($user_id=='' || $user_idx==''){
	echo "<script type='text/javascript'>window.location='sys_hycall_opd_login.php';</script>";
}else {
  echo '<script type="text/javascript">
        swal("", "xxxxxxxxxxxxxxxxxxx" , "success");
       </script>';
}
?>