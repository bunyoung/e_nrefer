<!doctype html>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
include('main_script.php');
include('sys_hycall_user_p4p.php');

#write number
$page=basename($_SERVER['PHP_SELF']);
if (file_exists('_couter/'.$page.'.txt'))
{
$fil = fopen('_couter/'.$page.'.txt', "r");
$dat = fread($fil, filesize('_couter/'.$page.'.txt'));
#echo $dat+1;
fclose($fil);
$fil = fopen('_couter/'.$page.'.txt', "w");
fwrite($fil, $dat+1);
}
else
{
$fil = fopen('_couter/'.$page.'.txt', "w");
fwrite($fil, 1);
#echo '1';
fclose($fil);
}
#read number
$myFile = "_couter/".$page.".txt";
$lines = file($myFile);//file in to an array
$count= $lines[0]; //line 2
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
    ?>
</head>

<body>
    <script>
    $(function() {
        Metis.dashboard();
    });
    </script>
 <div id="content3" style="margin-top:-50px;">
        <div class="inner bg-light lter">
		<p>
                    <div class="exTab">
	<ul class="nav nav-pills" style="color:#330066;font-weight: bold;">
            <li class="active"><a data-toggle="tab" href="#home">
            <i class="fa fa-fw fa-bell-o"></i>รับ Consult</a></li>
            <li><a data-toggle="tab" href="#menu1">ขนส่งเครื่องมือแพทย์</a></li>
            <li><a data-toggle="tab" href="#menu2">ขนส่งเวชภัณฑ์และสิ่งของต่างๆ</a></li>
            <li><a data-toggle="tab" href="#menu3">บริการทำความสะอาด/ผลิตภัณฑ์อื่น ๆ</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="panel-group">
                    <?php include ('sys_hycall_center_call_finish_nowa.php'); ?>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="panel-group">
                    <!-- งานจบภาระกิจ  -->
                    <?php include ('sys_hycall_center_call_finish_nowb.php'); ?>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div class="panel-group">
                    <!-- งานจบภาระกิจ  -->
                    <?php include ('sys_hycall_center_call_finish_nowc.php'); ?>
                </div>
            </div>
            <div id="menu3" class="tab-pane fade">
                <div class="panel-group">
                    <!-- งานจบภาระกิจ  -->
                    <?php include ('sys_hycall_center_call_finish_nowd.php'); ?>
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

</script>
<!-- <script type="text/javascript" src="assets/js/jquery.js"> </script> -->
<!-- <script type="text/javascript" src="assets/js/jquery.min.js"> </script>
<script type="text/javascript" src="assets/js/jquery-ui.min.js"> </script>
<script type="text/javascript" src="assets/lib/moment/min/moment.min.js"> </script> -->
<!--TABLE  -->
<!-- <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js">
</script> -->
<!-- <script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js"> -->
</script>
<!--Bootstrap -->
<!-- <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script> -->

<script type="text/javascript">
$(document).ready(function() {
    $('#pdataTable').dataTable({
        "oLanguage": {
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sLast": "หน้าสุดท้าย",
                "sNext": "ถัดไป",
                "sPrevious": "ก่อนหน้า"
            },
            "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
            "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
            "sSearch": "ค้นหา :"
        }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#edataTable').dataTable({
        "oLanguage": {
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sLast": "หน้าสุดท้าย",
                "sNext": "ถัดไป",
                "sPrevious": "ก่อนหน้า"
            },
            "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
            "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
            "sSearch": "ค้นหา :"
        }
    });
});
</script>

</html>