<?php
// Set the JSON header
header("Content-type: text/json");
include 'db/connection.php';

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;

$sql="SELECT * FROM v_asmonitor_b";
$query=mysqli_query($conn,$sql);

$data = array(); 
while($rs=mysqli_fetch_array($query)) {
    $a['dgroup']     = $rs['dgroup'].'-'.$rs['hyitem'];
    $a['assname'] = $rs['assname'];
    $a['firstplace']    = $rs['fplace'];
    $a['fplace']    = $rs['nfplace'];
    $a['tplace']    = $rs['ntplace'];
    $a['hdate']    = $rs['hdate'];
    $a['htime']    = $rs['htime'];
    $a['x1_pertime']    = $rs['x1_pertime'];
    $a['perto']    = $rs['perto'];
    $a['perfinish']    = $rs['perfinish'];
    $a['name']    = $rs['name'];
    $a['usetimeAll']    = $rs['usetimeAll'];
    $a['endjoba']    = $rs['typea'];
    $a['endjobb']    = $rs['typeb'];
    $a['endfinish']    = $rs['perrend'];
    if($rs['x1'] =='F'){
        $a['status']    = 'จบงาน';
    }else{
        if($rs['x1']=='C'){
            $a['status']    = 'ยกเลิก';
        }else{
            if($rs['x1']=='W'){
                $a['status']    = 'รอดำเนินการ';
            }
        }
    }
    array_push($data,$a);
}

print json_encode($data); 
?>