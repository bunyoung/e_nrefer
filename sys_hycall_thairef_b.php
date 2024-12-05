<?php
include('./db/connection_thairefer.php');
$id=$_REQUEST['rid'];
$sql=mysqli_query($conr,"SELECT memo FROM referout_reply WHERE referout_no='$id' ");
while($rs=mysqli_fetch_array($sql)){
    echo $rs['memo'].'<br>';
}
?>