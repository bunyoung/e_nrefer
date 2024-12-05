<!doctype html>
<?php 
include('main_script.php'); 
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รพ หาดใหญ่</title>
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- <script src="//code.jquery.com/jquery-2.1.1.js"></script> -->
    <!-- <link href="assets/docs.css" rel="stylesheet"> -->

    <!-- This is what you need -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
</head>
<style>
@media screen and (max-width:1000px) and (min-width:768px) {
    .img {
        text-align: center;
    }
}

@media all and (min-width:768px) {
    .img {
        text-align: center;
    }

    .navigation {
        flex-direction: column;
    }
}
</style>
<?php
require_once("db/connection.php");
?>
<?php
#variable from post
$hyitem=NULL;
if(isset($_GET['id']))
{
    $hyitem = $_GET['id'];
}
?>

<?php
#SQL
$sql = "
SELECT
   *
FROM v_monitor
WHERE hyitem='$hyitem'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

#แสดงรายการข้อมูล
$hn=$rsd['hn'];
$name=$rsd['patients'];
$hdate=$rsd['hdate'];
$htime=$rsd['htime'];
$x1_pertime=$rsd['x1_pertime'];
$fplace=$rsd['fplace'];
$tplace=$rsd['tplace'];
$assname=$rsd['assname'];
$pername=$rsd['name'];
$pers=$rsd['pers'];
$pold=$rsd['old'];
$pid=$rsd['idcard'];
?>
<?PHP
if(@$_POST['LEDIT'])
{
    $hyitem=@$_POST['hyitem'];
    $eidcard=@$_POST['didcard'];
    $perremark=@$_POST['hassrem'];
    $uptime=date("Y-m-d H:i:s");
    $fplace=@$_POST['dfplace'];
    $tplace=@$_POST['dtplace'];
    $pern=@$_POST['dpename'];
    $hn=@$_POST['phn'];
    $pt=@$_POST['pname'];
    $idcard=@$_POST['aid'];
    $old=@$_POST['aold'];
    // รับเรื่อง
    // $pstatus='W';     
    $pstatus='E'; 
    $sql_employee = "
    UPDATE employee
        SET perstatus='$pstatus'
        WHERE idcard=TRIM('$eidcard')";
    $result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();

    $sql_hycenter = "
    UPDATE hycent
        SET perto ='$uptime',X1='$pstatus',perremark='$perremark' 
    WHERE hyitem='$hyitem'";
    $result_hycent_edit = mysqli_query($conn,$sql_hycenter); 
    if ($result_hycent_edit==TRUE) {
        echo '
        <script>
                setTimeout(function() {
                    swal({
                        title: "บันทึกรับทราบ",
                        text: "ข้อมูลได้รับการ Update อย่างสมบูรณ์ ในขณะนี้ !!", 
                        type: "success"
                }, function() {
                        // window.location="sys_hycall_center_view.php";
                        window.close();
                    });
            }, 1000);
        </script>';
        echo "
        <script>window.close();</script>";
    }else{
        echo '
        <script>
                setTimeout(function() {
                    swal({
                        title: "บันทึกรับทราบ",
                        text: "ไม่สามารถดำเนินการได้ ในขณะนี้ !!", 
                        type: "warning"
                }, function() {
                        // window.location="sys_hycall_center_view.php";
                        window.close();
                    });
            }, 1000);
        </script>';
        echo "
        <script>window.close();</script>";
    }
}
?>

<body>
    <div class="containter">
        <div class="col-lg-12">
            <div class="panel panel-default" style="text-align:center;margin-left:0px;">
                <div class="panel-heading" style="background:#CC6600;opacity: 1;
                         color:#FFFFFF;font-size: 1.3em;font-weight: bold;">
                    รับทราบงานช่วยเหลือผู้ป่วย
                </div>

                <div class="panel-heading" style="background:#FF9966;opacity: 1;
                         color:#FFFFFF;font-size: 1.3em;font-weight: bold;">
                    HN : <?php echo $hn;?>
                    <p>
                        ชื่อ : <?php echo $name;?>
                </div>

                <div class="panel-heading" style="background:#ffb895;opacity: 1;
                         color:#FFFFFF;font-size: 1.3em;font-weight: bold;">
                    จนท.เปล : <?php echo $pers;?>
                    <p>
                        ชื่อ : <?php echo $pername;?>
                </div>
                <div class="panel-heading" style="text-align:left;background:#fbc284;opacity: 1;
                         color:#CC6600;font-size: 1.3em;font-weight: bold;">

                    <form class="form-horizontal" action="sys_hycall_center_finish_main_line.php" method=POST target="">
                        <div class="form-group">
                            <label for="name" class="col-sm-1" style="text-align:right;">ความเร่งด่วน :</label>
                            <p>
                                <label class="col-sm-4"><?php echo $assname;?></label>
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-1" style="text-align:right;">ไปรับจาก :</label>
                            <p>
                                <label class="col-sm-4"><?php echo $fplace; ?></label>
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-1" style="text-align:right;">ไปส่งที่ :</label>
                            <p>
                                <label class="col-sm-4"><?php echo $tplace; ?></label>
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-1" style="text-align:right;">อุปกรณ์+อุปกรณ์พิ่ม :</label>
                            <p>
                                <label class="col-sm-4"><?php echo $assname; ?></label>
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-1" style="text-align:right;">เหตุผลในการรอรับ :</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="hassrem" value="">
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="form-group">
                            <input type="hidden" name="hyitem" value="<?php echo $hyitem;?>">
                            <input type="hidden" name="didcard" value="<?php echo $pers;?>">
                            <input type="hidden" name="dpename" value="<?php echo $pername;?>">
                            <input type="hidden" name="dfplace" value="<?php echo $fplace;?>">
                            <input type="hidden" name="dtplace" value="<?php echo $tplace;?>">
                            <input type="hidden" name="phn" value="<?php echo $hn;?>">
                            <input type="hidden" name="pname" value="<?php echo $name;?>">
                            <input type="hidden" name="aid" value="<?php echo $pid;?>">
                            <input type="hidden" name="aold" value="<?php echo $pold;?>">
                            <input type="hidden" name="LEDIT" value="LEDIT">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-default btn-grad btn-rect"
                                    style="text-align:center;">พร้อมรับงาน
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        // echo '
        // <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"> </script>
        // <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        // ';
    ?>
</body>
</p>

<script src="assets/plugins/select2/select2.full.min.js"></script>
<script>
$(function() {
    $(".select2").select2();
});
</script>

</html>