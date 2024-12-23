<?php
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-Refer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<style>
#headcolor {
    background-color: #511281;
}

div.img-resize img {
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: -23px;
    width: 105px;
    height: 100px;
    float: left;
}

div.img-logo img {
    margin-top: 10px;
    margin-bottom: 5px;
    margin-right: -23px;
    width: 80px;
    height: 80px;
    float: right;
}

div.img-logistic img {
    margin-top: 15px;
    margin-bottom: 5px;
    margin-right: -23px;
    width: 120px;
    height: 80px;
    float: right;
    border-radius: 50%;
}
</style>
<?php
require_once("db/connection.php");
require_once('db/connect_pmk.php');
?>
<?php
#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult='01/' ;
# $date_start_m_defult=date('m/');
$date_start_m_defult='01/';
$date_start_y_defult=date('Y')+543 ;
$date_start_dmy_defult	= $date_start_d_defult.$date_start_m_defult.$date_start_y_defult;
// 01/m/y+543

$date_end_dm_defult=date('d/m/') ;
$date_end_y_defult=date('Y')+543 ;
$date_end_dmy_defult=$date_end_dm_defult.$date_end_y_defult;

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;

// วันที่ปัจจุบัน
$d_default=$date_curr_dmy_defult;

?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];
 $hname=$_SESSION["hosname"];
 $_SESSION['ih'] = 'Refer-Back/Out';
#ตรวจสอบสิทธิการเข้าใช้งาน
if ($_SESSION['hosname']=="") {
    echo '<script type="text/javascript">
            swal("Warning", "ต้อง Login เข้าสู่ระบบก่อนการใช้งาน !!", "danger");
          </script>';
}
?>
<?php
$SQLe = mysqli_query($conn,"SELECT rfid,rftype,rfevent
            FROM rf_event
            WHERE rfstatus='N'
            ORDER BY rftype");

$SQLpd = mysqli_query($conn,"SELECT m_depid,m_depname
            FROM rf_mdepart WHERE m_status ='0' ORDER BY m_depname") ;

$SQLf = mysqli_query($conn,"SELECT rfid,rffast
            FROM rf_fast 
            WHERE rfstatus='N' 
            ORDER BY rffast ");

$SQLh = mysqli_query($conn,"SELECT hcode,hosname
FROM v_view_users 
WHERE hcode <> '$hcode' 
ORDER BY hcode");

$SQLd="
    SELECT DOC_CODE,NAME,PRENAME,SURNAME
    FROM doc_dbfs
    WHERE(DOC_CODE like '$q%' OR NAME like '$q%' OR PRENAME like '$q%') AND
        PRENAME IN ('ทพ','ทพ.','ทต','ทต.','พญ.','พญ','ดร.พญ.','นพ','นพ.','น.พ.') AND 
        DOC_CODE <>'ADMIN' AND 
        DEL_FLAG IS NULL";
?>
<?php 
include('main_top_panel_head.php');
?>
<?php 
 include('main_top_menu_session.php');
include('sys_hycall_center_now_smenu.php');
?>
<?php 
    include('main_script.php');
?>

<body>
    <div class="justify-content-md-center" style="margin: 2px 90px 2px;padding: 2px 2px 2px;">
        <div class="table" style="width:100%;font-family: 'sarabun'; margin-top:0px;">
            <div class="card border-info"
                style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; font-family:sarabun;font-size:15px; margin-top:10px;">
                <div class="panel-heading" style="background-color:#663399;
                          color:#F4ECF7;font-size: 1.2em;">
                    <span class="glyphicon glyphicon-send"></span>
                    ขอใช้บริการส่งคนไข้เพื่อการรรักษาต่อ (e-Refer)
                </div>
                <div class="panel-body" style="background-color:#547980; color:#00dffc;">
                    <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="opd" class="label-control">
                                OPD / IPD ผู้ป่วยรักษา (HIS)
                            </label>
                            <select class="form-control select2" name="places" id="places"
                                style="width: 100%;font-family:sarabun;font-size:14px;">
                                <option value="" selected readonly>(เลือกรายการ)</option>
                                <?php 
                            $strSQL2 = "SELECT * FROM PLACES WHERE PT_PLACE_TYPE_CODE  IN ('1','2') 
                            AND DEL_FLAG IS NULL
                            ORDER BY PLACECODE ASC"; 
                            $objParse2 = oci_parse($objConnect, $strSQL2);  
                            oci_execute ($objParse2,OCI_DEFAULT);   
                            while($objResult2 = oci_fetch_array($objParse2,OCI_BOTH)) 
                            { 
                            ?>
                                <option value="<?=$objResult2["PLACECODE"];?>">
                                    <?=$objResult2["PLACECODE"]." - ".$objResult2["HALFPLACE"];?>
                                </option>
                                <?php
                             }                                                                  
                            ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="hn">ชื่อ-สกุล ผู้ป่วย</label>
                            <select class="form-control select2" name="fhn" id="fhn" required>
                                <option value="">ชื่อ-สกุล</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-2">
                            <label for="sex">HN</label>
                            <input type="text" class="form-control" name="dhn" id="dhn" readonly>
                        </div>

                        <div class="form-group col-sm-2">
                            <label for="sex">AN</label>
                            <input type="text" class="form-control" name="dan" id="dan" readonly>
                        </div>

                        <div class="form-group col-sm-2">
                            <label for="dateadmit">วันที่เข้ารักษา</label>
                            <input type="text" class="form-control" name="dateserv" id="dateserv" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="bed">OPD/Ward</label>
                            <input type="text" class="form-control" name="nplaces" id="nplaces" readonly>
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="ptype">สิทธิ์การรักษา</label>
                            <input type="text" class="form-control" name="ptname" id="ptname" readonly>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="dateadmit">กรุ๊ปเลือด</label>
                            <input type="text" class="form-control" name="blood" id="blood" readonly>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="sex">เพศ</label>
                            <input type="text" class="form-control" name="sex" id="sex" readonly>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="old">อายุ</label>
                            <input type="text" class="form-control" name="age" id="age" readonly>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="old">เตียง</label>
                            <input type="text" class="form-control" name="bed" id="bed" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="hosa">สถานพยาบาลหลัก</label>
                            <input type="text" class="form-control" name="mhosname" id="mhosname" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="add1">ที่อยู่ตามสำเนาทะเบียนบ้าน</label>
                            <input type="text" class="form-control" name="maddress" id="maddress">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="add2">โทรศัพท์ (ตามระบบ)</label>
                            <input type="text" class="form-control" name="mtel" id="mtel">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="add3">สถานพยาบาลรอง</label>
                            <input type="text" readonly class="form-control" name="shosname" id="shosname">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="add4">ที่อยู่ปัจจุบัน</label>
                            <input type="text" class="form-control" name="saddress" id="saddress">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="add5">โทรศัพท์</label>
                            <input type="text" class="form-control" name="stel" id="stel" placeholder="กรอกเบอร์ที่สามารถติดต่อได้">
                        </div>
                    </div>
                    <div class="panel panel-warning">
                        <div class="panel-body" style="background:#c5e0dc; opacity: 1;
                            color:#095169;">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="oth">สถานพยาบาลปลายทาง</label>
                                    <select class="form-control select2" name="hoseid" id="hoseid">
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
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="pcr">ระดับความรุนแรงของผู้ปวย (ระยะเวลาที่ควรส่งต่อ)</label>
                                    <select class="form-control select2" name="hotlevel" id="hotlevel">
                                        <option value="" selected readonly>(เลือกรายการ)</option>
                                        <?php
                                    while($row=mysqli_fetch_array($SQLf))
                                    {
                                    ?>
                                        <option value="<?php echo $row['rfid'];?>">
                                            <?php echo '['.$row['rfid'].']'.' - '.$row['rffast'];?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pcr">ประเภทส่งต่อ (หน่ายงานรับปลายทาง)</label>
                                    <select class="form-control select2" name="rfev" id="rfev">
                                        <option value="" selected readonly>(เลือกรายการ)</option>
                                        <?php
                                            while($rw=mysqli_fetch_array($SQLe))
                                            {
                                            ?>
                                        <option value="<?php echo $rw['rfid'];?>">
                                            <?php echo '['.$rw['rftype'].']'.' - '.$rw['rfevent'];?>
                                        </option>
                                        <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>

                            <!-- เพิ่มใหม่ -->
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="newa">Refer Out (กลุ่มงาน)</label>
                                    <select class="form-control select2" name="rid" id="rid">
                                        <option value="" selected readonly>(เลือกรายการ)</option>
                                        <?php 
                                        $sqlif = "SELECT * FROM rf_indication WHERE status ='Y'  ORDER BY departname ASC"; 
                                        $rf_i=mysqli_query($conn,$sqlif)  ;                                       
                                        while($rfi = mysqli_fetch_array($rf_i)) 
                                        { 
                                        ?>
                                        <option value="<?=$rfi["id"];?>">
                                            <?=$rfi["id"]." - ".$rfi["departname"];?>
                                        </option>
                                        <?php
                                        }                                                                  
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="oth">Refer Out (สาขา/โรค/อวัยวะ)</label>
                                    <select class="form-control select2" name="rsid" id="rsid">
                                        <option value="" selected readonly>(เลือกรายการ)</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="oth">Refer Out (โรค/ภาวะ)</label>
                                    <select class="form-control select2" name="rsdi" id="rsdi">
                                        <option value="" selected readonly>(เลือกรายการ)</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <!-- สิ้นสุดที่เพิ่มใหม่ -->

                            <!-- เพิ่มใหม่เรื่องการวัดอุณภูมิ -->
                            <div class="panel panel-warning">
                                <div class="panel-body" style="background:#006064; opacity: 1; color:#FCE4EC;">
                                    <div class="row">
                                        <div class="form-group col-sm-2">
                                            <label for="newa">BT ('C)</label>
                                            <input type="number" class="form-control col-sm-1">
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="oth">BP (mmHg) </label>
                                            <input type="text" class="form-control col-sm-1" name="bp" id="bp">
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label for="oth">PR  (per min)</label>
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
                                            <input type="number" class="form-control col-sm-1"  name="pain" id="pain"  min="0" max="10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- สิ้นสุดที่เพิ่มใหม่ -->

                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label for="lpcr">ประวัติแพ้ยา</label>
                                    <textarea class="form-control" name="his_allergy" id='his_allergy'
                                        rows="3" placeholder="โปรดระบุ (มี / ไม่มี) สามารถแก้ไขได้"></textarea>
                                </div>
                                <div class="form-group  col-sm-3">
                                    <label for="a1">ประวัติผู้ป่วย</label>
                                    <textarea class="form-control" name="his_patient" id='his_patient'
                                        rows="3"></textarea>
                                </div>
                                <div class="form-group  col-sm-3">
                                    <label for="a1">ตรวจร่างกาย </label>
                                    <textarea class="form-control" name="his_body" id='his_body' rows="3"></textarea>
                                </div>
                                <div class="form-group  col-sm-3">
                                    <label for="a3"> ผลตรวจทางห้องปฎิบัติการ/รังสี/อื่น ๆ</label>
                                    <textarea class="form-control" name="his_lab" id='his_lab' value=""
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group  col-sm-3">
                                    <label for="lpcr">การรักษาปัจจุบัน</label>
                                    <textarea class="form-control" name="his_takecare_now" id='his_takecare_now'
                                        rows="3"></textarea>
                                </div>
                                <div class="col-sm-3">
                                    <label for="lpcr">แผนการรักษา/ข้อมูลปลายทาง</label>
                                    <textarea class="form-control" name="exp_takecare_hosp_end"
                                        id='exp_takecare_hosp_end' rows="3"></textarea>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="oth">การวินิจฉัยโรค (ระบุเอง)</label>
                                    <textarea class="form-control" name="icd_free_text" id="icd_free_text"
                                        rows="3"></textarea>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="oth">เหตุผลอื่น Refer Out (ระบุเอง)</label>
                                    <textarea class="form-control" name="comment_takecare_hosp_end"
                                        id="comment_takecare_hosp_end" rows="3"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="oth">[1] การวินิจฉัย (ICD-10) </label>
                                    <input class="form-control" name="show_icd_101" type="text" id="show_icd_101" placeholder="(เลือกรายการ)"/>
                                    <input class="form-control" name="icd101" type="hidden" id="icd101" value="" />
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="oth">[2] การวินิจฉัย (ICD-10)</label>
                                    <input class="form-control" name="show_icd_102" type="text" id="show_icd_102" placeholder="(เลือกรายการ)"/>
                                    <input class="form-control" name="icd102" type="hidden" id="icd102" value="" />
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="oth">[3] การวินิจฉัย (ICD-10</label>
                                    <input class="form-control" name="show_icd_103" type="text" id="show_icd_103" placeholder="(เลือกรายการ)"/>
                                    <input class="form-control" name="icd103" type="hidden" id="icd103" value="" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="levcl">ชื่อแพทย์ผู้ส่งต่อ</label>
                                    <select class="form-control select2" name="hdoc" id="hdoc" required>
                                    <option value="" selected readonly>(เลือกรายการ)</option>
                                        <?php
                                            $objParse=oci_parse($objConnect,$SQLd);
                                            oci_execute($objParse,OCI_DEFAULT);
                                            while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                                            {
                                            ?>
                                        <option value="<?php echo $objResult["DOC_CODE"];?>">
                                            <?php echo '['.$objResult["DOC_CODE"].'] - '.$objResult['PRENAME'].''.$objResult['NAME'].' '.$objResult['SURNAME'];?>
                                        </option>
                                        <?php
                                            }
                                            ?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="levcl">ชื่อแพทย์เจ้าของไข้</label>
                                    <select class="form-control select2" name="fdoc" id="fdoc" required>
                                    <option value="" selected readonly>(เลือกรายการ)</option>
                                        <?php
                                            $objParse=oci_parse($objConnect,$SQLd);
                                            oci_execute($objParse,OCI_DEFAULT);
                                            while($objRs = oci_fetch_array($objParse,OCI_BOTH))
                                            {
                                            ?>
                                        <option value="<?php echo $objRs["DOC_CODE"];?>">
                                            <?php echo '['.$objRs["DOC_CODE"].'] - '.$objRs['PRENAME'].''.$objRs['NAME'].' '.$objRs['SURNAME'];?>
                                        </option>
                                        <?php
                                            }
                                            ?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="pcr">กลุ่มงานที่ส่งต่อ</label>
                                    <select class="form-control select2" name="tdep" id="tdep">
                                        <option value="" selected readonly>(เลือกรายการ)</option>
                                        <?php
                                            WHILE($row=mysqli_fetch_array($SQLpd))
                                            {
                                            ?>
                                        <option value="<?php echo $row['m_depid'];?>">
                                            <?php echo '['.$row['m_depid'].']'.' - '.$row['m_depname'];?>
                                        </option>
                                        <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <br>
                                <div class="form-group col-sm-6">
                                    <input type="hidden" name="action" value="refer">
                                    <input type="hidden" class="form-control" name="rfpatient" id="rfpatient">
                                    <input type="hidden" class="form-control" name="hosmain" id="hosmain">
                                    <input type="hidden" class="form-control" name="hossub" id="hossub">
                                    <input type="hidden" class="form-control" name="pttype" id="pttype">
                                    <input type="hidden" class="form-control" name="idcard" id="idcard">
                                    <input type="hidden" class="form-control" name="birthdate" id="birthdate">
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-success btn-grad" id="btn-save"
                                            style="font-size:1.2em;">
                                            <span class="glyphicon glyphicon-ok-circle"></span>
                                            ลงข้อมูล [REFER]
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
    <!-- <script src="s/jquery.min.js"></script> -->
    <script src="script.js"></script>
    <?php
    include('sys_hycall_footer.php'); ?>
    <!-- notify -->
    <script src="./assets/js/notify.js"></script>
    <script src="./assets/js/bootstrap-timepicker.min.js"></script>
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

    <script type="text/javascript">
    $(document).ready(function() {
        var places = $("#places").val();
        var age = $("#age").val();
        var bed = $("#bed").val();
        var rfpatient = $("#rfpatient").val();
        var idcard = $("#idcard").val();
        var birthdate = $("#birthdate").val();
        var hosmain = $("#hosmain").val();
        var hossub = $("#hossub").val();
        var shosname = $("#shosname").val();
        var mhosname = $("#mhosname").val();
        var hotleve = $("#hotlevel").val();
        var rfev = $("#rfev").val();
        var hoseid = $("#hoseid").val();

        // เพิ่ม
        var rid = $("#rid").val();
        var rsid = $("#rsid").val();
        var rsdi = $("#rsdi").val();
        // 
        var hosline = $("#hosline").val();
        var his_allergy = $("#his_allergy").val();
        var his_patient = $("#his_patient").val();
        // var stel = $("#stel").val();
        var his_body = $("#his_body").val();
        var his_lab = $("#his_lab").val();
        var his_takecare_now = $("#his_takecare_now").val();
        var exp_takecare_hosp_end = $("#exp_takecare_hosp_end").val();
        var icd_free_text = $("#icd_free_text").val();
        var comment_takecare_hosp_end = $("#comment_takecare_hosp_end").val();
        var icd10a = $("#icd101").val();
        var icd10b = $("#icd102").val();
        var icd10c = $("#icd103").val();
        var hdoc = $("#hdoc").val();
        var fdoc = $("#fdoc").val();
        var tdep = $("#tdep").val();
        var blood = $("#blood").val();
    });

    $("#places").on("change", function() {
        var placeid = $(this).val();
        if (placeid) {
            $.ajax({
                url: "action.php",
                type: "POST",
                cache: false,
                data: {
                    placeid: placeid
                },
                success: function(data) {
                    $("#fhn").html(data);
                }
            });
        }
    });

    // เพิ่มใหม่ 26092022
    // $("#rid").on("change", function() {
    //     var rfd = $(this).val();
    //     if (rfd) {
    //         $.ajax({
    //             url: "rf_indication_detail.php",
    //             type: "POST",
    //             cache: false,
    //             data: {
    //                 rfd: rfd
    //             },
    //             success: function(data) {
    //                 $("#rsid").html(data);
    //             }
    //         });
    //     }
    // });

    /*$("#rsid").on("change", function() {
        var rfdi = $(this).val();
        if (rfdi) {
            $.ajax({
                url: "rf_indication_sub_detail.php",
                type: "POST",
                cache: false,
                data: {
                    rfdi: rfdi
                },
                success: function(data) {
                    $("#rsdi").html(data);
                }
            });
        }
    });
    // สิ้นสุดที่เพิ่มใหม่
    */

    $("#fhn").on('change', function() {
        var fhn = this.value;
        var pl = $('#places').val();
        $.ajax({
            url: 'js_search_hn.php',
            type: "POST",
            dataType: "json",
            data: {
                fhn: fhn,
                pl: pl
            },
            cache: false,
            success: function(data) {
                var rfpatient = data[0].rfpatient;
                var dhn = data[0].dhn;
                var dan = data[0].dan;
                var sex = data[0].sex;
                var age = data[0].age;
                var bed = data[0].bed;
                var places = data[0].places;
                var nplaces = data[0].nplaces;
                var dateserv = data[0].dateserv;
                var ptname = data[0].ptname;
                var idcard = data[0].idcard;
                var saddress = data[0].saddress;
                var maddress = data[0].maddress;
                var pttype = data[0].pttype;
                var ptname = data[0].ptname;
                var birthdate = data[0].birthdate;
                var mtel = data[0].mtel;
                var hosmain = data[0].hosmain;
                var hossub = data[0].hossub;
                var mhosname = data[0].mhosname;
                var shosname = data[0].shosname;
                var hotlevel = data[0].hotlevel;
                var rfev = data[0].rfev;
                var hosid = data[0].hoseid;
                // เพิ่ม
                var rid = data[0].rid;
                var rsid = data[0].rsid;
                var rsdi = data[0].rsdi;
                // 
                var hosline = data[0].hosline;
                var his_allergy = data[0].his_allergy;
                var his_patient = data[0].his_patient;
                var his_body = data[0].his_body;
                var his_lab = data[0].his_lab;
                var his_takecare_now = data[0].his_takecare_now;
                var exp_takecare_hosp_end = data[0].exp_takecare_hosp_end;
                var icd_free_text = data[0].icd_free_text;
                var comment_takecare_hosp_end = data[0].comment_takecare_hosp_end;
                var icd10a = data[0].icd101;
                var icd10b = data[0].icd102;
                var icd10c = data[0].icd103;
                var hdoc = data[0].hdoc;
                var fdoc = data[0].fdoc;
                // var dep = data[0].tdep;
                var blood = data[0].blood;

                $('#dhn').val(data[0].dhn);
                $('#dan').val(data[0].dan);
                $('#rfpatient').val(data[0].rfpatient);
                $('#sex').val(data[0].sex);
                $('#age').val(data[0].age);
                $('#bed').val(data[0].bed);
                $("#dateserv").val(data[0].dateserv);
                $("#nplaces").val(data[0].nplaces);
                $('#ptname').val(data[0].ptname);
                $('#blood').val(data[0].blood);
                $('#mhosname').val(data[0].mhosname);
                $('#shosname').val(data[0].shosname);
                $("#maddress").val(data[0].maddress);
                $("#saddress").val(data[0].saddress);
                $("#birthdate").val(data[0].birthdate);
                $("#places").val(data[0].places);
                $("#idcard").val(data[0].idcard);
                $("#mtel").val(data[0].mtel);
                $("#pttype").val(data[0].pttype);
                $("#hosmain").val(data[0].hosmain);
                $("#hossub").val(data[0].hossub);
                $("#hoseid").val(data[0].hoseid);
            }
        });
    });

    $("#btn-save").on('click', function() {
        var ddate = $('#ddate').val();
        var rfpatient = $('#rfpatient').val();
        var dhn = $('#dhn').val();
        var dan = $('#dan').val();
        var sex = $("#sex").val();
        var age = $("#age").val();
        var bed = $("#bed").val();
        var birthdate = $("#birthdate").val();
        var dateserv = $("#dateserv").val();
        var places = $("#places").val();
        var nplaces = $("#nplaces").val();
        var idcard = $("#idcard").val();
        var maddress = $("#maddress").val();
        var mtel = $("#mtel").val();
        var saddress = $("#saddress").val();
        var pttype = $("#pttype").val();
        var hosmain = $("#hosmain").val();
        var hossub = $("#hossub").val();
        var hotlevel = $("#hotlevel").val();
        var rfev = $("#rfev").val();
        var hoseid = $("#hoseid").val();
        // เพิ่ม
        var rid = $("#rid").val();
        var rsid = $("#rsid").val();
        var rsdi = $("#rsdi").val();
        var hosline = $("#hosline").val();
        var show_hosp_line = $("#show_hosp_line").val();
        var his_allergy = $("#his_allergy").val();
        var his_patient = $("#his_patient").val();
        var stel = $("#stel").val();
        var his_body = $("#his_body").val();
        var his_lab = $("#his_lab").val();
        var his_takecare_now = $("#his_takecare_now").val();
        var exp_takecare_hosp_end = $("#exp_takecare_hosp_end").val();
        var icd_free_text = $("#icd_free_text").val();
        var comment_takecare_hosp_end = $("#comment_takecare_hosp_end").val();
        var icd101 = $("#icd101").val();
        var icd102 = $("#icd102").val();
        var icd103 = $("#icd103").val();
        var hdoc = $("#hdoc").val();
        var fdoc = $("#fdoc").val();
        var tdep = $("#tdep").val();
        var blood = $("#blood").val();

        if (places == '') {
            $('#places').notify("กรุณาระบุ OPD / IPD ผู้ป่วยรักษา (PMK)", "Error");
            return false;
        }

        if (dhn == '') {
            $('#fhn').notify("กรุณาระบุ HN หรือ ชื่อ ผู้ป่วยที่ต้องการ ก่อนทำการบันทึกข้อมูล", "Error");
            return false;
        }

        if (hoseid == '') {
            $('#hoseid').notify("กรุณาระบุ สถานพยาบาลปลายทาง", "Error");
            return false;
        }

        if (hotlevel == '') {
            $('#hotlevel').notify("กรุณาระบุ กรุณาเลือกระดับความรุนแรงของผู้ป่วย", "Error");
            return false;
        }
        if (rfev == '') {
            $('#rfev').notify("กรุณาระบุ สาเหตุการส่งต่อของผู้ป่วย", "Error");
            return false;
        }
        if (icd101 == '') {
            $('#show_icd_101').notify("กรุณาระบุ   [1] การวินิจฉัย (ICD-10)  ของผู้ป่วย", "Error");
            return false;
        }

        if (hdoc == '') {
            $('#show_doctor_hdoc').notify("กรุณาระบุ  ชื่อแพทย์ผู้ส่งต่อ", "Error");
            return false;
        }
        if (fdoc == '') {
            $('#fdoc').notify("กรุณาระบุ  ชื่อแพทย์เจ้าของไข้", "Error");
            return false;
        }
        if (tdep == '') {
            $('#tdep').notify("กรุณาระบุ   กลุ่มงานที่ส่งต่อ  ของผู้ป่วย", "Error");
            return false;
        }

        $.ajax({
            url: "insert_regis_referdb.php",
            type: "POST",
            data: {
                action: 'refer',
                ddate: ddate,
                dhn: dhn,
                dan: dan,
                rfpatient: rfpatient,
                sex: sex,
                age: age,
                bed: bed,
                birthdate: birthdate,
                dateserv: dateserv,
                places: places,
                nplaces: nplaces,
                idcard: idcard,
                maddress: maddress,
                mtel: mtel,
                saddress: saddress,
                pttype: pttype,
                hosmain: hosmain,
                hossub: hossub,
                hotlevel: hotlevel,
                rfev: rfev,
                hoseid: hoseid,
                rid: rid,
                rsid: rsid,
                rsdi: rsdi,
                stel: stel,

                hosline: hosline,
                his_allergy: his_allergy,
                his_patient: his_patient,
                his_body: his_body,
                his_lab: his_lab,
                his_takecare_now: his_takecare_now,
                exp_takecare_hosp_end: exp_takecare_hosp_end,
                icd_free_text: icd_free_text,
                comment_takecare_hosp_end: comment_takecare_hosp_end,
                icd101: icd101,
                icd102: icd102,
                icd103: icd103,
                hdoc: hdoc,
                fdoc: fdoc,
                tdep: tdep,
                hoseid: hoseid,
                blood: blood
            },
            cache: false,
            success: function(data) {
                console.log(data);
                // alert(data);
                if (data == '1') {
                    $('#places').val('');
                    $('#rfpatient').val('');
                    $('#fhn').val('');
                    $('#dhn').val('');
                    $('#dan').val('');
                    $('#sex').val('');
                    $('#age').val('');
                    $('#bed').val('');
                    $('#dateserv').val('');
                    $('#nplaces').val('');
                    $('#ptname').val('');
                    $('#blood').val('');
                    $('#mhosname').val('');
                    $('#maddress').val('');
                    $('#mtel').val('');
                    $('#shosname').val('');
                    $('#saddress').val('');
                    $('#hotlevel').val('');
                    $('#rfev').val('');
                    $("#rid").val('');
                    $("#rsid").val('');
                    $("#rsdi").val('');
                    $('#show_hosp_line').val('');
                    $('#his_allergy').val('');
                    $('#his_patient').val('');
                    $("#stel").val('');
                    $('#his_body').val('');
                    $('#his_lab').val('');
                    $('#his_takecare_now').val('');
                    $('#exp_takecare_hosp_end').val('');
                    $('#icd_free_text').val('');
                    $('#comment_takecare_hosp_end').val('');
                    $('#show_icd_101').val('');
                    $('#show_icd_102').val('');
                    $('#show_icd_103').val('');
                    $('#show_doctor_hdoc').val('');
                    $('#tdep').val('');
                    $('#hoseid').val('');

                    // ส่งเข้าไลน์
                    // line()
                    document.getElementById("fhn").focus();
                    swal(
                        'ผลการบันทึก..',
                        'บันทึกรายการให้เรียบร้อยแล้ว ..!',
                        'success'
                    );
                } else {
                    $('#places').val('');
                    $('#rfpatient').val('');
                    $('#fhn').val('');
                    $('#dhn').val('');
                    $('#dan').val('');
                    $('#sex').val('');
                    $('#age').val('');
                    $('#bed').val('');
                    $('#dateserv').val('');
                    $('#nplaces').val('');
                    $('#ptname').val('');
                    $('#blood').val('');
                    $('#mhosname').val('');
                    $('#maddress').val('');
                    $('#mtel').val('');
                    $('#shosname').val('');
                    $('#saddress').val('');
                    $('#hotlevel').val('');
                    $('#rfev').val('');
                    $("#rid").val('');
                    $("#rsid").val('');
                    $("#rsdi").val('');
                    $('#show_hosp_line').val('');
                    $('#his_allergy').val('');
                    $('#his_patient').val('');
                    $('#stel').val('');
                    $('#his_body').val('');
                    $('#his_lab').val('');
                    $('#his_takecare_now').val('');
                    $('#exp_takecare_hosp_end').val('');
                    $('#icd_free_text').val('');
                    $('#comment_takecare_hosp_end').val('');
                    $('#show_icd_101').val('');
                    $('#show_icd_102').val('');
                    $('#show_icd_103').val('');
                    $('#show_doctor_hdoc').val('');
                    $('#tdep').val('');
                    $('#hoseid').val('');
                    <?php echo $stel; exit() ?>
                    document.getElementById("fhn").focus();
                    swal(
                        'ผลการบันทึก..',
                        'บันทึกรายการให้เรียบร้อยแล้ว ..!',
                        'success'
                    );
                }
            }
        });
    });
    </script>

    <!-- รายการ icd10s -->
    <!-- รายการ icd10s รายการที่ 1-->
    <script type="text/javascript">
    function make_icd01(autoObj, showObj) {
        var mkAutoObj = autoObj;
        var mkSerValObj = showObj;
        new Autocomplete(mkAutoObj, function() {
            this.setValue = function(id) {
                document.getElementById(mkSerValObj).value = id;
            }
            if (this.isModified)
                this.setValue("");
            if (this.value.length < 1 && this.isNotClick)
                return;
            return "consult_icd_10s.php?q=" + encodeURIComponent(this.value);
        });
    }
    make_icd01("show_icd_101", "icd101");
    </script>

    <!-- รายการ icd10s รายการที่ 2-->
    <script type="text/javascript">
    function make_icd02(autoObj, showObj) {
        var mkAutoObj = autoObj;
        var mkSerValObj = showObj;
        new Autocomplete(mkAutoObj, function() {
            this.setValue = function(id) {
                document.getElementById(mkSerValObj).value = id;
            }
            if (this.isModified)
                this.setValue("");
            if (this.value.length < 1 && this.isNotClick)
                return;
            return "consult_icd_10s.php?q=" + encodeURIComponent(this.value);
        });
    }
    make_icd02("show_icd_102", "icd102");
    </script>

    <!-- รายการ icd10s รายการที่ 3-->
    <script type="text/javascript">
    function make_icd03(autoObj, showObj) {
        var mkAutoObj = autoObj;
        var mkSerValObj = showObj;
        new Autocomplete(mkAutoObj, function() {
            this.setValue = function(id) {
                document.getElementById(mkSerValObj).value = id;
            }
            if (this.isModified)
                this.setValue("");
            if (this.value.length < 1 && this.isNotClick)
                return;
            return "consult_icd_10s.php?q=" + encodeURIComponent(this.value);
        });
    }
    make_icd03("show_icd_103", "icd103");
    </script>
    <!-- สิ้นสุดรายการ ICD10s-->

    <!-- รายการ  Notify รายการที่ทำการบันทึกสำเร็จ-->
    <script type="text/javascript">
    function line() {

    }
    </script>
</body>
<?php 
// include('sys_hycall_footer.php');
 oci_close($objConnect);
?>

</html>