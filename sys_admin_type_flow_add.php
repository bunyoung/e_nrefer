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
    <script src="assets/js/style-switcher.min.js">
    </script>
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
$placecode=@$_POST['placecode'];
$fullplace=@$_POST['fullplace'];
$flow=@$_POST['flow'];
IF(@$_POST['delete_flag']=='1'){$delete_flag=1;}else{$delete_flag=0;}

// Recheck duplicate data
$sqlf = "SELECT * FROM places WHERE placecode='$placecode'";
$sqlresult=mysqli_query($conn,$sqlf);
$row1 =mysqli_num_rows($sqlresult);
if($row1 > 0){
    echo '<script type="text/javascript">
            swal("", "พบรหัสสถานที่ นี้มีอยู่แล้ว !!", "error");
          </script>';
}
else
{
$sql_add = "INSERT INTO places (
placecode,
fullplace,
flow)
VALUES ('$placecode','$fullplace','$flow');";
$result_sql_add = mysqli_query($conn,$sql_add);

if ($result_sql_add== TRUE) {
    echo '<script type="text/javascript">
            swal("", "บันทึกรายการ เสร็จเรียบร้อยแล้ว !!", "success");
          </script>';
} else {
    echo '<script type="text/javascript">
            swal("", "มีปัญหาในการบันทึกรายข้อมูล!!", "error");
          </script>';
}
}
}
?>
            <?PHP
if(@$_POST['EDIT'])
{

$hid = @$_POST['hid'];
$placecode=@$_POST['placecode'];
$flow=@$_POST['flow'];
$fullplace=@$_POST['fullplace'];
IF(@$_POST['delete_flag']=='1'){$delete_flag=1;}else{$delete_flag=0;}

$sql_edit = "UPDATE places
SET
placecode='$placecode',
fullplace='$fullplace',
flow = '$flow',
delete_flag='$delete_flag'
WHERE place_id='$hid' ; ";
$result_sql_edit = mysqli_query($conn,$sql_edit);
mysql_error();
if($result_sql_edit== TRUE) {
    echo '<script type="text/javascript">
            swal("", "แก้ไขรายการ เสร็จเรียบร้อยแล้ว !!", "success");
          </script>';
} else {
    echo '<script type="text/javascript">
            swal("", "มีปัญหาในการแก้ไขข้อมูล!!", "error");
          </script>';
}
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
                                    <h5>เพิ่มข้อมูลประเภทสถานที่
                                    </h5>
                                </header>
                                <p>
                                <form class="form-horizontal" action="sys_admin_type_place_add.php" method=POST
                                    target="">
                                    <div class="form-group">
                                        <label for="placecode" class="control-label col-lg-2">รหัสที่ส่ง
                                        </label>
                                        <div class="col-lg-2">
                                            <input type="text" id="placecode" name="placecode" placeholder="รหัสสถานที"
                                                class="form-control" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fullplace" class="control-label col-lg-2">ชื่อสถานทที่
                                        </label>
                                        <div class="col-lg-4">
                                            <input type="text" id="fullplace" name="fullplace" placeholder="ชื่อสถานที"
                                                class="form-control" value="" required>
                                        </div>
                                    </div>

                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="fullplace" class="control-label col-lg-2">สายงาน
                                        </label>
                                        <div class="col-lg-1">
                                            <select name="flow">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">ยกเลิกการใช้งาน
                                        </label>
                                        <div class="col-lg-2">
                                            <div class="checkbox">
                                                <label>
                                                    <input class="delete_flag" name="delete_flag" type="checkbox"
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
                                            <button type="submit" class="btn btn-primary btn-grad btn-rect">เพิ่มสถานที่
                                            </button>
                                        </div>
                                    </div>
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
                                    <h5>แก้ไขรายการสถานที่
                                    </h5>
                                </header>
                                <p>
                                    <?php
#SQL
$sql = "SELECT
place_id,
placecode,
fullplace,
flow,
delete_flag,
delete_date
FROM flow; ";
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
                                                <center>รหัสสถานที
                                                </center>
                                            </th>
                                            <th>
                                                <center>ชื่อสถานที
                                                </center>
                                            </th>
                                            <th>
                                                <center>สายงาน
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
                                                <center><?php  echo $rs_deb['placecode']; ?> </center>
                                            </td>
                                            <td>
                                                <?php    echo $rs_deb['fullplace']; ?>
                                            </td>
                                            <td>
                                                <?php    echo $rs_deb['flow']; ?>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php IF($rs_deb['delete_flag']==0){echo'<a href="#myModal_type_place" data-toggle="modal" data-id="'.$rs_deb['place_id'].'" class="btn btn-success btn-xs btn-grad">';}ELSE{echo'<a href="#myModal_type_place" data-toggle="modal" data-id="'.$rs_deb['place_id'].'" class="btn btn-danger btn-xs btn-grad">';}
IF($rs_deb['delete_flag']==0){echo '<i class="fa fa-thumbs-o-up"></i> : Edit';}ELSE{echo '<i class="fa fa-times"></i> : Edit';}
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
            $("#dataTable_").DataTable({
                "pageLength": 10, //จำนวนข้อมูลที่ให้แสดง ต่อ 1 หน้า
                "searching": true, //เปิด=true ปิด=false ช่องค้นหาครอบจักรวาล
                "lengthChange": false, //เปิด=true ปิด=false ช่องปรับขนาดการแสดงผล
            });
        });
        </script>
        <!-- <script>
        $(document).ready(function() {
            $('#dataTable_').dataTable();
        });
        </script> -->
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
    $('#myModal_type_place').on('show.bs.modal', function(e) {
        var hid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_admin_type_flow_edit.php', //Here you will fetch records
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
<div class="modal fade" id="myModal_type_place" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : แก้ไขข้อมูลเกี่ยวกับสถานที่่ E-Hycenter
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