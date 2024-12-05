<?php 
include_once('db/connect_pmk.php');
$pt="";
$placeid=$_POST['placeid'];

$vpl="SELECT * FROM PLACES WHERE PLACECODE = '$placeid' AND PT_PLACE_TYPE_CODE IN ('1','2') ";
$objParse = oci_parse($objConnect, $vpl);  
oci_execute ($objParse,OCI_DEFAULT); 
while($objResult = oci_fetch_array($objParse,OCI_BOTH)) 
{ 
    // คนไข้นอก
    $pt=$objResult['PT_PLACE_TYPE_CODE'];

    if($pt=='1')
    {
        $sqlo="SELECT 
        O.PLA_PLACECODE,(O.PAT_RUN_HN||'/'||O.PAT_YEAR_HN) HN,(VP.PRENAME||VP.NAME||'  '||VP.SURNAME) AS PNAME
        FROM OPDS O
        INNER JOIN V_PATIENTS VP ON VP.HN=(O.PAT_RUN_HN||'/'||O.PAT_YEAR_HN) AND
        TO_CHAR(O.OPD_DATE,'DDMMYYYY') = TO_CHAR(SYSDATE,'DDMMYYYY') AND 
        -- O.OPD_DISCHARGE_STATUSES NOT IN ('08') AND
        O.PLA_PLACECODE='$placeid' ";
            
        $objParse=oci_parse($objConnect, $sqlo);  
        oci_execute ($objParse,OCI_DEFAULT); 
        while($rso=oci_fetch_array($objParse,OCI_BOTH))
        {
          ?>
           <option value="<?=$rso["HN"];?>">
             <?=$rso["HN"]." - ".$rso["PNAME"];?>
           </option>     
         <?php  
        }         
    }

    // คนไข้ใน
    if($pt=='2')
    { 
         $sqli="SELECT 
         I.HN,(VP.PRENAME||VP.NAME||'  '||VP.SURNAME) AS PNAME,I.PLA_PLACECODE
         FROM IPDTRANS I
         INNER JOIN V_PATIENTS VP ON VP.HN=I.HN AND I.DATEDISCH IS NULL AND 
         I.PLA_PLACECODE <>'TEST' AND I.PLA_PLACECODE='$placeid'";

         $objParse = oci_parse($objConnect, $sqli);  
         oci_execute ($objParse,OCI_DEFAULT); 
         while($rsi = oci_fetch_array($objParse,OCI_BOTH))
         {
            ?>
            <option value="<?=$rsi["HN"];?>">
              <?=$rsi["HN"]." - ".$rsi["PNAME"];?>
            </option>     
          <?php  
         }         
    }
}
?>