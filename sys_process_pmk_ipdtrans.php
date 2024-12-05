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
 $sqld="DELETE FROM sys_ipdtrans";
 $dresult=mysqli_query($conn,$sqld);
?>

<!-- เตรียมการเพิ่มข้อมูลสำหรับแพทย์ ที่ยังอยู่-->
<?php
$strSQL="SELECT 
    a.an,a.hn,a.pla_placecode,a.bed_no,to_char(a.dateadmit,'dd-mm-yyyy') as dadmit,
    a.timeadmit,b.id_card,c.fullplace,
    (b.prename||b.name||' '||b.surname) as pname
FROM ipdtrans a
    inner join v_patients b ON b.hn=a.hn 
    inner join places c ON c.placecode=a.pla_placecode
WHERE a.datedisch is null and a.ipdplace <>'TEST' ";
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

    // ตรวจสอบรายการที่มีอยู่แล้ว
    
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

// foreach($type as $key => $val) {
//     if(isset($type[$key]) && $type[$key] != "") {
//         $query="INSERT INTO sys_ipdtrans(an) 
//                 VALUES ('$an[$key]')";
//             $result = mysqli_query($conn,$query); 
    
        // $sql_type ="INSERT INTO `tbl_type` ( `type_id` ,
        //     `type` ,
        //     `cause` ,
        //     `desc` ) VALUES ( NULL ,
        //     '$type[$key]',
        //     '$cause[$key]',
        //     '$desc[$key]'')";
        // $que_type = mysql_query($sql_type);
    
// $query="INSERT INTO sys_ipdtrans(an,hn,name,ward,bed) 
// VALUES ('$an','$hn','$name','$place','$bed')";
// $result = mysqli_query($conn,$query); 

// if($result)
// {
//  echo "<script type='text/javascript'>";
//  echo "window.location='sys_hycall_center_error.php?do=ok';";
//  echo "</script>";
// }else{
//   echo "<script type='text/javascript'>";
//   echo "window.location='sys_hycall_center_error.php?do=nok';";
//   echo "</script>";
//   echo $query; exit();
// } 
?>
    <?php 
    oci_close($objConnect);
    ?>

</body>

</html>