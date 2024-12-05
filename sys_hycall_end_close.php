<!doctype html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
include('main_script.php');
require_once("db/connection.php");
require_once("db/date_format.php");
?>

<?php
#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult='01/' ;
$date_start_m_defult='01/';
$date_start_y_defult=date('Y')+543 ;
$date_start_dmy_defult	= $date_start_d_defult.$date_start_m_defult.$date_start_y_defult;
// 01/m/y+543

$date_end_dm_defult=date('d/m/') ;
$date_end_y_defult=date('Y')+543 ;
$date_end_dmy_defult=$date_end_dm_defult.$date_end_y_defult;
// d/m/y+543

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;

// วันที่ปัจจุบัน
$d_default=$date_curr_dmy_defult;

$d_start_post = @$_POST['d_start'];
$d_end_post = @$_POST['d_end'];
IF(!empty($d_start_post)){
$d_start = $d_start_post ;
}ELSE{
$d_start = $date_start_dmy_defult;
}
IF(!empty($d_end_post) ){
$d_end = $d_end_post ;
}ELSE{
$d_end = $date_end_dmy_defult;
}
$d_start_cal = substr($d_start,0,2).substr($d_start,3,2).substr($d_start,6,4) ;
$d_end_cal =  substr($d_end,0,2).substr($d_end,3,2).substr($d_end,6,4) ;
$date_m= $d_end;
?>
<?php
$d_start=$_POST['d_start'];
$d_end=$_POST['d_end'];
?>
<html class="no-js">

<head>
    <?php
//    include('main_script.php');
    include('main_top_panel_head.php');
?>
</head>

<body>
    <script>
    $(function() {
        Metis.dashboard();
    });
    </script>
    <div id="content3" style="margin-top:-50px;">
        <div class="inner bg-light lter">
            <p>
            <div class="row-fluid">
                <div class="alert alert-success">
                    <form class="form-inline" action="sys_hycall_end_close.php" name="ins_fund_main" method="POST"
                        target="">
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
                            <button type="submit" class="btn btn-info" value="submit"> แสดงข้อมูล
                            </button>
                        </span>
                    </form>
                </div>
            </div>

            <div class="box">
                <header>
                    <div class="icons">
                        <a href="#modal_9" type="button" data-toggle="modal" data-id="modal_1">
                            <i class="fa fa-adjust"> </i>
                        </a>
                    </div>
                    <h5>กราฟแสดง <a class="text-success"> ประสิทธิภาพการให้บริการ </a> วันที่ <a class="text-danger">
                            <?PHP echo $d_start;?>
                        </a> ถึง <a class="text-danger">
                            <?PHP echo $d_end;?>
                        </a></h5>
                </header>

                <!-- แสดงกราฟ  -->
                <!-- ชุด 1 -->
                <div class="col-lg-3">
                    <div class="panel panel-default" style="margin-top:10px;">
                        <div class="panel-heading" style="background:#2233ee;opacity: 0.55;
                         color:rgb(255, 201, 66);font-size: 1.2em;font-weight: bold;">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            สถิติการใช้บริการแต่ละประเภทงาน
                        </div>

                        <div class="panel-body">
                            <?php
                    $sql = "SELECT assname,tot FROM v_logistic_pie w
                                WHERE hdate BETWEEN '$d_start' AND '$d_end' ";
            
                    $result = mysqli_query($conn, $sql);
                    $content = [];
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            $content[] = [
                                'name' => $row['assname'],
                                'value' => $row['tot']
                            ];
                        }
                    }

                    // mysqli_close($conn);
                    ?>
                            <div id="container" style="height: 350%"></div>
                            <script type="text/javascript" src="assets/js/echarts.min.js"></script>
                            <script type="text/javascript">
                            var dom = document.getElementById("container");
                            var myChart = echarts.init(dom);

                            var seriesData = <?=json_encode($content)?>;

                            option = {
                                title: {
                                    text: 'สถิติการใช้บริการแต่ละประเภทงาน',
                                    subtext: 'วันที่ :<?php echo $d_default ;?>',
                                    x: 'center'
                                },
                                tooltip: {
                                    trigger: 'item',
                                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                                },

                                series: [{
                                    name: 'สถิติการใช้บริการแต่ละประเภทงาน',
                                    type: 'pie',
                                    data: seriesData,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                        }
                                    }
                                }]
                            };

                            if (option && typeof option === "object") {
                                myChart.setOption(option, true);
                            }
                            </script>
                        </div>
                    </div>
                </div>
                <!-- ชุด 2 -->
                <div class="col-lg-3">
                    <div class="panel panel-default" style="margin-top:10px;">
                        <div class="panel-heading" style="background:#2233ee;opacity: 0.55;
                         color:rgb(255, 201, 66);font-size: 1.2em;font-weight: bold;">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            สถิติการใช้บริการแต่ละประเภทงาน
                        </div>

                        <div class="panel-body">
                            <?php
                    $sql = "SELECT assname,tot FROM v_logistic_pie
                            WHERE hdate BETWEEN '$d_start' AND '$d_end' ";
                    
                    $result = mysqli_query($conn, $sql);
                    $content = [];
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            $content[] = [
                                'name' => $row['assname'],
                                'value' => $row['tot']
                            ];
                        }
                    }

                    // mysqli_close($conn);
                    ?>
                            <div id="container" style="height: 350%"></div>
                            <script type="text/javascript" src="assets/js/echarts.min.js"></script>
                            <script type="text/javascript">
                            var dom = document.getElementById("container");
                            var myChart = echarts.init(dom);

                            var seriesData = <?=json_encode($content)?>;

                            option = {
                                title: {
                                    text: 'สถิติการใช้บริการแต่ละประเภทงาน',
                                    subtext: 'วันที่ :<?php echo $d_default ;?>',
                                    x: 'center'
                                },
                                tooltip: {
                                    trigger: 'item',
                                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                                },

                                series: [{
                                    name: 'สถิติการใช้บริการแต่ละประเภทงาน',
                                    type: 'pie',
                                    data: seriesData,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                        }
                                    }
                                }]
                            };

                            if (option && typeof option === "object") {
                                myChart.setOption(option, true);
                            }
                            </script>
                        </div>
                    </div>
                </div>
                <!-- ชุด 3 -->
                <div class="col-lg-3">
                    <div class="panel panel-default" style="margin-top:10px;">
                        <div class="panel-heading" style="background:#2233ee;opacity: 0.55;
                         color:rgb(255, 201, 66);font-size: 1.2em;font-weight: bold;">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            สถิติการใช้บริการแต่ละประเภทงาน
                        </div>

                        <div class="panel-body">
                            <?php
                    $sql = "SELECT assname,tot FROM v_logistic_pie where hdate = '$d_default' ";
                    
                    $result = mysqli_query($conn, $sql);
                    $content = [];
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            $content[] = [
                                'name' => $row['assname'],
                                'value' => $row['tot']
                            ];
                        }
                    }

                    // mysqli_close($conn);
                    ?>
                            <div id="container" style="height: 350%"></div>
                            <script type="text/javascript" src="assets/js/echarts.min.js"></script>
                            <script type="text/javascript">
                            var dom = document.getElementById("container");
                            var myChart = echarts.init(dom);

                            var seriesData = <?=json_encode($content)?>;

                            option = {
                                title: {
                                    text: 'สถิติการใช้บริการแต่ละประเภทงาน',
                                    subtext: 'วันที่ :<?php echo $d_default ;?>',
                                    x: 'center'
                                },
                                tooltip: {
                                    trigger: 'item',
                                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                                },

                                series: [{
                                    name: 'สถิติการใช้บริการแต่ละประเภทงาน',
                                    type: 'pie',
                                    data: seriesData,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                        }
                                    }
                                }]
                            };

                            if (option && typeof option === "object") {
                                myChart.setOption(option, true);
                            }
                            </script>
                        </div>
                    </div>
                </div>
                <!-- ชุด 4 -->
                <div class="col-lg-3">
                    <div class="panel panel-default" style="margin-top:10px;">
                        <div class="panel-heading" style="background:#2233ee;opacity: 0.55;
                         color:rgb(255, 201, 66);font-size: 1.2em;font-weight: bold;">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            สถิติการใช้บริการแต่ละประเภทงาน
                        </div>

                        <div class="panel-body">
                            <?php
                    $sql = "SELECT assname,tot FROM v_logistic_pie where hdate = '$d_default' ";
                    
                    $result = mysqli_query($conn, $sql);
                    $content = [];
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            $content[] = [
                                'name' => $row['assname'],
                                'value' => $row['tot']
                            ];
                        }
                    }

                    // mysqli_close($conn);
                    ?>
                            <div id="container" style="height: 350%"></div>
                            <script type="text/javascript" src="assets/js/echarts.min.js"></script>
                            <script type="text/javascript">
                            var dom = document.getElementById("container");
                            var myChart = echarts.init(dom);

                            var seriesData = <?=json_encode($content)?>;

                            option = {
                                title: {
                                    text: 'สถิติการใช้บริการแต่ละประเภทงาน',
                                    subtext: 'วันที่ :<?php echo $d_default ;?>',
                                    x: 'center'
                                },
                                tooltip: {
                                    trigger: 'item',
                                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                                },

                                series: [{
                                    name: 'สถิติการใช้บริการแต่ละประเภทงาน',
                                    type: 'pie',
                                    data: seriesData,
                                    itemStyle: {
                                        emphasis: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                        }
                                    }
                                }]
                            };

                            if (option && typeof option === "object") {
                                myChart.setOption(option, true);
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>