<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$sql="SELECT 
                    rf_id,
                    rf_birthdate,rf_hn,rf_patients,rf_id,rf_hos_send_to,rf_status,hosp_recive_status,
                    hosp_recive_rem,rfgroup,rf_date,rf_time,rf_opdipd,rf_sex,
                    rfchar,rffast,rf_placename,rf_hn,pttypename,hossendto_name,
                    m_depname,docsend_prename,docsend_name,docsend_surname,norf
        FROM v_rf_detail 
                    WHERE rf_hospital='$hcode' AND end_refer_end='N' AND rfgroup='1' Order by rf_id DESC";
while($rs=mysqli_fetch_array($query)) {
                        $year=substr($rs["rf_birthdate"],6,4);
                        $month=substr($rs["rf_birthdate"],3,2);
                        $date=substr($rs["rf_birthdate"],0,2);
                        $day=$year."-".$month."-".$date;
                        $date = date("Y-m-d");
                        $age=($date - $day);
                        $rfhn=$rs['rf_hn'];
                        $rfpatients=$rs['rf_patients'];
                        $rfno=$rs['rf_id'];
                        $hp = $rs['rf_hos_send_to'];
}
                        ?>
</body>
</html>