<?php 
 include('./db/connect_pmk.php')  ;
if(!empty($_GET['type']) && $_GET['type'] == 'places_search'){ 
    $search_term = !empty($_GET['search'])?$_GET['search']:''; 
 	$sql="SELECT PLACECODE as PLACECODE,HALFPLACE AS HALFPLACE FROM PLACES 
               WHERE PT_PLACE_TYPE_CODE  IN ('1','2') AND DEL_FLAG IS NULL AND
                             TRIM(PLACECODE) LIKE '%".$search_term."%'  OR
                             PT_PLACE_TYPE_CODE  IN ('1','2') AND DEL_FLAG IS NULL AND
                             TRIM(HALFPLACE) LIKE '%".$search_term."%'
                             ORDER BY PLACECODE ASC";  

                            // TRIM(PLACECODE) LIKE '".$search_term."%' 

    $objParse = oci_parse($objConnect, $sql);  
    $objParse1 = oci_parse($objConnect, $sql);  
    oci_execute ($objParse,OCI_DEFAULT); 
    $Result=oci_execute ($objParse1,OCI_DEFAULT); 
    
    $Num_Rows = oci_fetch_all($objParse1, $Result);                                                               
    $usersData = array();  
    if($Num_Rows > 0){  
        while($rs= oci_fetch_array($objParse,OCI_BOTH)){  
            $data['id'] = $rs['PLACECODE'];  
            $data['text'] = '['.$rs['PLACECODE'].'] '.$rs['HALFPLACE'];  
            array_push($usersData, $data);  
        }  
    }  
    echo json_encode($usersData);  
} 
 ?>