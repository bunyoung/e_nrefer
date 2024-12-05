<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];
?>

<!doctype html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js">
</script>

<?php
require_once("db/connection.php");
#variable from post
$rid=$_POST['rid_p'];
?>
<?php
$resultAll = mysqli_query($conn, "SELECT rf_id AS rfn FROM v_rf_detail WHERE rf_id=$rid " );
if(!$resultAll){
	die(mysqli_error($conn));
}

//  ส่วนการนับลำดับของการ refer เพื่ออกเลข
$n='00001';
// จบตรงนี้

if (mysqli_num_rows($resultAll) > 0) {
	while($rs = mysqli_fetch_array($resultAll)){
  		if($rs["rfn"] >'0'){
            $n=$rs["rfn"]; 
            if(strlen($n)=='1'){
                $n= '0000'.$n;
            }else if(strlen($n)=='2'){
                $n= '000'.$n;
            }else if(strlen($n)=='3'){
                $n= '00'.$n;
            } else if(strlen($n)=='4'){
                $n= '00'.$n;
            }else if(strlen($n)=='5'){
                $n= '0'.$n;
            }
        }
	}
}
?>

<?php
$sql = "
SELECT *
FROM v_rf_detail
WHERE rf_id='$rid' ";
$result_sql = mysqli_query($conn,$sql);
$rs=mysqli_fetch_array ($result_sql);
// วันที่ + เวลา
$rfdate = $rs['rf_date'];
$rft=$rs['rf_time'];
// ประเถทการ Refer
$rfev = $rs['rfevent'];
//  hn
$rfhn=$rs['rf_hn'];
// ชื่อนามสกุล
$rfpt = $rs['rf_patients'];
// รพ ปลายทาง
$rfs = $rs['hossendto_name'];
$nreter=$rs['m_code'].'-'.$rs['rf_hospital'].'-'.$rs['rf_hos_send_to'].'-'.'0'.$rs['rf_rfev'].'-'.$n;
?>
<div id="content3"
     style="font-family:sarabun;font-size:15px;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;"">
    <p>
    <form class=" form-horizontal" action="insert_regis_referdb.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-lg-4">ออกเลข Refer :
        </label>
        <div class="col-lg-4">
            <input type="text" id="rno" name="rno" class="form-control" value="<?php echo $nreter;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-4">ชื่อ-สกุล </label>
        <div class="col-lg-4">
            <input type="text" id="name" name="name" placeholder="ชื่อ-สกุล" class="form-control" disabled
                   value="<?php echo $rfpt;?> ">
        </div>
    </div>
    <div class="form-group">
        <label for="cid" class="control-label col-lg-4">วันที่ เวลา </label>
        <div class="col-lg-3">
            <input type="text" id="nid" name="nid" class="form-control" disabled
                   value="<?php echo $rfdate .' '.$rft;?>">
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label for="username" class="control-label col-lg-4">ประเภทการ Refer </label>
        <div class="col-lg-3">
            <input type="text" id="username" name="username" placeholder="username" class="form-control" disabled
                   value="<?php echo $rfev;?>">
        </div>
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label for="password" class="control-label col-lg-4">รพ. ปลายทาง
        </label>
        <div class="col-lg-6">
            <input type="text" id="text" name="text" class="form-control" disabled value="<?php echo $rfs;?>">
        </div>
    </div>
    <!-- /.row -->
    <div class="form-group">
        <label class="control-label col-lg-4">
        </label>
        <input type="hidden" name="rfid" value="<?php echo $rid;?>">
        <input type="hidden" name="fno" value="<?php echo $rs['rf_hospital'];?>">
        <input type="hidden" name="rfno" value="rfno">
        <div class="col-lg-4">
            <button type="submit" class="btn btn-primary btn-grad">บันทึกรายการ
            </button>
        </div>
    </div>
    </form>
    </p>
</div>

</html>