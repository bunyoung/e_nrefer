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
$sql = " SELECT
hyass,
assname,
asstatus,
assreturn,
delete_date,
create_user_id
FROM hyass
WHERE hyass='$hid'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );
#show variable
$hyass=$rsd['hyass'];
$name=$rsd['assname'];
$assreturn=$rsd['assreturn'];
$status=$rsd['asstatus'];
$delete_date=$rsd['delete_date'];
$add_user_priv=$rsd['create_user_id'];
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
                            <h5>แก้ไขข้อมูลที่เกี่่ยวข้องกับระบบศูนย์เปล :
                                <a class="text text-success">
                                    <?php echo $name;?>
                                </a>
                            </h5>
                        </header>
                        <p>
                        <form class="form-horizontal" action="sys_admin_type_patients_add.php" method=POST target="">
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-2">ประเภทรายการขอใช้บริการ
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" id="name" name="name" placeholder="ประเภทรายการขอใช้บริการ"
                                        class="form-control" value="<?php echo $name;?>">
                                </div>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label class="control-label col-lg-2">ใช้ส่งกลับ
                                </label>
                                <div class="col-lg-2">
                                    <div class="checkbox">
                                        <label>
                                            <input class="uniform" name="assreturn" type="checkbox" value="1"
                                                <?php IF($assreturn=='1'){echo 'checked';}?>>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">ยกเลิกการใช้งาน
                                </label>
                                <div class="col-lg-2">
                                    <div class="checkbox">
                                        <label>
                                            <input class="uniform" name="status" type="checkbox" value="1"
                                                <?php IF($status==1){echo 'checked';}?>>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2"></label>
                                <input type="hidden" name="hid" value="<?php echo $hyass ;?>">
                                <input type="hidden" name="EDIT" value="EDIT">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary btn-grad btn-rect">บันทึกรายการ
                                    </button>
                                </div>
                            </div>
                            <!-- /.row -->
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