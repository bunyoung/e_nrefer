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
include('db/connect_pmk.php');
require_once('db/connection.php');
?>

<body>

<?php
$sql="SELECT distinct(hn) from asssent";
$hresult=mysqli_query($conn,$sql);
while($rs=mysqli_fetch_array($hresult))
{
    $ehn=$rs['hn'];
    
    //ตรวจสอบค่าใน PMK 
    $strSQL = "SELECT ID_CARD,HN,PRENAME,NAME,SURNAME,(PRENAME||NAME||' '||SURNAME) as pname,
                    trunc(months_between(sysdate, BIRTHDAY)/12) as age
               FROM v_patients
                WHERE HN='".$ehn."' ";
    $objParse = oci_parse($objConnect, $strSQL);
    oci_execute($objParse);
    $Num_Rows = oci_fetch_all($objParse, $Result);
    // $objResult = oci_fetch_array($objParse,OCI_BOTH)
    // echo $Num_Rows;
    if(($Num_Rows)>0){
        oci_execute($objParse,OCI_DEFAULT);
        while($objResult = oci_fetch_array($objParse,OCI_BOTH))
        {
            $fhn=$objResult['HN'];
            $fna=$objResult['PNAME'];
            $fage=$objResult['AGE'];
            $fid=$objResult['ID_CARD'];
        }
    }

    // ตรวจสอบที่มีในระบบแล้วยัง
    $sqls="SELECT * FROM pmk_his WHERE hn='$ehn' ";
    $query=mysqli_query($conn,$sqls);
    $count = mysqli_num_rows($query);
    if($count>0){
        $pins="UPDATE pmk_his set age = '$fage' WHERE hn='$fhn' ";
        $result=mysqli_query($conn,$pins);   
    }else{
        $pins="INSERT INTO pmk_his(hn,pname,idcard,age) VALUES ('$fhn','$fna','$fid','$fage')";
        $result=mysqli_query($conn,$pins);   
    }

}
?>
    <?php 
    oci_close($objConnect);
    ?>

</body>

</html>