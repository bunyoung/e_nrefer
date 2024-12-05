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
    < link rel = "stylsheet"
    href = "flex_stlye.css" >
    </script>

    <style>
    .grid-container {
        display: grid;
        grid-template-columns: auto auto auto auto auto;
        background-color: #eddcc8;
        padding: 2px;
    }

    .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.8);
        margin:auto;
        padding: 1px;
        font-size: 20px;
        text-align: center;
    }
    </style>

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
    $_SESSION['ih'] = 'Application Mobile';
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
?>
    <?php     
        include ("main_script.php")
?>

<body class="full-width">
    <div class="row" style="background-color:#F2F4F4">
        <div class="col-md-1">
            <?php
                include('sys_hycall_center_now_smenu.php');
            ?>
        </div>
        <div class="col-md-11" style="font-family: 'sarabun'; margin-top:0px;background-color:#F2F4F4">
            <?php
            include('sys_hycall_monitor_shead.php');
            ?>
            <div class="grid-container">
            <?php
            $sql="SELECT * from v_view_users order by hcode";
            $rs=mysqli_query($conn,$sql);
            while($rw=mysqli_fetch_array($rs))
            {
                echo '<a href="#"><div class="grid-item">'.$rw["hcode"].'</div><a>';
            }               
            ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').dataTable({
            "lengthMenu": [
                [10, 20, 50, 60, -1],
                [10, 20, 50, 60, "All"]
            ],
        });
    });
    </script>
</body>

</html>