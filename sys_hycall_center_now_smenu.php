<html>

<head>
    <meta charset="UTF-8">
    <title>E-refer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="stylesheet" type="text/css" href="css/normalize.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/layout.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </script>
</head>

<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 if($did<>''){
    $_SESSION['ih'] = 'หัวหน้าแผนกยืนยัน';
 }else{
    $_SESSION['ih'] = 'แสดงคนไข้ Refer';
 }
  $hcode=$_SESSION['hcode'];
?>

<style>
.topnav {
    /* overflow: hidden; */
    font-family: sarabun;
    font-size: 16px;
    font-weight: 40px;    
    margin-top: 0px;
    background-color: #009775;
}

.topnav a {
    font-family: sarabun;
    float: left;
    /* display: block; */
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 20px;
}

.topnav a:hover {
    font-family: sarabun;
    color: #D1E0D7;
    text-decoration: none;
    background-color: #13322B;
    font-size: 20px;

}

.topnav a.active {
    /* background-color: #006064; */
    color: #EA80FC;
    text-decoration: none;
    font-weight: Bold;
}

@media screen and (max-width: 1024px) {
    .topnav a:not(:first-child) {
        display: none;
        text-decoration: none;
    }

    .topnav a.icon {
        float: right;
        display: block;
    }
}

@media screen and (max-width: 1024px) {
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
$s1="SELECT * FROM v_rf_detail  WHERE rf_hospital='$hcode' AND end_refer_end='N' ";
$rns1=mysqli_query($conn,$s1);
$rcn1=mysqli_num_rows($rns1);
mysqli_free_result($rns1);

$s2="SELECT * FROM v_rf_detail WHERE rf_hospital='$hcode' AND rfgroup='2' AND rf_status <> '5' AND rf_conf_doctor_id='0' AND end_refer_end='N' ";
$rns2=mysqli_query($conn,$s2);
$rcn2=mysqli_num_rows($rns2);
mysqli_free_result($rns2);

$s3="SELECT * FROM v_rf_detail  WHERE rf_hos_send_to = '$hcode' AND rf_status='1' ";
$rns3=mysqli_query($conn,$s3);
$rcn3=mysqli_num_rows($rns3);
mysqli_free_result($rns3);

$s4="SELECT * FROM v_rf_detail WHERE hosp_recive_rem='1' AND rf_hospital = '$hcode' AND  end_refer_end='N' ";
$rns4=mysqli_query($conn,$s4);
$rcn4=mysqli_num_rows($rns4);
mysqli_free_result($rns4);

$s5="SELECT  * FROM v_rf_detail WHERE rf_status='5' AND hosp_recive_rem='1' AND rf_hos_send_to='$hcode' AND end_refer_end ='N' ";
$rns5=mysqli_query($conn,$s5);
$rcn5=mysqli_num_rows($rns5);
mysqli_free_result($rns5);
?>
<body style="font-family:sarabun;">
    <div class="topnav" id="myTopnav" style="font-family:sarabun;letter-spacing: -0.2px;">
        <a href="sys_hycall_center_now.php">
            <i class="fa fa-ambulance fa-1x" aria-hidden="true" style="color:#84FFFF"></i>
            Request Refer
        </a>
        <a href="sys_hycall_monitor_now.php">
            <i class="fa fa-desktop fa-1x" aria-hidden="true" style="color:#84FFFF"></i>
             Monitor ROS <span class="badge progress-bar-danger"><?php echo $rcn1;?></span>
        </a>
        <!-- <a href="./login-form/index.php"><i class="fa fa-sign-out fa-1x" aria-hidden="true" style="color:#84FFFF"></i>
            Approve Refer Out <span class="badge progress-bar-danger"><?php echo $rcn2;?></span>
        </a> -->
        <a href="sys_hycall_hospital_ref.php"><i class="fa fa-sign-in fa-1x" aria-hidden="true" aria-hidden="true"
                style="color:#84FFFF"></i>
            Approve Refer In <span class="badge progress-bar-danger"><?php echo $rcn3;?></span>
        </a>
            <a href="sys_hycall_hospital_send.php"><i class="fa fa-car fa-1x" aria-hidden="true"
                style="color:#84FFFF"></i>
            Send Refer <span class="badge progress-bar-danger"><?php echo $rcn4;?></span>
        </a>
            <a href="sys_hycall_hospital_receive.php"><i class="fa fa-user-plus fa-1x" aria-hidden="true"
                style="color:#84FFFF"></i>
            Refer Receive <span class="badge progress-bar-danger"><?php echo $rcn5;?></span> 
        </a>
            <a href="sys_hycall_hospital_print.php"><i class="fa fa-print fa-1x" aria-hidden="true"
                style="color:#84FFFF"></i>
            Print </a>
        <div class="pull-right">
            <a href="javascript:void(0);" onClick="window.open('sys_hycall_monitor_now_full.php', '',
                            'fullscreen=yes, scrollbars=auto');">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </div>
</body>