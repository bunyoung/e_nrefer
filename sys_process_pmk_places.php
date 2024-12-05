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
// $sqld="DELETE FROM pmk_places";
// $dresult=mysqli_query($conn,$sqld);
?>

<?php
$strSQL="SELECT 
P.PLACECODE,P.HALFPLACE,P.FULLPLACE
FROM PLACES P 
WHERE P.PT_PLACE_TYPE_CODE IN ('1','2') AND P.DEL_FLAG IS NULL
ORDER BY P.HALFPLACE";
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
     $pl=$objResult['PLACECODE'];
     $hp=$objResult['HALFPLACE'];
     $fp=$objResult['FULLPLACE'];

    // ตรวจสอบรายการที่มีอยู่แล้ว
    
    $sqlf="SELECT pmkcode FROM pmk_places WHERE pmkcode='$pl' ";
    $resultf=mysqli_query($conn,$sqlf);
    $num=mysqli_num_rows($resultf);
    if($num <=0){
        $query="INSERT INTO pmk_places(pmkcode,pmkplace,pmkfullplace) 
        VALUES ('$pl','$hp','$fp')";
        $result = mysqli_query($conn,$query);    
    }else{
        $sqlm="UPDATE pmk_places SET 
                      pmkplace = '$wname',
                      pmkfullplace='$admit'   
            WHERE pmkcode='$pl' ";
        $resultm=mysqli_query($conn,$sqlm);
    }
}

?>
    <?php 
    oci_close($objConnect);
    mysqli_close($conn);
    ?>

</body>

</html>