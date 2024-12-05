<?php
ini_set("memory_limit","256M");
?>
<!DOCTYPE html>
<?php
// unset($_SESSION['user_name']);
// unset($_SESSION['user_id']);
// unset($_SESSION['user_idx']);
?>

<?php
session_start();
if(!isset($_SESSION)) { 
    session_start();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Refer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="./assets/theme/theme.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script type="text/javascript" src="assets/js/echarts.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    </link>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./css/stylesheet.css"></link>
    <link rel="stylesheet" href="./css/simple-sidebar.css"> -->
</head>
<style>
<style>* {
    margin: 0;
    padding: 0;
}

body {
    font-family: K2D;
    font-size: 18px;
    font-weight: 900px;
    /* overflow-y: hidden; */
    /* Hide vertical scrollbar */
    overflow-x: hidden;
    text-shadow: 0 -1px 0 #555;
    color: #20272F;
    /* Hide horizontal scrollbar */
}

#navcolor {
    font-family: 'K2D', sans-serif;
    font-size: 30px;
    font-weight: bolder;
    /* font-variant-alternates: swash(fancy); */
    /* background-color: #0247FE; */
    background: linear-gradient(120deg, #ec6a45, #901f3d);
    padding: 0px 0px 0px 0px;
    color: #64FFDA;
    box-sizing: content-box;
    #660000 width: auto;
    height: auto;
    padding: 20px;

    /* overflow: scroll;
    scrollbar-color: red orange;
    scrollbar-width: thin; */
}

canvas {
    background: #fff;
}
</style>

<?php 
include_once('./db/connection.php');
include_once ("main_script.php");
?>
<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;
?>
<!-- สำหรับตรวจสอบรายชื่อแพทย์ -->
<?php
//  include('sys_process_pmk_doctor.php');
?>
<?php
        // include('modal_close_system.php');
?>
<?php
$result=mysqli_query($conn,"
SELECT tot,rfgroup,rfevent FROM (
    SELECT COUNT(rf_id) as tot,rfd.rfgroup,re.rfevent
FROM v_rf_detail rfd
    INNER JOIN rf_event  re ON re.rftype = rfd.rftype
    WHERE rfd.rfgroup='1'
    GROUP BY rfd.rfgroup,re.rfevent
    ) x");
    $datax = array();
    foreach ($result as $k) {
    $datax[] = "['".$k['rfevent']."'".", ".$k['tot']."]";
    }
    $datax = implode(",", $datax);
?>

<body>
    <?php require_once("main_top_panel_head.php");?>
    <?php
    if(@$_SESSION['username'] =="") 
    { 
        require_once("main_top_menu_a.php");
    } 
    ?>
    <div class="box" style="border: 10px solid #FF9100;padding: 12px;margin-top:-18px;margin-bottom:0px;">
        <div class="container-fluid"
            style="text-shadow: 0 -1px 0 #555;font-family: 'Sarabun';font-size: 20px;color:#20272F;">
            <div class="row">
                <div class="col-md-6">
                    <?php include('main_refer_group.php'); ?>
                </div>
                <div class="col-md-6 outer">
                    <div id="piechart" style="font-size:18px;font-family:K2D;align:center;width:1020px; height: 700px;margin-top:0px;margin-right:0px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawCharta);
    function drawCharta() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'กลุ่มการ REFER'],
            <?php echo $datax;?>
        ]);

        var options = {
            title: 'สถิติกลุ่มการ REFER'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    </script>
</body>

</html>
<?php 
mysqli_close($conn);
include_once('main_hycall_footer.php');
?>