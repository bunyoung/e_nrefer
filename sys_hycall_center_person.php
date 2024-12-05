<!doctype html>
<meta http-equiv="content-type" content="10;text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php session_start();

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
?>
<?php
//  if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
//      session_start();
// } else {
//     if(!isset($_SESSION)) {  session_start();  }
// }
$idcard = @$_SESSION['idcard'];

require_once('db/date_format.php');
require_once("db/connection.php");
// require_once('function/conv_date.php');
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

<!--  ส่วนการแก้ไขรายการข้อมูล  -->
<?PHP
$hn = @$_POST['hn'];
$eidcard=@$_POST['eidcard'];
$perfremark=@$_POST['hassrem'];
$uptime=date("Y-m-d H:i:s");
$hyitem=@$_POST['hyitem'];
if(@$_POST['EDIT'])
{
// รับเรื่อง
$pstatus='E'; 

$sql_employee = "UPDATE employee
    SET perstatus='$pstatus'
WHERE idcard=TRIM('$eidcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();
if ($result_employee_edit==TRUE){
    echo '<script type="text/javascript">
    swal("", "ข้อมูลได้รับการ Update อย่างสมบูรณ์", "success");
    </script>';
}else{
    echo '<script type="text/javascript">
    swal("", "ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล", "error");
    </script>';
}

$sql_hycenter = "UPDATE hycent
SET perto ='$uptime',
X1='$pstatus',
perremark='$perremark'
WHERE hyitem='$hyitem'; ";
$result_hycent_edit = mysqli_query($conn,$sql_hycenter); mysql_error();

if ($result_hycent_edit== TRUE) {
    echo '<script type="text/javascript">
    swal("", "ข้อมูลได้รับการ Update อย่างสมบูรณ์", "success");
    </script>';
   } else {
    echo '<script type="text/javascript">
    swal("", "ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล", "error");
    </script>';
}

}
?>
<!-- สิ้นสุดการจบงาน -->

<!--  ส่วนการปิดงาน  -->
<?PHP
if(@$_POST['FINISH'])
{
// รับเรื่อง
$pstatus='W'; 

$sql_employee = "UPDATE employee
    SET perstatus='$pstatus'
WHERE idcard=TRIM('$eidcard'); ";
$result_employee_edit = mysqli_query($conn,$sql_employee); mysql_error();

$sql_hycenter = "UPDATE hycent
SET perfinish ='$uptime',
X1='F',
perfremark='$perfremark'
WHERE hn='$hn'; ";
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

<html class="no-js">

<head>
    <?php     
include ("main_script.php")
?>
    <script src="assets/js/style-switcher.min.js"></script>
</head>

<body class="boxed">
    <div class="boxed-wrapper">
        <div class="container">
            <script>
            $(function() {
                Metis.dashboard();
            });
            </script>
            <?php
// require("main_top_panel_session_person.php");
include('main_top_panel_head.php');

?>
            <div id="content3">
                <div class="outer">
                    <div class="inner bg-light lter">
                        <div class="box primary">
                            <header>
                                <h5>ผู้ป่วยที่ รอรับบริการศูนย์เปล ประจำวันที่ <a class="btn btn-success btn-grad">
                                        <?php Echo $d_end; ?> </a>
                                </h5>
                            </header>
                            <p>
                                <?php
#SQL
$sql ="SELECT
*
 from v_monitor where idcard = '$idcard'; ";
$result_sql = mysqli_query( $conn,$sql);
?>
                            <p>
                            <table id="dataTable" class="table table-border table-hover compact" style="width:100%">
                                <thead class="thead-light">
                                    <tr>
                                        <td><strong>HN</strong></td>
                                        <td><strong>ชื่อ-สกุล </strong></td>
                                        <td><strong>เวลารับแจ้ง</strong></td>
                                        <td><strong>เวลาประสาน</strong></td>
                                        <td><strong>เวลาจบงาน</strong></td>
                                        <td><strong>เหตุผลการรับ</strong></td>
                                        <td><strong>เหตุผลปิดงาน</strong></td>
                                        <td><strong>สถานะ</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                                    <tr valign='top'>
                                        <td><?php echo $arr['hn'];?></td>
                                        <td><?php echo $arr['patients'] ?></td>
                                        <td><?php echo $arr['x1_pertime'] ?> </td>
                                        <td><?php echo $arr['perto'] ?></td>
                                        <td><?php echo $arr['perfinish'] ?></td>
                                        <td><?php echo $arr['perremark'] ?></td>
                                        <td><?php echo $arr['perfremark'] ?></td>
                                        <td>
                                            <?php
                              IF($arr['x1']=="R"){
                                echo'<a href="#myModal_receive_finish" data-toggle="modal" 
                                        data-id="'.$arr['hyitem'].'" 
                                        class="btn btn-success btn-xs btn-grad">';
                              }else 
                              if($arr['x1']=='E'){
                                echo'<a href="#myModal_receive_end" data-toggle="modal" 
                                        data-id="'.$arr['hyitem'].'" 
                                        class="btn btn-info btn-xs btn-grad">';
                              }else
                              if($arr['x1']=='F'){
                                echo'<a href="#myModal_receive_end_detail" data-toggle="modal" 
                                        data-id="'.$arr['hyitem'].'" 
                                        class="btn btn-warning btn-xs btn-grad">';                              
                              }else {
                                echo'<a href="#myModal_type_fasta" data-toggle="modal" 
                                        data-id="'.$arr['hyitem'].'"  
                                        class="btn btn-danger btn-xs btn-grad">';

                              }if($arr['x1']=="R"){
                                 echo '<i class="fa fa-check-circle-o"></i>  : ดำเนินการ';
                              }
                              else 
                              IF($arr['x1']=="E"){
                                 echo '<i class="fa fa-check-circle-o"></i>  : รอจบงาน';
                              }else
                              IF($arr['x1']=="F"){
                                echo '<i class="fa fa-check-circle-o"></i>  : จบงานแล้ว';

                              }else{
                                 echo '<i class="fa fa-times"></i>  : รอรับเรื่องจากศูนย์';                              
                                 echo'</a>';
                              }
                              ?>
                                        </td>
                                    </tr>
                                    <?php
                        }
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="assets/js/jquery.js"> </script>
            <script type="text/javascript" src="assets/js/jquery.min.js"> </script>
            <script type="text/javascript" src="assets/js/jquery.flot.min.js"> </script>
            <script type="text/javascript" src="assets/js/jquery.flot.selection.min.js"> </script>
            <script type="text/javascript" src="assets/js/jquery.flot.resize.min.js"> </script>
            <script type="text/javascript" src="assets/js/jquery-ui.min.js"> </script>
            <script type="text/javascript" src="assets/lib/moment/min/moment.min.js"> </script>
            <script type="text/javascript" src="assets/lib/fullcalendar/dist/fullcalendar.min.js"> </script>
            <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"> </script>
            <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"> </script>
            <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"> </script>
            <script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js"> </script>
            <!--Bootstrap -->
            <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js"> </script>
            <!-- MetisMenu -->
            <script type="text/javascript" src="assets/js/metisMenu.min.js">
            </script>
            <!-- Screenfull -->
            <script type="text/javascript" src="assets/js/screenfull.min.js"> </script>

            <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    buttons: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "ALL"]
                    ],
                    "responsive": true
                });
            });
            </script>
            <!-- Preloader -->
            <script type="text/javascript">
            //<![CDATA[
            $(window).load(function() {
                // makes sure the whole site is loaded
                $('#status').fadeOut();
                // will first fade out the loading animation
                $('#preloader').delay(500).fadeOut('slow');
                // will fade out the white DIV that covers the website.
                $('body').delay(800).css({
                    'overflow': 'visible'
                });
            })
            //]]>
            </script>

</body>

</html>

<!--- ภาระงาน 0 เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_finish').on('show.bs.modal', function(e) {
        var hn = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_finish.php', //Here you will fetch records
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

<!--- ภาระงาน 0 เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_end').on('show.bs.modal', function(e) {
        var hyitem_id = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_end_finish.php', //Here you will fetch records
            data: {
                'hid': hyitem_id
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
                    </i> : ปิดงานการของศูนย์เปล [sys]
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
        var hyitem_id= $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_end_finish_detail.php', //Here you will fetch records
            data: {
                'hid': hyitem_id
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
