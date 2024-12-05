<!doctype html>
<?php
require_once("db/connection.php");
#variable from post

$rid=$_POST['rid_p'];
?>
<?php
$sql = "
SELECT *
FROM v_rf_detail
WHERE rf_id='$rid' ";
$result_sql = mysqli_query($conn,$sql);
$rs=mysqli_fetch_array ($result_sql);
// วันที่ + เวลา
$rfdate = $rs['rf_date'];
$rft=$rs['rf_time'];
$rfev = $rs['rfevent'];
$rfhn=$rs['rf_hn'];
$rfpt = $rs['rf_patients'];
$rfs = $rs['hossendto_name'];
$fhos=$rs['rf_hospital'];
$tohos=$rs['rf_hos_send_to'];
$rfgrp=$rs['rfgroup'];
$mcode=$rs['m_code'];
$rsshp=$rs['hosname'].'('.$rs['rf_hospital'].')';
$rssst=$rs['hossendto_name'].'('.$rs['rf_hos_send_to'].')';

// ดึงรายการ Request ตอน Approved
$SQLe = mysqli_query($conn,"SELECT id,rf_request
            FROM rf_request
                WHERE rf_status='N'
            ORDER BY id");
?>

<div id="content3" style="font-family:sarabun;font-size: 17px; font-weight:normal">
    <div class="row">
        <div class="col-sm-12">
            <center>
                <label for="" class="label-control" style="color:#AB47BC;">ขออนุมัติ Refer Out จาก หัวหน้ากลุ่มงาน :
                    <a href="#" class="btn btn-warning"><?php echo $rs['m_depname'] ;?></a>
                </label>
            </center>
        </div>
    </div>
    <hr>
    <form class="form-horizontal" action="insert_regis_rfno_db.php" method=POST target="">
        <div class="form-group">
            <label for="username" class="control-label col-sm-3">ประเภทการ Refer </label>
            <div class="col-sm-6">
                <input type="text" id="username" name="rftype" placeholder="username" class="form-control"
                       value="<?php echo $rfev;?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">ระดับความรุนแรงของผู้ป่วย </label>
            <div class="col-sm-6">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['rffast'];?> ">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">สถานพยาบาลต้นทาง </label>
            <div class="col-sm-6">
                <input type="text" id="name" name="ffhos" class="form-control" readonly value="<?php echo $rsshp;?> ">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">สถานพยาบาลปลายทาง </label>
            <div class="col-sm-6">
                <input type="text" id="name" name="ttohos" class="form-control" readonly value="<?php echo $rssst;?> ">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">กลุ่มงาน-สาขา Refer out </label>
            <div class="col-sm-7">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['m_depname'].'-'.$rs['indication'];?> ">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">โรค/ภาวะ refer out</label>
            <div class="col-sm-7">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['sindication_name'];?> ">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">ชื่อ-สกุล </label>
            <div class="col-sm-7">
                <input type="text" id="name" name="name" placeholder="ชื่อ-สกุล" class="form-control" readonly
                       value="<?php echo $rfpt;?> ">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">HN </label>
            <div class="col-sm-3">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['rf_hn'];?> ">
            </div>
            <label for="name" class="control-label col-sm-1">AN </label>
            <div class="col-sm-3">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['rf_an'];?> ">
            </div>
        </div>
        <div class="form-group">
            <label for="cid" class="control-label col-sm-3">วันที่ </label>
            <div class="col-sm-3">
                <input type="text" id="nid" name="nid" class="form-control" readonly value="<?php echo $rfdate;?>">
            </div>
            <label for="cid" class="control-label col-sm-2">เวลา </label>
            <div class="col-sm-2">
                <input type="text" id="nid" name="nid" class="form-control" readonly value="<?php echo $rft;?>">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">สิทธิ์การรักษา </label>
            <div class="col-sm-7">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['pttypename'];?> ">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">อายุ </label>
            <div class="col-sm-1">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['rf_age'];?>">
            </div>
            <label for="name" class="control-label col-sm-1">ปี เพศ </label>
            <div class="col-sm-2">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['rf_sex'];?>">
            </div>
            <label for="name" class="control-label col-sm-1">เตียง </label>
            <div class="col-sm-2">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['rf_bedno'];?>">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="control-label col-sm-3">สถานพยาบาลหลัก </label>
            <div class="col-sm-7">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['hosmain'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">สถานพยาบาลรอง </label>
            <div class="col-sm-7">
                <input type="text" id="name" name="name" class="form-control" readonly
                       value="<?php echo $rs['hossub'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-sm-3">ตอบรับการ Refer </label>
            <div class="col-sm-4">
                <select class="form-control select2" name="dconf" id="dconf" required>
                    <option value="" selected readonly>(เลือกรายการ)</option>
                    <?php
                    while($rw=mysqli_fetch_array($SQLe))
                    {
                    ?>
                    <option value="<?php echo $rw['id'];?>">
                        <?php echo '['.$rw['id'].']'.' - '.$rw['rf_request'];?>
                    </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"> </label>
            <input type="hidden" name="rfid" value="<?php echo $rid;?>">
            <input type="hidden" name="rfgrp" value="<?php echo $rfgrp; ?>">
            <input type="hidden" name="rfcnf" value="rfcnf">
            <input type="hidden" name="mcode" value="<?php echo $mcode; ?>">
            <input type="hidden" name="fhos" value="<?php echo $fhos; ?>">
            <input type="hidden" name="tohos" value="<?php echo $tohos; ?>">
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary btn-grad">ยืนยัน </button>
            </div>
        </div>
    </form>
    </p>
</div>