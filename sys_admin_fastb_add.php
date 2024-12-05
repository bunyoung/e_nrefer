<!doctype html>
<!-- couter visit -->
<?php
#echo basename($_SERVER['PHP_SELF']); /* Returns The Current PHP File Name */
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
?>
<?php
if(!isset($_SESSION)) {  session_start();  }
#ตรวจสอบสิทธิการเข้าใช้งาน
// $_SESSION['user_name']=$row['name'];
// $_SESSION['user_id']=$row['idcard'];
// $_SESSION['user_idx']=$row['username'];
if ( $_SESSION['username']==FALSE  ) {
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('ไม่พบสิทธิ [user]');
</SCRIPT>");
}
require_once("db/connection.php");
require_once("db/date_format.php");
?>
<html class="no-js">

<head>
    <?php
include ("main_script.php")
?>
    <!-- Preloader Page -->
    <!-- <div id="preloader">
        <div id="status">
            <img src="img/logo.png" width="210" />
            <span style="padding-left: 60px; color: #999999;">กรุณารอสักครู่...
            </span>
        </div>
    </div> -->
    <!-- Background& Color scripts -->
    <script src="assets/js/style-switcher.min.js"> </script>
</head>

<body class="boxed">
    <div class="boxed-wrapper">
        <div class="bg-blue dker" id="wrap">
            <script>
            $(function() {
                Metis.dashboard();
            });
            </script>
            <?php
if (@$_SESSION['sess_userid'] <> session_id().@$_SESSION['web_login'].@$_SESSION['username']) {
require("main_top_panel_head.php");
}ELSE{
require("main_top_panel_session_setting.php");
}
?>
            <!--ADD USER-->
            <?PHP
if(@$_POST['ADD'])
{
$fastname=@$_POST['fastname'];
IF(@$_POST['faststatus']=='1'){$faststatus=1;}else{$faststatus=0;}

$sql_add = " INSERT INTO fast_sick_b (
fastb_name,
fastb_status)
VALUES ('$fastname','$faststatus');";
$result_sql_add = mysqli_query($conn,$sql_add);

if ($result_sql_add== TRUE) {
$error1 = ' เพิ่มข้อมูล successfully ';
$error2 = ' ระบบเพิ่มข้อมูล '.$name.' เรียบร้อยแล้ว';
} else {
$error1 = ' UPDATE ERROR ';
$error2 = ' ไม่สามารถดำเนินการได้ กรุณาติดต่อผู้ดูแลระบบ';
}
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('".$error1.$error2."')
</SCRIPT>");
}
?>
            <!--END ADD USER-->

            <!--EDIT USER-->
            <?PHP
if(@$_POST['EDIT'])
{

$hid = @$_POST['fastid'];
$fastname=@$_POST['fastname'];
IF(@$_POST['faststatus']=='1'){$faststatus=1;}else{$faststatus=0;}

$sql_edit = "UPDATE fast_sick_b
SET
fastb_name='$fastname',
fastb_status='$faststatus'
WHERE fastb_id='$hid' ; ";
$result_sql_edit = mysqli_query($conn,$sql_edit);
mysql_error();
if ($result_sql_edit== TRUE) {
$error1 = ' UPDATE successfully ';
$error2 = ' ระบบแก้ไขข้อมูล ให้เรียบร้อยแล้ว';
} else {
$error1 = ' UPDATE ERROR ';
$error2 = ' ไม่สามารถดำเนินการได้ กรุณาติดต่อผู้ดูแลระบบ';
}
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('".$error1.$error2."')
</SCRIPT>");
}
?>
            <!--END EDIT USER-->
            <div id="content3">
                <div class="outer">
                    <div class="inner bg-light lter">
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <h5> : ฟอร์มข้อมูล ด่วนวิกฤต
                                    </h5>
                                </header>
                                <p>
                                <form class="form-horizontal" action="sys_admin_fastb_add.php" method=POST target="">
                                    <div class="form-group">
                                        <label for="fullplace" class="control-label col-lg-2">รายการ :
                                        </label>
                                        <div class="col-lg-4">
                                            <input type="text" id="fastname" name="fastname"
                                                placeholder="รายการด่วนวิกฤต" class="form-control" value="" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">ยกเลิกการ :
                                        </label>
                                        <div class="col-lg-2">
                                            <div class="checkbox">
                                                <label>
                                                    <input class="faststatus" name="faststatus" type="checkbox"
                                                        value="1">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">
                                        </label>
                                        <input type="hidden" name="ADD" value="ADD">
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-primary btn-grad btn-rect">เพิ่มข้อมูล
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </form>
                                </p>
                            </div>
                            <!-- แก้ไข-->
                            <div class="box">
                                <header>
                                    <div class="icons">
                                        <i class="fa fa-group">
                                        </i>
                                    </div>
                                    <h5>แก้ไขรายการข้อมูล ด่วนวิกฤต
                                    </h5>
                                </header>
                                <p>
                                    <?php
#SQL
$sql = "SELECT
fastb_id,
fastb_name,
fastb_status
FROM fast_sick_b; ";
$result_sql = mysqli_query( $conn,$sql);
?>
                                <table id="dataTable_" class="table table-bordered table-condensed ">
                                    <colgroup>
                                        <col class="con0" />
                                    </colgroup>
                                    <thead>
                                        <tr class="gradeA">
                                            <th>
                                                <center>ลำดับ
                                                </center>
                                            </th>
                                            <th>
                                                <center>รหัส
                                                </center>
                                            </th>
                                            <th>
                                                <center>รายการ
                                                </center>
                                            </th>
                                            <th>
                                                <center>สถานะ
                                                </center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$i=1;
while($rs_deb=mysqli_fetch_array($result_sql)) {
?>
                                        <tr>
                                            <td>
                                                <center>
                                                    <?php    $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                                                </center>
                                            </td>
                                            <td>
                                                <center><?php  echo $rs_deb['fastb_id']; ?> </center>
                                            </td>
                                            <td>
                                                <center><?php  echo $rs_deb['fastb_name']; ?> </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php IF($rs_deb['fastb_status']==0){
                                                           echo'<a href="#myModal_type_fasta" data-toggle="modal" data-id="'.$rs_deb['fastb_id'].'" class="btn btn-success btn-xs btn-grad">';
                                                          }ELSE{
                                                            echo'<a href="#myModal_type_fasta" data-toggle="modal" data-id="'.$rs_deb['fastb_id'].'" class="btn btn-danger btn-xs btn-grad">';}
                                                          IF($rs_deb['fastb_status']==0){
                                                            echo '<i class="fa fa-thumbs-o-up"></i> : Edit';
                                                          }ELSE{
                                                            echo '<i class="fa fa-times"></i> : Edit';}
                                                            echo'</a>'; ?>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php
}
?>
                                    </tbody>
                                </table>
                                </p>
                            </div>
                            <!--ประมลผลหน้าเวบ -->
                            <?php
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$endtime = $mtime;
$totaltime = ($endtime - $starttime);
?>
                            <span class="help-block" style="color: #c8c8c8; font-size: 12px;">
                                <i class="fa fa-clock-o">
                                </i> ใช้เวลาในการประมวลผลหน้านี้
                                <?php echo number_format($totaltime, 4);?> วินาที
                            </span>
                            <span class="help-block" style="color:#a9b0aa; font-size: 12px;">
                                <i class="fa fa-hand-o-right ">
                                </i> หน้านี้ถูกเปิดดูทั้งหมด
                                <?php echo $count;?> ครั้ง
                            </span>
                            <!--เลื่อนขึ้นบน -->
                            <a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
                                <i class="fa fa-angle-double-up">
                                </i> Back To Top
                            </a>
                        </div>
                        <!-- กรอบนอกสุด -->
                        <hr>
                    </div>
                    <!-- /.inner -->
                </div>
                <!-- /.outer -->
                <script>
                $(function() {
                    Metis.MetisTable();
                    Metis.metisSortable();
                });
                </script>
            </div>
            <!-- /#content -->
            <?php
require("main_footer_panel.php");
?>
        </div>
        <script type="text/javascript" src="assets/js/jquery.js">
        </script>
        <script type="text/javascript" src="assets/js/jquery.min.js">
        </script>
        <script type="text/javascript" src="assets/js/jquery.flot.min.js">
        </script>
        <script type="text/javascript" src="assets/js/jquery.flot.selection.min.js">
        </script>
        <script type="text/javascript" src="assets/js/jquery.flot.resize.min.js">
        </script>
        <script type="text/javascript" src="assets/js/jquery-ui.min.js">
        </script>
        <script type="text/javascript" src="assets/lib/moment/min/moment.min.js">
        </script>
        <script type="text/javascript" src="assets/lib/fullcalendar/dist/fullcalendar.min.js">
        </script>
        <!--TABLE  -->
        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js">
        </script>
        <script type="text/javascript" src="assets/js/dataTables.bootstrap.js">
        </script>
        <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js">
        </script>
        <script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js">
        </script>
        <!--Bootstrap -->
        <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js">
        </script>
        <!-- MetisMenu -->
        <script type="text/javascript" src="assets/js/metisMenu.min.js">
        </script>
        <!-- Screenfull -->
        <script type="text/javascript" src="assets/js/screenfull.min.js">
        </script>
        <!-- Metis core scripts -->
        <script type="text/javascript" src="assets/js/core.min.js">
        </script>
        <!-- Metis demo scripts -->
        <script type="text/javascript" src="assets/js/app.js">
        </script>
        <script src="assets/js/style-switcher.min.js">
        </script>
        <script>
        $(document).ready(function() {
            $('#dataTable_').dataTable();
        });
        </script>
</body>
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

<!---MODAL EDIT USER -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_type_fasta').on('show.bs.modal', function(e) {
        var hid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_admin_fastb_edit.php', //Here you will fetch records
            data: {
                'hid': hid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_type_fasta" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : แก้ไขข้อมูลด่วนวิกฤต
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด
                </button>
            </div>
        </div>
    </div>
</div>
<!---END MODAL EDIT USER -->

</html>