<?php session_start(); ?>
<?php date_default_timezone_set('Asia/Bangkok');?>
<?php
ob_start();
?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<style type="text/css">
</style>

<head>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<style type='text/css'>

@font-face {
  font-family: 'CSChatThaiUI';
  src: url('CSChatThaiUI.eot?#iefix') format('embedded-opentype'),  url('CSChatThaiUI.woff') format('woff'), url('CSChatThaiUI.ttf')  format('truetype'), url('CSChatThaiUI.svg#CSChatThaiUI') format('svg');
  font-weight: normal;
  font-style: normal;
}
body { font-family: 'CSChatThaiUI' !important; }

</style>
  
<body onLoad="window.print(); setTimeout(window.close, 0);">
    <?php
include 'db/connect_pmk.php';
include 'db/date_config_value.php';
$an = $_REQUEST['an']; 
$hn = $_REQUEST['hn']; 
$sql="
SELECT 
REPLACE(i.HN,'/','')||REPLACE(i.AN,'/','')||p.ID_CARD as idx,
i.AN,i.hn,p.prename,p.name,p.surname,i.FLNAME,i.PLA_PLACECODE,pl.halfplace,i.BED_NO,
i.AGE_YEAR as AGE_YEAR,i.age_day,i.age_month,
decode(p.sex,'M','ชาย','F','หญิง') as sex,i.hn,
to_char(i.DATEADMIT,'yyyy-mm-dd') as date_admit,
p.ID_CARD,t.name as credit,i.DATEDISCH,(d.PRENAME||''||d.name||' '||d.surname) as doctor,
trunc(months_between(SYSDATE,p.BIRTHDAY)/12) year,
trunc(mod(months_between(sysdate,p.BIRTHDAY),12)) month,
trunc(sysdate-add_months(p.BIRTHDAY,trunc(months_between(sysdate,p.BIRTHDAY)/12)*12
+trunc(mod(months_between(sysdate,p.BIRTHDAY),12)))) day,p.birthday,
i.FOOD_DETAIL as food1,f.name as food2,r.name as rname
FROM IPDTRANS i
LEFT JOIN DOC_DBFS d ON d.DOC_CODE=i.ATT_DOC
LEFT JOIN PLACES pl on pl.placecode=i.pla_placecode
LEFT JOIN PATIENTS p on p.hn=i.hn
LEFT JOIN CREDIT_TYPES t ON t.credit_id=i.ct_credit_id
LEFT JOIN CHAR_FOODS f on f.char_id=i.cf_char_id
left join RELIGIONS r on  r.religion_id=p.rel_religion_id
WHERE i.an='$an'
order by i.bed_no";
   
$objParse = oci_parse($objConnect, $sql);  
oci_execute ($objParse,OCI_DEFAULT); 
$rs= oci_fetch_array($objParse,OCI_BOTH);

$idx = 'http://192.168.99.17/e_ward/sys_eward_view.php?an='.$an;
// $idx = 'http://192.168.99.17/e_ward/sys_eward_view.php?an='.$an;
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
		$PNG_WEB_DIR = 'temp/';
		include("./phpqrcode/qrlib.php");    
		$errorCorrectionLevel = 'M';  
		$matrixPointSize = 2.5;
		$data=$idx;
		$filename = $PNG_TEMP_DIR.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';	
QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize,2);   
?>
    <br>
    <table width="100%" border='0' style='border-collapse: collapse; padding-left:20px;'>
        <tr>
            <td width="30%" colspan="0" align="center">
                <table width="100%" border="0">
                    <tr>
                        <td align="center">
                            <font style="font-size:40px;"> <strong> เตียง (BED) </strong> </font>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <font style="font-size:40px;"> <strong> <?php echo $rs['BED_NO'];?></strong> </font>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
                <table width="100%" border="0" align="center">
                    <tr>
                        <td width="20%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-left:10px;">
                            <font style="font-size:30px;">ชื่อ-สกุล </font>
                        </td>
                        <td width="80%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-top:10px;">
                            <font style="font-size:30px;"> : <?php echo $rs['FLNAME'];?> </font>
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td width="20%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-left:10px;">
                            <font style="font-size:30px;">HN </font>
                        </td>
                        <td width="80%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-top:10px;">
                            <font style="font-size:30px;color: blue;"> : <?php echo $rs['HN'];?> AN : <?= $rs['AN'];?>
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-left:10px;">
                            <font style="font-size:30px;"> อายุ </font>
                        </td>
                        <td width="80%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-top:10px;">
                            <font style="font-size:30px;"> :
                                <?php echo $rs['YEAR'].' ปี '.$rs['MONTH'].' เดือน '.$rs['DAY'].' วัน'; ?> </font>
                        </td>
                    </tr>

                    <tr>
                        <td width="25%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-left:10px;">
                            <font style="font-size:30px;"> วันที่นอน รพ. </font>
                        </td>
                        <td width="75%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-top:10px;">
                            <font style="font-size:30px;"> : <?php  echo date_to_thai($rs['DATE_ADMIT']);?> </font>
                        </td>
                    </tr>

                    <tr>
                        <td width="20%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-left:10px;">
                            <font style="font-size:30px;"> สิทธิการรักษา </font>
                        </td>
                        <td width="80%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-top:10px;">
                            <font style="font-size:30px;"> : <?php  echo $rs['CREDIT'];?> </font>
                        </td>
                    </tr>

                    <tr>
                        <td width="20%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-left:10px;">
                            <font style="font-size:30px;"> แพทย์ </font>
                        </td>
                        <td width="80%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-top:10px;">
                            <font style="font-size:30px;"> : <?php  echo $rs['DOCTOR'];?> </font>
                        </td>
                    </tr>

                    <tr>
                        <td width="20%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-left:10px;">
                            <font style="font-size:30px;"> ประเภทอาหาร </font>
                        </td>
                        <td width="80%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-top:10px;">
                            <font style="font-size:30px;"> : <?php echo $rs['FOOD1'];?> </font>
                        </td>
                    </tr>

                    <tr>
                        <td width="20%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-left:10px;">
                            <font style="font-size:30px;"> ชนิดอาหาร </font>
                        </td>
                        <td width="80%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-top:10px;">
                            <font style="font-size:30px;"> : <?php echo $rs['FOOD2'];?> </font>
                        </td>
                    </tr>

                    <tr>
                        <td width="20%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-left:10px;">
                            <font style="font-size:30px;">ศาสนา </font>
                        </td>
                        <td width="80%" align="left" style="border-bottom:1px dotted #CCCCCC; padding-top:10px;">
                            <font style="font-size:30px;">:<?php echo $rs['RNAME'];?> </font>
                        </td>
                    </tr>
                    <tr> </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td width="10%" align="right" style="padding-right:20px;">
                            <?php
                                echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />';  
                                echo '<br>';
                                echo '<font size="2" class="font12">';
                                echo 'พิมพ์ ';
                                echo  date('H:i').' น. ';
                                echo  date_to_thai(date('Y-m-d'));
                                echo '</font>';
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>