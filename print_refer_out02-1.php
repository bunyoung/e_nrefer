<?php
include('phpqrcode/qrlib.php'); 
QRcode::png($_GET['w']);
?>
<?php
	include_once('./vendor/autoload.php');
	include('./db/connection.php');
	ob_start();
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
<html>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<!-- <link rel="stylesheet" href="style.css" /> -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=K2D:wght@200&display=swap" rel="stylesheet">

<head>
    <style>
    body {
        font-family: 'K2D', sans-serif;
        font-weight: 10px;
    }

    .b {
        width: 95%;
        border: 0px solid #000000;
        word-wrap: break-word;
    }

    .table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .font16 {
        /* font-family: "K2D"; */
        font-size: 7pt;
        font-weight: normal;

    }

    .font16h {
        /* font-family: "K2D"; */
        font-size: 15pt;
        font-weight: 40px;
    }

    .font16s {
        /* font-family: "K2D"; */
        font-size: 4pt;
        font-weight: 10px;
    }

    .font16m {
        /* font-family: "K2D"; */
        font-size: 11pt;
        font-weight: normal;
    }

    .font18h {
        /* font-family: "K2D"; */
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
<body>
    <?php	
	$id = null;
    $ln = 200;
    $pl = 0;
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
    $eyy='';$emm='';$edd='';$end_rec_sys='';
	$strSQL ="SELECT * FROM v_rf_print WHERE rf_id = '".$id."' ";
	$result = mysqli_query($conn,$strSQL);
	while($rs = mysqli_fetch_array($result)) 
	{
        //  ส่วนที่ปรับปรุงใหม่
        if($rs['rf_expire_date']<>''){
            $eyy = substr($rs['rf_expire_date'],0,5)+543;
            $emm =substr($rs['rf_expire_date'],5,2);
            $edd =substr($rs['rf_expire_date'],8,2);
            $end_rec_sys = ($edd.'/'.$emm.'/'.$eyy);
        }else{
            $end_rec_sys = '-';
        }
        $hno = $rs["norf"];
        $hs1 ='<b>'.$rs['hosname'].' ('.$rs['rf_hospital'].')</b>';
        $h1 = 'สถานพยาบาลต้นทาง: <b>'.$rs['hosname'].'      ('.$rs['rf_hospital'].')</b>';
		$hd3 = 'สถานพยาบาลปลายทาง:<b> '.$rs['hossendto_name'].'       ('.$rs['rf_hos_send_to'].'</b>)';
        $hd1='วันที่ขอส่งต่อ:<b>'.'   '.$rs['rf_date'].'</b> เวลา: <b>'.$rs['rf_time'].'</b> น.' ;
        $sd12=  'ประเภทส่งต่อ: <b>'.$rs['rfevent'].'</b>' ;
        $sd121='ความเร่งด่วน: <b>'.$rs['rffast'].'</b>';
        $h5 = ' ชื่อ-สกุล ผู้ป่วย:<b>'.$rs['rf_patients'].' </b> เพศ: <b>'.$rs['rf_sex'].'</b>  อายุ: <b>'.$rs['rf_age'].'</b> ปี เลขที่บัตรประชาชน: <b>'.$rs['rf_idcard'].'</b>';
        $h9 = 'HN: '.'<b>'.$rs['rf_hn'].'</b>           AN: <b>'.'    '.$rs['rf_an'].'</b>         OPD/WARD: <b>'.'('.$rs['rf_placecode'].') '.$rs['rf_placename'].'</b>';
        $hd2='        สิทธิ์การรักษา: <b>'.$rs['pttypename'].'</b>';
        $h91='วันนอน รพ./รับบริการ: <b>'.$rs['rf_serv'].'</b>';
        $hd41 = '<b>'.$rs['rf_saddress'].'</b>';
        $hd43 = 'โทรศัพท์:  <b>'.$rs['rf_stel'].'</b>';
        $hd44 = 'Email Address:  <b>'.$rs['rf_mtel'].'</b>';
        $hd19 ='BT:<b>'.$rs['bb]'].'</b>'.'  <font face="Symbol">&#176;</font>C,  BP: <b>'.$rs['bpa'].'/'.$rs['bpb'].'</b>'.' mmHg,   PR: <b>'.$rs['pr'].'</b>'.'/min,
                       RR:<b> '.$rs['rr'].'</b>'.'/min,  O2 sat:<b> '.$rs['o2'].'</b>'.'%,   Pain Score:<b> '.$rs['pain'].'</b>'.'
                       BW:<b>'.$rs['weight_value'].' kg.</b> '.' BH:<b>'.$rs['heigth_value'].' cm.</b>'.' HC:<b> '.$rs['head_value'].' cm.</b>' ;
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
        $hd11 = '<b> '.$rs['rf_icd_free_text'].'</b>';
		$hd121='<b> 1. '.$rs['descicda'].'</b><br>';
        $hd122='<b> 2. '.$rs['descicdb'].'</b><br>';
        $hd123='<b> 3. '.$rs['descicdc'].'</b><br>';
        $hd124='ใช้สิทธิ :<b>'.$rs['pttype_name'].'</b><br>';
        $hd125='เรียกเก็บเงินไปที่ :<b>  '.$rs['pay_hosp_name'].'</b><br>';
        $hd126='วันหมดอายุ : <b>'.$end_rec_sys.'</b><br>';
        $hd127='RF.NO: (ThaiRefer) : <b>'.$rs['rf_no_thairefer'].'</b><br>';
        }
	?>
    <div style="position:absolute;left:10px;width:6%; top:0px;">
        <img src="print_refer_out02.php?w=http://61.19.25.194/e_nrefer/print_refer_out03.php?id=<?=$id;?>" />
    </div>
    <div
        style="position:absolute;left:15px;width:5%; top:120px; background-color:#263238;color:#E1F5FE;text-align:center;">
        <?php echo ' E-Refer From '.'<font style="font-weight: bold;" class="font18h">'; ?>
    </div>
    <div style="position:absolute;left:20px;width:95%; top:10px;color:#E1F5FE;text-align:right;font-weight:bold;">
        <img src="barcode39.php?barcode=<?php echo $hno.'&width=600px&height=50px';?>" />
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
    <div class="font16h" style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $h1; ?>
    </div>

    <?php $pl=$pl+22; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $hd3; ?> </div>

    <!-- วันที่ขอ -->
    <?php $pl=$pl+30; ?>
    <div style="position:absolute;left:550px;top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $hd1; ?> </div>

    <?php $pl=$pl+25;  ?>
    <div style="position:absolute;left:550px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $sd12; ?> </div>

    <?php $pl=$pl+25; ?>
    <div style="position:absolute;left:550px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $sd121; ?> </div>

    <!-- ชื่อนามสกุล -->
    <?php $pl=$pl+30; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $h5; ?>
    </div>

    <!-- HN -->
    <?php $pl=$pl+25;  ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $h9.'  '. $h91;?>
    </div>

    <?php $pl=$pl+30;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $hd2; ?>
    </div>

    <!-- ที่อยู่ ปัจจุบัน-->
    <?php $pl=$pl+35; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'ที่อยู่ปัจจุบัน (ติดต่อได้):';?>
    </div>

    <?php $pl=$pl+40;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $hd41; ?> </div>

    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $hd43; ?>
    </div>
    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd44; ?>
    </div>

    <!-- เพิ่มรายการวัดไข้ -->
    <?php $pl=$pl+35;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd19; ?>
    </div>

    <!-- ประวัติการแพ้ยา-->
    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd5; ?>
    </div>

    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd51; ?>
    </div>

    <!-- ประวัติผู้ป่วยปัจจุบัน-->
    <?php $pl=$pl+70;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'ประวัติผู้ป่วยปัจจุบัน  : '; ?> </div>
    <?php $pl=$pl+25; ?>
    <div class="b" style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd6; ?>
    </div>

    <?php $pl=$pl+150;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'ตรวจร่างกาย'; ?>
    </div>

    <?php $pl=$pl+25;?>
    <div class="b" style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd7; ?>
    </div>

    <?php $pl=$pl+120;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'การตรวจทางห้องปฏิบัติการ/รังสี/อื่น ๆ :'; ?>
    </div>

    <?php $pl=$pl+25;  ?>
    <div class="b" style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd8; ?>
    </div>
    <!--  -->
    <?php $pl=$pl+100;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo '</b>การวินิจฉัยระบุเอง :'; ?>
    </div>

    <?php $pl=$pl+25; ?>
    <div class="b" style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd11; ?>
    </div>
    <!--  -->
    <?php $pl=$pl+80;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'การวินิจฉัย (ICD10) :'; ?>
    </div>
    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd121; '<br>'?>
        <?php echo $hd122; '<br>'?>
        <?php echo $hd123; '<br>'?>
    </div>
    <!--  -->
    <?php $pl=$pl+120; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo '</b></b>การรักษาปัจจุบัน:'; ?>
    </div>

    <?php $pl=$pl+25;?>
    <div class="b" style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd9; '<br>'?>
    </div>
    <!--  -->
    <?php $pl=$pl+50;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'แผนการรักษาแจ้งปลายทาง:'; ?>
    </div>

    <?php $pl=$pl+25;?>
    <div class="b" style="position:absolute;left:60px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo $hd10; '<br>'?>
    </div>

    <?php $pl=$pl+50; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">'; ?>
        <?php echo 'ชื่อแพทย์ผู้ส่ง:  '.$hd18; ?> </div>
    <!--  -->
    <?php $pl=$pl+25;?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">' ?> <?php echo 'ชื่อแพทย์เจ้าของไข้:  ' .$hd16; ?> </div>
    <!--  -->
    <?php $pl=$pl+25; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16h">' ?> <?php echo 'กลุ่มงานส่งต่อ:  '.$hd17; ?> </div>
    <!-- สุดท้าย -->
    <?php $pl=$pl+180; ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>">
        <?php echo '<font size="2" class="font16m">'; ?> <table style="width:100%;">
            <tr>
                <td>
                    <?php echo '<font size="2" class="font16m">'; ?>
                    <table style="border: 1px solid;font-size:16px;">
                        <tr>
                            <td style="width:100%;">
                                <?php echo '<font size="2" class="font16m">'; ?>
                                <?php echo $hd124;?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo '<font size="2" class="font16m">'; ?>
                                <?php echo $hd125;?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo '<font size="2" class="font16m">'; ?>
                                <?php echo $hd126;?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo '<font size="2" class="font16m">'; ?>
                                <?php echo $hd127;?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <?php $pl=$pl+35;  ?>
    <div style="position:absolute;left:450px;width:30%; top:1700px;">
        <!-- <img src="print_refer_out02.php?w=http://61.19.25.194/e_nrefer/print_refer_out01.php?sid=<?=$id;?>" /> -->
        <img
            src="print_refer_out02.php?w=http://61.19.25.194/e_nrefer/sys_hycall_send_receive_mbile.php?sid=<?=$id;?>" />
    </div>
    <div style="position:absolute;left:465px;width:20%; top:1815px;">
        <?php echo 'สแกนยืนยันรับ' .'<font size="1" class="font16" style="text-align:center;">' ?>
    </div>

    <?php $pl=$pl;?>
    <div style="position:absolute;left:700px; width:30%;top:<?=($ln+$pl).'px';?>">
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