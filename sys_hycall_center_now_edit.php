<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>E-Refer</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/sweetalert.min.css" />
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/bootstrap-table/dist/bootstrap-table.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"> </script>
    <style>
    textarea {
        overflow: scroll;
        height: 100px;
        resize: none;
    }
    input:focus {
        background-color: #FFF9C4;
        border: 0;
        padding: 10px;
        color: #212121;
        border: solid 1px #ccc;
        box-shadow: inner 0 0 4px rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    textarea {
        width: 300px;
        height: 100px;
        font-size: 1em;
        border: 1px solid #F57F17;
    }

    textarea:focus {
        background-color: #FFF9C4;
    }
    </style>
</head>

<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];
?>
<?php 
include('./db/connection.php');
include('./db/connect_pmk.php');
include('./db/date_format.php');
include('main_script.php'); 

#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult='01/' ;
$date_start_m_defult='01/';
$date_start_y_defult=date('Y')+543 ;
$date_start_dmy_defult	= $date_start_d_defult.$date_start_m_defult.$date_start_y_defult;

$date_end_dm_defult=date('d/m/') ;
$date_end_y_defult=date('Y')+543 ;
$date_end_dmy_defult=$date_end_dm_defult.$date_end_y_defult;

// $dd_dd = DATE_diff(curdate(),90);
// echo $dd_dd; 
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y');
$date_curr_dmy_defult=($date_curr_dm_defult.$date_curr_y_defult);
$d_default=$date_curr_dmy_defult;
?>

<?php
# ฐานข้อมูล Mysql
$SQLe = mysqli_query($conn,"SELECT rfid,rftype,rfevent
            FROM v_rf_event
            WHERE rfstatus='N'
            ORDER BY rfid");

$SQLpd = mysqli_query($conn,"SELECT m_depid,m_depname
            FROM v_rf_mdepart WHERE m_status ='0' ORDER BY m_depname") ;

$SQLf = mysqli_query($conn,"SELECT rfid,rffast
            FROM v_rf_fast 
            WHERE rfstatus='N' 
            ORDER BY rfid ");

$SQLh = mysqli_query($conn,"SELECT hcode,hosname
               FROM v_view_users 
               WHERE hcode <> '$hcode'  AND hosname NOT LIKE('%สำนักงาน%')
               ORDER BY hcode");
               
// $SQLm = mysqli_query($conn,"SELECT hcode,hosname
// FROM v_view_users 
// WHERE hosname NOT LIKE('%สำนักงาน%')
// ORDER BY hcode");

$SQLt = mysqli_query($conn,"SELECT * FROM rf_pttype 
               WHERE del_flag ='N' 
               ORDER BY type_id");

$SQLif = mysqli_query($conn,"SELECT * FROM rf_indication 
                 WHERE status ='Y'  ORDER BY departname ASC"); 

# ดึงจาก His ของ รพ         
# 10682 สำหรับ ฐานข้อมูล Oracle โปรแกรม PMK
    $SQLd="
        SELECT DOC_CODE,NAME,PRENAME,SURNAME
            FROM doc_dbfs
        WHERE(DOC_CODE like '$q%' OR NAME like '$q%' OR PRENAME like '$q%') AND
		PRENAME IN ('ทพ','ทพ.','ทต','ทต.','พญ.','พญ','ดร.พญ.','นพ','นพ.','น.พ.','รศ.พิเศษ ดร. นพ.') AND 
            DOC_CODE <>'ADMIN' AND 
            DEL_FLAG IS NULL";

    $strSQL2 = "
            SELECT PLACECODE AS PLACECODE,HALFPLACE AS HALFPLACE FROM PLACES WHERE PT_PLACE_TYPE_CODE  IN ('1','2') 
            AND DEL_FLAG IS NULL
            ORDER BY PLACECODE ASC"; 
?>

<body style="font-family:'K2D';font-size:18px;font-weight:600;">
    <?php 
        include('main_top_panel_head.php');
        include('main_top_menu_session.php');
        include('main_top_menu_smenu.php');       
        ?>
    <?php       
        $ttpaid='0.00';
        $srid = $_REQUEST['id'];

        // ส่วนการแก้ไข
        $sql = "SELECT * FROM v_rf_detail WHERE rf_id='$srid' ";
                $result_sql = mysqli_query($conn,$sql);
        $rs=mysqli_fetch_array ($result_sql);
        $rfno=$rs['rf_no_refer'];
        $pan=$rs['rf_an'];
        $phn=$rs['rf_hn'];
        $rserv=$rs['rf_serv'];

        if($rs['rf_an'] <> '') {
            $sqlp = "SELECT m_total as ttp  from ipdtrans 
                           WHERE AN='$pan' ";
        }else{
            $sqlp = "SELECT  sum(m_total_sell) as ttp from opd_finance_headers 
                           WHERE PAT_RUN_HN=SUBSTR('$phn',1,LENGTH(trim('$phn'))-3) AND
								         PAT_YEAR_HN=SUBSTR('$phn',LENGTH(trim('$phn'))-1,2) AND 
                                         TO_CHAR(DATETIME,'dd-mm-yyyy')= '$rserv' ";
        }
        $objParse=oci_parse($objConnect,$sqlp);
        oci_execute($objParse,OCI_DEFAULT);
        while($prs = oci_fetch_array($objParse,OCI_BOTH))      {
            $ttpaid = $prs['TTP'];
        }
        oci_close($objConnect);
    ?>
    <div class="outer bg-gray lter ">
        <form action="insert_regis_refer_edit.php" method="POST" target="">
            <input type="hidden" name='rfno' id='rfno' value=<?=$rfno;?>>
            <div class="panel-heading" style="background-color:#FF1744;color:#fff;font-size: 18px;">
                <span class="glyphicon glyphicon-send"></span>
                แก้ไขการใช้บริการส่งคนไข้เพื่อการรรักษาต่อ (e-Refer)
                <?php echo $rs['rf_no_refer']; ?>
            </div>
            <div class="panel-body" style="background-color:#FFEBEE; color:#24135F;font-size: 16px;">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="opd" class="label-control">
                            OPD / IPD ผู้ป่วยรักษา (ระบบโรงพยาบาล)
                        </label>
                        <input class="form-control" type="text" name="pcode" id="pcode"
                            value="<?php echo $rs['rf_placecode'].'-'.$rs['rf_placename'];?>">
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="hn">ชื่อ-สกุล ผู้ป่วย</label>
                        <input type="text" class="form-control" name="fhn" id="fhn"
                            value="<?php echo $rs['rf_patients'];?>" readonly>
                    </div>

                    <div class="form-group col-sm-2">
                        <label for="sex">HN</label>
                        <input type="text" class="form-control" name="dhn" id="dhn" value="<?php echo $rs['rf_hn'];?>"
                            readonly>
                    </div>

                    <div class="form-group col-sm-2">
                        <label for="sex">AN</label>
                        <input type="text" class="form-control" name="dan" id="dan" value="<?php echo $rs['rf_an'];?>"
                            readonly>
                    </div>

                    <div class="form-group col-sm-2">
                        <label for="dateadmit">วันที่เข้ารักษา</label>
                        <input type="text" class="form-control" name="dateserv" id="dateserv"
                            value="<?php echo $rs['rf_serv'];?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="bed">OPD/Ward</label>
                        <input type="text" class="form-control" name="nplaces" id="nplaces"
                            value="<?php echo $rs['rf_placename'];?>" readonly>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="ptype">สิทธิ์การรักษา</label>
                        <select class="form-control select2" name="pttye" id="pttye">
                            <option value="" selected readonly>
                                <?php echo '['.$rs['rf_pttype'].']'.'  '.$rs['pttypename'];?></option>
                            <?php 
                                while($rst=mysqli_fetch_array($SQLt)) 
                                { 
                                ?>
                            <option value="<?=$rst["type_id"];?>">
                                <?=$rst["type_id"]." - ".$rst["name"];?>
                            </option>
                            <?php
                                }                                                                  
                                ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="dateadmit">กรุ๊ปเลือด</label>
                        <input type="text" class="form-control" name="blood" id="blood"
                            value="<?php echo $rs['rf_blood'];?>" readonly>
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="sex">เพศ</label>
                        <input type="text" class="form-control" name="sex" id="sex" value="<?php echo $rs['rf_sex'];?>"
                            readonly>
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="old">อายุ</label>
                        <input type="text" class="form-control" name="age" id="age" value="<?php echo $rs['rf_age'];?>"
                            readonly>
                    </div>
                    <div class="form-group col-sm-1">
                        <label for="old">เตียง</label>
                        <input type="text" class="form-control" name="bed" id="bed"
                            value="<?php echo $rs['rf_bedno'];?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="hosa">สถานพยาบาลหลัก</label>
                        <input type="text" class="form-control" name="mhosname" id="mhosname"
                            value="<?php echo $rs['hosmain'];?>" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="add1">ที่อยู่ในระบบงาน HIS</label>
                        <input type="text" class="form-control" name="maddress" id="maddress"
                            value="<?php echo $rs['rf_maddress'];?>">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="add2">Email Address</label>
                        <input type="text" class="form-control" name="mtel" id="mtel"
                            value="<?php echo $rs['rf_mtel'];?>" placeholder="กรุณากรอก Email Address">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="add3">สถานพยาบาลรอง</label>
                        <input type="text" readonly class="form-control" name="shosname" id="shosname"
                            value="<?php echo $rs['hossub'];?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="add4">ที่อยู่ปัจจุบัน</label>
                        <input type="text" class="form-control" name="saddress" id="saddress"
                            value="<?php echo $rs['rf_saddress'];?>" placeholder="กรุณากรอกที่อยู่ที่สามารถติดต่อได้">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="add5">โทรศัพท์</label>
                        <input type="text" class="form-control" name="stel" id="stel"
                            value="<?php echo $rs['rf_stel'];?>" placeholder="กรุณากรอกเบอร์โทรที่สามารถติดต่อได้">
                    </div>
                </div>
                <div class="panel panel-warning">
                    <div class="panel-body" style="background:#FFCDD2; opacity: 1; color:#24135F;">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="oth">สถานพยาบาลปลายทาง</label>
                                <select class="form-control select2" name="hoseid" id="hoseid">
                                    <option value="<?=$rs['rf_hos_send_to'];?>" selected readonly>
                                        <?php echo '['.$rs['rf_hos_send_to'].']'.' - '.$rs['hossendto_name'];?>
                                    </option>
                                    <?php
                                        while($row=mysqli_fetch_array($SQLh))
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
                                    <option value="<?php echo $rs['rf_hotlevel'];?>" selected readonly>
                                        <?php echo $rs['rffast'];?></option>
                                    <?php
                                    while($row=mysqli_fetch_array($SQLf))
                                    {
                                    ?>
                                    <option value="<?php echo $row['rfid'];?>">
                                        <?php echo $row['rffast'];?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pcr">ประเภทส่งต่อ (หน่ายงานต้นทาง)</label>
                                <select class="form-control select2" name="rfev" id="rfev">
                                    <option value="<?php echo $rs['rf_rfev'];?>" selected readonly>
                                        <?php echo $rs['rfevent'];?>
                                    </option>
                                    <?php
                                            while($rw=mysqli_fetch_array($SQLe))
                                            {
                                            ?>
                                    <option value="<?php echo $rw['rfid'];?>">
                                        <?php echo $rw['rfevent'];?>
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
                                    <option value="<?= $rs['rf_indication'];?>" selected readonly>
                                        <?php echo $rs['departname'];?>
                                    </option>
                                    <?php 
                                        $sqlif = "SELECT * FROM rf_indication WHERE status ='Y'  ORDER BY departname ASC"; 
                                        $rf_i=mysqli_query($conn,$sqlif)  ;                                       
                                        while($rfi = mysqli_fetch_array($rf_i)) 
                                        { 
                                        ?>
                                    <option value="<?php echo $rfi['id']; ?>">
                                        <?php echo $rfi['departname'];?>
                                    </option>
                                    <?php
                                        }                                                                  
                                        ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="oth">Refer Out (สาขา/โรค/อวัยวะ)</label>
                                <select class="form-control select2" name="rsid" id="rsid">
                                    <option value="<?= $rs['rf_mindication'];?>" selected readonly>
                                        <?php echo $rs['indication'];?>
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="oth">Refer Out (โรค/ภาวะ)</label>
                                <select class="form-control select2" name="rsdi" id="rsdi">
                                    <option value="<?= $rs['rf_sindication'];?>" selected readonly>
                                        <?php echo $rs['sindication_name'];?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- สิ้นสุดที่เพิ่มใหม่ -->
                        <!-- เพิ่มใหม่เรื่องการวัดอุณภูมิ -->
                        <!-- <div class="panel panel-warning"> -->
                        <div class="panel-body" style="background:#EF9A9A; color:#FFEBEE;">
                            <div class="row">
                                <div class="form-group col-sm-1">
                                    <label for="newa">BT ('C)</label>
                                    <input type="number" class="form-control col-sm-1" name="bt" id="bt"
                                        value="<?php echo $rs['bb'];?>">
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="oth">SBP (mmHg) </label>
                                    <input type="text" class="form-control col-sm-1" name="bpa" id="bpa"
                                        value="<?php echo $rs['bpa'];?>">
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="oth"> DBP (mmHg) </label>
                                    <input type="text" class="form-control col-sm-1" name="bpb" id="bpb"
                                        value="<?php echo $rs['bpb'];?>">
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="oth">HR (per min)</label>
                                    <input type="text" class="form-control col-sm-1" name="pr" id="pr"
                                        value="<?php echo $rs['pr'];?>">
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="oth">RR (per min)</label>
                                    <input type="text" class="form-control col-sm-1" name="rr" id="rr"
                                        value="<?php echo $rs['rr'];?>">
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="oth">O2 sat (%)</label>
                                    <input type="text" class="form-control col-sm-1" name="o2" id="o2"
                                        value="<?php echo $rs['o2'];?>">
                                </div>

                                <div class="form-group col-sm-1">
                                    <label for="bw">BW (kg)</label>
                                    <input type="text" class="form-control col-sm-1" name="bw" id="bw"
                                        value="<?php echo $rs['weight_value'];?>">
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="bh">BH (cm)</label>
                                    <input type="text" class="form-control col-sm-1" name="bh" id="bh"
                                        value="<?php echo $rs['head_value'];?>">
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="hc">HC (cm)</label>
                                    <input type="text" class="form-control col-sm-1" name="hc" id="hc"
                                        value="<?php echo $rs['height_value'];?>">
                                </div>

                                <div class="form-group col-sm-1">
                                    <label for="oth">Pain S (0-10)</label>
                                    <input type="number" class="form-control col-sm-1" name="pain" id="pain" min="0"
                                        max="10" value="<?php echo $rs['pain'];?>">
                                </div>
                            </div>
                        </div>
                        <!-- สิ้นสุดที่เพิ่มใหม่ -->
                        <br>
                        <div class="row" style="padding:2px 4px 4px;">
                            <div class="form-group col-sm-6" style="background-color:#CE0056;color:white;">
                                <div class="card">
                                    <label for="lpcr">ประวัติแพ้ยา (วันบันทึก);ยาที่แพ้ (อาการแพ้)</label>
                                    <div class="panel panel-default" style="color:black;">
                                        <textarea name="detail" rows="4" class="form-control" name="allergy"
                                            id="allergy"><?=$rs['rf_allergy'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="oth">เหตุผลอื่น Refer Out (ระบุเอง)</label>
                                <textarea class="form-control" name="comment_takecare_hosp_end"
                                    id="comment_takecare_hosp_end" rows="4"> <?=$rs['rf_comment_takecare_hosp_end'];?>
                                </textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group  col-sm-6">
                                <label for="">ประวัติผู้ป่วย</label>
                                <textarea class="form-control" name="his_patient" id='his_patient' value='' rows="4"><?=$rs['rf_his_patient'];?>
                                    </textarea>
                            </div>
                            <div class="form-group  col-sm-6">
                                <label for="a1">ตรวจร่างกาย </label>
                                <textarea class="form-control" name="his_body" id='his_body' rows="4"> <?=$rs['rf_his_body'];?>
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group  col-sm-6">
                                <label for="a3"> ผลตรวจทางห้องปฎิบัติการ/รังสี/อื่น ๆ</label>
                                <textarea class="form-control" name="his_lab" id='his_lab' value=""
                                    rows="4"><?=$rs['rf_his_lab'];?></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="oth">การวินิจฉัยโรค (ระบุเอง)/ICD10 ใน PMK</label>
                                <textarea class="form-control" name="icd_free_text" id="icd_free_text"
                                    rows="4"><?=$rs['rf_icd_free_text'];?> </textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group  col-sm-6">
                                <label for="lpcr">การรักษาปัจจุบัน</label>
                                <textarea class="form-control" name="his_takecare_now" id='his_takecare_now'
                                    rows="4"><?=trim($rs['rf_his_takecare_now']);?></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="lpcr">แผนการรักษา/ข้อมูลปลายทาง</label>
                                <textarea class="form-control" name="exp_takecare_hosp_end" id='exp_takecare_hosp_end'
                                    rows="4"><?=$rs['rf_exp_takecare_hosp_end'];?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group  col-sm-6">
                                <label for="lpcr">ผลการผ่าตัด</label>
                                <textarea class="form-control" name="his_oper" id='his_oper'
                                    rows="4"><?=trim($rs['rf_oper']);?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="oth">[1] การวินิจฉัย (ICD-10) โรคหลัก </label>
                                <input class="form-control" name="show_icd_101" type="text" id="show_icd_101"
                                    value="<?php echo  $rs['descicda'];?>" placeholder="(เลือกรายการ)" />
                                <input class="form-control" name="icd101" type="hidden" id="icd101"
                                    value="<?= $rs['rf_icd10a'];?>" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="oth">[2] การวินิจฉัย (ICD-10)</label>
                                <input class="form-control" name="show_icd_102" type="text" id="show_icd_102"
                                    value="<?php echo $rs['descicdb'];?>" placeholder="(เลือกรายการ)" />
                                <input class="form-control" name="icd102" type="hidden" id="icd102"
                                    value="<?= $rs['rf_icd10b'];?>" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="oth">[3] การวินิจฉัย (ICD-10)</label>
                                <input class="form-control" name="show_icd_103" type="text" id="show_icd_103"
                                    value="<?php echo $rs['descicdc'];?>" placeholder="(เลือกรายการ)" />
                                <input class="form-control" name="icd103" type="hidden" id="icd103"
                                    value="<?= $rs['rf_icd10c'];?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="levcl">ชื่อแพทย์ผู้ส่งต่อ</label>
                                <select class="form-control select2" name="hdoc" id="hdoc">
                                    <option value="<?=$rs['rf_doc_send'];?>" selected readonly>
                                        <?php echo $rs['docsend_prename'].$rs['docsend_name'].' '.$rs['docsend_surname'];?>
                                    </option>
                                    <?php
                                    #กรณีที่เป็น PMK
                                    if($hcode=='10682'){
                                        $objParse=oci_parse($objConnect,$SQLd);
                                        oci_execute($objParse,OCI_DEFAULT);
                                        while($objResult = oci_fetch_array($objParse,OCI_BOTH)){
                                        ?>
                                    <option value="<?php echo $objResult["DOC_CODE"];?>">
                                        <?php echo '['.$objResult["DOC_CODE"].'] - '.$objResult['PRENAME'].''.$objResult['NAME'].' '.$objResult['SURNAME'];?>
                                    </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label for="levcl">ชื่อแพทย์เจ้าของไข้</label>
                                <select class="form-control select2" name="fdoc" id="fdoc" required>
                                    <option value="<?=$rs['rf_doc_me'];?>" selected readonly>
                                        <?php echo $rs['docme_prename'].$rs['docme_name'].' '.$rs['docme_surname'];?>
                                    </option>
                                    <?php
                                                #กรณีที่ใช้ PMK
                                                   $objParse=oci_parse($objConnect,$SQLd);
                                                    oci_execute($objParse,OCI_DEFAULT);
                                                    while($objRs = oci_fetch_array($objParse,OCI_BOTH)){
                                                    ?>
                                    <option value="<?php echo $objRs["DOC_CODE"];?>">
                                        <?php echo '['.$objRs["DOC_CODE"].'] - '.$objRs['PRENAME'].''.$objRs['NAME'].' '.$objRs['SURNAME'];?>
                                    </option>
                                    <?php
                                                    }
                                                ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="pcr">กลุ่มงานที่ส่งต่อ</label>
                                <select class="form-control select2" name="tdep" id="tdep">
                                    <option value="<?=$rs['m_depid'];?>" selected readonly>
                                        <?php echo '['.$rs['m_depid'].'] '.$rs['m_depname'];?></option>
                                    <?php
                                            while($rw=mysqli_fetch_array($SQLpd))
                                            {
                                            ?>
                                    <option value="<?php echo $rw['m_depid'];?>">
                                        <?php echo '['.$rw['m_depid'].']'.' - '.$rw['m_depname'];?>
                                    </option>
                                    <?php
                                            }
                                            ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="card">
                                <div class="col-sm-4">
                                    <label for="pty">สิทธิ์การรักษาใช้เรียกเก็บเงิน</label>
                                    <select class="form-control select2" name="mpttype" id="mpttype">
                                        <option value="<?= $rs['rf_now_pttype'];?>" selected readonly>
                                            <?php echo '['.$rs['rf_now_pttype'].']'.' - '.$rs['pttype_name'];?>
                                        </option>
                                        <?php
                                                $spt=mysqli_query($conn,"SELECT type_id,name FROM rf_pttype ORDER BY type_id");
                                                while($rp=mysqli_fetch_array($spt))
                                                {
                                                    ?>
                                        <option value="<?php echo $rp['type_id'];?>">
                                            <?php echo '['.$rp['type_id'].']'.' - '.$rp['name'];?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="oth">สถานพยาบาลเรียกเก็บ</label>
                                    <select class="form-control select2" name="hosmoney" id="hosmoney">
                                        <option value="<?=$rs['rf_place_money'];?>" selected readonly>
                                            <?php echo '['.$rs['rf_place_money'].']'.' - '.$rs['pay_hosp_name'];?>
                                        </option>
                                        <?php
                                        $sqlm = mysqli_query($conn,"SELECT hcode,hosname FROM `rf_nametype` WHERE namestatus='Y'
                                                                                                    UNION ALL
                                                                                            SELECT hcode,hosname from v_view_users");
                                        while($rm=mysqli_fetch_array($sqlm))
                                        {
                                        ?>
                                        <option value="<?php echo $rm['hcode'];?>">
                                            <?php echo '['.$rm['hcode'].']'.' - '.$rm['hosname'];?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <label for="insipd">ระยะเวลาหมดอายุใบส่งตัว(วัน)</label>
                                    <select class="form-control select2" name='exp' value="exp">
                                        <option value="<?=$rs['rf_ptype_expire'];?>" selected>
                                            <?php echo '['.$rs['rf_ptype_expire'].']'.'-'.$rs['expire_day'];?>
                                        </option>
                                        <?php
                                            $sexp=mysqli_query($conn, "SELECT * from rf_expire WHERE expire_use ='Y' ");
                                            while ($rp=mysqli_fetch_array($sexp)){?>
                                        <option value="<?php echo $rp['id'];?>">
                                            <?php echo '['.$rp['id'].']'.'-'.$rp['expire_day'];?>
                                        </option>
                                        <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="insipd">Thai Refer No.:</label>
                                    <input class="form-control" name="rfthairefer" type="text" id="rfthairefer"
                                        value="<?php echo $rs['rf_no_thairefer'];?>">
                                </div>
                            </div>
                        </div>
                        <!-- เพิ่มเติม -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="levcl">กรอกเหตุผล Refer</label>
                                <select class="form-control select2" name="rema" id="rema">
                                    <option value="<?=$rs['rf_rema'];?>" selected readonly>
                                        <?php echo $rs['rf_name'];?>
                                    </option>
                                    <?php
                                    $rqm=mysqli_query($conn,"SELECT rf_id,rf_name 
                                               from rf_rem_comment WHERE rf_status='Y' Order by rf_index");
                                    while($row = mysqli_fetch_array($rqm)){
                                        ?>
                                    <option value="<?php echo $row["rf_id"];?>">
                                        <?php echo $row["rf_id"].' - '.$row['rf_name'];?>
                                    </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <label for="levcl">เหตุผลเพิ่มเติม</label>
                                <input class="form-control" type="text" name='remb' id="remb"
                                    value="<?php echo $rs['rf_remchar'];?>"
                                    placeholder="ระบุเหตุผล Refer Out เพิ่มเติม">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="lpcr">ค่าใช้จ่าย ทั้งหมด</label>
                                <input class="form-control" name="ttpaid" id='ttpaid'
                                    style="color:red;text-align:center;font-weight:bold;font-size:20px;"
                                    value="<?php echo  number_format($ttpaid,2)."";?>">
                            </div>
                            <div class="form-group  col-sm-2">
                                <label for="lpcr">E-singature (ผู้บันทึกรายการ)</label>
                                <select class="form-control select2" name="esign" id="esign" required>
                                    <option value="<?php echo trim($rs['rf_signature']);?>" selected readonly required>
                                        (ผู้บันทึกรายการ)
                                    </option>
                                </select>
                            </div>
                            <div class="form-group  col-sm-2">
                                <label for="lpcr">ประเมินความพึงพอใจ </label>
                                <select class="form-control select2" name="remarka" id="remarka">
                                    <option value="<?=$rs['rf_remarka'];?>" selected readonly>
                                        <?php echo $rs['satis'];?>
                                    </option>
                                    <?php
                                    $rsol=mysqli_query($conn,"SELECT * FROM rf_satis WHERE status='Y' ");
                                    while($rsl=mysqli_fetch_array($rsol)){
                                    ?>
                                    <option value="<?php echo $rsl["id"];?>">
                                        <?php echo $rsl["id"].' - '.$rsl['satis'];?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group  col-sm-2">
                                <label for="lpcr">ระดับความพึงพอใจ</label>
                                <select class="form-control select2" name="remarkb" id="remarkb">
                                    <option value="<?=$rs['rf_remarkb'];?>" selected readonly>
                                        <?php echo $rs['level'];?>
                                    </option>
                                    <?php
                                    $rsl=mysqli_query($conn,"SELECT * FROM rf_level WHERE status='Y' ");
                                    while($rwl = mysqli_fetch_array($rsl)){
                                        ?>
                                    <option value="<?php echo $rwl["id"];?>">
                                        <?php echo $rwl['level'];?>
                                    </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="lpcr">หมายเหตุ</label>
                                <input class="form-control" type="text" name="remarkc" id="remarkc"
                                    value="<?php echo $rs['rf_remarkc'];?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="lpcr">ขอกำหนดระยะเวลาหมดอายุของใบส่งตัว</label>
                                <select class="form-control select2" name="expdoc" id="expdoc" required>
                                    <option value="<?=$rs['rf_expdoc'];?>" selected>
                                        <?php echo $rs['rf_expdoc'];?>
                                    </option>
                                    <!-- <option value="" selected readonly>(ระยะเวลาหมดอายุใบส่งตัว)</option> -->
                                    <option value="3 เดือน"> 3 เดือน</option>
                                    <option value="6 เดือน"> 6 เดือน</option>
                                    <option value="9 เดือน"> 9 เดือน</option>
                                    <option value="12 เดือน">12 เดือน</option>
                                </select>
                            </div>

                            <div class="row" style="padding: 18px 0px 0px 0px;">
                                <input type="hidden" name="action" value="erefer">
                                <input type="hidden" name="erid" value="<?=$rs['rf_id'];?>">
                                <button type="submit" class="btn btn-button"
                                    style="font-size:1.2em;background-color:#FF6F00;color:#FFF8E1;">
                                    <span class="glyphicon glyphicon-ok-circle"></span>
                                    แก้ไขข้อมูล [REFER]
                                </button>
                                <button class="btn btn-button" 
                                    style="text-decoration:none;font-size:1.2em;color:;background-color:#FF6F00;" >
                                    <a style="text-decoration:none;color:#FFF8E1;" href="sys_hycall_wardmonitor_edit.php?hn=<?=$rs['rf_hn'] ;?>" target=_blank>
                                        ตรวจสอบใบส่งตัวทั้งหมด
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        <script src="scriptb.js"></script>
        <script src="./assets/js/notify.js"></script>
        <script src="./assets/js/bootstrap-timepicker.min.js"></script>
        <script src="./assets/js/jquery.min.js"></script>
        <script src="./assets/bootstrap-table/dist/bootstrap-table.min.js"></script>
        <script src="./assets/bootstrap-table/dist/bootstrap-table.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <script>
        $(document).ready(function() {
            $('.select2').select2({
                // theme: "classic",
                closeOnSelect: true,
                tags: true,
                // tokenSeparators: [',', ' ']
            });
        });

        $(document).ready(function() {
            $("#esign").select2({
                ajax: {
                    url: "user_pmk_ajax.php",
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'user_search'
                        }
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                },
                cache: true,
                placeholder: 'ผู้บันทึกรายการ'
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
</body>

</html>