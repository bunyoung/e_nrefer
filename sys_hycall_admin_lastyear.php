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
require_once("db/connection.php");
?>

<?php
#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult='01/' ;
$date_start_m_defult='01/';
$date_start_y_defult=date('Y')+543 ;
$date_start_dmy_defult	= $date_start_d_defult.$date_start_m_defult.$date_start_y_defult;

$date_end_dm_defult=date('d/m/') ;
$date_end_y_defult=date('Y')+543 ;
$date_end_dmy_defult=$date_end_dm_defult.$date_end_y_defult;

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
<div class="" alt="">

    <head>
        <?php     
        include('main_top_panel_head.php');
       ?>
    </head>

    <body class=" ">
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
                                        <form class="form-inline" action="sys_hycall_admin_lastyear_det.php"
                                            name="ins_fund_main" method="POST" target="_blank">
                                            <span>
                                                <i class="fa fa-clock-o">
                                                </i>&nbsp;&nbsp; ค้นหาข้อมูล ระหว่างวันที่:
                                                <input data-provide="datepicker" data-date-language="th-th" type="text"
                                                    name="d_start" value="<?php echo $d_start; ?>"
                                                    class="form-control autotab"
                                                    placeholder="วัน / เดือน / ปี ระหว่างวันที่" />
                                                ถึงวันที่:
                                                <input data-provide="datepicker" data-date-language="th-th" type="text"
                                                    name="d_end" value="<?php 	echo $d_end; ?>"
                                                    class="form-control autotab"
                                                    placeholder="วัน / เดือน / ปี ถึงวันที่" />

                                                <button type="submit" class="btn btn-info" value="submit"> แสดงข้อมูล
                                                </button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    </body>
</div>
<?php 
 require("main_footer_panel.php");
?>
<?PHP
mysqli_CLOSE($conn);
?>

</html>