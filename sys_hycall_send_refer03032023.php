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
include('main_top_panel_head.php');
include('main_top_menu_session.php');
include('sys_hycall_center_now_smenu.php');
?>
<?php
require_once("db/connection.php");
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
$rf='';
$rsshp=$rs['hosname'].'('.$rs['rf_hospital'].')';
$rssst=$rs['hossendto_name'].'('.$rs['rf_hos_send_to'].')';
if($rs['rf_rfev']=='1'){
    $rf='Refer Back';
}else{if($rss['rf_rfev']=='2'){
    $rf='Refer Out';
    }
}
?>

<body>
    <div class="mast-heade justify-content-md-center" style="margin: 2px 20px 2px;padding: 2px 2px 2px;">
        <table id="dataTable" class="display dataTable table-sm" role="grid" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll; max-width: 100%; display: block;font-family:sarabun; 
                           white-space: word-wrap: break-word;" cellspacing="0">
            <thead style="font-family: 'sarabun'; margin-top:0px;background-color:#367E18;color:#F1F8E9">

            <tbody>
                <tr>
                    <td style="font-weight:Bold;background-color:#8E44AD;color:#FDFEFE"> Refer Number :
                        <?php echo $rs['rf_no_refer']; ?></td>
                    <td> วันที่ : <?php echo $rfdate;?></td>
                    <td> เวลา : <?php echo $rft;?></td>
                </tr>
                <tr>
                    <td> ชื่อ-สกุล : <?php echo  $rfpt;?></td>
                    <td> อายุ : <?php echo $rs['rf_age'];?> ปี </td>
                    <td> เพศ : <?php echo $rs['rf_sex'];?></td>
                </tr>
                <tr>
                    <td colspan="3"> สถานพยาบาลต้นทาง :<?php echo $rsshp;?></td>
                </tr>
                <tr>
                    <td colspan="3"> สถานพยาบาลปลายทาง : <?php echo $rssst;?></td>
                </tr>
                <tr>
                    <td colspan="1"> กลุ่มงาน-สาขา : <?php echo  $rs['m_depname'];?></td>
                    <td colspan="2"> สิทธิ์การรักษา : <?php echo $rs['pttypename'];?> </td>
                </tr>
                <tr>
                    <td colspan="3"> โรค/ภาวะ refer out : <?php echo$rs['indication'];?></td>
                </tr>
            </tbody>
        </table>
        <!--  -->
        <br>
        <form class="form-inline" action="insert_regis_sendto_hos.php" method=POST target="">
            <div class="mast-heade justify-content-md-center" style="margin: 2px 20px 2px;padding: 2px 2px 2px;">
                <table id="dataTable" class="display dataTable table-sm" role="grid" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll; max-width: 100%; display: block; font-family:sarabun;
                           white-space: word-wrap: break-word;" cellspacing="0">
                    <input type="hidden" name="rfid" value="<?php echo $_GET['sid']; ?>">
                    <input type="hidden" name="rfno" value="<?php echo $rfno; ?>">
                    <tr>
                        <th colspan="14">สภาพผู้ป่วยปัจจุบัน </th>
                    </tr>
                    <tr>
                        <td colspan='4'>ระดับความรู้สึกตัว :</td>
                        <td colspan="3">
                            <select class="form-control" name="feel" id="">
                                <option value="รู้สึกตัวดี">รู้สึกตัวดี</option>
                                <option value="รู้สึกตัวดี">ไม่รู้สึกตัว</option>
                            </select>
                        </td>
                        <td colspan="1">อื่นๆ :</td>
                        <td colspan="4"><input type="text" class="form-control" name="feeloth" value=""></td>
                    </tr>
                    <tr>
                        <td colspan="4">Neuro sign :</td>
                        <td colspan="1">E :</td>
                        <td colspan="1"><input type="text" class="form-control" name="edata" value="" size='1'></td>
                        <td colspan="1">V :</td>
                        <td colspan="1"><input type="text" class="form-control" name="vdata" value="" size='1'></td>
                        <td colspan="1">M :</td>
                        <td><input type="text" class="form-control" name="mdata" value="" size='1'></td>
                        <td colspan="1">pupil: RT</td>
                        <!--  เพิ่ม-->
                        <td colspan="1"><input type="text" class="form-control" name="vdata" value="" size='1'> mm.</td>

                        <td colspan="1">
                            <select class="form-control" name="rtplus" id="">
                                <option value="1">RTL</option>
                                <option value="2">SRTL</option>
                                <option value="3">NRTL</option>
                            </select>
                        </td>
                        <td colspan="1">LT :</td>
                        <!--  เพิ่ม-->
                        <td colspan="1"><input type="text" class="form-control" name="vdata" value="" size='1'> mm.</td>

                        <td colspan="1">
                            <select class="form-control" name="ltplus" id="">
                                <option value="1">RTL</option>
                                <option value="2">SRTL</option>
                                <option value="3">NRTL</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">บาดแผล</td>
                        <td colspan="1">
                            <select class="form-control" name="body" id="">
                                <option value="1">ไม่มี</option>
                                <option value="2">มี</option>
                            </select>
                        </td>
                        <td colspan="2">(ลักษณะ/บริเวณ) :</td>
                        <td colspan="6"><input type="text" class="col-sm-6 form-control" name="bodyarea" value="">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">respiration</td>
                        <td colspan="2">
                            <select class="form-control" name="res" id="">
                                <option value="มี">มี</option>
                                <option value="ไม่มี">ไม่มี</option>
                            </select>
                        </td>
                        <td colspan="2">Room Air :
                            <select class="form-control" name="rmair" id="">
                                <option value="มี">มี</option>
                                <option value="ไม่มี">ไม่มี</option>
                            </select>
                        </td>
                        <td colspan="2">on ET. Tube :
                            <select class="form-control" name="tt" id="">
                                <option value="มี">มี</option>
                                <option value="ไม่มี">ไม่มี</option>
                            </select>
                        </td>
                        <td colspan="1">No :</td>
                        <td colspan="1"><input class="form-control" name="no" type="text" value="" size="1"></td>
                        <td colspan="1">ลึก :</td>
                        <td colspan="1"><input class="form-control" name="long" type="text" value="" size="1"></td>
                    </tr>
                    <tr>
                        <td colspan="4">ออกซิเจน</td>
                        <td colspan="1">T-piece</td>
                        <td colspan="1"><input type="text" class="form-control" name="tpiece" value="" size="1">LPM
                        </td>
                        <td colspan="1">Cannula</td>
                        <td colspan="1"><input type="text" class="form-control" name="camula" value="" size="1">
                            LPM
                        </td>
                        <td colspan="1">Mask</td>
                        <td colspan="1"><input type="text" class="form-control" name="mask" value="" size="1">
                            LPM
                        </td>
                        <td colspan="1">BOX</td>
                        <td colspan="1"><input type="text" class="form-control" name="box" value="" size="1">
                            LPM
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">Ventilator setting</td>
                        <td colspan="9"><input type="text" class="form-control" name="ven" value="" size="9"> </td>
                    </tr>
                    <tr>
                        <td colspan="4">อุปกรณ์อื่น ๆ</td>
                        <td colspan="1">ICD </td>
                        <td colspan="1">
                            <select class="form-control" name="icd" id="">
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </td>
                        <td colspan="1">Foley cath</td>
                        <td colspan="1">
                            <select class="form-control" name="fc" name="" id="">
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </td>
                        <td colspan="1">NG Tube </td>
                        <td colspan="1">
                            <select class="form-control" name="ng" name="" id="">
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </td>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td colspan="4">ยาและสารน้ำที่ให้ในปัจจุบัน</td>
                        <td colspan="10"><input type="text" class="form-control" name="drug" value=""> </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="4">
                            <button type="submit" class="btn btn-primary btn-grad">ยืนยันส่งผู้ป่วย
                            </button>
                        </td>
                        <td colspan="4"></td>
                    </tr>
                </table>
        </form>
    </div>
</body>
</html>