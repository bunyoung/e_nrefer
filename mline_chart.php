<!DOCTYPE html>
<html lang="en">
<?php
include('connection.php');
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ศูนย์เปล</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>
    <?php
$sql = "SELECT sum(total) as t, hdate,name FROM v_mychart GROUP BY hdate,name ORDER BY hdate,name";
$get_data=mysqli_query($conn, $sql);
while( $data=mysqli_fetch_array($get_data) ) {  
  $result[] = $data;
}
?>
    <h3>ข้อมูลสถิติการขอเปล</h3>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <table class="table" id="datatable">
        <thead>
            <tr>
                <th></th>
                <th>ประชากรหญิง</th>
                <th>ประชากรชาย</th>
            </tr>
        </thead>
    </table>
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script>
    $(function() {
        $('#container').highcharts({
            data: {
                //กำหนดให้ ตรงกับ id ของ table ที่จะแสดงข้อมูล
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'ข้อมูลจำนวนประชากรของแต่ละจังหวัด'
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Units'
                }
            },
        });
    });
    </script>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>