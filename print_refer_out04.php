<?php
// include('./phpqrcode/qrlib.php'); 
// QRcode::png($data, $_GET['w'], $errorCorrectionLevel, $matrixPointSize,3);    
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include('./db/connection.php');
	ob_start();
?>
<?php date_default_timezone_set('Asia/Bangkok');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<link rel="stylesheet" href="./assets/font_thai/thsarabunnew.css">
<style>
p {
    writing-mode: vertical-lr;
}

.rotate {
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    width: 400;
    height: 400;
}

@page rotated {
    size: landscape;
}

.style1 {
    font-family: "THsarabunPSK";
    font-size: 34pt;
    font-weight: bold;
}

.style2 {
    font-family: 'sarabun';
    font-size: 15pt;
    font-weight: normal;
    height: 806px;
    rotate: 90;
    text-align: center;
}

.style3 {
    font-family: 'sarabun';
    font-size: 15pt;
    font-weight: normal;
    rotate: -90;
    text-align: center;

}
</style>

<body onLoad="window.print(); setTimeout(window.close, 0);">
    <?php	
	$id = null;
	if(isset($_GET["id"]))
	{
		$id = $_GET["id"];
	}
    ?>
    <?php
    $lf=90;
    $tp=400;   
    $plus=27;
    ?>
    <?php
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = 'temp/';
    include("./phpqrcode/qrlib.php");    
    $errorCorrectionLevel = 'M';  
    $matrixPointSize = 2;
    $data="http://61.19.25.194/e_nrefer/sys_hycall_send_receive_mbile.php?id=".$id;
    $filename = $PNG_TEMP_DIR.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';   
    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize,2);       
    ?>
    <?php
    $strSQL ="SELECT * FROM v_rf_print WHERE rf_id = '".$id."' ";
	$result = mysqli_query($conn,$strSQL);
	while($rs = mysqli_fetch_array($result)) 
	{
        $syd  = SUBSTR($rs['sento_hos_date'],0,2);
        $sym = SUBSTR($rs['sento_hos_date'],3,2);
        $syr='';
        $slash='';
        if(SUBSTR($rs['sento_hos_date'],6,4) <>''){
            $syr=SUBSTR($rs['sento_hos_date'],6,4) + 543;
            $slash='/';
        }
        $send= $syd.$slash.$sym.$slash.$syr;
        $hno  = $rs["norf"];
        $rchar = '***'.$rs['rfchar'].'***';
        $allergy= '';
        if($rs['rf_allergy'] == 'ไม่มีประวัติแพ้ยา'){
            $allergy='แพ้ยา: No';
        }else{
            $allergy= 'แพ้ยา: Yes';
        }
        $slip1 = TRIM('Name : <b>'.$rs['rf_patients']).'</b> HN: <b>'.$rs['rf_hn'].'</b>'.'     Tel: <b>'.$rs['rf_stel'].'</b>';
        $slip2 = 'Age: <b>'.$rs['rf_age'].'</b> Yr '.' Sex: <b>'.$rs['rf_sex'].'</b>&nbsp;&nbsp;&nbsp;&nbsp;     Service Unit: <b>'.$rs['rf_placename'].'</b>';
        $slip3 = 'Request Date :<b>'.$rs['rf_date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>Send Date :<b>'.$shd.$send.'</b>';
        $slip4 = 'From: <b>'.$rs['hosname'].'&nbsp;&nbsp;&nbsp;</b>      To: <b>'.$rs['hossendto_name'].'</b>';
        $slip5 = 'Refer No : <b>'.$rs['rf_no_refer'].'</b>';
        }
    ?>
    <div class="style2"
        style="position:absolute; left:-20px; top:0px; width:24px; font-size:60px;font-weight:extra-bold;">
        <p align="left">
            <?php echo 'REFER'?>
        </p>
    </div>
    <div class="style2" style="position:absolute; left:15px; top:13px; font-family:sarabun; font-size:18px;">
        <p align="center">
            <?php echo $rchar?>
        </p>
    </div>
    <div class="style2" style="position:absolute; left:-5px; top:38px; font-family:sarabun; font-size:18px;">
        <p align="center">
            <?php echo $allergy?>
        </p>
    </div>

    <div class="style2"
        style="position:absolute; left:-100px; top:10px; width:24px; 
                 text-rotate:90; letter-spacing:0.98px;font-family:sarabun; font-size:70px;font-height:600px;font-weight:extra-bold;">
        <p align="left">
            <?php echo $slip6;?>
        </p>
    </div>

    <div class="style2" style="position:absolute;left:18px;top:280px; width:24px;">
        <?php echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" style="width:115px;height:115px;" />';  ?>
        <!-- <img src="print_refer_out02.php?w=http://61.19.25.194/e_nrefer/sys_hycall_send_receive_mbile.php?sid=<?=$id;?>" -->
            <!-- style="width:115px;height:115px;" /> -->
    </div>
    <div class="style2" style="position:absolute; left:-20px; top:300px;">
        <p align="left">
            <?php echo'สแกนรับ';?>
        </p>
    </div>
    <!--  -->
    <div class="style2" style="position:absolute; left:<?= $lf.'px';?>;  top:<?=$tp.'px';?>">
        <p align="left">
            <?php echo $slip1;?>
        </p>
    </div>

    <?php $lf=$lf-$plus; ?>
    <div class="style2" style="position:absolute; left:<?= $lf.'px';?>;  top:<?=$tp.'px';?>">
        <p align="left">
            <?php 
            echo $slip2
            ?>
        </p>
    </div>

    <!-- qrcode -->
    <?php $pl=500; ?>
    <?php $tp=$tp +$pl; ?>
    <!-- <div class="style2" style="position:absolute; left: -15px;  top:<?=$tp.'px';?>;">
        <p align="left">
        <?php echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" style="width:115px;height:115px;" />';  ?> -->
            <!-- <img src="print_refer_out02.php?w=http://61.19.25.194/e_nrefer/print_refer_out02.php?id=<?=$id;?>"
                style="width:110px;height:110px;" /> -->
            <!-- src="print_refer_out02.php?w=http://61.19.25.194/e_nrefer/sys_hycall_send_receive_mbile.php?sid=<?=$id;?>"  -->
        <!-- </p>
    </div>
    <div class="rotate" style="position:absolute; left:14px; top:635px;">
        <p align="left">
            <?php echo 'E-rerfer From';  ?>
        </p>
    </div> -->

    <?php $lf=$lf-$plus;$tp=$tp-$pl ?>
    <div class="style2" style="position:absolute; left:<?= $lf.'px';?>;  top:<?=$tp.'px';?>; width:24px;">
        <p align="left">
            <?php 
            echo $slip3;
             ?>
        </p>
    </div>
    <?php $lf=$lf-$plus; ?>
    <div class="style2" style="position:absolute; left:<?= $lf.'px';?>;  top:<?=$tp.'px';?>;width:24px;">
        <p align="left">
            <?php echo $slip4;?>
        </p>
    </div>
    <?php $lf=$lf-$plus; ?>
    <div class="style2"
        style="position:absolute; left:<?= $lf.'px';?>; top:<?=$tp.'px';?>; width:24px; rotate:90; text-rotate:90;text-align:center;">
        <p align="left">
            <?php 
            echo $slip5;
            ?>
        </p>
    </div>
</body>

</html>