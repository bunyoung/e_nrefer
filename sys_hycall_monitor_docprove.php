<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.min.css">
    <script type="text/javascript" src="https:////cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js">
    </script>
</head>

<?php
    require_once("db/connection.php");
?>
<?php
$date_start_d_defult = '01/';
$date_start_m_defult = date('m/');
$date_start_y_defult = date('Y') + 543;
$date_start_dmy_defult = $date_start_d_defult . $date_start_m_defult . $date_start_y_defult;
$date_end_dm_defult = date('d/m/');
$date_end_y_defult = date('Y') + 543;
$date_end_dmy_defult = $date_end_dm_defult . $date_end_y_defult;
$date_end_dm_defult = date('d/m/');
$date_end_y_defult = date('Y') + 543;
$date_end_dmy_defult = $date_end_dm_defult . $date_end_y_defult;
$d_start_post = $_POST['d_start'];
$d_end_post = $_POST['d_end'];
IF (!empty($d_start_post)) {
    $d_start = $d_start_post;
} else {
    $d_start = $date_start_dmy_defult;
}
IF (!empty($d_end_post)) {
    $d_end = $d_end_post;
} ELSE {
    $d_end = $date_end_dmy_defult;
}
$d_start_cal = substr($d_start, 6, 4) . substr($d_start, 3, 2) . substr($d_start, 0, 2);
$d_end_cal = substr($d_end, 6, 4) . substr($d_end, 3, 2) . substr($d_end, 0, 2);
$date_m = $d_end;
?>
<?php
$did=null;
if($did==null){
    $did=$_GET['id'];
}
?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 if($did<>''){
    $_SESSION['ih'] = 'แพทย์ Approve การ Refer';
 }else{
    $_SESSION['ih'] = 'หัวหน้าแผนกยืนยัน';
 }
 $hcode=$_SESSION['hcode'];
 $f_code=$_SESSION['mfdoc'];      
 $_SESSION['d_code'] =$did;

 #ตรวจสอบสิทธิการเข้าใช้งาน
 if ($_SESSION['hosname']=="") 
{
    echo (
        "<script>
                Swal.fire({
                    title: 'ไม่พบสิทธิ [admin]'',
                    text: 'ข้อความนี้สำหรับแจ้งให้ผู้ใช้งานทราบ',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
           });
           window.location.href='dashboard.php';
        </script>");
}
?>
<style>
table {
    font-family: sarabun;
    font-size: 18px;
}
</style>
<?php include('main_top_panel_head.php');?>
<?php include('main_top_menu_session.php');?>
<?php 
    include('main_script.php');
?>
<style>
/* @import "//netdna.bootstrapcdn.com/twitter-bootstrap/4.2.2/css/bootstrap-combined.min.css"; */

.tab:not(:target) {
    display: block;
}

.tab:last-child {
    display: block;
}

.tab:target~.tab:last-child {
    display: none;
}

.tabs {
    width: 30em;
    margin: 6.5em auto;
    color: #00C853;
}
</style>
<?php 
include('sys_hycall_center_now_smenu.php');
include('main_script.php');
?>

<body>
    <div class="row-fluid"
    style="font-family: sarabun;font-size:1.4em;background-color:#154734;color:#A7E6D7;text-align:center;">
       <label for=""><i class="fa fa-sign-out fa-1x" aria-hidden="true" style="color:#84FFFF"></i> Approve Refer Out ::
            ยืนยันคำร้องขอดำเนินการเคลื่อนย้ายจากหน่วยต้นทาง </label>
    </div>

    <div class="mast-heade justify-content-md-center" style="margin: 2px 20px 2px;padding: 2px 2px 2px;">
        <div class="panel panel-"
            style="font-family:sarabun;font-weight:bold;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;font-size:18px;">
            <div class="panel-heading">
                <div id="tab2" class="tab">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1primary" data-toggle="tab">รออนุมัติ</a></li>
                        <li><a href="#tab2primary" data-toggle="tab">อนุมัติแล้ว</a></li>
                        <li><a href="#tab3primary" data-toggle="tab">ทบทวนใหม่</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1primary">
                        <?php include("sys_hycall_monitor_docprove_a.php");?>
                    </div>
                    <div class="tab-pane fade" id="tab2primary">
                        <?php include('sys_hycall_monitor_docprove_b.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="tab3primary">
                        <?php include('sys_hycall_monitor_docprove_c.php') ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<br>
<?php
    include('sys_hycall_footer.php'); ?>

</html>

<script type="text/javascript">
$(document).ready(function() {
    $('#adataTable').dataTable({
        "lengthMenu": [
            [10, 20, 50, 60, -1],
            [10, 20, 50, 60, "All"]
        ],
    });
});
</script>