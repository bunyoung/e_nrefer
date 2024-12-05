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
    *
    FROM v_places
    WHERE place_id='$hid'; ";
    $result_sql = mysqli_query($conn,$sql);
    $rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );
    #show variable
    $place_id=$rsd['place_id'];
    $placecode=$rsd['placecode'];
    $fullplace=$rsd['fullplace'];
    $opdipd=$rsd['opdipd'];
    $fl=$rsd['floor'];
    $build=$rsd['build'];
    $class=$rsd['class'];
    $delete_flag=$rsd['delete_flag'];
    $delete_date=$rsd['delete_date'];
    $add_user_priv=$rsd['create_user_id'];
    ?>
    <div id="content3">
        <div class="outer">
            <div class="inner bg-light lter">
                <div class="col-lg-12">
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
                        <?php
                            $SQLass = mysqli_query($conn,"SELECT id,code,name
                            FROM sys_building ORDER BY name") OR die(mysqli_error());
                        ?>

                        <form class="form-horizontal" action="sys_admin_logis_place_add.php" method=POST target="">
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
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="fullplace" class="control-label col-lg-2">OPD/IPD
                                </label>
                                <div class="col-lg-4">
                                    <select name="opdipd">
                                        <option value="OPD" <?php if($opdipd=="OPD") echo 'selected="selected"'; ?>>OPD
                                        </option>
                                        <option value="IPD" <?php if($opdipd=="IPD") echo 'selected="selected"'; ?>>IPD
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="fullplace" class="control-label col-lg-2">สาย
                                </label>
                                <div class="col-lg-4">
                                    <select name="floor">
                                        <option value="F1" <?php if($fl=="F1") echo 'selected="selected"'; ?>>สายที่ 1
                                        </option>
                                        <option value="F2" <?php if($fl=="F2") echo 'selected="selected"'; ?>>สายที่ 2
                                        </option>
                                        <option value="F3" <?php if($fl=="F3") echo 'selected="selected"'; ?>>สายที่ 3
                                        </option>
                                        <option value="F4" <?php if($fl=="F4") echo 'selected="selected"'; ?>>สายที่ 4
                                        </option>
                                        <option value="F5" <?php if($fl=="F5") echo 'selected="selected"'; ?>>สายที่ 5
                                        </option>
                                        <option value="F6" <?php if($fl=="F5") echo 'selected="selected"'; ?>>สายที่ 6
                                        </option>
                                        <option value="F7" <?php if($fl=="F7") echo 'selected="selected"'; ?>>สายที่ 7
                                        </option>
                                        <option value="F8" <?php if($fl=="F8") echo 'selected="selected"'; ?>>สายที่ 8
                                        </option>
                                        <option value="F9" <?php if($fl=="F9") echo 'selected="selected"'; ?>>สายที่ 9
                                        </option>
                                        <option value="F10" <?php if($fl=="F10") echo 'selected="selected"'; ?>>สายที่
                                            10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fullplace" class="control-label col-lg-2">ตึก/สถานที่/อาคาร
                                </label>
                                <div class="col-lg-4">
                                    <select class="form-control select2" style="width:100%;" name="asstplace">
                                        <option value="<?php echo '['.$build.']';?>" 
                                                selected disabled>(เลือกรายการ)</option>
                                        <?php
                                                while($row1=mysqli_fetch_array($SQLass))
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
                            <div class="form-group">
                                <label for="fullplace" class="control-label col-lg-2">ชั้น/ห้อง
                                </label>
                                <div class="col-lg-2">
                                    <input type="number" class="form-control" min="1" step="1" name="ecl" 
                                        value="<?php echo $class;?>">
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
                <hr>
            </div>
        </div>
    </div>
</div>