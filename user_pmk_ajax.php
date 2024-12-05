<?php 
 include('./db/connect_pmk.php')  ;
if(!empty($_GET['type']) && $_GET['type'] == 'user_search'){ 
    $q = !empty($_GET['search'])?$_GET['search']:''; 
    $sql="SELECT U_USER_ID,NAME
                    FROM utables
                    WHERE UPPER(U_USER_ID) like UPPER('$q%') OR NAME like UPPER('$q%') AND
                                  DEL_FLAG IS NULL OR 
                                  UPPER(NAME) like UPPER('$q%') OR UPPER(U_USER_ID) like UPPER('$q%') AND
                                  DEL_FLAG IS NULL
                    ORDER BY NAME ASC";  

    $objParse = oci_parse($objConnect, $sql);  
    $objParse1 = oci_parse($objConnect, $sql);  
    oci_execute ($objParse,OCI_DEFAULT); 
    $Result=oci_execute ($objParse1,OCI_DEFAULT); 
    
    $Num_Rows = oci_fetch_all($objParse1, $Result);                                                               
    $usersData = array();  
    if($Num_Rows > 0){  
        while($rs= oci_fetch_array($objParse,OCI_BOTH)){  
            $data['id'] = $rs['U_USER_ID'];  
            $data['text'] = $rs['U_USER_ID'].' '.$rs['NAME'];  
            array_push($usersData, $data);  
        }  
    }  
    echo json_encode($usersData);  
} 
 ?>