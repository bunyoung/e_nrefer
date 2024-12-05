<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-nrefer</title>
</head>

<?php
require_once('main_script.php');
require_once('./db/connect_pmk.php');
require_once('./db/connection.php');
?>

<!-- Delete from sys_ipdtrans -->
<?php
 $sqld="DELETE FROM sys_ipdtrans";
 $dresult=mysqli_query($conn,$sqld);
?>

<!-- เตรียมการเพิ่มข้อมูลสำหรับแพทย์ ที่ยังอยู่-->
<?php
$strSQL="
SELECT DOC_CODE,PRENAME,NAME,SURNAME,(PRENAME||NAME||'  '||SURNAME) AS FULLNAME,DEL_FLAG
FROM DOC_DBFS
WHERE PRENAME IN ('พว.','พว','ทพญ','ทพญ.','ผศ.พญ.','ผศ.นพ','รศ.นพ','ผศ.นพ.','รศ.นพ.','พญ.','พญ','ดร.พญ.','นพ','นพ.','น.พ.','ทพ.','ทพ','ท.พ.') 
               AND DOC_CODE <> 'ADMIN' 
               AND DEL_FLAG IS NULL";
$objParse = oci_parse($objConnect, $strSQL);  
oci_execute ($objParse,OCI_DEFAULT); 
?>

<body>
    <?php
     include ("main_script_loading_sys.php");
?>

    <?php
while($objResult = oci_fetch_array($objParse,OCI_BOTH)) 
{ 
    $ds='0';
    IF($objResult['DEL_FLAG']=='Y')
    {
        $ds='1';
    }
    $dc= $objResult['DOC_CODE'];
    $pn= $objResult['PRENAME'];
    $na= $objResult['NAME'];
    $sn= $objResult['SURNAME'];
    $dp= '0';
    $fn= $objResult['FULLNAME'];
    $dl= '-';
    $ss= 'Y';
    $cw='0';

    // ตรวจสอบรายการที่มีอยู่แล้ว
    
    $sqlf="SELECT doc_code FROM doc_dbfs WHERE doc_code='$dc' ";
    $resultf=mysqli_query($conn,$sqlf);
    $num=mysqli_num_rows($resultf);
    if($num <=0){
        $query="INSERT INTO doc_dbfs(doc_code,prename,name,surname,dept,fullname,doc_status,doc_line,status,checkword) 
        VALUES ('$dc','$pn','$na','$sn','$dp','$fn','$ds','$dl','$ss','$cw')";
        $result = mysqli_query($conn,$query);    
    }else{
        $sqlm="UPDATE doc_dbfs SET prename='$pn',name='$na',surname='$sn' ,fullname='$fn',doc_status='$ds'  
            WHERE doc_code='$dc' ";
        $resultm=mysqli_query($conn,$sqlm);
    }
}
?>
    <?php 
   oci_close($objConnect);
    ?>

</body>
<?php 
    echo "
	<meta http-equiv=\"refresh\" content=\"0;URL=dashboard.php\">";
?>

</html>