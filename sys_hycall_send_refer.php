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

    $hcode=$_SESSION['hcode'];

    #ตรวจสอบสิทธิการเข้าใช้งาน if ($_SESSION['hosname']=="") {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('ไม่พบสิทธิ [admin]') window.location.href='dashboard.php';
            </SCRIPT>");
?>
    </style>
</head>

<?php
// include('main_top_panel_head.php');
// include('main_top_menu_session.php');
// include('main_top_menu_smenu.php');

// include('main_top_panel_head.php');
// include('main_top_menu_session.php');
// include('sys_hycall_center_now_smenu.php');
?>
<?php
require_once("./db/connection.php");
include('main_script.php');
#variable from post
$rid=$_GET['sid'];
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
$rfno=$rs['rf_no_refer'];
$rfage=$rs['rf_age'];
$rfsex=$rs['rf_sex'];
$rfptname = $rs['pttypename'];
$rfind=$rs['indication'];
$rfm=$rs['m_depname'];
$rf='';
$rsshp=$rs['hosname'].'   ('.$rs['rf_hospital'].')';
$rssst=$rs['hossendto_name'].'  ('.$rs['rf_hos_send_to'].')';
if($rs['rf_rfev']=='1'){
    $rf='Refer Back';
}else{
    if($rs['rf_rfev']=='2'){
        $rf='Refer Out';
    }
}
?>
#81D4FA

<body>
    <!-- <div class="inner bg-" style="background-color:#311B92;" lter> -->

    <?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
include('main_top_menu_smenu.php');
?>
    <div class="row-fluid"
        style="font-family: 'K2D';font-size:18px;background-color:#0D47A1;color:#E0F2F1;text-align:center;">
        <label for=""><i class="fa fa-car fa-1x" aria-hidden="true" style="color:#84FFFF"></i>
            <?php echo '('.$hcode.')    ';?>Send Refer :: เตรียมความพร้อมคนไข้ก่อนดำเนินการเคลื่อนย้าย </label>
    </div>

    <div class="justify-content-md-center" style="margin: 2px 100px 2px;padding: 2px 2px 2px;">
        <div class="table" style="width:100%;font-family: 'K2D';font: weight 100px;">
            <div class="card border-info"
                style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; font-family:'K2D';font-size:17px; margin-top:10px;">
                <div class="panel-heading" style="background-color:#311B92;  color:#F4ECF7;font-size: 18px;">
                    <span class="glyphicon glyphicon-send"></span>
                    บันทึกยืนยันการส่งคนไข้เพื่อการรรักษาต่อ (e-Refer)
                </div>
                <div class="panel-body" style="background:#0288D1; font-family: 'K2D'; font-size: 18px; color:#E3F2FD;">
                    <div class="row">
                        <div class="col-sm-3"> RF.NO: <a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF"><?=$rfno; ?></a></div>
                        <div class="form-group col-sm-3"> วันที่:<a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF">
                                <?php echo $rfdate.'   เวลา :'.$rft.'  น.';?></a></div>
                        <div class="form-group col-sm-3">ชื่อ-สกุล :<a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF">
                                <?php echo  $rfpt.' HN :'.$rfhn;?></a></div>
                        <div class="form-group col-sm-1">อายุ: <a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF">
                                <?php echo $rfage;?></a> ปี</div>
                        <div class="form-group col-sm-1">เพศ: <a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF">
                                <?php echo $rfsex;?></a></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">สถานพยาบาลต้นทาง :<a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF">
                                <?php echo $rsshp;?></a></div>
                        <div class="form-group col-sm-3">สถานพยาบาลปลายทาง :<a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF">
                                <?php echo $rssst;?></a></div>
                        <div class="form-group col-sm-3">กลุ่มงาน-สาขา :<a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF">
                                <?php echo  $rfm;?></a></div>
                        <div class="form-group col-sm-3">สิทธิ์การรักษา :<a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF">
                                <?php echo $rfptname;?></a> </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">โรค/ภาวะ refer out :<a class="text text-"
                                style="font-size:18px;font-weight:80px;color:#18FFFF">
                                <?php echo $rfind;?> </a></div>
                    </div>
                </div>

                <form action="insert_regis_sendto_hos.php" method=POST target="">
                    <!-- <div class="panel panel-warning"> -->
                    <div class="panel-body" style="background:#81D4FA; opacity: 1; color:#095169;">
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="newa">V/S</label>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="newa">BT ('C)</label>
                                <input type="number" class="form-control col-sm-1" name="bt" id="bt">
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth">BP (mmHg) </label>
                                <input type="text" class="form-control col-sm-1" name="bpa" id="bpa">
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth"> .. </label>
                                <input type="text" class="form-control col-sm-1" name="bpb" id="bpb">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="oth">PR (per min)</label>
                                <input type="text" class="form-control col-sm-1" name="pr" id="pr">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="oth">RR (per min)</label>
                                <input type="text" class="form-control col-sm-1" name="rr" id="rr">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="oth">O2 sat (%)</label>
                                <input type="text" class="form-control col-sm-1" name="o2" id="o2">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="oth">Pain Score (0-10)</label>
                                <input type="number" class="form-control col-sm-1" name="pain" id="pain" min="0"
                                    max="10">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="pcr">สภาพผู้ป่วยปัจจุบัน</label>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="newa">ความรู้สึกตัว</label>
                                <select class="form-control" name="feel" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="รู้สึกตัวดี">รู้สึกตัวดี</option>
                                    <option value="รู้สึกตัวดี">ไม่รู้สึกตัว</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-10">
                                <label for="oth">อื่นๆ :</label>
                                <input type="text" class="form-control" name="feeloth" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="lpcr">Neuro sign</label>
                            </div>
                            <div class="form-group  col-sm-1">
                                <label for="a1">E:</label>
                                <input type="text" class="form-control" name="edata" value="" size='1'>
                            </div>
                            <div class="form-group  col-sm-1">
                                <label for="a1">V:</label>
                                <input type="text" class="form-control" name="vdata" value="" size='1'>
                            </div>
                            <div class="form-group  col-sm-1">
                                <label for="a1">M:</label>
                                <input type="text" class="form-control" name="mdata" value="" size='1'>
                            </div>
                            <div class="form-group  col-sm-2">
                                <label for="a1">pupil: RT:</label>
                                <input type="text" class="form-control" name="vdata" value="" size='1'>
                            </div>
                            <div class="form-group  col-sm-2">
                                <label for="a1">mm.</label>
                                <select class="form-control" name="rtplus" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="1">RTL</option>
                                    <option value="2">SRTL</option>
                                    <option value="3">NRTL</option>
                                </select>
                            </div>
                            <div class="form-group  col-sm-2">
                                <label for="a1">LT:</label>
                                <input type="text" class="form-control" name="vdata" value="" size='1'>
                            </div>
                            <div class="form-group  col-sm-2">
                                <label for="a1">mm.</label>
                                <select class="form-control" name="ltplus" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="1">RTL</option>
                                    <option value="2">SRTL</option>
                                    <option value="3">NRTL</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-sm-1">
                                <label for="a1">บาดแผล</label>
                            </div>
                            <div class="form-group  col-sm-1">
                                <label for="a1">บาดแผล</label>
                                <select class="form-control" name="body" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="1">ไม่มี</option>
                                    <option value="2">มี</option>
                                </select>
                            </div>
                            <div class="col-sm-10">
                                <label for="lpcr">(ลักษณะ/บริเวณ)</label>
                                <input type="text" class="col-sm-1 form-control" name="bodyarea" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="oth">Respiration</label>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth">Respiration</label>
                                <select class="form-control" name="res" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="มี">มี</option>
                                    <option value="ไม่มี">ไม่มี</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth">Room Air :</label>
                                <select class="form-control" name="rmair" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="มี">มี</option>
                                    <option value="ไม่มี">ไม่มี</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth">ON ET.Tube :</label>
                                <select class="form-control" name="tt" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="มี">มี</option>
                                    <option value="ไม่มี">ไม่มี</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth">No :</label>
                                <input class="form-control" name="no" type="text" value="" size="1">
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth">ลึก (cm)</label>
                                <input class="form-control" name="long" type="text" value="" size="1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="oth">ออกซิเจน</label>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth">T-piece (LPM)</label>
                                <input type="text" class="form-control" name="tpiece" value="" size="1">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="oth">Cannula (LPM) </label>
                                <input type="text" class="form-control" name="camula" value="" size="1">
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth">Mask (LPM)</label>
                                <input type="text" class="form-control" name="mask" value="" size="1">
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="oth">BOX (LPM)</label>
                                <input type="text" class="form-control" name="box" value="" size="1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="levcl">Ventilator Setting</label>
                            </div>
                            <div class="form-group col-sm-11">
                                <label for="levcl">Ventilator Setting</label>
                                <input type="text" class="form-control" name="ven" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="levcl">อุปกรณ์อื่น ๆ</label>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="levcl">ICD</label>
                                <select class="form-control" name="icd" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="pcr">Foley cath</label>
                                <select class="form-control" name="fc" name="" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-1">
                                <label for="pcr">NG Tube</label>
                                <select class="form-control" name="ng" name="" id="">
                                    <option value="">(เลือก)</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="pcr">ยาและสารน้ำที่ให้ในปัจจุบัน</label>
                            </div>
                            <div class="form-group col-sm-11">
                                <textarea rows="2" cols="60" class="form-control" name="drug"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="newa">วิธีการส่งผู้ป่วย</label>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="newa">ส่งโดย</label>
                                <select class="form-control" name="bus" name="" id="">
                                    <option value="">(เลือกรถไปส่ง)</option>
                                    <option value="รถ รพ. ต้นทางไปส่ง">รถ รพ. ต้นทางไปส่ง</option>
                                    <option value="รถ รพ. ปลายทางมารับ">รถ รพ. ปลายทางมารับ</option>
                                    <option value="รถ รพ. ศูนย์กลาง">รถ รพ. ศูนย์กลาง</option>
                                    <option value="ผู้ป่วยเดินทางมาเอง">ผู้ป่วยเดินทางมาเอง</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="levcl">ทะเบียนรถ</label>
                                <input type="text" class="form-control" name="nocar" value="" size="2">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="levcl">พนักงานขับรถ</label>
                                <input type="text" class="form-control" name="drivecar" value="">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="levcl">โทรศัพท์</label>
                                <input type="text" class="form-control" name="telnocar" value="" size="2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="levcl">เจ้าหน้าที่</label>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="levcl">เจ้าหน้าที่ คนที่ 1</label>
                                <input type="text" class="form-control" name="pera" value="">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="levcl">โทรศัพท์</label>
                                <input type="text" class="form-control" name="tela" value="" size="2">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="levcl">เจ้าหน้าที่ คนที่ 2</label>
                                <input type="text" class="form-control" name="perb" value="">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="levcl">โทรศัพท์</label>
                                <input type="text" class="form-control" name="telb" value="" size="2">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="levcl">ญาติหรือผู้เกี่ยวข้อง</label>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="levcl">ญาติหรือผู้เกี่ยวข้อง คนที่ 1</label>
                                <input type="text" class="form-control" name="sera" value="">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="levcl">โทรศัพท์</label>
                                <input type="text" class="form-control" name="telsa" value="" size="2">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="levcl">ญาติหรือผู้เกี่ยวข้อง คนที่ 2</label>
                                <input type="text" class="form-control" name="serb" value="">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="levcl">โทรศัพท์</label>
                                <input type="text" class="form-control" name="telsb" value="" size="2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <label for="levcl">Location บ้านผู้ป่วย</label>
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="levcl">Mapping</label>
                                <input type="text" class="form-control" name="loca" value="" size="2">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="levcl">Link Google Map</label>
                                <div class="row">
                                    <div class="form-group col-sm-10">
                                        <a href="https://www.google.co.th/maps/" target='_blank'>
                                            <img src='./img/gmap.png' atl="" style="width:40px; height:30px;">  Google Map  </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-1">
                                <input type="hidden" name="action" value="send">
                                <input type="hidden" name="rfid" value="<?php echo $_GET['sid']; ?>">
                                <input type="hidden" name="rfno" value="<?php echo $rfno; ?>">
                                <input type="hidden" name="ddate" value="<?php echo $d_default;?>">
                                <input type="hidden" name="hcode" value="<?php echo $hcode;?>">
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-grad" style="font-size:1.1em;">
                                    <span class="glyphicon glyphicon-ok-circle"></span>
                                    ยืนยันส่งผู้ป่วย
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>