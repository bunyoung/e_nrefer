<!doctype html>
<meta http-equiv="content-type" content="10;text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<?php
        include('main_script.php');
        // include 'sys_hycall_user_p4p.php';
?>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>

<?php
        include('main_script.php');
        // include 'sys_hycall_user_p4p.php';

require_once("db/connection.php");
require_once("db/date_format.php");
?>

<?php
$d_start_post = $_POST['d_start'];
$d_end_post = $_POST['d_end'];
?>

<html class="no-js">
<div class="" alt="">

    <head>
        <?php     
        include('main_top_panel_head.php');
       ?>
    </head>

    <body class=" ">
        <script>
        $(document).ready(function() {
            $("#export_to_excel").click(function() {
                $("#dataTable").table2excel({
                    exclude: ".noExl",
                    name: "E-Hy center",
                    filename: "ภาระกิจงานศูนย์เปลตั้งแต่_<?php echo $d_start_post; ?>_ถึงวันที่_<?php echo $d_end_post; ?>.xls",
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
                        <!-- <div class="col-lg-12"> -->
                        <div class="box success">
                            <header>
                                <div class="icons">
                                    <button id="export_to_excel" class="btn btn-success btn-xs btn-grad"> <i
                                            class="fa fa-file-excel-o"></i></button>
                                </div>
                                <h5>สรุปงานภาระกิจ
                                    <a class="text-primary"> </a> ประจำเดือน
                                    <a class="text-defaalt"><?php echo $d_start_post;echo ' - ' ;echo $d_end_post;?></a>
                                </h5>
                            </header>
                            <div id="collapse4" class="body" style="overflow:scroll">
                                <!-- <table id="dataTable" style="word-wrap: break-word;"
                                class="display" style="width:100%"> -->
                                    <!-- class="table table-bordered table-condensed table-hover"> -->

                                    <table id="dataTable" style="word-wrap: break-word;  overflow: hidden;"
                                    class="table table-bordered table-condensed table-hover table-striped">
                                    <thead>
                                        <tr class="gradeA">
                                            <th>
                                                <center>ลำดับ </center>
                                            </th>
                                            <th>
                                                <center>หมายเลขงาน </center>
                                            </th>
                                            <th>
                                                <center>ประจำวันที่</center>
                                            </th>
                                            <th>
                                                <center>HN </center>
                                            </th>
                                            <th>
                                                <center>ชื่อ นามสกุล </center>
                                            </th>
                                            <th>
                                                <center>อายุ </center>
                                            </th>
                                            <th>
                                                <center>ประเภทผู้ป่วย </center>
                                            </th>
                                            <th>
                                                <center>อุปกรณ์ </center>
                                            </th>
                                            <th>
                                                <center>ต้นทาง </center>
                                            </th>
                                            <th>
                                                <center>ปลายทาง </center>
                                            </th>
                                            <th>
                                                <center>การรับงาน </center>
                                            </th>
                                            <th>
                                                <center>การปิดงาน </center>
                                            </th>
                                            <th>
                                                <center>เจ้าหน้าที่เปลคนที่ 1 </center>
                                            </th>
                                            <th>
                                                <center>เจ้าหน้าที่เปลคนที่ 2</center>
                                            </th>
                                            <th>
                                                <center>เวลาร้องขอ</center>
                                            </th>
                                            <th>
                                                <center>เวลารับเรื่อง </center>
                                            </th>
                                            <th>
                                                <center>เวลารับผู้ป่วย </center>
                                            </th>
                                            <th>
                                                <center>เวลาจบงาน </center>
                                            </th>
                                            <th>
                                                <center>เวลาที่ใช้ไป </center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                    $dd_start_d = substr($d_start_post,0,2) ;
                                                    $dd_start_m = substr($d_start_post,3,2);
                                                    $dd_start_y = substr($d_start_post,6,4);

                                                    $dd_end_d =  substr($d_end_post,0,2);
                                                    $dd_end_m =  substr($d_end_post,3,2);
                                                    $dd_end_y  =  substr($d_end_post,6,4) ;
                                                    
                                                    $sql_deb_sum="
                                                    SELECT
                                                    *
                                                    FROM v_monitor_hysm
                                                    WHERE ((p4_day      BETWEEN '$dd_start_d' AND '$dd_end_d') 
                                                         AND  (p4_month BETWEEN '$dd_start_m' AND '$dd_end_m') 
                                                         AND  (p4_year    BETWEEN '$dd_start_y' AND '$dd_end_y'))
                                                        ORDER BY p4_year,p4_month,p4_day";

                                                    $result_sql_deb_sum = mysqli_query($conn,$sql_deb_sum); // connect HOSxP						
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
                                                <?php echo $rs_deb['hassnamea']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rs_deb['fplace']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rs_deb['tplace']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rs_deb['rmachine']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rs_deb['machine']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rs_deb['pname1']; ?>
                                            </td>
                                            <td>
                                                <?php echo $rs_deb['pname2']; ?>
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
                                                <?php echo $rs_deb['usetimeall']; ?>
                                            </td>
                                        </tr>
                                        <?php   
                                                    }
                                                    ?>
                                    </tbody>
                                </table>
                                <!-- </div> -->
                            </div>
                        </div>
                        <!-- <hr> -->
                        <!-- </div> -->
                        <!-- <hr> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
            <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    scrollX: '200px',
                    scrollCollapse: true,
                    paging: false,
                });
            });
            </script>
    </body>
</div>
<?php 
 require("main_footer_panel.php");
?>
<?PHP
mysqli_CLOSE($conn);
?>

</html>