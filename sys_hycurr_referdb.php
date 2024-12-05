<?php
require_once("db/connection.php");
// require_once("db/connect_pmk.php");
include('main_script.php');
?>

<?php
if(@$_POST['refer']) {
    $place = $_POST['place'];
    $hn    = $_POST['fhn'];
    $sex = $_POST['sex']; 
    $age = $_POST['age'];
    $nplace = $_POST['nplace'];
    $dateserv = $_POST['dateserv'];
    $pt_name=$_POST['pt_name'];
    $hosp = $_POST['hosp'];
    $rfev = $_POST['rfev'];
    $allergy = $_POST['allergy'];
    $a1 = $_POST['a1'];
    $a2 = $_POST['a2'];
    $a3 = $_POST['a3'];
    $ftext = $_POST['ftext'];  
    $tdep = $_POST['tdep'];
    $exp = $_POST['exp'];
    $h_arti_id = $_POST['h_arti_id'];
    $h_arti_id01 = $_POST['h_arti_id01'];
    $futext = $_POST['futext'];
    $fast = $_POST['fast'];
    $hdoc = $_POST['hdoc'];
    $calltime=date("Y-m-d H:i:s");

    if(empty($hn) OR empty($fromplace) OR empty($toplace) OR empty($hyass))
    {
             echo "<script type='text/javascript'>";
             echo "window.location='sys_hycall_center_error.php?do=vali';";
             echo "</script>";
    }else{

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
          (hdate,htime,hn,patients,sicka,sickb,sickc,hyass,fast_sick,hassa,hassb,fromplace,toplace,idcard,old)
          VALUES ('$ddate','$calltime','$hn','$na','$sa','$sb','$sc','$hyass',
                       '$fast','$aidhass','$bidhass','$fromplace','$toplace','$aidcard','$aold')";

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
