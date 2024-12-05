<!doctype html>
<meta http-equiv="content-type" content="10;text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
require_once("db/connection.php");
?>
<?php 
$d_start = $_POST['d_start'];
$d_end = $_POST['d_end'];
?>
<html class="no-js">
<div class="" alt="">
    <head>
        <?php     
        include('main_script.php');
        include('main_top_panel_head.php');
        // include ("main_script_loading.php");
       ?>
    </head>

    <body class=" ">

        <script>
        $(document).ready(function() {
            $("#export_to_excel").click(function() {
                $("#dataTable").table2excel({
                    exclude: ".noExl",
                    name: "E-Hy center",
                    filename: "ภาระกิจงานศูนย์เปลตั้งแต่_<?php echo $d_start; ?>_ถึงวันที่_<?php echo $d_end; ?>.xls",
                    fileext: ".xls",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true
                });
            });
        });
        </script>

        <div class="boxed-wrapper">
            <div class="bg-blue dker" id="wrap">
                <script>
                $(function() {
                    Metis.dashboard();
                });
                </script>

                <div id="content" style="margin-top:-20px;">
                    <!-- <div class="outer"> -->
                        <div class="inner bg-light lter">
                            <!-- <hr> -->
                            <!-- <div class="col-lg-12"> -->
                                <div class="box success">
                                    <header>
                                        <div class="icons">
                                            <button id="export_to_excel" class="btn btn-success btn-xs btn-grad"> <i
                                                    class="fa fa-file-excel-o"></i></button>
                                        </div>
                                        <h5>สรุปงานภาระกิจ
                                            <a class="text-primary"> </a> ประจำเดือน
                                            <a class="text-defaalt"><?php echo $d_start;echo ' - ' ;echo $d_end;?></a>
                                        </h5>
                                    </header>
                                    <div id="collapse4" class="body" style="overflow:scroll">

                                        <table id="dataTable" style="word-wrap: break-word;"
                                            class="table table-bordered table-condensed table-hover table-striped">
                                            <thead>
                                                <tr class="gradeA">
                                                    <th>
                                                        <center>ลำดับ
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>หมายเลขงาน
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>ประจำวันที่
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>HN
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>ชื่อ-นามสกุล
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>อายุ(ปี)
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>ความเร่งด่วน
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>ผู้ป่วยเฉพาะ
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>วิธีการเคลื่อนย้าย
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>ต้นทาง
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>ปลายทาง
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>เจ้าหน้าที่เปลคนที่ 1
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>เจ้าหน้าที่เปลคนที่ 2
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>ผู้จ่ายงาน
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>เวลาร้องขอ
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>เวลารับเรื่อง
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>เวลารับผู้ป่วย
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>เวลาจบงาน
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>ระยะเวลารับผู้ป่วย
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>รับงานผ่านทาง
                                                        </center>
                                                    </th>
                                                    <th>
                                                        <center>จบงานผ่านทาง</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $sql_deb_sum="
                                                SELECT  *  
                                                FROM v_monitor   
                                                WHERE hdate BETWEEN '$d_start' AND '$d_end'     
                                                 ORDER BY hdate ";

                                                 $result_sql_deb_sum = mysqli_query($conn,$sql_deb_sum); 
                                                 $i=1;				
                                                 while($rs_deb=mysqli_fetch_array($result_sql_deb_sum)) {
                                                ?>
                                                <tr class="gradeA">
                                                    <td>
                                                        <center>
                                                            <?php    $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else{echo $n;}?>
                                                        </center>
                                                    </td>

                                                    <td>
                                                        <center>
                                                            <?php    echo $rs_deb['hyitem']; ?>
                                                        </center>
                                                    </td>

                                                    <td>
                                                        <center>
                                                            <?php    echo $rs_deb['hdate']; ?>
                                                        </center>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['hn']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['patients'];?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['old']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['fasts_name']; ?>
                                                    </td>

                                                    <td>
                                                    <?php
                                                        echo $rs_deb['sicka'].' '
                                                                         .' '.$rs_deb['sickb'].' '
                                                            .$rs_deb['sickc'].' '.$rs_deb['sickd'].' '
                                                            .$rs_deb['sicke'].' '.$rs_deb['sickf'].' '
                                                            .$rs_deb['sickg'].' '.$rs_deb['sickh'].' '
                                                            .$rs_deb['ems'].' '.$rs_deb['covidgp'].' '
                                                            .$rs_deb['sicki'].' '.$rs_deb['sickj'].' '
                                                            .$rs_deb['sickk'].' '.$rs_deb['sickl'];
                                                    ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['hassnamea']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['fplace']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['tplace']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['name']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['empname']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['ufname']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['htime']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['x1_pertime']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['perto']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['perfinish']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['usetime']; ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $rs_deb['rmachine']; ?>
                                                    </td>
                                                   
                                                    <td>
                                                        <center><?php  echo $rs_deb['machine']; ?></center>
                                                    </td>
                                                </tr>
                                                <?php   
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </body>
</div>
<?php 
 require("main_footer_panel.php");
?>
<?PHP
mysqli_CLOSE($conn);
?>

</html>