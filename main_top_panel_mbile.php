<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Refer</title>
    <style>
    img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        overflow: hidden;
    }

    .header {
        overflow: hidden;
        background-color: #f1f1f1;
        padding: 20px 10px;
    }

    .header a {
        float: left;
        color: black;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        line-height: 25px;
        border-radius: 4px;
    }

    #headcolor {
        /* background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%); */
        /* background-image: linear-gradient( 179.2deg,  rgba(138,5,190,1) 3.9%, rgba(60,0,94,1) 97.5% ); */
        background-image: radial-gradient(circle farthest-corner at 10% 20%, rgba(0, 52, 89, 1) 0%, rgba(0, 168, 232, 1) 90%);
        /* background-image: radial-gradient(circle 652px at 0.8% 45.2%, rgba(4, 103, 246, 1) 0%, rgba(8, 0, 163, 1) 100.3%); */
        color: #bbdefb;
        margin-top: 0px;
        font-family: ''sarabun'';
        font-weight: bold;
        font-size: 26px;
        letter-spacing: -0.5px;
    }

    #navcolor {
        background-color: #C449C2;
        color: #FFF5AB;
    }

    .header a.logo {
        font-size: 25px;
        font-weight: bold;
    }

    .header a:hover {
        background-color: #ddd;
        color: black;
    }

    .header a.active {
        background-color: dodgerblue;
        color: white;
    }

    .header-right {
        float: right;
    }

    @media screen and (max-width: 700px) {
        .header a {
            float: none;
            display: block;
            text-align: left;
        }

        .header-right {
            float: none;
        }
    }
    </style>
</head>
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

<body>
    <div class=" container-fluid" id="headcolor">
        <div class="row">
            <div class="col-sm-10"
                style="margin: 0px;padding: 2px 2px 2px;width:100%;font-family: sarabun; font-size:7vw;margin-top:0px;">
                <strog>
                    <center>ศูนย์บริการจัดการส่งต่อผู้ป่วย <?php echo $headw;?> (HY-RMC)</center>
                    <br>
                    <center>Seamless Refer</center>
                    </strong>
                </p>
            </div>
            <!-- <div class="col-md-1 pull-right">
                <div class="img-logo"><img src="img/hy.png"
                        style="width:80px;height:80px;text-align:center;margin-top:5px;" />
                </div>
            </div> -->
        </div>
    </div>
</body>

</html>