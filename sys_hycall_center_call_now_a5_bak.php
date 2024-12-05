<?php
require_once('db/date_format.php');
require_once("db/connection.php");
require_once('function/conv_date.php');
require_once('db/connect_pmk.php');
include('main_script.php');
?>

<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
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

$SQLplr = mysqli_query($conn,"SELECT id,clean_argent,status
FROM sys_clean_argent WHERE status='0' ORDER BY clean_argent ") OR die(mysqli_error());

$SQLhys = mysqli_query($conn,"SELECT hysm_code,hysm_description,hysm_status
FROM sys_hys_mest WHERE hysm_status='0' ORDER BY hysm_description") OR die(mysqli_error());

?>

<div class="container-fluid">
    <p>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default" style="margin-left:-15px;">
                <div class="panel-heading" style="background:#ff8040;opacity: 0.65;
                         color:#fae7f1 ;font-size: 1.2em;font-weight: bold;">
                    <img src="img/New folder/hy_Hgk_icon.ico" style="width:20px;height:20px;margin-top:-10px;"></img>
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
                                    <div class="col-lg-4">
                                        <select class="form-control select2" style="width:100%;" name="assfplace"
                                            id="job">
                                            <option value="" selected disabled>(เลือกรายการ)</option>
                                            <?php
                                        while($row1=mysqli_fetch_array($SQLhys))
                                        {
                                        ?>
                                            <option value="<?php echo $row1['id'];?>">
                                                <?php echo '['.$row1['hysm_code'].']'.'  '.$row1['hysm_description'];?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-4" for="assdet">รายละเอียดเพิ่มเติมสำหรับรายการ</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" name="assdet" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-4" for="levcl">ผู้รับงาน</label>
                                    <div class="col-md-4">
                                        <select class="form-control select2" style="width:100%;" name="argent">
                                            <option value="" selected disabled>(เลือกรายการ)</option>
                                            <?php
                                        while($row1=mysqli_fetch_array($SQLplr))
                                        {
                                        ?>
                                            <option value="<?php echo $row1['id'];?>">
                                                <?php echo '['.$row1['id'].']'.'  '.$row1['clean_argent'];?>
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
                                    <label class="col-md-4" style="margin-left:15px;" for=""></label>
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
        <div class="col-lg-3">
            <div class="panel panel-default" style="margin-left:-15px;">
                <div class="panel-heading" style="background:#ff8040;opacity: 0.65;
                         color:#fae7f1 ;font-size: 1.2em;font-weight: bold;">
                    <img src="img/New folder/hy_Hgk_icon.ico" style="width:20px;height:20px;margin-top:-10px;"></img>
                    [รายละเอียดเพิ่มเติมสำหรับรายการ]
                </div>
                <div class="panel-body" style="background:#96cccd;opacity: 0.75;
                        color:#004f4f;font-weight: bold;font-size: 1.1em;">
                    <form class="form-horizontal" action="sys_hycurr_db.php" method="POST" target="" name="" id="">
                        <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                        <div class="panel-body">
                            <div class="row">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <?php include('hysm_mest.graph.php');?>
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

$(function() {
    $(".select2").select2();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#job").on("change", function() {
        var jobid = $(this).val();
        if (jobid) {
            $.ajax({
                url: "job-action.php",
                type: "POST",
                cache: false,
                data: {
                    jobid: jobid
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