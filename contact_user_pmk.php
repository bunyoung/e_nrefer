<?php
header("Content-type:text/html; charset=UTF-8"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
?>
<?php  
include('db/connect_pmk.php');   
include('function/conv_date.php');   
$q = strtoupper(urldecode($_GET["q"]));  
    $pagesize = 50; // จำนวนรายการที่ต้องการแสดง  
    $find_field="code"; // ฟิลที่ต้องการค้นหา  
	$sqledu="SELECT IDCARD,PRENAME,NAME,LASTNAME 
       FROM v_patients WHERE (IDCARD LIKE '$q%' OR NAME LIKE '$q%') AND ROWNUM <= 100 AND EMPLOYEE_FLAG='Y' ";
	$objParse=oci_parse($objConnect,$sqledu);
    oci_execute($objParse,OCI_DEFAULT);
	
	while($objResult = oci_fetch_array($objParse,OCI_BOTH))
       {
        $id=$objResult["IDCARD"]; // ฟิลที่ต้องการส่งค่ากลับ  
        $tname=tis_to_utf($objResult['PRENAME'].''. objResult['NAME']).'  '.objResult['LASTNAME']); // ฟิลที่ต้องการแสดงค่า  
        $name=$objResult["IDCARD"].' - '.$tname; // ฟิลที่ต้องการแสดงค่า  
		//$name = iconv("utf-8","tis-620",$objResult2['HALFPLACE']);
        $name = str_replace("'", "'", $name);  
        $display_name = preg_replace("/(" . $q . ")/i", "<b>$1</b>", $name);  
        echo "<li onselect=\"this.setText('$name').setValue('$id');\">$display_name</li>";  
    }  
   oci_close($objConnect);
    ?>