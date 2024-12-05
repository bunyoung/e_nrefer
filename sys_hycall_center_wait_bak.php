<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-hycenter</title>
</head>
<?php
$hitem=$_POST['hyitem'];
?>
<?php
require_once("db/connection.php");
?>
<?php
require_once("main_script.php");
?>

<?php
$sql="SELECT 
        h.hn,
        h.patients,
        h1.hassname,
        p.fullplace,
        h.old,
        h.idcard,
        h.hyitem
    FROM hycent h
        LEFT JOIN hass h1 ON h1.hassid = h.hassa
        LEFT JOIN places p ON p.placecode=h.fromplace
    WHERE hyitem='$hitem' ";
        $result_sql=mysqli_query($conn,$sql);
        $rsd=mysqli_fetch_array($result_sql, MYSQL_ASSOC);
        $hn=$rsd['hn'];
        $name=$rsd['patients'];
        $hassname=$rsd['hassname'];
        $place=$rsd['fullplace'];
        $pold=$rsd['old'];
        $pid=$rsd['idcard'];
        ?>

<!-- คนที่ 1 -->
<?php
$idper= "";
$query=mysqli_query($conn,"SELECT idcard,name,perstatus FROM employee
                           ORDER BY name");
while($row=mysqli_fetch_array($query))
{
    $idper .='<option value=" '.$row['idcard'].' ">'.$row['name'].'</option>';
}
?>

<!-- คนที่ 2  -->
<?php
$idper02= "";
$query=mysqli_query($conn,"SELECT idcard,name,perstatus FROM employee
                           ORDER BY name");
while($row=mysqli_fetch_array($query))
{
    $idper02 .='<option value=" '.$row['idcard'].' ">'.$row['name'].'</option>';
}
?>

<!-- ผู้จ่ายงาน -->
<?php
$idper03= "";
$qy=mysqli_query($conn,"SELECT idcard,name,perstatus FROM employee
                           ORDER BY name");
while($rw=mysqli_fetch_array($qy))
{
    $idper03 .='<option value=" '.$rw['idcard'].' ">'.$rw['name'].'</option>';
}
?>

<body>
    <h4> เลขที่อ้างอิง : <?php echo $hitem; ?></h4>
    <h5> HN : <a class="text text-success"><?php echo $hn;?></a> ชื่อ :<?php echo $name;?></h5>
    <br>
    <form class="form-horizontal" action="sys_hycall_center_view.php" method=POST target="">
        <!-- คนที่ 1 -->
        <div class="form-group">
            <label for="name" class="control-label col-lg-2">ผู้ได้รับมอบคนที่ 1 :</label>
            <div class="col-lg-6">
                <select class="form-control input-sm select2" name="idcard" requied>
                    <?php echo $idper;?>
                </select>
            </div>
        </div>

        <!--คนที่ 2  -->
        <div class="form-group">
            <label for="name" class="control-label col-lg-2">ผู้ได้รับมอบคนที่ 2 :</label>
            <div class="col-lg-6">
                <select class="form-control input-sm select2" name="idcard1" requied>
                    <?php echo $idper02;?>
                </select>
            </div>
        </div>

        <!--ผู้จ่ายงาน  -->
        <div class="form-group">
            <label for="name" class="control-label col-lg-2">ผู้จ่ายงาน :</label>
            <div class="col-lg-6">
                <select class="form-control input-sm select2" name="idcard2" requied>
                    <?php echo $idper03;?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-2"></label>
            <input type="hidden" name="hitem" value="<?php echo $hitem;?>">
            <input type="hidden" name="hold" value="<?php echo $pold;?>">
            <input type="hidden" name="hid" value="<?php echo $pid;?>">
            <input type="hidden" name="EDIT" value="EDIT">
            <div class="col-lg-2">
                <button type="submit" class="btn btn-success btn-grad">
                    จ่ายงาน
                </button>
            </div>
        </div>
    </form>
    </p>
</body>

</html>

<script src="assets/plugins/select2/select2.full.min.js"></script>

<script>
$(function() {
    $(".select2").select2();
});
</script>