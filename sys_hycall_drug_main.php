<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Refer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="./assets/theme/theme.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script type="text/javascript" src="assets/js/echarts.min.js"></script>
</head>
<style>
* {
    margin: 0;
    padding: 0px 0;
}

#navcolor {
    font-family: 'K2D', sans-serif;
    font-size: 30px;
    font-weight: bolder;
    background: linear-gradient(120deg, #ec6a45, #901f3d);
    padding: 0px 0px 0px 0px;
    color: #64FFDA;
    box-sizing: content-box;
    height: auto;
    padding: 20px;
}
</style>

<?php 
include('./db/connection.php');
include ("main_script.php");
?>
<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;
?>
<!-- สำหรับตรวจสอบรายชื่อแพทย์ -->
<?php
//  include('sys_process_pmk_doctor.php');
?>
<?php
        // include('modal_close_system.php');
?>

<?php require("main_top_panel_head_drug.php");?>
<?php require("main_top_menu_session_b.php");?>

<body>
    <div class="box">
        <div class="outer bg-light lter">
            <?php
        // if(@$_SESSION['username'] =="") 
        // { 
            require("main_top_menu_drug.php");
        // } 
        ?>
        </div>
        <div class="row" style="height: 1200px;;">
            <p></p>
        </div>
</body>
<?php 
mysqli_close($conn);
include('./main_hycall_footer.php');
?>

</html>