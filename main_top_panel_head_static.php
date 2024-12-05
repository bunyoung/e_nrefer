<style>
@import url('https://fonts.googleapis.com/css2?family=K2D:wght@300&display=swap');
</style>
<style>
#navcolor {
    font-family: 'K2D', sans-serif;
    font-size: 30px;
    font-weight: bolder;
    margin-top: 0px;
    /* font-variant-alternates: swash(fancy); */
    /* background-color: #0247FE; */
    background: linear-gradient(120deg, #ec6a45, #901f3d);
    padding: 0px 0px 0px 0px;
    color: #F8E08E;
    /* box-sizing: content-box; */
    /* #660000 width: auto; */
    height: auto;
    padding: 20px;
    /* border: 1px solid #fffb76; */
    /* box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; */
    /* animation: mymove 5s infinite; */
}

/* @keyframes mymove { */
/* 10% {text-shadow: 10px 10px 10px #8C9EFF;} */
/* } */
</style>

<?php
// if(!isset($_SESSION)) {  
//     session_start(); 
//  }
//  $hcode=$_SESSION['hcode'];
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
<div style="border-top: 12px solid #E03C31;box-shadow:  #C8C9C7 0px 0px 15px;  rgba(0, 0, 0, 0.3) 0px 7px 13px -5px,
     rgba(0, 0, 0, 0.2) 0px -5px 0px inset;">
    <div class="container-fluid" id="navcolor" style="border-bottom: 4px solid #E03C31;">
        <div class="col-sm-1 ">
            <a href="logout.php"><img src="./img/hyh.png" style="width:90px;height:100px;border-radius: 50px;" /></a>
        </div>
        <div class="col-sm-9" style="font-weight:1.5;">ศูนย์บริการจัดการส่งต่อผู้ป่วย <?php echo $headw;?>
            (NB e-Refer Service Operating System:NBER SOS)
            <br>(Your Safety Made Always)</br>
        </div>
        <div class="col-sm-1 pull-right">
            <a href="logout.php"><i class="fa fa-home" style="color:#EFEBE9;font-size: 50px;margin-top:20px;" aria-hidden="true"></i></a>
        </div>
    </div>
</div>