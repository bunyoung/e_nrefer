<!doctype html>
<meta http-equiv="content-type" content=";text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
include 'sys_hycall_user.php';
// if(!isset($_SESSION)) {  session_start();  }
#write number
$page=basename($_SERVER['PHP_SELF']);
if (file_exists('_couter/'.$page.'.txt'))
{
$fil = fopen('_couter/'.$page.'.txt', "r");
$dat = fread($fil, filesize('_couter/'.$page.'.txt'));
#echo $dat+1;
fclose($fil);
$fil = fopen('_couter/'.$page.'.txt', "w");
fwrite($fil, $dat+1);
}
else
{
$fil = fopen('_couter/'.$page.'.txt', "w");
fwrite($fil, 1);
#echo '1';
fclose($fil);
}
#read number
$myFile = "_couter/".$page.".txt";
$lines = file($myFile);//file in to an array
$count= $lines[0]; //line 2
require_once("db/connection.php");
require_once("db/date_format.php");
?>

<?php
#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult='01/' ;
# $date_start_m_defult=date('m/');
$date_start_m_defult='01/';
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
// รับเรื่อง
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

if ($result_hycent_edit== FALSE) {
//    $error1 = ' UPDATER ข้อมูลสำเร็จ ';
//    $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
//    } else {
        $error1 = ' Update Error ';
        $error2 = ' ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล ';
}

// if ($result_employee_edit==TRUE){
//    $error1 = ' UPDATER ข้อมูลสำเร็จ ';
//    $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
// }
// echo ("<SCRIPT LANGUAGE='JavaScript'>
// window.alert('".$error1.$error2."')
// </SCRIPT>");
}
?>
<!-- สิ้นสุดการปิดงาน -->

<!--  ส่วนการแก้ไขรายการข้อมูล  -->
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
// รับเรื่อง
$pstatus='E'; 
$sql_employee = "UPDATE employee
    SET perstatus='$pstatus'
    WHERE idcard=TRIM('$eidcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();

$sql_hycenter = "UPDATE hycent
SET perto ='$uptime',X1='$pstatus',perremark='$perremark' WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();
if ($result_hycent_edit== TRUE) {
    // 
    define('LINE_API', "https://notify-api.line.me/api/notify");
    $token = "25mN8JLVQXAQjH0awruhaBi6PK1F0itHj47nNWF6VKh"; //ใส่Token ที่copy เอาไว้
    $headers    = [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer '.$token
    ];
    $str= "\r\n".'รับ ผป :'.$hn.' '.$pt. 
            "\r\n".'อายุ :'.$old.' ปี ID '.$idcard. 
            "\r\n".'----------------------------------'.
            "\r\n".'ผู้รับงาน :'.$eidcard.' '.$pern.
            "\r\n".'สถานที่รับ :'.$fplace.
            "\r\n".'สถานที่ส่ง :'.$tplace.
            "\r\n" .'จ่ายงาน :'.$uptime;
    $res = notify_message($str,$token);
    print_r($res);
    // 
   $error1 = ' UPDATER ข้อมูลสำเร็จ ';
   $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
} else {
   $error1 = ' Update Error ';
   $error2 = ' ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล ';
}

// if ($result_employee_edit==TRUE){
//    $error1 = ' UPDATER ข้อมูลสำเร็จ ';
//    $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
// }
// echo ("<SCRIPT LANGUAGE='JavaScript'>
// window.alert('".$error1.$error2."')
// </SCRIPT>");
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

<?PHP
if(@$_POST['EDIT'])
{
$hyitem=@$_POST['hitem'];
$idcard=@$_POST['idcard'];
$uptime=date("Y-m-d H:i:s");
// 
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

$sql_hycenter = "UPDATE hycent
SET pers= TRIM('$idcard'),
x1_pertime='$uptime',
X1='$pstatus'
WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

// Update สำเร็จ
if ($result_hycent_edit== TRUE) {
    $sql = "SELECT * from v_monitor WHERE hyitem = '$hyitem' ";
    $result=mysqli_query($conn,$sql);
    while($arr=mysqli_fetch_array($result)) {
        $na=$arr['name'];       // เจ้าหน้าที่ 0 เปล
        $hn= $arr['hn'];
        $pt=$arr['patients'];   //ชื่อผู้ป่วย
        $fp=$arr['fplace'];
        $tp=$arr['tplace'];
        $eold=$arr['old'];
        $eid=$arr['idcard'];    
    }   
    // 
    define('LINE_API', "https://notify-api.line.me/api/notify");
    $token = "25mN8JLVQXAQjH0awruhaBi6PK1F0itHj47nNWF6VKh"; //ใส่Token ที่copy เอาไว้
    $headers    = [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer '.$token
    ];
    $str= "\r\n".'เตรียมรับ ผป :'.$hn.' '.$pt. 
            "\r\n".'อายุ :'.$eold.' ปี ID '.$eid. 
            "\r\n".'----------------------------------'.
            "\r\n".'ผู้รับงาน :'.$idcard.' '.$na.
            "\r\n".'สถานที่รับ :'.$fp.
            "\r\n".'สถานที่ส่ง :'.$tp.
            "\r\n" .'จ่ายงาน :'.$uptime;
    $res = notify_message($str,$token);
    print_r($res);
    $error1 = ' ส่วนการแก้ไขรายการข้อมูล¨ ';
    $error2 = ' แก้ไขเรีเรียบร้อยแล้ว';
   } else {
        $error1 = ' Update Error ';
        $error2 = ' ไม่สามารถทำการแก้ไขได้ ';
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
WHERE idcard=TRIM('$idcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();
echo $idcard;
$sql_hycenter = "UPDATE hycent
SET pers= TRIM('$idcard'),
perfinish='$uptime',
X1='F'
WHERE hn='$hn' AND pers = '$idcard'; ";
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
        define('LINE_API', "https://notify-api.line.me/api/notify");
        $token = "25mN8JLVQXAQjH0awruhaBi6PK1F0itHj47nNWF6VKh"; //ใส่Token ที่copy เอาไว้
        $headers    = [
          'Content-Type: application/x-www-form-urlencoded',
         'Authorization: Bearer '.$token
     ];
      $str= "\r\n".'เตรียมรับ : '.$asna. 
              "\r\n".'----------------------------------'.
              "\r\n".'ผู้รับงาน : '.$idcard.' '.$pam.
              "\r\n".'สถานที่รัับ : '.$fp.
              "\r\n".'สถานที่ส่ง : '.$tp.
              "\r\n" .'จ่ายงาน : '.$uptime;
      $res = notify_message($str,$token);
      print_r($res);      
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
    define('LINE_API', "https://notify-api.line.me/api/notify");
    $token = "25mN8JLVQXAQjH0awruhaBi6PK1F0itHj47nNWF6VKh"; //ใส่Token ที่copy เอาไว้
    $headers    = [
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer '.$token
    ];
    $str= "\r\n".'รับ : '.$asna. 
            "\r\n".'----------------------------------'.
            "\r\n".'ผู้รับงาน : '.$eidcard.' '.$nam.
            "\r\n".'สถานที่รับ : '.$fp.
            "\r\n".'สถานที่ส่ง : '.$tp.
            "\r\n".'จ่ายงาน : '.$uptime;
    $res = notify_message($str,$token);
    print_r($res);
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
    include('main_top_panel_head.php');
    // include('main_script.php');
?>
</head>

<body>
    <script>
    $(function() {
        Metis.dashboard();
    });
    </script>
    <p>
        <?php
    $sqlc = "SELECT *  from asssent WHERE x1 <> 'F' ";
    $query = mysqli_query($conn,$sqlc);
    $num_rows = mysqli_num_rows($query);
    ?>
    <div class="fluid">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#home"><i class="fa fa-fw fa-bell-o"></i> Monitor</a>
            </li>
            <li>
                <a data-toggle="tab" href="#asset"><i class="fa fa-fw fa-bell-o"></i> เวชภัณฑ์และสิ่งของ<span
                        class="badge badge-danger"><?php echo $num_rows; ?></span></a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="asset" class="tab-pane fade">
                <div class="panel-group">
                    <?php include ('sys_hycall_center_asset_now.php'); ?>
                </div>
            </div>

            <div id="home" class="tab-pane fade in active">
                <div class="panel-group">
                    <!-- Monitor รายการเรียกเปล -->
                    <?php include('sys_hycall_center_per_now.php'); ?>
                </div>
            </div>
        </div>
    </div>
</body>

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
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
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
</div>

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