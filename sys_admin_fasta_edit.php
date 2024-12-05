<!doctype html>
<?php
require_once("db/connection.php");
#variable from post
$hid=$_POST['hid'];
?>
<?php
include ("main_script.php")
?>
<div class="bg-blue dker" id="wrap">
    <?php
#SQL
$sql = "SELECT
fasts_id,
fasts_name,
fasts_status
FROM fast_sick_a
WHERE fasts_id='$hid'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );
#show variable
$fastsid=$rsd['fasts_id'];
$fastname=$rsd['fasts_name'];
$faststatus=$rsd['fasts_status'];
?>
    <div id="content3">
        <div class="outer">
            <div class="inner bg-light lter">
                <div class="col-lg-12">
                    <!--ตั้งค่าการเข้าใช้งานระบบโปรแกรม E-Hycenter-->
                    <!-- แก้ไข-->
                    <div class="box">
                        <header>
                            <div class="icons">
                                <i class="fa fa-user">
                                </i>
                            </div>
                            <h5>แก้ไขข้อมูลด่วนวิกฤต :
                                <a class="text text-success">
                                    <?php echo $fastsname;?>
                                </a>
                            </h5>
                        </header>
                        <p>
                        <form class="form-horizontal" action="sys_admin_fasta_add.php" method=POST target="">
                            <input type="hidden" name="fastsid" value="<?php echo $fastsid; ?>">
                            <div class="form-group">
                                <label for="fullplace" class="control-label col-lg-2">รายการ :
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" id="" name="fastname" placeholder="รายการ" class="form-control"
                                        value="<?php echo $fastname; ?>" required>
                                </div>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label class="control-label col-lg-2">ยกเลิกการ :
                                </label>
                                <div class="col-lg-2">
                                    <div class="checkbox">
                                        <label>
                                            <input class="fasts" name="faststatus" type="checkbox" value="1"
                                                <?php IF($faststatus==1){echo 'checked';}?>>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2"></label>
                                <input type="hidden" name="fastid" value="<?php echo $hid ;?>">
                                <input type="hidden" name="EDIT" value="EDIT">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary btn-grad btn-rect">บันทึกรายการ
                                    </button>
                                </div>
                            </div>
                        </form>
                        </p>
                    </div>
                </div>
                <!-- กรอบนอกสุด -->
                <hr>
            </div>
            <!-- /.inner -->
        </div>
        <!-- /.outer -->
    </div>
    <!-- /#content -->
</div>