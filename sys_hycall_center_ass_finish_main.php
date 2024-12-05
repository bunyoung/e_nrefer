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
FROM v_asmonitor
WHERE hyitem='$hyitem'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

#แสดงรายการข้อมูล
$hdate=$rsd['hdate'];
$htime=$rsd['htime'];
$x1_pertime=$rsd['x1_pertime'];
$fplace=$rsd['nfromplace'];
$tplace=$rsd['ntplace'];
$asname=$rsd['assname'];
$idcard=$rsd['idcard'];
$pers=$rsd['name'];
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
              <?php echo $idcard;?> : <?php echo $pers;?>
           </a>
         </p>
      </strong>
    </h4>
    <hr>
</header>
<p>
<form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">เวชภัณฑ์และสิ่งของ
          :</label>
        <div class="col-lg-6">
            <input type="button" class="btn btn-danger" name="assname" value="<?php echo $asname;?>">
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
        <label for="name" class="control-label col-lg-3">เหตุผลในการรอรับ :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="hassrem" value="">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-3">
        </label>

        <input type="hidden" name="hyitem" value="<?php echo $hyitem;?>">
        <input type="hidden" name="eidcard" value="<?php echo $idcard;?>">
        <input type="hidden" name="RFEDIT" value="RFEDIT">
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary btn-grad btn-rect">พร้อมรับงาน</button>
        </div>
    </div>
</form>
</p>
<script src="assets/plugins/select2/select2.full.min.js"></script>
<script>
$(function() {
    $(".select2").select2();
});
</script>

</html>