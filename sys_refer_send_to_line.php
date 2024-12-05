<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Refer</title>
</head>
<?php
$id=$_GET['id'];
    require_once("db/connection.php");
?>

<body>
    <?php
    $sql="
    SELECT 
    * 
    FROM v_rf_detail
    WHERE rf_id = '$id' "; 
    $result=mysqli_query($conn,$sql);
    $rs=mysqli_num_rows($result);
    if($rs > '0')
    {
        $rss=mysqli_fetch_array($result);
        if($rss['line'] ==''){
            $sToken ="TzKhqEASEIef5I3qhuQ8DUU0wjOwZx8dyxzV06pg2fm";
        }else{
            $sToken=$rss['line'];
        }
        $sMessage =  
            "\r\n".'_____________________________________'.
            "\r\n".'1. เลขที่ Refer :'.$rss['rf_no_refer'].
            "\r\n".'2. ประจำวันที่ :'.$rss['rf_date'].
            "\r\n".'3. รพ ต้นทาง :'.$rss['hossendto_name'].
            "\r\n".'4. รพ ปลายทาง :'.$rss['name_hosp_line'].
            "\r\n".'5. ผป. :'.$rss['rf_patients'].'  เพศ :'.$rss['rf_sex'].' Blood :'.$rss['rf_blood'].
            "\r\n".'6. สิทธิ์การรักษา :'.$rss['pttypename'].
            "\r\n".'7. สาเหตุส่งต่อ :'.$rss['rfevent'].
            "\r\n".'8. ระดับความรุนแรง :'.$rss['rffast'].
            "\r\n".'9. พ.ผู้ส่ง :'.$rss['docsend_prename'].''.$rss['docsend_name'].'  '.$rss['docsend_surname'];           
        $chOne = curl_init(); 
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt( $chOne, CURLOPT_POST, 1); 
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec( $chOne ); 
    
        //Result error 
        // $result_ = json_decode($result, true); 
        // if(curl_error($chOne)) 
        // { 
        //     echo 'error:' . curl_error($chOne); 
        // } 
        // else { 
        //     echo "status : ".$result_['status']; echo "message : ". $result_['message'];
        // }    
    }
    curl_close( $chOne );   
    mysqli_close($conn);
    ?>
    <?php
         header('Location: sys_hycall_monitor_now.php');
    //  exit()
     ?>
    <!-- <script type="text/javascript">
    window.location = "sys_hycall_monitor_now.php";
    </script> -->
</html>