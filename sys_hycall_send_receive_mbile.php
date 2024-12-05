<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e_Refer</title>
    <link rel="stylesheet" href="assets/multiselect/dist/picker.min.css">
    <script type="text/javascript" src="assets/multiselect/js/picker.min.js"></script>
    <style>
    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
        font-size: 1.3em;
    }

    table caption {
        font-size: 1.4em;
        margin: .5em 0 .75em;
    }

    table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
    }

    table th,
    table td {
        padding: .625em;
        /* text-align: center; */
    }

    table th {
        font-size: 1.2em;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table caption {
            font-size: 1.8em;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
        }

        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: 1.8em;
            text-align: right;
        }

        table td::before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }

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
// include('main_top_panel_mbile.php');
// include('main_top_menu_session.php');
// include('sys_hycall_center_now_smenu.php');
?>
<?php
require_once("db/connection.php");
include('main_script.php');
#variable from post
// $rfid='2860';
$rfid=$_GET['id'];
?>
<?php
    //         SELECT *
    //         FROM v_rf_detail
    // WHERE rf_id='$rfid' ";

$sql = "
            SELECT *
                    FROM v_rf_detail
            WHERE rf_id='$rfid' ";
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

?>
<?php 
$SQLh = mysqli_query($conn,"SELECT hcode,hosname 
FROM rf_hospital WHERE hcode <> '$ehos' ");
// $SQLh = mysqli_query($conn,"SELECT hcode,hosname
// FROM v_view_users 
// WHERE hcode = '$ehos' 
// ORDER BY hcode");
?>

<body>
    <div class="container-fluid"
        style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; font-family:K2D;font-size:18px; margin-top:10px;">
        <div class="justify-content-md-center" style="margin: 0px;padding: 0px 0px 0px;">
            <div class="table" style="width:100%;font-family: K2D; margin-top:0px;">
                <div class="card border-info">
                    <div class="panel-heading" style="font-size: 18px;text-align:center;">
                        <span class="glyphicon glyphicon-send"></span>
                        การรับคนไข้เมื่อมาถึงปลายทาง
                    </div>
                    <div class="panel-body"
                        style="background:#00796B; font-family: K2D; font-size: 18px; color:#E3F2FD;">
                        <input type="hidden" name=ddate value=<?php echo $d_default;?> <input type="hidden" name=ss_hosp
                            value=<?php echo $hcode;?> <div class="row">
                        <div class="col-sm-4">Refer No: <?php echo $rs['rf_no_refer']; ?></div>
                        <div class="col-sm-4">รพ.ขอ Refer
                            :<?php echo $rs['hosname'].'      ('.$rs['rf_hospital'].')'; ?></div>
                        <div class="col-sm-4">รพ.รับ Refer
                            :<?php echo $rs['hossendto_name'].'       ('.$rs['rf_hos_send_to'].')'; ?></div>
                        <div class="col-sm-4">วันที่ขอส่งต่อ
                            :<?php echo $rs['rf_date'].'</b> เวลา: <b>'.$rs['rf_time'].'</b> น.' ; ?></div>
                        <div class="col-sm-4">ประเภทส่งต่อ : <?php echo $rs['rfevent']; ?></div>
                        <div class="col-sm-4">ความเร่งด่วน : <?php echo$rs['rffast']; ?></div>

                        <div class="col-sm-4">HN :<?php echo $rs['rf_hn'].'           AN :'.$rs['rf_an']; ?> </div>
                        <div class="col-sm-4">ชื่อ-สกุลผู้ป่วย : <?php echo $rs['rf_patients']; ?></div>
                        <div class="col-sm-4">อายุ :<?php echo $rs['rf_age'].'  ปี    เพศ : '.$rs['rf_sex']; ?></div>
                        <div class="col-sm-4">สิทธิ์การรักษา : <?php echo $rs['pttypename']; ?></div>
                        <div class="col-sm-4"> รพ เรียกเก็บ :<?php echo $rs['pay_hosp_name']; ?></div>
                        <div class="col-sm-4"> วันหมดอายุ :<?php echo $exp; ?></div>
                        <div class="col-sm-4"> วันที่ Update :<?php echo $exu; ?></div>
                        <div class="col-sm-4">เวลา :<?php echo $rs['sento_hos_time'];?> น.  </div>
                        <div class="col-sm-4">หน่วยบริการ : <?php echo $rs['rf_placename']; ?></div>
                        <div class="col-sm-4">แพทย์ผู้ส่ง :<?php echo $rs['docsend_prename'].$rs['docsend_name'].'  '.$rs['docsend_surname'].'  (ว. '.$rs['docsend_code'].')';?>             </div>
                        <div class="col-sm-4">แพทย์เจ้าของไข้ :<?php echo $rs['docme_prename'].$rs['docme_name'].'  '.$rs['docme_surname'].'  (ว. '.$rs['docme_code'].')';?>               </div>
                        <div class="col-sm-4">กลุ่มงาน :<?php echo $rs['m_depname'].' ('.$rs['m_code'].')';?></div>
                    </div>
 
                    <form action="insert_regis_rec_hos.php" method=POST target="">
                        <input type="hidden" name="rfid" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="ehos" value="<?php echo $ehos; ?>">
                        <div class="panel panel-warning">
                            <div class="panel-body"
                                style="background:#c5e0dc; opacity: 1; font-family:'K2D';font-size:18px;color:#095169;">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="newa">ผู้ป่วยถึงปลายทาง คือ
                                            <?php echo $rs['hossendto_name'].'       ('.$rs['rf_hos_send_to'].')';?></label>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="newa">ถ้าไม่ใช่ &nbsp; <?php echo $rs['hossendto_name']; ?>&nbsp;
                                            กรุณาระบุปลายทาง</label>
                                        <input class="form-control" type="text" name="hosid" value="" />
                                        <!-- <select class="form-control select2" name="hosid" id="hosid">
                                        <option value="" selected readonly>(เลือกรายการ)</option>
                                        <?php
                                            WHILE($row=mysqli_fetch_array($SQLh))
                                            {
                                            ?>
                                        <option value="<?php echo $row['hcode'];?>">
                                            <?php echo '['.$row['hcode'].']'.' - '.$row['hosname'];?>
                                        </option>
                                        <?php
                                            }
                                            ?>
                                    </select> -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="pcr">สภาพผู้ป่วยปัจจุบัน</label>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="newa">ลักษณะ</label>
                                        <select class="form-control" name="body" id="">
                                            <option value="">(เลือก)</option>
                                            <option value="ปลอดภัย">ปลอดภัย</option>
                                            <option value="เสียชีวติ">เสียชีวติ</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="newa">หน่วยงาน/บุคคลตอบรับ</label>
                                        <select class="form-control" name="fopd" id="">
                                            <option value="">(เลือก)</option>
                                            <option value="ER">ER</option>
                                            <option value="OPD">OPD</option>
                                            <option value="IPD">IPD</option>
                                            <option value="ศูนย์ส่งต่อ">ศูนย์ส่งต่อ</option>
                                            <option value="ผู้ป่วย/ญาติ">ผู้ป่วย/ญาติ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="oth">ชื่อผู้ตอบกลับ :</label>
                                    </div>
                                    <div class="form-group col-sm-7">
                                        <label for="oth">ชื่อ</label>
                                        <input type="text" class="form-control" name="ufor" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="lpcr">เบอร์โทรติดต่อ</label>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="lpcr">เบอร์โทร</label>
                                        <input type="text" class="form-control" name="ufotel" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group  col-sm-3">
                                        <label for="a1">กรุณาประเมินภาพรวมของระบบส่งต่อ:</label>
                                    </div>
                                    <div class="form-group  col-sm-2">
                                        <label for="a1">(5=ดีมาก 4=ดี 3=พอใช้ 2=ปรับปรุง 1=แก้ไขเร่งด่วน)</label>
                                        <input type="number" class="form-control" name="rca" value="" min="1" max="5">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group  col-sm-9">
                                        <label for="a1">ข้อแนะนำ/แก้ไข/ติชม</label>
                                        <input type="text" class="form-control" name="ehlp" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-1">
                                        <input type="hidden" name="action" value="send">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-success btn-grad"
                                                style="font-size:1.1em;">
                                                <span class="glyphicon glyphicon-ok-circle"></span>
                                                บันทึกยืนยันการรับ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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