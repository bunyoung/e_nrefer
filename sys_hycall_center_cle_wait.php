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
FROM v_cleanmonitor
WHERE hyitem='$hitem'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

#แสดงรายการข้อมูล
$place=$rsd['fullplace'];
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
<!-- <header>
    <h4> จ่ายงาน</h4>
</header> -->
<body>
<p>
<form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-lg-2">มอบหมาย ให้ จนท.:</label>
        <div class="col-lg-6">
            <select class="form-control input-sm select2" name="idcard" requied>
                <?php echo $idper;?>
            </select>
        </div>
    </div>
    <!-- /.row -->
    <div class="form-group">
        <label class="control-label col-lg-2"></label>
        <input type="hidden" name="htem" value="<?php echo $hitem;?>">
        <input type="hidden" name="REDIT" value="REDIT">
        <div class="col-lg-2">
            <button type="submit" class="btn btn-primary btn-grad btn-rect">มอบงาน
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
</body>
</html>