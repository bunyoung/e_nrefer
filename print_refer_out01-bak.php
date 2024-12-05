<?php
include('phpqrcode/qrlib.php'); 
QRcode::png($_GET['w']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	include('main_script.php');
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
	$strSQL ="SELECT * FROM v_rf_print WHERE rf_id = '".$id."' ";
	$result = mysqli_query($conn,$strSQL);
	while($rs = mysqli_fetch_array($result)) 
	{
		$d1 = $rs['docsend_prename'].''.$rs['docsend_name'].'   '.$rs['docsend_surname'];
		$d2 = $rs['docme_prename'].''.$rs['docme_name'].'   '.$rs['docme_surname'];

		$hno = $rs["rf_no_refer"];
		$h1 = $rs["hosname"];
		$h2 = $rs["hosp_recive_date"];
		$h3 = $rs['hosp_recive_time'];
		$h4 = $rs['m_depname']; 
		$h5 = $rs['rf_patients'];
		$h6 = $rs['rf_age'];
		$h7 = $rs['rf_idcard'];
        $h8 = $rs['rf_serv'];
        $h9 = $rs['pname'];
		$h10=$rs['icd10a'].'.'.$rs['icd10b'].','.$rs['icd10c'];
        $h11=$rs['indication'];
        $h12=$rs['rf_his_patient'];
        $h13= '  ญาติต้องการ';
		$h14= '  เกินศักยภาพ';
		$h15= '  สิทธิต้นสังกัด';
        $h16= '  สิทธิแรงงานต่างด้าว รพ........................................................................................... ';
        $h17= '<i class="fa fa-square-o"></i>  สิทธิประกันสังคม  รพ..................................................................';
        $h18= '<i class="fa fa-square-o"></i>  สิทธิประกันสุขภาพ  รพ..................................................................';
        $h19= '<i class="fa fa-square-o"></i>  ปัญหาค่ารักษา   <i class="fa fa-square-o"></i>  กองทุนทดแทน <i class="fa fa-square-o"></i> พรบ.รถยนต์';
        $h20= '<i class="fa fa-square-o"></i>  อื่น ๆ';
        $h21= 'ชื่อผู้ติดต่อ .................................................................... เบอร์โทรศัพท์ ............................................ เบอร์ Fax .......................................';
		$h23= $rs['rffast'];
        $h24= 'แพทย์ผู้รับปรึกษา ๑. '.$d1.'  ๒.'.$d2; 
		$h25= 'ผลการ Refer  '.'<i class="fa fa-square-o"></i> ไม่รับ เพราะ ..........................................................................................................';
		$h26= '                      '.'<i class="fa fa-square-o"></i> รอจองเตียงที่.........................................................................................................';
		$h27= '                      '.'<i class="fa fa-square-o"></i> รับ/ส่งผู้ป่วยที่........................................................................................................';
		$h28= '                      '.'<i class="fa fa-square-o"></i> อื่น ๆ........................................................................................................................';
		$h29= 'หมายเหตุ....................................................................................................................................................................................................';
		$h30= 'ผู้ประสานงาน.....................................................................................................(ศูนย์รับ-ส่งต่อผู้ป่วย) ผู้รับเรื่อง ER/OPD/IPD.................';
		$h31= 'บันทึกการติดตาม ..........................................................................................................................................................................................';
		$h32= '...........................................................................................................................................................................................................................';
		$h33= '..........................................................................................................................................................................................................................';
	}
	?>
        <div class="container">
            <table class="table-responsive" width="100%" align="center" style='border: 0.5px solid;border-collapse: collapse; padding-left:20px;
              font-family: "sarabun";font-size: 23px;font-weight:bold;padding: 0rem;margin-top:0px;'>
                <tr>
                    <table width="100%" align="center" style='border: 0px solid; padding-left:60px;
                                      font-family: "sarabun";font-size: 20px;padding:1px;'>
                        <tr>
                            <td width="10%"><img src="img/logo.png" style="width:60px;height:60px;"></td>
                            <td
                                style="font-family:sarabun; font-size: 22px; font-weight:bold;padding: 2rem; text-align:center;">
                                แบบรับแจ้งขอ Refer ผู้ป่วย</td>
                            <td width="10%"><img src="img/hy.png" style="width:60px;height:60px;"></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="BORDER-BOTTOM: #999999 2px solid"></td>
                        </tr>
                        <tr>
                            <td colspan="6">เลข Refer :<?php echo $hno; ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="BORDER-BOTTOM: #999999 1px dotted"></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                โรงพยาบาล. <?php echo $h1;?> ในสังกัดกระทรวงสาธารณสุข
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                วันที่รับแจ้ง <?php echo $h2;?> เวลา. <?php echo $h3;?> หน่วยงานที่ขอ Refer.
                                <?php echo $h4;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                ชื่อ-นามสกุล ผู้ป่วย <?php echo $h5;?> อายุ <?php echo $h6;?> ปี
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                ID <?php echo $h7;?> วันที่ Admit <?php echo $h8;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                โรค <?php echo $h9;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                อาการสำคัญที่มา รพ. <?php echo $h10;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                ประวัติการเจ็บป่วยในอดีต. <?php echo $h11;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                อาการปัจจุัน <?php echo $h12;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <b>เหตุผลที่ขอ Refer </b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <i class="fa fa-square-o"></i><?php echo $h13;?>
                                <i class="fa fa-square-o"></i><?php echo $h14;?>
                                <i class="fa fa-square-o"></i><?php echo $h15;?>
                                <i class="fa fa-square-o"></i><?php echo $h16;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h17;?><?php echo $h18;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h19;?> <?php echo $h20;?>
                            </td>
                        </tr>
                        <div>

                        </div>
                        <tr>
                            <td colspan="6">
                                <?php echo $h21;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                แพทย์รับปรึกษา <?php echo $h22;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                เหตุผล Refer <?php echo $h23;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h24;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h25;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h26;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h27;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h28;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h29;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h30;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php echo $h31;?>
                            </td>
                        </tr>

                    </table>
                    <br>
                    <!-- <table width="100%" align="center" style='border:px solid; padding-left:60px;
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
                </table> -->
                </tr>
            </table>
        </div>
    </body>

</html>