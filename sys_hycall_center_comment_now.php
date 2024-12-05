<!doctype html>
<?php
require_once("db/connection.php");

#variable from post
$hy_cons=$_POST['hy_cons'];
?>
<?php
include ("main_script.php")
?>
<?php
#SQL
$sql="SELECT ecd.*, 
em.m_depname,es.s_ename,
dd.prename AS prea, dd.name AS namea, dd.surname AS surnamea,
dd1.prename AS preb,dd1.name AS nameb,dd1.surname AS surnameb,
dd2.prename AS prec,dd2.name AS namec,dd2.surname AS sunamec,
i.icd_desc AS icd_desca,i1.icd_desc AS icd_descb,i2.icd_desc AS icd_descc,
pt.name as ptname
FROM e_cons_detail ecd 
LEFT JOIN e_mdepart em ON em.m_depid=ecd.hdep
LEFT JOIN e_smdepart es ON es.s_edepart= ecd.sdep
LEFT JOIN doc_dbfs dd ON dd.doc_code=ecd.hdoc
LEFT JOIN doc_dbfs dd1 ON dd1.doc_code=ecd.fdoc
LEFT JOIN doc_dbfs dd2 ON dd2.doc_code=ecd.mdoc
LEFT JOIN icd10s i ON i.code=ecd.icda
LEFT JOIN icd10s i1 ON i1.code=ecd.icdb
LEFT JOIN icd10s i2 ON i2.code=ecd.icdc
LEFT JOIN pt_types pt ON pt.type_id = ecd.pt_types
WHERE cons_id=$hy_cons";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

#แสดงรายการข้อมูล
 $exp=$rsd['exp'];
 $icda=$rsd['icda'].' '.$rsd['icd_desca'];
 $icdb=$rsd['icdb'].' '.$rsd['icd_descb'];
 $icdc=$rsd['icdc'].' '.$rsd['icd_descc'];
 $comment=$rsd['comment'];
?>
<header>
    <h4>
        <strong>
            <p>
                รับใบ Consult NO :
                <a class="text text-info">
                    <?php echo $hy_cons;?>
                </a>
            </p>
        </strong>
    </h4>
    <hr>
</header>
<p>
<form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
    <div class="form-group">
        <label for="name" class="control-label col-md-3">จุดประสงค์การปรึกษา
            :</label>
        <div class="col-md-7">
            <input type="button" class="btn btn-success" name="assname" value="<?php echo $exp;?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-md-3">การวินิจฉัยโรค 1 :</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="hdate" value="<?php echo $icda; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-md-3">การวินิจฉัยโรค 2 :</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="hdate" value="<?php echo $icdb; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-md-3">การวินิจฉัยโรค 2 :</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="hdate" value="<?php echo $icdc; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-md-3">ให้คำปรึกษา :</label>
        <div class="col-md-7">
        <input class="form-control" type="text" name="d_comment" id="d_comment" rows="3" 
               value="<?php echo $comment; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3"></label>

        <input type="hidden" name="hy_cons" value="<?php echo $hy_cons;?>">
        <input type="hidden" name="RFEDIT" value="RFEDIT">
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