<?php
include('db/connect_pmk.php');
$objConnect = oci_connect("$oracle_username","$oracle_password","$oracle_server_name", "AL32UTF8");

$hn1=$_REQUEST['hn'];
/*$strSQL = "select *
from PATIENT_PICTURE p
	WHERE (p.pat_run_hn||'/'||p.pat_year_hn)='$hn1'
	";*/
	$strSQL="SELECT pp.* FROM
	(select * from PATIENTS WHERE hn='".$hn1."') p
	INNER JOIN PATIENT_PICTURE pp ON p.run_hn=pp.PAT_RUN_HN AND p.year_hn=pp.PAT_YEAR_HN";
	$objParse = oci_parse($objConnect, $strSQL);
	oci_execute($objParse, OCI_DEFAULT);
	$objResult = oci_fetch_array($objParse);
if($objResult) {
	echo $objResult['PIC_1'];
}else{
	$filename = "img/ps.png";
	$handle = fopen($filename, "rb");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	header("content-type: image/jpeg");
	echo $contents;
}
// header("Content-Type: ".$objResult["image/jpg"]);
oci_close($objConnect);