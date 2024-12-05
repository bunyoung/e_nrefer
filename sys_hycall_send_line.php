<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set("Asia/Bangkok");
?>
<?php
include('./db/connection.php');
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];
 if(empty($rs['rf_no_thairefer']) || empty($rs['rf_ptype_expire']) || empty($rs['rf_place_money']) || empty($rs['rf_pttype']))

$sql="SELECT *
FROM v_rf_detail_line 
WHERE rf_hospital='$hcode' AND send_line = '0'  
Order by rf_id DESC";
$result=mysqli_query($conn,$sql);
if($rro=mysqli_num_rows($result) > 0)
{
    foreach ($result as $rss)
    {
        $rs = $rss['send_line'];
        $n=$rss["rf_id"];
        $nn=$rss["rf_id"];
        if(strlen($n)=='1')
        {
            $n= '0000'.$n;
        }else if(strlen($n)=='2')
        {
            $n= '000'.$n;
        }else if(strlen($n)=='3')
        {
            $n= '00'.$n;
        }else if(strlen($n)=='4')
        {
            $n= '00'.$n;
        }else if(strlen($n)=='5')
        {
            $n= '0'.$n;
        }
        $rf='';
        $rsshp=$rss['hosname'].'('.$rss['rf_hospital'].')';
        $rssst=$rss['hossendto_name'].'('.$rss['rf_hos_send_to'].')';
        $loca = $rss['rf_location'];
        
        $sToken=$rss['hosp_line'];
        $aToken='4wkqT672rXIHv531j9iqfrABMiAki9ZFEsnYNeB3Keh';
        if($sToken ==''){
            $sToken="3fu4ikkl3ssCcNLLDJ37OMa6wdQyseTSwUh1RhjWQrB";
        }
        $sMessage =
        "\r\n".'ขอพิจารณาส่งต่อผู้ป่วย จาก '.$rsshp.
        "\r\n".'Refer No :'.$rss['norf'].
        "\r\n".'วันที่ขอ :'.$rss['rf_date'].' เวลา :'.$rss['rf_time'].' น.'.
        "\r\n".'ประเภท :'.$rss['rfevent'].
        "\r\n".'ต้นทาง :'.$rsshp.
        "\r\n".'ปลายทาง :'.$rssst.
        "\r\n".'ความรุนแรง :'.$rss['rffast'].
        "\r\n".'ชื่อ-สกุล :'.$rss['rf_patients'].
        "\r\n".'HN :'.$rss['rf_hn'].' AN :'.$rss['rf_an'].
        "\r\n".'อายุ :'.$rss['rf_age'].' ปี เพศ :'.$rss['rf_sex'].
        "\r\n".'สิทธิ์การรักษา :'.$rss['pttypename'].
        "\r\n".'สถานพยาบาลหลัก :'.$rss['hosmain'].
        "\r\n".'สถานพยาบาลรอง :'.$rss['hossub'].
        "\r\n".' สามารถดูข้อมูล Refer ได้ที่ :'.
        "\r\n".'http://61.19.25.194/e_nrefer/print_refer_out02.php?id='.$nn.
        "\r\n".' ตอบรับ/ปฎิเสธ Referral Request :'.
        "\r\n".'http://61.19.25.194/e_nrefer/print_refer_out02.php?id='.$nn.
        "\r\n".'Location ผู้ป่วยปัจจุบัน '.$loca.
        "\r\n".'';
        $chOne = curl_init();
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $chOne, CURLOPT_POST, 1);
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage);
        $headers = array( 'Content-type: application/x-www-form-urlencoded',
        'Authorization: Bearer '.$sToken.'', );
        $headersa = array( 'Content-type: application/x-www-form-urlencoded',
        'Authorization: Bearer '.$aToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headersa);
        
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $chOne );
        $sql=mysqli_query($conn,"update rf_detail SET send_line = '1' WHERE rf_id=  '$n' ");
    }
    // if($rs <> 1) {
    //     $sql=mysqli_query($conn,"update rf_detail SET send_line = '1' ");
    // }
}
?>