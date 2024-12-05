<?php
include('./db/connection.php');
    $csql="SELECT 
    rf_id,
    rf_birthdate,rf_hn,rf_patients,rf_id,rf_hos_send_to,rf_status,hosp_recive_status,
    hosp_recive_rem,rfgroup,rf_date,rf_time,rf_opdipd,rf_sex,
    rfchar,rffast,rf_placename,rf_hn,pttypename,hossendto_name,rf_first_edit,rf_ptype_expire,rf_rema,
    m_depname,docsend_prename,docsend_name,docsend_surname,norf,rf_no_thairefer,rf_ptype_expire,rf_place_money,rf_pttype
    FROM v_rf_detail 
                Order by rf_id DESC";
    $cquery=mysqli_query($conn,$csql);
    $data=array();
    while($crs=mysqli_fetch_array($cquery)) 
    {
        // $a['running']        = $i++;
        $a["hn"]            = $crs['rf_hn'];
        // $a["p4p_id"]         = $rs->p4p_id;
        // $a["customer"]       = $rs->prename.$rs->name.' '.$rs->lastname;
        // $a["work_position"]  = $rs->work_position;
        // $a["type_officer"]   = $rs->type_officer;
        // $a["del"]            = '<i class="ri-delete-bin-2-line ri-1x cursor-pointer text-danger">';
    array_push($data,$a);
   }
print json_encode($data);
?>
