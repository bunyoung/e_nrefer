<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-refer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js">
    </script>
</head>

<?php
    // require_once("db/connection.php");
    // require_once('db/connect_pmk.php');
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
if(!isset($_SESSION)) {  
    session_start(); 
 }
 if($did<>''){
    $_SESSION['ih'] = 'แพทย์ Approve การ Refer';
 }else{
    $_SESSION['ih'] = 'แฟ้มระบบการตั้งค่า';
 }
 $hcode=$_SESSION['hcode'];

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
    font-family: 'sarabun';
    font-size: 18px;
}
</style>

<style>
body {
    margin: 0
}

.icon-bar {
    width: 200px;
    /* background-color: #555; */
}

.icon-bar a {
    display: block;
    text-align: center;
    padding: 16px;
    transition: all 0.3s ease;
    color: white;
    font-size: 36px;
}

.icon-bar a:hover {
    background-color: #000;
}
</style>

<body>
    <?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
?>
    <?php     
        include ("main_script.php")
?>

    <body class="Full-Width">
        <div class="row" style="background-color:#F2F4F4">
            <div class="col-md-1">
                <?php
        include('sys_hycall_center_now_smenu.php');
        ?>
            </div>
            <div class="col-md-11" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
                         font-family: 'sarabun'; margin-top:0px;background-color:#BBDEFB;color:black">
                <?php
            include('sys_hycall_monitor_shead.php');
            ?>
                <div class="icon-bar">
                    <a class="active" href="#"><i class="fa fa-home">กดฟดฟกด</i></a>
                    <a href="#"><i class="fa fa-search">ดกฟดฟหกด</i></a>
                    <a href="#"><i class="fa fa-envelope">ดกฟหกด</i></a>
                    <a href="#"><i class="fa fa-globe">ดกฟหกดฟหกด</i></a>
                    <a href="#"><i class="fa fa-trash">กดฟหดกฟหด</i></a>
                </div>
            </div>
        </div>
    </body>

</html>