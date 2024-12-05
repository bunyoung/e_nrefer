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
place_id,
placecode,
fullplace,
opdipd,
delete_flag,
delete_date,
create_user_id
FROM places
WHERE place_id='$hid'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );
#show variable
$place_id=$rsd['place_id'];
$placecode=$rsd['placecode'];
$fullplace=$rsd['fullplace'];
$opdipd=$rsd['opdipd'];
$delete_flag=$rsd['delete_flag'];
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
                                    <?php echo $fullplace;?>
                                </a>
                            </h5>
                        </header>
                        <p>
                        <form class="form-horizontal" action="sys_admin_type_place_add.php" method=POST target="">
                            <div class="form-group">
                                <label for="placecode" class="control-label col-lg-2">รหัสสถานที
                                </label>
                                <div class="col-lg-2">
                                    <input type="text" id="placecode" name="placecode" placeholder="รหัสสถานที"
                                        class="form-control" value="<?php echo $placecode; ?>" required>
                                </div>
                            </div>
                            <input type="hidden" name='hid' value="<?php echo $hid; ?>">
                            <div class="form-group">
                                <label for="fullplace" class="control-label col-lg-2">ชื่อสถานที
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" id="fullplace" name="fullplace" placeholder="ชื่อสถานที"
                                        class="form-control" value="<?php echo $fullplace; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="opdipd" class="control-label col-lg-2">OPD/IPD
                                </label>
                                <div class="col-lg-4">
                                    <option value=""><?php echo $opdipd; ?></option>
                                    <select name = "opdipd" >
                                        <option value="OPD">Opd </option>
                                        <option value="IPD">Ipd </option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label class="control-label col-lg-2">ยกเลิกการใช้งาน
                                </label>
                                <div class="col-lg-2">
                                    <div class="checkbox">
                                        <label>
                                            <input class="delete_flag" name="delete_flag" type="checkbox" value="1"
                                                <?php IF($delete_flag==1){echo 'checked';}?>>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2"></label>
                                <input type="hidden" name="hid" value="<?php echo $hid ;?>">
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