<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e_Refer</title>
    <link rel="stylesheet" href="./assets/multiselect/dist/picker.min.css">
    <script type="text/javascript" src="assets/multiselect/js/picker.min.js"></script>
    <style>
    <?php if( !isset($_SESSION)) {
        session_start();
    }

    if($did<>'') {
        $_SESSION['ih']='หัวหน้าแผนกยืนยัน';
    }

    else {
        $_SESSION['ih']='เตรียมส่งคนไข้ไปปลายทาง ';
    }

    #ตรวจสอบสิทธิการเข้าใช้งาน if ($_SESSION['hosname']=="") {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('ไม่พบสิทธิ [admin]') window.location.href='dashboard.php';
            </SCRIPT>");
?>
    </style>
</head>
<?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
include('main_top_menu_smenu.php');
?>
<?php
require_once("db/connection.php");
include('main_script.php');
#variable from post
$rfid=$_GET['id'];
if($_GET['hos']<>''){
    $hcode = $_GET['hos'];
}else{
    $hcode=$_SESSION['hcode'];
}
?>
<?php
$sql = "SELECT *
        FROM v_hossend_to_audit  WHERE rf_no_refer='$rfid' ";
$result_sql = mysqli_query($conn,$sql);
$rs=mysqli_fetch_array ($result_sql);
// วันที่ + เวลา
$rfdate = $rs['rf_date'];
$rft=$rs['rf_time'];
$rfev = $rs['rfevent'];
$rfhn=$rs['rf_hn'];
$rfpt = $rs['rf_patients'];
$rfs = $rs['hossendto_name'];
$rfno=$rs['rf_no_refer'];
$ehos=$rs['rf_hos_send_to'];
$expy=substr($rs['rf_expire_date'],0,4) + 543;
$exp=substr($rs['rf_expire_date'],8,2).'/'.substr($rs['rf_expire_date'],5,2).'/'.$expy;

$exuy=substr($rs['sento_hos_date'],6,4) + 543;
$exu=substr($rs['sento_hos_date'],0,2).'/'.substr($rs['sento_hos_date'],3,2).'/'.$exuy;

$rf='';
$rsshp=$rs['hosname'].'('.$rs['rf_hospital'].')';
$rssst=$rs['hossendto_name'].'('.$rs['rf_hos_send_to'].')';
if($rs['rf_rfev']=='1'){
    $rf='Refer Back';
}else{
    if($rs['rf_rfev']=='2'){
        $rf='Refer Out';
    }
}
?>
<?php 
$SQLh = mysqli_query($conn,"SELECT hcode,hosname FROM v_view_users 
WHERE hcode <> '$hcode' 
ORDER BY hcode");
?>

<body>
    <div class="row-fluid"
        style="font-family: K2D;font-size:18px;background-color:#0D47A1;color:#E0F2F1;text-align:center;">
        <label for=""><i class="fa fa-user-plus fa-1x" aria-hidden="true" style="color:#84FFFF"></i>
            <?php echo ' ('.$hcode.') ';?>Refer Audit ::
            ปลายทางยืนยันการรับคนไข้ เมื่อมาถึงแล้ว </label>
    </div>
    <div class="" style="margin: 2px 200px 2px;padding: 2px 2px 2px;">
        <div class="card border-info" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; font-family:K2D;font-size:18px; 
                        margin-top:10px;padding;10px;1px;10px;5px;">
            <div class="panel-heading"
                style="background-color:#311B92;  color:#F4ECF7;font-size: 18px;font-weight:30px;">
                <span class="glyphicon glyphicon-send"></span>
                Audit ระบบส่งต่อรายบุคคล
            </div>
            <div class="panel-body"
                style="background:#134c4c; font-family: K2D; font-size: 18px;font-weight:90; color:#E3F2FD;">
                <input type="hidden" name=ddate value=<?php echo $d_default;?> <input type="hidden" name=ss_hosp
                    value=<?php echo $hcode;?>>
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-sm-12"> Refer No :
                                <b><a class="text text-" style="color:#ec6a45;">
                                        <?php echo $rs['rf_no_refer']; ?>
                                    </a>
                                </b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> รพ.ขอ Refer :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['hosname'].'      ('.$rs['rf_hospital'].')'; ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">รพ.รับ Refer :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['hossendto_name'].'       ('.$rs['rf_hos_send_to'].')'; ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> วันที่ขอส่งต่อ :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['rf_date'].'</b> เวลา: <b>'.$rs['rf_time'].'</b> น.' ; ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> ประเภทส่งต่อ :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['rfevent']; ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">ความเร่งด่วน :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo$rs['rffast']; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-sm-12"> ชื่อ-สกุลผู้ป่วย :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['rf_patients']; ?> อายุ
                                    :<?php echo $rs['rf_age'].'  ปี    เพศ: '.$rs['rf_sex']; ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> HN :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['rf_hn'].'           AN:'.$rs['rf_an']; ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> หน่วยบริการ :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['rf_placename']; ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">กลุ่มงาน :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['m_depname'].' ('.$rs['m_code'].')';?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> แพทย์ผู้ส่ง :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['docsend_prename'].$rs['docsend_name'].'  '.$rs['docsend_surname'].'  (ว. '.$rs['docsend_code'].')';?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-sm-12"> สิทธิ์การรักษา :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['pttypename']; ?>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12"> รพ เรียกเก็บ :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['pay_hosp_name']; ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> วันหมดอายุ :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $exp; ?>
                            </div>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                แพทย์เจ้าของไข้ :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $rs['docme_prename'].$rs['docme_name'].'  '.$rs['docme_surname'].'  (ว. '.$rs['docme_code'].')';?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"> วันที่ Update :
                                <a class="text text-" style="color:#f0c04c;">
                                    <?php echo $exu; ?>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">เวลา :
                                <a class="text text-" style="color:#f0c04c;"><?php echo $rs['sento_hos_time'];?>
                                </a> น.
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <form action="insert_regis_rec_hos.php" method=POST target="">
                    <input type="hidden" name="rfid" value="<?php echo $_GET['sid']; ?>">
                    <input type="hidden" name="ehos" value="<?php echo $ehos; ?>">
                    <div class="card">
                        <div class="card-body"
                            style="background:#2c89af; opacity: 1; font-family:'K2D';font-size:17px;font-weight:10;color:#64e7e7;padding:20px 30px 40px 20px">
                            <div class="row">
                                <div class="col-sm-4">
                                    1. ความเหมาะสม
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">ผ่าน
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input"
                                                name="optradio" value="ss6">ไม่ผ่าน/ปรับปรุง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="s5">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    2. ความถูกต้อง
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">ผ่าน
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input"
                                                name="optradio" value="ss6">ไม่ผ่าน/ปรับปรุง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="s5">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    3. ความรวดเร็ว
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">ผ่าน
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input"
                                                name="optradio" value="ss6">ไม่ผ่าน/ปรับปรุง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="s5">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    4. ความปลอดภัย
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">ผ่าน
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input"
                                                name="optradio" value="ss6">ไม่ผ่าน/ปรับปรุง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="s5">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    5. ความพึงพอใจผู้ป่วย/ญาติ
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">1
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">3
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">4
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">5
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    6. ความพึงพอใจเจ้าหน้าที่ ต้นทาง
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">1
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">3
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">4
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">5
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    7. ความพึงพอใจเจ้าหน้าที่ ปลายทาง
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">1
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">3
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">4
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optradio" value="ss5">5
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.select2').select2({
            // theme: "classic"
            closeOnSelect: true
            // tags: true,
            // tokenSeparators: [',', ' ']
        });
    });
    </script>
</body>

</html>