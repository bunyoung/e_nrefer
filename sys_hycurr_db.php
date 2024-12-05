<?php
require_once("db/connection.php");
// require_once("db/connect_pmk.php");
include('main_script.php');
?>

<?php
if(@$_POST['ADD']) {
    $ddate = $_POST['ddate'];
    $hn    = $_POST['hn'];
    $fromplace = $_POST['fromplace']; 
    $toplace = $_POST['toplace'];
    $hyass = $_POST['hyass'];
    $aold = $_POST['nold'];
    $aidcard=$_POST['nidcard'];
	  $calltime=date("Y-m-d H:i:s");

    $na = $_POST['nname'];
    IF(@$_POST['sa']=='CRE'){$sa='CRE';}else{$sa='';}
    IF(@$_POST['sb']=='PUI/COVID-19'){$sb='PUI/COVID-19';}else{$sb='';}
    IF(@$_POST['sc']=='TB'){$sb='sc';}else{$sc='';}
    $fast = $_POST['fast']; $aidhass = $_POST['aidhass']; $bidhass = $_POST['bidhass'];

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

//  สำหรับ รายการทรัพย์สิน
if(@$_POST['DADD']) {
  $ddate=$_POST['ddate'];
  $hlpplace=$_POST['hplace'];
  $fromplace=$_POST['assfplace']; 
  $pmkplace=$_POST['asspplace']; 
  $hn=$_POST['hn']; 
  $toplace=$_POST['asstplace'];
  $prc=$_POST['pcr']; 
  $lprc=$_POST['lprc']; 
  $ffp=$_POST['ffp']; 
  $crp=$_POST['crp']; 
  $plasma=$_POST['plasma']; 
  $pca=$_POST['pca']; 
  $crto=$_POST['crto'];
  $pcb=$_POST['pcb']; 
  $oth=$_POST['oth']; 
  $arg=$_POST['argent'];
  $idpcr=$_POST['idpcr'];
  $idlprc=$_POST['idlprc'];
  $idffp=$_POST['idffp'];
  $idcrp=$_POST['idcrp'];
  $idplasma=$_POST['idplasma'];
  $idpca=$_POST['idpca'];
  $idcryo=$_POST['idcryo'];
  $idpcb=$_POST['idpcb'];
  $calltime=date("Y-m-d H:i:s");
  $ldrc=$_POST['ldrc'];
  $iddrc=$_POST['idldrc'];
  if($fromplace !='' && $toplace !='' && $hn !='')
  {
  //  ตรวจสอค่าว่างก่อนทำการบันทึก
  // DEF assetcode = 11 สำหรับการขอเลือดโดยตรง
  $query = "INSERT INTO asssent (
     hdate,
     htime,
     firstplace,
     pmkplace,
     fromplace,
     hn,
     toplace,
     pcr,
     lprc,
     ffp,
     crp,
     plasma,
     pca,
     cryo,
     pcb,
     other,
     dgroup,
     drug_argent,
     assetcode,
     idpcr,
     idlprc,
     idffp,
     idcrp,
     idplasma,
     idpca,
     idcryo,
     idpcb,
     ldrc,
     idldrc)
  VALUES (
     '$ddate',
     '$calltime',
     '$hlpplace',
     '$pmkplace',
     '$fromplace',
     '$hn',
     '$toplace',
     '$prc',
     '$lprc',
     '$ffp',
     '$crp',
     '$plasma',
     '$pca',
     '$crto',
     '$pcb',
     '$oth',
     'A',
     '$arg',
     '11',
     '$idpcr',
     '$idlprc',
     '$idffp',
     '$idcrp',
     '$idplasma',
     '$idpca',
     '$idcryo',
     '$idpcb',
     '$ldrc',
     '$iddrc')";
    $result = mysqli_query($conn,$query);
    if($result)
    {
      // สร้างการเชื่อมต่อเพื่อติดต่อกับ PMK
      //สร้างรายชื่อเพิ่มเติมในระบบของคนไข้ที่ได้ร้องขอ โดยการดึงประวัติคนไข้จากระบบ HIS ของ รพ
      // แฟ้มประวัติ
      include('sys_process_pmk_his.php');
      // แฟ้มแผนก
      include('sys_process_pmk_places.php');
      // 
      echo "<script type='text/javascript'>";
      echo "window.location='sys_hycall_center_error.php?do=ok';";
      echo "</script>";
    }else{
      echo "<script type='text/javascript'>";
      echo "window.location='sys_hycall_center_error.php?do=nok';";
      echo "</script>";
      echo $query; exit();
    }   
  }else{
    echo "<script type='text/javascript'>";
    echo "window.location='sys_hycall_center_error.php?do=nok';";
    echo "</script>";
    echo $query; exit();
 }
}

//  สำหรับ รายการทรัพย์สิน
if(@$_POST['DADE']) {
  $ddate=$_POST['ddate'];
  $hlpplace=$_POST['hplace'];
  $fromplace=$_POST['assfplace'];
  $assdet=$_POST['assdet'];
  $toplace=$_POST['asstplace'];
  $notal=$_POST['notot'];
  $unit=$_POST['unit'];
  $thos=$_POST['typehos'];
  $argent=$_POST['argent'];
  $calltime=date("Y-m-d H:i:s");
  if($fromplace !='' && $toplace !='' && $thos !='')
  {
  //  ตรวจสอค่าว่างก่อนทำการบันทึก
  // DEF assetcode = 11 สำหรับการขอเลือดโดยตรง
  $query = "INSERT INTO asssent (
     hdate,
     htime,
     firstplace,
     fromplace,
     assetdet,
     toplace,
     peramt,
     unit,
     hostype,
     dgroup,
     assetcode,
     other_argent)
  VALUES (
     '$ddate',
     '$calltime',
     '$hlpplace',
     '$fromplace',
     '$assdet',
     '$toplace',
     '$notal',
     '$unit',
     '$thos',
     'B',
     '2',
     '$argent')";
    $result = mysqli_query($conn,$query);
    if($result)
    {
      // สร้างการเชื่อมต่อเพื่อติดต่อกับ PMK
      //สร้างรายชื่อเพิ่มเติมในระบบของคนไข้ที่ได้ร้องขอ โดยการดึงประวัติคนไข้จากระบบ HIS ของ รพ
      // แฟ้มประวัติ
      include('sys_process_pmk_his.php');
      // แฟ้มแผนก
      include('sys_process_pmk_places.php');
      // 
      echo "<script type='text/javascript'>";
      echo "window.location='sys_hycall_center_error.php?do=ok';";
      echo "</script>";
    }else{
      echo "<script type='text/javascript'>";
      echo "window.location='sys_hycall_center_error.php?do=nok';";
      echo "</script>";
      echo $query; exit();
    }   
  }else{
    echo "<script type='text/javascript'>";
    echo "window.location='sys_hycall_center_error.php?do=nok';";
    echo "</script>";
    echo $query; exit();
 }

}
//  สำหรับ รายการทรัพย์สิน
if(@$_POST['DADF']) {
  $ddate=$_POST['ddate'];
  $assf=$_POST['assf'];
  $hlpplace=$_POST['hplace'];
  $fromplace=$_POST['assfplace'];
  $assdet=$_POST['assdet'];
  $toplace=$_POST['asstplace'];
  $notal=$_POST['notot'];
  $unit=$_POST['unit'];
  $argent=$_POST['argent'];
  $calltime=date("Y-m-d H:i:s");
  if($fromplace !='' && $toplace !='' && $notal != '' && $unit != '')
  {
  //  ตรวจสอค่าว่างก่อนทำการบันทึก
  // DEF assetcode = 11 สำหรับการขอเลือดโดยตรง
  $query = "INSERT INTO asssent (
     hdate,
     htime,
     assetcode,
     firstplace,
     fromplace,
     assetdet,
     toplace,
     peramt,
     unit,
     dgroup,
     clean_argent)
  VALUES (
     '$ddate',
     '$calltime',
     '$assf',
     '$hlpplace',
     '$fromplace',
     '$assdet',
     '$toplace',
     '$notal',
     '$unit',
     'C',
     '$argent')";
    $result = mysqli_query($conn,$query);
    if($result)
    {
      // สร้างการเชื่อมต่อเพื่อติดต่อกับ PMK
      //สร้างรายชื่อเพิ่มเติมในระบบของคนไข้ที่ได้ร้องขอ โดยการดึงประวัติคนไข้จากระบบ HIS ของ รพ
      // แฟ้มประวัติ
      include('sys_process_pmk_his.php');
      // แฟ้มแผนก
      include('sys_process_pmk_places.php');
      // 
      echo "<script type='text/javascript'>";
      echo "window.location='sys_hycall_center_error.php?do=ok';";
      echo "</script>";
    }else{
      echo "<script type='text/javascript'>";
      echo "window.location='sys_hycall_center_error.php?do=nok';";
      echo "</script>";
      echo $query; exit();
    }   
  }else{
    echo "<script type='text/javascript'>";
    echo "window.location='sys_hycall_center_error.php?do=nok';";
    echo "</script>";
    echo $query; exit();
 }

}
//  สำหรับ รายการทรัพย์สิน
if(@$_POST['DADG']) {
  $ddate=$_POST['ddate'];
  $fromplace=$_POST['assfplace'];
  $build=$_POST['build'];
  $floor=$_POST['floor'];
  $assf=$_POST['assf'];
  $assdet=$_POST['assdet'];
  $argent=$_POST['argent'];
  $lvc=$_POST['lvclean'];
  $calltime=date("Y-m-d H:i:s");
  if($fromplace !=''  && $build!=''  && $floor!='' && $assf !='' && $argent!='')
  {
  // ตรวจสอค่าว่างก่อนทำการบันทึก
  // DEF assetcode = 11 สำหรับการขอเลือดโดยตรง
  $query = "INSERT INTO asssent (
     hdate,
     htime,
     fromplace,
     clean_place,
     assetdet,
     clean_level,
     clean_argent,
     dgroup,
     assetcode,
     build,
     floor)
  VALUES (
     '$ddate',
     '$calltime',
     '$fromplace',
     '$assf',
     '$assdet',
     '$lvc',
     '$argent',
     'D',
     '13',
     $build,
     $floor)";
    $result = mysqli_query($conn,$query);
    if($result)
    {
      // สร้างการเชื่อมต่อเพื่อติดต่อกับ PMK
      //สร้างรายชื่อเพิ่มเติมในระบบของคนไข้ที่ได้ร้องขอ โดยการดึงประวัติคนไข้จากระบบ HIS ของ รพ
      // แฟ้มประวัติ
      include('sys_process_pmk_his.php');
      // แฟ้มแผนก
      include('sys_process_pmk_places.php');
      // 
      echo "<script type='text/javascript'>";
      echo "window.location='sys_hycall_center_error.php?do=ok';";
      echo "</script>";
    }else{
      echo "<script type='text/javascript'>";
      echo "window.location='sys_hycall_center_error.php?do=nok';";
      echo "</script>";
      echo $query; exit();
    }   
  }else{
    echo "<script type='text/javascript'>";
    echo "window.location='sys_hycall_center_error.php?do=nok';";
    echo "</script>";
    echo $query; exit();
 }

}