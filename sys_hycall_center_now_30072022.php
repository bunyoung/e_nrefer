<!doctype html>
<html class="no-js">

<head>
    <meta charset="UTF-8">
    <title>E-Refer</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.gif" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap-multiselect.min.css" />
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="../assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="../assets/css/jquery.gritter.min.css" />
    <link rel="stylesheet" href="../assets/css/colorbox.min.css" />

    <!-- bootstrap-table -->
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="../assets/css/bootstrap-table.css" />

    <!-- <link rel="stylesheet" href="../assets/css/ace.min.css" /> -->
    <link rel="stylesheet" href="../assets/css/select2.min.css" />

    <!-----  กำหนดขนาดของ font ทั้งหน้าเว็บ ----->
    <link rel="stylesheet" href="../assets/css/fullcalendar.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/style1.css" /> -->
    <link rel="stylesheet" href="../assets/css/bootstrap-select.css" />

    <link rel="stylesheet" href="../assets/css/bootstrap-table.css" />
    <!-- Bootstrap CDN JS Links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<style>
#headcolor {
    background-color: #511281;
}

#navcolor {
    background-color: #C449C2;
    color: #FFF5AB;
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
require_once('main_script.php');
require_once('db/date_format.php');
require_once("db/connection.php");
require_once('function/conv_date.php');
require_once('db/connect_pmk.php');
?>
<?php
    include("main_top_panel_head.php");
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
// d/m/y+543

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;

// วันที่ปัจจุบัน
$d_default=$date_curr_dmy_defult;

?>
<?php
// ข้อมูลแผนก จากระบบเอง
$SQLh = mysqli_query($conn,"SELECT hoscode5,hosname
            FROM rf_hospital
           ORDER BY hoscode5") OR die(mysqli_error());

$SQLe = mysqli_query($conn,"SELECT rfid,rfevent
            FROM rf_event
            WHERE rfstatus='N'
            ORDER BY rfevent") OR die(mysqli_error());

$SQLpd = mysqli_query($conn,"SELECT m_depid,m_depname
            FROM e_mdepart ORDER BY m_depname") OR die(mysqli_error());

$SQLf = mysqli_query($conn,"SELECT rfid,rffast
            FROM rf_fast 
            WHERE rfstatus='N' 
            ORDER BY rffast ") OR die(mysqli_error());
?>

<body>
    <!-- <br> -->
    <div class="containe-fluid" style="align:center;">
        <div class="panel-heading" style="background:#9D04CB;
                          color:#bbdefb;font-size: 1.2em;font-weight: bold;">
            <span class="glyphicon glyphicon-send"></span>
            ขอใช้บริการส่งคนไข้เพื่อการรรักษาต่อ (e-Refer)
        </div>
        <form action="insert_regis_referdb.php" method="POST" target="" name="formq" id="formq">
            <div class="panel-body" style="background:#F4ECF7; color:#151d1e;font-weight: bold;font-size: 1.1em;">
                <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                <div class="row">
                    <div class="form-group col-sm-2">
                        <label for="opd" class="label-control">
                            OPD / IPD ผู้ป่วยรักษา (PMK)
                        </label>
                        <select class="form-control select2" name="places" id="places">
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
                        <label for="hn">HN และ ชื่อ-สกุล ผู้ป่วย</label>
                        <select class="form-control select2" name="fhn" id="fhn">
                            <option value="">ชื่อ-สกุล</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="sex">HN</label>
                        <input type="text" class="form-control" name="dhn" id="dhn" readonly>
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="sex">เพศ</label>
                        <input type="text" class="form-control" name="sex" id="sex" readonly>
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="old">อายุ</label>
                        <input type="text"  class="form-control" name="age" id="age" readonly>
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="bed">OPD/Ward</label>
                        <input type="text"  class="form-control" name="nplaces" id="nplaces" readonly>
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="dateadmit">วันที่เข้ารักษา</label>
                        <input type="text"  class="form-control" name="dateserv" id="dateserv" readonly>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="ptype">สิทธิ์การรักษา</label>
                        <input type="text"  class="form-control" name="ptname" id="ptname" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="hosa">โรงพยาบาลหลัก</label>
                        <input type="text"  class="form-control" name="mhosname" id="mhosname" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="add1">ที่อยู่ตามสำเนาทะเบียนบ้าน</label>
                        <input type="text" class="form-control" name="maddress" id="maddress">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="add2">โทรศัพท์</label>
                        <input type="text" class="form-control" name="mtel" id="mtel">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="add3x">โรงพยาบาลรอง</label>
                        <input type="text" readonly class="form-control" name="shosname" id="shosname">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="add4">ที่อยู่ปัจจุบัน</label>
                        <input type="text" class="form-control" name="saddress" id="saddress">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="add5">โทรศัพท์</label>
                        <input type="text" class="form-control" name="stel" id="stel">
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body" style="background:#F5EEF8 ;opacity: 5;
                            color:#354649;font-weight: bold;font-size: 1.1em;">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="oth">สถานพยาบาลปลายทาง</label>
                                <input class="form-control" name="show_hosp_topic" type="text" id="show_hosp_topic" />
                                <input class="form-control" name="hoseid" type="hidden" id="hoseid" value="" />
                            </div>

                            <div class="form-group col-md-3">
                                <label for="pcr">ระดับความรุนแรงของผู้ปวย</label>
                                <select class="form-control select2" name="hotlevel" id="hotlevel">
                                    <option value=""></option>
                                    <?php
                                    WHILE($row=mysqli_fetch_array($SQLf))
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
                            <div class="form-group col-md-3">
                                <label for="pcr">สาเหตุที่ส่งต่อ</label>
                                <select class="form-control select2" name="rfev" id="rfev">
                                    <?php
                                WHILE($rw=mysqli_fetch_array($SQLe))
                                {
                                ?>
                                    <option value="<?php echo $rw['rfid'];?>">
                                        <?php echo '['.$rw['rfid'].']'.' - '.$rw['rfevent'];?>
                                    </option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="line">แจ้งข้อมูลสถานพยาบาลปลายทางผ่านทาง LINE</label>
                                <input class="form-control" name="show_hosp_line" type="text" id="show_hosp_line" />
                                <input class="form-control" name="hosline" type="hidden" id="hosline" value="" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="lpcr">แพ้ยา</label>
                                <textarea class="form-control" name="his_allergy" id='his_allergy' rows="3"></textarea>
                            </div>
                            <div class="form-group  col-sm-3">
                                <label for="a1">ประวัติผู้ป่วย</label>
                                <textarea class="form-control" name="his_patient" id='his_patient' rows="3"></textarea>
                            </div>
                            <div class="form-group  col-sm-3">
                                <label for="a1">ตรวจร่างกาย </label>
                                <textarea class="form-control" name="his_body" id='his_body' rows="3"></textarea>
                            </div>
                            <div class="form-group  col-sm-3">
                                <label for="a3"> ผลตรวจทางห้องปฎิบัติการ/อื่น ๆ</label>
                                <textarea class="form-control" name="his_lab" id='his_lab' value="" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-sm-3">
                                <label for="lpcr">การรักษาปัจจุบัน</label>
                                <textarea class="form-control" name="his_takecare_now" id='his_takecare_now'
                                    rows="3"></textarea>
                            </div>
                            <div class="col-sm-3">
                                <label for="lpcr">แผนการรักษาที่สถานพยาบาลปลายทาง</label>
                                <textarea class="form-control" name="exp_takecare_hosp_end" id='exp_takecare_hosp_end' rows="3"></textarea>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="oth">การวินิจฉัยโรค (ระบุเอง)</label>
                                <textarea class="form-control" name="icd_free_text" id="icd_free_text" rows="3"></textarea>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="oth">ข้อมูลเพิ่มเติมสำหรับ สถานพยาบาลปลายทาง</label>
                                <textarea class="form-control" name="comment_takecare_hosp_end" id="comment_takecare_hosp_end" rows="3"></textarea>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="oth">[1] การวินิจฉัย (ICD-10) </label>
                                <input class="form-control" name="show_icd_101" type="text" id="show_icd_101" />
                                <input class="form-control" name="icd101" type="hidden" id="icd101" value="" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="oth">[2] การวินิจฉัย (ICD-10)</label>
                                <input class="form-control" name="show_icd_102" type="text"  id="show_icd_102" />
                                <input class="form-control" name="icd102" type="hidden" id="icd102" value="" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="oth">[3] การวินิจฉัย (ICD-10</label>
                                <input class="form-control" name="show_icd_103" type="text"  id="show_icd_103" />
                                <input class="form-control" name="icd103" type="hidden" id="icd103" value="" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="levcl">ชื่อแพทย์ผู้ส่งต่อ</label>
                                <input class="form-control" name="show_doctor_hdoc" type="text" id="show_doctor_hdoc" />
                                <input class="form-control" name="hdoc" type="hidden" id="hdoc" value="" />
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="levcl">ชื่อแพทย์เจ้าของไข้</label>
                                <input class="form-control" name="show_doctor_fdoc" type="text" id="show_doctor_fdoc" />
                                <input class="form-control" name="fdoc" type="hidden" id="fdoc" value="" />
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="lpcr">ชื่อแพทย์หัวหน้ากุล่มงาน</label>
                                <input class="form-control" name="show_doctor_edoc" type="text" id="show_doctor_edoc" />
                                <input class="form-control" name="edoc" type="hidden" id="edoc" value="" />
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="pcr">กลุ่มงานที่ส่งต่อ</label>
                                <select class="form-control select2" name="tdep" id="tdep">
                                    <option value=""></option>
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
                            <div class="form-group col-sm-7">
                            <input type="hidden" class="form-control" name="hosmain" id="hosmain">
                            <input type="hidden" class="form-control" name="hossub" id="hossub">
                            <input type="hidden" class="form-control" name="pttype" id="pttype">
                                <input type="hidden" class="form-control" name="idcard" id="idcard">
                                <input type="hidden" class="form-control" name="birthdate" id="birthdate">
                                <input type="hidden" name="REFER" value="REFER">
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success btn-grad">
                                        <span class="glyphicon glyphicon-ok-circle"></span>
                                        ลงบันทึก [REFER]
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

<?php 
 oci_close($objConnect);
?>

</html>

<script src="assets/plugins/select2/select2.full.min.js"></script>
<script src="../assets/bootstrap-table/src/bootstrap-table.js"></script>
<!--- alert ----->
<script src="../assets/js/bootbox.js"></script>

<!-- nitiy -->
<script src="../assets/js/notify.js"></script>

<script src="../assets/js/bootstrap-timepicker.min.js"></script>
<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../assets/js/jquery.knob.min.js"></script>
<script src="../assets/js/autosize.min.js"></script>
<script src="../assets/bootstrap-table/src/bootstrap-table.js"></script>

<!--Auto refresh -->
<script type="text/javascript" src="../assets/js/bootstrap-table.min.js"></script>
<!-- <script type="text/javascript" src="../assets/js/bootstrap-table-auto-refresh.min.js"></script> -->


<!-- <script type="text/javascript" src="../assets/js/highcharts.js"></script> -->
<!-- <script type="text/javascript" src="../assets/js/series-label.js"></script> -->
<!-- <script type="text/javascript" src="../assets/js/exporting.js"></script> -->
<!-- <script type="text/javascript" src="../assets/js/export-data.js"></script> -->
<!-- <script type="text/javascript" src="../assets/js/accessibility.js"></script> -->

<script type="text/javascript">
$(function() {
    $(".select2").select2();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    var fhn = $('#fhn').val();
    var dhn = $('#dhn').val();
    var sex = $("#sex").val();
    var age = $("#age").val();
    var places = $("#places").val();
    var idcard = $("#idcard").val();
    var birthdate = $("#birthdate").val();
    var hosmain = $("#hosmain").val();
    var hossub = $("#hossub").val();
    var shosname = $("#shosname").val();
    var mhosname = $("#mhosname").val();
    // var nplaces = $("#nplaces").val();
    // var dateserv = $("#dateserv").val();
    // var ptname = $("#ptname").val();
    // var saddress = $("#saddress").val();
    // var maddress = $("#maddress").val();
    // var pttype = $("#pttype").val();
    // var ptname = $("#ptname").val();
    // var mtel = $("#mtel").val();
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
            var ddate = data[0].ddate;
            var fhn = data[0].fhn;
            var dhn = data[0].dhn;
            var sex = data[0].sex;
            var age = data[0].age;
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

            $('#ddate').val(data[0].ddate);
            $('#fhn').val(data[0].fhn);
            $('#dhn').val(data[0].dhn);
            $("#sex").val(data[0].sex);
            $("#age").val(data[0].age);
            $("#places").val(data[0].places);
            $("#nplaces").val(data[0].nplaces);
            $("#dateserv").val(data[0].dateserv);
            $("#ptname").val(data[0].ptname);
            $("#idcard").val(data[0].idcard);
            $("#saddress").val(data[0].saddress);
            $("#maddress").val(data[0].maddress);
            $("#pttype").val(data[0].pttype);
            $("#birthdate").val(data[0].birthdate);
            $("#mtel").val(data[0].mtel);
            $("#hosmain").val(data[0].hosmain);
            $("#hossub").val(data[0].hossub);
            $("#mhosname").val(data[0].mhosname);
            $("#shosname").val(data[0].shosname);
            // alert(hosmain);
            //     $('#txt-ddate').val('');
            //     $('#txt-places').val('');
            //     $('#txt-fhn').val('');
            //     $('#txt-dhn').val('');
            //     $('#txt-sex').val('');
            //     $('#txt-age').val('');
            //     $('#txt-nplaces').val('');
            //     $('#txt-dateserv').val('');
            //     $('#txt-ptname').val('');
            //     $('#txt-mhosname').val('');
            //     $('#txt-maddress').val('');
            //     $('#txt-mtel').val('');
            //     $('#txt-shosname').val('');
            //     $('#txt-saddress').val('');
            //     $('#txt-stel').val('');
            //     $('#txt-h_arti_id').val('');
            //     $('#txt-hotlevel').val('');
            //     $('#txt-rfev').val('');
            //     $('#txt-h_line_id').val('');
            //     $('#txt-his_patient').val('');
            //     $('#txt-his_body ').val('');
            //     $('#txt-his_lab').val('');
            //     $('#txt-his_takecare_now').val('');
            //     $('#txt-allergy').val('');
            //     $('#txt-ftext').val('');
            //     $('#txt-h_icda_id').val('');
            //     $('#txt-icd102').val('');
            //     $('#txt-h_icdc_id').val('');
            //     $('#txt-hdoc').val('');
            //     $('#txt-fdoc').val('');
            //     $('#txt-edoc').val('');
            //     $('#txt-tdep').val('');
            //     $('#txt-pt_type').val('');
            //     $('#txt-idcard').val('');
            //     document.getElementById("fhn").focus();
        }
    });
});

// $("#btn-save").on('click', function() {
//     var ddate = $('#txt-ddate').val();
//     var places = $('#txt-places').val();
//     var fhn = $('#txt-fhn').val();
//     var dhn = $('#txt-dhn').val();
//     var sex = $('#txt-sex').val();
//     var age = $('#txt-age').val();
//     var nplaces = $('#txt-nplaces').val();
//     var dateserv = $('#txt-dateserv').val();
//     var ptname = $('#txt-ptname').val();
//     var mhosname = $('#txt-mhosname').val();
//     var maddress = $('#txt-maddress').val();
//     var mtel = $('#txt-mtel').val();
//     var shosname = $('#txt-shosname').val();
//     var saddress = $('#txt-saddress').val();
//     var stel = $('#txt-stel').val();
//     var h_arti_id = $('#txt-h_arti_id').val();
//     var hotlevel = $('#txt-hotlevel').val();
//     var rfev = $('#txt-rfev').val();
//     var h_line_id = $('#txt-h_line_id').val();
//     var his_patient = $('#txt-his_patient').val();
//     var his_body = $('#txt-his_body ').val();
//     var his_lab = $('#txt-his_lab').val();
//     var his_takecare_now = $('#txt-his_takecare_now').val();
//     var allergy = $('#txt-allergy').val();
//     var ftext = $('#txt-ftext').val();
//     var h_icda_id = $('#txt-h_icda_id').val();
//     var icd102 = $('#txt-icd102').val();
//     var h_icdc_id = $('#txt-h_icdc_id').val();
//     var hdoc = $('#txt-hdoc').val();
//     var fdoc = $('#txt-fdoc').val();
//     var edoc = $('#txt-edoc').val();
//     var tdep = $('#txt-tdep').val();
//     var pt_type = $('#txt-pt_type').val();
//     var idcard = $('#txt-idcard').val();
//     // var birthdate = $('#txt-birthdate').val();
//     if (fhn == '') {
//         $('#fhn').notify("กรุณาระบุ HN หรือ ชื่อ ผู้ป่วยในการค้นหา", "Error");
//         return false;
//     }

//     // $.ajax({
//     //     url: "insert_regis_referdb.php",
//     //     type: "POST",
//     //     data: {
//     //         action: 'refer',
//     //         ddate: ddate,
//     //         places: places,
//     //         fhn: fhn,
//     //         dhn: dhn,
//     //         sex: sex,
//     //         age: age,
//     //         nplaces: nplaces,
//     //         dateserv: dateserv,
//     //         ptname: ptname,
//     //         mhosname: mhosname,
//     //         maddress: maddress,
//     //         mtel: mtel,
//     //         shosname: shosname,
//     //         saddress: saddress,
//     //         stel: stel,
//     //         h_arti_id: h_arti_id,
//     //         hotlevel: hotlevel,
//     //         rfev: rfev,
//     //         h_line_id: h_line_id,
//     //         his_patient: his_patient,
//     //         his_body: his_body,
//     //         his_lab: his_lab,
//     //         his_takecare_now: his_takecare_now,
//     //         allergy: allergy,
//     //         ftext: ftext,
//     //         h_icda_id: h_icda_id,
//     //         icd102: icd102,
//     //         h_icdc_id: h_icdc_id,
//     //         hdoc: hdoc,
//     //         fdoc: fdoc,
//     //         edoc: edoc,
//     //         tdep: tdep,
//     //         pt_type: pt_type
//     //         // birthdate: birthdate
//     //     },

//     //     success: function(data) {
//     //         console.log(data);
//     //         alert(data);
//     //         if (data == 1) {
//     //             $('#txt-ddate').val('');
//     //             $('#txt-places').val('');
//     //             $('#txt-fhn').val('');
//     //             $('#txt-dhn').val('');
//     //             $('#txt-sex').val('');
//     //             $('#txt-age').val('');
//     //             $('#txt-nplaces').val('');
//     //             $('#txt-dateserv').val('');
//     //             $("#txt-ptname").val('');
//     //             $("#txt-mhosname").val('');
//     //             $("#txt-maddress").val('');
//     //             $("#txt-mtel").val('');
//     //             $("#txt-shosname").val('');
//     //             $("#txt-saddress").val('');
//     //             $("#txt-stel").val('');
//     //             $("#txt-h_arti_id").val('');
//     //             $("#txt-hotlevel").val('');
//     //             $("#txt-rfev").val('');
//     //             $("#txt-h_line_id").val('');
//     //             $('#txt-his_patient').val('');
//     //             $('#txt-his_body').val('');
//     //             $('#txt-his_lab').val('');
//     //             $('#txt-his_takecare_now').val('');
//     //             $('#txt-allergy').val('');
//     //             $('#txt-ftext').val('');
//     //             $('#txt-h_icda_id').val('');
//     //             $('#txt-icd102').val('');
//     //             $('#txt-h_icdc_id').val('');
//     //             $('#txt-hdoc').val('');
//     //             $('#txt-fdoc').val('');
//     //             $('#txt-edoc').val('');
//     //             $('#txt-tdep').val('');
//     //             $('#txt-pt_type').val('');
//     //             $('#txt-idcard').val('');
//     //             $('#txt-ddate').val('');
//     //             $('#txt-fhn').val('');
//     //             $('#txt-dhn').val('');
//     //             $("#txt-sex").val('');
//     //             $("#txt-age").val('');
//     //             $("#txt-nplaces").val('');
//     //             $("#txt-dateserv").val('');
//     //             $("#txt-ptname").val('');
//     //             $("#txt-idcard").val('');
//     //             $("#txt-saddress").val('');
//     //             $("#txt-maddress").val('');
//     //             $("#txt-pttype").val('');
//     //             $("#txt-birthdate").val('');
//     //             $("#txt-mtel").val('');
//     //             notifyMe();
//     //             document.getElementById("fhn").focus();

//     //             swal(
//     //                 'ผลการบันทึก..',
//     //                 'บันทึกรายการให้เรียบร้อยแล้ว ..!',
//     //                 'success'
//     //             );
//     //         }
//     //         else {
//     //             notifyMe();
//     //             document.getElementById("fhn").focus();
//     //             swal(
//     //                 'ผลการบันทึก..',
//     //                 'บันทึกรายการไม่สำเร็จ ..!',
//     //                 'warning'
//     //             );
//     //         }
//     //     }
//     // });
// });
</script>

<!-- โรงพยาบาลปลายทาง -->
<script type="text/javascript">
function make_doctor(autoObj, showObj) {
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
        return "consult_hospital_th.php?q=" + encodeURIComponent(this.value);
    });
}
make_doctor("show_hosp_topic", "hoseid");
</script>
<!-- สิ้นสุด รพ ปลายทาง-->

<!-- โรงพยาบาลปลายทางไลน์ -->
<script type="text/javascript">
function make_doctor(autoObj, showObj) {
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
        return "consult_hospital_line.php?q=" + encodeURIComponent(this.value);
    });
}
make_doctor("show_hosp_line", "hosline");
</script>
<!-- สิ้นสุด รพ ปลายทางไลย์-->

<!--  ชื่อแพทย์ผู้ส่งต่อ-->
<script type="text/javascript">
function make_doctor(autoObj, showObj) {
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
        return "consult_detail_doctor.php?q=" + encodeURIComponent(this.value);
    });
}
make_doctor("show_doctor_hdoc", "hdoc");
</script>

<!-- ชื่อแพทย์เจ้าของไข้ -->
<script type="text/javascript">
function make_doctor(autoObj, showObj) {
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
        return "consult_detail_doctor.php?q=" + encodeURIComponent(this.value);
    });
}
make_doctor("show_doctor_fdoc", "fdoc");
</script>

<!-- ชื่อแพทย์หัวหน้ากุล่มงาน -->
<script type="text/javascript">
function make_doctor(autoObj, showObj) {
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
        return "consult_detail_doctor.php?q=" + encodeURIComponent(this.value);
    });
}
make_doctor("show_doctor_edoc", "edoc");
</script>
<!-- สิ้นสุดรายชื่อแพทย์-->

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
function notifyMe() {
    // เมื่อบราวเซอร์ไม่รองรับ    
    if (!Notification) {
        alert('Desktop notifications not available in your browser. Try Chromium.');
        return;
    }

    //ตรวจสอบและขออนุญาตให้แสดงการแจ้งเตือน    
    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    } else {
        // จัดรูปแบบรายการแจ้งเตือน  
        var notification = new Notification('หัวเรื่องแจ้งเตือน', {
            icon: 'http://www.ninenik.com/images/logo_01_Tue.gif',
            body: "มีการบันทึกรายการขอ Refer ใหม่",
        });
        // เมื่อคลิกที่การแจ้งเตือน สิ่งที่ต้องเพิ่มเติมรายการ
        // notification.onclick = function() {
        //     window.open("http://www.ninenik.com");  
        // };
    }
}
</script>