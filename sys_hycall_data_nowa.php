<?php
header("Content-type: text/json");
include 'db/connection.php';

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;

$sqlb ="SELECT p4_month,p4_year,wtime,name,a26,a32,a33,a34,a35,a36,a37,a38,a39,a40,a44,a45,a46,total 
        FROM v_wperson WHERE name is not Null";
$query=mysqli_query($conn,$sqlb);

$data = array(); 
while($rsb=mysqli_fetch_array($query)) {
    $a['p4_month'] = $rsb['p4_month'];
    $a['p4_year']  = $rsb['p4_year'];
    $a['htime']    = $rsb['htime'];
    $a['name']     = $rsb['name'];
    $a['a26'] = $rsb['a26'];
    $a['a32'] = $rsb['a32'];
    $a['a33'] = $rsb['a33'];
    $a['a34'] = $rsb['a34'];
    $a['a35'] = $rsb['a35'];
    $a['a36'] = $rsb['a36'];
    $a['a37'] = $rsb['a37'];
    $a['a38'] = $rsb['a38'];
    $a['a39'] = $rsb['a39'];
    $a['a40'] = $rsb['a40'];
    $a['a44'] = $rsb['a44'];
    $a['a45'] = $rsb['a45'];
    $a['a46'] = $rsb['a46'];
    $a['total'] = $rsb['total'];
    array_push($data,$a);
}

print json_encode($data); 
?>