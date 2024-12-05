<!doctype html>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
 <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js">
<?php
require_once("./db/connect_pmk.php");
#variable from post
$id=$_POST['pid'];
$it =$_POST['it'];
?>
<?php include('main_script.php'); ?>
<div class="bg-default dker" id="wrap">
    <?php
        $sql = "SELECT 
        I.AN,VP.PRENAME,VP.NAME,VP.SURNAME,I.HN, I.PLA_PLACECODE,P.FULLPLACE, I.BED_NO,
        TO_CHAR(I.DATEADMIT,'dd-mm-yyyy') dateadm,I.M_TOTAL,I.ATT_DOC,(D.PRENAME||D.NAME||'  '||D.SURNAME) AS DNAME,CT_CREDIT_ID,PT.NAME AS PTNAME,
        TRUNC(MONTHS_BETWEEN(SYSDATE+1,DATEADMIT)-(TRUNC(MONTHS_BETWEEN(SYSDATE,DATEADMIT)/12)*30))*30 + 1 +
      TRUNC(SYSDATE - ADD_MONTHS(DATEADMIT, TRUNC(MONTHS_BETWEEN(SYSDATE+1,DATEADMIT)))) AS LOS
        FROM IPDTRANS I
        INNER JOIN V_PATIENTS VP ON VP.HN=I.HN   AND
        I.DEGREE_OF_PATIENT_CODE = '$id' 
        INNER JOIN PLACES P ON P.PLACECODE=I.PLA_PLACECODE 
        INNER JOIN DOC_DBFS D ON D.DOC_CODE = I.ATT_DOC
        INNER JOIN PT_TYPES PT ON PT.TYPE_ID=I.CT_CREDIT_ID
        WHERE I.DATEDISCH IS NULL 
        ORDER BY I.PLA_PLACECODE,I.AN";

        $objParse=oci_parse($objConnect,$sql);
        oci_execute($objParse,OCI_DEFAULT);
        ?>

    <div class="" style="background:#E65100;color:#FFE57F;font-size: 17px;font-family:'K2D';">
        <i class="fa fa-bar-chart" aria-hidden="true"></i>
            สถิติการเข้ารักษาแยกตามแต่ละระดับอาการ
    </div>
    <table id="#" class="table table-bordered table-condensed ">
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
                <center>วันที่เข้ารักษา</center>
            </th>
            <th>
                <center>หอผู้ป่วย </center>
            </th>
            <th>
                <center>เตียง</center>
            </th>
            <th>
                <center>สิทธิการรักษา</center>
            </th>
            <th>
                <center>แพทย์เจ้าของไข้</center>
            </th>
            <th>
                <center>LOS(วัน) </center>
            </th>
            <th>
                <center>ค่าใช้จ่าย(บาท)</center>
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
                <?php    $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?> 
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
                    <?php echo $rs['PTNAME'];?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $rs['DNAME'];?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $rs['LOS'];?>
                </center>
            </td>
            <td>
                <center>
                    <?php echo $rs['M_TOTAL'];?>
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
<?php oci_close($objConnect); ?>

</html>