<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Refer</title>
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
    font-family: 'K2D';
    font-style: unset;
    display: block;
    padding: 10px 10px 10px 10px;
    width: AUTO;
    /* background: #651FFF; */
    font-size: 20px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}

.tab {
    font-family: 'K2D';
    font-size: 16px;
    overflow: hidden;
    background-color: #1e3a29;
    color: #fffcf1;
}

.tab a {
    color: #fffcf1;
}

.tab button:hover {
    background-color: #440099;
}

.tab button.active {
    background-color: #034638;
}
</style>

<?php
    require_once("./db/connection.php");
?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];
?>
<style>
table {
    font-family: 'K2D';
    font-size: 16px;
    letter-spacing: -1.01px;
    font-weight: 100px;
}
</style>
<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
include('main_top_menu_smenu.php');
?>

<body>
    <div class="tab">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab1curr" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" role="tab"
                    aria-controls="nav-home" aria-selected="true">
                    TODAY
                    <span class="badge badge-"
                        style="background-color:#e8eff8;color:#661188;font-size:18px;"><?php echo $curall; ?></span>
                </a>
            </li>
            <li>
                <a href="#tab1primary" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" role="tab"
                    aria-controls="nav-home" aria-selected="true">
                    All Requests
                    <span class="badge badge-"
                        style="background-color:#e8eff8;color:#661188;font-size:18px;"><?php echo $cqa; ?></span>
                </a>
            </li>
            <li>
                <a href="#tab2primary" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                    aria-controls="nav-home" aria-selected="true">
                    Refer Out
                    <span class="badge badge-"
                        style="background-color:#e8eff8;color:#661188;font-size:18px;"><?php echo $cqb; ?></span>
                </a>
            </li>
            <li>
                <a href="#tab3primary" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                    aria-controls="nav-home" aria-selected="true">
                    Refer Back
                    <span class="badge badge-"
                        style="background-color:#e8eff8;color:#661188;font-size:18px;"><?php echo $cqc; ?></span>
                </a>
            </li>
            <li>
                <a href="#tab5primary" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                    aria-controls="nav-home" aria-selected="true">
                    Refer Other
                    <span class="badge badge-"
                        style="background-color:#e8eff8;color:#661188;font-size:18px;"><?php echo $cqe; ?></span>
                </a>
            </li>
            <li>
                <a href="#tab4primary" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                    aria-controls="nav-home" aria-selected="true">
                    Refer Completed
                    <span class="badge badge-"
                        style="background-color:#e8eff8;color:#661188;font-size:18px;"><?php echo $cqd; ?></span>
                </a>
            </li>
        </ul>
    </div>

    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1curr">
                <?php include("sys_hycall_monitor_now_f.php");?>
            </div>
            <div class="tab-pane fade" id="tab1primary">
                <?php include("sys_hycall_monitor_now_a.php");?>
            </div>
            <div class="tab-pane fade" id="tab2primary">
                <?php include("sys_hycall_monitor_now_c.php");?>
            </div>
            <div class="tab-pane fade" id="tab3primary">
                <?php include("sys_hycall_monitor_now_d.php");?>
            </div>
            <div class="tab-pane fade" id="tab4primary">
                <?php include('sys_hycall_monitor_now_b.php'); ?>
            </div>
            <div class="tab-pane fade" id="tab5primary">
                <?php include('sys_hycall_monitor_now_e.php'); ?>
            </div>
        </div>
    </div>
</body>

<?php
    include('main_hycall_footer.php'); ?>

</html>