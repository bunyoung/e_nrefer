<?php
include('./db/connection.php');
$rh=$_REQUEST['rid_p'];
$sql="select * from rf_users WHERE hcode='$rh' ";
$rss=mysqli_query($conn,$sql);
while($rs=mysqli_fetch_array($rss)){
    $hos=$rs['hospital'];
?>
<div class="form-group">
    <form action="../edit_faculty.php" method="POST">
        <div class="Id">
            <input value="<?php echo $hos;?>" type="hidden" class="form-control" name="hos">
            <label class="col-md-2 label-control" for="Email Address :"></label>
            <input class="form-control" type="text" name="email" value="<?php echo $rs['email'];?>">
        </div>
    </form>
</div>
<?php
}
?>