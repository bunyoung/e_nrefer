<?php 
 include('./db/connect_pmk.php')  ;
if(!empty($_GET['type']) && $_GET['type'] == 'doctorb_search'){ 
    $search_term = !empty($_GET['search'])?$_GET['search']:''; 
    $sql="SELECT DOC_CODE,NAME,PRENAME,SURNAME
        FROM doc_dbfs
        WHERE(DOC_CODE like '%$q%' OR NAME like '%$q%' OR PRENAME like '%$q%') AND
                PRENAME IN ('จนท.','นส.','พว.','ทพญ','ทพญ.','ผศ.พญ.','ผศ.นพ','รศ.นพ','ผศ.นพ.','รศ.นพ.','พญ.','พญ','ดร.พญ.','นพ','นพ.','น.พ.','ทพ.','ทพ','ท.พ.') AND  DOC_CODE <>'ADMIN' AND 
                DEL_FLAG IS NULL AND  TRIM(NAME) LIKE '%".$search_term."%' OR  
                (DOC_CODE like '%$q%' OR NAME like '%$q%' OR PRENAME like '%$q%') AND
                PRENAME IN ('จนท.','นส.','พว.','ทพญ','ทพญ.','ผศ.พญ.','ผศ.นพ','รศ.นพ','ผศ.นพ.','รศ.นพ.','พญ.','พญ','ดร.พญ.','นพ','นพ.','น.พ.','ทพ.','ทพ','ท.พ.') AND  DOC_CODE <>'ADMIN' AND 
                DEL_FLAG IS NULL AND TRIM(DOC_CODE) LIKE '%".$search_term."%' 
                ORDER BY NAME ASC";  

    $objParse = oci_parse($objConnect, $sql);  
    $objParse1 = oci_parse($objConnect, $sql);  
    oci_execute ($objParse,OCI_DEFAULT); 
    $Result=oci_execute ($objParse1,OCI_DEFAULT); 
    
    $Num_Rows = oci_fetch_all($objParse1, $Result);                                                               
    $usersData = array();  
    if($Num_Rows > 0){  
        while($rs= oci_fetch_array($objParse,OCI_BOTH)){  
            $data['id'] = $rs['DOC_CODE'];  
            $data['text'] = '['.$rs['DOC_CODE'].'] '.$rs['PRENAME'].$rs['NAME'].'  '.$rs['SURNAME'];  
            array_push($usersData, $data);  
        }  
    }  
    echo json_encode($usersData);  
} 
 ?>