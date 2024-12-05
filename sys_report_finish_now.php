<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-hycenter</title>
    <link rel="stylesheet" href="../assets/css/bootstrap-multiselect.min.css" />
    <link rel="stylesheet" href="../assets/css/jquery.datetimepicker.css" />
    <!-- <link rel="stylesheet" href="../assets/css/font-awesome.min.css" /> -->

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="../assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="../assets/css/jquery.gritter.min.css" />
    <link rel="stylesheet" href="../assets/css/colorbox.min.css" />

    <!-- bootstrap-table -->
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css" /> -->
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap-table.css" /> -->

    <!-- ace styles -->
    <link rel="stylesheet" href="../assets/css/ace.min.css" />
    <link rel="stylesheet" href="../assets/css/select2.min.css" />

    <!-----  กำหนดขนาดของ font ทั้งหน้าเว็บ ----->
    <link rel="stylesheet" href="../assets/css/fullcalendar.min.css">
    <!-- <link rel="stylesheet" href="../assets/css/style1.css" /> -->
    <link rel="stylesheet" href="../assets/css/bootstrap-select.css" />
</head>
<?php include_once('main_script.php'); ?>
<body>
    <!-- <div class="container-fluid"> -->
    <div class="panel panel-info">
        <div class="panel-heading">
            <div id="hy_ins_d">
                <form class="form-inline" name="ins_fund_main" method="POST" target="">
                    <span>
                        <i class="fa fa-clock-o">
                        </i>&nbsp;&nbsp; ค้นหาข้อมูล ระหว่างวันที่:
                        <input data-provide="datepicker" data-date-language="th-th" type="text" name="d_start"
                            value="<?php echo $d_start; ?>" class="form-control autotab"
                            placeholder="วัน / เดือน / ปี ระหว่างวันที่" />
                        ถึงวันที่:
                        <input data-provide="datepicker" data-date-language="th-th" type="text" name="d_end"
                            value="<?php echo $d_end; ?>" class="form-control autotab"
                            placeholder="วัน / เดือน / ปี ถึงวันที่" />
                        <button type="submit" class="btn btn-info" value="submit"> แสดงข้อมูล</button>
                    </span>
                </form>
            </div>
        </div>

        <table id="hy_ins_d" class="table table-dark" data-toolbar="#tool-search" data-toggle="table"
            data-show-export="true" data-show-print='true' data-export-types="['excel']" data-search="false"
            data-show-refresh="true" data-pagination="true" data-page-list="[10,50,100,All]" data-page-size="10"
            data-row-style="cellStyle" data-url="get_hycall_a.php">
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
                    <th data-field="fplace" data-sortable="true" class="text-left">
                        <font style="color: black;"> รับจาก/ชั้น </font>
                    </th>
                    <th data-field="tplace" data-sortable="true" class="text-left">
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
        <!-- </div> -->
</body>

</html>

<script src="../../assets/js/jquery-3.2.1.min.js"></script>
<script src="../../assets/js/popper.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>

<!--- bootstrap-table ----->
<script src="../../assets/bootstrap-table/src/bootstrap-table.min.js"></script>
<!-- <script src="../../assets/bootstrap-table/src/bootstrap-table-locale-all.js"></script> -->
<script src="../../assets/bootstrap-table/src/bootstrap-table-export.js"></script>
<script src="../../assets/bootstrap-table/src/tableexport.js"></script>

<!--- select ---->
<script src="../../assets/js/bootstrap-select.js"></script>

<script>
$('#btn-search').on('click', function() {
    var date1 = $('#date1').val();
    var date2 = $('#date2').val();
    //alert(an);
    $.ajax({
        url: "get_hycall_a.php",
        type: "POST",
        data: {
            date1: date1,
            date2: date2
        },
        success: function(data) {
            console.log(data);
            if (data == 0) {
                alert('ไม่มีข้อมูลตามช่วงระหว่างวันที่ ที่ระบุ');
            } else {
                var an = data[0].an;
                var flname = data[0].flname;
                var places = data[0].places;
                var places_name = data[0].places_name;
                var bed = data[0].bed_no;
                var age = data[0].age;
                var diag = data[0].diag;
                var doctor = data[0].doctor;

                //alert(flname);
                $('#txt-an').val(an);
                $('#txt-flname').val(flname);
                $('#txt-places').val(places);
                $('#txt-places-name').val(places_name);
                $('#txt-bed').val(bed);
                $('#txt-age').val(age);
                $('#txt-diag').val(diag);
                $('#txt-doctor').val(doctor);
                $('#s-flname').html('AN: ' + an + ' ' + flname);
                $('#t-view-all').bootstrapTable('refresh', {
                    url: "q_view_detail.php?an=" + an
                });
            }
        }
    });
});