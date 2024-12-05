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
if ( $_SESSION['user_name']==FALSE  ) {
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('ไม่พบสิทธิ [user]');
window.location.href='sys_hycall_login.php';
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
require("main_top_panel.php");
}ELSE{
require("main_top_panel_session_setting.php");
}
?>
            <!--ADD USER-->
            <?PHP
if(@$_POST['ADD'])
{
$name=@$_POST['name'];
$username=@$_POST['username'];
$password=@$_POST['password'];
$cid=@$_POST['cid'];
$comment=@$_POST['comment'];
$hisgroup_prav=mysql_real_escape_string(join(@$_POST['hisgroup_prav'],','));
$hisgroup_prav_ok=mysql_escape_string($hisgroup_prav);
IF(@$_POST['user_level']=='1'){$user_level=1;}else{$user_level=0;}
IF(@$_POST['delete_flag']=='1'){$delete_flag=1;}else{$delete_flag=0;}
$delete_date=date("Y-m-d H:i:s");
$add_user_priv=@$_POST['add_user_priv'];
$create_user_id=@$_SESSION['name'];

// ตรวจสอบข้อมูลเดิม
$sqlf = "SELECT * FROM employee WHERE idcard='$cid'";
$sqlresult=mysqli_query($conn,$sqlf);
$row1 =mysqli_num_rows($sqlresult);
if($row1 > 0){
    echo '<script type="text/javascript">
            swal("", "พบเลข วิทยุนี้มีอยู่แล้ว !!", "error");
          </script>';
}
else
{
    $sql_add = " INSERT INTO employee (
    idcard,
    name,
    username,
    passw,
    hisgroup_priv,
    user_level,
    delete_flag,
    delete_date,
    create_user_id)
    VALUES ('$cid','$name','$username','$password',concat('[],','$hisgroup_prav_ok'),'$user_level','$delete_flag','$delete_date','$create_user_id');";
        $result_sql_add = mysqli_query($conn,$sql_add); 

    if ($result_sql_add== TRUE) 
    {
      $error1 = ' เพิ่มข้อมูล จนท ศุนย์เปล successfully ';
      $error2 = ' ระบบเพิ่มข้อมูล '.$name.' เรียบร้อยแล้ว';
    } else {
        $error1 = ' UPDATE ERROR ';
        $error2 = ' ไม่สามารถดำเนินการได้ กรุณาติดต่อผู้ดูแลระบบ';
    }
    echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('".$error1.$error2."')
           </SCRIPT>");
    }
}
?>
            <!--EDIT USER-->
            <?PHP
if(@$_POST['EDIT'])
{
    $idcard=@$_POST['idcard'];
    $name=@$_POST['name'];
    $username=@$_POST['username'];
    $password=@$_POST['password'];
    $position=@$_POST['position'];
    IF(@$_POST['delete_flag']=='1'){$delete_flag=1;}else{$delete_flag=0;}
    $delete_date=date("Y-m-d H:i:s");
    IF(@$_POST['user_level']=='1'){$user_level=1;}else{$user_level=0;}
        $hisgroup_prav=mysql_real_escape_string(join(@$_POST['hisgroup_prav'],','));
        $hisgroup_prav_ok=mysql_escape_string($hisgroup_prav);
    IF(@$_POST['add_user_priv']=='0'){$add_user_priv=0;}else{$add_user_priv=1;}
        $create_user_id=@$_SESSION['name'];

        $sql_edit = "UPDATE employee
        SET
        name='$name',
        username='$username',
        passw='$password',
        position='$position',
        hisgroup_priv=concat('[],','$hisgroup_prav_ok'),
        delete_flag='$delete_flag',
        delete_date='$delete_date',
        user_level='$user_level',
        create_user_id='$create_user_id'
        WHERE trim(idcard)='$idcard' ; ";
            $result_sql_edit = mysqli_query($conn,$sql_edit);
            mysql_error();
        if ($result_sql_edit== TRUE) {
            $error1 = ' UPDATE successfully ';
            $error2 = ' ระบบเพิ่มข้อมูล '.$name.' เรียบร้อยแล้ว';
        } 
        else
        {
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
                                    <h5>เพิ่มข้อมูลผู้ใช้งาน/เจ้าหน้าที่ศูนย์เปล
                                    </h5>
                                </header>
                                <p>
                                <form class="form-horizontal" action="sys_admin_user_add.php" method=POST target="">
                                    <div class="form-group">
                                        <label for="name" class="control-label col-lg-2">ชื่อ-สกุล
                                        </label>
                                        <div class="col-lg-4">
                                            <input type="text" id="name" name="name" placeholder="ชื่อ-สกุล"
                                                class="form-control" value="" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="username" class="control-label col-lg-2">ผู้ใช้งาน
                                        </label>
                                        <div class="col-lg-4">
                                            <input type="text" id="username" name="username" placeholder="username"
                                                class="form-control" value="" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="password" class="control-label col-lg-2">รหัสผ่าน
                                        </label>
                                        <div class="col-lg-4">
                                            <input type="password" id="password" name="password" placeholder="password"
                                                class="form-control" value="" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="cid" class="control-label col-lg-2">เลขวิทยุ
                                        </label>
                                        <div class="col-lg-1">
                                            <input type="text" id="cid" name="cid" placeholder="เลขวิทยุประจำตัว"
                                                class="form-control" value="" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="comment" class="control-label col-lg-2">ตำแหน่ง
                                        </label>
                                        <div class="col-lg-4">
                                            <input type="text" id="position" name="position" placeholder="ตำแหน่ง"
                                                class="form-control" value="">
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">สิทธิการใช้งาน
                                        </label>
                                        <div class="col-lg-4">
                                            <select class="multipleSelect" multiple name="hisgroup_prav[]">
                                                <option value="[admin]">Web Admin[admin]</option>
                                                <option value="[setting]">ตั้งค่า ระบบ[system]</option>
                                                <option value="[hycenter]">ขอเปล [hycenter] </option>
                                                <option value="[monitor]">monitor [monitor]</option>
                                            </select>
                                        </div>
                                        <script>
                                        $('.multipleSelect').fastselect();
                                        </script>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Admin
                                        </label>
                                        <div class="col-lg-2">
                                            <div class="checkbox">
                                                <label>
                                                    <input class="uniform" name="user_level" type="checkbox" value="1">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">ยกเลิกการใช้งาน
                                        </label>
                                        <div class="col-lg-2">
                                            <div class="checkbox">
                                                <label>
                                                    <input class="uniform" name="delete_flag" type="checkbox" value="1">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">
                                        </label>
                                        <input type="hidden" name="add_user_priv" value="1">
                                        <input type="hidden" name="ADD" value="ADD">
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-primary btn-grad btn-rect">เพิ่มข้อมูล
                                                User
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
                                    <h5>แก้ไขข้อมูลผู้ใช้งาน
                                    </h5>
                                </header>
                                <p>
                                    <?php
#SQL
$sql = "SELECT
idcard,
name,
username,
passw,
user_level,
delete_flag,
delete_date,
hisgroup_priv
  FROM employee; ";
$result_sql = mysqli_query( $conn,$sql);
?>
                                <table id="dataTable_" class="table table-bordered table-condensed ">
                                    <colgroup>
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con2" />
                                        <col class="con3" />
                                        <col class="con4" />
                                        <col class="con5" />
                                        <col class="con6" />
                                    </colgroup>
                                    <thead>
                                        <tr class="gradeA">
                                            <th>
                                                <center>ลำดับ
                                                </center>
                                            </th>
                                            <th>
                                                <center>เลขวิทยุ
                                                </center>
                                            </th>
                                            <th>
                                                <center>ชื่อ-สกุล
                                                </center>
                                            </th>
                                            <th>
                                                <center>สิทธิ
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
                                                <?php  echo substr($rs_deb['idcard'],0,4);echo '******';echo substr($rs_deb['idcard'],10,3); ?>
                                            </td>
                                            <td>
                                                <?php    echo $rs_deb['name']; ?>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php IF($rs_deb['user_level']==1){echo'<a class="btn btn-success btn-xs btn-grad">';}ELSE{echo'<a class="btn btn-primary btn-xs btn-grad">';}
IF($rs_deb['user_level']==1){echo 'Admin';}ELSE{echo 'User';}
echo'</a>'; ?>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <?php IF($rs_deb['delete_flag']==0){echo'<a href="#myModal_edit_user" data-toggle="modal" data-id="'.$rs_deb['idcard'].'" class="btn btn-success btn-xs btn-grad">';}ELSE{echo'<a href="#myModal_edit_user" data-toggle="modal" data-id="'.$rs_deb['idcard'].'" class="btn btn-danger btn-xs btn-grad">';}
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
    $('#myModal_edit_user').on('show.bs.modal', function(e) {
        var idcard = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_admin_user_edit.php', //Here you will fetch records 
            data: {
                'idcard': idcard
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_edit_user" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : แก้ไขข้อมูลจ้าหน้เจ้าหน้าที่ศูนย์เปล และที่ีสิทธิผู้ใช้งานระบบโปรแกรม E-Hycenter
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