<?php
require('./db/connection.php');

if(isset($_GET['id']))
{
     $sql = "DELETE FROM rf_detail WHERE rf_id=".$_GET['id'];
     $sqld=mysqli_query($conn,$sql);
    //  header('location:sys_hycall_monitor_now_a.php');
    exit;
}
exit;
?>