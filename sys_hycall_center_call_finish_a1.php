<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no" initial-scale=1.0">
    <title>E-logistic</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/font-awesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/css/fontawesome.css">
    <link rel="stylesheet" href="assets/font-awesome/css/brands.css">
    <link rel="stylesheet" href="assets/font-awesome/css/solid.css">
    <link rel="stylesheet" href="assets/bootstrap-table/bootstrap-table.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css">
</head>

<body>
    <div class="container-fluid" id="main-container">
        <div class="main-content">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12">
                        <table id="view-regised" data-toolbar="#tool-run" data-toggle="table" data-search="true"
                            data-pagination="true" data-page-list="[10,20,50,ALL]" data-page-size="20"
                            data-show-refresh="true" data-url="sys_hycall_show_a.php">
                            <thead class="thead-light">
                                <tr>
                                    <th data-field="date_created" data-sortable="true" data-align="left">
                                        <font style="color: black;"> ลำดับ</font>
                                    </th>
                                    <th data-field="hid" data-sortable="true" data-align="center">
                                        <font style="color: black;"> รหัสงาน </font>
                                    </th>
                                    <th data-field="hn" class="text-center" data-sortable="true" data-align="left">
                                        <font style="color: black;">HN </font>
                                    </th>
                                    <th data-field="flname" data-sortable="true" data-align="left">
                                        <font style="color: black;"> ชื่อ - สกุล ผู้ป่วย</font>
                                    </th>
                                    <th data-field="fplace" data-sortable="true" data-align="left">
                                        <font style="color: black;"> หน่วยงานร้องขอ </font>
                                    </th>
                                    <th data-field="appoint" class="text-center" data-sortable="true"
                                        data-align="center">
                                        <font style="color: black;"> ชนิดของส่ง/ตึก </font>
                                    </th>
                                    <th data-field="appoint_name" data-sortable="true" data-align="left">
                                        <font style="color: black;"> รับจาก/ชั้น </font>
                                    </th>
                                    <th data-field="p" class="text-center" data-sortable="false" data-align="center"
                                        data-formatter="chk_before_doctor">
                                        <font style="color: black;">ไปส่งทึ่/ตำแหน่ง</font>
                                    </th>

                                    <th data-field="express" class="text-center" data-sortable="false"
                                        data-align="center" data-formatter="chk_express">
                                        <font style="color: black;">ดำเนินการโดย</font>
                                    </th>

                                    <th data-field="loss" class="text-center" data-sortable="false" data-align="center"
                                        data-formatter="chk_loss">
                                        <font style="color: black;">วันที่ร้องขอ</font>
                                    </th>

                                    <th data-field="users" class="text-center" data-sortable="true" data-align="center">
                                        <font style="color: black;"> เวลา </font>
                                    </th>
                                    <th data-field="status" class="text-center" data-sortable="true"
                                        data-align="center">
                                        <font style="color: black;"> เวลารับงาน </font>
                                    </th>
                                    <!--                                <th data-field="ok" class="text-center" data-sortable="true" data-align="center" ><font style="color: black;">   </font></th> -->
                                    <th data-field="pro" class="text-center" data-sortable="true" data-align="center">
                                        <font style="color: black;">เวลาจ่ายงาน </font>
                                    </th>
                                    <th data-field="canc" class="text-center" data-sortable="true" data-align="center">
                                        <font style="color: black;">รวมระยเวลาดำเนินการ </font>
                                    </th>
                                    <th data-field="canc" class="text-center" data-sortable="true" data-align="center">
                                        <font style="color: black;">ประเมินจากผู้ขอ/ศูนย์ </font>
                                    </th>
                                    <th data-field="canc" class="text-center" data-sortable="true" data-align="center">
                                        <font style="color: black;"> Status </font>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>