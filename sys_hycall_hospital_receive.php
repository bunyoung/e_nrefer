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
        font-size: 20px;
        text-align: center;
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

<?php
    require_once("db/connection.php");
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
<?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
include('main_top_menu_smenu.php');
?>

<body>
<!-- <div class="inner bg-" style="background-color:#311B92;" lter> -->
<?php
// 1
$aqa='0';$aqb='0';$aqc='0';
$sqla ="SELECT * FROM v_refer_receive_wait WHERE rf_hos_send_to='$hcode' ";
$qa = mysqli_query($conn,$sqla);
while($sqa = mysqli_fetch_array($qa)){
$aqa = $sqa['rall'];
}

$sqla ="SELECT * FROM v_refer_receive_success WHERE rf_hos_send_to='$hcode' ";
$qa = mysqli_query($conn,$sqla);
while($sqa = mysqli_fetch_array($qa)){
$aqb = $sqa['rall'];
}
// SELECT  * FROM v_rf_detail WHERE rf_status='5' AND hosp_recive_rem='1' AND rf_hos_send_to='$hcode' AND end_refer_end ='N'
$sqla ="SELECT * FROM v_refer_receive_all WHERE rf_hos_send_to='$hcode' ";
$qa = mysqli_query($conn,$sqla);
while($sqa = mysqli_fetch_array($qa)){
$aqc = $sqa['rall'];
}
?>
    <div class="row-fluid"
    style="font-family: sarabun;font-size:18px;font-weight:10px;background-color:#3A1078;color:#A7E6D7;text-align:center;">
        <label for=""><i class="fa fa-desktop fa-1x" aria-hidden="true"style="color:#84FFFF"></i>                <?php echo '  ('.$hcode.')  ';?>
                  Refer Received:: ปลายทางรับคนไข้ เมื่อคนไข้ไปถึงแล้ว
            </label>
    </div>
    <div class="panel panel-"
        style="font-family:sarabun;font-weight:bold;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;font-size:18px;">
        <!-- <div class="panel-heading"> -->
            <div id="nav-tab" class="tab">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab1primary" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                            role="tab" aria-controls="nav-home" aria-selected="true">
                            All Recievied
                            <span class="badge badge-"
                                style="background-color:#6b1fb1;color:#f9e6cf;font-size: 0.78em;"><?php echo $aqc; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab2primary" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                            aria-controls="nav-home" aria-selected="true">
                            Recieved Waiting
                            <span class="badge badge-"
                                style="background-color:#6b1fb1;color:#f9e6cf;font-size: 0.78em;"><?php echo $aqa; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab3primary" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                            aria-controls="nav-home" aria-selected="true">
                            Recieved Success
                            <span class="badge badge-"
                                style="background-color:#6b1fb1;color:#f9e6cf;font-size: 0.78em;"><?php echo $aqb; ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        <!-- </div> -->

        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1primary">
                    <?php include("sys_hycall_hospital_receive_a.php");?>
                </div>
                <div class="tab-pane fade" id="tab2primary">
                    <?php include("sys_hycall_hospital_receive_b.php");?>
                </div>
                <div class="tab-pane fade" id="tab3primary">
                    <?php include("sys_hycall_hospital_receive_c.php");?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>