<!doctype html>
<meta http-equiv="content-type" content=";text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php session_start();
// include('main_script.php');

$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];
$user_idx=$_SESSION['user_idx'];

if ($user_id=='' || $user_idx==''){
	echo "<script type='text/javascript'>window.location='sys_hycall_login.php';</script>";
}else {
  echo '<script type="text/javascript">
        swal("", "ให้ทำการ Login เข้าสู่ระบบ ก่อนดำเนินการ" , "success");
       </script>';
}
?>

<?php
// require_once('sys_hycall_user.php');
require_once("db/connection.php");
require_once("db/date_format.php");
?>

<?php
#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult='01/' ;
# $date_start_m_defult=date('m/');
$date_start_m_defult='01/';
$date_start_y_defult=date('Y')+543 ;
$date_start_dmy_defult	= $date_start_d_defult.$date_start_m_defult.$date_start_y_defult;
// 01/m/y+543

$date_end_dm_defult=date('d/m/') ;
$date_end_y_defult=date('Y')+543 ;
$date_end_dmy_defult=$date_end_dm_defult.$date_end_y_defult;
// d/m/y+543

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;

// วันที่ปัจจุบัน
$d_default=$date_curr_dmy_defult;

$d_start_post = @$_POST['d_start'];
$d_end_post = @$_POST['d_end'];
IF(!empty($d_start_post)){
$d_start = $d_start_post ;
}ELSE{
$d_start = $date_start_dmy_defult;
}
IF(!empty($d_end_post) ){
$d_end = $d_end_post ;
}ELSE{
$d_end = $date_end_dmy_defult;
}
$d_start_cal = substr($d_start,0,2).substr($d_start,3,2).substr($d_start,6,4) ;
$d_end_cal =  substr($d_end,0,2).substr($d_end,3,2).substr($d_end,6,4) ;
$date_m= $d_end;
?>

<html class="no-js">

<head>
    <?php
    include('main_top_panel_head.php');
    include('main_script.php');
?>
</head>
<?PHP
if(@$_POST['RFEDIT'])
{
$consid=@$_POST['hy_cons'];
$update=date("d-m-Y");
$uptime=date("H:i:s");
$pstatus='C';
$opt=@$_POST['opt'];
$dcomment=$_POST['d_comment'];

$sql_hycenter = "
    UPDATE e_cons_detail
    SET comment=TRIM('$dcomment'),status='C',doc_time='$update',
    doc_date='$update',doc_time='$uptime',e_option='$opt'
    WHERE cons_id='$consid'; ";
$result_comment = mysqli_query($conn,$sql_hycenter); mysql_error();

if ($result_comment== TRUE) {
   $error1 = ' UPDATER ให้คำปรึกษา';
   $error2 = ' บันทึกให้คำปรึกษา เรียบร้อยแล้ว';
 }else {
   $error1 = ' Update Error ';
   $error2 = ' ไม่สามารถดำเนินการได้  ';
 }
}
?>
<body onload=”javascript:setTimeout(“location.reload(true);”,60000);”>
    <script>
    $(function() {
        Metis.dashboard();
    });
    </script>
    <p>
    <div class="fluid">
        <div class="exTab">
            <ul class="nav nav-tabs" style="color:#330066;font-weight: bold;margin-top:-18px;">
                <li class="active">
                    <a data-toggle="tab" href="#home">
                        <i class="fa fa-medkit fa-lg" style="color:orange;">
                        </i> รายการรอตอบ[Consult]
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#menu">
                        <i class="fa fa-ambulance fa-lg" aria-hidden="true" style="color:yellow;">
                        </i> รายการที่่[Consult]
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#" class="button btn-success">
                        <i class="fa fa-clock-o" aria-hidden="true"
                            style="color:green;font-size: 1.2em;font-weight: bold;"> </i>
                        <strong>ประจำวันที่ :<?=$d_default; ?></strong><strong id="timer"></strong>
                    </a>
                </li>
            </ul>

            <p>
            
            <!-- รายการที่่[Consult] -->
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <div id="content3">
                        <div class="inner bg-light lter" style="margin-top: -10px;">
                            <?php include('sys_hycall_center_asset_nowa.php'); ?>
                        </div>
                    </div>
                </div>

                <div id="menu" class="tab-pane fade">
                    <div id="content3">
                        <div class="inner bg-light lter" style="margin-top: -10px;">
                            <?php include('sys_hycall_center_asset_nowb.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
$(function() {
    Metis.MetisTable();
    Metis.metisSortable();
});
</script>

<script type="text/javascript" src="assets/js/jquery.js"> </script>
<script type="text/javascript" src="assets/js/jquery.min.js"> </script>
<script type="text/javascript" src="assets/js/jquery-ui.min.js"> </script>
<script type="text/javascript" src="assets/lib/moment/min/moment.min.js"> </script>
<!--TABLE  -->
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js">
</script>
<script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js">
</script>
<script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js">
</script>

<script type="text/javascript">
var h = '';
$(document).ready(function() {
    //chk_hour();
    setInterval(getnow, 1000);
});

function chk_hour() {
    datetime = new Date();
    var x = datetime.getHours();
    if (h != x) {
        //console.log('aaa');
        upload_bed_color();
        h = x;
    }
    setInterval(chk_hour, 1000 * 5);
}


function getnow() {
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var hh = d.getHours();
    var mm = d.getMinutes();
    var ss = d.getSeconds();

    var datenow = +(day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + d.getFullYear();
    var timenow = +(hh < 10 ? '0' : '') + hh + ':' + (mm < 10 ? '0' : '') + mm + ':' + (ss < 10 ? '0' : '') + ss;

    var now = datenow + ' ' + timenow;
    $("#timer").html("เวลา :" + timenow);

    if (h != hh) {
        //console.log('aaa');
        upload_bed_color();
        h = hh;
    }
    //console.log(timenow);
}
</script>

</html>