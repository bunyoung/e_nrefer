<?php 
include_once('db/connect_pmk.php');
$dhn="";
$phn='';$yhn='';
$dhn=$_REQUEST['hn'];
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
 DISTINCT DFD.OFH_DATE,DFD.OFH_OPD_FINANCE_NO,DFD.OFH_OPD_FINANCE_NO VN,
    DFD.DRUG_TYPE,DFD.DRU_CODE,DC.POPUP_NAME DRUG,  DFD.QUANTITY,DUC.NAME USING_A,
    DTC.NAME TELLU , DWC.NAME WARNING_A, DFD.DRUG_USING_REMARK AS DRUG_REM,DFD.PLA_PLACECODE,
    TO_CHAR(DFD.OFH_DATE,'DD/MM/YYYY') UDATE
FROM
(SELECT
    O.OPD_NO
FROM OPDS O
WHERE O.PAT_RUN_HN='$phn' AND O.PAT_YEAR_HN='$yhn') SS
  INNER JOIN OPD_FINANCE_HEADERS OFH ON OFH.OPD_NO= SS.OPD_NO
    LEFT JOIN DRUG_FINANCE_DETAILS DFD ON OFH.OPD_FINANCE_NO = DFD.OFH_OPD_FINANCE_NO
    LEFT JOIN DRUGCODES DC ON DFD.DRU_CODE=DC.CODE
    LEFT JOIN DRUG_USING_CODES DUC ON DUC.USING_CODE=DFD.DUC_USING_CODE
    LEFT JOIN DRUG_TIMING_CODES DTC ON DTC.TIMING_CODE=DFD.DTC_TIMING_CODE
    LEFT JOIN DRUG_WARNING_CODES DWC ON DWC.WARNING_CODE=DFD.DWC_WARNING_CODE
    LEFT JOIN REASON_USING_DRUG RUDA ON RUDA.CODE=DFD.DUC_USING_CODE 
    LEFT JOIN REASON_USING_DRUG RUDB ON  RUDA.CODE=DFD.DUC_USING_CODE 
WHERE OFH.VN IS NOT NULL AND DUC.NAME IS NOT NULL AND TO_CHAR(SYSDATE,'DDMMYYYY') = TO_CHAR(DFD.OFH_DATE,'DDMMYYYY')
ORDER BY DFD.OFH_DATE DESC,DRUG ASC";
$objParse = oci_parse($objConnect, $strSQL);
oci_execute ($objParse,OCI_DEFAULT);
$data=array();
while($objResult = oci_fetch_array($objParse,OCI_BOTH))
{
  $a['udate']=$objResult['UDATE'];
  $a['drug']=$objResult['DRUG'];
  $a['quantity']=$objResult['QUANTITY'];
  $a['using_a']=$objResult['USING_A'];
  $a['tellu']=$objResult['TELLU'];
  $a['warning_a']=$objResult['WARNING_A'];
  array_push($data,$a);
}
print json_encode($data);
oci_close($objConnect);
?>