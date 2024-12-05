<!doctype html>
<?php
require_once("db/connection.php");
$hid=$_POST['hid'];
?>
<?php
include ("main_script.php")
?>
<div class="bg-blue dker" id="wrap">
    <?php
#SQL
$sql = "SELECT *
FROM sys_asset
WHERE assetid='$hid'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );
#show variable
$hassid=$rsd['assetid'];
$assco=$rsd['asscode'];
$name=$rsd['assname'];
$asscolor=$rsd['asscolor'];
$uni=$rsd['assunit'];
$status=$rsd['status'];
$linkh=$rsd['linkhos'];
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
                                <i class="fa fa-user"></i>
                            </div>
                            <h5>แก้ไขข้อมูลที่เกี่่ยวข้องกับระบบศโลจิสติกส์ :
                                <a class="text text-success">
                                    <?php echo $name;?>
                                </a>
                            </h5>
                        </header>

                        <p>
                        <form class="form-horizontal" action="sys_admin_type_assets_add.php" method=POST target="">
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-2">รหัสประเภท</label>
                                <div class="col-lg-1">
                                    <input type="text" id="code" name="code" placeholder="รายการ" class="form-control"
                                        value="<?php echo $assco;?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="control-label col-lg-2">รายการ</label>
                                <div class="col-lg-4">
                                    <input type="text" id="name" name="name" placeholder="รายการ" class="form-control"
                                        value="<?php echo $name;?>">
                                </div>
                            </div>
                            <?php 
                                        $SQLhyass = mysqli_query($conn,"SELECT id,unit
                                        FROM sys_unit Where status = '0'
                                            ORDER BY unit") OR die(mysqli_error());
                                    ?>

                            <div class="form-group">
                                <label for="name" class="control-label col-lg-2">หน่วยนับ
                                </label>

                                <div class="col-lg-2">
                                    <select class="form-control" name="unit" id="sel_hyass">
                                        <option value="" selected disabled>(เลือกรายการ)</option>
                                        <?php
                                        while($row1=mysqli_fetch_array($SQLhyass))
                                        {
                                        ?>
                                        <option value="<?php echo $row1['id'];?>">
                                            <?php echo '['.$row1['id'].']'.' '.$row1['unit'];?>
                                        </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="control-label col-lg-2">รหัสสี</label>
                                <div class="col-lg-2">
                                    <select name="lcolo" class="form-control">
                                        <option value="R" <?php if($asscolor=="R") echo 'selected="selected"'; ?>>สีแดง
                                        </option>
                                        <option value="G" <?php if($asscolor=="G") echo 'selected="selected"'; ?>>
                                            สีเขียว</option>
                                        <option value="X" <?php if($asscolor=="X") echo 'selected="selected"'; ?>>ไม่มี
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">เชื่อมระบบ รพ</label>
                                <div class="col-lg-1">
                                    <div class="checkbox">
                                    <label>
                                            <input class="uniform" name="status" type="checkbox" value="1" <?php 
                                                    IF($linkh=='1'){
                                                      echo 'checked';
                                                    }
                                                ?>>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-lg-2">ยกเลิกการใช้งาน
                                </label>
                                <div class="col-lg-1">
                                    <div class="checkbox">
                                        <label>
                                            <input class="uniform" name="status" type="checkbox" value="1" <?php 
                                                    IF($status=='1'){
                                                      echo 'checked';
                                                    }
                                                ?>>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2"></label>
                                <input type="hidden" name="hid" value="<?php echo $hassid ;?>">
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