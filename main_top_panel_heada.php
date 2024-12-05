<link rel="stylesheet" href="./css/style.css">
<?php include('./db/connection.php'); ?>

<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];
?>
<?php
$sql="SELECT * FROM rf_users WHERE hcode='$hcode' ";
$sda=mysqli_query($conn,$sql);
$rs=mysqli_fetch_array($sda);
$hosname=$rs['hospital'];
$headw    =$rs['headweb'];
$hostel    =$rs['telephone'];
$hosadd  =$rs['address'];
?>

    <div id="headcolor">
        <div class="col-md-1">
            <div class="img">
                <img src="./img/hy01.png" style="width:90px;hieght:90px;" />
            </div>
        </div>

        <div class="col-md-10">
            <div class="headb"><strong>
                    ศูนย์บริการจัดการส่งต่อผู้ป่วย <?php echo $headw;?>
                    (NB e-Refer Service Operating System:NBER SOS)
                </strong>
                <br>
                <strong>(Your Safety Made Always)</strong>
            </div>
        </div>
    </div>
