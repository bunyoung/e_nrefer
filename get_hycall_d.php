<?php
header("Content-type: text/json");
include 'db/connection.php';

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;

$sql="SELECT * FROM v_p4_month_year_06_09_2564 WHERE hdate='$d_default' ";
$query=mysqli_query($conn,$sql);

$data = array(); 
while($rs=mysqli_fetch_array($query)) {
    $a['hyitem']     = $rs['hyitem'];
    $a['hdate']    = $rs['hdate'];
    $a['fasts_name']     = $rs['fasts_name'];
    $a['hassnamea']         = $rs['hassnamea'];
    $a['hn']      = $rs['hn'];
    $a['patients'] = $rs['patients'];
    $a['old']     = $rs['old'];
    $a['idcard']     = $rs['idcard'];
    $a['pers']      = $rs['pers'];
    $a['name']      = $rs['name'];
    $a['fplace'] = $rs['fplace'];
    $a['tplace']      = $rs['tplace'];
    $a['htime']  = $rs['htime'];
    $a['x1_pertime']       = $rs['x1_pertime'];
    $a['perto'] = $rs['perto'];
    $a['perfinish']    = $rs['perfinish'];
    $a['usetimeAll']  = $rs['usetimeAll'];
     
    array_push($data,$a);
}

print json_encode($data); 
?>