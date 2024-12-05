<?php
	include_once('vendor/autoload.php');
	include('db/connection.php');
	ob_start();
?>

<?php	
	$id = null;
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
	$strSQL ="SELECT * FROM v_consult_detail WHERE cons_id = '".$id."' ";
	$result = mysqli_query($conn,$strSQL);
	while($rs = mysqli_fetch_array($result)) 
	{
		$h1 			= $rs["cons_date"];
		$h2 			= $rs["cons_time"];
		$mh			  =$rs['m_depname'];
		$sh			   =$rs['s_ename']; 
		$no            =$rs['mcode'].'-'.$rs['cons_id'];
		$doctor      =$rs['prec'].''.$rs['namec'].'   '.$rs['surnamec'];
		$patient     =$rs['pname'];
		$age		   = $rs['age'];
		$sex		    =$rs['sex'];
        $ward         =$rs['places'];
		$bed   		   =$rs['beds'];
		$dateadm  =$rs['date_admit'];
		$heatha1   =$rs["a1"];
		$heathb1   ='-'.$rs["a2"];
		$takecar2  ='-'.$rs['a3'];
		$expre1      ='-'.$rs['exp'];
		$icd1           ='-'.$rs['icda'].','.$rs['icdb'].','.$rs['icdc'];
		$dconm      =$rs['prea'];
		$namea      =$rs['namea'];
		$surnamea=$rs['surnamea'];
		$dcons        =$rs['preb'];
		$nameb      =$rs['nameb'];
		$surnameb=$rs['surnameb'];
		$dftext        ='-'.$rs["comment"];
		$doctor       =$rs['prec'].''.$rs['namec'].'  '.$rs['surnamec'];
		$headf        =$rs['prec'];
		$namec      =$rs['namec'];
		$surnamec=$rs['surnamec'];
		$headd       =$rs['doc_date'];
		$headt        =$rs['doc_time'];
	}
	$f20='20px';
	$d20='15px';
	$l20='20px';
	$head = "
			<h3 style=\"font-family: THSaraban;font-weight:bold;text-align:center;font-size:$f20;\">
								ใบปรึกษาผู้ป่วยระหว่างแผนก (ใบ Consult)
			</h3>
	";

	// เลขที่ใบ consult
	$csno = "
			<p style=\"font-family: THSaraban;font-weight:bold;margin-left:$l20;font-size:$d20;\">
				เลขที่ใบ Consult :
			</p>
	";
	// วันที่ขอ
    $dater= "
		<p style=\"font-family: THSaraban;font-weight:bold;margin-left:$l20;font-size:$d20;\">
				วันที่ขอ : $no   
		</p>
	";	
	// เวลา
    $datet= "
		<p style=\"font-family: THSaraban;font-weight:bold;margin-left:$l20;font-size:$d20;\">
				เวลา :
		</p>
	";	
?>
<?php

$html = ob_get_contents();
ob_end_clean();

$mpdf = new mPDF('th', 'A4-P', '0', 'THSaraban','1','5','5','0','0');
$mpdf->adjustFontDescLineheight = 2.0;
$mpdf->WriteHTML($head);
$mpdf->WriteHTML($csno);
// 
$mpdf->WriteHTML($head);
// 
$mpdf->WriteHTML($csno);
// 
$mpdf->Output();
?>           
