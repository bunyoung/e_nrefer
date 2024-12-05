<?PHP
include('main_script.php');
?>
<?php
$SQLass = mysqli_query($conn,"SELECT assetid,assname
FROM v_sys_asset  Where asstype='0' and linkhos='0' ") OR die(mysqli_error());

$SQLpld = mysqli_query($conn,"SELECT id,unit
FROM sys_unit WHERE status ='0'ORDER BY unit") OR die(mysqli_error());

$SQLass = mysqli_query($conn,"SELECT assetid,assname
FROM sys_asset  Where asstype='0' and linkhos='0'
ORDER BY assname") OR die(mysqli_error());

$SQLplc = mysqli_query($conn,"SELECT placecode,fullplace
            FROM places ORDER BY fullplace") OR die(mysqli_error());

$SQLplp = mysqli_query($conn,"SELECT placecode,fullplace
FROM places ORDER BY fullplace") OR die(mysqli_error());

$SQLplh = mysqli_query($conn,"SELECT placecode,fullplace
FROM places ORDER BY fullplace") OR die(mysqli_error());

$SQLplr = mysqli_query($conn,"SELECT id,clean_argent,status
FROM v_sys_clean_argent WHERE status='0'") OR die(mysqli_error());

?>

<div class="container-fluid">
    <p>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-left:-15px;">
                <div class="panel-heading" style="background:#336633;opacity: 0.85;
                         color:#FFFFFF;font-size: 1.2em;font-weight: bold;">
                    <span class="glyphicon glyphicon-send"></span>
                    ขอใช้บริการขนส่งเวชภัณฑ์และสิ่่งของอื่นๆ
                </div>
                <div class="panel-body" style="background:#009999;opacity: 0.90;
                        color:#33FFFF;font-weight: bold;font-size: 1.1em;">
                    <form class="form-horizontal" action="sys_hycurr_db.php" method="POST" target="" name="" id="">
                        <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4" for="desc">หน่วยร้องขอ</label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2" style="width:100%;" name="hplace">
                                            <option value="" selected disabled>(เลือกรายการ)</option>
                                            <?php
                                        while($row1=mysqli_fetch_array($SQLplh))
                                        {
                                        ?>
                                            <option value="<?php echo $row1['placecode'];?>">
                                                <?php echo '['.$row1['placecode'].']'.'  '.$row1['fullplace'];?>
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
                                    <label class="col-sm-4" for="desc">ความต้องการในการบริการ</label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2" style="width:100%" name="assf" id="assf">
                                            <option value="" selected disabled>(เลือกรายการ)</option>
                                            <?php
                                            while($row1=mysqli_fetch_array($SQLass))
                                            {
                                            ?>
                                            <option value="<?php echo $row1['assetid'];?>">
                                                <?php echo $row1['assname'];?>
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
                                    <label class="col-sm-4" for="asstplace">หน่วยงานต้นทางที่ให้ HYs-MEST ไป
                                        "รับ"</label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2" style="width:100%;" name="assfplace">
                                            <option value="" selected disabled>(เลือกรายการ)</option>
                                            <?php
                                        while($row1=mysqli_fetch_array($SQLplc))
                                        {
                                        ?>
                                            <option value="<?php echo $row1['placecode'];?>">
                                                <?php echo '['.$row1['placecode'].']'.'  '.$row1['fullplace'];?>
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
                                    <label class="col-sm-4" for="assdet">รายละเอียดเพิ่มเติมสำหรับรายการ</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="assdet" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-4" for="asstplace">หน่วยงานปลายทางที่ให้ HYs-MEST ไป
                                        "ส่ง"</label>
                                    <div class="col-sm-6">
                                        <select class="form-control select2" style="width:100%;" name="asstplace">
                                            <option value="" selected disabled>(เลือกรายการ)</option>
                                            <?php
                                        while($row1=mysqli_fetch_array($SQLplp))
                                        {
                                        ?>
                                            <option value="<?php echo $row1['placecode'];?>">
                                                <?php echo '['.$row1['placecode'].']'.'  '.$row1['fullplace'];?>
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
                                    <label class="col-sm-4" for="idsend">จำนวน/หน่วย</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control input-sm" name="notot" value="">
                                    </div>
                                    <label class="col-sm-2" for="unit">หน่วยนับ</label>
                                    <div class="col-sm-2">
                                        <select class="form-control select2" name="unit">
                                            <option value="" selected disabled>(เลือก)</option>
                                            <?php
                                        while($rows=mysqli_fetch_array($SQLpld))
                                        {
                                        ?>
                                            <option value="<?php echo $rows['id'];?>">
                                                <?php echo $rows['unit'];?>
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
                                    <label class="col-sm-4" for="levcl">ระบุความรีบด่วน โดยดูตามความรีบเร่ง
                                        สัมพันธ์กับผู้ป่วย/เจ้าหน้าที่</label>
                                    <div class="col-sm-6">
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
                                    <label class="col-sm-4" for=""></label>
                                    <input type="hidden" name="DADF" value="DADF">
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