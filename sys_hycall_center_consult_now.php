<!doctype html>
<?php
session_start(); 
require_once("db/connection.php");

$user_name=$_SESSION['user_name'];
$user_id=$_SESSION['user_id'];

#variable from post
$hy_cons=$_POST['hy_cons'];
?>
<?php
include ("main_script.php")
?>
<?php
#SQL
$sql="SELECT * FROM v_consult_detail WHERE cons_id=$hy_cons; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql);

$SQLop = mysqli_query($conn,"SELECT id,e_option
FROM e_option WHERE e_status='Y' ORDER BY id");
?>
<header>
    <h4>
        <strong>
            <p>
                ใบรับ Consult NO :
                <a class="text text-info">
                    <?php echo $rsd['mcode'].'-'.$hy_cons.' โดยแพทย์ :'.$user_name;?>
                </a>
            </p>
        </strong>
    </h4>
    <hr>
</header>
<p>
<form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-md-3">กลุ่มงาน :</label>
        <div class="col-md-7">
            <label for="name" class="control-label">
                <?php echo '['.$rsd['m_depname'].'] '.$rsd['s_ename'];?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-md-3">แพทย์ผู้ปรึกษา :</label>
        <div class="col-md-7">
            <label for="name" class="control-label">
                <?php echo $rsd['hdoc'].'  '.$rsd['namea'].'   '.$rsd['surnamea'];?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-md-3">Ward Staft :</label>
        <div class="col-md-7">
            <label for="name" class="control-label">
                <?php echo $rsd['fdoc'].'  '.$rsd['nameb'].'   '.$rsd['surnameb'];?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-md-3">กลุ่มงานที่ขอปรึกษา :</label>
        <div class="col-md-7">
            <label for="name" class="control-label">
                <?php echo $rsd['conmdepname'];?>
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label col-md-3">ตอบรับ Consult </label>
        <div class="col-md-3">
            <select class="form-control select2" name="opt" id="opt">
                <option value="" selected disabled>(เลือกรายการ)</option>
                <?php
                WHILE($rs=mysqli_fetch_array($SQLop))
                {
                ?>
                <option value="<?php echo $rs['id'];?>">
                <?php echo '['.$rs['id'].']'.' - '.$rs['e_option'];?>
                </option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label col-md-3"><button class="btn btn-danger">บันทึกรายละเอียด</button></label>
        <div class="col-md-7">
            <textarea class="form-control" name="d_comment" id="d_comment" rows="4"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3"></label>
        <input type="hidden" name="hy_cons" value="<?php echo $hy_cons;?>">
        <input type="hidden" name="RFEDIT" value="RFEDIT">
        <div class="col-md-3">
            <button type="submit" class="btn btn-success btn-grad btn-rect">บันทึก Consult</button>
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