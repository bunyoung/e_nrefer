<?php
header("Content-type:text/html; charset=UTF-8"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
?>
<?php  
include('db/connect_pmk.php');   
include('main_script.php');
    $q = strtoupper(urldecode($_GET["q"]));  
    $pagesize = 20; // จำนวนรายการที่ต้องการแสดง  
	$sqledu="
SELECT DOC_CODE,PRENAME,NAME, SURNAME 
FROM doc_dbfs
WHERE(DOC_CODE LIKE '$q%' OR NAME LIKE '$q%' OR PRENAME LIKE '$q%') AND
PRENAME IN ('ผศ.นพ','รศ.นพ','ผศ.นพ.','รศ.นพ.','พญ.','พญ','ดร.พญ.','นพ','นพ.','น.พ.') AND DOC_CODE <>'ADMIN' AND DEL_FLAG IS NULL";
$objParse=oci_parse($objConnect,$sqledu);
    oci_execute($objParse,OCI_DEFAULT);
	
	while($objResult = oci_fetch_array($objParse,OCI_BOTH))
       {
        $id = $objResult["DOC_CODE"]; // ฟิลที่ต้องการส่งค่ากลับ  
	    $name = $objResult["DOC_CODE"].' - '.$objResult['PRENAME'].''.$objResult['NAME'].' '.$objResult['SURNAME']; // ฟิลที่ต้องการแสดงค่า  
		//$name = iconv("tis-620","utf-8",$objResult2['HALFPLACE']);
        // $name =  iconv("utf-8","tis-620",$objResult["DOC_CODE"].' - '.$objResult['PRENAME'].''.$objResult['NAME'].' '.$objResult['SURNAME']);
        // $name =  iconv("UTF-8", "CP1250 ",$objResult["DOC_CODE"].' - '.$objResult['PRENAME'].''.$objResult['NAME'].' '.$objResult['SURNAME']);
        // ป้องกันเครื่องหมาย '  
        $name = str_replace("'", "'", $name);  
        // กำหนดตัวหนาให้กับคำที่มีการพิมพ์  
        $display_name = preg_replace("/(" . $q . ")/i", "<b>$1</b>", $name);  
        echo "<li onselect=\"this.setText('$name').setValue('$id');\">$display_name</li>";  
    }  
    oci_close($objConnect);
       ?>