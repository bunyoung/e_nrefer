<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Refer</title>
    <?php
    require_once("./db/connection.php");
?>

    <?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
//  $hcode=$_SESSION['hcode'];
 $hcode='10682';

 #ตรวจสอบสิทธิการเข้าใช้งาน
 if ($hcode=="") 
{
    echo (
        "<script>
                Swal.fire({
                    title: 'ไม่พบสิทธิ [admin]'',
                    text: 'ข้อความนี้สำหรับแจ้งให้ผู้ใช้งานทราบ',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
           });
           window.location.href='dashboard.php';
        </script>");
}
?>
    <?php
include('main_top_panel_head.php');
// include('main_script.php');
include('main_top_menu_session.php');
?>

<?php
require_once("./db/connect_pmk.php");
// include('main_script.php');
#variable from post
$id=$_POST['pid'];
$it =$_POST['it'];
?>
<?php
$sql = "SELECT 
I.OPD_NO,
PFH.IMPORTANT_NO,
PFH.CONTACT,
I.AN,
 VP.PRENAME,
 VP.NAME,
 VP.SURNAME,
 I.HN,
 I.PLA_PLACECODE,
 o.pla_placecode,
 P.FULLPLACE,
 I.BED_NO,
 I.DEGREE_OF_PATIENT_CODE,
 TO_CHAR( I.DATEADMIT, 'dd-mm-yyyy' ) dateadm,
 I.ATT_DOC,
 I.PREDIAGNOS,
 ( D.PRENAME || D.NAME || '  ' || D.SURNAME ) AS DNAME,
 CT_CREDIT_ID,
 PT.NAME AS PTNAME,
 TRUNC(MONTHS_BETWEEN(SYSDATE+1,DATEADMIT)-(TRUNC(MONTHS_BETWEEN(SYSDATE,DATEADMIT)/12)*30))*30 + 1 +
TRUNC(SYSDATE - ADD_MONTHS(DATEADMIT, TRUNC(MONTHS_BETWEEN(SYSDATE+1,DATEADMIT)))) AS LOS,
VP.PRO1_PROV_CODE,
 ( SELECT PROV_NAME FROM PROVINCES WHERE PROV_CODE = PRO1_PROV_CODE ) PNAME,
 VP.DIS_DIST_CODE,
 ( SELECT NAME FROM AMPHUR WHERE SUBSTR( CODE, 1, 4 ) = DIS_DIST_CODE ) TPROV,
 VP.HOME_BOOK_TAMBON,
 (SELECT NAME FROM TAMBON WHERE CODE = HOME_BOOK_TAMBON) TNAME
 FROM IPDTRANS I
 INNER JOIN V_PATIENTS VP ON VP.HN = I.HN
 INNER JOIN PLACES P ON P.PLACECODE = I.PLA_PLACECODE AND P.DEL_FLAG IS NULL AND P.PLACECODE <> 'TEST'
 LEFT JOIN DOC_DBFS D ON D.DOC_CODE = I.ATT_DOC
 INNER JOIN PT_TYPES PT ON PT.TYPE_ID = I.CT_CREDIT_ID 
 INNER JOIN OPDS O ON O.OPD_NO = I.OPD_NO  AND O.COME_TO_HOSPITAL_CODE IN ('03','68','89','88')
 INNER JOIN PATIENTS_REFER_HX PFH ON PFH.OPD_NO=O.OPD_NO
WHERE
 I.DATEDISCH IS NULL 
 ORDER BY
I.BED_NO,
 I.PLA_PLACECODE,
 I.AN,OWNNAME";       
$objParse=oci_parse($objConnect,$sql);
oci_execute($objParse,OCI_DEFAULT);
?>

<body onload=”javascript:setTimeout(“location.reload(true);”,60000);” style="font-family:K2D;font-size:18px;margin-top:0px;" >
    <script>
    $(document).ready(function() {
        $("#export_to_excel-a").click(function() {
            $("#ptdetail_a").table2excel({
                exclude: ".noExl",
                name: "E-nrefer",
                filename: "การ Refer ผู้ป่วย ตั้งแต่_<?php echo $d_start; ?>_ถึงวันที่_<?php echo $d_end; ?>.xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
    </script>

    <div class="container-fluid">
        <div class="box">
            <header>
                <div class="icons">
                    <button id="export_to_excel-a" class="btn btn-success btn-xs btn-grad">
                        <i class="fa fa-file-excel-o" style="font-size:18px;"></i>
                    </button>
                </div>
                <div class="panel-heading" style="background:#E65100;
                         color:#FFE57F;font-size: 18px;font-family:'K2D';">

                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    จำนวนผู้ป่วยในเข้ารักษา รพ.หาดใหญ่ ปัจจุบัน วันที่ <?php echo $d_default ;?>
                </div>
            </header>
            <table id="ptdetail_a" class="display dataTable" style="width:100%; font-family:K2D;font-size:16px; ">
                <thead>
                    <tr>
                        <th>
                            <center>ลำดับ</center>
                        </th>
                        <th>
                            <center>HN</center>
                        </th>
                        <th>
                            <center>AN </center>
                        </th>
                        <th>
                            <center>ชื่อ นามสกุล </center>
                        </th>
                        <th>
                            <center>ที่อยู่ปัจจุบัน</center>
                        </th>
                        <th>
                            <center>วันที่เข้ารักษา</center>
                        </th>
                        <th>
                            <center>หอผู้ป่วย </center>
                        </th>
                        <th>
                            <center>เตียง</center>
                        </th>
                        <th>
                            <center>ระดับ<br>อาการ</center>
                        </th>
                        <th>
                            <center>วินิจฉัยโรค</center>
                        </th>
                        <th>
                            <center>สิทธิ์การรักษา</center>
                        </th>
                        <th>
                            <center>OPD NO.</center>
                        </th>
                        <th>
                            <center>THAIREFER NO.</center>
                        </th>
                        <th>
                            <center>NB REFER NO.</center>
                        </th>
                        <th>
                            <center>แพทย์เจ้าของไข้</center>
                        </th>
                        <th>
                            <center>LOS (วัน) </center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            $i=1;
            while($rs=oci_fetch_array($objParse,OCI_BOTH)) 
            {
            ?>
            <tr>
                <td>
                    <center>
                        <?php $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                    </center>
                </td>
                <td>
                    <center>
                        <?php  echo $rs['HN'];?>
                    </center>
                </td>
                <td>
                    <center>
                        <?php  echo $rs['AN']; ?>
                    </center>
                </td>
                <td>
                    <?php echo $rs['PRENAME'].$rs['NAME'].'  '.$rs['SURNAME'];?>
                </td>
                <td>
                    <?php  echo ' อ.'.$rs['TPROV']; ?> <br> <?php echo ' จ.'.$rs['PNAME']; ?>
                </td>
                <td>
                    <center>
                        <?php echo $rs['DATEADM'];?>
                    </center>
                </td>
                <td>
                    <center>
                        <?php echo $rs['FULLPLACE'];?>
                    </center>
                </td>
                <td>
                            <center>
                                <?php echo $rs['BED_NO'];?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php echo $rs['DEGREE_OF_PATIENT_CODE'];?>
                            </center>
                        </td>
                        <td>
                            <?php echo $rs['PREDIAGNOS'];?>
                        </td>
                        <td>
                            <?php echo $rs['PTNAME'];?>
                        </td>
                        <td>
                            <?php echo $rs['OPD_NO'];?>
                        </td>
                        <td>
                            <?php echo $rs['IMPORTANT_NO'];?>
                        </td>
                        <td>
                            <?php echo $rs['CONTACT'];?>
                        </td>
                        <td>
                            <?php echo $rs['DNAME'];?>
                        </td>
                        <td>
                            <center>
                                <?php echo $rs['LOS'];?>
                            </center>
                        </td>
                    </tr>
                    <?php
            }
            ?>
                </tbody>
            </table>
        </div>
</body>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        $('#ptdetail_a').dataTable({
            "lengthMenu": [
                ["All", 80, 100, -1],
                ["All"
                    80, 100, 200
                ]
            ],
            "ordering": false,
        });
    });
</script>
<?php oci_close($objConnect); ?>

</html>