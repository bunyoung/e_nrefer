<?PHP
include('main_script.php');
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

$SQLblu = mysqli_query($conn,"SELECT id,code,name,status
FROM sys_building WHERE status='0' ORDER BY name") OR die(mysqli_error());

?>
<!-- <div id="content3" style="margin-top:-50px;"> -->
    <!-- <div class="inner bg-light lter"> -->
        <div class="container-fluid">
            <p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default" style="margin-left:-15px;">
                        <div class="panel-heading" style="background:#6600CC;opacity: 0.65;
                         color:	#FFFFFF;font-size: 1.2em;font-weight: bold;">
                            <span class="glyphicon glyphicon-send"></span>
                            มอบหมายงายภาระกิจของศูนย์
                        </div>
                        <div class="panel-body" style="background:#6699FF;opacity: 0.90;
                        color:#6600FF;font-weight: bold;font-size: 1.1em;">
                            <form class="form-horizontal" action="sys_hycurr_db.php" method="POST" target="" name=""
                                id="">
                                <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-5" for="assfplace">หน่วยงานที่ร้องขอ</label>
                                            <div class="col-sm-6">
                                                <select class="form-control select2" style="width:100%;"
                                                    name="assfplace">
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
                                            <label class="col-sm-5" for="assfplace">ตึก/อาคาร/สถานที่</label>
                                            <div class="col-sm-6">
                                                <select class="form-control select2" style="width:100%;" name="build">
                                                    <option value="" selected disabled>(เลือกรายการ)</option>
                                                    <?php
                                        while($row1=mysqli_fetch_array($SQLblu))
                                        {
                                        ?>
                                                    <option value="<?php echo $row1['id'];?>">
                                                        <?php echo '['.$row1['code'].']'.'  '.$row1['name'];?>
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
                                            <label class="col-sm-5" for="assfplace">ชั้น / floor</label>
                                            <div class="col-sm-2">
                                                <input type="number" class="form-control" id="floor" name="floor"
                                                    min="1" max="20">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-5" for="desc">ระบุ
                                                พื้นที่ในหน่วยงานหรือภาระกิจที่ปฎิบัติ(ต้องกรอกเท่านั้น)</label>
                                            <div class="col-sm-6">
                                                <select class="form-control select2" style="width:100%" name="assf"
                                                    id="assf">
                                                    <option value="" selected disabled>(เลือกรายการ)</option>
                                                    <?php
                                            while($row1=mysqli_fetch_array($SQLpla))
                                            {
                                            ?>
                                                    <option value="<?php echo $row1['id'];?>">
                                                        <?php echo '['.$row1['id'].'] '.$row1['clean_place'];?>
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
                                            <label class="col-sm-5" for="assdet">รายละเอียดเพิ่มเติมสำหรับรายการ เช่น จำนวน จนท ที่ต้องการ,จำนวนโต๊ะประชุม ฯลฯ (ในกรณีจัดห้องประชุม ให้แจ้งก่อน 72 ชม.)</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" name="assdet" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-5" for="levcl">ระบุ ระดับความสะอาด ปัจจุบัน</label>
                                            <div class="col-sm-6">
                                                <select class="form-control select2" style="width:100%;" name="lvclean">
                                                    <option value="" selected disabled>(เลือกรายการ)</option>
                                                    <?php
                                        while($row1=mysqli_fetch_array($SQLlv))
                                        {
                                        ?>
                                                    <option value="<?php echo $row1['id'];?>">
                                                        <?php echo '['.$row1['id'].']'.'  '.$row1['clean_level'];?>
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
                                            <label class="col-sm-5" for="levcl">ระบุความรีบด่วน โดยดูตามความรีบเร่ง
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
                                            <label class="col-sm-5" for=""></label>
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
    <!-- </div>
</div> -->

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