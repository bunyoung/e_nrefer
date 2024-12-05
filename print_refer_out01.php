<?php
// include('phpqrcode/qrlib.php'); 
// QRcode::png($_GET['w']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	// include('main_script.php');
    include_once('./vendor/autoload.php');
    // include_once('./vendor/autoload.php');
	include('./db/connection.php');
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
        font-family: "TH K2D New", sans-serif;
        font-size: 18px;
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
<?php	
	$id = null;
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
	if(isset($_GET["hos"]))
	{
		$hp = $_GET["hos"];
	}
?>
<?php
$location='';
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = 'temp/';
    include("./phpqrcode/qrlib.php");  

    $errorCorrectionLevel = 'M';  
    $matrixPointSize = 2;
    $data="http://61.19.25.194/e_nrefer/print_refer_out03.php?id=".$id;
    $filename = $PNG_TEMP_DIR.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';   
    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize,2);    
?>

<body>
    <?php	
	$strSQL ="SELECT * FROM v_rf_print WHERE rf_id = '".$id."' ";
	$result = mysqli_query($conn,$strSQL);
	while($rs = mysqli_fetch_array($result)) 
	{
		$d1 = $rs['docsend_prename'].''.$rs['docsend_name'].'   '.$rs['docsend_surname'];
		$d2 = $rs['docme_prename'].''.$rs['docme_name'].'   '.$rs['docme_surname'];
        $opdipd = $rs['rf_opdipd'];
		$hno = $rs["norf"];
        $norf=$rs['rf_hos_send_to'];
		$h1 = '<b>'.$rs["hosname"].'</b>';
		$h2 = '<b>'.$rs["rf_date"].'</b>';
		$h3 = '<b>'.$rs['rf_time'].'</b>  น.';
		$h4 = '<b>'.$rs['m_depname'].'</b>'; 
		$h5 = '<b>'.$rs['rf_patients'].'</b>';
		$h6 = '<b>'.$rs['rf_age'].'</b>';
		$h7 = '<b>'.$rs['rf_idcard'].'</b>';
        $h8 = '<b>'.$rs['rf_serv'].'</b>';
        $h9 = '<b>'.$rs['pname'].'</b>';
		$h10='<b>'.$rs['icd10a'].'.'.$rs['icd10b'].','.$rs['icd10c'].'</b>';
        $h11='<b>'.$rs['indication'].'</b>';
        $h12='<b>'.$rs['rf_his_patient'].'</b>';
        $g1='<b>'.$rs['rfevent'].' </b>';
        $g2='<b>'.$rs['rffast'].'</b>';
        $g4='<b>'.$rs['rf_placename'].'   ('.$rs['rf_placecode'].')</b>';
        $g5='<b>'.$rs['sindication_name'].'</b>';
        $g6='<b>'.$rs['rf_comment_takecare_hosp_end'].'</b>';
        $g7='<b>'.$rs['rf_patients'].'</b>';
        $g9='<b>'.$rs['rf_hn'].'  AN :'.$rs['rf_an'].'</b>';
        $g10='<b>'.$rs['rf_bedno'].'</b>';
        $g11='<b>'.$rs['rf_age'].'</b>';
        $g12='<b>'.$rs['rf_sex'].'</b>';
        $g13='<b>'.$rs['pttypename'].'</b>';
        $g14='<b>'.$rs['hosmain'].'</b>';
        $g15='<b>'.$rs['hossub'].'</b>';
        $g16='<b>'.$rs['docsend_prename'].''.$rs['docsend_name'].' '.$rs['docsend_surname'].'   (ว. '.$rs['docsend_code'].')</b>';
        $g17='<b>'.$rs['docme_prename'].''.$rs['docme_name'].' '.$rs['docme_surname'].'  (ว. '.$rs['docme_code'].')</b>';
        $g18='<b>'.$rs['m_depname'].'</b>';
        $rshp = '<b>'.$rs['hosname'].'</b>';
        $rsst = '<b>'.$rs['hossendto_name'].'</b>';
        $rtdate =date("d-m-Y").'  '.date("H:i:s");
        $hd41 = '<b>'.$rs['rf_saddress'].'</b>';
        $hmtel = '<b>'.$rs['rf_mtel'].'</b>';
        $hd43 = 'โทรศัพท์:  <b>'.$rs['rf_stel'].'</b>';
        $hrd_1 = '<b>'.$rs['hosp_recive_date'].'</b>';
        $hrt_1 = '<b>'.$rs['hosp_recive_time'].'</b>'.' น.';
        $refer_no = $rs['rf_no_thairefer'];
        // ปรับวันที่
        $expy='';$exp='';
        if($rs['rf_expire_date']<>''){
            $expy=substr($rs['rf_expire_date'],0,4) + 543;
            $exp=substr($rs['rf_expire_date'],8,2).'/'.substr($rs['rf_expire_date'],5,2).'/'.$expy;   
        }
        $exu='';$exuy='';
        if($rs['sento_hos_date']<>''){
            $exuy=substr($rs['sento_hos_date'],6,4) + 543;
            $exu=substr($rs['sento_hos_date'],0,2).'/'.substr($rs['sento_hos_date'],3,2).'/'.$exuy;    
        }
        $hrt_2 = '<b>'.$rs['sento_hos_time'].'</b>';
        $hrd_3 = '<b>'.$rs['end_rec_date'].'</b>';
        $hrt_3 = '<b>'.$rs['end_rec_time'].'</b>';
        $prt_exp ='วันที่หมดอายุ : '.'<b>'.$exp.'</b>' ;
        $prt_upd ='วันที่ตรวจสอบล่าสุด : '.'<b>'.$exu.'</b>'.'  เวลา : '.'<b>'.$rs['sento_hos_time'].'</b> น.' ;

        $prtype ='สิทธิ์การรักษาเรียกเก็บ : '.'<b>'.$rs['pttype_name'].'</b>' ;
        $prthosp ='เรียกเก็บเงินที่ : '.'<b>'.$rs['pay_hosp_name'].'</b>' ;
        
        $ind='<b>'.$rs['departname'].'</b>';
        $sind='<b>'.$rs['indication'].'</b>';
        $mind='<b>'.$rs['sindication_name'].'</b>';
        $allergy = '<b>'.$rs['rf_allergy'].'</b>';
        $location = $rs['rf_location'];
        $lodata=$location;   
        $filenamea = $PNG_TEMP_DIR.md5($lodata.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';   
        QRcode::png($lodata, $filenamea, $errorCorrectionLevel, $matrixPointSize,2);    
    
        $pry='';
        $pryall='';
        if($rs['sento_hos_date'] <> ''){
            $pry = substr($rs['sento_hos_date'],6,4)+543;
            $pryall =  substr($rs['sento_hos_date'],0,2).'/'.substr($rs['sento_hos_date'],3,2).'/'.$pry;   
        }
	}
	?>
    <div class="container">
        <table class="table-responsive" width="80%" align="center"
            style='border: 1px solid; padding-left:20px;
                                    font-family: "K2D";font-size: 18px;font-weight:bold;padding: 0rem;margin-top:0px;border:0px;'>

            <tr>
                <table width="100%" align="center" style='border: 0px solid; padding-left:60px;
                                      font-family: "K2D";font-size: 16px;padding:1px;'>
                    <tr>
                        <td>
                            <center>
                                <img src="./img/logo/logo.png" alt="hy" style="widht:120px;height:120px;">
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family:K2D; font-size: 18px;
                                          color:#006064;font-weight:bold;padding: 2rem; text-align:center;">
                            ใบแสดงข้อมูลส่งต่อผู้ป่วย <br> (Referral Information Sheet)
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td colspan="6" style="font-size:20px;"><?php echo 'Refer No : '. $hno; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'ต้นทาง :  '.$rshp; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'ปลายทาง : '.$rsst; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'หน่วยงานทางคลินิคที่ส่งต่อ : '.$ind; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'สาขา/หน่วยงาน: '.$sind; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'โรค/ภาวะ/วินิจฉัย/การรักษาเฉพาะ : '.$mind; ?>
                        </td>
                    </tr>

                    <!-- <tr>
                            <td>
                                <div style="width:100%; top:0px;text-align:center;">
                                    <img
                                        src="print_refer_out02.php?w=http://61.19.25.194/e_nrefer/print_refer_out03.php?id=<?=$id;?>" />
                                </div>
                            </td>
                        </tr> -->
                    <tr>
                        <td colspan="6">
                            <?php echo 'วันที่ขอส่งต่อ:  '.$h2.'   เวลา :  '.$h3;?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <?php echo 'วันที่ปลายทางตอบรับ:  '.$hrd_1.'   เวลา :  '.$hrt_1;?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <?php echo 'วันที่ส่งผู้ป่วยออก:  '.'<b>'.$pryall.'</b>'.' เวลา :  '.'<b>'.$hrt_2.'</b>'.'  น.';?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <?php echo 'วันที่ผู้ป่วยถึงปลายทาง:  '.$hrd_3.'   เวลา :  '.$hrt_3;?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?php echo 'ประเภท :  '.$g1;?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'ประเภทผู้ป่วย (ความเร่งด่วน) :  '.$g2; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'RF.NO: (ThaiRefer) : <b>'.$refer_no; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="BORDER-BOTTOM: #999999 4px dotted"></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'ประวัติแพ้ยา :  '.$allergy; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="BORDER-BOTTOM: #999999 4px dotted"></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <?php echo 'ชื่อ-นามสกุล ผู้ป่วย : '.$g7;?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo 'อายุ : '.$g11.'  ปี  เพศ :  '.$g12; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo 'สิทธิ์การรักษา :  '.$g13;?></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <?php echo 'HN:  '.$g9; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'หน่วยบริการ : '.$g4; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'สถานพยาบาลหลัก : '.$g14; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'สถานพยาบาลรอง : '.$g15; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'ที่อยู่ปัจจุบัน : '.$hd41; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'Email Address  : '.$hmtel; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $hd43; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="BORDER-BOTTOM: #999999 4px dotted"></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><?php echo $prtype; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $prthosp; ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo  $prt_upd; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="BORDER-BOTTOM: #999999 4px dotted"></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><?php echo 'แพทย์ผู้ส่ง :  '.$g16;?></td>
                    </tr>
                    <tr>
                        <td><?php echo 'แพทย์เจ้าของไข้ :  '.$g17;?></td>
                    </tr>
                    <tr>
                        <td>
                            กลุ่มงาน:<?php echo $g18;?>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="BORDER-BOTTOM: #999999 4px dotted"></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo 'เมื่อผู้ป่วยถึงสถานพยาบาลปลายทางแล้ว ผู้ป่วย/ญาติ/เจ้าหน้าที่กรุณา SCAN QR code นี้เพื่อยืนยันถึงปลายทาง';?>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <div style="width:100%; top:0px;text-align:center;">
                                    <?php echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" style="width:115px;height:115px;" />';  ?>
                                </div>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                ท่านสามารถติดต่อศูนย์บริหารจัดการส่งต่อผู้ป่วย โรงพยาบาลหาดใหญ่ (HY-RMC) ผ่านทาง
                                LINE Official ข้างล่างนี้ครับ <br>
                                เบอร์ติดต่อศูนย์โดยตรง: 074-273-100 ต่อ 2108,5433  <br>
                                Email : refer.hy@hatyaihospital.go.th
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <div style="width:100%; top:0px;text-align:center;">
                                    <img src="./img/lineall.JPG" style="width: 115px;" />
                                </div>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <b> ท่านสามารถ SCAN QR CODE เพื่อหาตำแหน่งบ้านผู้ป่วยปัจจุบัน</b>
                                <?php
                                    IF($location <>'')
                                    { ?>
                                <br>
                                <div style="width:100%; top:0px;text-align:center;">
                                    <?php echo '<img src="'.$PNG_WEB_DIR.basename($filenamea).'" style="width:115px;height:115px;" />';  ?>

                                    <!-- <img src="print_refer_out01.php?w=<?=$location;?>"
                                        style="width:130px;height:130px;"> -->
                                </div>
                                <?php
                                    }else{?>
                                <br><br>
                                ไม่มีตำแหน่งบ้านผู้ป่วยปัจจุบันในระบบ
                                <?php 
                                    }    
                                    ?>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <br>
                            </center>
                        </td>

                    </tr>
                    <tr>
                        <td class="pull right"><?php echo 'วันที่พิมพ์ :'.$rtdate;?></td>
                    </tr>
                </table>
                <br>
            </tr>
        </table>
        <?php
        if($opdipd=="I")
        {
            ?>
        <div class="container">
            <table widht="80%" style="font-family:K2D;font-size:18px;">
                <tr>
                    <td style="font-size:20px; font-weight:bold;">
                        Check List : Refer Back-IPD
                    </td>
                </tr>
                <tr>
                    <td width="15%">1. ความพร้อมผู้ป่วย </td>
                    <td width="5%"> วิกฤติ                กึ่งวิกฤติ          ทั่วไป </td>
                </tr>
                <tr>
                    <td width="15%">2. การประสานปลายทาง แพทย์ผู้ส่ง </td>
                    <td width="5%"> Complete  In progress</td>
                </tr>
                <tr>
                    <td width="15%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พยาบาล</td>
                    <td width="5%"> Complete  In progress</td>
                </tr>
                <tr>
                    <td width="15%">3. ชื่อแพทย์</td>
                    <td width="5%">................................................................</td>
                </tr>
                <tr>
                    <td width="15%">4. เบอร์โทรศัพท์แพทย์ปลายทาง</td>
                    <td width="5%">................................................................</td>
                </tr>
                <tr>
                    <td width="15%">5. หน่วยงานปลายทาง</td>
                    <td width="5%">................................................................</td>
                </tr>
                <tr>
                    <td width="15%">6. ชื่อพยาบาล</td>
                    <td width="5%">................................................................</td>
                </tr>
                <tr>
                    <td width="15%">7. เบอร์โทรศัพท์พยาบาลปลายทาง </td>
                    <td width="5%">................................................................</td>
                </tr>
                <tr>
                    <td width="15%">8. ค่ารักษาพยาบาล </td>
                    <td width="5%"> Complete        In progress</td>
                </tr>
                <tr>
                    <td width="15%">9. ยารักษา(ตรวจสอบบัญชียาปลายทาง) </td>
                    <td width="5%"> Complete           In progress</td>
                </tr>
                <tr>
                    <td width="15%">10. ตรวจสอบใบนัดและเอกสารเกี่ยวข้อง
                    <td width="5%"> Complete        In progress</td>
                </tr>
                <tr>
                    <td width="15%">11. ใบ refer </td>
                    <td width="5%"> Complete        In progress</td>
                </tr>
                <tr>
                    <td width="15%">12. ใบ LAB </td>
                    <td width="5%"> Complete        In progress</td>
                </tr>
            </table>
        </div>
        <?php
        }
        ?>
    </div>
</body>

</html>