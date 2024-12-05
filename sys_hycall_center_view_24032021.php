<!doctype html>
<meta http-equiv="content-type" content=";text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
/* include 'sys_hycall_admin_login.php'; */
include 'sys_hycall_user.php';

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
$perfremark=@$_POST['hassrem'];
$uptime=date("Y-m-d H:i:s");

// รับเรื่อง
$pstatus='W'; 

$sql_employee = "UPDATE employee
    SET perstatus='$pstatus'
WHERE idcard=TRIM('$eidcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();

$sql_hycenter = "UPDATE hycent
SET perfinish ='$uptime',
X1='F',
X3='S',
perremark='$perremark'
WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

if ($result_hycent_edit== TRUE) {
   $error1 = ' UPDATER ข้อมูลสำเร็จ ';
   $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
   } else {
        $error1 = ' Update Error ';
        $error2 = ' ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล ';
}

if ($result_employee_edit==TRUE){
   $error1 = ' UPDATER ข้อมูลสำเร็จ ';
   $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
}
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('".$error1.$error2."')
</SCRIPT>");
}
?>
<!-- สิ้นสุดการปิดงาน -->

<!--  ส่วนการแก้ไขรายการข้อมูล  -->
<?PHP
if(@$_POST['FEDIT'])
{
$hyitem = @$_POST['hyitem'];
$eidcard=@$_POST['eidcard'];
$perremark=@$_POST['hassrem'];
$uptime=date("Y-m-d H:i:s");

// รับเรื่อง
$pstatus='E'; 

$sql_employee = "UPDATE employee
    SET perstatus='$pstatus'
WHERE idcard=TRIM('$eidcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();

$sql_hycenter = "UPDATE hycent
SET perto ='$uptime',
X1='$pstatus',
perremark='$perremark'
WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

if ($result_hycent_edit== TRUE) {
   $error1 = ' UPDATER ข้อมูลสำเร็จ ';
   $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
   } else {
        $error1 = ' Update Error ';
        $error2 = ' ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล ';
}

if ($result_employee_edit==TRUE){
   $error1 = ' UPDATER ข้อมูลสำเร็จ ';
   $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
}
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('".$error1.$error2."')
</SCRIPT>");
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
   } else {
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
   } else {
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

// ÃÑºàÃ×èÍ§
$pstatus='R';
$sql_employee = "UPDATE employee
    SET perstatus='$pstatus'
WHERE idcard=TRIM('$idcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();
if ($result_employee_edit==TRUE){
    echo '<script type="text/javascript">
    swal("", "ทำการปรับปรุงข้อมูล เรียบร้อยแล้ว", "success");
    </script>';
 } else {
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

if ($result_hycent_edit== TRUE) {
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

<html class="no-js">

<head>
    <?php
    include('main_top_panel_head.php');
    include('main_script.php');
?>
</head>

<body>
    <script>
    $(function() {
        Metis.dashboard();
    });
    </script>
    <p>
    <div class="container-fluid">
        <div class="alert alert-primary" role="alert">
            <i class="fa fa-wheelchair fa-lg" aria-hidden="true">
                <strong> เข้าสูระบบโดย :  <?php echo $user_name;?></strong>
                <a href="logout.php">Logout</a>
            </i>
        </div>
        <hr>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-fw fa-bell-o"></i> Monitor</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <div class="panel-group">
                    <!-- Monitor รายการเรียกเปล -->
                    <?php include('sys_hycall_center_per_now.php'); ?>
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
<!--Bootstrap -->
<script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js">
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
<!--- มอบหมายงาน 0 เปล -->
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
        var hitem= $(e.relatedTarget).data('id');
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

</html>