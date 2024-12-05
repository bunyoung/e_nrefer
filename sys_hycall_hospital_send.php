<?php
	include('./db/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-refer</title>

    <style>
    .badge-primary {
        color: #ebeef0;
        background-color: #B23CFD;
    }

    .badge-secondary {
        color: #ebeef0;
        background-color: #2abe74;
    }

    .badge-success {
        color: #ebeef0;
        background-color: #b9fd3c;
    }

    .badge-danger {
        color: #ebeef0;
        background-color: #e93e9c;
    }

    .badge-warning {
        color: #ebeef0;
        background-color: #5f3cfd;
    }

    .badge-info {
        color: #ebeef0;
        background-color: #fd3c46;
    }

    .badge-light {
        color: #ebeef0;
        background-color: #3cfdbd;
    }

    .badge-dark {
        color: #ebeef0;
        background-color: #064118;
    }
    </style>
</head>

<style>
.border {
    font-family: 'sarabun';
    font-style: unset;
    display: block;
    padding: 10px 10px 10px 10px;
    width: AUTO;
    /* background: #651FFF; */
    font-size: 20px;
    text-align: center;

    /* color: #69F0AE; */
    border-radius: 3%;
}
</style>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

.mast-head {
    padding: 3rem 0 7rem;
    position: relative;
    background-color: #00dffc;
    background-image: url(img/overlay.svg), linear-gradient(45deg, #00dffc 0%, #008c9e 100%);
    background-size: cover;
    z-index: 0;
    margin-bottom: 20px;
    color: white;
}

.comment {
    /* width: 40%; */
    height: 900px;
    padding: 4px 0px;
    margin: 0px 1px;
    /* background-color: #81D4FA; */
    /* border-top-left-radius: 1px 1px; */
    /* border-top-right-radius: 1px 1px; */
    /* opacity: 0.1; */
    border: 0px dotted #F0F2F5;
    inset: 10px 30% 20px 0;
}
</style>
<?php
    require_once("db/connection.php");
    // require_once('db/connect_pmk.php');
?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];

 #ตรวจสอบสิทธิการเข้าใช้งาน
 
?>
<style>
table {
    font-family: 'sarabun';
    font-size: 18px;
    letter-spacing: -1.01px;
    font-weight: 100px;
}

#tab2 {
    font-family: 'sarabun';
    font-size: 18px bold;
    color: #5a315d;
    padding: auto;

}
</style>
<?php 
// include('main_top_panel_head.php');
// include('main_top_menu_session.php');
// include('main_top_menu_smenu.php');
?>
<style>
.border {
    font-family: 'sarabun';
    font-style: unset;
    display: block;
    padding: 10px 10px 10px 10px;
    width: AUTO;
    /* background: #651FFF; */
    font-size: 20px;
    text-align: center;

    /* color: #69F0AE; */
    border-radius: 3%;
}
</style>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

.comment {
    /* width: 40%; */
    height: 900px;
    padding: 4px 0px;
    margin: 0px 1px;
    border: 0px dotted #F0F2F5;
    inset: 10px 30% 20px 0;
}
</style>
<style>
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #2E008B;
}

.tab a {
    color: #B4B5DF;
}

.tab button:hover {
    background-color: #440099;
}

.tab button.active {
    background-color: #034638;
}
</style>
<?php include('main_script.php'); ?>

<body>
    <!-- <div class="inner bg-" style="background-color:#311B92;" lter> -->
    <?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
include('main_top_menu_smenu.php');
?>

    <?php
// include('main_script_loading.php');
?>

    <?php
// 1
$saa='0';$ssa='0';$swa='0';
$sqla ="SELECT COUNT(*) as rall FROM v_rf_detail
WHERE rf_hospital = '$hcode' AND hosp_recive_rem='1' AND end_refer_end='N' AND rf_status IN ('4','5') ";
$qa = mysqli_query($conn,$sqla);
while($sqa = mysqli_fetch_array($qa)){
    $saa = $sqa['rall'];
}

$a ="SELECT * FROM v_send_refer_success WHERE rf_hospital = '$hcode' ";
$wa = mysqli_query($conn,$a);
while($sqa = mysqli_fetch_array($wa)){
$swa = $sqa['rall'];
}
$sqla ="SELECT * FROM v_send_refer_wait WHERE rf_hospital = '$hcode' ";
$qa = mysqli_query($conn,$sqla);
while($sqa = mysqli_fetch_array($qa)){
    $ssa = $sqa['rall'];
}

// $sqla ="SELECT COUNT(*) AS rall  FROM v_rf_detail WHERE hosp_recive_rem='1' AND rf_hospital = '$hcode'  AND  end_refer_end='N' AND rf_status='4'
// GROUP BY rf_hospital";
// $qa = mysqli_query($conn,$sqla);
// while($sqa = mysqli_fetch_array($qa)){
// $ssa = $sqa['rall'];
// }
?>
    <div class="row-fluid"
        style="font-family: sarabun;font-size:18px;font-weight:10px;background-color:#3A1078;color:#A7E6D7;text-align:center;">
        <label for=""><i class="fa fa-desktop fa-1x" aria-hidden="true" style="color:#84FFFF"></i>
            <?php echo '('.$hcode.')    ';?>Send Refer :: เตรียมความพร้อมคนไข้ก่อนดำเนินการเคลื่อนย้าย </label>
    </div>
    <div class="panel panel-"
        style="font-family:sarabun;font-weight:bold;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;font-size:18px;">
        <!-- <div class="box"> -->
        <div class="tab">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1primary" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                        role="tab" aria-controls="nav-home" aria-selected="true">
                        Send Refer All
                        <span class="badge badge-"
                            style="background-color:#6b1fb1;color:#f9e6cf;font-size: 0.78em;"><?php echo $aqc; ?></span>
                    </a>
                </li>
                <li>
                    <a href="#tab2primary" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                        aria-controls="nav-home" aria-selected="true">
                        Refer waiting
                        <span class="badge badge-"
                            style="background-color:#6b1fb1;color:#f9e6cf;font-size: 0.78em;"><?php echo $ssa; ?></span>
                    </a>
                </li>
                <li>
                    <a href="#tab3primary" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                        aria-controls="nav-home" aria-selected="true">
                        Refer Success
                        <span class="badge badge-"
                            style="background-color:#6b1fb1;color:#f9e6cf;font-size: 0.78em;"><?php echo $swa; ?></span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- </div> -->

        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1primary">
                    <?php include("sys_hycall_hospital_send_a.php");?>
                </div>
                <div class="tab-pane fade" id="tab2primary">
                    <?php include("sys_hycall_hospital_send_b.php");?>
                </div>
                <div class="tab-pane fade" id="tab3primary">
                    <?php include("sys_hycall_hospital_send_c.php");?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>