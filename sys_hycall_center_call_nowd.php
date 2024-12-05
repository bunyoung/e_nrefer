<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-logistic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="../../assets/css/jquery.gritter.min.css" />

</head>
<?php
include('main_script.php');
?>

<body>
    <div class="container-fluid" id="main-container">
        <div class="main-content">
            <div class="page-content">
                <div class="widget-box">
                    <p>
                    <table id="hycenter-view-a" class="table table-dark" data-toolbar="#hycenter-logistic"
                        data-toggle="table" data-show-export="true" data-show-print='true' data-export-types="['excel']"
                        data-search="true" data-show-refresh="true" data-pagination="true"
                        data-page-list="[10,50,100,All]" data-page-size="10" data-row-style="cellStyle"
                        data-url="get_hycall_d.php">
                        <thead>
                            <tr>
                                <th data-field="hyitem" data-sortable="true" class="text-center">
                                    <font style="color: black;"> รหัสงาน </font>
                                </th>
                                <th data-field="hdate" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ประจำวันที่ </font>
                                </th>
                                <th data-field="fasts_name" data-sortable="true" class="text-center">
                                    <font style="color: black;"> ระดับวิกฤติ </font>
                                </th>
                                <th data-field="hassnamea" data-sortable="true" class="text-center">
                                    <font style="color: black;"> อุปกรณ์ </font>
                                </th>
                                <th data-field="hn" data-sortable="true" class="text-center">
                                    <font style="color: black;"> HN </font>
                                </th>
                                <th data-field="patients" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ชื่อ สกุล </font>
                                </th>
                                <th data-field="old" data-sortable="true" class="text-left">
                                    <font style="color: black;"> อายุ </font>
                                </th>
                                <th data-field="idcard" data-sortable="true" class="text-left">
                                    <font style="color: black;"> บปช</font>
                                </th>
                                <th data-field="pers" data-sortable="true" class="text-left">
                                    <font style="color: black;"> รหัสเจ้าหน้าที่ </font>
                                </th>
                                <th data-field="name" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ชื่อเจ้าหน้าที่เปล </font>
                                </th>
                                <th data-field="fplace" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ผู้ส่ง</font>
                                </th>
                                <th data-field="tplace" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ถึงปลายทาง </font>
                                </th>
                                <th data-field="htime" data-sortable="true" class="text-left">
                                    <font style="color: black;"> เวลาร้องขอ </font>
                                </th>
                                <th data-field="x1_pertime" data-sortable="true" class="text-left">
                                    <font style="color: black;"> เวลารับงาน </font>
                                </th>
                                <th data-field="perto" data-sortable="true" class="text-left">
                                    <font style="color: black;"> เวลารับผู้ป่วย </font>
                                </th>
                                <th data-field="perfinish" data-sortable="true" class="text-left">
                                    <font style="color: black;"> เวลาจบงาน</font>
                                </th>
                                <th data-field="usetimeAll" data-sortable="true" class="text-left">
                                    <font style="color: black;"> รวมระยะเวลา</font>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="../../assets/js/jquery-2.1.4.min.js"></script> -->
    <!-- <script src="../../assets/js/jquery-ui.min.js"></script> -->
    <script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="../../assets/js/jquery.easypiechart.min.js"></script>
    <script src="../../assets/js/jquery.sparkline.index.min.js"></script>
    <script src="../../assets/js/bootstrap-datepicker.min.js"></script>
    <script src="../../assets/js/jquery.inputlimiter.min.js"></script>
    <script src="../../assets/js/jquery.maskedinput.min.js"></script>

    <!-- ace scripts -->
    <!-- <script src="../../assets/js/ace-elements.min.js"></script> -->
    <!-- <script src="../../assets/js/ace.min.js"></script> -->
    <!-- <script src="../../assets/js/bootbox.js"></script> -->

    <!---- bootstrap table ------->
    <!-- <script src="../../assets/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="../../assets/bootstrap-table/src/bootstrap-table.js"></script> -->
    <script src="../../assets/bootstrap-table/src/bootstrap-table-print.js"></script>
    <script src="../../assets/bootstrap-table/src/tableExport.js"></script>
    <!-- <script src="../../assets/js/select2.min.js"></script> -->
    <script src="../../assets/bootstrap-table/src/bootstrap-table-export.js"></script>
    <script src="../../assets/bootstrap-table/src/tableExport.js"></script>

    <script src="../../assets/js/jquery.gritter.min.js"></script>


</body>

</html>