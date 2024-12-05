<!doctype html>
<?php
require_once("db/connection.php");

#variable from post
$hn=$_POST['hn_id'];
?>
<?php
include ("main_script.php")
?>
<div class="bg-blue dker" id="wrap">

<?php
#SQL
$sql = "SELECT
    hn,
    patients,
    hassname,
    fullplace,
    hyquicka,
    hyquickb
FROM v_monitor
WHERE hn='$hn'; ";
$result_sql = mysqli_query($conn,$sql);
$rsd=mysqli_fetch_array ($result_sql, MYSQL_ASSOC );

#แสดงรายการข้อมูล
$hn=$rsd['hn'];
$name=$rsd['patients'];
$hassname=$rsd['hassname'];
$place=$rsd['fullplace'];
$qa=$rsd['hyquicka'];
$qb=$rsd['hyquickb'];
if($qa=='1'){
$mqa='ย้าย ผป.วิกฤติไป ICU';
}
if($qa=='2'){
$mqa='เข้า OR Emergency';
}
if($qa=='3'){
$mqa='ESI-L1 (หยุดหายใจ/หัวใจหยุดเต้น/ชัก/Shock)';
}
if($qa=='4'){
$mqa='STEMI เข้ารับทำ PCI';
}
?>

<?php
$idper= "";
$query=mysqli_query($conn,"SELECT idcard,name,perstatus FROM employee
 WHERE delete_flag <> '1' AND perstatus = 'W'
 ORDER BY name") OR die(mysqli_error());
while($row=mysqli_fetch_array($query))
{
    $idper .='<option value=" '.$row['idcard'].'">'.$row['name'].'</option>';
}
?>

<!-- ทำการบันทึกรายการข้อมูล -->
<?php
?>
    <div id="content3">
        <div class="outer">
            <div class="inner bg-light lter">
                <div class="col-lg-12">
                  <!--มอบหมายงานให้ จนท ศูนย์เปล E-Monitor-->
                    <div class="box">
                        <header>
                            <div class="icons">
                                <i class="fa fa-user"></i>
                            </div>
                            <h5>เปิดงาน สำหรับผู้ป่วย HN :
                                <a class="text text-success">
                                    <?php echo $hn;?>
                                </a> ชื่อ : <?php echo $name;?>
                            </h5>
                        </header>
                        <p>
                        <form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-2">จนท.ศูนย์เปล :</label>
                                <div class="col-lg-6">
                                   <select class="form-control input-sm select2" name="idcard" requied>
                                     <?php echo $idper;?>
                                   </select>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="form-group">
                                <label class="control-label col-lg-2">
                                </label>

                                <input type="hidden" name="hn" value="<?php echo $hn;?>">
                                <input type="hidden" name="EDIT" value="EDIT">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary btn-grad btn-rect">มอบหมายงาน
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
<script src="assets/plugins/select2/select2.full.min.js"></script>
  <script>
   $(function() {
                    $(".select2").select2();
                });
                </script>

</html>