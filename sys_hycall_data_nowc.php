<?php
header("Content-type: text/json");
include('db/connection.php');

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;

$sqlc ="SELECT hdate,hn,patients,old,idcard,fasts_name,pers,fplace,htime,tplace,x1_pertime,
        perto,perfinish,usetime,usetimeAll FROM v_p4_month_year WHERE name is not Null";
$query=mysqli_query($conn,$sqlc);

$data = array(); 
while($rsb=mysqli_fetch_array($query)) {
    $a['hdate']       = $rsb['hdate'];
    $a['hn']          = $rsb['hn'];
    $a['patients']    = $rsb['patients'];
    $a['old']         = $rsb['old'];
    $a['idcard']      = $rsb['idcard'];
    $a['fasts_name']  = $rsb['fasts_name'];
    $a['pers']        = $rsb['pers'];
    $a['fplace']      = $rsb['fplace'];
    $a['htime']       = $rsb['htime'];
    $a['tplace']      = $rsb['tplace'];
    $a['x1_pertime']  = $rsb['x1_pertime'];
    $a['perto']       = $rsb['perto'];
    $a['perfinish']   = $rsb['perfinish'];
    $a['usetime']     = $rsb['usetime'];
    $a['usetimeAll']  = $rsb['usetimeAll'];
    array_push($data,$a);
}

print json_encode($data); 
?>