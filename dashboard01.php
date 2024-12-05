<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Refer</title>
    <link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
    </script>

    <!-- style.css 
</head>
<?php
$date_start_d_defult = '01/';
$date_start_m_defult = date('m/');
$date_start_y_defult = date('Y') + 543;
$date_start_dmy_defult = $date_start_d_defult . $date_start_m_defult . $date_start_y_defult;
$date_end_dm_defult = date('d/m/');
$date_end_y_defult = date('Y') + 543;
$date_end_dmy_defult = $date_end_dm_defult . $date_end_y_defult;
$date_end_dm_defult = date('d/m/');
$date_end_y_defult = date('Y') + 543;
$date_end_dmy_defult = $date_end_dm_defult . $date_end_y_defult;
//IF DATE SELECT
$d_start_post = $_POST['d_start'];
$d_end_post = $_POST['d_end'];
IF (!empty($d_start_post)) {
    $d_start = $d_start_post;
} ELSE {
    $d_start = $date_start_dmy_defult;
}
IF (!empty($d_end_post)) {
    $d_end = $d_end_post;
} ELSE {
    $d_end = $date_end_dmy_defult;
}
$d_start_cal = substr($d_start, 6, 4) . substr($d_start, 3, 2) . substr($d_start, 0, 2);
$d_end_cal = substr($d_end, 6, 4) . substr($d_end, 3, 2) . substr($d_end, 0, 2);
$date_m = $d_end;
?>
<?php
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;
?>

<?php
include ("main_script.php");
?>



    <!-- ใช้กรณีเชือม PMK -->
    <?php
        //  require('sys_process_pmk_ipdtrans.php');
        //  require('sys_process_pmk_places.php');
        //  require('sys_process_pmk_his.php');
        ?>

    <?php
        require("main_top_panel_head.php");
        ?>
    <!-- style="font-family: 'Kodchasan', sans-serif;    font-size: 18px;" -->

<body>
    <div class="container-fuid">
        <!-- <br> -->
        <div class="vertical-tab" role="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab"
                        data-toggle="tab">ขอ Refer</a></li>
                <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">ศูนย์
                        Refer</a></li>
                <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab"
                        data-toggle="tab">Monitor</a></li>
            </ul>
            <div class="tab-content tabs">
                <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                    <h3>ขอ Refer</h3>
                    <?php
                            include('sys_hycall_center_now.php');
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="Section2">
                    <h3>ศูนย์ Refer</h3>
                    <?php 
                            include('sys_hycall_monitor_now.php');
                            ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="Section3">
                    <h3> Monitor</h3>
                    <?php 
                            include('sys_hycall_monitor_control.php');
                            ?>
                </div>
            </div>
        </div>

</body>

</html>