<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-HYcenter</title>
</head>
<?php 
$ds=$_REQUEST['d_start'];
$dt=$_REQUEST['d_end'];
?>
<body>
    <p>
    <table id="t-view-b" class="table table-dark" data-toolbar="#tool-searchb" data-toggle="table"
        data-show-export="true" data-show-print='true' data-export-types="['excel']" data-search="true"
        data-show-refresh="true" data-pagination="true" data-page-list="[10,50,100,All]" data-page-size="10"
        data-row-style="cellStyle" data-url="sys_hycall_data_nowc.php">
        <thead>
            <tr>
                <th data-field="p4_month" data-sortable="true" class="text-center">
                    <font style="color: black;"> เดือน </font>
                </th>
                <th data-field="p4_year" data-sortable="true" class="text-center">
                    <font style="color: black;"> ปี </font>
                </th>
                <th data-field="wtime" data-sortable="true" class="text-center">
                    <font style="color: black;"> เวลา </font>
                </th>
                <th data-field="name" data-sortable="true" class="text-left">
                    <font style="color: black;"> ชื่อสกุล </font>
                </th>
                <th data-field="a26" data-sortable="true" class="text-left">
                    <font style="color: black;"> นอน </font>
                </th>
                <th data-field="a32" data-sortable="true" class="text-left">
                    <font style="color: black;"> นอน+อจ. </font>
                </th>
                <th data-field="a33" data-sortable="true" class="text-left">
                    <font style="color: black;"> นั่ง </font>
                </th>
                <th data-field="a34" data-sortable="true" class="text-left">
                    <font style="color: black;"> นั่ง+อจ.</font>
                </th>
                <th data-field="a35" data-sortable="true" class="text-left">
                    <font style="color: black;"> เดิน </font>
                </th>
                <th data-field="a36" data-sortable="true" class="text-left">
                    <font style="color: black;"> ปด</font>
                </th>
                <th data-field="a37" data-sortable="true" class="text-left">
                    <font style="color: black;"> ปด+อจ </font>
                </th>
                <th data-field="a38" data-sortable="true" class="text-left">
                    <font style="color: black;"> CRD+รน+ต </font>
                </th>
                <th data-field="a39" data-sortable="true" class="text-left">
                    <font style="color: black;"> TB</font>
                </th>
                <th data-field="a40" data-sortable="true" class="text-left">
                    <font style="color: black;"> VRE</font>
                </th>
                <th data-field="a44" data-sortable="true" class="text-left">
                    <font style="color: black;"> รน+อจ+ต</font>
                </th>
                <th data-field="a45" data-sortable="true" class="text-left">
                    <font style="color: black;"> รถนั่ง+สก+อจ</font>
                </th>
                <th data-field="a46" data-sortable="true" class="text-left">
                    <font style="color: black;"> รถนั่ง+สก</font>
                </th>
                <th data-field="total" data-sortable="true" class="text-left">
                    <font style="color: black;"> รวม</font>
                </th>
            </tr>
        </thead>
    </table>
</body>
</html>
