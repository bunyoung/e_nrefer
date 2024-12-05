<?php 
include_once('db/connection.php');
/* $rfd=$_POST['rfd'];

// $vpl="SELECT * FROM rf_mindication WHERE m_depid = '$rfd' AND status='Y' ";
// $rvp=mysqli_query($conn,$vpl);
// while($rso = mysqli_fetch_array($rvp)) 
// { 
    ?>
//     <option value="<?=$rso["id"];?>">
//             <?=$rso["id"].' - '.$rso["indication"];?>
//     </option>     
//     <?php  
// }       
// mysqli_close('$conn') ;
?>
*/
$sql="SELECT * FROM rf_mindication WHERE m_depid ={$_GET['m_depid']} AND status='Y' ";
$query=mysqli_query($conn,$sql);
$json=array();
while($result=mysqli_fetch_assoc($query)){
    array_push($json,$result);
}
echo json_encode($json);

