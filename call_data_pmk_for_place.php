<?php
$data=array();
$sql="SELECT C.* FROM ($sql1) C WHERE C.ROWNO > $Page_Start AND 
        C.ROWNO <= $Row_End";
$objParse = oci_parse($objConnect, $sql);  
$objParse1 = oci_parse($objConnect, $sql);  
oci_execute ($objParse,OCI_DEFAULT); 
$Result=oci_execute ($objParse1,OCI_DEFAULT); 

$Num_Rows = oci_fetch_all($objParse1, $Result); 
while($rs = oci_fetch_array($objParse,OCI_ASSOC))
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
    $a['dname']=$rs['DOCNAME'];
    $a['sname']=$rs['SURNAME'];
    array_push($data,$a);
}    
$arrData=json_encode($data); 
oci_close($objConnect);
?>