<?php
header("Content-type:text/html; charset=UTF-8"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
?>

<?php  
include('db/connection.php');   
$q = strtoupper(urldecode($_GET["q"]));  
$pagesize = 50; // จำนวนรายการที่ต้องการแสดง  
$find_field="code"; // ฟิลที่ต้องการค้นหา  
if ($q=='')
{
    $sqledu="
        SELECT 
        code,icd_desc  
        FROM rf_icd10 limit 20"; 
}else{
    $sqledu="
        SELECT 
        code,icd_desc  
        FROM rf_icd10
        WHERE (code LIKE '$q%' OR icd_desc LIKE '%$q%') limit  20"; 
}

$result=mysqli_query($conn,$sqledu);  
while($rs = mysqli_fetch_array($result))
    {
    $id=$rs["code"]; // ฟิลที่ต้องการส่งค่ากลับ  
    $name = addslashes($rs['icd_desc']);  
    $display_name = preg_replace("/(" . $q . ")/i", "<b>$1</b>", $name);  
    echo "<li onselect=\"this.setText('[$id]&nbsp;$name').setValue('$id');\">($id) $display_name</li>";  
}  
?>