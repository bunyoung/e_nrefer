<!doctype html>
<meta http-equiv="content-type" content=";text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
include('sys_hycall_user.php');
require_once("db/connection.php");
require_once("db/date_format.php");
?>

<?php
$date_start_d_defult='01/' ;
$date_start_m_defult=date('m/');
$date_start_y_defult=date('Y')+543 ;
$date_start_dmy_defult	= $date_start_d_defult.$date_start_m_defult.$date_start_y_defult;
// 01/m/y+543

$date_end_dm_defult=date('d/m/') ;
$date_end_y_defult=date('Y')+543 ;
$date_end_dmy_defult=$date_end_dm_defult.$date_end_y_defult;
// d/m/y+543

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;

// วันที่ปัจจุบัน
$d_default=$date_curr_dmy_defult;

$d_start_post = @$_POST['d_start'];
$d_end_post = @$_POST['d_end'];
IF(!empty($d_start_post)){
$d_start = $d_start_post ;
}ELSE{
$d_start = $date_start_dmy_defult;
}
IF(!empty($d_end_post) ){
$d_end = $d_end_post ;
}ELSE{
$d_end = $date_end_dmy_defult;
}
$d_start_cal = substr($d_start,0,2).substr($d_start,3,2).substr($d_start,6,4) ;
$d_end_cal =  substr($d_end,0,2).substr($d_end,3,2).substr($d_end,6,4) ;
$date_m= $d_end;
?>

<!--  ส่วนการปิดงาน  -->
<?PHP
if(@$_POST['FINISH'])
{
$hyitem = @$_POST['hyitem'];
$eidcard=@$_POST['eidcard'];
$perremark=@$_POST['hassrem'];
$uptime=date("Y-m-d H:i:s");

// ปิดงาน
$pstatus='W'; 
$sql_employee = "UPDATE employee
      SET perstatus='$pstatus' WHERE idcard=TRIM('$eidcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();

$sql_hycenter = "UPDATE hycent
SET perfinish ='$uptime',
X1='F',
X3='S',
perrend= '$perremark'
WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

if ($result_hycent_edit== TRUE) {
    // ส่งรายการแจ้งเตือนทาง Line
    $sql = "SELECT * from v_monitor WHERE hyitem = '$hyitem' ";
    $result=mysqli_query($conn,$sql);
    while($arr=mysqli_fetch_array($result)) {
        $hn= $arr['hn'];
        $pt=$arr['patients'];   //ชื่อผู้ป่วย
        $old=$arr['old'];       
        $idcard=substr($arr['idcard'],0,4).''.'******'.substr($arr['idcard'],10,3);
        $htem = $arr['hyitem'];
        $pers=$arr['pers'];       // เจ้าหน้าที่ 0 เปล
        $name=$arr['name'];       // เจ้าหน้าที่ 0 เปล
        $fplace=$arr['fplace'];
        $tplace=$arr['tplace'];
        $htime=$arr['htime'];
        $x1_pertime=$arr['x1_pertime'];
        $perto=$arr['perto'];    
        $hdate=$arr['hdate'];    
        $perfinish=$arr['perfinish'];
        $usetime=$arr['usetime'];     
        $usetimeA=$arr['usetimeAll'];     
        $fname=$arr['fasts_name'];     
        $hna=$arr['hassnamea'];     
        $token=$arr['linenotify'];
    }   
    define('LINE_API', "https://notify-api.line.me/api/notify");
    if($token <> '') {
        $headers    = [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$token
        ];
        $str= "\r\n".'หมายเลขงาน : '.$htem. 
                "\r\n".'สถานะงาน : จบงาน'. 
                "\r\n".'เคลื่อนย้าย : ผู้ป่วย'. 
                "\r\n".'สถานะ : '. $fname.
                "\r\n".'ชนิดรถ/อุปกรณ์ : '.$hna. 
                "\r\n".'----------------------------------'.
                "\r\n".'HN : '.$hn. 
                "\r\n".'ชื่อ-สกุลผู้ป่วย : '.$pt. 
                "\r\n".'อายุ : '.$old.' ปี'.
                // "\r\n".'ID : '.$idcard.
                "\r\n".'----------------------------------'.
                "\r\n".'ผู้รับงาน : ว'.$pers.' '.$name.
                "\r\n".'สถานที่รับ : '.$fplace.
                "\r\n".'สถานที่ส่ง : '.$tplace.
                "\r\n".'วันที่ร้องขอ : '.$hdate.
                "\r\n".'เวลาร้องขอ : '.$htime.
                "\r\n" .'เวลาจ่ายงาน : '.$x1_pertime.
                "\r\n" .'เวลารับงาน : '.$perto.
                "\r\n" .'เวลาจบงาน : '.$perfinish.
                "\r\n" .'ร้องขอ-รับงาน : '.$usetime.' นาที'.
                "\r\n" .'รวมระยะเวลา : '.$usetimeA .'  นาที';
    
        // $res = notify_message($str,$token);
        // print_r($res);       
    }
    $token = "25mN8JLVQXAQjH0awruhaBi6PK1F0itHj47nNWF6VKh"; //ใส่Token ที่copy เอาไว้
    $headers    = [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer '.$token
    ];
    $str= "\r\n".'หมายเลขงาน : '.$htem. 
            "\r\n".'สถานะงาน : จบงาน'. 
            "\r\n".'เคลื่อนย้าย : ผู้ป่วย'. 
            "\r\n".'สถานะ : '. $fname.
            "\r\n".'ชนิดรถ/อุปกรณ์ : '.$hna. 
            "\r\n".'----------------------------------'.
            "\r\n".'HN : '.$hn. 
            "\r\n".'ชื่อ-สกุลผู้ป่วย : '.$pt. 
            "\r\n".'อายุ : '.$old.' ปี'.
            // "\r\n".'ID : '.$idcard.
            "\r\n".'----------------------------------'.
            "\r\n".'ผู้รับงาน : ว'.$pers.' '.$name.
            "\r\n".'สถานที่รับ : '.$fplace.
            "\r\n".'สถานที่ส่ง : '.$tplace.
            "\r\n".'วันที่ร้องขอ : '.$hdate.
            "\r\n".'เวลาร้องขอ : '.$htime.
            "\r\n" .'เวลาจ่ายงาน : '.$x1_pertime.
            "\r\n" .'เวลารับงาน : '.$perto.
            "\r\n" .'เวลาจบงาน : '.$perfinish.
            "\r\n" .'ร้องขอ-รับงาน : '.$usetime.' นาที'.
            "\r\n" .'รวมระยะเวลา : '.$usetimeA .'  นาที';

    // $res = notify_message($str,$token);
    // print_r($res);
    // 
        $error1 = ' Update Error ';
        $error2 = ' ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล ';
}
}
?>
<!-- สิ้นสุดการปิดงาน -->


<!--  ส่วนการแก้ไขรายการข้อมูล รับงาน  -->
<?PHP
if(@$_POST['FEDIT'])
{
    $hyitem=@$_POST['hyitem'];
    $eidcard=@$_POST['didcard'];
    $perremark=@$_POST['hassrem'];
    $uptime=date("Y-m-d H:i:s");
    $fplace=@$_POST['dfplace'];
    $tplace=@$_POST['dtplace'];
    $pern=@$_POST['dpename'];
    $hn=@$_POST['phn'];
    $pt=@$_POST['pname'];
    $idcard=@$_POST['aid'];
    $old=@$_POST['aold'];
    
    // ปิดงาน
    $pstatus='E'; 
    $sql_employee = "UPDATE employee
                     SET perstatus='$pstatus'
                     WHERE idcard=TRIM('$eidcard')";
    $result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();

    $sql_hycenter = "UPDATE hycent
                     SET perto ='$uptime',X1='$pstatus',perremark='$perremark' 
                     WHERE hyitem='$hyitem'";
    $result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();
    if ($result_hycent_edit== TRUE) {
        $error1 = ' UPDATER ข้อมูลสำเร็จ ';
        $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
    }else{
        $error1 = ' Update Error ';
        $error2 = ' ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล ';
    }
}
?>
<!-- สิ้นสุดการจบงาน -->

<?PHP
if(@$_POST['CHANGE'])
{
$hyitem=@$_POST['hitem'];
$idcard=@$_POST['idcard'];
$uptime=date("Y-m-d H:i:s");

// ÃÑºàÃ×èÍ§
$pstatus='R';

$sql_hycenter = "UPDATE hycent
    SET pers= TRIM('$idcard')
    WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

if ($result_hycent_edit== TRUE) {
   $error1 = ' UPDATER รายการเรียกเปล';
   $error2 = ' รายการเรียกเปล เรียบร้อยแล้ว';
 }else {
   $error1 = ' Update Error ';
   $error2 = ' ไม่สามารถดำเนินการได้  ';
 }
}
?>
<!-- สิ้นสุดการจบงาน -->

<?PHP
if(@$_POST['CHANGEEMP'])
{
$hyitem=@$_POST['hitem'];
$idcard=@$_POST['idcard'];
$uptime=date("Y-m-d H:i:s");

// ÃÑºàÃ×èÍ§
$pstatus='R';

$sql_hycenter = "UPDATE hycent
    SET pers2= TRIM('$idcard')
    WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

if ($result_hycent_edit== TRUE) {
   $error1 = ' UPDATER รายการเรียกเปล';
   $error2 = ' รายการเรียกเปล เรียบร้อยแล้ว';
 }else {
   $error1 = ' Update Error ';
   $error2 = ' ไม่สามารถดำเนินการได้  ';
 }
}
?>

<!-- ยกเลิกรายการร้องขอ -->
<?PHP
if(@$_POST['DEL'])
{
$hyitem=@$_POST['hitem'];

$sql_hycenter = "UPDATE hycent
SET x1= 'C',x3='C'
WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

if ($result_hycent_edit== TRUE) {
   $error1 = ' ยกเลิกรายการร้องขอ ';
   $error2 = ' ยกเลิกรายการร้องขอ เรียบร้อยแล้ว';
   }else {
    $error1 = ' Update Error ';
    $error2 = ' ไม่สามารถ ยกเลิกรายการร้องขอ  ';
}
}
?>

<!-- กรณีจ่ายงาน รับจาก สถานะ 'W'  -->
<?php
$edit = '';
$edit = @$_POST['EDIT'];
if($edit)
{
    $idcard=@$_POST['idcard'];
    $idcard1=@$_POST['idcard1'];
    $idcard2=@$_POST['idcard2'];
    $hyitem=@$_POST['hitem'];
    $uptime=date("Y-m-d H:i:s");
    if($idcard=='100'){
        $idcard='';
    }
    if($idcard1=='100'){
        $idcard1='';
    }
    //
    $pstatus='R';
    $sql_employee = "
    UPDATE employee
        SET perstatus='$pstatus'
    WHERE idcard=TRIM('$idcard') OR idcard=TRIM('$idcard1')";
    $result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();
    if($result_employee_edit==FALSE)
    {
      echo '<script type="text/javascript">
              swal("", "ไม่สามารถดำเนินการได้", "error");
            </script>';
    }

    // ตรวจสอบค่าก่อนทำการ Update 
    $sqlr="
    SELECT 
    hyitem,x1
    FROM hycent 
    WHERE hyitem = '$hyitem' AND  x1 NOT IN ('R' ,'E','F','C') ";

    $result  = mysqli_query($conn,$sqlr);
    if(mysqli_num_rows($result) > 0 ){
        $sql_hycenter = "
        UPDATE hycent
            SET pers=TRIM('$idcard'),
            x1_pertime='$uptime',
            X1='$pstatus',
            pers2=TRIM('$idcard1'),
            userfocus=TRIM('$idcard2')
        WHERE hyitem='$hyitem' AND  x1 NOT IN ('R' ,'E','F','C') ";
        $result_hycent_edit = mysqli_query($conn,$sql_hycenter); 
        mysql_error();

        // Update สำเร็จ
        if($result_hycent_edit==TRUE) {
            $sql = "
            SELECT * 
            from v_monitor 
            WHERE hyitem = '$hyitem' AND sendline <> '1' ";
            $result=mysqli_query($conn,$sql);
            while($arr=mysqli_fetch_array($result)) {
                $hn= $arr['hn'];
                $wd= $arr['ward'];
                $bno= $arr['bedno'];
                $pt=$arr['patients'];   //ชื่อผู้ป่วย
                $old=$arr['old'];       
                $idcard=$arr['idcard'];       // เจ้าหน้าที่ 0 เปล
                $htem = $arr['hyitem'];
                $pers=$arr['pers'];       // เจ้าหน้าที่ 0 เปล
                $name=$arr['name'];       // เจ้าหน้าที่ 0 เปล
                $fplace=$arr['fplace'];
                $tplace=$arr['tplace'];
                $htime=$arr['htime'];
                $x1_pertime=$arr['x1_pertime'];
                $perto=$arr['perto'];    
                $hdate=$arr['hdate'];    
                $perfinish=$arr['perfinish'];
                $usetime=$arr['metime'];     
                $fname=$arr['fasts_name'];     
                $hna=$arr['hassnamea'];     
                $hnb=$arr['hassname'];     
                $token=$arr['linenotify'];
                $ufocus=$arr['ufname'];
            }   

            // กรณีทีมี Line ส่วนตัวไปแล้ว
            define('LINE_API', "https://notify-api.line.me/api/notify");
            if($token <>'')
            {
                $headers    = [
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer '.$token
                ];
                $str= "\r\n".'หมายเลขงาน : '.$htem. 
                "\r\n".'สถานะงาน :  เตรียมรับงาน'. 
                "\r\n".'เคลื่อนย้าย : ผู้ป่วย'. 
                "\r\n".'สถานะ : '. $fname.
                "\r\n".'ชนิดรถ/อุปกรณ์ : '.$hna. 
                "\r\n".'อุปกรณ์เพิ่มเติม : '.$hnb. 
                "\r\n".'----------------------------------'.
                "\r\n".'HN : '.$hn. 
                "\r\n".'ชื่อ-สกุลผู้ป่วย : '.$pt. 
                "\r\n".'อายุ : '.$old.' ปี'.
                "\r\n".'Ward : '.$wd. 
                "\r\n".'เตียง : '.$bno.                
                "\r\n".'----------------------------------'.
                "\r\n".'ผู้รับงาน : ว'.$pers.' '.$name.
                "\r\n".'สถานที่รับ : '.$fplace.
                "\r\n".'สถานที่ส่ง : '.$tplace.
                "\r\n".'วันที่ร้องขอ : '.$hdate.
                "\r\n".'เวลาร้องขอ : '.$htime.
                "\r\n" .'เวลาจ่ายงาน : '.$x1_pertime.
                "\r\n" .'ร้องขอ-จ่ายงาน : '.$usetime.' นาที'.
                "\r\n" .'ผู้จ่ายงาน : '.$ufocus.
                // "\r\n" .'http://192.168.99.17/hycenter/sys_hycall_center_finish_main_line.php?id='.$hyitem;
                "\r\n" .'http://192.168.99.17/e_mward/sys_e_mward_confirm_job.php?t='.$hyitem;
                $res = notify_message($str,$token);
                print_r($res);
            }
            // หยุดการส่งขึ้นไล้น์
            $sqline = "
            UPDATE  hycent SET sendline = '1'
            WHERE hyitem = '$hyitem' ";       
            $sline = mysqli_query($conn,$sqline);
            mysql_error();
        }
    }
}
?>

<!--  ส่วนการปิดงาน  -->
<?PHP
if(@$_POST['FDIT'])
{
    $hn = @$_POST['hn'];
    $idcard=@$_POST['idcard'];
    $uptime=date("Y-m-d H:i:s");
    $pstatus='W';

    $sql_employee = "UPDATE employee
                     SET perstatus='$pstatus'
                     WHERE idcard=TRIM('$idcard')";
    $result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();
    // echo $idcard;
    $sql_hycenter ="UPDATE hycent
                    SET pers= TRIM('$idcard'),
                    perfinish='$uptime',
                    X1='F'
                    WHERE hn='$hn' AND pers = '$idcard'";
    $result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

    if ($result_hycent_edit== TRUE) {
        echo '<script type="text/javascript">
                    swal("", "ข้อมูลได้รับการ Update อย่างสมบูรณ์", "success");
                </script>';
        return false;
    } else {
        echo '<script type="text/javascript">
                    swal("", "ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล", "error");
                </script>';
        return false;
    }

    if ($result_employee_edit==TRUE){
        echo '<script type="text/javascript">
                        swal("", "ข้อมูลได้รับการ Update อย่างสมบูรณ์", "success");
                </script>';
        return false;
    }else{
        echo '<script type="text/javascript">
                    swal("", "ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล", "error");
                </script>';
        return false;
    }
}
?>
<!-- สิ้นสุดการปิดงาน -->

<!-- ส่วนงานของ เวชภัณฑ์และสิี่งของ -->
<?PHP
if(@$_POST['REDIT']){
    $hytem=@$_POST['htem'];
    $idcard=@$_POST['idcard'];
    $uptime=date("Y-m-d H:i:s");
    $pstatus='R';
    $sql_employee = "UPDATE employee
    SET perstatus='$pstatus'
    WHERE idcard=TRIM('$idcard'); ";
     $result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();
     if ($result_employee_edit==FALSE){
        echo '<script type="text/javascript">
                  swal("", "ไม่สามารถดำเนินการได้", "error");
               </script>';
     }
     $sql_hycenter = "UPDATE asssent
                             SET pers= TRIM('$idcard'),
                                   x1_pertime='$uptime',
                                   X1='$pstatus'
                            WHERE hyitem='$hytem'; ";
    $result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

    if ($result_hycent_edit== TRUE) {
        $sql="SELECT * FROM v_asmonitor WHERE hyitem='$hytem' " ;
        $result=mysqli_query($conn,$sql);
        while($arr=mysqli_fetch_array($result)) {
            $asna=$arr['assname'];
            $pam=$arr['name'];
            $id=$arr['idcard'];
            $fp=$arr['nfromplace'];
            $tp=$arr['ntplace'];
       }    
    //     define('LINE_API', "https://notify-api.line.me/api/notify");
    //     $token = "25mN8JLVQXAQjH0awruhaBi6PK1F0itHj47nNWF6VKh"; //ใส่Token ที่copy เอาไว้
    //     $headers    = [
    //       'Content-Type: application/x-www-form-urlencoded',
    //      'Authorization: Bearer '.$token
    //  ];
    //   $str= "\r\n".'เตรียมรับ : '.$asna. 
    //           "\r\n".'----------------------------------'.
    //           "\r\n".'ผู้รับงาน : '.$idcard.' '.$pam.
    //           "\r\n".'สถานที่รัับ : '.$fp.
    //           "\r\n".'สถานที่ส่ง : '.$tp.
    //           "\r\n" .'จ่ายงาน : '.$uptime;
    //   $res = notify_message($str,$token);
    //   print_r($res);      
   } else {
        $error1 = ' Update Error ';
        $error2 = ' ไม่สามารถทำการแก้ไขได้ ';
   }
}
?>

<!-- ส่วนการรับ เวชภัณฑ์และสิ่งของ -->
<?PHP
if(@$_POST['RFEDIT'])
{
$hyitem = @$_POST['hyitem'];
$eidcard=@$_POST['eidcard'];
$perremark=@$_POST['hassrem'];
$uptime=date("Y-m-d H:i:s");
$pstatus='E'; 

$sql="SELECT * FROM v_asmonitor WHERE hyitem='$hyitem' " ;
$result=mysqli_query($conn,$sql);
while($arr=mysqli_fetch_array($result)) {
    $asna=$arr['assname'];
    $nam= $arr['name'];
    $id=$arr['idcard'];
    $fp=$arr['nfromplace'];
    $tp=$arr['ntplace'];
}    

$sql_employee = "UPDATE employee
    SET perstatus='$pstatus'
WHERE idcard=TRIM('$eidcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();

$sql_hycenter = "UPDATE asssent
SET perto ='$uptime',X1='$pstatus',perremark='$perremark' WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();
if ($result_hycent_edit== TRUE) {
    // 
    // define('LINE_API', "https://notify-api.line.me/api/notify");
    // $token = "25mN8JLVQXAQjH0awruhaBi6PK1F0itHj47nNWF6VKh"; //ใส่Token ที่copy เอาไว้
    // $headers    = [
    //     'Content-Type: application/x-www-form-urlencoded',
    //     'Authorization: Bearer '.$token
    // ];
    // $str= "\r\n".'รับ : '.$asna. 
    //         "\r\n".'----------------------------------'.
    //         "\r\n".'ผู้รับงาน : '.$eidcard.' '.$nam.
    //         "\r\n".'สถานที่รับ : '.$fp.
    //         "\r\n".'สถานที่ส่ง : '.$tp.
    //         "\r\n".'จ่ายงาน : '.$uptime;
    // $res = notify_message($str,$token);
    // print_r($res);
    // 
} else {
   $error1 = ' Update Error ';
   $error2 = ' ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล ';
}
}
?>
<!--  ส่วนการปิดงาน  -->
<?PHP
if(@$_POST['RSFINISH'])
{
$hyitem = @$_POST['hyitem'];
$eidcard=@$_POST['eidcard'];
$perremark=@$_POST['hassrem'];
$uptime=date("Y-m-d H:i:s");
$pstatus='W'; 

$sql_employee = "UPDATE employee
      SET perstatus='$pstatus' WHERE idcard=TRIM('$eidcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();

$sql_hycenter = "UPDATE asssent
    SET perfinish ='$uptime',
    X1='F',
    X3='S',
    perrend= '$perremark'
    WHERE hyitem='$hyitem'; ";
        $result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

        if ($result_hycent_edit== FALSE) {
            $error1 = ' Update Error ';
            $error2 = ' ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล ';
    }
}
?>
<!-- สิ้นสุดส่วยเวชภัณฑ์และสิ่งของ -->

<html class="no-js">

<head>
    <?php
    include('db/connection.php');
        include('main_top_panel_head.php');
    ?>
</head>

<?php
$rw='0';
$rr='0';
$rf='0';
$rt='0';

$result = mysqli_query( $conn,"SELECT COUNT(*) as wtotal,hdate FROM v_monitor WHERE x1='W' AND 
                        hdate = '$d_default' ");
$res = mysqli_fetch_array($result,MYSQLI_ASSOC);
$rw = $res['wtotal'];

$result1 = mysqli_query( $conn,"SELECT COUNT(*) as rtotal,hdate FROM v_monitor WHERE x1='R' AND 
                        hdate = '$d_default' ");
$res1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
$rr = $res1['rtotal'];

$result2 = mysqli_query( $conn,"SELECT COUNT(*) as ftotal,hdate FROM v_monitor WHERE x1='E' AND
                        hdate = '$d_default'  ");
$res2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
$rf = $res2['ftotal'];

$result3 = mysqli_query($conn,"SELECT COUNT(*) as ftotal,hdate FROM v_monitor WHERE hdate = '$d_default' ");
$res3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
$rt = $res3['ftotal'];

$result4 = mysqli_query($conn,"SELECT COUNT(*) as ftotal,hdate FROM v_monitor WHERE x1 = 'F' AND hdate = '$d_default'");
$res4=mysqli_fetch_array($result4,MYSQLI_ASSOC);
$rn = $res4['ftotal'];

$rtt=$rw+$rr+$rf;
?>
<style>
.btn-skyblue {
    background-color: #87eebb;
    color: white;
}

.btn-orange {
    background-color: #ff8c00;
    color: white;
}

.btn-green {
    background-color: #11ef1111;
    color: white;
}
</style>

<body onload=”javascript:setTimeout(“location.reload(true);”,60000);”>
    <script>
    $(function() {
        Metis.dashboard();
    });
    </script>
    <div id="content3" style="margin-top:-20px;">
        <div class="inner bg-light lter">
            <button type="button" class="btn btn-orange">
                <span class="glyphicon glyphicon-earphone"></span>
                ผู้ป่วยที่รอรับบริการ ประจำวันที่ : <?php echo $d_end;?></button>
            <button type="button" class="btn btn-warning">
                <span class="glyphicon glyphicon-remove"></span>
                ปิดงาน :<span class="badge badge-light"><?php echo $rn;?> &nbsp;คน</span>
                Monitor :<span class="badge badge-light"><?php echo $rtt;?> &nbsp;คน</span>
                ร้องขอ :<span class="badge badge-light"><?php echo $rw;?> &nbsp;คน</span>
                รอรับ :<span class="badge badge-primary"><?php echo $rr;?> &nbsp;คน</span>
                รอปิดงาน :<span class="badge badge-light"><?php echo $rf;?> &nbsp;คน</span>
            </button>
            <!--  -->
            <a href="#modal_db_v" type="button" data-toggle="modal" data-id="modal_db_v" class="btn btn-success">
                <span class="glyphicon glyphicon-user"></span> เจ้าหน้าที่เปล
            </a>

            <button class="btn btn-danger navbar-btn">
                <span class="glyphicon glyphicon-time"></span>
                <strong id="timer">
                    <h5 id="timer"></h5>
                </strong>
            </button>
            <!-- Monitor รายการเรียกเปล -->
            <?php include('sys_hycall_center_per_now.php'); ?>
        </div>
    </div>
</body>

<!-- Modal เจ้าหน้าทีเปล -->
<div id="modal_db_v" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                </button>
                <h4 class="modal-title text-success">
                    <span class="glyphicon glyphicon-user"></span>
                    สรุปภาระงานประจำวัน : <?php echo $d_default; ?> (ช่วงทดสอบระบบ)
                </h4>
            </div>

            <div class="modal-body text-default">
                <div id="collapse4" class="body">
                    <table id="dataTable2" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <center>
                                    <th>
                                        <center>ลำดับ</center>
                                    </th>
                                    <th>
                                        <center>เจ้าหน้าที่เปล </center>
                                    </th>
                                    <th>
                                        <center>เริ่มปฎิบัติงาน</center>
                                    </th>
                                    <th>
                                        <center>เวลาเลิกงาน</center>
                                    </th>
                                    <th>
                                        <center>ช่วงเวร</center>
                                    </th>
                                    <th>
                                        <center>ภาระงานรวม</center>
                                    </th>
                                    <th>
                                        <center>สถานะ</center>
                                    </th>
                                </center>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
$sqliwww ="SELECT 
h.pers,
e.name,
h.hdate,
COUNT(*) AS totj,
e.perstatus,
MIN(h.htime) AS mitime,
MAX(h.htime) AS matime
FROM hycent h 
INNER JOIN employee e ON e.idcard=h.pers
WHERE h.pers<>'' AND hdate='$d_default'
GROUP BY hdate,pers
ORDER BY hdate,pers ASC
";	
$result_iwww = mysqli_query($conn,$sqliwww);

$schd='เวรเช้า';
$i=1;
while($rs_www=mysqli_fetch_array($result_iwww)) 
{
    if($rs_www['mitime'] >='08:30:00' AND $rs_www['mitime'] <='16:30:00' ){
        $schd='เวรเช้า';
    }else{
        if($rs_www['mitime'] >='16:30:01' AND $rs_www['mitime'] <='23:59:01' ){
            $schd='เวรบ่าย';  
        }else{
            if($rs_www['mitime'] >='01:0:01' AND $rs_www['mitime'] <='08:30:01' ){  
                $schd='เวรดึก';  
            }    
        }    
    }
?>
                            <tr>
                                <td>
                                    <center>
                                        <?php $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else{echo $n;}?>
                                    </center>
                                </td>

                                <td>
                                    <?php echo $rs_www['name']; ?>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $rs_www['mitime'] ; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $rs_www['matime'] ; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $schd; ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $rs_www['totj'] ; ?>
                                    </center>
                                </td>

                                <td>
                                    <center>
                                        <?php 
                                    $pstatus='รอรับภาระกิจ';
                                    if($rs_www['perstatus']=='W'){
                                        $pstatus='รอรับภาระกิจ';                                           
                                    }else{
                                        if($rs_www['perstatus']=='R'){
                                            $pstatus='ระหว่างรับงาน';                                           
                                        }else{
                                            if($rs_www['perstatus']=='E'){
                                                $pstatus='ปิดงาน';  
                                            }                                             
                                        }                                                
                                    }
                                    ?>
                                        <?php 
                                    if($rs_www['perstatus']=='W'){
                                        ?>
                                        <a href="#" class="btn btn-warning btn-sm">
                                            <span class="glyphicon glyphicon-thumbs-up"></span>
                                            <?php echo $pstatus; ?>
                                        </a>
                                        <?php 
                                    } 
                                    ?>

                                        <?php 
                                    if($rs_www['perstatus']=='R'){
                                        ?>
                                        <a href="#" class="btn btn-danager btn-sm">
                                            <span class="glyphicon glyphicon-thumbs-down"></span>
                                            <?php echo $pstatus; ?>
                                        </a>
                                        <?php 
                                    } 
                                    ?>
                                        <?php 
                                    if($rs_www['perstatus']=='E'){
                                        ?>
                                        <a href="#" class="btn btn-success btn-sm">
                                            <span class="glyphicon glyphicon-hand-right"></span>
                                            <?php echo $pstatus; ?>
                                        </a>
                                        <?php 
                                    } 
                                    ?>
                                    </center>
                                </td>
                            </tr>
                            <?php         
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- สิ้นสุด Modal -->

<script>
$(function() {
    Metis.MetisTable();
    Metis.metisSortable();
});
</script>
<script type="text/javascript" src="assets/js/jquery.js"> </script>
<script type="text/javascript" src="assets/js/jquery.min.js"> </script>
<script type="text/javascript" src="assets/js/jquery-ui.min.js"> </script>
<script type="text/javascript" src="assets/lib/moment/min/moment.min.js"> </script>
<!--TABLE  -->
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js">
</script>
<script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js">
</script>
<script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js">
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#vfdataTable').dataTable({
        "ordering": false,
        "oLanguage": {
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sLast": "หน้าสุดท้าย",
                "sNext": "ถัดไป",
                "sPrevious": "ก่อนหน้า"
            },
            "sLengthMenu": "แสดง _MENU_ รายการ ต่อหน้า",
            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
            "sInfo": "แสดง _START_ - _END_ ของ _TOTAL_ รายการ",
            "sInfoEmpty": "แสดง 0 - 0 ของ 0 รายการ",
            "sInfoFiltered": "(จากรายการทั้งหมด _MAX_ รายการ)",
            "sSearch": "ค้นหา :"
        }
    });

    $('#asdataTable').dataTable({
        "oLanguage": {
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sLast": "หน้าสุดท้าย",
                "sNext": "ถัดไป",
                "sPrevious": "ก่อนหน้า"
            },
            "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
            "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
            "sSearch": "ค้นหา :"
        }
    });
});
</script>
<!--- ภาระงาน 0 เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_end').on('show.bs.modal', function(e) {
        var hid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_end_finish_main.php', //Here you will fetch records
            data: {
                'hyitem': hid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_receive_end" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" background-color:green;>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-user">
                    </i> : ปิดงานการของศูนย์เปล
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc"> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>

<!--- เปลี่ยน เจ้าหน้าที่เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_change_person').on('show.bs.modal', function(e) {
        var hyitems = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_chang_person.php', //Here you will fetch records
            data: {
                'hyitems': hyitems
            },
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_change_person" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" background-color:green;>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-user">
                    </i> : สลับเจ้าหน้าที่ศูนย์เปล ในการเคลื่อนย้ายผู้ป่วย
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc"> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>

<!--- เปลี่ยน เจ้าหน้าที่เปลคนที่ 2 -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_change_personemp').on('show.bs.modal', function(e) {
        var hyitems = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_chang_personemp.php', //Here you will fetch records
            data: {
                'hyitems': hyitems
            },
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_change_personemp" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" background-color:green;>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-user">
                    </i> : สลับเจ้าหน้าที่ศูนย์เปล ในการเคลื่อนย้ายผู้ป่วย
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc"> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>

<!--- ภาระงาน 0 เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_end_detail').on('show.bs.modal', function(e) {
        var hn = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_end_finish_detail_main.php', //Here you will fetch records
            data: {
                'hn': hn
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_receive_end_detail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" background-color:green;>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-user">
                    </i> : การสิ้นสุดภาระงานของศูนย์เปล
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc"> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>

<!--- ภาระงาน 0 เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_finish').on('show.bs.modal', function(e) {
        var hn = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_finish_main.php', //Here you will fetch records
            data: {
                'hn': hn
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_receive_finish" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" background-color:green;>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">
                    <i class="fa fa-user"></i> : มอบหมายงานให้เจ้าหน้าที่ศูนย์เปล
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc"> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม</button>
            </div>
        </div>
    </div>
</div>

<!-- ส่วนการมอบหมายงาน เวชภัณฑ์ -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_wait').on('show.bs.modal', function(e) {
        var hyitem = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_wait.php', //Here you will fetch records
            data: {
                'hyitem': hyitem
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //แสดงรายการข้อมูจาก database
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_receive_wait">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <i class="fa fa-user"></i> ภาระกิจงานที่มอบหมาย
                </h4>
            </div>
            <div class="modal-body text-default">
                <div class="fetched-data_rc"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม</button>
            </div>
        </div>
    </div>
</div>
<!-- สิ้นสุดการมอบหมายงาน จนท -->

<!--- มอบหมายงาน 0 เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_patient_quicka').on('show.bs.modal', function(e) {
        var hn = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_send.php', //Here you will fetch records
            data: {
                'hn': hn
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_patient_quicka" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : ด่วน วิกฤต / หัตถการ
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->

<!--- มอบหมายงาน 0 เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_cancel').on('show.bs.modal', function(e) {
        var hitem = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_cancel.php', //Here you will fetch records
            data: {
                'hyitems': hitem
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_receive_cancel" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : ยกเลิกรายการร้องขอ
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ส่วนงานของเวชภัณฑ์และสิ่งของ -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_ass_finish').on('show.bs.modal', function(e) {
        var hn = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_ass_finish_main.php', //Here you will fetch records
            data: {
                'hn': hn
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_receive_ass_finish" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" background-color:green;>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-user">
                    </i> : มอบหมายงานให้เจ้าหน้าที่ศูนย์เปล
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc"> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_ass_wait').on('show.bs.modal', function(e) {
        var hyitem = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_ass_wait.php', //Here you will fetch records
            data: {
                'hyitem': hyitem
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //แสดงรายการข้อมูจาก database
            }
        });
    });
});
</script>
<script type="text/javascript">
var h = '';
$(document).ready(function() {
    //chk_hour();
    setInterval(getnow, 1000);
});

function chk_hour() {
    datetime = new Date();
    var x = datetime.getHours();
    if (h != x) {
        //console.log('aaa');
        // upload_bed_color();
        h = x;
    }
    setInterval(chk_hour, 1000 * 5);
}

// function upload_bed_color() {
//     $.ajax({
//         url: 'upload_bed_color.php',
//         //error: OnError,
//         success: function(data) {
//             //console.log(data);
//             $('#log_table').bootstrapTable('refresh', {
//                 silent: true
//             });
//         },
//         cache: false
//     });
// }

function getnow() {
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var hh = d.getHours();
    var mm = d.getMinutes();
    var ss = d.getSeconds();

    var datenow = +(day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + d.getFullYear();
    var timenow = +(hh < 10 ? '0' : '') + hh + ':' + (mm < 10 ? '0' : '') + mm + ':' + (ss < 10 ? '0' : '') + ss;

    var now = datenow + ' ' + timenow;
    $("#timer").html("เวลา :" + timenow);

    if (h != hh) {
        h = hh;
    }
}
</script>

<div class="modal fade" id="myModal_receive_ass_wait">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times; </button>
                <h5 class="modal-title">
                    <i class="fa fa-user">
                    </i> : มอบหมายงานให้เจ้าหน้าที่ศูนย์เปล
                </h5>
            </div>
            <div class="modal-body text-danger">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม</button>
            </div>
        </div>
    </div>
</div>

<!-- ส่วนการปิดงาน -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_ass_end').on('show.bs.modal', function(e) {
        var hid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_ass_end_finish_main.php', //Here you will fetch records
            data: {
                'hyitem': hid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>
<?php
function notify_message($message,$token){
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array( 
            'http'=>array(
               'method'=>'POST',
               'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                         ."Authorization: Bearer ".$token."\r\n"
                         ."Content-Length: ".strlen($queryData)."\r\n",
               'content' => $queryData
            ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API,FALSE,$context);
    $res = json_decode($result);
    // return $res;
}
?>
<div class="modal fade" id="myModal_receive_ass_end" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" background-color:green;>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-user">
                    </i> : ปิดงานการของศูนย์เปล
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc"> </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>
<!-- สิ่นสุดเวชภัณฑ์ -->

</html>