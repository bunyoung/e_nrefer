<?php
header("Content-type:text/html; charset=UTF-8"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
?>

<?php  
include('db/connection.php');   
// include('db/conv_date.php');   
$q = strtoupper(urldecode($_GET["q"]));  
$pagesize = 50; // จำนวนรายการที่ต้องการแสดง  
$find_field="code"; // ฟิลที่ต้องการค้นหา  
// if ($q=='')
// {
    // $sqledu="
    //     SELECT 
    //     doc_code,prename,name,surname  
    //     FROM rf_doctor limit 20"; 
// }else{
    $sqledu="
        SELECT 
        doc_code,prename,name,surname,hstatus  
        FROM doc_dbfs
        WHERE hstatus='Y' AND doc_status='0' AND  (doc_code LIKE '$q%' OR name LIKE '%$q%' OR surname LIKE '%$q%') limit  20"; 
// }
$result=mysqli_query($conn,$sqledu);  
while($rs=mysqli_fetch_array($result))
    {
    $id=$rs["doc_code"]; // ฟิลที่ต้องการส่งค่ากลับ  
    $name = $rs['prename'].''.$rs['name'].'  '.$rs['surname'];  
    // $name =  iconv("tis-620","utf-8",$rs["doc_code"].' - '.$rs['prename'].''.$rs['name'].' '.$rs['surname']);
    $display_name = preg_replace("/(" . $q . ")/i", "<b>$1</b>", $name);  
    echo "<li onselect=\"this.setText('$name').setValue('$id');\">$display_name</li>";  
}  
?>