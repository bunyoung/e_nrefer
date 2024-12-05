<?php
echo 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'; exit();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process_date_patients</title>
</head>

<?php
require_once('main_script.php');
require_once('./db/connect_pmk.php');
require_once('./db/connection.php');
?>

<body>
<?php
     include ("main_script_loading.php");
?>
<?php
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
while($objResult = oci_fetch_array($objParse,OCI_BOTH))
{
    $adate=$objResult['DDATE'];
    $atimedate=$objResult['TTIME'];
    $adoc=$objResult['PRENAME'].''.$objResult['NAME'].'  '.$objResult['SURNAME'];
    $adateplace='('.$objResult['PLACECODE'].') '.$objResult['FULLPLACE'];
    $appplace=$objResult['APP_NAME'];
    $hn=$objResult[' PAT_RUN_HN'].'/'.$objResult['PAT_YEAR_HN'];

// ตรวจสอบรายการที่มีอยู่แล้ว   
    $sqlf="SELECT hn,hn_date FROM rf_date WHERE hn ='$hn' AND hn_date='$adate' ";
    $resultf=mysqli_query($conn,$sqlf);
    $num=mysqli_num_rows($resultf);
    if($num <=0){
        $query="INSERT INTO rf_date(hn,hn_date,hn_time,hn_doc,hn_place,hn_ftime) 
        VALUES ('$hn','$adate','$atimedate','$adoc','$adateplace','$appplace')";
        $result = mysqli_query($conn,$query);    
    }else{
        $sqlm="UPDATE rf_date SET 
                    hn_time='$atimedate',
                    hn_doc='$adoc',
                    hn_place='$adateplace',
                    hn_ftime='appplace'
            WHERE hn ='$hn' AND hn_date='$adate' ";
        $resultm=mysqli_query($conn,$sqlm);
    }    
}
oci_close($objConnect);
mysqli_close($conn);
?>

</body>

</html>