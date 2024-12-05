<?php
include('phpqrcode/qrlib.php'); 
QRcode::png($_GET['w']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include_once('vendor/autoload.php');
	include('./db/connection.php');
	ob_start();
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<link rel="stylesheet" href="style.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Thasadith&display=swap" rel="stylesheet">

<head>
    <style>
    body {
        font-family: 'Thasadith', sans-serif;
        font-weight: 10px;
    }

    .table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .font16 {
        /* font-family: "Thasadith"; */
        font-size: 7pt;
        font-weight: normal;

    }

    .font16h {
        /* font-family: "Thasadith"; */
        font-size: 15pt;
        font-weight: 40px;
    }

    .font16s {
        /* font-family: "Thasadith"; */
        font-size: 4pt;
        font-weight: 10px;
    }

    .font16m {
        /* font-family: "Thasadith"; */
        font-size: 11pt;
        font-weight: normal;
    }

    .font18h {
        /* font-family: "Thasadith"; */
        font-size: 16pt;
        font-weight: normal;
        /* font-weight: bold; */
    }

    img.barcode {
        border: 0px solid #ccc;
        padding: 0px 0px;
        border-radius: 0px;
    }

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

<!-- <body  onLoad="window.print(); setTimeout(window.close, 0);"> -->

<body>
    <?php	
	$id = null;
    $ln = 200;
    $pl = 0;
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
	$strSQL ="SELECT * FROM v_rf_print WHERE rf_id = '".$id."' ";
	$result = mysqli_query($conn,$strSQL);
	while($rs = mysqli_fetch_array($result)) 
	{
        //  ส่วนที่ปรับปรุงใหม่
        $hno = $rs["norf"];
        $hs1 ='<b>'.$rs['hosname'].' ('.$rs['rf_hospital'].')</b>';
        $h1 = 'สถานพยาบาลต้นทาง: <b>'.$rs['hosname'].'      ('.$rs['rf_hospital'].')</b>';
		$hd3 = 'สถานพยาบาลปลายทาง:<b> '.$rs['hossendto_name'].'       ('.$rs['rf_hos_send_to'].'</b>)';
        $hd1='วันที่ขอส่งต่อ:<b>'.'   '.$rs['rf_date'].'</b> เวลา: <b>'.$rs['rf_time'].'</b> น.' ;
        $sd12=  'ประเภทส่งต่อ: <b>'.$rs['rfevent'].'</b>' ;
        $sd121='ความเร่งด่วน: '.$rs['rffast'];
        $h5 = ' ชื่อ-สกุล ผู้ป่วย:<b>'.$rs['rf_patients'].' </b> เพศ: <b>'.$rs['rf_sex'].'</b>  อาย: <b>'.$rs['rf_age'].'</b> ปี เลขที่บัตรประชาชน: <b>'.$rs['rf_idcard'].'</b>';
        $h9 = 'HN: '.'<b>'.$rs['rf_hn'].'</b>           AN: <b>'.'    '.$rs['rf_an'].'</b>         OPD/WARD: <b>'.'('.$rs['rf_placecode'].') '.$rs['rf_placename'].'</b>';
        $hd2='        สิทธิ์การรักษา: <b>'.$rs['pttypename'].'</b>';
        $h91='วันนอน รพ./รับบริการ: <b>'.$rs['rf_serv'].'</b>';
        $hd41 = '<b>'.$rs['rf_saddress'].'</b>';
        $hd43 = 'โทรศัพท์:  <b>'.$rs['rf_stel'].'</b>';
        $hd19 ='BT:<b>'.$rs['bb]'].'</b>'.'  <font face="Symbol">&#176;</font>C,  BP: <b>'.$rs['bpa'].'/'.$rs['bpb'].'</b>'.' mmHg,   PR: <b>'.$rs['pr'].'</b>'.'/min,
                       RR:<b> '.$rs['rr'].'</b>'.'/min,  O2 sat:<b> '.$rs['o2'].'</b>'.'%,   Pain Score:<b> '.$rs['pain'].'</b>';
        $hd5 = 'ประวัติการแพ้ยา';
        $hd51= '<b>'.$rs['rf_allergy'].'</b>';
        $hd6 = '<b>'.$rs['rf_his_patient'].'</b>';
        $hd7 = '<b>'.$rs['rf_his_body'].'</b>';
		$hd8 = '<b>'.$rs['rf_his_lab'].'</b>';
		$hd9 = '<b> '.$rs['rf_his_takecare_now'].'</b>';
		$hd10 = '<b>'.$rs['rf_exp_takecare_hosp_end'].'</b>';
        $hd18 = '<b>'.$rs['docsend_prename'].$rs['docsend_name'].'  '.$rs['docsend_surname'].'  (ว. '.$rs['docsend_code'].')</b>';
        $hd16 = '<b>'.$rs['docme_prename'].$rs['docme_name'].'  '.$rs['docme_surname'].'  (ว. '.$rs['docme_code'].')</b>';
        $hd17 = '<b>'.$rs['m_depname'].' ('.$rs['m_code'].') </b>';
        $hd121='<b> 1. '.$rs['icd10a'].'<br>';
        $hd122='<b> 2. '.$rs['icd10b'].'<br>';
        $hd123='<b> 3.'.$rs['icd10c'].'</b>';
        }
	?>
    <div style="position:absolute;left:10px;width:6%; top:0px;">
        <img src="print_refer_out02.php?w=http://61.19.25.194/e_nrefer/print_refer_out03.php?id=<?=$id;?>" />
    </div>
    <div
        style="position:absolute;left:15px;width:10%; top:120px; background-color:#263238;color:#E1F5FE;text-align:center;">
        <?php echo ' E-Refer Receive '.'<font style="font-weight: bold;" class="font18h">'; ?>
    </div>
    <div style="position:absolute;left:20px;width:95%; top:10px;color:#E1F5FE;text-align:right;font-weight:bold;">
        <img src="barcode39.php?barcode=<?php echo $hno.'&width=630px&height=50px';?>" />
    </div>

    <!-- ขอความหัวเรื่อง -->
    <div style="position:absolute;left:30px; top:110px;text-align:center;width:100%;text-align:center;">
        <?php echo '<font style="font-weight: bold;" class="font18h">'; ?>
        <?php echo 'แบบสำหรับส่งต่อผู้ป่วยไปรับการตรวจหรือรักษาต่อ (Referral Information Form)';?>
    </div>

    <!-- จาก-->
    <div style="position:absolute;left:20px; top:140px;text-align:center;width:100%;text-align:center;">
        <?php echo '<font size="2" class="font18h">'; ?>
        <?php echo $hs1;?>
    </div>

    <!-- สถานพยาบาลต้นทาง ปลายทาง -->
    <div class="font16h" style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>" 
        <?php echo '<font size="2" class="font16h">'; ?> 
        <?php echo $h1; ?>
    </div>

    <?php $pl=$pl+22; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?> 
        <?php echo $hd3; ?> 
    </div>

    <!-- วันที่ขอ -->
    <?php $pl=$pl+30; ?> 
    <div style="position:absolute;left:550px;top:<?=($ln+$pl).'px';?>"
          <?php echo '<font size="2" class="font16h">'; ?> <?php echo $hd1; ?>
    </div>

    <?php $pl=$pl+25;  ?>
    <div style="position:absolute;left:550px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $sd12; ?> 
    </div>

    <?php $pl=$pl+25; ?>
    <div style="position:absolute;left:550px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $sd121; ?> 
    </div>

    <!-- ชื่อนามสกุล -->
    <?php $pl=$pl+30; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $h5; ?> 
    </div>
    
    <!-- HN -->
    <?php $pl=$pl+25;  ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $h9.'  '. $h91;?> 
    </div>

    <?php $pl=$pl+30;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $hd2; ?> 
    </div>

    <!-- ที่อยู่ ปัจจุบัน-->
    <?php $pl=$pl+35; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'ที่อยู่ปัจจุบัน (ติดต่อได้):';?> 
    </div>

    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd41; ?> 
    </div>

    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd43; ?> 
    </div>
    
    <!-- เพิ่มรายการวัดไข้ -->
    <?php $pl=$pl+35;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd19; ?> 
    </div>
    
   <!-- ประวัติการแพ้ยา-->
   <?php $pl=$pl+25;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd5; ?> 
    </div>

    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd51; ?> 
    </div>
    
    <!-- ประวัติผู้ป่วยปัจจุบัน-->
     <?php $pl=$pl+50;
    ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'ประวัติผู้ป่วยปัจจุบัน  : '; ?>
    </div>
    <?php $pl=$pl+25; ?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd6; ?> 
    </div>

    <?php $pl=$pl+50;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'ตรวจร่างกาย'; ?> 
    </div>

    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd7; ?> 
    </div>

   <?php $pl=$pl+100;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'การตรวจทางห้องปฏิบัติการ/รังสี/อื่น ๆ :'; ?>
    </div>

    <?php $pl=$pl+25;  ?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd8; ?>
    </div>
    <!--  -->
    <?php $pl=$pl+60;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'การวินิจฉัยระบุเอง :'; ?>
    </div>

    <?php $pl=$pl+25; ?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd11; ?>
    </div>
    <!--  -->
    <?php $pl=$pl+60;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'การวินิจฉัย (ICD10) :'; ?>
    </div>
    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd121; '<br>'?>
        <?php echo $hd122; '<br>'?>
        <?php echo $hd123; '<br>'?>
    </div>
    <!--  -->
    <?php $pl=$pl+80; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'การรักษาปัจจุบัน:'; ?>
    </div>

    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd9; '<br>'?>
    </div>
    <!--  -->
    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'แผนการรักษาแจ้งปลายทาง:'; ?>
    </div>

    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd10; '<br>'?>
    </div>
    
    <?php $pl=$pl+25; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'ชื่อแพทย์ผู้ส่ง:  '.$hd18; ?>
    </div>
        <!--  -->
    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">' ?>
        <?php echo 'ชื่อแพทย์เจ้าของไข้:  ' .$hd16; ?>
    </div>
        <!--  -->
    <?php $pl=$pl+25; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">' ?>
        <?php echo 'กลุ่มงานส่งต่อ:  '.$hd17; ?>
    </div>
    <!-- สุดท้าย -->
    <?php $pl=$pl+35; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
      <?php echo '<font size="2" class="font16m">'; ?>
            <table style="width:100%;">
            <tr>
                <td>
                    <?php echo '<font size="2" class="font16m">'; ?>
                    <table
                        style="border: 1px solid;font-size:16px;">
                        <tr>
                            <td style="width:100%;">
                              <?php echo '<font size="2" class="font16m">'; ?>
                                ใช้สิทธิ.....................................................
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo '<font size="2" class="font16m">'; ?>
                                เรียกเก็บเงินไป......................................
                            </td>
                        </tr>
                        <tr>
                            <td>
                                วันหมดอายุ
                                OPD..................................
                            </td>
                        </tr>
                        <tr>
                            <td>
                                วันหมดอายุ
                                IPD..................................
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            </table>
        </div>

        <?php $pl=$pl+25;?>
        <div style="position:absolute;left:700px; width:30%;top:<?=($ln+$pl).'px';?>"
            <br>
            <?php echo '<font size="2" class="font16m">'; ?>
            <?php echo '<b>'.'ลงชื่อ .............................................................'.'</b>'; ?>
            <br>
            <?php echo '<font size="2" class="font18m">'; ?>
            <?php echo '('.$hd18 ?>
            <br>
            <?php echo '<font size="2" class="font16m">'; ?>
            <?php echo date("d-m-Y"); ?>
        </div>
</body>

</html>