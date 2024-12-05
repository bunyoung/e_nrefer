<!doctype html>
<?php
require_once("db/connection.php");

#variable from post
$hyitem=$_POST['hyitem'];
?>
<?php
include ("main_script.php")
?>
<?php
#SQL
$sql = "SELECT
     *
      FROM v_cleanmonitor
        WHERE hyitem='$hyitem'; ";
        $result_sql = mysqli_query($conn,$sql);
        $rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

#แสดงรายการข้อมูล
$asname=$rsd['c_clear'];
$fplace=$rsd['fullplace'];
$x1_pertime=$rsd['x1_pertime'];
$hdate=$rsd['c_date'];
$htime=$rsd['c_time']; 
$idcard=$rsd['pers'];
$pers=$rsd['name'];
$perto=$rsd['perto'];
?>
<header>
<h4>
        <strong>
            <p>
                จนท.:
                <a class="text text-info">
                    <?php echo $idcard;?>
                    : <?php echo $pers;?>
                </a>
            </p>
        </strong>
    </h4>
    <hr>
</header>
<p>
<form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">เวชภัณฑ์และสิ่งของ :</label>
        <div class="col-lg-6">
            <input type="button" class="btn btn-danger" name="hass" value="<?php echo $asname;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">วันที่ร้องขอ :</label>
        <div class="col-lg-2">
            <input class="form-control" type="text" name="hdate" value="<?php echo $hdate; ?>" >
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
        <label for="name" class="control-label col-lg-3">เวลารับงาน :</label>
        <div class="col-lg-2">
            <input class="form-control" type="text" name="perto" value="<?php echo $perto; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label col-lg-3">ผู้แจ้ง :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="fullplace" value="<?php echo $fplace; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">เหตุผลในการปิดงาน :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="hassrem" value="">
        </div>
    </div>

    <!-- /.row -->
    <div class="form-group">
        <label class="control-label col-lg-3">
        </label>

        <input type="hidden" name="hyitem" value="<?php echo $hyitem;?>">
        <input type="hidden" name="eidcard" value="<?php echo $idcard;?>">
        <input type="hidden" name="RSFINISH" value="RSFINISH">
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary btn-grad btn-rect">ปิดงานนี้
            </button>
        </div>
    </div>
    <!-- /.row -->
</form>
</p>

</html>