<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php

// ข้อมูลแผนก จากระบบเอง
$SQLplh = mysqli_query($conn,"SELECT placecode,fullplace
            FROM places ORDER BY fullplace") OR die(mysqli_error());
            
$SQLplb = mysqli_query($conn,"SELECT placecode,fullplace
FROM places ORDER BY fullplace") OR die(mysqli_error());

$SQLplc = mysqli_query($conn,"SELECT placecode,fullplace
            FROM places ORDER BY fullplace") OR die(mysqli_error());

$SQLpld = mysqli_query($conn,"SELECT id,unit
FROM sys_unit WHERE status ='0'ORDER BY unit") OR die(mysqli_error());

$SQLass = mysqli_query($conn,"SELECT assetid,assname
FROM sys_asset  Where asstype='0' and linkhos='1'
ORDER BY assname") OR die(mysqli_error());

$SQLplr = mysqli_query($conn,"SELECT id,clean_argent,status,sindex
FROM sys_clean_argent WHERE status='0' ORDER BY sindex ") OR die(mysqli_error());

?>
<div class="container-fluid">
    <p>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" style="margin-left:-15px;">
                <div class="panel-heading" style="background:#CC6600;opacity: 1;
                         color:#FFFFFF;font-size: 1.2em;font-weight: bold;">
                    <span class="glyphicon glyphicon-send"></span>
                    ขอใช้บริการขนส่งผลิตภัณฑ์เลือดจากธนาคารเลือด
                </div>
                <div class="panel-body" style="background:#FF9966;opacity: 0.90;
                        color:#FFFFFF;font-weight: bold;font-size: 1.1em;">
                    <form action="sys_hycurr_db.php" method="POST" target="" name="formq" id="formq">
                        <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="desc">หน่วยร้องขอ</label>
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
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="opd" class="label-control">
                                    หน่วยงาน OPD หรือ IPD ที่ผู้ป่วยรักษาปัจจุบัน (ข้อมูลจาก PMK)</label>
                                <select class="form-control select2" name="asspplace" id="place">
                                    <option value="" selected disabled>(เลือกรายการ)</option>
                                    <?php 
                                    $strSQL2 = "SELECT * FROM places WHERE pt_place_type_code IN ('1','2') 
                                    AND DEL_FLAG IS NULL
                                    ORDER BY PLACECODE ASC"; 
                                    $objParse2 = oci_parse($objConnect, $strSQL2);  
                                    oci_execute ($objParse2,OCI_DEFAULT);   
                                    while($objResult2 = oci_fetch_array($objParse2,OCI_BOTH)) 
                                    { 
                                    ?>
                                    <option value="<?=$objResult2["PLACECODE"];?>">
                                        <?=$objResult2["PLACECODE"]." - ".$objResult2["HALFPLACE"];?>
                                    </option>
                                    <?php
                                                    }                                                                  
                                                ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="hn">HN และ ชื่อ-สกุล ผู้ป่วย</label>
                                <select class="form-control select2" name="hn" id="state">
                                    <option value="">ชื่อ-สกุล</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="desc">หน่วยงานต้นทางที่ให้ HYs-MEST ไป "รับ."</label>
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

                            <div class="form-group col-sm-12">
                                <label for="desc">หน่วยงานปลายทางที่ให้ HYs-MEST ไป "ส่ง."</label>
                                <select class="form-control select2" style="width:100%;" name="asstplace">
                                    <option value="" selected disabled>(เลือกรายการ)</option>
                                    <?php
                                        while($row1=mysqli_fetch_array($SQLplb))
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

                            <!-- <div class="col-sm-1"></div> -->
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-1">
                                    <label for="pcr">PRC</label>
                                    <input type="text" class="form-control" name="pcr" value="">
                                </div>
                                <div class="col-sm-1">
                                    <label for="pcr">#</label>
                                    <select class="form-control" name="idpcr" id="">
                                        <option value="UNIT">Unit</option>
                                        <option value="ML">ml</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-1">
                                    <label for="lpcr">LPRC</label>
                                    <input type="text" class="form-control" name="lprc" value="">
                                </div>
                                <div class="col-sm-1">
                                    <label for="pcr">#</label>
                                    <select class="form-control" name="idlprc" id="">
                                        <option value="UNIT">Unit</option>
                                        <option value="ML">ml</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-1">
                                    <label for="ffp">FFP</label>
                                    <input type="text" class="form-control" name="ffp" value="">
                                </div>
                                <div class="col-sm-1">
                                    <label for="pcr">#</label>
                                    <select class="form-control" name="idffp" id="">
                                        <option value="UNIT">Unit</option>
                                        <option value="ML">ml</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-1">
                                    <label for="crp">CCP</label>
                                    <input type="text" class="form-control" name="crp" value="">
                                </div>
                                <div class="col-sm-1">
                                    <label for="pcr">#</label>
                                    <select class="form-control" name="idcrp" id="">
                                        <option value="UNIT">Unit</option>
                                        <option value="ML">ml</option>
                                    </select>
                                </div>

                                <!-- <div class="form-group col-sm-1">
                                    <label for="plasma">PLASMA</label>
                                    <input type="text" class="form-control" name="plasma" value="">
                                </div> -->
                                <div class="form-group col-sm-1">
                                    <label for="plasma">PC,SDP,LPPC</label>
                                    <input type="text" class="form-control" name="plasma" value="">
                                </div>

                                <div class="col-sm-1">
                                    <label for="pcr">#</label>
                                    <select class="form-control" name="idplasma" id="">
                                        <option value="UNIT">Unit</option>
                                        <option value="ML">ml</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-1">
                                    <label for="cryo">Cryo</label>
                                    <input type="text" class="form-control" name="crto" value="">
                                </div>
                                <div class="col-sm-1">
                                    <label for="pcr">#</label>
                                    <select class="form-control" name="idcryo" id="">
                                        <option value="UNIT">Unit</option>
                                        <option value="ML">ml</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-sm-1"></div>
                            <div class="row col-sm-12">
                                <div class="form-group col-sm-1">
                                    <label for="LDRC">LD-PRC</label>
                                    <input type="text" class="form-control" name="ldrc" value="">
                                </div>
                                <div class="col-sm-1">
                                    <label for="pcr">#</label>
                                    <select class="form-control" name="idldrc" id="">
                                        <option value="UNIT">Unit</option>
                                        <option value="ML">ml</option>
                                    </select>
                                </div>
                                <!-- <div class="col-sm-1">
                                    <label for="pcb">PC</label>
                                    <input type="text" class="form-control" name="pcb" value="">
                                </div>
                                <div class="col-sm-1">
                                    <label for="pcr">#</label>
                                    <select class="form-control" name="idpcb" id="">
                                        <option value="u">Unit</option>
                                        <option value="l">ml</option>
                                    </select>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="oth">ร้องขอเพิ่มเติมจากหน่วยร้องขอ/แจ้งธนาคารเลือด</label>
                                <input type="text" class="form-control" name="oth" value="">
                            </div>
                        </div>
                        <!-- 
                        เพิ่มเติม
                        -->
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="levcl">ระบุความรีบด่วน โดยดูตามความรีบเร่ง
                                    สัมพันธ์กับผู้ป่วย/เจ้าหน้าที่</label>
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
                        <!-- สินสุดการเพิ่มเติม -->

                        <div class="form-group">
                            <label for="add" class="col-sm-12"></label>
                            <input type="hidden" name="DADD" value="DADD">
                            <button type="submit" class="btn btn-success btn-grad">
                                <span class="glyphicon glyphicon-ok-circle"></span>
                                ลงบันทึกขอใช้บริการ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </form>
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