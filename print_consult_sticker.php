<?php date_default_timezone_set('Asia/Bangkok');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
p {
    writing-mode: vertical-lr;
}
.rotate90 {
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}

@page rotated { size: landscape; }
.style1 {
	font-family: "THsarabunPSK";
	font-size: 34pt;
	font-weight: bold;
}
.style2 {
	font-family: "TH sarabunPSK";
	font-size: 16pt;
	font-weight: bold;
}
.style3 {
	font-family: "TH sarabunPSK";
	font-size: 16pt;
	
}
.font12 {
	font-family: "TH sarabunPSK";
	font-size: 12pt;
	
}
.font12B {
	font-family: "TH sarabunPSK";
	font-size: 12pt;
	font-weight: bold;
	
}
.font18{
	font-family: "TH sarabunPSK";
	font-size: 18pt;
}
.font18b{
	font-family: "TH sarabunPSK";
	font-size: 18pt;
	font-weight: bold;
}
.font10 {
	font-family: "TH sarabunPSK";
	font-size: 10pt;
	
}
.font24{
	font-family: "TH sarabunPSK";
	font-size: 24pt;
	
}
.font24b{
	font-family: "TH sarabunPSK";
	font-size: 24pt;
	font-weight: bold;
	
}
.font24b{
	font-family: "TH sarabunPSK";
	font-size: 24pt;
	font-weight: bold;
	
}
.font26b{
	font-family: "TH sarabunPSK";
	font-size: 26pt;
	font-weight: bold;
	
}
.font28b{
	font-family: "TH sarabunPSK";
	font-size: 28pt;
	font-weight: bold;
	
}
.font30b{
	font-family: "TH sarabunPSK";
	font-size: 30pt;
	font-weight: bold;
	
}
.font36b{
	font-family: "TH sarabunPSK";
	font-size: 36pt;
	font-weight: bold;
	
}
.font20{
	font-family: "TH sarabunPSK";
	font-size: 20pt;
	
}
.font20b{
	font-family: "TH sarabunPSK";
	font-size: 20pt;
	font-weight: bold;
	
}
.font16{
	font-family: "Thasadith";
	font-size: 12pt;
	font-weight:90px;
	
}
.font16b{
	font-family: "TH sarabunPSK";
	font-size: 16pt;
	font-weight: bold;
	
}
.font14{
	font-family: "TH sarabunPSK";
	font-size: 14pt;
	
}
.style5 {cursor: hand; font-weight: normal; color: #000000;}
.style9 {font-family: Tahoma; font-size: 12px; }
.style11 {font-size: 12px}
.style13 {font-size: 9}
.style16 {font-size: 9; font-weight: bold; }
.style17 {font-size: 12px; font-weight: bold; }
.Section2 table tr td {
	font-size: 18px;
	font-weight: bold;
}

</style>
<?php
include('db/connection.php');
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
    $pname=$rs['pname'];
    $an=$rs['an'];
    $hn=$rs['hn'];
    $ward=$rs['places'];
    $beds=$rs['beds'];
    $cdate=$rs['cons_date'];
    $ctime=$rs['cons_time'];
    $prec=$rs['prec'];
    $namec=$rs['namec'];
	$dep=$rs['conmdepname'];
    $surnamec=$rs['surnamec'];
	$ep=$rs['eoption'];

	$ms=$rs['m_depname'];
	$me=$rs['s_ename'];
    
	$dod=$rs['doc_date'];
	$con=$rs['mcode'].'-'.$rs['cons_id'];

	$dt=$rs['doc_time'];
	$dat=$rs['date_admit'];

	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qrcode'.DIRECTORY_SEPARATOR;
	$PNG_WEB_DIR = 'qrcode/';
	include('phpqrcode/qrlib.php'); 
	$errorCorrectionLevel = 'M';  
	$matrixPointSize = 2.5;
	$data='http://61.19.25.203/e_consult/print_consult_preview.php?id='.$id;
	$filename = $PNG_TEMP_DIR.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
	QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize,2);    
}
?>

<body onLoad="window.print(); setTimeout(window.close, 0);">
<div style="position:absolute; left:5px; top:0px; width:500px; height: 17px;" align="left" class="n" >
  <?php 
		 echo '<font size="2" class="font16">';
		 echo 'Consult วันที่ :'.$cdate.'        เวลา : '.$ctime.' น.';
		 echo '</font>';
  ?>
</div>

<div style="position:absolute; left:5px; top:20px; width:500px; height: 17px;" align="left" class="n" >
  <?php 
		 echo '<font size="2" class="font16">';
		 echo 'กลุ่มงาน-สาขา Consult : '.$ms.' - '.$me;
		 echo '</font>';
  ?>
</div>

<!-- dddd -->
<div style="position:absolute; left:5px; top:40px; width:500px; height: 17px;" align="left" class="n" >
  <?php 
		 echo '<font size="2" class="font16">';
		 echo 'ชื่อ-สกุล ผู้ป่วย : '.$pname;
		 echo '</font>';
  ?>
</div>

<div style="position:absolute; left:388px; top:3px; width:120px; height: 120px;align="center" >
  <p align="center"> 
      <?php echo '<img src=" '.$PNG_WEB_DIR.basename($filename).' " Style="width:140px; height: 120px;" />';  ?>
  </p>
</div>

<div style="position:absolute; left:5px; top:60px; width:500px; height: 17px;" align="left" >
     <?php 
	   echo '<font size="2" class="font16">';
	   echo 'HN: '.$hn.'              AN: '.$an.'  Admit :'.$dat;
	   echo '</font>';
	?>
</div>

<div style ="position:absolute; left:5px; top:80px; width:500px; height: 17px;" align="left" >
  <?php 
	   echo '<font size="2" class="font16">';
	   echo 'WARD: '.$ward.'       เตียง: '.$beds;
	   echo '</font>';
	?>
</div>

<div style ="position:absolute; left:5px; top:100px; width:500px; height: 17px;" align="left" >
  <?php 
	   echo '<font size="2" class="font16">';
	   echo 'แพทย์รับ Consult: '.$prec.''.$namec.' '.$surnamec;
	   echo '</font>';
	?>
</div>

<div style ="position:absolute; left:5px; top:120px; width:500px; height: 17px;" align="left" >
  <?php 
	   echo '<font size="2" class="font16">';
	   echo 'กลุ่มงาน : '.$dep.'   วันที่ตอบ : '.$dod.'  '.$dt.'  น.';
	   echo '</font>';
	?>
</div>

<div style ="position:absolute; left:400px; top:120px; width:500px; height: 17px;" align="left" >
  <?php 
	   echo '<font size="2" class="font16">';
	   echo 'Consult NO : '.$con;
	   echo '</font>';
	?>
</div>

</body>



