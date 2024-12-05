<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-logistic</title>
</head>

<body>
<p>
            <div class="panel-group">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class='fa fa-wheelchair fa-1x'></i> บริการทำความสะอาด/ผลิตภัณฑ์อื่น ๆ ประจำวันที่
                        <?php echo $d_end; ?>
                    </div>
                    <p>
                    <table id="t-view-a" class="table table-dark" data-toolbar="#tool-search" data-toggle="table"
                        data-show-export="true" data-show-print='true' data-export-types="['excel']" data-search="true"
                        data-show-refresh="true" data-pagination="true" data-page-list="[10,50,100,All]" data-page-size="10"
                        data-row-style="cellStyle" data-url="get_logistic_d.php">
                        <thead>
                            <tr>
                                <th data-field="dgroup" data-sortable="true" class="text-center">
                                    <font style="color: black;"> รหัสงาน </font>
                                </th>
                                <th data-field="assname" data-sortable="true" class="text-center">
                                    <font style="color: black;"> ประเภท </font>
                                </th>
                                <th data-field="firstplace" data-sortable="true" class="text-left">
                                    <font style="color: black;"> หน่วยร้องขอ </font>
                                </th>
                                <th data-field="nbuild" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ชนิดของส่ง/ตึก </font>
                                </th>
                                <th data-field="fplace" data-sortable="true" class="text-left">
                                    <font style="color: black;"> รับจาก/ชั้น </font>
                                </th>
                                <th data-field="clean_place" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ไปส่งที่/ตำแหน่ง</font>
                                </th>
                                <th data-field="name" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ดำเนินการโดย </font>
                                </th>
                                <th data-field="hdate" data-sortable="true" class="text-left">
                                    <font style="color: black;"> วันที่ร้องขอ </font>
                                </th>
                                <th data-field="htime" data-sortable="true" class="text-left">
                                    <font style="color: black;"> เวลา</font>
                                </th>
                                <th data-field="x1_pertime" data-sortable="true" class="text-left">
                                    <font style="color: black;"> เวลารับงาน </font>
                                </th>
                                <th data-field="perto" data-sortable="true" class="text-left">
                                    <font style="color: black;"> เวลาจ่ายงาน </font>
                                </th>
                                <th data-field="perfinish" data-sortable="true" class="text-left">
                                    <font style="color: black;"> เวลาจบงาน</font>
                                </th>
                                <th data-field="usetimeAll" data-sortable="true" class="text-left">
                                    <font style="color: black;"> รวมระยะเวลา</font>
                                </th>
                                <th data-field="endjoba" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ประเมินจากผู้ขอ</font>
                                </th>
                                <th data-field="endjobb" data-sortable="true" class="text-left">
                                    <font style="color: black;"> ประเมินจากศูนย์</font>
                                </th>
                                <th data-field="endfinish" data-sortable="true" class="text-left">
                                    <font style="color: black;"> สิ้นสุดการปิดงาน</font>
                                </th>
                                <th data-field="status" data-sortable="true" class="text-left">
                                    <font style="color: black;"> สถานะงาน</font>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
    </div>
</body>

<!-- <script src="../../assets/js/jquery-3.2.1.min.js"></script>
<script src="../../assets/js/popper.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script> -->

<!--- bootstrap-table ----->
<!-- <script src="../../assets/bootstrap-table/src/bootstrap-table.min.js"></script> -->
<!-- <script src="../../assets/bootstrap-table/src/bootstrap-table-locale-all.js"></script> -->
<!-- <script src="../../assets/bootstrap-table/src/bootstrap-table-export.js"></script>
<script src="../../assets/bootstrap-table/src/tableexport.js"></script> -->

<!--- select ---->
<!-- <script src="../../assets/js/bootstrap-select.js"></script> -->
</html>
