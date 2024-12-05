<?php
alert('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'); 
$hyscode=$_POST['mcode'];
$strSQL = "SELECT * FROM sys_hys_mest WHERE mys_code= '$hyscode' ;
$result = mysqli_query($conn,$strSQL);
$count = mysqli_num_rows($result);
$data=array();
while($rs=mysqli_fetch_array($result)) 
{

    $mys['myscode']=$rs['mys_code'];
    $mys['mysbuild']=$rs['mys_build'];
    $mys['mysfloor']=$rs['mys_floor'];
    // $mys['locatio']=$rs['mys_location'];
    // $mys['schedule']=$rs['mys_schedule'];
    array_push($data,$mys);    
}
-- // if($count==1){
-- //     print json_encode($data); 
-- //  }else{
-- //     echo $count; 
-- //  } 
?>