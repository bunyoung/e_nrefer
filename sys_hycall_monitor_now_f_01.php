<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
if(!isset($_SESSION)) 
{  
    session_start(); 
}
$hcode=$_SESSION['hcode'];
require_once("./db/connection.php");
include('main_script.php');
include('sys_hycall_send_line.php');
include('sys_hycall_send_mail.php');
?>
<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>

<body style="font-family:K2D;font-size:18px;">
    <div class="container-fluid" style="margin: 2px 2px 2px;padding: 2px 2px 2px;">
        <table id="v_view_refer_today" class="table table-condensed" data-toggle="table" data-search="true"
            data-show-print="true" data-pagination="true" data-page-list="[10, 25, 50, 100, ALL]" data-page-size="10"
            data-side-pagination="client" data-show-refresh="true" 
            data-url="data_q_veiw_today.php?id=".$d_default&va='All';
            style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                               font-family:K2D;font-size:18px;">
            <thead style=" background-color: buttonface;">
                <tr>
                    <th data-field="id" data-sortable="true" class="text-center  text-black">
                        <font style="color: black;"> Ref No. </font>
                    </th>
                    <!-- <th data-field="round_p4p" data-sortable="true" class="text-center  text-black">
                        <font style="color: black;"> Requested </font>
                    </th>
                    <th data-field="year_p4p" data-sortable="true" class="text-center  text-black">
                        <font style="color: black;"> Edited</font>
                    </th>
                    <th data-field="project_month" data-sortable="true" class="text-center  text-black">
                        <font style="color: black;"> Refer Type </font>
                    </th>
                    <th data-field="result_round" data-sortable="true" class="text-center  text-black">
                        <font style="color: black;"> Priority </font>
                    </th>
                    <th data-field="project_size" data-sortable="true" class="text-center  text-black">
                        <font style="color: black;"> Service </font>
                    </th>
                    <th data-field="project_name" data-sortable="true" class="text-left  text-black">
                        <font style="color: black;"> HN </font>
                    </th>
                    <th data-field="flname" data-sortable="true" class="text-left  text-black">
                        <font style="color: black;"> Name </font>
                    </th>
                    <th data-field="project_status" data-sortable="true" class="text-center  text-black">
                        <font style="color: black;"> Sex </font>
                    </th>
                    <th data-field="customer" class="text-center  text-black">
                        <font style="color: black;"> Age </font>
                    </th>
                    <th data-field="customer" class="text-center  text-black">
                        <font style="color: black;"> Medical </font>
                    </th>
                    <th data-field="customer" class="text-center  text-black">
                        <font style="color: black;"> Destination </font>
                    </th>
                    <th data-field="customer" class="text-center  text-black">
                        <font style="color: black;"> Doctor refer </font>
                    </th>
                    <th data-field="customer" class="text-center  text-black">
                        <font style="color: black;"> Department </font>
                    </th>
                    <th data-field="customer" class="text-center  text-black">
                        <font style="color: black;"> Status </font>
                    </th>
                    <th data-field="customer" class="text-center  text-black">
                        <font style="color: black;"> Doctor </font>
                    </th> -->
                </tr>
            </thead>
        </table>
    </div>
</body>

<!---MODAL -->
<!-- ยืนยันการ Refer -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_approve_moph').on('show.bs.modal', function(e) {
        var rid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_hospital_ref_con.php', //Here you will fetch records 
            data: {
                'rid_p': rid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_approve_moph" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="color:#212121;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times; </button>
                <h5 class="modal-title" style="color:black;">
                    <i class="fa fa-group"> </i> : ยืนยันการรับ Refer
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด </button>
            </div>
        </div>
    </div>
</div>

<!-- Time interval  -->
<script type="text/javascript">
setTimeout(function() {
    location.reload();
}, 240000);
</script>

<!-- Confirm Delete-->
<script type="text/javascript">
$(".remove").click(function() {
    var id = $(this).parents("tr").attr("id");
    if (confirm(' ยืนยันรบการข้อมูลนี้ใช่ไหม ?')) {
        $.ajax({
            url: 'sys_hycall_monitor_now_delete.php',
            type: 'GET',
            data: {
                id: id
            },
            error: function() {
                alert('ไม่สามารถทำการลบข้อมูลนี้ได้ .. ');
            },
            success: function(data) {
                $("#" + id).remove();
                alert("ลบรายการข้อมูลให้เรียบร้อยแล้ว ..");
            }
        });
    }
});
</script>

</html>