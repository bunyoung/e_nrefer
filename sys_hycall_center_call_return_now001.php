<!DOCTYPE html>
<?php
include("db/connection.php");
?>

<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php
#SQL
$sql ="SELECT * FROM v_monitor
WHERE hdate = '$d_default' and x1 ='F' and usereturn = '0' And x2 is null";
$result_sql = mysqli_query( $conn,$sql);
?>

<html class="no-js">
<div class="" atl="">
    <head>
        <?php include('main_script.php');?>
    </head>
    <!-- Preloader Page -->
    <div id="preloader">
        <div id="status">
            <img src="img/logo.png" width="210" />
            <span style="padding-left: 60px; color: #999999;">กรุณารอสักครู่...
            </span>
        </div>
    </div>

    <body>
        <div class="boxed-wrapper">
            <div class="bg-blue dker" id="wrap">
                <script>
                $(function() {
                    Metis.dashboard();
                });
                </script>
                <!-- <div class="fluid"> -->
                <div class="outer">
                    <div class="inner bg-light lter">
                        <header>
                            <div class="icons"><i class="fa fa-user" aria-hidden="true"></i>
                            </div>

                            <h5 id="div1">ทะเบียนผู้ป่วยที่อยู่ระหว่างการดำเนินการเคลื่อนย้าย (รอส่งกลับ)
                                ประจำวันที่_
                                <a class="text-success">
                                    <?PHP echo $d_default; ?>
                                </a>
                            </h5>
                        </header>
<br>
                        <!-- <div id="collapse4" class="body" style="overflow:scroll"> -->
                        <table id="sdataTable" class="table table-bordered table-condensed table-hover table-striped"
                            style="width:100%;">
                            <thead>
                                <tr>
                                    <td><strong>HN</strong></td>
                                    <td><strong>ชื่อ-สกุล </strong></td>
                                    <td><strong>รับจาก </strong></td>
                                    <td><strong>ปภ ผป.</strong></td>
                                    <td><strong>อุปกรณ์</strong></td>
                                    <td><strong>อุปกรณ์เพิ่ม</strong></td=>
                                    <td><strong>ผป.</strong></td>
                                    <td><strong>เปล</strong></td>
                                    <td><strong>เริ่ม</strong></td>
                                    <td><strong>รับ</strong></td>
                                    <td><strong>ปิด</strong></td>
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
                                    <td><?php echo $arr['tplace'] ?></td>
                                    <td><?php echo $arr['assname'] ?></td>
                                    <td><?php echo $arr['hassnamea']?></td>
                                    <td><?php echo $arr['hassnameb']?></td>
                                    <td><?php echo $arr['sicka'].' '.$arr['sickb'].' '.$arr['sickc'].' '.$arr['sickd'].' '.$arr['sicke'].' '.$arr['sickf'].' '.$arr['sickg'].' '.$arr['ems']; ?>
                                    </td>
                                    <td>
                                        <?php
                    IF($arr['pers']==""){
                        echo '<i class="fa fa-bell-slash" style="color:red"></i> ';}
                    ELSE {
                        echo ''.$arr['name'];} ;
                    ?>
                                    </td>
                                    <!-- <td><?php echo substr($arr['htime'],11,8); ?></td> -->
                                    <td><?php echo $arr['htime']; ?></td>
                                    <td><?php echo $arr['x1_pertime']; ?></td>
                                    <td><?php echo $arr['perfinish']; ?></td>
                                    <td align="center">
                                        <?php
                        echo'<a href="#myModal_receive_wait" data-toggle="modal" data-id="'.$arr['hyitem'].'" 
                                        class="btn btn-info btn-grad">';
                        echo '<i class="fa fa-thumbs-o-up"></i>: ส่งกลับ';
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

    </body>
</div>
<!-- Preloader -->
<!-- ajax selection   -->
<!-- <script type="text/javascript" src="./assets/js/ajax_jquery.min.js"></script> -->
<!--- Script layout -->
<!-- App scripts -->
<script type="text/javascript" src="./assets/js/jquery.js"> </script>
<script type="text/javascript" src="./assets/js/jquery.min.js"> </script>
<script type="text/javascript" src="./assets/js/jquery-ui.min.js"> </script>
<script type="text/javascript" src="./assets/lib/moment/min/moment.min.js"> </script>
<script type="text/javascript" src="./assets/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="./assets/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="./assets/js/jquery.tablesorter.min.js">
</script>
<script type="text/javascript" src="./assets/js/jquery.ui.touch-punch.min.js">
</script>
<script type="text/javascript" src="./assets/lib/bootstrap/dist/js/bootstrap.min.js">
</script>

<script type="text/javascript">
$(function() {
    $('#boxed-layout').click(function() {
        if ($('body').hasClass('boxed')) {
            $('body').removeClass('boxed');
            $('.status-boxed-layout').html("Off")
        } else {
            $('body').addClass('boxed');
            $('.status-boxed-layout').html("<span class='text-success font-bold'>On</span>");
            $('body').removeClass('fixed-small-header');
            $('body').removeClass('sidebar-scroll');
            $('#navigation').slimScroll({
                destroy: true
            });
            $('#navigation').attr('style', '');
            $('body').removeClass('fixed-navbar');
            $('body').removeClass('fixed-footer');
            $('.status-fixed-small-header').html("Off");
            $('.status-fixed-footer').html("Off");
            $('.status-fixed-sidebar').html("Off");
            $('.status-fixed-navbar').html("Off");
        }
    });
});
</script>
<!--- End Script layout -->
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

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    $('#sdataTable').dataTable({
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

</html>