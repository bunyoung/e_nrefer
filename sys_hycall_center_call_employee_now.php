<p>
<div class="rows boxed">
    <div class="container-fluid">
        <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class='fa fa-wheelchair fa-1x'></i> ผู้ป่วยที่ รอรับบริการศูนย์เปล ประจำวันที่
                    <?php Echo $d_end .'  เวลา : '.date("H:i:s"); ?>
                </div>
                <p>
                    <?php
#SQL
$sql ="SELECT * FROM v_wperson WHERE name is not Null";
$result_sql = mysqli_query( $conn,$sql);
?>
                <table id="pdataTable" class="cell-border compact stripe" style="width:100%">
                    <thead>
                        <tr>
                        <td><strong>เดือน</strong></td>
                        <td><strong>ปี</strong></td>
                            <td><strong>เวลา</strong></td>
                            <td><strong>ชื่อ-สกุล </strong></td>
                            <td><strong>นอน </strong></td>
                            <td><strong>นอน+อจ.</strong></td>
                            <td><strong>นั่ง</strong></td>
                            <td><strong>นั่ง+อจ</strong></td=>
                            <td><strong>เดิน</strong></td>
                            <td><strong>ปด</strong></td>
                            <td><strong>ปด+อจ</strong></td>
                            <td><strong>CRE+รน+อจ</strong></td>
                            <td><strong>TB</strong></td>
                            <td><strong>VRE</strong></td>
                            <td><strong>รน+อจ+ต</strong></td>
                            <td><strong>รถนั่ง+สก+อจ</strong></td>
                            <td><strong>รถนั่ง+สก</strong></td>
                            <td><strong>รวม</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                        <tr valign='top' valign="center">
                        <td><?php echo $arr['p4_month'] ?></td>
                        <td><?php echo $arr['p4_year'] ?></td>
                            <td>
                                <center><?php echo $arr['wtime']; ?></center>
                            </td>
                            <td><?php echo $arr['name'] ?></td>
                            <td><?php echo $arr['a26'] ?></td>
                            <td><?php echo $arr['a32'] ?></td>
                            <td><?php echo $arr['a33']?></td>
                            <td><?php echo $arr['a34']?></td>
                            <td><?php echo $arr['a35'] ?></td>
                            <td><?php echo $arr['a36'] ?></td>
                            <td><?php echo $arr['a37']?></td>
                            <td><?php echo $arr['a38']?></td>
                            <td><?php echo $arr['a39'] ?></td>
                            <td><?php echo $arr['a40'] ?></td>
                            <td><?php echo $arr['a44']?></td>
                            <td><?php echo $arr['a45']?></td>
                            <td><?php echo $arr['a46']?></td>
                            <td><?php echo $arr['total']?></td>
                        </tr>
                        <?php
                         }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/jquery.min.js"> </script>
<script type="text/javascript" src="assets/js/jquery-ui.min.js"> </script>
<script type="text/javascript" src="assets/lib/moment/min/moment.min.js"> </script>
<!--TABLE  -->
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js">
</script>
<script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js">
</script>
<!--Bootstrap -->
<script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js">
</script>
