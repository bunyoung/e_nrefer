<?php
require_once('db/date_format.php');
// require_once('db/connect_pmk.php');
require_once("db/connection.php");
require_once('function/conv_date.php');
?>

<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<div class="rows boxed">
<p>
<div class="container-fluid">
        <div class="panel panel-info">
            <div class="panel-heading">
                <strong>แสดงรายการ ขอรับบริการเคลื่อนย้ายสิ่งของ</strong> <?php echo $d_default; ?>
            </div>
            <p>
                <?php
#SQL
$sql ="SELECT
    *
 FROM v_monitor
     WHERE  hdate = '$d_default'; ";
$result_sql = mysqli_query( $conn,$sql);
?>
            <p>
            <table id="vdataTable"  class="cell-border compact stripe" style="width:100%">
                <thead>
                    <tr>
                        <td><strong>เลขที่อ้างอิง</strong></td>
                        <td><strong>ประเภทรายการ</strong></td>
                        <td><strong>ชื่อ-สกุล</strong></td>
                        <td><strong>รับจาก </strong></td>
                        <td><strong>ไปส่งที่</strong></td>
                        <td><strong>ปภ ผป.</strong></td>
                        <td><strong>อุปกรณ์</strong></td>
                        <td><strong>อุปกรณ์เพิ่ม</strong></td=>
                        <td><strong>ผป.</strong></td>
                        <td><strong>เริ่ม</strong></td>
                        <td><strong>รับ</strong></td>
                        <td align='center'><strong>สถานะ</strong></td>
                        <td align='center'><strong>ยกเลิก</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                    <tr valign='top'>
                      <td><?php  echo $arr['hyitem']; ?> </td>
                       <td><?php  echo $arr['hn']; ?> </td>
                        <td><?php echo $arr['patients'] ?></td>
                        <td><?php echo $arr['fplace'] ?></td>
                        <td><?php echo $arr['tplace'] ?></td>
                        <td><?php echo $arr['assname'] ?></td>
                        <td><?php echo $arr['hassnamea']?></td>
                        <td><?php echo $arr['hassnameb']?></td>
                        <td><?php echo $arr['sicka'].','.$arr['sickb'] ?></td>
                        <!-- <td><?php echo substr($arr['htime'],11,8); ?></td> -->
                        <td><?php echo $arr['htime']; ?></td>
                        <td><?php echo $arr['x1_pertime']; ?></td>
                        <td align="center">
                            <?php
                                                  IF($arr['x1']=="C"){
                                                    echo'<a class="btn btn-danger btn-grad">';
                                                  } ELSE
                                                  if($arr['x1']=='F'){
                                                    echo'<a class="btn btn-success btn-grad">';
                                                  }else
                                                  if($arr['x1']=='W'){
                                                    echo'<a class="btn btn-info btn-grad">';

                                                  }IF($arr['x1']=="C"){
                                                    echo '<i class="fa fa-thumbs-o-up"></i>: กำลังดำเนินการ';
                                                  } ELSE
                                                     IF($arr['x1']=="F"){
                                                        echo '<i class="fa fa-thumbs-o-up"></i>: ดำเนินการสิ้นสุด';}
                                                   else {
                                                    echo '<i class="fa fa-times"></i>  : รอดำเนินการ';}
                                                    echo'</a>';
                                                ?>
                        </td>
                        <td align="center">
                            <!-- รายการที่จะทำการยกเลิก -->
                            <?php
                                IF($arr['x1']=='W') {
                                    echo'<a href="#myModal_receive_cancel" data-toggle="modal"
                                    data-id="'.$arr['hyitem'].'" class="btn btn-danger btn-grad">';
                                }else{
                                    echo '<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                                    echo'</a>';
                                }
                                IF($arr['x1']=='W') {
                                    echo '<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                                    echo'</a>';
                                }
                                ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
   </div>
</div>