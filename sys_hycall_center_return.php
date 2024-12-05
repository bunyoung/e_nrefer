<!doctype html>
<!-- <meta http-equiv="refresh" content="30"> -->
<meta http-equiv="content-type" content="10;text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
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
if(@$_POST['ADD'])
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

// เพิ่มรายการใหม่
$sqlins = "INSERT INTO hycent (hdate, hn, patients, depart, hass, hassn, rfto, rfquick, x2, hyquick_a, hyquick_b) 
                     SELECT hdate, hn, patients, rfto, hass, hassn, depart, rfquick, x2, hyquick_a, hyquick_b from hycent 
    WHERE hyitem = $hyitem ";
$result = mysqli_query($conn,$sqlins);
// echo $sqlins; exit();
if($result==TRUE)
{
   $sqlupdate = "UPDATE hycent SET x3='S',x1='X',assreturn='0' WHERE hyitem='$hyitem' ";
   $up_result = mysqli_query($conn,$sqlupdate);
    //      
   $error1 = ' UPDATER ข้อมูลสำเร็จ ';
   $error2 = ' ข้อมูลได้รับการ Update อย่างสมบูรณ์';
}else{
   $error1 = ' Update Error ';
   $error2 = ' ไม่สามารถดำเนินการได้ แฟ้มข้อมูลการร้องขอ ศูนย์เปล ';
}echo ("<SCRIPT LANGUAGE='JavaScript'>
             window.alert('".$error1.$error2."')
          </SCRIPT>"); 
}
?>
<!-- สิ้นสุดการปิดงาน -->

<html class="no-js">

<head>
<?php
include('main_top_panel_head.php');
include ('main_script.php');
?>
</head>

<body>
    <div class="bg-blue dker" id="wrap">
        <script>
        $(function() {
            Metis.dashboard();
        });
        </script>
        <div class="inner bg-light lter">
            <div class="box primary">
                <header>
                    <h5><i class='fa fa-wheelchair fa-2x'></i> ได้รับบริการศูนย์เปล <a
                            class="btn btn-success btn-danger">รอส่งกลับ</a> ประจำวันที่ <a
                            class="btn btn-success btn-grad">
                            <?php Echo $d_end; ?> </a>
                    </h5>
                </header>
                <p>

<?php
// echo $d_default; exit();
?>

                    <?php
#SQL
$sql ="SELECT
        *
  from v_monitor
 where x3='X' AND hdate = '$d_default'; ";
$result_sql = mysqli_query( $conn,$sql);
// 

?>
<!-- table-bordered  table-condensed table-striped table-hover -->
                <table id="dataTable" class="table table-responsive table-bordered  table-condensed table-striped table-hover"
                            data-show-refresh="true"
                            data-auto-refresh="true"
                            style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <td><strong>HN</strong></td>
                            <td><strong>ชื่อ-สกุล </strong></td>
                            <td><strong>เวลาเริ่ม</strong></td>
                            <td><strong>จาก </strong></td>
                            <td><strong>ส่ง</strong></td>
                            <td><strong>อุปกรณ์</strong></td>
                            <td><strong>เพิ่ม</strong></td=>
                            <td><strong>ประเภท</strong></td>
                            <td><strong>เปล</strong></td>
                            <td><strong>รับ</strong></td>
                            <td align='center'><strong>ยืนยัน</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                        <tr valign='top'>
                            <td><?php  echo $arr['hn']; ?> </td>
                            <td><?php echo $arr['patients'] ?></td>
                            <td><?php echo substr($arr['htime'],11,8); ?></td>
                            <td><?php echo $arr['fullplace'] ?></td>
                            <td><?php echo $arr['placeb'] ?></td>
                            <td><?php echo $arr['hassname'] ?></td>
                            <td><?php echo $arr['b'] ?></td>
                            <td><?php echo $arr['assname'] ?></td>
                            <td>
                                <?php
                               IF($arr['pers']==""){
                                 echo '<i class="fa fa-bell-slash" style="color:red"></i> ';}
                               ELSE {
                                 echo ''.$arr['pers'];} ;
                               ?>
                            </td>

                            <td><?php echo $arr['x1_pertime'] ?></td>
                            <td align="center">
                                <?php
                                IF($arr['x1']=="F") {
                                    echo'<a href="#myModal_receive_wait" data-toggle="modal" data-id="'.$arr['hyitem'].'" 
                                                 class="btn btn-info btn-grad">';
                                }                             
                                // กรณีที่มีการร้องขอ
                                IF($arr['x1']=='F')
                                {
                                    echo '<i class="fa fa-thumbs-o-up"></i>: ส่งกลับ';
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
                "scrollX": true,
                "responsive": true
            });
        });
        </script>

        <!-- <script type="text/javascript" src="assets/js/ajax_jquery.min.js">
    </script> -->
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
<!--- มอบหมายงาน 0 เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_wait').on('show.bs.modal', function(e) {
        var hn = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_end_finish_patients.php', //Here you will fetch records
            data: {
                'hn_id': hn
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
                <h5 class="modal-title text-success">
                    <i class="fa fa-user">
                    </i> : มอบหมายงานให้เจ้าหน้าที่ศูนย์เปล
                </h5>
            </div>
            <div class="modal-body text-success">
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