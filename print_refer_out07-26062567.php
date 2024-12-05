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
$d_home ='
<table width="100%" style="border:1px solid;border-collapse: collapse;font-family:sarabun;font-size:11pt;margin-top:10px;">
    <thead>
        <tr>
            <td style="border:1px solid;text-align:center;">รายการยา </td>
            <td style="border:1px solid;text-align:center;">วิธีการใช้ยา</td>
            <td style="border:1px solid;text-align:center;">เวลาใช้ยา</td>
            <td style="border:1px solid;text-align:center;">จำนวนยา </td>
        </tr>
    </thead>
    <tbody>';

$strSQL ="SELECT * FROM v_rf_print WHERE rf_id = '".$id."' ";
$rss=mysqli_query($conn,$strSQL);
$rs=mysqli_fetch_array($rss);
$dhn=$rs['rf_hn'];
$dan=$rs['rf_an'];

// ส่วนของรายการยากลับบ้าน
$SQL="SELECT 
DISTINCT(DDW.CODE), DDW.C2,I.HN,I.AN,TO_CHAR(I.DATEADMIT,'DD-MM-YYYY') ADM,
TO_CHAR(I.DATEDISCH,'DD-MM-YYYY') DISCH,
 D.NAME AS DRUNAME ,DDW.QUANTITY,DUC.NAME AS USING,DTC.NAME AS TIMING
  FROM DATA_DRUG_WH DDW
  LEFT JOIN IPDTRANS I ON I.AN=DDW.AN
  LEFT JOIN DRUGCODES D ON D.CODE=DDW.CODE
  LEFT JOIN DRUG_USING_CODES DUC ON DUC.USING_CODE = DDW.DRUG_USING_CODE
  LEFT JOIN DRUG_TIMING_CODES DTC ON DTC.TIMING_CODE=DDW.DRUG_TIMING_CODE
  WHERE  I.AN='$dan' AND DDW.QUANTITY<>'0' AND DDW.DRUG_TYPE='1' AND DUC.USING_CODE IS NOT NULL
               AND DDW.CODE <> 'HM4'
                 ORDER BY DDW.C2  ";
  $objParse = oci_parse($objConnect, $SQL);
  oci_execute ($objParse,OCI_DEFAULT);
  while($orResult = oci_fetch_array($objParse,OCI_BOTH))
  {
      $c2=$orResult['C2'];
      $hn=$orResult['HN'];
      $an=$orResult['AN'];
      $dateadmit=$orResult['ADM'];
      $datedisch=$orResult['DISCH'];
      $drugcode=$orResult['CODE'];
      $name=$orResult['DRUNAME'];
      $quantity=$orResult['QUANTITY'];
      $using=$orResult['USING'];
      $timing=$orResult['TIMING'];
      $d_home .='
      <tr>
          <td  style="border:1px solid;">'.$name.'</td>
          <td style="border:1px solid;">'.$using.'</td>
          <td style="border:1px solid;">'.$timing.'</td>
          <td style="border:1px solid;text-align:center;">'.$quantity.'</td>
      </tr>';

  }
oci_close($objConnect);

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
// 
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
    $appplace=$objResult['APP_NAME'];
    $hn=$objResult['PAT_RUN_HN'].'/'.$objResult['PAT_YEAR_HN'];

    // ตรวจสอบรายการที่มีอยู่แล้ว   
    $sqlf="SELECT hn,hn_date FROM rf_date WHERE hn ='$hn' AND hn_date='$adate' ";
    $resultf=mysqli_query($conn,$sqlf);
    $num=mysqli_num_rows($resultf);
    if($num==0){
        $query="INSERT INTO rf_date(hn,hn_date,hn_time,hn_doc,hn_place,hn_ftime) 
        VALUES ('$hn','$adate','$atimedate','$adoc','$adateplace','$appplace')";
        $result = mysqli_query($conn,$query);    
    }else{
        $sqlm="UPDATE rf_date SET 
                    hn_time='$atimedate',
                    hn_doc='$adoc',
                    hn_place='$adateplace',
                    hn_ftime='$appplace'
            WHERE hn ='$hn' AND hn_date='$adate' ";
        $resultm=mysqli_query($conn,$sqlm);
    }    
}
oci_close($objConnect);

// เรียกวันนัด
$sql="SELECT * FROM rf_date WHERE hn= '$dhn' ";
$rss=mysqli_query($conn,$sql);
?>
<?php
$d_date ='
<table width="100%" style="border:1px solid;border-collapse: collapse;font-family:sarabun;font-size:11pt;margin-top:10px;">
    <thead>
        <tr>
            <td style="border:1px solid;text-align:center;">วันที่นัด </td>
            <td style="border:1px solid;text-align:center;">เวลานัด </td>
            <td style="border:1px solid;text-align:center;">แพทย์ที่นัด</td>
            <td style="border:1px solid;text-align:center;">สถานที่นัด</td>
            <td style="border:1px solid;text-align:center;">เวลาพบแพทย์</td>
        </tr>
    </thead>
    <tbody>';

    while($row=mysqli_fetch_array($rss))
    {
        $d_date .='
        <tr>
            <td  style="border:1px solid;text-align:center;">'.$row["hn_date"].'</td>
            <td style="border:1px solid;text-align:center;">'.$row["hn_time"].'</td>
            <td style="border:1px solid;">'.$row["hn_doc"].'</td>
            <td style="border:1px solid;">'.$row["hn_place"].'</td>
            <td style="border:1px solid;text-align:center;">'.$row["hn_ftime"].'</td>
        </tr>';
    } 
    $d_date .='</tbody></table>';
    
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