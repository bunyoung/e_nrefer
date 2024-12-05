<?php 
 include('./db/connection.php ')  ;
$query = $conn->query("SELECT * FROM v_rf_detail 
										    ORDER BY rf_refer_no DESC");  
$query=mysqli_query($conn,"select * from v_rf_detail");   
$i=1;
    $data = array();  
        while($row = mysqli_fetch_array($query)){  
            $a['no'] = $i++;
            $a['rf_id'] = $row['rf_id'];
            $a['rf_no_refer'] = $row['rf_no_refer'];  
            $a['rf_date'] =$row['rf_date'];  
            $a['rf_time'] =$row['rf_time'];  
            $a['rfchar'] =$row['rfchar'];  
            $a['rffast'] =$row['rffast'];  
            $a['rf_placename'] =$row['rf_placename'];  
            $a['rf_hn'] =$row['rf_hn'];  
            $a['rf_patients'] =$row['rf_patients'];  
            $a['rf_sex'] =$row['rf_sex'];  
            $a['rf_age'] =$row['rf_age'];  
            $a['pttypename'] =$row['pttypename'];  
            $a['hossendto_name'] = $row['hossendto_name'];  
            $a['docsend_prename'] = $row['docsend_prename'].''.$row['docsend_name'].'  '.$row['docsend_surname'];;  
            $a['m_depname'] = $row['m_depname'];  
            $a['mark']='<a href="#myModal_approve_mopa" data-toggle="modal" data-id="'.$a['rf_id'].'">
                                    <i class="fa fa-reply fa-2x" style="color:#DD2C00;"></i>
                                </a>';
            $a['edit']= '<a class="btn btn-danger"  href="sys_hycall_center_now_edit.php?id="'.$a['rf_id'].'">Edit</a>';
            $a['del']= '<a class="btn btn-danger"  href="sys_hycall_center_now_edit.php"><i class="fa fa-trash"></i></i> </a>';
            array_push($data,$a);
        }
        print json_encode($data); 
 ?>