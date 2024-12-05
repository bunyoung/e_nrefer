<?php
	include_once('./vendor/autoload.php');
	ob_start();
    $mpdf = new mPDF('th', '', '', '');
?>
<?php
	include('./db/connection.php');
    require_once('./db/connect_pmk.php');
?>
<?php    
    if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
    $qra="http://61.19.25.194/e_nrefer/print_refer_out03.php?id=".$id;
    $qrb="http://61.19.25.194/e_nrefer/sys_hycall_send_receive_mbile.php?id=".$id;
?>
<style>
.container {
    font-family: "Thsarabun";
}

p {
    text-align: justify;
}

h1 {
    text-align: center;
}
</style>
<?php
    $d_date ='
    <table width="100%" style="border:1px solid;border-collapse: collapse;font-family:sarabun;font-size:11pt;margin-top:10px;">
    <thead>
        <tr style="background-color:#d6e1e9;font-color:#0f0e11;font-size:12px;">
            <td style="border:1px solid;text-align:center;">วันที่นัด </td>
            <td style="border:1px solid;text-align:center;">เวลานัด </td>
            <td style="border:1px solid;text-align:center;width:20%;">สถานที่นัด</td>
            <td style="border:1px solid;text-align:center;width:10%;">แพทย์ที่นัด</td>
            <td style="border:1px solid;text-align:center;">เวลาพบแพทย์</td>
        </tr>
    </thead>
    <tbody>';

$d_con ='
<table width="100%" style="border:1px solid;border-collapse: collapse;font-family:sarabun;font-size:11pt;margin-top:10px;">
    <thead>
        <tr style="background-color:#d6e1e9;font-color:#0f0e11;font-size:12px;">
            <td style="border:1px solid;text-align:center;">ลำดับ</td>
            <td style="border:1px solid;text-align:center;">รายการยา </td>
            <td style="border:1px solid;text-align:center;">วิธีการและเวลาใช้ยา<br>(คำเตือน)</td>
            <td style="border:1px solid;text-align:center;">จำนวนยา </td>
        </tr>
    </thead>
    <tbody>';

    $l_con ='
    <table width="100%" style="border:1px solid;border-collapse: collapse;font-family:sarabun;font-size:11pt;margin-top:10px;">
        <thead>
            <tr style="background-color:#d6e1e9;font-color:#0f0e11;font-size:12px;">
                <td style="border:1px solid;text-align:center;">ลำดับ</td>
                <td style="border:1px solid;text-align:center;">รายการแลบ </td>
                <td style="border:1px solid;text-align:center;">ผลแลบ</td>
                <td style="border:1px solid;text-align:center;">ค่าปกติ</td>
            </tr>
        </thead>
        <tbody>';
    
$d_home ='
<table width="100%" style="border:1px solid;border-collapse: collapse;font-family:sarabun;font-size:11pt;margin-top:10px;">
    <thead>
        <tr style="background-color:#d6e1e9;font-color:#0f0e11;font-size:12px;">
            <td style="border:1px solid;text-align:center;">ลำดับ</td>
            <td style="border:1px solid;text-align:center;">รายการยา </td>
            <td style="border:1px solid;text-align:center;">วิธีการและเวลาใช้ยา<br>(คําเตือน)</td>
            <td style="border:1px solid;text-align:center;">จำนวนยา </td>
        </tr>
    </thead>
    <tbody>';

$strSQL ="SELECT *,SUBSTR(rf_an,1,LENGTH(rf_an)-3) AS noan,SUBSTR(rf_an,LENGTH(rf_an)-1,3) AS yy FROM v_rf_print WHERE rf_id = '".$id."' ";
$rss=mysqli_query($conn,$strSQL);
$rs=mysqli_fetch_array($rss);
$dhn=$rs['rf_hn'];
$dan=$rs['rf_an'];
$an=$rs['noan'];
$yy=$rs['yy'];

//รายการยาประจำวัน
$sqld="SELECT
                D.CODE, D.NAME2 DRUG,
                (DUC.NAME||DTC1.NAME||' '||DTC.NAME) A,
                IDP.DRUG_USING_REMARK U,
                (DWC.NAME||'  '||DWCA.NAME) D,
                IDP.QUANTITY,
                 DUC1.NAME UNIT
            FROM IPDPT_DRUG_PROFILE IDP 
                LEFT JOIN DRUGCODES D ON D.CODE=IDP.DRU_CODE
                LEFT JOIN DRUG_TIMING_CODES DTC ON DTC.TIMING_CODE=IDP.DTC_TIMING_CODE
                LEFT JOIN DRUG_TIMING_CODES DTCA ON DTCA.TIMING_CODE=IDP.DTC1_LABEL_CODE
                LEFT JOIN DRUG_WARNING_CODES DWC ON DWC.WARNING_CODE=IDP.DWC_WARNING_CODE
                LEFT JOIN DRUG_USING_CODES DUC ON DUC.USING_CODE=IDP.DUC_USING_CODE
                LEFT JOIN DRUG_WARNING_CODES DWCA ON DWCA.WARNING_CODE=IDP.SIG2
                LEFT JOIN DRUG_TOTAL_CODES DTC1 ON DTC1.LABEL_CODE = IDP.DTC1_LABEL_CODE
                LEFT JOIN DRUG_UNIT_CODES DUC1 ON DUC1.UNIT_CODE = D.DUC1_UNIT_CODE                
            WHERE IDP.IPD_RUN_AN='$an'  AND 
                IDP.IPD_YEAR_AN='$yy' AND 
                IDP.TYPE_GIVEN_FLAG IN('C','W') AND 
                IDP.OFF_DATE IS NULL
                ORDER BY D.NAME";
 $objParse = oci_parse($objConnect, $sqld);
  oci_execute ($objParse,OCI_DEFAULT);
  $i=0;
  while($orResult = oci_fetch_array($objParse,OCI_BOTH))
  {
    $i = $i+1;
    // $dand=$orResult['AN'];
    $dcode=$orResult['CODE'];
    $dname=$orResult['DRUG'].' ['.$orResult['UNIT'].']';
    $using=$orResult['A'];
    $warning=$orResult['U'].'<br>'.$orResult['D'];
    $dquan=$orResult['QUANTITY'];
     $d_con .='
      <tr>
          <td  style="border:1px solid;text-align:center;font-size:14px;width:5%;">'.$i.'</td>
          <td  style="border:1px solid;font-size:14px;width:30%;">'.$dname.'</td>
          <td style="border:1px solid;font-size:14px;">'.$using.'<br>'.$warning.'</td>
          <td style="border:1px solid;text-align:center;font-size:14px;width:10%;">'.$dquan.'</td>
      </tr>';
  }  
// oci_close($objConnect);
$d_con .='</tbody></table>';
// สิ้นสุดของยาประจำวัน

// ส่วนของรายการยากลับบ้าน
$SQL="SELECT
  D.CODE,
  nvl(D.NAME2,D.NAME) DRUG,
  DUC1.NAME UNIT,
  (DTC2.NAME||DUC.NAME||DFD.DRUG_USING_REMARK) USING,
  DTC.NAME TIMING,
  (DWC.NAME||' '||DWC1.NAME) WARNING,
  DFD.QUANTITY
  FROM OPD_FINANCE_HEADERS OFH
        LEFT JOIN DRUG_FINANCE_DETAILS DFD ON DFD.OFH_OPD_FINANCE_NO = OFH.OPD_FINANCE_NO
        LEFT JOIN DRUGCODES D ON D.CODE=DFD.DRU_CODE
        LEFT JOIN DRUG_WARNING_CODES DWC ON DWC.WARNING_CODE=DFD.DWC_WARNING_CODE
        LEFT JOIN DRUG_WARNING_CODES DWC1 ON DWC1.WARNING_CODE=DFD.SIG2
        LEFT JOIN DRUG_TIMING_CODES DTC ON DTC.TIMING_CODE=DFD.DTC_TIMING_CODE
        LEFT JOIN DRUG_TIMING_CODES DTC1 ON DTC1.TIMING_CODE=DFD.DTC1_LABEL_CODE
        LEFT JOIN DRUG_TOTAL_CODES DTC2 ON DTC2.LABEL_CODE=DFD.DTC1_LABEL_CODE
        LEFT JOIN DRUG_USING_CODES DUC ON DUC.USING_CODE=DFD.DUC_USING_CODE
        LEFT JOIN DRUG_UNIT_CODES DUC1 ON DUC1.UNIT_CODE = D.DUC1_UNIT_CODE
  WHERE DFD.GROUP_CODE2='AA' AND OFH.IPD_RUN_AN='$an' AND OFH.IPD_YEAR_AN='$yy'
        ORDER BY DRUG";
  $objParse = oci_parse($objConnect, $SQL);
  oci_execute ($objParse,OCI_DEFAULT);
  $i=0;
  while($hResult = oci_fetch_array($objParse,OCI_BOTH))
  {
      $i=$i+1;
      $name=$hResult['DRUG'].' ['.$hResult['UNIT'].']';
      $using=$hResult['USING'];
      $timing=$hResult['TIMING'];
      $quantity=$hResult['QUANTITY'];
      $warning=$hResult['WARNING'];
      $d_home .='
      <tr>
          <td  style="border:1px solid;text-align:center;font-size:14px;width:5%;">'.$i.'</td>
          <td  style="border:1px solid;font-size:14px;width:30%;">'.$name.'</td>
          <td style="border:1px solid;font-size:14px;">'.$using.'<br>'.$timing.'<br>'.$warning.'</td>
          <td style="border:1px solid;text-align:center;font-size:14px;width:10%;">'.$quantity.'</td>
      </tr>';
  }
// oci_close($objConnect);
$d_home .='</tbody></table>';
// สิ้นสุดของยากลับบ้าน

//เริ่ม ส่วนของงานนัด
$strSQL="SELECT DISTINCT RUN_HN,YEAR_HN FROM V_PATIENTS WHERE HN='$dhn' ";
$objParse = oci_parse($objConnect, $strSQL);
oci_execute ($objParse,OCI_DEFAULT);
while($objResult = oci_fetch_array($objParse,OCI_BOTH))
{
  $phn=$objResult['RUN_HN'];
  $yhn=$objResult['YEAR_HN'];
}

// รายการแลบ
$l_sql="SELECT
   L.OFH_OPD_FINANCE_NO,LD.LABCODE,LD.LABCODE_DETAIL_CODE,LD.NAME ,LD.UNIT_TEXT,L.NUMBERIC_RESULT,L.MIN_NORMAL_VALUE,L.MAX_NORMAL_VALUE,L.NORMAL_TEXT
FROM
(SELECT MAX(TO_CHAR(OFH.OPD_FINANCE_NO)) OPDNO FROM OPD_FINANCE_HEADERS OFH 
   WHERE OFH.PAT_RUN_HN = '$phn'
        AND OFH.PAT_YEAR_HN = '$yhn' AND FT_TYPE_CODE='06'
)A
 LEFT JOIN LABRESULT L ON L.OFH_OPD_FINANCE_NO = A.OPDNO
LEFT JOIN LABCODE_DETAIL LD ON LD.LABCODE_DETAIL_CODE = L.LABCODE_DETAIL_CODE
LEFT JOIN LABCODES L1 ON L1.LABCODE = LD.LABCODE AND L.LAB1_LABCODE IS NOT NULL
ORDER BY L1.LAB_CODE, L.LABCODE_DETAIL_CODE";
$objParse = oci_parse($objConnect, $l_sql);
oci_execute ($objParse,OCI_DEFAULT);
$di=0;
while($objResult = oci_fetch_array($objParse,OCI_BOTH))
{
    $di=$di+1;
    $lname=$objResult['NAME'];
    $lresult=$objResult['NUMBERIC_RESULT'];
    $nrs=$objResult['NORMAL_TEXT'];
    $l_con .='
    <tr>
        <td  style="border:1px solid;text-align:center;width:10%">'.$di.'</td>
        <td style="border:1px solid;text-align:center;">'.$lname.'</td>
        <td style="border:1px solid;width:10%;text-align:center;">'.$lresult.'</td>
        <td style="border:1px solid;width:10%;text-align:center;">'.$nrs.'</td>
    </tr>';
}
$l_con .='</tbody></table>';
// <!-- จบแลบ -->

//  การนัด
$strSQL = "SELECT 
DD.PAT_RUN_HN,DD.PAT_YEAR_HN,DD.PLA_PLACECODE,
TO_CHAR(DD.APP_DATE,'DD/MM/YYYY') DDATE,
DD.APPOINT_NAME TTIME,DD.DOC_APPOINT_NAME,DD.DD_DOC_CODE,
P.PLACECODE,P.FULLPLACE,DD1.PRENAME,DD1.NAME,DD1.SURNAME
FROM  DATE_DBFS DD 
LEFT JOIN PLACES P ON P.PLACECODE=DD.PLA_PLACECODE 
LEFT JOIN DOC_DBFS DD1 ON DD1.DOC_CODE=DD.DD_DOC_CODE
WHERE PAT_RUN_HN='$phn' AND PAT_YEAR_HN='$yhn' AND DD.APP_DATE >= SYSDATE AND
              DD.DEL_FLAG IS NULL
ORDER BY DD.APP_DATE ASC";
$objParse = oci_parse($objConnect, $strSQL);
oci_execute ($objParse,OCI_DEFAULT);
while($objResult = oci_fetch_array($objParse,OCI_BOTH))
{
    $adate=$objResult['DDATE'];
    $atimedate=$objResult['TTIME'];
    $adoc=$objResult['PRENAME'].''.$objResult['NAME'].'  '.$objResult['SURNAME'];
    $adateplace='('.$objResult['PLACECODE'].') '.$objResult['FULLPLACE'];
    $appplace=$objResult['APPOINT_NAME'];
    $hn=$objResult['PAT_RUN_HN'].'/'.$objResult['PAT_YEAR_HN'];
    $d_date .='
    <tr>
        <td  style="border:1px solid;text-align:center;width:10%">'.$adate.'</td>
        <td style="border:1px solid;text-align:center;width:10%">'.$atimedate.'</td>
        <td style="border:1px solid;width:35%;">'.$adateplace.'</td>
        <td style="border:1px solid;width:20%;">'.$adoc.'</td>
        <td style="border:1px solid;text-align:center;width:10%;">'.$appplace.'</td>
    </tr>';
}
$d_date .='</tbody></table>';
?>

<?php
   
    $mdoc='';
    $msgd='';
    $h8='ใบสรุปการรักษาผู้ป่วย (Discharge Summary Form)';
    $strSQL ="SELECT * FROM v_rf_print WHERE rf_id = '".$id."' ";
	$result = mysqli_query($conn,$strSQL);

    $head = '
    <body style="font-family:sarabun;font-size: 18px;">
          <div style="text-align: center;"><img src="./img/hyh.png" style="width: 12%;margin-top:-30px;"></div>
          <table class="container" width="100%" style="border-collapse: collapse;padding:-30px;">
            <thead>
                <tr>
                    <td style="font-size:20px;padding:15px 0px 0px 0px;text-align:center;">
                    '.$h8.'
                    </td>
                </tr>
            </thead>
            <br>
	        <tbody>';

    $content='';
    while($rs = mysqli_fetch_assoc($result))
    {
        if($rs['rf_expire_date'] <>'')
        {
            $eyy = substr($rs['rf_expire_date'],0,5)+543;
            $emm =substr($rs['rf_expire_date'],5,2);
            $edd =substr($rs['rf_expire_date'],8,2);

            //  Discharge Date
            $eyya = substr($rs['rf_date_system'],0,4)+543;
            $emma =substr($rs['rf_date_system'],5,2);
            $edda =substr($rs['rf_date_system'],8,2);
            $disdate = $edda.'/'.$emma.'/'.$eyya;

            if($rs['rf_ptype_expire'] =='6'){
                $end_rec_sys = 'อนุมัติครั้งเดียวและขอข้อมูลรักษากลับ (Single e-Approved)';
                $mdoc='เรียนแพทย์ที่ตรวจรักษา - จากนโยบายที่มุ่งเน้นเรื่องความปลอดภัยของผู้ป่วยเป็นหลัก รพ. หาดใหญ่จะส่งต่อผู้ป่วยไปยังท่านในกรณีที่เกินศักยภาพการรักษาของรพ. หาดใหญ่ ดังนั้นขอให้ท่านสรุปประวัติการรักษาทั้งหมด รวมถึงผลทางรังสีและห้อง LAB ที่จำเป็นมายัง รพ.หาดใหญ่ เพื่อให้ผู้ป่วยเข้ารักษาต่อเนื่องที่รพ.หาดใหญ่ต่อไป  - ขอแสดงความนับถือ  - ศูนย์บริหารจัดการส่งผู้ป่วย รพ.หาดใหญ่ (CVT-10682-13779-09-0003045) (อมุมัติครั้งเดียว (Single e-Approved))';
            }else{
                if($rs['rf_ptype_expire']=='7')
                {
                    $end_rec_sys = 'ไม่อนุมัติส่ง (Unapproved)';
                }else{
                    if($rs['rf_ptype_expire']=='8')
                    {
                        $end_rec_sys = 'ส่งกลับ​รพ.​ต้นสังกัดเดิม';
                    }else{
                        if($rs['rf_ptype_expire']=='10'){
                            $end_rec_sys = 'ยกเลิกใบส่งต่อ';
                        }else{
                            $end_rec_sys = ($edd.'/'.$emm.'/'.$eyy);
                        }
                    }
                }
            }
        }else{
            $end_rec_sys = '-';
        }
        // 
        $wat='โรงพยาบาลหาดใหญ่';
        if(empty($rs['rf_no_thairefer']) || empty($rs['rf_ptype_expire']) || empty($rs['rf_place_money']) || empty($rs['rf_pttype']))
        {
            $wat ='Waiting for e-Approval';
        }

        $hs1 ='<b>'.$rs['hosname'].' ('.$rs['rf_hospital'].')</b>';
        // 
        $icd_a='';    
        $icd_b='';    
        $icd_c='';    
        if(strlen(trim($rs['descicda']))<>0){
            $icd_a='('.$rs['rf_icd10a'].') '.$rs['descicda'].'<br>';
        }else{
            $icd_a='';
        }
        if(strlen(trim($rs['descicdb']))<>0){
            $icd_b='&nbsp;&nbsp;&nbsp;&nbsp;('.$rs['rf_icd10b'].') '.$rs['descicdb'].'<br>';
        }else{
            $icd_b='';           
        }
        if(strlen(trim($rs['descicdc']))<>0){
            $icd_c='&nbsp;&nbsp;&nbsp;&nbsp;('.$rs['rf_icd10c'].') '.$rs['descicdc'];
        }else{
            $icd_c=''; 
        }

        $hno = $rs['norf'];
        $an=$rs['rf_an'];
        $hd18 = $rs['docsend_prename'].$rs['docsend_name'].'  '.$rs['docsend_surname'].'  (ว. '.$rs['docsend_code'].')';
        $hd18a = $rs['docsend_prename'].$rs['docsend_name'].'  '.$rs['docsend_surname'];
    
        if(empty($an)){
            $an='----------';
        }
        $sryy = substr($rs['rf_serv'],6,4)+'543';
        $syy =  substr($rs['rf_serv'],0,2).'/'.substr($rs['rf_serv'],3,2).'/'.$sryy; 

        $content .= '
        <br>
        <tr>
            <td style="font-size:14px;"><b>ชื่อ-สกุล ผู้ป่วย : </b>'.$rs['rf_patients'].'<b>  เพศ : </b>'.$rs['rf_sex'].'<b> อายุ : </b>'.$rs['rf_age'].'<b> ปี เลขที่บัตรประชาชน : </b>'.$rs['rf_idcard'].'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>HN : </b>'.$rs['rf_hn'].' <b>AN : </b>'.$an.'<b>   OPD/WARD : </b>'.'('.$rs['rf_placecode'].') '.$rs['rf_placename'].' </td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>วันนอน รพ. : </b> '.$syy.'<b>  วันที่จำหน่าย : </b> '.$disdate.' <b>      สิทธิ์การรักษาครั้งนี้ : </b> '.$rs['pttypename'].'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>ที่อยู่ปัจจุบัน (ติดต่อได้) : </b>'.$rs['rf_maddress'].'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>โทรศัพท์ : </b> '.$rs['rf_stel'].'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>Vital Signs :</b></td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;<b>BT </b>'.$rs['bb'].'<b> <sup>.</sup>C,</b> <b>BP </b>'.$rs['bpa'].'<b>/</b>'.$rs['bpb'].' <b>mmHg, PR </b>'.$rs['pr'].'/min<b>, RR </b>'.$rs['rr'].'<b>/min,  O2 Sat </b> '.$rs['o2'].'%, </td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;<b>Pain Score  </b> '.$rs['pain'].' <b>, BW </b>'.$rs['weight_value'].' <b>kg. , BH </b>'.$rs['head_value'].   '<b>  cm. , HC  </b>'.$rs['heigth_value'].  ' <b>cm.</b> </td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>ประวัติการแพ้ยา</b></td>
        </tr>
        <tr>
            <td style="font-size:14px;"> &nbsp;&nbsp;&nbsp;&nbsp;'.trim($rs['rf_allergy']).'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>ประวัติผู้ป่วยปัจจุบัน / Problem lists</b> </td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.trim($rs['rf_his_patient']).'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>ตรวจร่างกาย </b></td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$rs['rf_his_body'].'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>การตรวจทางห้องปฏิบัติการ/รังสี/อื่น ๆ </b></td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$rs['rf_his_lab'].'</td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td style="font-size:14px;"><b>การวินิจฉัยระบุเอง </b></td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$rs['rf_icd_free_text'].'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>การวินิจฉัย (ICD10) </b></td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$icd_a.'</td>
        </tr>
        <tr>
            <td style="font-size:14px;">'.$icd_b.'</td>
        </tr>
        <tr>
            <td style="font-size:14px;">'.$icd_c.'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>ข้อมูลผ่าตัด</b></td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$rs['rf_oper'].'</td>
        </tr>

        <tr>
            <td style="font-size:14px;"><b>การรักษาปัจจุบัน </b></td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$rs['rf_his_takecare_now'].'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>แผนการรักษาแจ้งปลายทาง </b></td>
        </tr>
        <tr>
            <td style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$rs['rf_exp_takecare_hosp_end'].'</td>
        </tr>
        <br>
        <tr>
            <td style="font-size:14px;"><b>ยารักษาต่อ ก่อนกลับบ้าน/ส่งกลับ</b></td>
        </tr>
        <tr>
            <td>'.$d_con.'</td>
        </tr>
        <br>
        <tr>
            <td style="font-size:14px;"><b>ยากลับบ้าน (Home  Medication)</b></td>
        </tr>
        <tr>
            <td>'.$d_home.'</td>
        </tr>
        <br>
        <tr>
            <td style="font-size:14px;"><b>วันนัด ครั้งถัดไป </b></td>
        </tr>
        <tr>
            <td>'.$d_date.'</td>
        </tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
            <td style="font-size:14px;"><b>ชื่อแพทย์ผู้รักษา : </b>'.$rs['docsend_prename'].$rs['docsend_name'].'  '.$rs['docsend_surname'].'<b>  (ว. </b>'.$rs['docsend_code'].')'.'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>ชื่อแพทย์เจ้าของไข้ : </b>'.$rs['docme_prename'].$rs['docme_name'].'  '.$rs['docme_surname'].' <b> (ว. </b>'.$rs['docme_code'].')' .'</td>
        </tr>
        <tr>
            <td style="font-size:14px;"><b>กลุ่มงาน : </b>'.$rs['m_depname'].' ('.$rs['m_code'].')'.'</td>
        </tr>
        <tr>
            <td>
                <table width="100%" style="margin-top:60px;">
                    <tr>
                        <td width="30%"></td>
                        <td width="20%"></td>
                        <td style="font-size:16px;"><center><b>ลงชื่อ </b>'.$hd18a. ' (E-signature) </center></td>
                    </tr>
                    <tr>
                    <td width="30%"></td>
                    <td width="20%"></td>
                    <td style="font-size:16px;"><center>'.$hd18.'</center></td>
                </tr>
                </table>
            </td>
        </tr>
    
        <tr>
            <td  width="50%">
                    <table width="100%" style="margin-top:0px;">
                        <tr>
                                <td width="50%" align="right">
                                    (NB e-Refer Service Operating System:NBER SOS)
                                </td>
                        </tr>
                    </table>
            </td>  
        </tr>
        <tr>
    </tr>';
    }   
    mysqli_close($conn);

    $end = "</tbody></table></div></body>";
    $mpdf->WriteHTML($head);
    $mpdf->WriteHTML($content);
    $mpdf->WriteHTML($end);
    // $mpdf->SetWatermarkText($wat);
    $mpdf->showWatermarkText = true;
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->Output();
?>