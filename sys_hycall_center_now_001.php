<!doctype html>
<html class="no-js">

<head>
    <meta charset="UTF-8">
    <title>E-Logistic</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.gif" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
</head>
<?php session_start();
    $page=basename($_SERVER['PHP_SELF']);
	if (file_exists('_couter/'.$page.'.txt')) 
	{
		$fil = fopen('_couter/'.$page.'.txt', "r");
		$dat = fread($fil, filesize('_couter/'.$page.'.txt')); 
		#echo $dat+1;
		fclose($fil);
		$fil = fopen('_couter/'.$page.'.txt', "w");
		fwrite($fil, $dat+1);
	}
	else
	{
		$fil = fopen('_couter/'.$page.'.txt', "w");
		fwrite($fil, 1);
		#echo '1';
		fclose($fil);
	}
    ?>
<?php
#read number
$myFile = "_couter/".$page.".txt";
$lines = file($myFile);//file in to an array
$count= $lines[0]; //line 2
?>

<?php
include('main_script.php');
include('db/date_format.php');
include("db/connection.php");
include('function/conv_date.php');
include('db/connect_pmk.php');
?>

<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<!-- ดึงวันที่ปัจจุบัน -->
<?php
        include('main_top_panel_head.php');
        include ('main_script.php');
        ?>

<html class="no-js">
<div class="" alt="">
    <!-- ใช้เรียกเวลาจาก server -->
    <script language="JavaScript1.2">
    function server_date(now_time) {
        current_time1 = new Date(now_time);
        current_time2 = current_time1.getTime() + 1000;
        current_time = new Date(current_time2);
        server_time.innerHTML = current_time.getDate() + "/" + (current_time.getMonth() + 1) + "/" +
            current_time
            .getYear() + " " + current_time.getHours() + ":" + current_time.getMinutes() + ":" + current_time
            .getSeconds();
        setTimeout("server_date(current_time.getTime())", 1000);
    }
    setTimeout("server_date('<?=$current_server_time?>')", 1000);
    </script>
    <?php
        $current_server_time = date("H:i:s");
        ?>

    <body>
        <script>
        $(function() {
            Metis.dashboard();
        });
        </script>
        <div id="content3" style="margin-top:-20px;">
            <div class="inner bg-light lter">
                <div class="col-lg-12">
                    <div class="page-content">
                        <p>
                        <div class="exTab">
                            <ul class="nav nav-pills">
                                <li class="active"><a data-toggle="tab" href="#home"><i
                                            class="fa fa-fw fa-bell-o fa-lg"></i>
                                        บริการงานอุปกรณ์ทางการแพทย์และขอเลือด</a>
                                </li>
                                <li><a data-toggle="tab" href="#menu1"><i class="fa fa-user-plus fa-lg"
                                            aria-hidden="true"></i>
                                        บริการงานเคลื่อนย้ายสิ่งของ</a></li>
                            </ul>
                            <hr>
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    <div class="panel-group">
                                        <?php include('sys_hycall_center_call_now_a1.php'); ?>
                                    </div>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <div class="panel-group">
                                        <?php include ('sys_hycall_center_call_now_a2.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal_receive_cancel" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;
                                    </button>
                                    <h5 class="modal-title">
                                        <i class="fa fa-group">
                                        </i> : ยกเลิกรายการร้องขอ
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <div class="fetched-data_rc">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="myModal_receive_wait">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;
                                    </button>
                                    <h5 class="modal-title text-success">
                                        <i class="fa fa-user">
                                        </i> : ส่งคนไข้กลับหน่วยงานเดิม
                                    </h5>
                                </div>
                                <div class="modal-body text-success">
                                    <div class="fetched-data_rc">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
        $(function() {
            $("#assf").change(function() {
                if (($(this).val() == 2) || ($(this).val() == 11)) {
                    $("#hn").removeAttr("disabled");
                    $("#hn").focus();
                } else {
                    $("#hn").attr("disabled", "disabled");
                }
            });
        });
        </script>

        <script type="text/javascript">
        $(document).ready(function() {
            $("#place").on("change", function() {
                var placeid = $(this).val();
                if (placeid) {
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        cache: false,
                        data: {
                            placeid: placeid
                        },
                        success: function(data) {
                            $("#state").html(data);
                            // $('#city').html('<option value="">Select state</option>');
                        }
                    });
                }
            });
        });
        </script>

        <script>
        $(function() {
            Metis.MetisTable();
            Metis.metisSortable();
        });
        </script>
        <script type="text/javascript" src="assets/js/jquery.min.js"> </script>
        <script type="text/javascript" src="assets/js/jquery-ui.min.js"> </script>
        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"> </script>
        <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js">
        </script>

        </script>
        <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js">
        </script>

        <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#dataTable').dataTable({
                "oLanguage": {
                    "oPaginate": {
                        "sFirst": "หน้าแรก",
                        "sLast": "หน้าสุดท้าย",
                        "sNext": "ถัดไป",
                        "sPrevious": "ก่อนหน้า"
                    },
                    "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                    "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                    "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                    "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                    "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                    "sSearch": "ค้นหา :"
                }
            });
        });
        </script>

        <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#rdataTable').dataTable({
                "oLanguage": {
                    "oPaginate": {
                        "sFirst": "หน้าแรก",
                        "sLast": "หน้าสุดท้าย",
                        "sNext": "ถัดไป",
                        "sPrevious": "ก่อนหน้า"
                    },
                    "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                    "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                    "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                    "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                    "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                    "sSearch": "ค้นหา :"
                }
            });
        });
        </script>

        <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $('#vdataTable').dataTable({
                "oLanguage": {
                    "oPaginate": {
                        "sFirst": "หน้าแรก",
                        "sLast": "หน้าสุดท้าย",
                        "sNext": "ถัดไป",
                        "sPrevious": "ก่อนหน้า"
                    },
                    "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                    "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                    "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                    "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                    "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                    "sSearch": "ค้นหา :"
                }
            });
        });
        </script>

        <!--- มอบหมายงาน 0 เปล -->
        <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal_receive_wait').on('show.bs.modal', function(e) {
                var jhyitem = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'post',
                    url: 'sys_hycall_center_end_finish_patients.php', //Here you will fetch records
                    data: {
                        'hyid': jhyitem
                    }, //Pass $id
                    success: function(data) {
                        $('.fetched-data_rc').html(data);
                        //แสดงรายการข้อมูจาก database
                    }
                });
            });
        });
        </script>
        <!--- มอบหมายงาน 0 เปล -->
        <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal_receive_cancel').on('show.bs.modal', function(e) {
                var hitem = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'post',
                    url: 'sys_hycall_center_cancel.php', //Here you will fetch records
                    data: {
                        'hyitems': hitem
                    }, //Pass $id
                    success: function(data) {
                        $('.fetched-data_rc').html(data);
                    }
                });
            });
        });
        </script>

        <script type="text/javascript">
        $(document).ready(function() {
            $("#place").on("change", function() {
                var placeid = $(this).val();
                if (placeid) {
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        cache: false,
                        data: {
                            placeid: placeid
                        },
                        success: function(data) {
                            $("#state").html(data);
                            // $('#city').html('<option value="">Select state</option>');
                        }
                    });
                }
            });
        });
        </script>
<script src="assets/plugins/select2/select2.js"></script>
<!-- <script src="assets/plugins/select2/select2.full.min.js"></script> -->
<script>
$(function() {
    $(".select2").select2();

    // ใช้สำหรับการทำ Multiple select
    // $(".js-example-basic-multiple-limit").select2({
    //     maximumSelectionLength: 2
    // });
});
</script>

<!-- <script type="text/javascript">
$(function() {
    $("#assf").change(function() {
        if (($(this).val() == 2) || ($(this).val() == 11)) {
            $("#hn").removeAttr("disabled");
            $("#hn").focus();
        } else {
            $("#hn").attr("disabled", "disabled");
        }
    });
});
</script> -->
    </body>
    <?php 
 require("main_footer_panel.php");
?>
    <?php 
 oci_close($objConnect);
?>

</html>