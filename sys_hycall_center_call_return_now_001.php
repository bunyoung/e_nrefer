<?php
require_once("db/connection.php");
?>
<!-- วันที่ปัจจุบัน -->
<div class="rows">
    <p>
    <div class="container-fluid">
        <!-- <div class="panel-group"> -->
            <div class="panel panel-info">
                <div class="panel-heading">
                    <strong>แสดงรายการ ขอรับบริการศูนย์เปล</strong> <?php echo $d_default; ?>
                </div>
                <p>
                    <?php
#SQL
$sql ="SELECT
        *
        FROM v_monitor
            WHERE  hdate = '$d_default' and x1 ='F'; ";
$result_sql = mysqli_query( $conn,$sql);
?>
                <table id="rdataTable" class="cell-border compact stripe" style="width:100%">
                    <thead>
                        <tr>
                            <td><strong>HN</strong></td>
                            <td><strong>ชื่อ-สกุล </strong></td>
                            <td><strong>รับจาก </strong></td>
                            <td><strong>ปภ ผป.</strong></td>
                            <td><strong>อุปกรณ์</strong></td>
                            <td><strong>อุปกรณ์เพิ่ม</strong></td=>
                            <td><strong>ผป.</strong></td>
                            <td><strong>เปล</strong></td>
                            <td><strong>เริ่ม</strong></td>
                            <td><strong>รับ</strong></td>
                            <td><strong>ปิด</strong></td>
                            <td align='center'><strong>ยืนยัน</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                        <tr valign='top'>
                            <td><?php  echo $arr['hn']; ?> </td>
                            <td><?php echo $arr['patients'] ?></td>
                            <td><?php echo $arr['tplace'] ?></td>
                            <td><?php echo $arr['assname'] ?></td>
                            <td><?php echo $arr['hassnamea']?></td>
                            <td><?php echo $arr['hassnameb']?></td>
                            <td><?php echo $arr['sicka'].','.$arr['sickb'] ?></td>
                            <td>
                                <?php
                               IF($arr['pers']==""){
                                 echo '<i class="fa fa-bell-slash" style="color:red"></i> ';}
                               ELSE {
                                 echo ''.$arr['name'];} ;
                               ?>
                            </td>
                            <!-- <td><?php echo substr($arr['htime'],11,8); ?></td> -->
                            <td><?php echo $arr['htime']; ?></td>
                            <td><?php echo $arr['x1_pertime']; ?></td>
                            <td><?php echo $arr['perfinish']; ?></td>
                            <td align="center">
                                <?php
                                    echo'<a href="#myModal_receive_wait" data-toggle="modal" data-id="'.$arr['hyitem'].'" 
                                                 class="btn btn-info btn-grad">';
                                    echo '<i class="fa fa-thumbs-o-up"></i>: ส่งกลับ';
                                ?>
                            </td>
                        </tr>
                        <?php
                         }
                        ?>
                    </tbody>
                </table>
            </div>
        <!-- </div> -->
    </div>
</div>