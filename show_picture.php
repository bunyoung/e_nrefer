<?php
$hn=$_REQUEST['hn'];
$strSQL = "SELECT HN,PRENAME,NAME,SURNAME FROM v_patients where (hn='".$_REQUEST['hn']."')";
$objParse = oci_parse($objConnect, $strSQL);
oci_execute ($objParse,OCI_DEFAULT);
$num_Rows = oci_fetch_all($objParse, $Result);
oci_close($objConnect);

if($num_Rows > 0){
?>
<div align="center" ><center>
    <img src="ViewImage.php?hn=<?= $hn ?>" width="150" >
</center></div>
<?PHP
}
?>
