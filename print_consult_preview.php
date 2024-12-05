<?php
include('phpqrcode/qrlib.php'); 
QRcode::png($_GET['w']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('vendor/autoload.php');
	include('db/connection.php');
	ob_start();
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<link rel="stylesheet" href="style.css" />

<head>
    <style>
    body {
        font-family: "TH sarabun New", sans-serif;
        font-size: 22px;
    }
    </style>
    <style>
    .center {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    .left {
        text-align: left;
    }

    .div {
        width: 100%;
    }
    </style>
</head>

<body>
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
        // $ewb= ereg_replace('[[:space:]]+','',($rs['cons_id'])); 
		$h1 = $rs["cons_date"];
		$h2 = $rs["cons_time"];
		$mh=$rs['m_depname'];
		$sh=$rs['s_ename']; 
		$no         =$rs['mcode'].'-'.$rs['cons_id'];
		$doctor =$rs['prec'].''.$rs['namec'].'   '.$rs['surnamec'];
		$hn         =$rs['hn'];
        $an         = $rs['an'];
        $na         = $rs['pname'];
		$old       = $rs['age'];
        $sex      =$rs['sex'];
        $ward    =$rs['places'];
        $bed = $rs['beds'];
        $dateadm=$rs['date_admit'];
		$heatha1 =$rs["a1"];
		$heathb1 ='-'.$rs["a2"];
		$takecar2='-'.$rs['a3'];
		$expre1='-'.$rs['exp'];
		// $icd='การวินิจฉัยโรค : ';
		$icd1='-'.$rs['icd_desca'].','.$rs['icd_descb'].','.$rs['icd_descc'];
		// $icd3='การวินิจฉัยโรค (ระบุเอง) :';
		$icd4='-'.$rs['ftext'];
		$dconm=$rs['prea'].''.$rs['namea'].' '.$rs['surnamea'];
		$dcons=$rs['preb'].''.$rs['nameb'].' '.$rs['surnameb'];
		$dtext='สรุปผลตรวจ / ข้อแนะนำ';
		$dftext='-'.$rs["comment"];
		$doctor=$rs['prec'].''.$rs['namec'].'  '.$rs['surnamec'];
		$headf='ชื่อ-สกุลแพทย์ผู้รับปรึกษา :'.$rs['prec'].''.$rs['namec'].'   '.$rs['surnamec'].'  วันที่ :'.$rs['doc_date'].' เวลา :'.$rs['doc_time'].' น.';
		$headd='วันที่ :'.$rs['doc_date'].' เวลา :'.$rs['doc_time'].' น.';
	}
	?>
    <div class="container">
        <table class="table-responsive" width="100%" align="center" style='border: 0.5px solid;border-collapse: collapse; padding-left:20px;
              font-family: "sarabun", sans-serif; font-size: 23px;font-weight:bold;padding: 0rem;margin-top:0px;'>
            <!-- <br>
            <caption style="font-size: 22px;font-weight:300;padding: 0rem;">โรงพยาบาลหาดใหญ่</caption> -->
            <tr>
                <table width="100%" align="center" style='border: 0px solid; padding-left:60px;
                                      font-family: "Thasadith", sans-serif;font-size: 20px;padding:1px;'>
                    <tr>
                        <td width="10%"><img src="img/logo.png" style="width:60px;height:60px;"></td>
                        <td
                            style="font-family: Thasadith;font-size: 22px;font-weight:300;padding: 0rem; text-align:center;">
                            ใบปรึกษาระหว่างแผนก <br>โรงพยาบาลหาดใหญ่</td>
                        <td width="10%"><img src="img/hy.png" style="width:60px;height:60px;"></td>
                    </tr>
                    <tr>
                    <td  colspan="6" style="BORDER-BOTTOM: #999999 2px solid"></td>
                    </tr>
                    <tr>
                        <td colspan="6">รหัสเอกสาร
                            :<b><?php  echo  $no; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo "วันที่ขอ : <b>$h1 </b>   เวลา : <b>$h2 </b>น."; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td  colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <b>รายละเอียดเกี่ยวกับผู้ป่วย.-</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><?php  echo  "HN :<b> $hn</b> AN : <b> $an </b> ชื่อ-สกุล :<b> $na" ?></b> </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <?php  echo "อายุ : <b> $old </b>ปี เพศ : <b> $sex"; ?></b><?php  echo " หอผู้ป่วย : <b> $ward </b>  เตียง :<b>$bed </b> วันที่นอนโรงพยาบาล : <b> $dateadm </b> ";?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <?php  echo "กลุ่มงานที่จะปรึกษา :  <b>$mh   </b>   สาขา/หน่วยงาน : <b>$sh"; ?></b>
                        </td>
                    </tr>
                    <tr>
                    <td  colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                    </tr>

                    <tr>
                        <td colspan="6">ประวัติและการตรวจร่างกาย </td>
                    </tr>
                    <tr>
                        <td colspan="6"><b> <?php  echo $heatha1 ;?></b> </td>
                    </tr>
                    <tr>
                    <td  colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                    </tr>
                    <tr>
                        <td colspan="6">ผลการตรวจทางห้องปฏิบัติการและการตรวจพิเศษ : </td>
                    </tr>
                    <tr>
                        <td colspan="6"><b><?php  echo $heathb1 ;?></b></td>
                    </tr>
                    <tr>
                    <td  colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                    </tr>

                    <tr>
                        <td colspan="6">การรักษาปัจจุบัน : </td>
                    </tr>
                    <tr>
                        <td colspan="6"><b> <?php  echo $takecar2 ;?></b> </td>
                    </tr>
                    <tr>
                        <td colspan="6">จุดประสงค์ในการปรึกษาครั้งนี้ : </td>
                    </tr>
                    <tr>
                        <td colspan="6"><b> <?php  echo $expre1 ;?> </td>
                    </tr>
                    <tr>
                    <td  colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                    </tr>

                    <tr>
                        <td colspan="6">การวินิจฉัยโรค : </td>
                    </tr>
                    <tr>
                        <td colspan="6"><b> <?php  echo $icd1 ;?></b></td>
                    </tr>
                    <tr>
                    <td  colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                    </tr>

                    <tr>
                        <td colspan="6">การวินิจฉัยโรค (ระบุเอง) :</td>
                    </tr>
                    <tr>
                        <td colspan="6"><b><?php  echo $icd4 ;?></b></td>
                    </tr>
                    <tr>
                    <td  colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                    </tr>

                    <tr>
                        <td colspan="6">ชื่อ-สกุลแพทย์ผู้ปรึกษา : </td>
                    </tr>
                    <tr>
                        <td colspan="6"><b><?php  echo $dconm ;?></b></td>
                    </tr>
                    <tr>
                        <td colspan="6"><br></td>
                    </tr>
                    <tr>
                        <td colspan="6">ชื่อ-สกุลอาจารย์แพทย์ผู้รับผิดชอบ : </td>
                    </tr>
                    <tr>
                        <td colspan="6"><b> <?php  echo $dcons ;?></td>
                    </tr>
                </table>
                <br>
                <table width="100%" align="center" style='border:px solid; padding-left:60px;
                                      font-family: "Thasadith", sans-serif;font-size: 20px;padding:1px;'>
                    <tr>
                        <td>
                            <center><strong>บันทึกการรับปรึกษา</strong></center>
                        </td>
                    </tr>
                    <tr>
                    <td  colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                    </tr>
                    <tr>
                        <td><b> <?php echo $dtext; ?> </b></td>
                    </tr>
                    <tr>
                        <td><b>
                                <?php echo $dftext; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>
                                <?php echo $headf; ?><b>
                        </td>
                    </tr>
                    <tr>
                    <td  colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                    </tr>
                    <tr>
                        <td>
                        <img
                                src="print_consult_a4.php?w=http://61.19.25.203/e_consult/print_consult_a4.php?id=<?=$id;?>" />
                        </td>
                    </tr>
                </table>
            </tr>
        </table>
    </div>
</body>

</html>