<!doctype html>
<?php
require_once("db/connection.php");

#variable from post
$hitem=$_POST['hyitem'];
?>
<?php
include ("main_script.php")
?>
<?php
#SQL
$sql = "SELECT
   *
FROM v_monitor
WHERE hyitem='$hitem'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

#แสดงรายการข้อมูล
$hn=$rsd['hn'];
$name=$rsd['patients'];
$hassname=$rsd['hassname'];
$place=$rsd['fullplace'];
$pold=$rsd['old'];
$pid=$rsd['idcard'];
?>

<?php
$idper= "";
$query=mysqli_query($conn,"SELECT idcard,name,perstatus FROM employee
 ORDER BY name") OR die(mysqli_error());
while($row=mysqli_fetch_array($query))
{
    $idper .='<option value=" '.$row['idcard'].'">'.$row['idcard'].' '.$row['name'].'</option>';
}
?>

<!-- ทำการบันทึกรายการข้อมูล -->
<?php
?>
<header>
    <h4> จ่ายงาน <small> สำหรับผู้ป่วย HN :
            <a class="text text-success">
                <?php echo $hn;?>
            </a> ชื่อ : <?php echo $name;?></small>
    </h4>
</header>
<p>
<form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-lg-2">ให้ จนท.ศูนย์เปล :</label>
        <div class="col-lg-6">
            <select class="form-control input-sm select2" name="idcard" requied>
                <?php echo $idper;?>
            </select>
        </div>
    </div>
    <!-- /.row -->
    <div class="form-group">
        <label class="control-label col-lg-2">
        </label>
        <input type="hidden" name="hitem" value="<?php echo $hitem;?>">
        <input type="hidden" name="hold" value="<?php echo $pold;?>">
        <input type="hidden" name="hid" value="<?php echo $pid;?>">
        <input type="hidden" name="EDIT" value="EDIT">
        <div class="col-lg-2">
                <button type="submit" class="btn btn-primary btn-grad btn-rect">จ่ายงาน
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