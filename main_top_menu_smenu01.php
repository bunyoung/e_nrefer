<html>

<head>
    <meta charset="UTF-8">
    <title>E-refer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/layout.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
    "

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

<?php include('main_script.php');?>
<?php include('./db/connection.php');?>

<?php
$s1="SELECT * FROM v_rf_detail  WHERE rf_hospital='$hcode' AND end_refer_end IN ('N')  AND rfgroup<>''";
$rns1=mysqli_query($conn,$s1);
$rcn1=mysqli_num_rows($rns1);
mysqli_free_result($rns1);

$s11="SELECT * FROM v_rf_detail  WHERE rf_hospital='$hcode' AND end_refer_end IN ('Y')  AND rfgroup<>''";
$rns11=mysqli_query($conn,$s11);
$rcn11=mysqli_num_rows($rns11);
mysqli_free_result($rns11);

$s2="SELECT * FROM v_rf_detail WHERE rf_hospital='$hcode' AND rfgroup='2' AND rf_status <> '5' AND rf_conf_doctor_id='0' AND end_refer_end='N' ";
$rns2=mysqli_query($conn,$s2);
$rcn2=mysqli_num_rows($rns2);
mysqli_free_result($rns2);

// $s3="SELECT * FROM v_rf_detail  WHERE rf_hos_send_to = '$hcode' AND end_refer_end='N' AND hosp_recive_status<>'Y' ";
$s3="SELECT * FROM v_approve_in_all  WHERE rf_hos_send_to = '$hcode' ";
$rns3=mysqli_query($conn,$s3);
while ($rs=mysqli_fetch_array($rns3)){
    $rcn3=$rs['rsall'];
}
mysqli_free_result($rns3);

$s7="SELECT * FROM v_approve_in_not_success WHERE rf_hos_send_to = '$hcode'  ";
$rns7=mysqli_query($conn,$s7);
while($rs=mysqli_fetch_array($rns7)){
    $rcf=$rs['rsall'];
}
mysqli_free_result($rns7);

$sdb='0';$saa='0';$aqa='0';$aqb='0';$aqc='0';$rcn5='0';$rcn6='0';
$a ="SELECT * FROM v_send_refer_success WHERE rf_hospital = '$hcode' ";
$wa = mysqli_query($conn,$a);
while($sqa = mysqli_fetch_array($wa)){
    $swa = $sqa['rsall'];
}

$sqla ="SELECT * FROM v_send_refer_wait WHERE rf_hospital = '$hcode' ";
$qa = mysqli_query($conn,$sqla);
while($sqa = mysqli_fetch_array($qa)){
    $saa = $sqa['rall'];
}

$a ="SELECT * FROM v_send_refer_success WHERE rf_hospital = '$hcode' ";
$wa = mysqli_query($conn,$a);
while($sqa = mysqli_fetch_array($wa)){
$sab = $sqa['rall'];
}

$sqla ="SELECT * FROM v_refer_receive_wait WHERE rf_hos_send_to='$hcode' ";
$qa = mysqli_query($conn,$sqla);
while($sqa = mysqli_fetch_array($qa)){
$rcn6 = $sqa['rall'];
}

$sqla ="SELECT * FROM v_refer_receive_success WHERE rf_hos_send_to='$hcode' ";
$qa = mysqli_query($conn,$sqla);
while($sqa = mysqli_fetch_array($qa)){
$rcn5 = $sqa['rall'];
}

?>

<body>
    <div class="topnav">
        <a href="sys_hycall_center_now.php">
            <i class="fa fa-ambulance fa-1x" aria-hidden="true" style="color:#F9E547"></i>
            Request Refer
        </a>
        <?php
        if($dtem=='1')
        {
        ?>
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
                style="font-weight:0.1px;color:#fff; background-color:#CE0037;font-size:18px;"><?php echo $rcn3;?></span>
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#33691E; background-color:#CCFF90;font-size:18px;"><?php echo $rcf ;?></span>
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
            <!-- <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#fff; background-color:#CE0037;font-size:18px;"><?php echo $rcn6;?></span>
            <span class="badge progress-bar-"
                style="font-weight:0.1px;color:#33691E; background-color:#CCFF90;font-size:18px;"><?php echo $rcn5 ;?></span> -->
        </a>
        <a href="sys_hycall_hospital_print.php"><i class="fa fa-print fa-1x" aria-hidden="true"
                style="font-weight:0.1px;color:#F9E547"></i>
            Print </a>
        <div class="pull-right">
            <a href="javascript:void(0);" onClick="window.open('sys_hycall_monitor_now_full.php', '',
                            'fullscreen=yes, scrollbars=auto');">
                <i class="fa fa-bars"></i>
            </a>
        </div>

        <?php
        }
        ?>
    </div>
</body>

</html>