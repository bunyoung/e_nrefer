<?php 
include_once('db/connection.php');
$sql="SELECT id,name FROM rf_sindication WHERE s_mdepid={$_GET['s_mdepid']} AND status='Y' ";
$query=mysqli_query($conn,$sql);
$json = array();
while($result=mysqli_fetch_assoc($query)){
    array_push($json,$result);
}
echo json_encode($json);