<?php
if(!isset($_SESSION)) { 
         session_start(); 
     }
?>

<?php
include('main_script.php');
include('db/connection.php');
$u=strtoupper($_POST['login']);

$sql="
SELECT *
FROM  e_mdepart
WHERE  m_code='$u'
    AND m_passw='".$_POST['psword']."' ";

$query = mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($query);
$row=mysqli_fetch_array($query, MYSQL_ASSOC);
if($numrow==1){
    $_SESSION['n_depart']=strtoupper($row['m_code']).''.$row['m_depname'];
    $_SESSION['n_code']=$row['m_code'];
    $sm_code =  $_SESSION['n_code'];
    echo "<script type='text/javascript'>window.location='sys_hycall_consult_p4p.php';</script>";
}else{
    echo "<script type='text/javascript'>";
    echo "window.location='sys_hycall_center_error.php?hd=s&do=nof';";
    echo "</script>";
}
mysqli_close($conn);
?>