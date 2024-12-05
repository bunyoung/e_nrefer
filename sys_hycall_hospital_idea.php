<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-refer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <link rel="stylesheet" href="assets/theme/theme.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js">
    </script>

    <?php
    require_once("db/connection.php");
    require_once('db/connect_pmk.php');
?>
</head>
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
} ELSE {
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
    $_SESSION['ih'] = 'หัวหน้าแผนกยืนยัน';
 }else{
    $_SESSION['ih'] = 'ข้อเสนอแนะเพิ่มเติม';
 }
 $hcode=$_SESSION['hcode'];

 #ตรวจสอบสิทธิการเข้าใช้งาน
if ($_SESSION['hosname']=="") 
{
    echo (
        "<SCRIPT LANGUAGE='JavaScript'>
            window.alert('ไม่พบสิทธิ [admin]')
            window.location.href='dashboard.php';
        </SCRIPT>");
}
?>
<style>
table {
    font-family: 'sarabun';
    font-size: 18px;
}
</style>
<?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
include ("main_script.php")
?>

<body>
    <div class="row">
        <div class="col-md-1">
            <?php
        include('sys_hycall_center_now_smenu.php');
        ?>
        </div>
        <div class="col-md-11" style="font-family: 'sarabun'; margin-top:0px;">
            <div class="table-responsive-sm"
                style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
                <?php
            include('sys_hycall_monitor_shead.php');
            ?>
                <div class="card border-info" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
                       font-family:sarabun;font-size:16px; margin-top:10px; color:white">
                    <div class="panel-heading" style="background-color:#663399; color:#F4ECF7;font-size: 1.2em;">
                        <span class="glyphicon glyphicon-send"></span>
                        ขอเสนอแนะรักษาต่อ (e-Refer)
                    </div>
                    <div class="panel-body" style="background-color:#154360;">
                        <form action="insert_comment_require_db.php" method="">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="opd" class="label-control">
                                        หัวข้อเสนอแนะการปรับปรุง
                                    </label>
                                </div>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="idea" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="opd" class="label-control">
                                        เนื้อหา
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <textarea class="form-control" name="comment" rows="6" cols="120" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="opd" class="label-control"></label>
                                </div>
                                <div class="col-sm-5">
                                    <button type="button" class="btn btn-success btn-grad" style="font-size:1.2em;">
                                        <span class="glyphicon glyphicon-ok-circle"></span>
                                        บันทึกข้อเสนอแนะ
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- การ ปิด ช่อง ค้นหาข้อมูล  Search -->
<!-- 
$('#example').dataTable( {
	"bFilter": false
} ); -->