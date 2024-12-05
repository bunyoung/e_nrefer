<?php 
include_once('db/connect_pmk.php');
$dhn="";
$dhn=$_REQUEST['hn'];
// $strSQL2 = "SELECT DISTINCT d.NAME dname,pt.ALLERGIC_DESC
// FROM PT_GR_ALLERGY pt
// LEFT JOIN DRUG_CATAGORY_3 d ON d.CODE=pt.DC_3_CODE
// WHERE (pt.PAT_RUN_HN||'/'||pt.PAT_YEAR_HN)='$dhn'";
// $objParse2 = oci_parse($objConnect, $strSQL2);
// oci_execute ($objParse2,OCI_DEFAULT);
// $adata=array();
// while($objResult2 = oci_fetch_array($objParse2,OCI_BOTH))
// {
// $a['his_allergy'] = $objResult2['GNAME'].' '.$objResult2['ALLERGIC_DESC'];
// array_push($adata,$a);
// }
// print json_encode($adata);
// $his_allergy = $p_allergy.'<br>'.$d_allergy.'<br>'.$pt_allergy;

// $vpl="SELECT DRUG_ALLERGY_HX FROM V_PATIENTS WHERE HN = '$dhn' ";
// $objParse = oci_parse($objConnect, $vpl);
// oci_execute ($objParse,OCI_DEFAULT);
// while($objResult = oci_fetch_array($objParse,OCI_BOTH))
// {
// $p_allergy=$objResult['DRUG_ALLERGY_HX'];

// }

$strSQL = "
SELECT PAT_RUN_HN,PAT_YEAR_HN,DPA.DRU_CODE,DPA.ALLERGIC_DESC,dx.POPUP_NAME,
TO_CHAR(DPA.DATE_CREATED,'dd/mm/yyyy') as DD
FROM DRUG_PT_ALLERGY dpa
LEFT JOIN DRUGCODES dx ON dx.CODE= dpa.DRU_CODE
WHERE (dpa.PAT_RUN_HN||'/'||dpa.PAT_YEAR_HN)='$dhn' ORDER BY DPA.DATE_CREATED DESC";
$objParse = oci_parse($objConnect, $strSQL);
oci_execute ($objParse,OCI_DEFAULT);
$data=array();
WHILE($objResult = oci_fetch_array($objParse,OCI_BOTH))
{
// $a['dru_code'] = $objResult['DRU_CODE'];

$allddmm=SUBSTR($objResult['DD'],0,5); 
$allyy=SUBSTR($objResult['DD'],6,4) + 543;
$alldate=$allddmm.'/'.$allyy;

$a['name']=$objResult['POPUP_NAME'];
$a['allergic_desc']=$objResult['ALLERGIC_DESC'];
$a['date_created']=$alldate;
// ($objResult['DD']);
array_push($data,$a);
}
print json_encode($data);
oci_close($objConnect);
?>