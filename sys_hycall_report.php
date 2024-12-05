<!doctype html>
<?php
#ตรวจสอบสิทธิการเข้าใช้งาน
require_once("db/connection.php");
require_once("db/date_format.php");
?>
<html>

<head>
    <?php     
        include("main_script.php");
        require("main_top_panel_head_admin.php");
    ?>
    <script src="assets/js/style-switcher.min.js"></script>
</head>
<?php
$date_start_d_defult='01/' ;
$date_start_m_defult=date('m/');
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
                                <h5>ระบบรายการงานเพื่อการวิเคราะห์</h5>
                            </header>
                            <p>
                            <ol class="list-ordered">
                                <p>
                                    <li>
                                        <a href="sys_report_finish_now.php" target="_blank" data-toggle="tooltip"
                                            data-placement="bottom" class="btn btn-success btn-grad btn-rect">
                                            <i class="fa fa-cogs">
                                            </i> : สรุปภาระงานประจำวันระบุวันที่
                                        </a>
                                    </li>
                                </p>
                                <p>
                                    <li>
                                        <a href="sys_admin_type_assets_add.php" data-toggle="tooltip"
                                            data-placement="bottom" class="btn btn-success btn-grad btn-rect">
                                            <i class="fa fa-cogs">
                                            </i> : ประเภทของอุปกรณ์ที่ต้องใช้ในระบบ
                                        </a>

                                    </li>
                                </p>
                                <p>
                                    <li>
                                        <a href="sys_admin_type_patients_add.php" data-toggle="tooltip"
                                            data-placement="bottom" class="btn btn-success btn-grad btn-rect">
                                            <i class="fa fa-cogs">
                                            </i> : ประเภทของผู้ป่วยที่ขอบริการ
                                        </a>
                                    </li>
                                </p>
                                <p>
                                    <li>
                                        <a href="sys_admin_type_place_add.php" data-toggle="tooltip"
                                            data-placement="bottom" class="btn btn-success btn-grad btn-rect">
                                            <i class="fa fa-cogs">
                                            </i> : แฟ้มแผนก/หน่วยงานต่าง ๆ
                                        </a>
                                    </li>
                                <p>
                                    <li>
                                        <a href="sys_admin_fasta_add.php" data-toggle="tooltip" data-placement="bottom"
                                            class="btn btn-success btn-grad btn-rect">
                                            <i class="fa fa-cogs">
                                            </i> : รายการด่วน วิกฤต
                                        </a>
                                    </li>
                                </p>
                                <p>
                                    <li>
                                        <a href="sys_admin_fastb_add.php" data-toggle="tooltip" data-placement="bottom"
                                            class="btn btn-success btn-grad btn-rect">
                                            <i class="fa fa-cogs">
                                            </i> : รายการด่วน หัตถการ
                                        </a>
                                    </li>
                                </p>
                                </p>
                            </ol>
                            </p>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <?php 
        require("main_footer_panel.php");
        ?>
    </div>
</body>

</html>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<!--- alert ----->
<script src="../assets/js/bootbox.js"></script>

<!-- nitiy -->
<script src="../assets/js/notify.js"></script>

<script src="../assets/js/bootstrap-timepicker.min.js"></script>
<script src="../assets/js/moment.min.js"></script>
<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../assets/js/jquery.knob.min.js"></script>
<script src="../assets/js/autosize.min.js"></script>
<script src="../assets/js/jquery.inputlimiter.min.js"></script>
<script src="../assets/js/jquery.maskedinput.min.js"></script>
<script src="../assets/js/bootstrap-tag.min.js"></script>
<script src="../assets/bootstrap-table/src/bootstrap-table.js"></script>
<script src="../assets/js/clipboard.min.js"></script>

<!-- ace scripts -->
<script src="../assets/js/ace-elements.min.js"></script>
<script src="../assets/js/ace.min.js"></script>

<script src="../assets/js/select2.js"></script>


<!--Autocomplate -->
<script type="text/javascript" src="../assets/js/autocomplete.js"></script>
<script src="../assets/js/bootstrap-select.js"></script>

<!--Auto refresh -->
<script type="text/javascript" src="../assets/js/bootstrap-table.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap-table-auto-refresh.min.js"></script>


<script type="text/javascript" src="../assets/js/highcharts.js"></script>
<script type="text/javascript" src="../assets/js/series-label.js"></script>
<script type="text/javascript" src="../assets/js/exporting.js"></script>
<script type="text/javascript" src="../assets/js/export-data.js"></script>
<script type="text/javascript" src="../assets/js/accessibility.js"></script>
