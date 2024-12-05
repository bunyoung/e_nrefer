<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
require_once('main_script.php');
require_once('db/connect_pmk.php');
require_once('db/connection.php');
?>

<!-- Delete from sys_ipdtrans -->
<?php
// $sqld="DELETE FROM sys_ipdtrans";
// $dresult=mysqli_query($conn,$sqld);
?>

<!-- เตรียมการเพิ่มข้อมูลสำหรับคนไข้ใน ที่ยัง Admit อยู่-->
<?php

$objParse = oci_parse($objConnect, $strSQL);  
oci_execute ($objParse,OCI_DEFAULT); 
?>

<body>
    <?php
    //  include ("main_script_loading.php");
?>

    <?php
while($objResult = oci_fetch_array($objParse,OCI_BOTH)) 
{ 
    $an= $objResult['AN'];
    $hn= $objResult['HN'];
    $name= $objResult['PNAME'];
    $place= $objResult['PLA_PLACECODE'];
    $bed= $objResult['BED_NO'];
    $admit=$objResult['DADMIT'];
    $tadmit= $objResult['TIMEADMIT'];
    $idcard= $objResult['ID_CARD'];
    $wname=$objResult['FULLPLACE'];
    
    $sqlf="SELECT hn FROM sys_ipdtrans WHERE hn='$hn' ";
    $resultf=mysqli_query($conn,$sqlf);
    $num=mysqli_num_rows($resultf);
    if($num <=0){
        $query="INSERT INTO sys_ipdtrans(an,hn,name,ward,bed,idcard,dateadmit,wardname) 
        VALUES ('$an','$hn','$name','$place','$bed','$idcard','$admit','$wname')";
        $result = mysqli_query($conn,$query);    
    }else{
        $sqlm="UPDATE ipdtrans SET discharge='Y',
                      wardname = '$wname',
                      dateadmit='$admit'   
            WHERE hn='$hn' ";
        $resultm=mysqli_query($conn,$sqlm);
    }
}
?>

    <?php 
oci_close($objConnect);
?>
</body>

</html>