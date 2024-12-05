<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require_once('db/date_format.php');
require_once("db/connection.php");
require_once("db/conn_his.php");
require_once('function/conv_date.php');
require_once('db/connect_pmk.php');
include('main_script.php');
?>
<?php
include('main_top_panel_head.php');
include ('main_script.php');
?>
<?php
$SQLpla = mysqli_query($conn,"SELECT id,clean_place
FROM sys_clean_place Where clean_status='0' Order by clean_place") OR die(mysqli_error());

$SQLlv = mysqli_query($conn,"SELECT id,clean_level
FROM sys_clean_level WHERE clean_status ='0'ORDER BY clean_level") OR die(mysqli_error());

$SQLplc = mysqli_query($conn,"SELECT place_id,placecode,fullplace
            FROM places ORDER BY fullplace") OR die(mysqli_error());

$SQLplp = mysqli_query($conn,"SELECT place_id,placecode,fullplace
FROM places ORDER BY fullplace") OR die(mysqli_error());

$SQLhis = mysqli_query($conh,"SELECT *
FROM his_sys_user WHERE t_depart='43' ORDER BY t_name,t_lastname") OR die(mysqli_error());

$SQLhys = mysqli_query($conn,"SELECT mys_code,mys_user_care,mys_status
FROM sys_hys_mest WHERE mys_status='0' ORDER BY mys_user_care") OR die(mysqli_error());
?>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default" style="margin-left:-15px;margin-top:-20px;">
                    <div class="panel-heading" style="background:#ff8040;opacity: 0.65;
                         color:#fae7f1 ;font-size: 1.2em;font-weight: bold;">
                        <img src="img/New folder/hy_Hgk_icon.ico"
                            style="width:20px;height:20px;margin-top:-10px;"></img>
                        HYs-MEST [Group]
                    </div>
                    <div class="panel-body" style="background:#96cccd;opacity: 0.75;
                        color:#004f4f;font-weight: bold;font-size: 1.1em;">
                        <form class="form-horizontal" action="sys_hycurr_db.php" method="POST" target="" name="" id="">
                            <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-lg-4" for="assfplace">รหัสหน้าที่ปฎิบัติงาน</label>
                                        <div class="col-lg-8">
                                            <select class="form-control select2" style="width:100%;" name="assfplace"
                                                id="assp">
                                                <option value="" selected disabled>(เลือกรายการ)</option>
                                                <?php
                                        while($row1=mysqli_fetch_array($SQLhys))
                                        {
                                        ?>
                                                <option value="<?php echo $row1['mys_code'];?>">
                                                    <?php echo '['.$row1['mys_code'].']'.'  '.$row1['mys_user_care'];?>
                                                </option>
                                                <?php
                                        }
                                        ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-4" for="assfplace">ตึก</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" id="myscode" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4" for="assdet">รายละเอียดเพิ่มเติมสำหรับรายการ</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" name="assdet" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4" for="levcl"><a href="http://192.168.99.15/e_timekeeper"
                                                target="_blank">ผู้รับงาน(ทะเบียน HRM)</a></label>
                                        <div class="col-md-8">
                                            <select class="form-control select2" style="width:100%;" name="argent">
                                                <option value="" selected disabled>(เลือกรายการ)</option>
                                                <?php
                                        while($row1=mysqli_fetch_array($SQLhis))
                                        {
                                        ?>
                                                <option value="<?php echo $row1['t_idcard'];?>">
                                                    <?php echo '['.$row1['t_idcard'].']'.'  '
                                                .$row1['t_name'].'  '
                                                .$row1['t_lastname'];?>
                                                </option>
                                                <?php
                                        }
                                        ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <hr>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-4" for="" style="margin-left:13px;"></label>
                                        <input type="hidden" name="DADG" value="DADG">
                                        <button type="submit" class="btn btn-success btn-grad">
                                            <span class="glyphicon glyphicon-ok-circle"></span>
                                            ลงบันทึกขอใช้บริการ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<!--- alert ----->
<script src="../assets/js/bootbox.js"></script>

<!-- nitiy -->
<script src="../assets/js/notify.js"></script>

<script src="../assets/js/bootstrap-timepicker.min.js"></script>
<script src="../assets/js/moment.min.js"></script>
<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../assets/js/jquery.knob.min.js"></script>
<script src="../assets/js/autosize.min.js"></script>
<script src="../assets/js/jquery.inputlimiter.min.js"></script>
<script src="../assets/js/jquery.maskedinput.min.js"></script>
<script src="../assets/js/bootstrap-tag.min.js"></script>
<script src="../assets/bootstrap-table/src/bootstrap-table.js"></script>
<script src="../assets/js/clipboard.min.js"></script>
<!-- ace scripts -->
<script src="../assets/js/ace-elements.min.js"></script>
<script src="../assets/js/ace.min.js"></script>
<script src="../assets/js/select2.js"></script>
<!--Autocomplate -->
<script type="text/javascript" src="../assets/js/autocomplete.js"></script>
<script src="../assets/js/bootstrap-select.js"></script>

<script type="text/javascript">
$(function() {
    $(".select2").select2();
});
</script>

<script type="text/javascript">
// var myscode = document.getElementById("myscode");
// var mysbuild = document.getElementById("mysbuild");
// var mysfloor = document.getElementById("mysfloor");
$(document).ready(function() {
    $("#assp").on("change", function() {
        alert(this.value);
        var mcode = $(this).val();
        alert(mcode);
        $.ajax({
            url: "show_name.php",
            type: "POST",
            data: {
                mcode: mcode
            },
            success: function(data) {
                alert(console.log(data));
                console.log(data);
                if (data == 0) {
                    alert('ไม่พบรหัสรายการที่เลือก...');
                    $('#myscode').val('');
                    $('#mysbuild').val('');
                    $('#mysfloor').val('');
                } else {
                    var myscode = data[0].myscode;
                    var mysbuild = data[0].mysbuild;
                    var mysfloor = data[0].mysfloor;
                    alert(myscode);

                    $('#myscode').val(myscode);
                    $('#mysbuild').val(mysbuild);
                    $('#mysfloor').val(mysfloor);
                }
                exit();
            }
        });
    });
});
</script>


<!-- $.ajax({
        url: "get_pmk.php",
        type: "POST",
        data: {
            an: an
        },
        success: function(data) {
            console.log(data);
            if (data == 0) {
                alert('ไม่เจอ AN นี้ในระบบ');
                $('#txt-an').val('');
                $('#txt-flname').val('');
                $('#txt-places').val('');
                $('#txt-places-name').val('');
                $('#txt-age').val('');
                $('#txt-bed').val('');
                $('#txt-diag').val('');
                $('#txt-doctor').val('');
                $('#s-flname').val('');
                // document.getElementById("an").focus();
            } else {
                //console.log(data[0].an);

                var an = data[0].an;
                var flname = data[0].flname;
                var places = data[0].places;
                var places_name = data[0].places_name;
                var bed = data[0].bed_no;
                var age = data[0].age;
                var diag = data[0].diag;
                var doctor = data[0].doctor;

                //alert(flname);
                $('#txt-an').val(an);
                $('#txt-flname').val(flname);
                $('#txt-places').val(places);
                $('#txt-places-name').val(places_name);
                $('#txt-bed').val(bed);
                $('#txt-age').val(age);
                $('#txt-diag').val(diag);
                $('#txt-doctor').val(doctor);
                $('#s-flname').html('AN: ' + an + ' ' + flname);
                $('#t-view-all').bootstrapTable('refresh', {
                    url: "q_view_detail.php?an=" + an
                });
            }
        } -->