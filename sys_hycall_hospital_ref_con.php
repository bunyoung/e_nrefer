<!doctype html>
<?php
require_once("./db/connection.php");
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
// ประเถทการ Refer
$rfev = $rs['rfevent'];
//  hn
$rfhn=$rs['rf_hn'];
// ชื่อนามสกุล
$rfpt = $rs['rf_patients'];
// รพ ต้นทาง
$rff = $rs['hosname'];
// รพ ปลายทาง
$rfs = $rs['hossendto_name'];
?>

<body style="font-family:'K2D';font-size:17px;">
    <p>
    <form class="form-horizontal" action="insert_regis_accept_db.php" method=POST target="">
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;" for="password">รพ. รับปลายทาง </label>
            <div class="col-sm-6">
                <input type="text" id="text" name="text" class="form-control" disabled value="<?php echo $rfs;?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;"> รพ. ส่งต้นทาง
            </label>
            <div class="col-sm-6">
                <input type="text" id="text" name="text" class="form-control" disabled value="<?php echo $rff;?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">ชื่อ-สกุล
            </label>
            <div class="col-sm-4">
                <input type="text" id="name" name="name" placeholder="ชื่อ-สกุล" class="form-control" disabled
                    value="<?php echo $rfpt;?> ">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">วันที่ เวลา
            </label>
            <div class="col-sm-3">
                <input type="text" id="nid" name="nid" class="form-control" disabled
                    value="<?php echo $rfdate .' '.$rft;?>">
            </div>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">ประเภทการ Refer
            </label>
            <div class="col-sm-6">
                <input type="text" id="username" name="username" class="form-control" disabled
                    value="<?php echo $rfev;?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">การรับ Refer
            </label>
            <div class="col-sm-3">
                <select class="form-control" name="rcf" id="rcf" required>
                    <option value="1">ยืนยันรับ Refer</option>
                    <option value="2">ปฎิเสธการรับ</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">กรุณาระบุ ชื่อแพทย์ที่รับส่งต่อ
            </label>
            <div class="col-sm-6">
                <input type="text" id="doc" name="doc" class="form-control" placeholder="ระบุชื่อแพทย์ที่รับส่งต่อ">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">โทรศัพท์แพทย์ที่รับส่งต่อ
            </label>
            <div class="col-sm-6">
                <input type="text" id="dtel" name="dtel" class="form-control"
                    placeholder="ระบุเหตุ โทรศัพท์แพทย์ที่รับส่งต่อ">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">โทรศัพท์เจ้าหน้าที่ (พยาบาล) </label>
            <div class="col-sm-6">
                <input type="text" id="tel" name="tel" class="form-control" placeholder="โทรศัพท์เจ้าหน้าที่ (พยาบาล) ">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">โปรดระบุ หน่วยงาน (OPD/IPD)
            </label>
            <div class="col-sm-6">
                <input type="text" id="rdept" name="rdept" class="form-control" placeholder="ระบุหน่วยงาน (OPD/IPD)">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">โปรดระบุ เวลา วันที่นัด
            </label>
            <div class="col-sm-6">
                <input type="text" id="fdate" name="fdate" class="form-control" placeholder="ระบุเวลา วันที่นัด">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">โปรดระบุ เวลา วันที่ มารับผู้ป่วย
            </label>
            <div class="col-sm-6">
                <input type="text" id="rcdate" name="rcdate" class="form-control"
                    placeholder="ระบุ เวลา วันที่ มารับผู้ป่วย">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" style="color:black;">โปรดระบุ เหตุผลที่ ปฎิเสธ Refer
            </label>
            <div class="col-sm-6">
                <input type="text" id="comment" name="comment" class="form-control"
                    placeholder="ระบุเหตุผลที่ ปฎิเสธ Refer">
            </div>
        </div>

        <!-- /.row -->
        <div class="form-group">
            <label class="control-label col-sm-4">
            </label>
            <input type="hidden" name="rfid" value="<?php echo $rid;?>">
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary btn-grad">บันทึกข้อมูล !!! </button>
            </div>
        </div>
    </form>
</body>

</html>