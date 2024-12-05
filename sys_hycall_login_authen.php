<?php session_start(); ?>
<?php
include('main_script.php');
include('db/connection.php');

$sql="SELECT *
 FROM doc_dbfs
 where doc_code='".$_POST['login']."' AND checkword='".$_POST['psword']."' ";

$query = mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($query);
$row=mysqli_fetch_array($query, MYSQL_ASSOC);


if($numrow==1){

    $_SESSION['user_name']=$row['prename'].''.$row['name'].'  '.$row['surname'];
    $_SESSION['user_id']=$row['doc_code'];
    $_SESSION['user_idx']=$row['prename'].''.$row['name'].' '.$row['prename'];
	echo "<script type='text/javascript'>window.location='sys_hycall_center_view.php';</script>";
}else{
    echo "<script type='text/javascript'>";
    echo "window.location='sys_hycall_center_error.php?hd=s&do=nof';";
    echo "</script>";
}
?>