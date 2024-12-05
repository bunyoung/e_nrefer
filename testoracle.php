<?php
require("db/connect_pmk.php");
$strSQL = "SELECT * FROM V_PATIENTS WHERE ROWNUM < 10";
$objParse = oci_parse($objConnect, $strSQL);
oci_execute($objParse, OCI_DEFAULT);
?>
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">CustomerID </div></th>
    <th width="98"> <div align="center">Name </div></th>
    <th width="198"> <div align="center">Email </div></th>
  </tr>
<?php
while($objResult = oci_fetch_array($objParse,OCI_BOTH))
{
?>
  <tr>
    <td><div align="center"><?=$objResult["HN"];?></div></td>
    <td><?=$objResult["NAME"];?></td>
    <td><?=$objResult["SURNAME"];?></td>
  </tr>
<?php
}
?>
</table>
<?php
oci_close($objConnect);
?>
