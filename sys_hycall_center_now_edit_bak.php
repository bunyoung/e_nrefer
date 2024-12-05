<!-- <!DOCTYPE html> -->
<html class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Refer</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <style>
    @import url('https://fonts.googleapis.com/css?family=sarabun&display=swap');

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
        /* margin: 0 0 20px; */
        /* width: 300px; */
        box-shadow: inner 0 0 4px rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    textarea {
        width: 300px;
        height: 100px;
        /* background-color: yellow; */
        font-size: 1em;
        /* font-weight: bold;
        font-family: Verdana; */
        border: 1px solid #F57F17;
    }

    textarea:focus {
        background-color: #FFF9C4;
    }
    </style>
</head>
<?php 
include('./db/connection.php');
include('./db/date_format.php');
// include('main_script.php'); 

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

$d_start_post = @$_POST['d_start'];
$d_end_post = @$_POST['d_end'];
IF(!empty($d_start_post)){
$d_start = $d_start_post ;
}ELSE{
$d_start = $date_start_dmy_defult;
}
IF(!empty($d_end_post) ){
$d_end = $d_end_post ;
}ELSE{
$d_end = $date_end_dmy_defult;
}
$d_start_cal = substr($d_start,0,2).substr($d_start,3,2).substr($d_start,6,4) ;
$d_end_cal =  substr($d_end,0,2).substr($d_end,3,2).substr($d_end,6,4) ;
$date_m= $d_end;
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

$rid = $_POST['oid'];
$sql = "
SELECT *
FROM v_rf_detail
WHERE rf_id='$rid' ";
$result_sql = mysqli_query($conn,$sql);
$rs=mysqli_fetch_array ($result_sql);
?>

<!-- <body style="font-family:'K2D',font-size:16px;"> -->
    <div class="card border-info"
        style="font-family:'K2D',font-size:16px; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; margin-top:10px;">
        <form action="" class="form-control" >
        <div class="panel-heading" style="background-color:#24135F;
                          color:#BFCED6;font-size: 18px;">
            <span class="glyphicon glyphicon-send"></span>
            ขอใช้บริการส่งคนไข้เพื่อการรรักษาต่อ (e-Refer)
        </div>
            <div class="panel-body" style="background-color:#B4B5DF; color:#24135F;">
                <input type="hidden" name=ddate id=ddate value="<?php echo $d_default;?>">
                <input type="hidden" name="hcode" id="hcode" value="<?php echo $hcode ;?>">
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
                        <select class="form-control select2" name="pttye" id="pttye"
                            style="width: 100%;font-family:sarabun;font-size:14px;">
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
                            placeholder="กรุณากรอกเบอร์โทรที่สามารถติดต่อได้">
                    </div>
                </div>
                <div class="panel panel-warning">
                    <div class="panel-body" style="background:#9595D2; opacity: 1;
                            color:#24135F;">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="oth">สถานพยาบาลปลายทาง</label>
                                <select class="form-control select2" name="hoseid" id="hoseid">
                                    <option value="" selected readonly>
                                        <?php echo '['.$rs['rf_hos_send_to'].']'.' '.$rs['hossendto_name'];?></option>
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
                                    <option value="" selected readonly>
                                        <?php echo '['.$rs['rf_hotlevel'].']'.'  '.$rs['rffast'];?></option>
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
                                <label for="pcr">ประเภทส่งต่อ (หน่ายงานรับปลายทาง)</label>
                                <select class="form-control select2" name="rfev" id="rfev">
                                    <option value="" selected readonly>
                                        <?php echo '['.$rs['rf_rfev'].']'.'  '.$rs['rfevent'];?>
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
                                    <option value="" selected readonly>
                                        <?php echo '['.$rs['rf_indication'].']'.'  '.$rs['departname'];?></option>
                                    <?php 
                                        while($rfi = mysqli_fetch_array($SQLif)) 
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
                                    <option value="" selected readonly>
                                        <?php echo '['.$rs['id'].']'.'  '.$rs['indication'];?></option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="oth">Refer Out (โรค/ภาวะ)</label>
                                <select class="form-control select2" name="rsdi" id="rsdi">
                                    <option value="" selected readonly>
                                        <?php echo '['.$rs['rf_sindication'].']'.'  '.$rs['sindication_name'];?>
                                    </option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <!-- สิ้นสุดที่เพิ่มใหม่ -->
                        <!-- เพิ่มใหม่เรื่องการวัดอุณภูมิ -->
                        <!-- <div class="panel panel-warning"> -->
                        <div class="panel-body" style="background:#7474C1; color:#211551;">
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
                                    <label for="bh">BH/BL (cm)</label>
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
                        <!-- </div> -->
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
                                <label for="a1">ประวัติผู้ป่วย</label>
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
                                    rows="4"><?=$rs['rf_his_takecare_now'];?></textarea>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="lpcr">แผนการรักษา/ข้อมูลปลายทาง</label>
                                <textarea class="form-control" name="exp_takecare_hosp_end" id='exp_takecare_hosp_end'
                                    rows="4"><?=$rs['rf_exp_takecare_hosp_end'];?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="oth">[1] การวินิจฉัย (ICD-10) โรคหลัก </label>
                                <input class="form-control" name="show_icd_101" type="text" id="show_icd_101"
                                    placeholder="(เลือกรายการ)" />
                                <input class="form-control" name="icd101" type="hidden" id="icd101" value="" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="oth">[2] การวินิจฉัย (ICD-10)</label>
                                <input class="form-control" name="show_icd_102" type="text" id="show_icd_102"
                                    placeholder="(เลือกรายการ)" />
                                <input class="form-control" name="icd102" type="hidden" id="icd102" value="" />
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="oth">[3] การวินิจฉัย (ICD-10</label>
                                <input class="form-control" name="show_icd_103" type="text" id="show_icd_103"
                                    placeholder="(เลือกรายการ)" />
                                <input class="form-control" name="icd103" type="hidden" id="icd103" value="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="levcl">ชื่อแพทย์ผู้ส่งต่อ</label>
                                <select class="form-control select2" name="hdoc" id="hdoc" required>
                                    <option value="" selected readonly>(เลือกรายการ)</option>
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

                                                # กรณีที่ไม่ใช้ PMK
                                                if($hcode<>'10682'){
                                                    $rsg=mysqli_query($rfconn,$SQLd);
                                                    while ($rs=mysqli_fetch_array($rsg)) 
                                                    {
                                                    ?>
                                    <option value="<?php echo $rs["doc_code"];?>">
                                        <!-- <?php echo iconv('TIS-620','UTF-8','['.$rs["doc_code"].'] - '.$rs['name']);?> -->
                                        <?php echo '['.$rs["doc_code"].'] - '.$rs['name'];?>
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
                                    <option value="" selected readonly>(เลือกรายการ)</option>
                                    <?php
                                                #กรณีที่ใช้ PMK
                                                if($hcode == '10682'){
                                                    $objParse=oci_parse($objConnect,$SQLd);
                                                    oci_execute($objParse,OCI_DEFAULT);
                                                    while($objRs = oci_fetch_array($objParse,OCI_BOTH)){
                                                    ?>
                                    <option value="<?php echo $objRs["DOC_CODE"];?>">
                                        <?php echo '['.$objRs["DOC_CODE"].'] - '.$objRs['PRENAME'].''.$objRs['NAME'].' '.$objRs['SURNAME'];?>
                                    </option>
                                    <?php
                                                    }
                                                }    
                                                
                                                # กรณีที่ไม่ใช่ PMK
                                                if($hcode <> '10682') {
                                                    $rsg=mysqli_query($rfconn,$SQLd);
                                                    while ($rs=mysqli_fetch_array($rsg)) {
                                                        ?>
                                    <option value="<?php echo $rs["doc_code"];?>">
                                        <!-- <?php echo iconv('TIS-620','UTF-8','['.$rs["doc_code"].'] - '.$rs['name']);?> -->
                                        <?php echo '['.$rs["doc_code"].'] - '.$rs['name'];?>
                                    </option>
                                    <?php
                                                    }
                                                }
                                                ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="pcr">กลุ่มงานที่ส่งต่อ</label>
                                <select class="form-control select2" name="tdep" id="tdep">
                                    <option value="" selected readonly>(เลือกรายการ)</option>
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
                        <div class="row">
                            <div class="card">
                                <div class="col-sm-4">
                                    <label for="pty">ใช้สิทธิ์ครั้งนี้</label>
                                    <select class="form-control select2" name="rsdi" id="rsdi">
                                        <option value="" selected readonly>(เลือกรายการ)</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label for="insopd">วันหมดอายุ OPD</label>
                                    <input data-provide="datepicker" data-date-language="th-th" type="text"
                                                    name="d_start" value="<?php echo $d_start; ?>"
                                                    class="form-control autotab"
                                                    placeholder="วัน / เดือน / ปี" />
                                </div>
                                <div class="col-sm-2">
                                    <label for="insopd">วันหมดอายุ IPD</label>
                                    <input data-provide="datepicker" data-date-language="th-th" type="text"
                                        name="expipd" class="form-control autotab" placeholder="วัน / เดือน / ปี" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <div class="form-group col-sm-5">
                                <input type="hidden" name="action" value="refer">
                                <input type="hidden" class="form-control" name="rfpatient" id="rfpatient">
                                <input type="hidden" class="form-control" name="hosmain" id="hosmain">
                                <input type="hidden" class="form-control" name="hossub" id="hossub">
                                <input type="hidden" class="form-control" name="pttype" id="pttype">
                                <input type="hidden" class="form-control" name="idcard" id="idcard">
                                <input type="hidden" class="form-control" name="birthdate" id="birthdate">
                                <button type="button" class="button btn bth-button" id="btn-save"
                                    style="font-size:1.2em;">
                                    <span class="glyphicon glyphicon-ok-circle"></span>
                                    แก้ไขข้อมูล [REFER]
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
    <!-- <script src="./assets/js/notify.js"></script> -->
    <!-- <script src="./assets/js/bootstrap-timepicker.min.js"></script> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
    <!-- <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script> -->
    <script>
    $(document).ready(function() {
        $('.select2').select2({
            // theme: "classic",
            closeOnSelect: true,
            tags: true,
            // tokenSeparators: [',', ' ']
        });
    });
    </script>

<!-- </body> -->

</html>