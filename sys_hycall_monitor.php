<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Refer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="./assets/theme/theme.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script type="text/javascript" src="assets/js/echarts.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=K2D:wght@300&display=swap');
    </style>
</head>
<style>
#navcolor {
    font-family: 'K2D', sans-serif;
    font-size: 30px;
    font-weight: bolder;
    margin-top: 0px;
    background: linear-gradient(120deg, #ec6a45, #901f3d);
    padding: 0px 0px 0px 0px;
    color: #f4d66e;
    box-sizing: content-box;
    height: auto;
    padding: 20px;
    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}
</style>
<?php include('main_script.php'); ?>
<?php include('./db/connection.php'); ?>
<?php include('main_top_panel_head_monitor.php'); ?>

<body>
    <?php
$srf="SELECT COUNT(rf_rfev) as tt,	rf_event.rfgroup FROM	rf_detail
	INNER JOIN 	rf_event ON rf_detail.rf_rfev = rf_event.rfid
    GROUP BY  rf_event.rfgroup";

$rf=mysqli_query($conn,$srf);
$rga='';$rgb='';$rgc='';$rgd='';
$rta='0';$rtb='0';$rtc='0';$rtd='0';$rtt='0';$rcp = '0';
while($rs=mysqli_fetch_array($rf))
{
    if($rs['rfgroup']=='1'){
        $rta=$rs['tt'];
    }else{
        if($rs['rfgroup']=='2'){
            $rtb=$rs['tt'];
        }else{
            if($rs['rfgroup']=='3'){
                $rtc=$rs['tt'];
            }else{
                $rtd=$rs['tt'];
            }    
        }
    }
}

// Refer Complete
$sqlc="SELECT 
               count(end_refer_end) as cpl,end_refer_end
            FROM v_rf_detail 
            WHERE rf_hospital='10682' AND end_refer_end='Y' 
                 group by end_refer_end";

$query=mysqli_query($conn,$sqlc);
while($rsp=mysqli_fetch_array($query))
{
    $rcp=$rsp['cpl'];
}
$rtt = ($rta + $rtb + $rtc+$rtd+$rcp);
$rga = (($rta / $rtt)*100);
$rgb = (($rtb / $rtt)*100);
$rgc = (($rtc / $rtt)*100);
// $rgd = (($rtt / $rtt)*100);
$rge = (($rcp / $rtt)*100);
include('main_top_menu_session_b.php');
?>
    <nav>
        <div class="outer lter bgcolor-green">
            <div class="boxed">
                <div class="container-fluid"
                    style="font-family: 'K2D';font-size: 18px;background-color:#FFEBEE;color:#20272F;">
                    <div class="row">
                        <div class="col-md-12" style="padding: 5px 5px 5px 5px">
                            <div class="row">
                                <?php include('main_refer_group.php'); ?>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-5" style="padding: 0px 0px 0px 5px">
                        <center>
                        <?php 
                             include('main_chart_pttype.php'); ?>
                        </center>
                    </div>
                    <div class="col-md-7" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php  
                            include('main_chart_table_pttype.php'); ?>
                        </center>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php
                            include('main_refer_credit.php'); 
                            ?>
                        </center>
                    </div>
                    <div class="col-md-7" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php 
                            include('main_refer_table_credit.php'); 
                            ?>
                        </center>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php 
                            include('main_seven_colorbed.php'); ?>
                        </center>
                    </div>
                    <div class="col-md-7" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php
                             include('main_seven_table_colorbed.php'); ?>
                        </center>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php 
                            include('main_refer_paida.php');
                             ?>
                        </center>
                    </div>
                    <div class="col-md-7" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php 
                            include('main_refer_table_paida.php'); 
                            ?>
                        </center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php 
                            include('main_refer_los.php'); 
                            ?>
                        </center>
                    </div>
                    <div class="col-md-7" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php 
                            include('main_refer_table_los.php'); 
                            ?>
                        </center>
                    </div>
                </div>

                <!-- Doctor staff -->
                <div class="row">
                    <div class="col-md-5" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php
                             include('main_docter_staff.php'); 
                            ?>
                        </center>
                    </div>
                    <div class="col-md-7" style="padding: 0px 0px 0px 5px">
                        <center>
                            <?php 
                            include('main_docter_table_staff.php'); 
                            ?>
                        </center>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>