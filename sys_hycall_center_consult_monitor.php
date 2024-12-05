<!doctype html>
<?php
require_once("db/connection.php");
require_once('main_script.php');
#variable from post
$hy_cons=$_POST['hy_cons'];
?>
<?php
#SQL
$sql="SELECT * FROM v_consult_detail WHERE cons_id=$hy_cons; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql);
?>
<?php
$iddoc= "";
$query=mysqli_query($conn,"
       SELECT doc_code,prename,name,surname FROM doc_dbfs  WHERE doc_status='0' ORDER BY doc_code");
while($row=mysqli_fetch_array($query))
{
    $docname = $row['doc_code'].'-'.$row['prename'].''.$row['name'].'   '.$row['surname'];
    $iddoc .='<option value=" '.$row['doc_code'].' ">'.$docname.'</option>';
}
?>
<header>
    <h4>
        <strong>
            <p>
                เลขที่ใบ Consult :
                <a class="text text-info">
                    <?php echo $rsd['mcode'].'-'.$hy_cons;?>
                </a>
            </p>
        </strong>
    </h4>
    <hr>
</header>
<p>
<form class="form-horizontal" action="monitor_consult_befor_request.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-md-3">กลุ่มงานที่ขอปรึกษา :</label>
        <div class="col-md-7">
            <label for="name" class="control-label">
                <?php echo '['.$rsd['condep'].'] '.$rsd['conmdepname'];?>
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label col-md-3">ส่งขอ Consult ประจำวันที่/เวลา :</label>
        <div class="col-md-7">
            <label for="name" class="control-label">
                <?php echo $rsd['cons_date'].'  เวลา :'.$rsd['cons_time'].'  น.';?>
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
        <label for="name" class="control-label col-md-3">Ward staff เจ้าของไข้ :</label>
        <div class="col-md-7">
            <label for="name" class="control-label">
                <?php echo $rsd['fdoc'].'  '.$rsd['nameb'].'   '.$rsd['surnameb'];?>
            </label>
        </div>
    </div>


    <div class="form-group">
        <label for="name" class="control-label col-md-3">HN/AN/ชื่อ สกุล :</label>
        <div class="col-md-7">
            <input type="button" class="btn btn-success" name="patient"
                value="<?php echo 'HN :'.$rsd['hn'].' AN :'.$rsd['an'].' ชื่อ-สกุล :'.$rsd['pname'];?>">
        </div>
    </div>

    <div class="form-group">
        <label for="doctor" class="control-label col-md-3">แพทย์ :</label>
        <div class="col-md-4">
            <select class="form-control input-sm select2" name="doctor">
                <?php echo $iddoc;?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3"></label>
        <input type="hidden" name="hy_cons" value="<?php echo $hy_cons;?>">
        <input type="hidden" name="RFT" value="RFT">
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-grad btn-rect">บันทึก Consult</button>
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