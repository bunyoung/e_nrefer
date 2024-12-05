<?php 
// if(!isset($_SESSION)) {
session_start();
// }
$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
$user_idx=$_SESSION['user_idx'];

if ($user_id=='' || $user_idx==''){
	echo "<script type='text/javascript'>window.location='sys_hycall_login_p4p.php';</script>";
}else {
  echo '<script type="text/javascript">
        swal("", "ไม่พบ User name หรือ password ที่ใช้" , "success");
       </script>';
/*    echo '<meta http-equiv="refresh" content="1;url=sys_hycall_center_now.php" />'; */
}
?>