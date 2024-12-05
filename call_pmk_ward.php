<?php
require_once('db/date_format.php');
require_once("db/connection.php");
require_once("db/connect_pmk.php");
?>

<?php
$place=$_REQUEST['place'];
$a4='0';$a3='0';$b3='0';$a2b2='0';$a1c2='0';
// $sqlt="SELECT COUNT(I.DEGREE_OF_PATIENT_CODE) AS A4,I.DEGREE_OF_PATIENT_CODE AS D
//         FROM IPDTRANS I
//         LEFT JOIN DEGREE_OF_IPD_PT_TYPE DOIPT ON DOIPT.CODE = I.DEGREE_OF_PATIENT_CODE
//         WHERE I.PLA_PLACECODE = '$place' AND DATEDISCH IS NULL
//         GROUP BY I.DEGREE_OF_PATIENT_CODE";
//         $sted = oci_parse($objConnect, $sqlt);
//         oci_execute ($sted,OCI_DEFAULT);
//         while($rs=oci_fetch_array($sted,OCI_ASSOC))
//         {
//             if($rs['D']=='4A')
//             {
//                 $a4=$rs['A4'];
//             }
//             if($rs['D']=='3A'){
//                 $a3=$rs['A4'];
//             }
//             if($rs['D']=='3B'){
//                 $b3=$rs['A4'];
//             }
//             if($rs['D']=='2B'||$rs['D']=='2A'){
//                 $a2b2=$rs['A4'];
//             }
//             if($rs['D']=='1A' || $rs['D']=='2C'){
//                 $a1c2=$rs['A4'];
//             }
//         }
//     ?>

<?php
    $sql1 = "SELECT ROW_NUMBER() OVER(ORDER BY T.PLA_PLACECODE,BED_NO) AS ROWNO, 
    T.AN,T.HN,T.BED_NO,TO_CHAR(T.DATEADMIT,'DD-MM-YYYY') AS DATEADMIT,
    T.DEGREE_OF_PATIENT_CODE,DOIPT.NAME AS DONA,T.PROCDIAG,T.TREATMNT,
    TO_DATE(SYSDATE,'DD-MM-YY')-TO_DATE(T.DATEADMIT, 'DD-MM-YY') AS NDAY,
    DPA.ALLERGIC_DESC AS DS,T.M_TOTAL,T.CF_CHAR_ID,CF.NAME,(DD.PAT_RUN_HN||'/'||DD.PAT_YEAR_HN) AS DHN,
    DD.PLA_PLACECODE AS DOUTL,(VP.PRENAME||VP.NAME||' '||VP.SURNAME) AS FNAME,
    DD1.DOC_CODE,(DD1.PRENAME||DD1.NAME) AS DOCNAME,DD1.SURNAME
    FROM IPDTRANS T
    LEFT JOIN DEGREE_OF_IPD_PT_TYPE DOIPT ON DOIPT.CODE = T.DEGREE_OF_PATIENT_CODE
    LEFT JOIN DRUG_PT_ALLERGY DPA ON DPA.PAT_RUN_HN=T.PAT_RUN_HN AND DPA.PAT_YEAR_HN=T.PAT_YEAR_HN
    LEFT JOIN CHAR_FOODS CF ON CF.CHAR_ID = T.CF_CHAR_ID
    LEFT JOIN V_PATIENTS VP ON VP.HN=T.HN 
    LEFT JOIN DOC_DBFS DD1 ON dd1.DOC_CODE = T.ATT_DOC
    LEFT JOIN DATE_DBFS DD ON (DD.PAT_RUN_HN||'/'||DD.PAT_YEAR_HN)=T.HN AND 
              TO_DATE(DD.APP_DATE,'DD-MM-YY')>=TO_DATE(SYSDATE,'DD-MM-YY') AND 
              DD.PLA_PLACECODE IN('OUTL','0101','0501')
    WHERE T.PLA_PLACECODE = '$place' AND DATEDISCH IS NULL";

    $data = array(); 
	$stid = oci_parse($objConnect, $sql1);
	oci_execute ($stid,OCI_DEFAULT);
    while($rs = oci_fetch_array($stid,OCI_ASSOC))
    {
        $a['bedno']=$rs['BED_NO'];
        $a['an']=$rs['AN'];
        $a['hn']=$rs['HN'];
        $a['name']=$rs['FNAME'];
         $a['pl']=$rs['PLA_PLACECODE'];
         $a['dateadm']=$rs['DATEADMIT'];
         $a['dd']=substr($rs['DATEADMIT'],0,2);
         $a['mm']=substr($rs['DATEADMIT'],3,2);
         $a['yy']=substr($rs['DATEADMIT'],6,4);
         $a['yy']=$yy+543;
         $a['dsp']=$dd.'-'.$mm.'-'.substr($yy,2,2);               // วันที่ Admit
         $a['dpa']=$rs['ALLERGIC_DESC'];                           //รายการแพ้ยา
         $a['dlc']=$rs['DEGREE_OF_PATIENT_CODE'];
         $a['nday']=$rs['NDAY'];
         $a['ds']=$rs['DS'];
         $a['dc']=$rs['PROCDIAG'];
         $a['cm']=$rs['TREATMNT'];
         $a['da']=$rs['M_TOTAL'];
         $a['cf']=$rs['NAME'];
         $a['cfid']=$rs['CF_CHAR_ID'];
         $a['dhn']=$rs['DHN'];
         $a['outl']=$rs['DOUTL'];
         $a['dname']=$rs['DOCNAME'];
         $a['sname']=$rs['SURNAME'];
			
        array_push($data,$a);
    }
    oci_close($objConnect);
    print json_encode($data); 

    ?>