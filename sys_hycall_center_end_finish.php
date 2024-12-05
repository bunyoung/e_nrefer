<!doctype html>
<?php
require_once("db/connection.php");

#variable from post
$hyitem=$_POST['hid'];
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
$hassname=$rsd['hassname'];
$place=$rsd['fullplace'];
$assname =$rsd['assname'];
$x1_pertime=$rsd['x1_pertime'];
$hdate=$rsd['hdate'];
$fullplace=$rsd['fullplace'];
$placeb=$rsd['placeb'];
$b=$rsd['b'];
$htime=$rsd['htime']; 
$idcard=$rsd['idcard'];
$perto=$rsd['perto'];
?>

<?php
?>
<header>
    <h4>
        สำหรับผู้ป่วย HN :
        <a class="text text-info">
            <?php echo $hn;?>
            ชื่อ : <?php echo $name;?>
        </a>
    </h4>
</header>
<p>
<form class="form-horizontal" action="sys_hycall_center_person.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">ประเภทคนไข้ :</label>
        <div class="col-lg-6">
            <input type="button" class="btn btn-danger" name="assname" value="<?php echo $assname;?>">
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
           <input class="form-control" type="text" name="htime" value="<?php echo substr($htime,11,8);  ?>">
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
        <label for="name" class="control-label col-lg-3">รับจาก :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="fullplace" value="<?php echo $fullplace; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label col-lg-3">ไปส่งที่ :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="placeb" value="<?php echo $placeb; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-lg-3">อุปกรณ์+อุปกรณ์เพิ่ม :</label>
        <div class="col-lg-6">
            <input class="form-control" type="text" name="hassname" value="<?php echo $hassname.' '.$b;?>">
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

        <input type="hidden" name="hn" value="<?php echo $hn;?>">
        <input type="hidden" name="eidcard" value="<?php echo $idcard;?>">
        <input type="hidden" name="FINISH" value="FINISH">
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary btn-grad btn-rect">พร้อมปิดงาน
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