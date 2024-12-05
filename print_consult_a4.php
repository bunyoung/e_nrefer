<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('vendor/autoload.php');
	include('db/connection.php');
	ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<head>
</head>
<body>

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
		$h1 = $rs["cons_date"];
		$h2 = $rs["cons_time"];
		$mh=$rs['m_depname'];
		$sh=$rs['s_ename']; 
		$no           ='เลขที่ใบ Consult :'.$rs['mcode'].'-'.$rs['cons_id'];
		$doctor   =$rs['prec'].''.$rs['namec'].'   '.$rs['surnamec'];
		$patient  ='ชื่อ-สกุลผู้ป่วย :' .$rs['pname'].' อายุ :'.$rs['age'].' ปี     เพศ :'.$rs['sex'];
        $ward      ='หอผู้ป่วย :'.$rs['places'].' เตียง :'.$rs['beds'].'  วันที่นอนโรงพยาบาล :'.$rs['date_admit'];
		$heatha  ='ประวัติและการตรวจร่างกาย : ';
		$heatha1 =$rs["a1"];
		$heathb   ='ผลการตรวจทางห้องปฏิบัติการและการตรวจพิเศษ : ';
		$heathb1 ='-'.$rs["a2"];
		$takecar1='การรักษาปัจจุบัน : ';
		$takecar2='-'.$rs['a3'];
		$expre='จุดประสงค์ในการปรึกษาครั้งนี้ : ';
		$expre1='-'.$rs['exp'];
		$icd='การวินิจฉัยโรค : ';
		$icd1='-'.$rs['icda'].','.$rs['icdb'].','.$rs['icdc'];
		$icd3='การวินิจฉัยโรค (ระบุเอง) :';
		$icd4='-'.$rs['ftext'];
		$dconm='ชื่อ-สกุลแพทย์ผู้ปรึกษา : '.$rs['prea'].''.$rs['namea'].' '.$rs['surnamea'];
		$dcons='ชื่อ-สกุลอาจารย์แพทย์ผู้รับผิดชอบ : '.$rs['preb'].''.$rs['nameb'].' '.$rs['surnameb'];
		$dtext='สรุปผลตรวจ / ข้อแนะนำ';
		$dftext='-'.$rs["comment"];
		$doctor=$rs['prec'].''.$rs['namec'].'  '.$rs['surnamec'];
		$headf='ชื่อ-สกุลแพทย์ผู้รับปรึกษา :'.$rs['prec'].''.$rs['namec'].'   '.$rs['surnamec'];
		$headd='วันที่ :'.$rs['doc_date'].' เวลา :'.$rs['doc_time'].' น.';
	}
	$content = '
	<style>
	h1{
		text-align:center;
	}

	</style>
	
	<div class="container">
	</div>
	';


	// ----------------------------------------
	$head = '
	<style>
	body{
		font-family: "Garuda";
		font-size:12pt;
		margin-left:30px;

	}
	</style>
	<h3 style="text-align:center">ใบปรึกษาผู้ป่วยระหว่างแผนก (ใบ Consult)</h3>' ;

	$heade = '
	<style>
		body{
			font-family: "Garuda";
		}
	</style>
	<h3 style="text-align:center">บันทึกการรับปรึกษา (ในกรณีที่ตอบทางเอกสาร)</h3>';
	$headg = '
	<style>
		body{
			font-family: "Garuda";
		}
	</style>
	<h4 style="text-align:right">'.$headf.' </h4>';

	$hd = '
	<style>
		body{
			font-family: "Garuda";
		}
	</style>
	<h5 style="text-align:right"> '.$headd.' </h5>';

	$hl = '
	<style>
		body{
			font-family: "Garuda";
			font-size:12pt;
		}
	</style>
	<h5 style="text-align:center">........................................................................................ </h5>';
	?>
	<?php  echo "วันที่ขอ    : $h1    เวลา : $h2 น."; ?><br>
	<?php  echo "กลุ่มงานที่จะปรึกษา :  $mh      สาขา/หน่วยงาน : $sh"; ?><br>
	<?php  echo $patient ;?><br>
	<?php  echo $ward ;?><br>
	<?php  echo $heatha ;?><br>
	<?php  echo $heatha1 ;?><br>
	<?php  echo $heathb ;?><br>
	<?php  echo $heathb1 ;?><br>
	<?php  echo $takecar1 ;?><br>
	<?php  echo $takecar2 ;?><br>
	<?php  echo $expre ;?><br>
	<?php  echo $expre1 ;?><br>
	<?php  echo $icd ;?><br>
	<?php  echo $icd1 ;?><br>
	<?php  echo $icd3 ;?><br>
	<?php  echo $icd4 ;?><br>
	<?php  echo $dconm ;?><br>
	<?php  echo $dcons ;?><br>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf = new mPDF('th', 'A4-P', '0', 'THSaraban','20','5','5','0','0');
$mpdf->adjustFontDescLineheight = 2.0;
$mpdf->WriteHTML($head);
$mpdf->adjustFontDescLineheight = 2.0;
$mpdf->WriteHTML($no);
$mpdf->adjustFontDescLineheight = 0.70;
$mpdf->WriteHTML($html, 2);
$mpdf->adjustFontDescLineheight = 1.05;
$mpdf->WriteHTML($hl);
$mpdf->WriteHTML($heade);
$mpdf->WriteHTML($dtext);
$mpdf->WriteHTML($dftext);
$mpdf->WriteHTML($headg);
$mpdf->WriteHTML($hd);
$mpdf->Output();
?>           
