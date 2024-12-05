<!doctype html>
<html class="no-js">

<head>
    <meta charset="UTF-8">
    <title>E-Refer</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.gif" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap-multiselect.min.css" />

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
@media screen and (min-width: 768px) {
    .modal-dialog {
        width: 1024px;
        /* New width for default modal */
    }

    .modal-sm {
        width: 450px;
        /* New width for small modal */
        display: inline-block;

    }

    .modal-lg {
        width: 1200px;
        /* New width for large modal */
    }

    .centered {
        text-align: center;
        font-size: 0;
    }

    .centered>div {
        float: none;
        display: inline-block;
        text-align: left;
        font-size: 13px;
    }

}

/* กำหนด highlight */
tr.custom--success td {
    background-color: #3399ff !important;
    /*custom color here*/
}

tr.custom--success1 td {
    background-color: #3399ff !important;
    /*custom color here*/
}

/*กำหนด cursor ให้เป็นรูป pointer สำหรับ click table*/
.table-hover tbody tr:hover>td {
    cursor: pointer;
}

.finger img {
    cursor: pointer;
}

/* กำหนดให้ modal อยู่กลางจอ */
.modal-dialog {
    position: absolute;
    top: 20px;
    right: 100px;
    bottom: 0;
    left: 0;
    z-index: 10040;
    overflow: auto;
    overflow-y: auto;
}

th {
    background-color: #0099FF;
    color: white;
}

tr {
    line-height: 25px;
    min-height: 25px;
    height: 20px;
}
</style>

<?php
include('main_script.php');
require_once('db/date_format.php');
require_once("db/connection.php");
require_once('function/conv_date.php');
require_once('db/connect_pmk.php');
?>

<?php
// include('main_top_panel_sub_head.php');
include('main_top_panel_head.php');
?>
<?php
// ข้อมูลแผนก จากระบบเอง
$SQLplh = mysqli_query($conn,"SELECT m_depid,m_depname
            FROM e_mdepart ORDER BY m_depname") OR die(mysqli_error());
?>

<?php
$an=NULL;
if(isset($_GET['an']))
{
	$an = $_GET['an'];
}
?>

<body style="background:#bbdefb;">
    <div class="inner bg-light lter" style="margin-top: -25px;">
        <br>
        <div class="container" style="align:center" ;>
            <div class="panel-heading" style="background:#1976d2;
                         color:#bbdefb;font-size: 1.2em;font-weight: bold;">
                <span class="glyphicon glyphicon-send"></span>
                ขอใช้บริการส่งปรึกษาแพทย์ทางออนไลน์ (E-Refer)
            </div>
            <?php
            /*
             $strSQL2="SELECT I.AN,
				I.HN,
				I.BED_NO,
				I.PLA_PLACECODE,
				I.IPDPLACE,
				I.ATT_DOC,
				I.PT_TYPE_ID,
				I.AGE_YEAR,
				I.AGE_MONTH,
				I.AGE_DAY,
				I.FLNAME,
				I.DATEADMIT,
				PT.NAME,
				ATT_DOC,
				DECODE(VP.SEX, 'F', 'หญิง', 'M', 'ชาย') VSEX,
				P.HALFPLACE,
				PP.PIC_1
				FROM IPDTRANS I
				INNER JOIN PT_TYPES PT
				ON PT.TYPE_ID = I.PT_TYPE_ID
				INNER JOIN V_PATIENTS VP ON VP.HN = I.HN
				INNER JOIN PLACES P ON P.PLACECODE = I.IPDPLACE
				LEFT JOIN PATIENT_PICTURE PP ON (PP.PAT_RUN_HN||PP.PAT_YEAR_HN)=I.HN
				WHERE I.AN='$an'
				AND I.DATEDISCH IS NULL
				AND I.PLA_PLACECODE<>'TEST' ";
                */
            $strSQL2="SELECT I.AN,
            I.HN,
            I.BED_NO,
            I.PLA_PLACECODE,
            I.IPDPLACE,
            I.ATT_DOC,
            I.PT_TYPE_ID,
            I.AGE_YEAR,
            I.AGE_MONTH,
            I.AGE_DAY,
            I.FLNAME,
            TO_CHAR(I.DATEADMIT,'dd-mm-yyyy') AS dd,
            PT.NAME,
            ATT_DOC,
            DECODE(VP.SEX, 'F', 'หญิง', 'M', 'ชาย') VSEX,
            P.HALFPLACE,
            vp.PIC_1,
            VP.ID_CARD,
            REPLACE(i.HN,'/','')||REPLACE(i.AN,'/','')||VP.ID_CARD AS NIDX
            FROM (SELECT FLNAME,hn,an,BED_NO,PLA_PLACECODE,ATT_DOC,IPDPLACE,PT_TYPE_ID,AGE_YEAR,AGE_MONTH,AGE_DAY,DATEADMIT FROM IPDTRANS WHERE AN='$an' AND DATEDISCH IS NULL AND PLA_PLACECODE<>'TEST' ) I
            LEFT JOIN PT_TYPES PT ON PT.TYPE_ID = I.PT_TYPE_ID
            INNER JOIN (
            SELECT pc.* FROM
            ((SELECT p.*,PATIENT_PICTURE.PIC_1 FROM
            (SELECT ID_CARD,hn,run_hn,YEAR_HN,SEX,last_an FROM PATIENTS WHERE LAST_AN='$an') p
            LEFT JOIN PATIENT_PICTURE ON p.run_hn=PATIENT_PICTURE.PAT_RUN_HN AND p.year_hn=PATIENT_PICTURE.PAT_YEAR_HN) pc
            )) vp ON vp.last_an=i.an
            INNER JOIN PLACES P ON P.PLACECODE = I.IPDPLACE";
			$objParse2 = oci_parse($objConnect, $strSQL2);  
			oci_execute ($objParse2,OCI_DEFAULT);   
			while($objResult = oci_fetch_array($objParse2,OCI_BOTH)) 
			{ 
				$an     = $objResult["AN"]; 
				$hn     = $objResult["HN"]; 
				$n_flname = $objResult["FLNAME"];  
				$age    = $objResult["AGE_YEAR"].'-'.$objResult["AGE_MONTH"].'-'.$objResult["AGE_DAY"];  
				$beds   = $objResult["BED_NO"];
				$places = $objResult["IPDPLACE"];    
				$n_places = $objResult["IPDPLACE"].'-'.$objResult["HALFPLACE"];    
				$date_admit= $objResult["DATEADMIT"];
				$pt_type 	= $objResult["PT_TYPE_ID"];  
				$n_pt_type = $objResult["PT_TYPE_ID"].' - '.$objResult["NAME"];  
				$hdoc 	= $objResult["ATT_DOC"];  
				$sex 	= $objResult["VSEX"];                
            }    
			?>
            <div class="panel-body" style="background:#90caf9; color:#354649;font-weight: bold;font-size: 1.1em;">
                <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="hn">AN และ ชื่อ-สกุล ผู้ป่วย</label>
                        <input type="text" class="form-control autotab" name="an" id="an" value="<?php echo $an.'-'.$n_flname;?>">
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="sex">เพศ</label>
                        <input type="text" disabled class="form-control" name="sex" id="sex" value="<?php echo $sex;?>">
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="old">อายุ</label>
                        <input type="text" disabled class="form-control" name="age" id="age" value="<?php echo $age;?>">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="bed">WARD</label>
                        <input type="hidden" class="form-control" name="places" id="places">
                        <input type="text" disabled class="form-control" name="n_places" id="n_places"
                            value="<?php echo $n_places;?>">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="dateadmit">วันที่นอน รพ.</label>
                        <input type="text" disabled class="form-control" name="date_admit" id="date_admit" value="<?php echo $date_admit;?>">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-2">
                        <label for="hn">HN</label>
                        <input type="text" disabled class="form-control" name="hn" id="hn" value="<?php echo $hn;?>">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="flname">ชื่อ นามสกุล</label>
                        <input type="text" disabled class="form-control" name="n_flname" id="n_flname" value="<?php echo $n_flname;?>">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="ptype">สิทธิ์การรักษา</label>
                        <input type="hidden" class="form-control" name="pt_type" id="pt_type">
                        <input type="text" disabled class="form-control" name="n_pt_type" id="n_pt_type" value="<?php echo $n_pt_type;?>">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="bed">เตียง</label>
                        <input type="text" disabled class="form-control" name="beds" id="beds" value="<?php echo $beds;?>">
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body" style="background:#e3f2fd ;opacity: 5;
                        color:#354649;font-weight: bold;font-size: 1.1em;">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="pcr">กลุ่มงาน/งานที่ปรึกษา</label>
                            <select class="form-control select2" name="hdep" id="hdep">
                                <option value="" selected disabled>(เลือกรายการ)</option>
                                <?php
                                            WHILE($row1=mysqli_fetch_array($SQLplh))
                                            {
                                            ?>
                                <option value="<?php echo $row1['m_depid'];?>">
                                    <?php echo '['.$row1['m_depid'].']'.' - '.$row1['m_depname'];?>
                                </option>
                                <?php
                                            }
                                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="pcr">สาขา/หน่วยงาน</label>
                            <select class="form-control" name="sdep" id="sdep">
                                <option value=value="<?php echo $row["s_edepart"];?>"></option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="lpcr">ชื่อแพทย์(กรณีที่ได้รับการยืนยันจากแพทย์ที่ระบุเท่านั้น)</label>
                            <input class="form-control" name="h_arti_doctor" type="text" id="h_arti_doctor" />
                            <input class="form-control" name="mdoc" type="hidden" id="mdoc" value="" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="a1">(1)-ประวัติการตรวจร่างกาย</label>
                                    <textarea class="form-control" name="a1" id='a1' rows="3"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="a2">(2)-ผลการตรวจทางห้องปฎิบัติการและการตรวจการพิเศษ</label>
                                    <textarea class="form-control" name="a2" id='a2' value="" rows="3"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="a3">(3)-การรักษา</label>
                                    <textarea class="form-control" name="a3" id='a3' value="" rows="3"></textarea>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="levcl">ชื่อแพทย์ผู้ปรึกษา</label>
                                    <input class="form-control" name="h_arti_doca" type="text" id="h_arti_doca" />
                                    <input class="form-control" name="hdoc" type="hidden" id="hdoc" value="" />
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="levcl">ชื่ออาจารย์แพทย์ผู้รับผิดชอบให้คำปรึกษาครั้งนี้</label>
                                    <input class="form-control" name="h_arti_docb" type="text" id="h_arti_docb" />
                                    <input class="form-control" name="fdoc" type="hidden" id="fdoc" value="" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="pcr">จุดประสงค์ในการปรึกษาครั้งนี้</label>
                            <textarea class="form-control" name="textfield" id="exp" rows="3"></textarea>
                            <br>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="oth">การวินิจฉัยโรค(1,2,3)</label>
                                    <input class="form-control" name="show_arti_topic" type="text"
                                        id="show_arti_topic" />
                                    <input class="form-control" name="h_arti_id" type="hidden" id="h_arti_id"
                                        value="" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input class="form-control" name="show_arti_topic01" type="text"
                                        id="show_arti_topic01" />
                                    <input class="form-control" name="h_arti_id01" type="hidden" id="h_arti_id01"
                                        value="" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input class="form-control" name="show_arti_topic02" type="text"
                                        id="show_arti_topic02" />
                                    <input class="form-control" name="h_arti_id02" type="hidden" id="h_arti_id02"
                                        value="" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="oth">การวินิจฉัยโรค (Free text)</label>
                                    <textarea class="form-control" name="ftext" id="ftext" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-grad" id="btn-save">
                                    <span class="glyphicon glyphicon-ok-circle"></span>
                                    ลงบันทึกขอใช้บริการ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- พื้นที่สำหรับ Modal -->
<div id="modal_consult_view_update" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> แสดงรายการข้อมูลการ Consult</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="profile">
                <div class="profile-user-info profile-user-info-striped align-left">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <div class="profile-info-name"> CNS.NO </div>
                            <div class="profile-info-value">
                                <input type="hidden" class="form-control" id="mo-consid" readonly="true">
                                <input type="text" class="form-control" id="mo-cons_id" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <div class="profile-info-name"> AN </div>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-an" readonly="true">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="profile-info-name"> HN </div>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-hn" readonly="true">
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <div class="profile-info-name">เพศ </div>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-sex" readonly="true">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="profile-info-name"> อายุ </div>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-age" readonly="true">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="profile-info-name"> WARD </div>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-places" readonly="true">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="profile-info-name"> วันที่นอน รพ. </div>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-date_admit" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="profile-info-name"> ชื่อ-สกุล </div>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-flname" readonly="true">
                            </div>
                        </div>

                        <div class="form-group col-sm-4">
                            <div class="profile-info-name"> สิทธิการรักษา </div>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-pt_types" readonly="true">
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <div class="profile-info-name"> เตียง </div>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-beds" readonly="true">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="pcr">กลุ่มงาน/งานที่ปรึกษา</label>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-hdep" readonly="true">
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="pcr">สาขา/หน่วยงาน</label>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-sdep" readonly="true">
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="pcr">ชื่อแพทย์(กรณีที่ได้รับการยืนยัน) </label>
                            <div class="profile-info-value">
                                <input type="text" class="form-control" id="mo-hdoc" readonly="true">
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body" style="background:#e3f2fd ;opacity: 5;
                        color:#354649;font-weight: bold;font-size: 1.1em;">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="a1">(1)-ประวัติการตรวจร่างกาย</label>
                                            <textarea class="form-control" name="mo-a1" id='mo-a1' rows="3"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="a2">(2)-ผลการตรวจทางห้องปฎิบัติการและการตรวจการพิเศษ</label>
                                            <textarea class="form-control" name="mo-a2" id='mo-a2' value=""
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="a3">(3)-การรักษา</label>
                                            <textarea class="form-control" name="mo-a3" id='mo-a3' value=""
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="levcl">ชื่อแพทย์ผู้ปรึกษา</label>
                                            <div class="profile-info-value">
                                                <input type="text" class="form-control" id="mo-mdoc" readonly="true">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="levcl">ชื่ออาจารย์แพทย์ผู้รับผิดชอบให้คำปรึกษาครั้งนี้</label>
                                            <div class="profile-info-value">
                                                <input type="text" class="form-control" id="mo-fdoc" readonly="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="pcr">จุดประสงค์ในการปรึกษาครั้งนี้</label>
                                    <textarea class="form-control" name="mo-ftext" id="mo-ftext" rows="3">
                                    </textarea>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="oth">การวินิจฉัยโรค(1,2,3)</label>
                                            <input class="form-control" name="mo-icda" type="text" id="mo-icda" />
                                            <!-- <input class="form-control" name="h_arti_id" type="hidden" id="mo-icda"
                                                value="" /> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <input class="form-control" name="mo-icdb" type="text" id="mo-icdb" />
                                            <!-- <input class="form-control" name="h_arti_id01" type="hidden" id="mo-icdb"
                                                value="" /> -->
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <input class="form-control" name="mo-icdc" type="text" id="mo-icdc" />
                                            <!-- <input class="form-control" name="h_arti_id02" type="hidden" id="mo-icdc"
                                                value="" /> -->
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="oth">การวินิจฉัยโรค (Free text)</label>
                                            <textarea class="form-control" name="exp" id="mo-exp" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="btn-update" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

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
<script type="text/javascript" src="../assets/js/bootstrap-table-auto-refresh.min.js"></script>


<!-- <script type="text/javascript" src="../assets/js/highcharts.js"></script> -->
<script type="text/javascript" src="../assets/js/series-label.js"></script>
<script type="text/javascript" src="../assets/js/exporting.js"></script>
<script type="text/javascript" src="../assets/js/export-data.js"></script>
<script type="text/javascript" src="../assets/js/accessibility.js"></script>

<script type="text/javascript">
$(function() {
    $(".select2").select2();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    var ddate = $('#ddate').val();
    var fan = $('#fan').val();
    var sex = $('#sex').val();
    var age = $('#age').val();
    var places = $('#places').val();
    var n_places = $('#n_places').val();
    var date_admit = $('#date_admit').val();
    var hn = $('#hn').val();
    var n_flname = $('#n_flname').val();
    var pt_type = $('#pt_type').val();
    var n_pt_type = $('#n_pt_type').val();
    var beds = $('#beds').val();
    var hdep = $('#hdep').val();
    var sdep = $('#sdep').val();
    var h_arti_doctor = $('#h_arti_doctor').val();
    var mdoc = $('#mdoc').val();
    var a1 = $('#a1').val();
    var a2 = $('#a1').val();
    var a3 = $('#a1').val();
    var h_arti_doca = $('#h_arti_doca').val();
    var hdoc = $('#hdoc').val();
    var h_arti_docb = $('#h_arti_docb').val();
    var fdoc = $('#fdoc').val();
    var exp = $('#exp').val();
    var show_arti_topic = $('#show_arti_topic').val();
    var h_arti_id = $('#h_arti_id').val();
    var show_arti_topic01 = $('#show_arti_topic01').val();
    var h_arti_id01 = $('#h_arti_id01').val();
    var show_arti_topic02 = $('#show_arti_topic02').val();
    var h_arti_id02 = $('#h_arti_id02').val();
    var ftext = $('#ftext').val();
});

$('#consult_view_all_befor').on('click-row.bs.table', function(e, row, $element, data) {
    // console.log(row);
    $('#modal_consult_view_update').modal('show');

    var cons_id = row.cons_id;
    var an = row.an;
    var hn = row.hn;
    var pname = row.pname;
    var sex = row.sex;
    var age = row.age;
    var places = row.places;
    var beds = row.beds;
    var date_admit = row.date_admit;
    var pt_types = row.pt_types;
    var hdep = row.hdep;
    var sdep = row.sdep;
    var a1 = row.a1;
    var a2 = row.a2;
    var a3 = row.a3;
    var hdoc = row.hdoc;
    var exp = row.exp;
    var fdoc = row.fdoc;
    var icda = row.icda;
    var icdb = row.icdb;
    var icdc = row.icdc;
    var ftext = row.ftext;
    var mdoc = row.mdoc;
    var status = row.status;

    $('#mo-cons_id').val(cons_id);
    $('#mo-an').val(an);
    $('#mo-hn').val(hn);
    $('#mo-flname').val(pname);
    $('#mo-sex').val(sex);
    $('#mo-age').val(age);
    $('#mo-places').val(places);
    $('#mo-beds').val(beds);
    $('#mo-pt_types').val(pt_types);
    $('#mo-hdep').val(hdep);
    $('#mo-sdep').val(sdep);
    $('#mo-date_admit').val(date_admit);
    $('#mo-a1').val(a1);
    $('#mo-a2').val(a2);
    $('#mo-a3').val(a3);
    $('#mo-hdoc').val(hdoc);
    $('#mo-exp').val(exp);
    $('#mo-fdoc').val(fdoc);
    $('#mo-icda').val(icda);
    $('#mo-icdb').val(icdb);
    $('#mo-icdc').val(icdc);
    $('#mo-ftext').val(ftext);
    $('#mo-mdoc').val(mdoc);
    $('#mo-status').val(status);

});


$("#fan").on('change', function() {
    var an = this.value;
    $.ajax({
        url: 'js_search_hn.php',
        type: "POST",
        dataType: "json",
        data: {
            an: an
        },
        cache: false,
        success: function(data) {
            var ddate = data[0].ddate;
            var fan = data[0].fan;
            var sex = data[0].sex;
            var age = data[0].age;
            var places = data[0].places;
            var n_places = data[0].n_places;
            var date_admit = data[0].date_admit;
            var hn = data[0].hn;
            var n_flname = n_flname;
            var pt_type = data[0].pt_type;
            var n_pt_type = data[0].n_pt_type;
            var beds = data[0].beds;
            var hdep = data[0].hdep;
            var sdep = data[0].sdep;
            var h_arti_doctor = data[0].h_arti_doctor;
            var mdoc = data[0].mdoc;
            var a1 = data[0].a1;
            var a2 = data[0].a2;
            var a3 = data[0].a3;
            var h_arti_doca = data[0].h_arti_doca;
            var hdoc = data[0].hdoc
            var h_arti_docb = data[0].h_arti_docb;
            var fdoc = data[0].fdoc;
            var exp = data[0].exp;
            var show_arti_topic = data[0].show_arti_topic;
            var h_arti_id = data[0].h_arti_id;
            var show_arti_topic01 = data[0].show_arti_toic01;
            var h_arti_id01 = data[0].h_arti_id01;
            var show_arti_topic02 = data[0].show_arti_topic02;
            var h_arti_id02 = data[0].h_arto_id02;
            var ftext = data[0].ftext;

            $('#n_flname').val(data[0].n_flname);
            $('#an').val(data[0].an);
            $('#hn').val(data[0].hn);
            $('#age').val(data[0].age);
            $('#beds').val(data[0].beds);
            $('#places').val(data[0].places);
            $('#n_places').val(data[0].n_places);
            $('#date_admit').val(data[0].date_admit);
            $('#pt_type').val(data[0].pt_type);
            $('#n_pt_type').val(data[0].n_pt_type);
            $('#hdoc').val(data[0].hdoc);
            $('#sex').val(data[0].sex);
            $('#pt_type').val(data[0].pt_type);
            $('#n_pt_type').val(data[0].n_pt_type);
            $('#mdoc').val(data[0].mdoc);
            $('#fdoc').val(data[0].fdoc);
            $('#exp').val(data[0].exp);
            $('#h_arti_id').val(data[0].h_arti_id);
            $('#h_arti_id01').val(data[0].h_arti_id01);
            $('#h_arti_id02').val(data[0].h_arti_id02);
            $('#ftext').val(data[0].ftext);
            $('#a1').val(data[0].a1);
            $('#a2').val(data[0].a2);
            $('#a3').val(data[0].a3);
        }
    });
});

$("#btn-save").on('click', function() {
    var ddate = $('#ddate').val();
    var fan = $('#fan').val();
    var sex = $('#sex').val();
    var age = $('#age').val();
    var places = $('#places').val();
    var n_places = $('#n_places').val();
    var date_admit = $('#date_admit').val();
    var hn = $('#hn').val();
    var n_flname = $('#n_flname').val();
    var pt_type = $('#pt_type').val();
    var n_pt_type = $('#n_pt_type').val();
    var beds = $('#beds').val();
    var hdep = $('#hdep').val();
    var sdep = $('#sdep').val();
    var h_arti_doctor = $('#h_arti_doctor').val();
    var mdoc = $('#mdoc').val();
    var a1 = $('#a1').val();
    var a2 = $('#a2').val();
    var a3 = $('#a3').val();
    var h_arti_doca = $('#h_arti_doca').val();
    var hdoc = $('#hdoc').val();
    var h_arti_docb = $('#h_arti_docb').val();
    var fdoc = $('#fdoc').val();
    var exp = $('#exp').val();
    var show_arti_topic = $('#show_arti_topic').val();
    var h_arti_id = $('#h_arti_id').val();
    var show_arti_topic01 = $('#show_arti_topic').val();
    var h_arti_id01 = $('#h_arti_id01').val();
    var show_arti_topic02 = $('#show_arti_topic').val();
    var h_arti_id02 = $('#h_arti_id02').val();
    var ftext = $('#ftext').val();

    if (fan == '') {
        $('#fan').notify("กรุณาระบุ AN หรือ ชื่อ ผู้ป่วยในการค้นหา", "Error");
        return false;
    }
    if (hdep == '') {
        $('#hdep').notify("กรุณาระบุ กลุ่มงาน/งานที่ปรึกษา", "Error");
        return false;
    }
    if (sdep == '') {
        $('#sdep').notify("กรุณาระบุ สาขา/หน่วยงาน", "Error");
        return false;
    }
    if (a1 == '') {
        $('#a1').notify("กรุณาระบุ ประวัติการตรวจร่างกาย", "Error");
        return false;
    }
    if (a2 == '') {
        $('#a2').notify("กรุณาระบุ ผลการตรวจทางห้องปฎิบัติการและการตรวจการพิเศษ",
            "Error");
        return false;
    }
    if (a3 == '') {
        $('#a3').notify("การรักษา", "Error");
        return false;
    }
    if (hdoc == '') {
        $('#hdoc').notify("ชื่อแพทย์ผู้ปรึกษา", "Error");
        return false;
    }
    if (fdoc == '') {
        $('#fdoc').notify("ชื่อแพทชื่ออาจารย์แพทย์ผู้รับผิดชอบให้คำปรึกษาครั้งนี้",
            "Error");
        return false;
    }

    $.ajax({
        url: "insert_regis_consult.php",
        type: "POST",
        data: {
            action: 'consult',
            ddate: ddate,
            fan: fan,
            hn: hn,
            sex: sex,
            age: age,
            places: places,
            n_places: n_places,
            date_admit: date_admit,
            n_flname: n_flname,
            pt_type: pt_type,
            n_pt_type: pt_type,
            beds: beds,
            hdep: hdep,
            sdep: sdep,
            mdoc: mdoc,
            a1: a1,
            a2: a2,
            a3: a3,
            hdoc: hdoc,
            fdoc: fdoc,
            h_arti_id: h_arti_id,
            h_arti_id02: h_arti_id02,
            h_arti_id01: h_arti_id01,
            ftext: ftext

        },
        success: function(data) {
            console.log(data);
            if (data == 1) {
                $('#fdoc').val('');
                $('#h_arti_docb').val('');
                $('mdoc').val('');
                $('#h_arti_doca').val('');
                $('#h_arti_id').val('');
                $('#show_arti_topic').val('');
                $('#h_arti_id01').val('');
                $('#show_arti_topic01').val('');
                $('#h_arti_id02').val('');
                $('#show_arti_topic02').val('');
                $('#n_flname').val('');
                $('#ddate').val('');
                $('#fan').val('');
                $('#hn').val('');
                $('#sex').val('');
                $('#age').val('');
                $('#places').val('');
                $('#n_places').val('');
                $('#beds').val('');
                $('#date_admit').val('');
                $('#pt_type').val('');
                $('#n_pt_type').val('');
                $('#hdep').val('');
                $('#sdep').val('');
                $('#mdoc').val('');
                $('#a1').val('');
                $('#a2').val('');
                $('#a3').val('');
                $('#hdoc').val('');
                $('#exp').val('');
                $('#fdoc').val('');
                $('#h_arti_id').val('');
                $('#h_arti_id01').val('');
                $('#h_arti_id02').val('');
                $('#ftext').val('');
                $('#h_arti_doctor').val('');
                $('#consult_view_all_befor').bootstrapTable('refresh', {
                    url: "js_view_befor.php"
                });
                notifyMe();
                document.getElementById("fan").focus();

                swal(
                    'ผลการบันทึก..',
                    'บันทึกรายการให้เรียบร้อยแล้ว ..!',
                    'success'
                );
            }
        }
    });
});

$('#hdep').on('change', function() {
    var dept = this.value;
    $.ajax({
        type: "POST",
        url: 'action.php',
        data: 'dept=' + dept,
        success: function(result) {
            $("#sdep").html(result);
        }
    });
});
</script>

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
make_doctor("h_arti_doctor", "mdoc");
</script>

<!-- แพทย์ที่ปรึกษา -->
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
        return "consult_detail_doctora.php?q=" + encodeURIComponent(this.value);
    });
}
make_doctor("h_arti_doca", "hdoc");
</script>

<!-- อจ แพทย์ผู้รับผิดชอบให้คำปรึกษา -->
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
        return "consult_detail_doctorb.php?q=" + encodeURIComponent(this.value);
    });
}
make_doctor("h_arti_docb", "fdoc");
</script>

<script type="text/javascript">
function make_autocom(autoObj, showObj) {
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
make_autocom("show_arti_topic", "h_arti_id");
</script>


<script type="text/javascript">
function make_autocom01(autoObj, showObj) {
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
make_autocom01("show_arti_topic01", "h_arti_id01");
</script>

<script type="text/javascript">
function make_autocom02(autoObj, showObj) {
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
make_autocom02("show_arti_topic02", "h_arti_id02");
</script>

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
            body: "มีการบันทึกรายการขอ Consult ใหม่",
        });
        // เมื่อคลิกที่การแจ้งเตือน สิ่งที่ต้องเพิ่มเติมรายการ
        // notification.onclick = function() {
        //     window.open("http://www.ninenik.com");  
        // };
    }
}
</script>