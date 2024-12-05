<?php 
 include('./core/connect_pmk.php')  ;
if(!empty($_GET['type']) && $_GET['type'] == 'hnan_search'){ 
    $q = !empty($_GET['search'])?$_GET['search']:''; 
    $sql="SELECT
    DISTINCT(O.PAT_RUN_HN),O.PAT_YEAR_HN,VP.NAME,VP.SURNAME,VP.HN
    FROM OPDS O
    INNER JOIN V_PATIENTS VP ON VP.RUN_HN=O.PAT_RUN_HN AND VP.YEAR_HN=O.PAT_YEAR_HN
    WHERE TO_CHAR(SYSDATE,'ddmmyyyy') = TO_CHAR(O.OPD_DATE,'ddmmyyyy')";  

    $objParse = oci_parse($objConnect, $sql);  
    $objParse1 = oci_parse($objConnect, $sql);  
    oci_execute ($objParse,OCI_DEFAULT); 
    $Result=oci_execute ($objParse1,OCI_DEFAULT); 
    
    $Num_Rows = oci_fetch_all($objParse1, $Result);                                                               
    $usersData = array();  
    if($Num_Rows > 0){  
        while($rs= oci_fetch_array($objParse,OCI_BOTH)){  
            $data['id']     = $rs['HN'];  
            $data['text'] = $rs['NAME'].' '.$rs['SURNAME'];  
            array_push($usersData, $data);  
        }  
    }  
    echo json_encode($usersData);  
} 
 ?>