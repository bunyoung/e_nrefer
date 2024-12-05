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
      FROM v_asmonitor
        WHERE hyitem='$hyitem'; ";
        $result_sql = mysqli_query($conn,$sql);
        $rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

#แสดงรายการข้อมูล
$asname=$rsd['assname'];
$fplace=$rsd['nfromplace'];
$tplace=$rsd['ntplace'];
$x1_pertime=$rsd['x1_pertime'];
$hdate=$rsd['hdate'];
$htime=$rsd['htime']; 
$idcard=$rsd['idcard'];
$pers=$rsd['name'];
$perto=$rsd['perto'];
$ta=$rsd['typea'];
$tb=$rsd['typeb'];
if($rsd['dgroup']=='D'){
    $asname='ขอใช้ทำความสะอาดและภาระกิจอื่นๆ';
}
?>
<header>
    <h4>
        <strong>
            <p>
                จนท ศูนย์ HYs-MEST :
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
        <label for="name" class="control-label col-lg-4">เวชภัณฑ์และสิ่งของ :</label>
        <div class="col-lg-6">
            <input type="button" class="btn btn-danger" name="hass" value="<?php echo $asname;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-4">วันที่ร้องขอ :</label>
        <div class="col-lg-2">
            <input class="form-control" type="text" name="hdate" value="<?php echo $hdate; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-4">เวลาร้องขอ :</label>
        <div class="col-lg-2">
            <input class="form-control" type="text" name="htime" value="<?php echo $htime;  ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-4">เวลารับแจ้ง :</label>
        <div class="col-lg-2">
            <input class="form-control" type="text" name="x1_pertime" value="<?php echo $x1_pertime; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-4">เวลารับงาน :</label>
        <div class="col-lg-2">
            <input class="form-control" type="text" name="perto" value="<?php echo $perto; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label col-lg-4">รับจาก :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="fullplace" value="<?php echo $fplace; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label col-lg-4">ไปส่งที่ :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="placeb" value="<?php echo $tplace; ?>">
        </div>
    </div>

    <!-- เพิ่มเติม
ดี
ดีมาก
พอใช้
ควรปรับปรุง
-->
    <div class="form-group">
        <label for="name" class="control-label col-lg-4">ประเมินการทำงานโดยศูนย์ :</label>
        <div class="col-lg-6">
        <select  class="select2" name="typea" id="" value="<?php echo $ta;?>">
                <option value="" selected disabled>(เลือกหัวข้อประเมิน)</option>
                <option value="ดีมาก">ดีมาก</option>
                <option value="ดี">ดี</option>
                <option value="พอใช้">พอใช้</option>
                <option value="ควรปรับปรุง">ควรปรับปรุง</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-4">ประเมินการทำงานโดยผู้ขอใช้บริการ :</label>
        <div class="col-lg-6">
            <select class="select2" name="typeb" id="" value="<?php echo $tb;?>">
                <option value="" selected disabled>(เลือกหัวข้อประเมิน)</option>
                <option value="ดีมาก">ดีมาก</option>
                <option value="ดี">ดี</option>
                <option value="พอใช้">พอใช้</option>
                <option value="ควรปรับปรุง">ควรปรับปรุง</option>
            </select>
        </div>
    </div>

    <!-- สิ้นสุดการเพิ่ม -->
    <div class="form-group">
        <label for="name" class="control-label col-lg-4">รายงานเหตุการณ์/ชมเชย/ร้องเรียนอื่นๆ :</label>
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
<script src="assets/plugins/select2/select2.full.min.js"></script>
<script>
$(function() {
    $(".select2").select2();
});
</script>
