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
    require("main_top_panel_head_admin.php");
}
?>
            <!--ADD USER-->
            <?PHP
if(@$_POST['ADD'])
{
$code=@$_POST['code'];
$name=@$_POST['name'];
$lcolo=@$_POST['lcolo'];
$uni=@$_POST['unit'];
$link=@$_POST['linkh'];
IF(@$_POST['linkh']=='1'){$linkh='1';}else{$linkh='0';}
IF(@$_POST['status']=='1'){$status='1';}else{$status='0';}
$sql_add = "INSERT INTO sys_asset(
asscode,
assname,
asscolor,
assunit,
linkhos,
status)
VALUES ('$code','$name','$lcolo','$uni','$status','$link');";
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
    $hid = @$_POST['hid'];
    $code=@$_POST['code'];
    $name=@$_POST['name'];
    $uni=@$_POST['unit'];
    $lcolo=@$_POST['lcolo'];
    $link=@$_POST['lnkh'];
    IF(@$_POST['linkh']=='1'){$linkh='1';}else{$linkh='0';}
    IF(@$_POST['status']=='1'){$status='1';}else{$status='0';}
    $sql_edit = "UPDATE sys_asset
    SET
    asscode='$code',
    assname='$name',
    asscolor='$lcolo',
    assunit='$uni',
    linkhos='$linkh',
    status='$status'
    WHERE assetid='$hid' ; ";
    $result_sql_edit = mysqli_query($conn,$sql_edit);
    mysql_error();
    if ($result_sql_edit== TRUE) {
    $error1 = ' UPDATE successfully ';
    $error2 = ' ระบบเพิ่มข้อมูล เรียบร้อยแล้ว';
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
                            <!-- เพิ่ม-->
                            <div class="box">
                                <header>
                                    <div class="icons">
                                        <i class="fa fa-user">
                                        </i>
                                    </div>
                                    <h5>เพิ่มข้อมูลประเภทอุปกรณ์ โลจิสติกส์
                                    </h5>
                                </header>
                                <p>
                                <form class="form-horizontal" action="sys_admin_type_assets_add.php" method=POST
                                    target="">
                                    <div class="form-group">
                                        <label for="name" class="control-label col-lg-2">รหัสประเภท
                                        </label>
                                        <div class="col-lg-1">
                                            <input type="text" id="code" name="code" placeholder="รหัสประเภท"
                                                class="form-control" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="control-label col-lg-2">ประเภทอุปกรณ์
                                        </label>
                                        <div class="col-lg-4">
                                            <input type="text" id="name" name="name" placeholder="ประเภทอุปกรณ์"
                                                class="form-control" value="" required>
                                        </div>
                                    </div>
                                    <?php 
                                        $SQLhyass = mysqli_query($conn,"SELECT id,unit
                                        FROM sys_unit Where status = '0'
                                            ORDER BY unit") OR die(mysqli_error());
                                    ?>

                                    <div class="form-group">
                                        <label for="name" class="control-label col-lg-2">หน่วยนับ
                                        </label>

                                        <div class="col-lg-2">
                                            <select class="form-control" name="unit" id="sel_hyass">
                                                <option value="" selected disabled>(เลือกรายการ)</option>
                                                <?php
                                        while($row1=mysqli_fetch_array($SQLhyass))
                                        {
                                        ?>
                                                <option value="<?php echo $row1['id'];?>">
                                                    <?php echo '['.$row1['id'].']'.' '.$row1['unit'];?>
                                                </option>
                                                <?php
                                        }
                                        ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="control-label col-lg-2">รหัสสี</label>
                                        <div class="col-lg-2">
                                            <select class="form-control" name="lcolo">
                                                <option value="X">ไม่มี</option>
                                                <option value="G">เขียว</option>
                                                <option value="R">แดง</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-2">เชื่อมระบบ รพ</label>
                                        <div class="col-lg-1">
                                            <div class="checkbox">
                                                <label>
                                                    <input class="status" name="linkh" type="checkbox" value="1">
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-2">ยกเลิกการใช้งาน</label>
                                        <div class="col-lg-1">
                                            <div class="checkbox">
                                                <label>
                                                    <input class="status" name="status" type="checkbox" value="1">
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-lg-2">
                                        </label>
                                        <input type="hidden" name="ADD" value="ADD">
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-primary btn-grad btn-rect">เพิ่มอุปกรณ์
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
                                    <h5>แก้ไขรายการอุประเภทอุปกรณ์
                                    </h5>
                                </header>
                                <p>
                                    <?php
#SQL
$sql = "SELECT
assetid,
asscode,
assname,
asscolor,
linkhos,
assunit,(select unit from sys_unit WHERE id=assunit AND status='0') as dss,
status
FROM sys_asset; ";
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
                                                <center>ชื่อรายการ
                                                </center>
                                            </th>
                                            <th>
                                                <center>หน่วยนับ
                                                </center>
                                            </th>
                                            <th>
                                                <center>รหัสสี
                                                </center>
                                            </th>
                                            <th>
                                                <center>เชื่อมระบบ
                                                </center>
                                            </th>
                                            <th>
                                                <center>การใช้งาน
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
                                                <center>
                                                    <?php    echo $rs_deb['asscode']; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <?php    echo $rs_deb['assname']; ?>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php    echo $rs_deb['dss']; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php 
                                                        if($rs_deb['asscolor']=='R') {
                                                          echo 'แดง';
                                                        }else{
                                                          if($rs_deb['asscolor']=='G') {
                                                            echo 'เขียว';
                                                          }else{
                                                            echo 'ไม่มี';
                                                          }
                                                        }
                                                    ?>
                                                </center>
                                            </td>
                                            <th>
                                                <center>
                                                    <?php 
                                                        IF($rs_deb['linkhos']=='0'){
                                                            ?>
                                                            <a class="text text-success">
                                                                <?php
                                                            echo '<i class="fa fa-times"></i> : ไม่เชื่อม';
                                                            ?>
                                                            </a>
                                                            <?php
                                                        }ELSE{
                                                            echo '<i class="fa fa-thumbs-o-up"></i> : เชื่อม';
                                                        }
                                                        echo'</a>'; 
                                                        ?>
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    <?php 
                                                        IF($rs_deb['status']=='0'){
                                                            echo '<i class="fa fa-thumbs-o-up"></i> : ใช้';
                                                        }ELSE{
                                                            echo '<i class="fa fa-times"></i> : ไม่ได้ใช้';
                                                        }
                                                        echo'</a>'; 
                                                        ?>
                                                </center>
                                            </th>

                                            <th>
                                                <center>
                                                    <?php 
                                                    IF($rs_deb['status']=='0'){
                                                        echo'<a href="#myModal_type_patient" data-toggle="modal" data-id="'.$rs_deb['assetid'].'"
                                                            class="btn btn-success btn-xs btn-grad">';
                                                    }ELSE{
                                                        echo'<a href="#myModal_type_patient" data-toggle="modal" data-id="'.$rs_deb['assetid'].'"
                                                            class="btn btn-danger btn-xs btn-grad">';}

                                                    echo '<i class="fa fa-thumbs-o-up"></i> : แก้ไข';
                                                    echo'</a>'; ?>
                                                </center>
                                            </th>
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
    $('#myModal_type_patient').on('show.bs.modal', function(e) {
        var hid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_admin_type_assets_edit.php', //Here you will fetch records
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
<div class="modal fade" id="myModal_type_patient" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : แก้ไขข้อมูลใช้งานระบบโปรแกรม E-Hycenter
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