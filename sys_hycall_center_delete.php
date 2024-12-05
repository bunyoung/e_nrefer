<?php 
include "db/connection.php";
if(isset($_GET['id'])){
    $sql="DELETE from e_cons_detail WHERE cons_id =".$_GET['id'];
    mysqli_query($conn,$sql);
    echo 'ลบรายการนี้ให้เรียบร้อยแล้ว';
    exit;
}
echo 0;
exit;
// if(isset($_POST['id'])){
//     $id=  $_POST['id'];
//      $sql="DELETE from e_cons_detail WHERE cons_id =".$id;
//     mysqli_query($conn,$sql);
//     echo 1;
//     exit;
//  }
 
//  echo 0;
//  exit;