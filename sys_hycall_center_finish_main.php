<!doctype html>
<?php
require_once("db/connection.php");

#variable from post
$hyitem=$_POST['hn'];
?>
<?php
include ("main_script.php")
?>
<?php
#SQL
$sql = "SELECT
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

<?php
?>
<header>
    <h4>
        <strong>
            สำหรับผู้ป่วย HN :
            <a class="text text-info">
                <?php echo $hn;?>
                ชื่อ : <?php echo $name;?>
            </a>
            <p>
            <p>
                จนท เปล เลข ว :
                <a class="text text-info">
                    <?php echo $pers;?>  <?php echo $pername;?>
                </a>
                </p>
        </strong>
    </h4>
    <hr>
</header>
<p>
<form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">ความเร่งด่วน  :</label>
        <div class="col-lg-6">
            <input type="button" class="btn btn-danger" name="assname" value="<?php echo $assname;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">วันที่ร้องขอ :</label>
        <div class="col-lg-2">
            <input class="form-control" type="text" name="hdate" value="<?php echo $hdate; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">เวลาร้องขอ :</label>
        <div class="col-lg-2">
            <input class="form-control" type="text" name="htime" value="<?php echo $htime;  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">เวลารับแจ้ง :</label>
        <div class="col-lg-2">
            <input class="form-control" type="text" name="x1_pertime" value="<?php echo $x1_pertime; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label col-lg-3">รับจาก :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="fullplace" value="<?php echo $fplace; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label col-lg-3">ไปส่งที่ :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="placeb" value="<?php echo $tplace; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">อุปกรณ์+อุปกรณ์เพิ่ม :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="hassname" value="<?php echo $assname.' '.$b;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">เหตุผลในการรอรับ :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="hassrem" value="">
        </div>
    </div>

    <!-- /.row -->
    <div class="form-group">
        <label class="control-label col-lg-3">
        </label>
        <input type="hidden" name="hyitem" value="<?php echo $hyitem;?>">
        <input type="hidden" name="didcard" value="<?php echo $pers;?>">
        <input type="hidden" name="dpename" value="<?php echo $pername;?>">
        <input type="hidden" name="dfplace" value="<?php echo $fplace;?>">
        <input type="hidden" name="dtplace" value="<?php echo $tplace;?>">
        <input type="hidden" name="phn" value="<?php echo $hn;?>">
        <input type="hidden" name="pname" value="<?php echo $name;?>">
        <input type="hidden" name="aid" value="<?php echo $pid;?>">
        <input type="hidden" name="aold" value="<?php echo $pold;?>">
        <input type="hidden" name="FEDIT" value="FEDIT">
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary btn-grad btn-rect">พร้อมรับงาน
            </button>
        </div>
    </div>
    <!-- /.row -->
</form>
</p>
<script src="assets/plugins/select2/select2.full.min.js"></script>
<script>
$(function() {
    $(".select2").select2();
});
</script>

</html>