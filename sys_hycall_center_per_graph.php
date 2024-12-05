<?php
/*include('db/connection.php'); */
$sql = "SELECT count(hassnamea) as nt,name from v_monitor
              WHERE hassnamea is not null group by name";
$result = mysqli_query($conn,$sql);
         $chart_dat="";
         while ($row = mysqli_fetch_array($result)) {

            $pname[]  = $row['name']  ;
            $hass[] = $row['nt'];
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Graph</title>
    </head>
    <body>
        <div style="width:100%; text-align:center">
            <div></div>
            <canvas  id="chartjs_per"></canvas>
        </div>
    </body>
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  <script type="text/javascript">
      var ctx = document.getElementById("chartjs_per").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($pname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($hass); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: false,
                        position: 'bottom',

                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },


                }
                });
    </script>
</html>