<!doctype html>
<meta http-equiv="content-type" content=";text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<html>

<head>
    <title>Consult Manage System</title>
</head>
<?php
// include ("main_script.php")
?>

<style type="text/css">
img.barcode {
    border: 0px solid #ccc;
    padding: 0px 0px;
    border-radius: 0px;
}

< !-- @page rotated {
    size: landscape;
}

.style28 {
    font-family: "sarabun";
    font-size: 28pt;
    /*font-weight: bold;*/
}

.style16b {
    font-family: "sarabun";
    font-size: 16pt;
    font-weight: bold;
}

.style26 {
    font-family: "sarabun";
    font-size: 26pt;
    font-weight: bold;
}

.style24 {
    font-family: "sarabun";
    font-size: 24pt;
}

.style23 {
    font-family: "sarabun";
    font-size: 23pt;
}

.style20 {
    font-family: "sarabun";
    font-size: 20pt;
}

.font12 {
    font-family: "sarabun";
    font-size: 12pt;
}

.font12center {
    font-family: "sarabun";
    font-size: 12pt;
    text-align: center;

}

.font14 {
    font-family: "sarabun";
    font-size: 14pt;

}

.font14b {
    font-family: "sarabun";
    font-size: 14pt;
    font-weight: bold;
}

.font16 {
    font-family: "sarabun";
    font-size: 16pt;
    font-weight: bold;
    text-decoration: underline 1px;
}

.font16t {
    font-family: "sarabun";
    font-size: 16pt;
}

.font17 {
    font-family: "sarabun";
    font-size: 17pt;

}

.font18 {
    font-family: "sarabun";
    font-size: 18pt;
    font-weight: bold;
    text-decoration: underline 1px;
}

.font10 {
    font-family: "sarabun";
    font-size: 10pt;

}

.style5 {
    cursor: hand;
    font-weight: normal;
    color: #000000;
}

.style9 {
    font-family: Tahoma;
    font-size: 12px;
}

.style11 {
    font-size: 12px
}

.style13 {
    font-size: 9
}

.style16 {
    font-size: 9;
    font-weight: bold;
}

.style17 {
    font-family: "sarabun";
    font-size: 12px;
    font-weight: bold;
    text-decoration: underline;
}

/* .Section2 table tr td {
    font-size: 18px;
    font-weight: bold;
} */


/* table {
    width: 100%; */
}

/* table,
th,
td {
    border: 1px solid black;
    border-collapse: collapse;
    font-family: "sarabun";
    font-size: "10pt";
} */

/* body {
    margin-top: 0em;
    margin-right: 0em;
    margin-left: 4em;
    font-family: "sarabun";

} */

.text-left {
    text-align: left !important;
}

.text-right {
    text-align: right !important;
}

.text-center {
    text-align: center !important;
}
</style>

<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
$time=date("H:i:s");    
?>
<?php
require_once("db/connection.php");
$dhy_cons=$_POST['hy_vs'];
?>
<?php
$sql="SELECT ecd.*, 
em.m_depname,es.s_ename,
dd.prename AS prea, dd.name AS namea, dd.surname AS surnamea,
dd1.prename AS preb,dd1.name AS nameb,dd1.surname AS surnameb,
dd2.prename AS prec,dd2.name AS namec,dd2.surname AS sunamec,
i.icd_desc AS icd_desca,i1.icd_desc AS icd_descb,i2.icd_desc AS icd_descc,
pt.name as ptname
FROM e_cons_detail ecd 
LEFT JOIN e_mdepart em ON em.m_depid=ecd.hdep
LEFT JOIN e_smdepart es ON es.s_edepart= ecd.sdep
LEFT JOIN doc_dbfs dd ON dd.doc_code=ecd.hdoc
LEFT JOIN doc_dbfs dd1 ON dd1.doc_code=ecd.fdoc
LEFT JOIN doc_dbfs dd2 ON dd2.doc_code=ecd.mdoc
LEFT JOIN icd10s i ON i.code=ecd.icda
LEFT JOIN icd10s i1 ON i1.code=ecd.icdb
LEFT JOIN icd10s i2 ON i2.code=ecd.icdc
LEFT JOIN pt_types pt ON pt.type_id = ecd.pt_types
WHERE cons_id=$dhy_cons ";
$result_sql = mysqli_query($conn,$sql);
$rs=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );
$consid=$rs['cons_id'];
$condate=$rs['cons_date'];
$mdname=$rs['m_depname'];
$sdname=$rs['s_ename'];
$mdoc=$rs['prea'].''.$rs['namea'].' '.$rs['surnamea'];
$pname=$rs['pname'];
?>

<body>
    <div class="container">
        <div class="row">
            <div class="row text-center">
                <div class="col-md-8 font18b">ใบปรึกษาผู้ป่วยระหว่างแผนก (ใบ Consult)</div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'เลขที่ : '.$consid;?></div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'วันที่ : '.$condate;?> เวลา : </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'ปรึกษา กลุ่มงาน/งานที่ปรึกษา : '.$mdname;?>
                    <?php echo ' สาขา/หน่วยงาน : '.$sdname;?> </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0">
                    <?php echo 'ชื่อ-สกุลแพทย์ที่รับปรึกษา(ในกรณีที่ได้รับการยืนยันจากแพทย์ที่ระบุเท่านั้น) : '.$mdoc;?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0">
                    <?php echo 'ชื่อ-สกุลผู้ป่วย : '.$pname;?>
                    <?php echo ' อายุ :'.$rs['age'];?>
                    <?php echo ' ปี   เพศ :'.$rs['sex'];?>
                    <?php echo ' สิทธิ์การรักษา :'.$rs['ptname'];?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'หอผู้ป่วย : '.$rs['places'];?>
                    <?php echo ' เตียง :'.$rs['beds'];?>
                    <?php echo ' วันนอนโรงพยาบาล :'.$rs['date_admit'];?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'ประวัติและการตรวจร่างกาย : '.$rs['a1'];?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0">
                    <?php echo ' ผลการตรวจทางห้องปฏิบัติการและการตรวจพิเศษ : '.$rs['a2'];?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'การรักษาปัจจุบัน : '.$rs['a3'];?></div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'จุดประสงค์ในการปรึกษาครั้งนี้ : '.$rs['exp'];?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'การวินิจฉัยโรค : '.$ptname;?></div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo '1 : '.$rs['icd_desca'];?></div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo '2 : '.$rs['icd_descb'];?></div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo '3 : '.$rs['icd_descc'];?></div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0">
                    <?php echo 'ชื่อ-สกุลแพทย์ผู้ปรึกษา : '.$rs['preb'].''.$rs['nameb'].' '.$rs['surnameb'];?>
                    ชื่อ-สกุลอาจารย์แพทย์ผู้รับผิดชอบ :
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0">
                    <?php echo 'ชื่อ-สกุลแพทย์ผู้ปรึกษา : '.$rs['prec'].''.$rs['namec'].' '.$rs['surnamec'];?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'สรุปผลการตรวจ '.$rs['exp'];?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'ข้อแนะนำ '.$ptname;?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 font16t pt-0 pb-0"><?php echo 'ชื่อ-สกุลแพทย์ผู้รับปรึกษา '.$ptname;?>
                </div>
            </div>
            <br />
            <div class="row">
                <label class="col-lg-2" style="font-size:10px;margin-right:center;">วันที่พิมพ์
                    :<?php echo $d_default.' '.$time;?> น. </label>
            </div>
        </div>
    </div>
</body>

</html>