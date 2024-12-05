<?php
// header("Content-type: text/json");
include("db/connection.php");
?>

<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php
$sql ="SELECT * FROM v_monitor WHERE hdate='$d_default' order by name";
// $sql ="SELECT * FROM v_monitor WHERE hdate=$d_default order by name ";
$result_sql = mysqli_query( $conn,$sql);
$data = array();

while($rs=mysqli_fetch_array($result_sql)) {
 $a['hyitem']       = $rs['hyitem'];
 $a['hn']           = $rs['hn'];
 $a['patients']     = $rs['patients'];
 $a['fplace']       = $rs['fplace'];
 $a['tplace']       = $rs['tplace'];
 $a['assname']      = $rs['assname'];
 $a['hassnamea']    = $rs['hassnamea'];
 $a['hassnameb']    = $rs['hassnameb'];
 $a['sick']         = $rs['sicka'].' '.$rs['sickb'].' '.$rs['sickc'].' '.$rs['sickd'].' '.$rs['sicke'].' '.$rs['sickf'].' '.$rs['sickg'];
 $a['htime']        = $rs['htime'];
 $a['x1_pertime']   = $rs['x1_pertime'];
 $a['perto']        = $rs['perto'];
 $a['name']         = $rs['name'];
 if($rs['x1']=='C'){
     $a['status']   = '<a class="btn btn-danger btn-grad"><i class="fa fa-thumbs-o-up"></i>: กำลังดำเนินการ </a>';
 }else{
     if($rs['x1']=='F'){
        $a['status']= '<a class="btn btn-success btn-grad"><i class="fa fa-thumbs-o-up"></i>: ดำเนินการสิ้นสุด </a>';
     }else{
        $a['status']= '<a class="btn btn-info btn-grad"><i class="fa fa-times"></i>  : รอดำเนินการ </a>';
     }
 }
 $a['x1']         = $rs['x1'];
 array_push($data, $a);
}
print json_encode($data);
?>