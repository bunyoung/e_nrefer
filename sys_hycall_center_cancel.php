<?php
require_once("db/connection.php");

#variable from post
$hitem=$_POST['hyitems'];
?>
<?php
include ("main_script.php")
?>
<?php
#SQL
$sql = "SELECT
   *
FROM v_asmonitor
WHERE hyitem='$hitem'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );
$assn=$rsd['assname'];
$htem=$rsd['hyitem'];
?>
<!-- ทำการยกเลิกข้อมูล -->
<?php
?>
<header>
    <h5> เวชภันฑ์และสิ่งของ :
        <a class="text text-success">
            <?php echo $htem;?>
        </a> <?php echo $assn; ?>
    </h5>
</header>
<p>
<form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
    <!-- /.row -->
    <div class="form-group">
        <label class="control-label col-lg-2">
        </label>
        <input type="hidden" name="hitem" value="<?php echo $htem;?>">
        <input type="hidden" name="DEL" value="DEL">
        <br>
        <div class="col-lg-3">
            <button type="submit" class="btn btn-danger btn-grad btn-rect">ยืนยันการยกเลิก
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