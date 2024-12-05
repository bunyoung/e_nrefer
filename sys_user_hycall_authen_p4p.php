<?php session_start(); ?>
<?php
include('main_script.php');
include'db/connection.php';

$sql="
 SELECT *
 FROM employee
 where username='".$_POST['login']."' and passw='".$_POST['psword']."'
";

$query = mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($query);
$row=mysqli_fetch_array($query, MYSQL_ASSOC);


if($numrow==1){

    $_SESSION['user_name']=$row['name'];
    $_SESSION['user_id']=$row['idcard'];
    $_SESSION['user_idx']=$row['username'];
	echo "<script type='text/javascript'>window.location='sys_hycall_admin_login_p4p.php';</script>";
}else{
    echo "<script type='text/javascript'>";
    echo "window.location='sys_hycall_center_error.php?hd=s&do=nof';";
    echo "</script>";
}
?>