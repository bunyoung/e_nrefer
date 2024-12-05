<?php 
	// Include the database config file 
	include_once 'connect_pmk.php';

	// Get country id through state name

	$placeid = $_POST['placeid'];

	// if (!empty($placeid)) {
		$strSQL2="SELECT    
		 TO_CHAR(O.OPD_DATE,'DDMMYYYY') AS pdate,P.PLACECODE,(O.PAT_RUN_HN||'/'||O.PAT_YEAR_HN) AS HN,
		 	(VP.PRENAME||VP.NAME||'  '||VP.SURNAME) AS pname
	   	FROM PLACES P
			 INNER JOIN OPDS O ON P.PLACECODE=O.PLA_PLACECODE 
       INNER JOIN V_PATIENTS VP ON VP.HN=(O.PAT_RUN_HN||'/'||O.PAT_YEAR_HN) AND
		   	 TO_CHAR(O.OPD_DATE,'DDMMYYYY')='04082021' AND
			 P.PLACECODE='$placeid'";

		$objParse2 = oci_parse($objConnect, $strSQL2);  
		oci_execute ($objParse2,OCI_DEFAULT);   
		while($objResult2 = oci_fetch_array($objParse2,OCI_BOTH)) 
		{ 
		?>
		<option value="<?=$objResult2["HN"];?>">
			<?=$objResult2["HN"]."-".$objResult2["PNAME"];?>
		</option>
		<?php
		}  
		oci_close($objConnect);                                                                
		?>

	<!-- } -->
?>