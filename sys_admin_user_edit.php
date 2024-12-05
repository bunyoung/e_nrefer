<!doctype html>
<?php
require_once("db/connection.php");
#variable from post
$id_card=$_POST['idcard'];
?>
<?php
include ("main_script.php")
?>
<div class="bg-blue dker" id="wrap">
<?php
$sql = " SELECT
idcard,
name,
linenotify,
id,
username,
hisgroup_priv,
passw,
position,
user_level,
delete_flag,
delete_date,
create_user_id
FROM employee
WHERE idcard='$id_card' ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );
$idcard=$rsd['idcard'];
$name=$rsd['name'];
$username=$rsd['username'];
$nid=$rsd['id'];
$lineno=$rsd['linenotify'];
$password=$rsd['passw'];
$position=$rsd['position'];
$delete_flag=$rsd['delete_flag'];
$delete_date=$rsd['delete_date'];
$user_level=$rsd['user_level'];
$hisgroup_prav=$rsd['hisgroup_priv'];
$add_user_priv=$rsd['ADD_USER_PRIV'];
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
              <h5>แก้ไขข้อมูลผู้ใช้งาน :
                <a class="text text-success">
                  <?php echo $name;?>
                </a> ตำแหน่ง : <?php echo $position;?>
              </h5>
            </header>
            <p>
                                    <form class="form-horizontal" action="sys_admin_user_add.php" method=POST target="">
                                        <div class="form-group">
                                            <label for="name" class="control-label col-lg-2">ชื่อ-สกุล
                                            </label>
                                            <div class="col-lg-4">
                                                <input type="text" id="name" name="name" placeholder="ชื่อ-สกุล"
                                                    class="form-control" value="<?php echo $name;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <label for="cid" class="control-label col-lg-2">เลข บปช
                                        </label>
                                        <div class="col-lg-3">
                                            <input type="text" id="nid" name="nid" placeholder="เลขบัตรประชาชน"
                                                class="form-control" value="<?php echo $nid;?>">
                                        </div>
                                    </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="username" class="control-label col-lg-2">Username
                                            </label>
                                            <div class="col-lg-3">
                                                <input type="text" id="username" name="username" placeholder="username"
                                                    class="form-control" value="<?php echo $username;?>">
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="password" class="control-label col-lg-2">Password
                                            </label>
                                            <div class="col-lg-3">
                                                <input type="password" id="password" name="password"
                                                    placeholder="password" class="form-control" value="<?php echo $password;?>">
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="cid" class="control-label col-lg-2">เลขวิทยุ
                                            </label>
                                            <div class="col-lg-1">
                                                <input type="text" id="cid" name="cid" placeholder="เลขบัตรประชาชน"
                                                    class="form-control" value="<?php echo $idcard; ?>" required>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label for="comment" class="control-label col-lg-2">ตำแหน่ง
                                            </label>
                                            <div class="col-lg-4">
                                                <input type="text" id="position" name="position" placeholder="ตำแหน่ง"
                                                    class="form-control" value="<?php echo $position; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <label for="comment" class="control-label col-lg-2">Line Notify
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" id="lineno" name="lineno" placeholder="Line Notify"
                                                class="form-control"  value="<?php echo $lineno; ?>">
                                        </div>
                                    </div>
                                        <!-- /.row -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">สิทธิการใช้งาน
                                            </label>
                                            <div class="col-lg-4">
            <select class="multipleSelect" multiple name="hisgroup_prav[]">
                    <option
                            <?php IF(strpos( $hisgroup_prav, "[admin]")== TRUE){echo ' selected '; }?> value="[admin]">Web Admin[admin]
                    </option>
                  <option
                          <?php IF(strpos( $hisgroup_prav, "[setting]")== TRUE){echo ' selected '; }?> value="[setting]">ตั้งค่าระบบ[setting]
                  </option>
                <option
                        <?php IF(strpos( $hisgroup_prav, "[hycenter]")== TRUE){echo ' selected '; }?> value="[hycenter]">ขอเปล[hycenter]
                </option>
              <option
                      <?php IF(strpos( $hisgroup_prav, "[monitor]")== TRUE){echo ' selected '; }?> value="[monitor]">monitor [monitor]
              </option>                                                </select>
                                            </div>
                                            <script>
                                            $('.multipleSelect').fastselect();
                                            </script>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Admin
                                            </label>
                                            <div class="col-lg-2">
                                                <div class="checkbox">
                                                    <label>
                                                        <input class="uniform" name="user_level" type="checkbox"
                                                            value="1" <?php IF($user_level==1){echo 'checked';}?>>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.row -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">ยกเลิกการใช้งาน
                                            </label>
                                            <div class="col-lg-2">
                                                <div class="checkbox">
                                                    <label>
                                                        <input class="uniform" name="delete_flag" type="checkbox"
                                                            value="1"
                                                            <?php IF($delete_flag==1){echo 'checked';}?>>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->
<div class="form-group">
  <label class="control-label col-lg-2">
  </label>
  <input type="hidden" name="idcard" value="<?php echo $idcard;?>" >
  <input type="hidden" name="add_user_priv" value="1" >
  <input type="hidden" name="EDIT" value="EDIT" >
  <div class="col-lg-2">
    <button type="submit" class="btn btn-primary btn-grad btn-rect" >บันทึกรายการ
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