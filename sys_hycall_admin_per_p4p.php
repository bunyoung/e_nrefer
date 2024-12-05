<!doctype html>
<meta http-equiv="content-type" content="10;text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
require_once("db/connection.php");
require_once("db/date_format.php");
?>

<?php
#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult='01/' ;
# $date_start_m_defult=date('m/');
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

<html class="no-js">

<head>
    <?php include('main_script.php'); ?>
</head>

<body class="">

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
                <div class="outer">
                    <div class="inner bg-light lter">

                        <!-- START PATIENT SERCH -->
                        <br>
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="alert alert-success">
                                    <form class="form-inline" action="sys_hycall_admin_login_p4p.php"
                                        name="ins_fund_main" method="POST" target="">
                                        <span>
                                            <i class="fa fa-clock-o">
                                            </i>&nbsp;&nbsp; ค้นหาข้อมูล ระหว่างวันที่:
                                            <input data-provide="datepicker" data-date-language="th-th" type="text"
                                                name="d_start" value="<?php 	echo $d_start; ?>"
                                                class="form-control autotab"
                                                placeholder="วัน / เดือน / ปี ระหว่างวันที่" />
                                            ถึงวันที่:
                                            <input data-provide="datepicker" data-date-language="th-th" type="text"
                                                name="d_end" value="<?php 	echo $d_end; ?>" class="form-control autotab"
                                                placeholder="วัน / เดือน / ปี ถึงวันที่" />

                                            <button type="submit" class="btn btn-info" value="submit"> แสดงข้อมูล
                                            </button>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="box success">
                                <header>
                                    <div class="icons">
                                        <button id="export_to_excel" class="btn btn-success btn-xs btn-grad"> <i
                                                class="fa fa-file-excel-o"></i></button>
                                    </div>
                                    <h5>สรุปงานภาระกิจ
                                        <a class="text-primary"> </a> ประจำเดือน
                                        <a class="text-black"><?php echo $d_start;echo ' - ' ;echo $d_end;?></a>
                                    </h5>
                                </header>
                                <div id="collapse4" class="body" style="overflow:scroll">

                                    <table id="dataTable" style="word-wrap: break-word;  overflow: hidden;"
                                        class="table table-bordered table-condensed table-hover table-striped">
                                        <thead>
                                            <tr class="gradeA">
                                                <th>
                                                    <center>ลำดับ
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
                                                    <center>ชื่อ นามสกุล
                                                    </center>
                                                </th>
                                                <th>
                                                    <center>อายุ
                                                    </center>
                                                </th>
                                                <th>
                                                    <center>ประเภทผู้ป่วย
                                                    </center>
                                                </th>
                                                <th>
                                                    <center>สถานที่ส่ง
                                                    </center>
                                                </th>
                                                <th>
                                                    <center>สถานที่รับ
                                                    </center>
                                                </th>
                                                <th>
                                                    <center>เจ้าหน้าที่เปล
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
                                                    <center>เวลาที่ใช้ไป
                                                    </center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                    $sql_deb_sum="SELECT
                                                    `vm`.`hyitem` AS `hyitem`,
                                                    `vm`.`fasts_name` AS `fasts_name`,
                                                    `vm`.`hassnamea` AS `hassnamea`,
                                                    `vm`.`hn` AS `hn`,
                                                    `vm`.`patients` AS `patients`,
                                                    `vm`.`old` AS `old`,
                                                    `vm`.`idcard` AS `idcard`,
                                                    `vm`.`pers` AS `pers`,
                                                    `vm`.`name` AS `name`,
                                                    `vm`.`fplace` AS `fplace`,
                                                    `vm`.`tplace` AS `tplace`,
                                                    `vm`.`hdate` AS `hdate`,
                                                    `vm`.`htime` AS `htime`,
                                                    `vm`.`x1_pertime` AS `x1_pertime`,
                                                    `vm`.`perto` AS `perto`,
                                                    `vm`.`perfinish` AS `perfinish`,
                                                    `vm`.`usetime` AS `usetime`,
                                                    `vm`.`usetimeAll` AS `usetimeAll`,
                                                    `vm`.`p4_day` AS `p4_day`,
                                                    `vm`.`p4_month` AS `p4_month`,
                                                    `vm`.`p4_year` AS `p4_year`
                                                  FROM `v_monitor` `vm`
                                                  WHERE ((`vm`.`hdate` BETWEEN '$d_start' AND '$d_end'))
                                                  ORDER BY `vm`.`hdate` ";
                                                    $result_sql_deb_sum = mysqli_query($conn,$sql_deb_sum); // connect HOSxP						
                                                    $i=1;				
                                                    while($rs_deb=mysqli_fetch_array($result_sql_deb_sum)) {
                                                    ?>
                                            <tr class="gradeA">
                                                <td>
                                                    <center>
                                                        <?php $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else{echo $n;}?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php echo $rs_deb['hdate']; ?>
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
                                                    <?php echo $rs_deb['fplace']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rs_deb['tplace']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rs_deb['name']; ?>
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
                                </div>
                            </div>
                        </DIV>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
mysqli_CLOSE($conn);
?>

</html>