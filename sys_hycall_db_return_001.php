<?php
require_once("db/connection.php");
require_once('main_script.php');
?>
<script src="assets/Alert/js/jquery.js" type="text/javascript"></script>
<script src="assets/Alert/js/jquery.ui.draggable.js" type="text/javascript"></script>
<script src="assets/Alert/js/jquery.alerts.js" type="text/javascript"></script>
<link href="assets/Alert/css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

<?php
if(@$_POST['ADD'])
{
    // กำหนดรับค่าตัวแปรจากฟอร์ม คีย์ Master
    $ddate = $_POST['ddate'];
    $hn    = $_POST['hn'];
    $na    = $_POST['na'];
    $fromplace = $_POST['tplace'];
    $toplace = $_POST['tpplace'];
    $hyass = $_POST['hyass'];    // ประเภทผู้ป่วย
    $fast  = $_POST['fast'];
    $aidhass = $_POST['adhass'];
    $bidhass = $_POST['bdhass'];

    // กำหนดรับค่าตัวแปรจากฟอร์ม
    $na = $_POST['nname'];
    IF(@$_POST['sa']=='CRE'){$sa='CRE';}else{$sa='';}
    IF(@$_POST['sb']=='PUI/COVID-19'){$sb='PUI/COVID-19';}else{$sb='';}
    $fast = $_POST['fast'];
    $aidhass = $_POST['hassa'];
    $bidhass = $_POST['hassb'];
    /*echo '1= '. $hn.'  2= '.$fromplace.'  3= '.$toplace.'  4= '.$hyass. ' 5='.$aidhass.' 6='.$bidhass;
    exit();*/

    if(empty($hn) OR empty($fromplace) OR empty($toplace) OR empty($hyass))
    {
             echo "<script type='text/javascript'>";
             echo "window.location='sys_hycall_center_error.php?do=vali';";
             echo "</script>";
    }else {

        // ตรวจสอบรายการข้อซ้ำ
        $check = "SELECT * FROM hycent
             WHERE hdate='$ddate' AND hn='$hn' AND fromplace='$fromplace'
                                  AND toplace= '$toplace'";
        $result = mysqli_query($conn,$check);
        $num=mysqli_num_rows($result);

        if($num <=0)
        {
          // ตรวจสอค่าว่างก่อนทำการบันทึก
          $query = "INSERT INTO hycent
          (hdate,hn,patients,sicka,sickb,hyass,fast_sick,hassa,hassb,fromplace,toplace)
          VALUES ('$ddate','$hn','$na','$sa','$sb','$hyass','$fast','$aidhass','$bidhass','$fromplace','$toplace')";

          // สั่งทำการบันทึก
          $result = mysqli_query($conn,$query);
          if($result)
          {
           echo "<script type='text/javascript'>";
           echo "window.location='sys_hycall_center_error.php?do=ok';";
           echo "</script>";
          }
        }else {
          echo "<script type='text/javascript'>";
          echo "window.location='sys_hycall_center_error.php?do=nok';";
          echo "</script>";
        }
    }
}