<?php 
 include('./db/connection.php ')  ;
if(!empty($_GET['type']) && $_GET['type'] == 'icd10_search'){ 
    $search_term = !empty($_GET['search'])?$_GET['search']:''; 
 	$query = $conn->query("SELECT code,icd_desc FROM rf_icd10  
	                                               WHERE icd_desc LIKE '%".$search_term."%' OR  
                                                                 code LIKE '%".$search_term."%' 
												    ORDER BY code,icd_desc ASC");  
    $icdData = array();  
    if($query->num_rows > 0){  
        while($row = $query->fetch_assoc()){  
            $data['id'] = $row['code'];  
            $data['text'] = '['.$row['code'].'] '.$row['icd_desc'];  
            array_push($icdData, $data);  
        }  
    }  
    echo json_encode($icdData);  
} 
 ?>