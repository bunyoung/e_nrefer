<?php
require_once("db/connection.php");
define('LINE_API', "https://notify-api.line.me/api/notify");
$token = "cM5vgSw2lEJywDb60Eax9IBCjbB2qXmStC6Zz5jK3Ch"; //ใส่Token ที่copy เอาไว้
$sql = "SELECT * FROM v_monitor WHERE perto  is null  AND pers <>'' ";
$result = mysqli_query($conn,$sql);
$i=1;
while($arr=mysqli_fetch_array($result)) {
    $params = array(
        "message"      => 'ว.'.$arr['pers'] .'  '.'รับผู้ป่วย '.$arr['fromplace'], //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
        "stickerPkg"    => 2, //stickerPackageId
        "stickerId"      => 34, //stickerId
        "imageThumbnail" => "https://c1.staticflickr.com/9/8220/8292155879_bd917986b4_m.jpg", // max size 240x240px JPEG
        "imageFullsize"  => "https://c1.staticflickr.com/9/8220/8292155879_bd917986b4_m.jpg", //max size 1024x1024px JPEG
      );
      $res = notify_message($params, $token);    
}

// print_r($res);
 function notify_message($params, $token) {
  $queryData = array(
    'message'          => $params["message"],
    'stickerPackageId' => $params["stickerPkg"],
    'stickerId'        => $params["stickerId"],
    'imageThumbnail'   => $params["imageThumbnail"],
    'imageFullsize'    => $params["imageFullsize"],
  );
  $queryData = http_build_query($queryData, '', '&');
  $headerOptions = array(
    'http' => array(
      'method'  => 'POST',
      'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
      . "Authorization: Bearer " . $token . "\r\n"
      . "Content-Length: " . strlen($queryData) . "\r\n",
      'content' => $queryData,
    ),
  );
  $context = stream_context_create($headerOptions);
  $result = file_get_contents(LINE_API, FALSE, $context);
  $res = json_decode($result);
  return $res;
}
?>