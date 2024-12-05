<!doctype html>
<?php
require_once("db/connection.php");
#variable from post
$nid=$_POST['id'];
?>

<?php
include ("main_script.php")
?>
<div class="bg-blue dker" id="wrap">
<?php
#SQL
$sql="SELECT * FROM sys_unit WHERE id='$nid';";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

#show variable
$้nid=$rsd['id'];
$name=$rsd['unit'];
$status=$rsd['status'];
?>
    <div id="content3">
        <div class="outer">
            <div class="inner bg-light lter">
                <div class="col-lg-12">

                    <!-- แก้ไข-->
                    <div class="box">
                        <header>
                            <div class="icons">
                                <i class="fa fa-user"></i>
                            </div>
                            <h5>แก้ไขข้อมูลที่เกี่่ยวข้องกับระบบ Logistic :
                                <a class="text text-success">
                                    <?php echo $name;?>
                                </a>
                            </h5>
                        </header>

                        <p>
                        <form class="form-horizontal" action="sys_admin_type_unit_add.php" method=POST target="">
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-2">หน่วยนับ
                                </label>
                                <div class="col-lg-2">
                                    <input type="text" id="name" name="unt" placeholder="หน่วยนับ"
                                        class="form-control" value="<?php echo $name;?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2">ยกเลิกการใช้งาน
                                </label>
                                <div class="col-lg-1">
                                    <div class="checkbox">
                                        <label>
                                            <input class="uniform" name="status" type="checkbox" value="1"
                                                <?php 
                                                    IF($status=='1'){
                                                      echo 'checked';
                                                    }
                                                ?>
                                                >
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2"></label>
                                <input type="hidden" name="nid" value="<?php echo $้nid;?>">
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