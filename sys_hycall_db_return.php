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
    $hn    = $_POST['hn'];
    $na    = $_POST['na'];
    $item  = $_POST['item'];
    $toplace = $_POST['tpplace'];
    $hyass = $_POST['hyass'];    // ประเภทผู้ป่วย
    $ddate = $_POST['ddate'];
    $fromplace = $_POST['tplace'];

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

    if(empty($hn) && empty($fromplace) && empty($toplace) && empty($hyass))
    {
             echo "<script type='text/javascript'>";
             echo "window.location='sys_hycall_center_error.php?do=vali';";
             echo "</script>";
    }else{
      $query = "INSERT INTO hycent
      (hdate,hn,patients,sicka,sickb,hyass,fast_sick,hassa,hassb,fromplace,toplace)
      VALUES ('$ddate','$hn','$na','$sa','$sb','$hyass','$fast','$aidhass','$bidhass','$fromplace','$toplace')";
      $result = mysqli_query($conn,$query);
      if($result)
      {
        $sqlupdate = "UPDATE hycent set x2='R' WHERE hyitem = '$item' ";
        $result_update = mysqli_query($conn,$sqlupdate);
        if($result_update){
          echo "<script type='text/javascript'>";
          echo "window.location='sys_hycall_center_error.php?do=ok';";
          echo "</script>";
        }else{
          echo "<script type='text/javascript'>";
          echo "window.location='sys_hycall_center_error.php?do=nok';";
          echo "</script>";
        }
      }
    }
}