<html>

<head>
    <meta charset="UTF-8">
    <title>E-refer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
</head>

<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
$hcode=$_SESSION['hcode'];
$dtem = $_SESSION['dtem'];
?>

<style>
.topnav {
    overflow: hidden;
    font-family: 'K2D';
    font-size: 18px;
    font-weight: 400;
    background-color: #1565C0;
    letter-spacing: -0.4px;
    font-weight: 0.1px;
}

.topnav a {
    font-family: 'K2D';
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 20px;
}

.topnav a:hover {
    font-family: 'K2D';
    color: #2F58CD;
    text-decoration: none;
    background-color: #3A1078;
    font-size: 20px;
}

.topnav a.active {
    background-color: #006064;
    color: #EA80FC;
    text-decoration: none;
    font-weight: Bold;
}

@media screen and (max-width: 600px) {
    .topnav a:not(:first-child) {
        display: none;
        text-decoration: none;
    }

    .topnav a.icon {
        float: right;
        display: block;
    }
}

@media screen and (max-width: 600px) {
    .topnav.responsive {
        position: relative;
    }

    .topnav.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
    }

    .topnav.responsive a {
        float: none;
        display: block;
        text-align: left;
    }
}
</style>

<?php 
// include('main_script.php');
?>
<?php include('./db/connection.php');?>

<body>
    <div class="topnav">
        <?php
        if($hcode<>'10682' || $hcode<>'24005' || $hcode<>'24006' || $hcode<>'99773' || $hcode<>'77491'){
            ?>
        <a href="sys_hycall_center_now.php">
            <i class="fa fa-ambulance fa-1x" aria-hidden="true" style="color:#F9E547"></i>
            Request Refer
        </a>

        <a href="sys_hycall_monitor_now.php">
            <i class="fa fa-desktop fa-1x" aria-hidden="true" style="color:#F9E547"></i>
            Approve Refer Back/Out
        </a>
        <a href="sys_hycall_hospital_ref.php">
            <i class="fa fa-sign-in fa-1x" aria-hidden="true" aria-hidden="true" style="color:#F9E547"></i>
            Approve Refer In
        </a>
        <a href="sys_hycall_hospital_thai.php">
            <i class="fa fa-sign-in fa-1x" aria-hidden="true" aria-hidden="true" style="color:#F9E547"></i>
            Refer In (ThaiRefer)
        </a>
        <a href="sys_hycall_hospital_send.php"><i class="fa fa-car fa-1x" aria-hidden="true" style="color:#F9E547"></i>
            Send Refer
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#fff; background-color:#CE0037;font-size:18px;"><?php echo $saa;?></span>
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#33691E; background-color:#CCFF90;font-size:18px;"><?php echo $sab ;?></span>
        </a>
        <a href="sys_hycall_hospital_receive.php"><i class="fa fa-user-plus fa-1x" aria-hidden="true"
                style="color:#F9E547"></i>
            Refer Received
        </a>
        <a href="sys_hycall_hospital_auditor.php"><i class="fa fa-user-plus fa-1x" aria-hidden="true"
                style="color:#F9E547"></i>
            Refer Audit
        <a href="sys_hycall_hospital_print.php"><i class="fa fa-print fa-1x" aria-hidden="true"
                style="font-weight:0.1px;color:#F9E547"></i>
            Advice Center
        </a>
        <div class="pull-right">
            <a href="javascript:void(0);" onClick="window.open('sys_hycall_monitor_now_full.php', '',
                            'fullscreen=yes, scrollbars=auto');">
                <i class="fa fa-bars"></i>
            </a>
        </div>

        <?php
        }else{

        if($dtem=='1')
        {
        ?>
        <a href="sys_hycall_center_now.php">
            <i class="fa fa-ambulance fa-1x" aria-hidden="true" style="color:#F9E547"></i>
            Request Refer
        </a>

        <a href="sys_hycall_monitor_now.php">
            <i class="fa fa-desktop fa-1x" aria-hidden="true" style="color:#F9E547"></i>
            Approve Refer Back/Out
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#fff; background-color:#CE0037;font-size:18px;"><?php echo $rcn1;?>
            </span>
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#33691E; background-color:#CCFF90;font-size:18px;"><?php echo $rcn11;?>
            </span>
        </a>
        <a href="sys_hycall_hospital_ref.php">
            <i class="fa fa-sign-in fa-1x" aria-hidden="true" aria-hidden="true" style="color:#F9E547"></i>
            Approve Refer In
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#fff; background-color:#CE0037;font-size:18px;">
                <?php echo $rcn3;?></span>
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#33691E; background-color:#CCFF90;font-size:18px;">
                <?php echo $rcf ;?></span>
        </a>
        <a href="sys_hycall_hospital_send.php"><i class="fa fa-car fa-1x" aria-hidden="true" style="color:#F9E547"></i>
            Send Refer
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#fff; background-color:#CE0037;font-size:18px;"><?php echo $saa;?></span>
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#33691E; background-color:#CCFF90;font-size:18px;"><?php echo $sab ;?></span>

        </a>
        <a href="sys_hycall_hospital_receive.php"><i class="fa fa-user-plus fa-1x" aria-hidden="true"
                style="color:#F9E547"></i>
            Refer Received
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#fff; background-color:#CE0037;font-size:18px;"><?php echo $rcn6;?></span>
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#33691E; background-color:#CCFF90;font-size:18px;"><?php echo $rcn5 ;?></span>
        </a>
        <a href="sys_hycall_hospital_auditor.php"><i class="fa fa-user-plus fa-1x" aria-hidden="true"
                style="color:#F9E547"></i>
            Refer Audit
        </a>
        <a href="sys_hycall_my_request.php"><i class="fa fa-print fa-1x" aria-hidden="true"
                style="font-weight:0.1px;color:#F9E547"></i>
            Advice Center 
        </a>
        <div class="pull-right">
            <a href="javascript:void(0);" onClick="window.open('sys_hycall_monitor_now_full.php', '',
                            'fullscreen=yes, scrollbars=auto');">
                <i class="fa fa-bars"></i>
            </a>
        </div>

        <?php
        }
    }
        ?>
    </div>
</body>

</html>