<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-HYcenter</title>
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" /> -->
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <!-----  กำหนดขนาดของ font ทั้งหน้าเว็บ ----->
    <link rel="stylesheet" href="assets/css/style1.css" />
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/jquery.gritter.min.css" />
    <!-- bootstrap-table -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="assets/css/bootstrap-table.css" rel="stylesheet">

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" />
    <link rel="stylesheet" href="assets/css/select2.min.css" />

</head>
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;

// วันที่ปัจจุบัน
$d_start=$date_curr_dmy_defult;
include('main_script.php');
?>

<body>
    <div class="row-fluid">
        <div class="alert alert-info">
            <span>
                <i class="fa fa-clock-o"></i>&nbsp;&nbsp; ค้นหาข้อมูลวันที่:
                <input data-provide="datepicker" data-date-language="th-th" type="text" id="curdate" name="d_start"
                    value="<?php echo $d_start; ?>" class="form-control autotab"
                    placeholder="วัน / เดือน / ปี ระหว่างวันที่" />
            </span>
        </div>
    </div>

    <table id="t-view-a" class="table table-dark" data-toolbar="#tool-searcha" data-toggle="table"
        data-show-export="true" data-show-print='true' data-export-types="['excel']" data-search="true"
        data-show-refresh="true" data-pagination="true" data-page-list="[10,50,100,All]" data-page-size="10"
        data-row-style="cellStyle" data-url="">
        <!-- sys_hycall_data_nowa.php -->
        <thead>
            <tr>
                <th data-field="hdate" data-sortable="true" class="text-center">
                    <font style="color: black;"> วันที่ </font>
                </th>
                <th data-field="hn" data-sortable="true" class="text-center">
                    <font style="color: black;"> HN </font>
                </th>
                <th data-field="patients" data-sortable="true" class="text-center">
                    <font style="color: black;"> ชื่อสกุล </font>
                </th>
                <th data-field="fplace" data-sortable="true" class="text-left">
                    <font style="color: black;"> รับจาก </font>
                </th>
                <th data-field="tplace" data-sortable="true" class="text-left">
                    <font style="color: black;"> ไปส่งที่ </font>
                </th>
                <th data-field="hassnamea" data-sortable="true" class="text-left">
                    <font style="color: black;"> อุปกรณ์ที่มี </font>
                </th>
                <th data-field="hassnameb" data-sortable="true" class="text-left">
                    <font style="color: black;"> เพิ่ม</font>
                </th>
                <th data-field="name" data-sortable="true" class="text-left">
                    <font style="color: black;"> เปล </font>
                </th>
                <th data-field="x1_pertime" data-sortable="true" class="text-left">
                    <font style="color: black;"> เริ่มงาน</font>
                </th>
                <th data-field="perto" data-sortable="true" class="text-left">
                    <font style="color: black;"> รับงาน </font>
                </th>
                <th data-field="perfinish" data-sortable="true" class="text-left">
                    <font style="color: black;"> ปิดงาน </font>
                </th>
                <th data-field="usetimeAll" data-sortable="true" class="text-left">
                    <font style="color: black;"> รวมระยะเวลา</font>
                </th>
            </tr>
        </thead>
    </table>
</body>

<script type="text/javascript">
< script src = "../../assets/js/jquery-2.1.4.min.js" >
</script>
<script src="../../assets/js/jquery-ui.min.js"></script>
<script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="../../assets/js/jquery.easypiechart.min.js"></script>
<script src="../../assets/js/jquery.sparkline.index.min.js"></script>
<script src="../../assets/js/jquery.inputlimiter.min.js"></script>
<script src="../../assets/js/jquery.maskedinput.min.js"></script>

<!-- ace scripts -->
<script src="../../assets/js/ace-elements.min.js"></script>
<script src="../../assets/js/ace.min.js"></script>
<script src="../../assets/js/bootbox.js"></script>

<!---- bootstrap table ------->
<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/bootstrap-table/src/bootstrap-table.js"></script>
<script src="../../assets/bootstrap-table/src/bootstrap-table-print.js"></script>
<script src="../../assets/bootstrap-table/src/tableExport.js"></script>
<script src="../../assets/js/select2.min.js"></script>
<script src="../../assets/bootstrap-table/src/bootstrap-table-export.js"></script>
<script src="../../assets/bootstrap-table/src/tableExport.js"></script>


<!--- กราฟ ---->
<script src="../../assets/js/highcharts.js"></script>
<script src="../../assets/js/highcharts-more.js"></script>

<script src="../../assets/js/jquery.gritter.min.js"></script>



<script type="text/javascript">
$(document).ready(function() {
    d_start = $('#d_start').val();
    $('#t-view-a').bootstrapTable('refresh', {
        url: 'sys_hycall_data_nowa.php?ddate=' + d_start
    });
    interval = setInterval(checkdisch, 72000);
});
</script>

</html>