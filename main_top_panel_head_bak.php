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

<body>
    <div class="container-fluid" id="navcolor">
        <div class="col-md-1">
            <div class="img-resize"><img src="img/hy01.png" style="widht:90px;height:90px;" /></div>
        </div>
        <div class="col-md-8" id="text-head" style="color: #e64e4b;  
                   text-shadow: 1px 1px 2px #332d58;font-family:K2D;font-size: 25px;padding:10px 10px 10px 0px;">
            ศูนย์บริการจัดการส่งต่อผู้ป่วย <?php echo $headw;?>
            (NB e-Refer Service Operating System:NBER SOS)
            <br>
            <strong>(Your Safety Made Always)</strong>
            </br>
        </div>
    </div>