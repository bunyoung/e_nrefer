<?php
require('./db/connection.php');
if(isset($_GET['id']))
{
     $sql = "DELETE FROM rf_detail  WHERE rf_id=".$_GET['id'];
     $rdel = mysqli_query($conn,$sql);
     echo 'ลบข้อมูลเรียบร้อยแล้ว';
}


?>