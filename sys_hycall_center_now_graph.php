<!doctype html public "-//w3c//dtd html 3.2//en">
<html>

<head>
    <title>Graph</title>
</head>

<?php
include('main_script.php');
require('db/connection.php'); // Database connection
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>

<body>
    <?Php
if($stmt = $conn->query("SELECT name,hdate,total FROM v_mchart WHERE name is not null"))
{
    $php_data_array = Array(); // create PHP array
    while ($row = $stmt->fetch_row()) {
        $php_data_array[] = $row; // Adding to array
    }
}else{
	echo $connection->error;
}
echo "<script>
        var my_2d = ".json_encode($php_data_array)."
	  </script>";
    ?>
    <div id="curve_chart"></div>
    <br><br>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'name');
        data.addColumn('number', 'hdate');
        data.addColumn('number', 'total');
        for (i = 0; i < my_2d.length; i++)
            // data.addRow([my_2d[i][0], parseInt(my_2d[i][1]),parseInt(my_2d[i][2]),parseInt(my_2d[i][3]),parseInt(my_2d[i][4])]);
            data.addRow([my_2d[i][0], parseInt(my_2d[i][1]), parseInt(my_2d[i][2])]);
        var options = {
            // title: 'สถิติการให้บริการของ จนท ประจำวัน',
            curveType: 'function',
            width: 800
            height: 500,
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }
    </script>
</body>

</html>