<?php
include('db/connect_pmk.php');
<!-- วันที่ปัจจุบัน -->
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;

$sql ="SELECT  *  FROM v_monitor  WHERE  hdate = '$d_default' order by name; ";
$result_sql = mysqli_query( $conn,$sql);
$data=array();
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
    $a['hyno'] = $arr['hyitem']; 
    $a['hn'] = $arr['hn']; 
    $a['name'] = $arr['patients'];
    $a['rfrom'] = $arr['fplace'];
    $a['rto'] =  $arr['tplace'];
    $a['psick'] = $arr['assname'];
    $a['htype'] = $arr['hassnamea'];
    $a['htypeplus'] = $arr['hassnameb'];
    $a['patients'] =  $arr['sicka'].','.$arr['sickb'].','.$arr['sickc'];
    $a['pstart'] =  $arr['htime'];
    $a['preceiv'] =  $arr['x1_pertime'];
    $a['employee'] =  $arr['name']; 
    array_push($data,$a);
}
oci_close($objConnect);
print json_encode($data);
?>