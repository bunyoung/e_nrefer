<!doctype html>
<!-- couter visit -->
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
?>
<?php
if(!isset($_SESSION)) {  session_start();  }
#ตรวจสอบสิทธิการเข้าใช้งาน
require_once("db/connection.php");
require_once("db/date_format.php");
?>
<html class="no-js">

<head>
    <?php     
        include ("main_script.php");
        require("main_top_panel_head_admin.php");
    ?>
    <script src="assets/js/style-switcher.min.js"></script>
</head>

<body class="boxed">
    <div class="bg-blue dker" id="wrap">
        <script>
        $(function() {
            Metis.dashboard();
        });
        </script>
        <div id="content3">
            <div class="outer">
                <div class="inner bg-light lter">
                    <div class="col-lg-12">
                        <div class="box">
                            <header>
                                <div class="icons">
                                    <i class=" fa fa-cog"></i>
                                </div>
                                <h5>ตั้งค่าระบบงาน โลจิสติกส์</h5>
                            </header>
                            <p>
                            <ol class="list-ordered">

                                <p>
                                    <li>
                                        <a href="sys_admin_logis_place_add.php" data-toggle="tooltip" data-placement="bottom"
                                            class="btn btn-success btn-grad btn-rect">
                                            <i class="fa fa-cogs">
                                            </i> : หน่วยส่งปลายทาง
                                        </a>
                                    </li>
                                </p>

                                <p>
                                    <li>
                                        <a href="sys_admin_type_unit_add.php" data-toggle="tooltip"
                                            data-placement="bottom" class="btn btn-success btn-grad btn-rect">
                                            <i class="fa fa-cogs">
                                            </i> : ประเภทหน่วยนับ
                                        </a>
                                    </li>
                                </p>
                                <p>
                                    <li>
                                        <a href="sys_admin_type_assets_add.php" data-toggle="tooltip"
                                            data-placement="bottom" class="btn btn-success btn-grad btn-rect">
                                            <i class="fa fa-cogs">
                                            </i> : รายการประเภทของจัดส่ง
                                        </a>
                                    </li>
                                </p>
                                </p>
                            </ol>
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
        </div>
        <!-- /#content -->
        <?php 
require("main_footer_panel.php");
?>
    </div>
    <?PHP
// require_once("main_script_loading.php");
?>
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

</html>