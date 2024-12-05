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
DD.PAT_RUN_HN,DD.PAT_YEAR_HN,DD.PLA_PLACECODE,
TO_CHAR(DD.APP_DATE,'DD/MM/YYYY') DDATE,
DD.APPOINT_NAME TTIME,DD.DOC_APPOINT_NAME,DD.DD_DOC_CODE,
P.PLACECODE,P.FULLPLACE,DD1.PRENAME,DD1.NAME,DD1.SURNAME
FROM  DATE_DBFS DD 
LEFT JOIN PLACES P ON P.PLACECODE=DD.PLA_PLACECODE 
LEFT JOIN DOC_DBFS DD1 ON DD1.DOC_CODE=DD.DD_DOC_CODE
WHERE PAT_RUN_HN='$phn' AND PAT_YEAR_HN='$yhn' AND DD.APP_DATE >= SYSDATE
ORDER BY DD.APP_DATE DESC";
$objParse = oci_parse($objConnect, $strSQL);
oci_execute ($objParse,OCI_DEFAULT);
$data=array();
while($objResult = oci_fetch_array($objParse,OCI_BOTH))
{
$a['date']=$objResult['DDATE'];
$a['timedate']=$objResult['TTIME'];
$a['doc']=$objResult['PRENAME'].''.$objResult['NAME'].'  '.$objResult['SURNAME'];
$a['dateplace']='('.$objResult['PLACECODE'].') '.$objResult['FULLPLACE'];
$a['appplace']=$objResult['APP_NAME'];
array_push($data,$a);
}
print json_encode($data);
oci_close($objConnect);
?>