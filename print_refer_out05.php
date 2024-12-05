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
        $ns1='OPD/IPD :'.$rs['rf_placename'].'  '.' ชื่อ-สกุล ผู้ป่วย.:'.$rs['rf_patients'].   'HN:'.$rs['rf_hn'].' '.' AN:'.$rs['rf_an'].' '.' วันที่เข้ารักษา:'.$rs['rf_serv'];
        $ns2='สิทธิ์การรักษา :'.$rs['pttypename'].' '.' กรุ๊ฟเลือด :'.$rs['rf_blood'].' '.' เพศ :'.$rs['rf_sex'].' '.' อายุ :'.$rs['rf_age'].' '.' เตียง :'.$rs['rf_bed'];
        $ns3='สถานพยาบาลหลัก :'.$rs['hosmain'].'  '.' ที่อยู่ในระบบ HIS.'.$rs['rf_maddress'].'  '.' Email Address:'.$rs['rf_mtel'];
        $ns4='สถานพยาบาลรอง :'.$rs['hossub'].'  '.' ที่อยู่ปัจจุบัน.'.$rs['rf_saddress'].'  '.' โทรศัพท์ :'.$rs['rf_mtel'];
        $ns5='สถานปลายทาง :'.$rs['hossendto_name'].'  '.' ระดับความรุนแรง.'.$rs['rf_hostlevel'].'  '.' ประเภทการส่งต่อ :'.$rs['rf_rfev'];
        $ns6='Refer Out (กลุ่มงาน) :'.$rs['rf_placename'].'  '.' Refer Out (สาขา/โรค/อวัยวะ)'.$rs['indication'].'  '.' Refer Out (โรค/ภาวะ) :'.$rs['rf_rfev'];
        $ns7='BT(c) :'.$rs['bb'].'  '.' SBP (mmHg)'.$rs['bpa'].'  '.' DBP (mmHg) :'.$rs['bpb'].' PR :'.'  '.$rs['pr'].str_repeat(4,2).' O2 sat'.$rs['o2'].'  '.'Pain Score(0-10)'.$rs['pain'];
        $ns7='ประวัติการแพ้ยา :'.$rs['rf_allergy'].'  '.' ประวัติผู้ป่วย:'.$rs['rf_his_patient'].'  '.' ตรวจทางร่างกาย.'.$rs['rf_his_body'].'  '.' ตรวจทางห้องปฎิบัติการ '.$rs['rf_his_lab'];
        $ns8='การรักษาปัจจุบัน :'.$rs['rf_allergy'].'  '.' แผนการรักษา/ข้อมูลปลายทาง:'.$rs['rf_his_patient'].'  '.' การวินิจฉัยโรค'.$rs['rf_exp_takecare'].'  '.' เหตุผลอื่น ๆ'.$rs['rf_icd_free_text'];
        $ns9='การวินิจฉัยโรค (icd10) :'.$rs['rf_allergy'].'  '.' การวินิจฉัยโรค (icd10):'.$rs['rf_his_patient'].'  '.' การวินิจฉัยโรค (icd10)' .$rs['rf_exp_takecare'].'  '.' เหตุผลอื่น ๆ'.$rs['rf_icd_free_text'];
         }
	?>
    <!-- <div style="position:absolute;left:10px;width:6%; top:0px;">
        <img src="print_refer_out02.php?w=http://61.19.25.194/e_nrefer/print_refer_out03.php?id=<?=$id;?>" />
    </div> -->
    <!-- ขอความหัวเรื่อง -->
    <div style="position:absolute;left:30px; top:40px;text-align:center;width:100%;text-align:center;">
        <?php echo '<font style="font-weight: bold;" class="font18h">'; ?>
        <?php echo 'แบบสำหรับส่งต่อผู้ป่วยไปรับการตรวจหรือรักษาต่อ (Referral Information Form)';?>
    </div>

    <!-- จาก-->
    <div style="position:absolute;left:0px; top:140px;width:100%;text-align:center;">
        <?php echo '<font size="2" class="font18h">'; ?>
        <?php echo $ns1;?>
    </div>

    <!-- สถานพยาบาลต้นทาง ปลายทาง -->
    <div class="font16h" style="position:absolute;left:0px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $ns2; ?> </div>

        <?php $pl=$pl+22; ?>
        <div style="position:absolute;left:0px; top:<?=($ln+$pl).'px';?>"
            <?php echo '<font size="2" class="font16h">'; ?> <?php echo $ns3; ?> </div>

            <!-- วันที่ขอ -->
            <?php $pl=$pl+30; ?>
            <div style="position:absolute;left:0px;top:<?=($ln+$pl).'px';?>"
                <?php echo '<font size="2" class="font16h">'; ?> <?php echo $ns4; ?> </div>

                <?php $pl=$pl+25;  ?>
                <div style="position:absolute;left:0px; top:<?=($ln+$pl).'px';?>"
                    <?php echo '<font size="2" class="font16h">'; ?> <?php echo $ns5; ?> </div>

                    <?php $pl=$pl+25; ?>
                    <div style="position:absolute;left:0px; top:<?=($ln+$pl).'px';?>"
                        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $sd121; ?> </div>

                        <!-- ชื่อนามสกุล -->
                        <?php $pl=$pl+30; ?>
                        <div style="position:absolute;left:0px; top:<?=($ln+$pl).'px';?>"
                            <?php echo '<font size="2" class="font16h">'; ?> <?php echo $ns6; ?> </div>

                            <!-- HN -->
                            <!-- <?php $pl=$pl+25;  ?>
    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $h9.'  '. $h91;?> 
    </div> -->

                            <?php $pl=$pl+30;?>
                            <div style="position:absolute;left:0px; top:<?=($ln+$pl).'px';?>"
                                <?php echo '<font size="2" class="font16h">'; ?> <?php echo $hs7; ?> </div>

                                <!-- ที่อยู่ ปัจจุบัน-->
                                <?php $pl=$pl+35; ?>
                                <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
                                    <?php echo '<font size="2" class="font16h">'; ?>
                                    <?php echo 'ที่อยู่ปัจจุบัน (ติดต่อได้):';?> </div>

                                    <?php $pl=$pl+25;?>
                                    <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
                                        <?php echo '<font size="2" class="font16h">'; ?> <?php echo $ns8; ?> </div>

                                        <?php $pl=$pl+25;?>
                                        <div style="position:absolute;left:40px; top:<?=($ln+$pl).'px';?>"
                                            <?php echo '<font size="2" class="font16h">'; ?> <?php echo $ns9; ?> </div>

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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>