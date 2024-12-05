<?php
require_once('db/date_format.php');
require_once('db/connect_pmk.php');
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
<!-- ดึงวันที่ปัจจุบัน -->

<?php
            include ('main_script.php');
        ?>
<!--เริ่มเนื้อหาตรงนี้  -->
<div class="col-lg-12">
    <p>
    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading">
                <strong>แสดงรายการ ขอรับบริการศูนย์เปล</strong> <?php Echo $d_end; ?>
            </div>
            <p>
                <?php
#SQL
$sql ="SELECT
*
 from v_monitor where hdate = '$d_default'; ";
$result_sql = mysqli_query( $conn,$sql);
?>
            <p>
            <table id="dataTable" class="table-bordered table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <td align="center"><strong>HN</strong></td>
                        <td align='center'><strong>ชื่อ-สกุล </strong></td>
                        <td align='center'><strong>เวลาขอ</strong></td>
                        <td align='center'><strong>ส่ง</strong></td>
                        <td align='center'><strong>อุปกรณ์</strong></td>
                        <td align='center'><strong>เพิ่ม</strong></td>
                        <td align='center'><strong>ผู้ป่วย</strong></td>
                        <td align='center'><strong>รับ</strong></td>
                        <td align='center'><strong>สถานะ</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                    <tr valign='top'>
                        <td align='center'>
                            <?php
                                                    if($arr['hyquicka'] > 0 OR $arr['hyquickb'] > 0) {
                                                       echo'<a href="#myModal_patient_quicka" data-toggle="modal" data-id="'.$arr['hn'].'" class="text text-success">';
                                                    }
                                                    echo $arr['hn'];
                                                    echo'</a>';
                                                ?>
                        </td>
                        <td><?php echo $arr['patients'] ?></td>
                        <td align='center'><?php echo substr($arr['htime'],11,8); ?>
                        </td>
                        <td align='center'><?php echo $arr['placeb'] ?></td>
                        <td><?php echo $arr['hassname'] ?></td>
                        <td><?php echo $arr['b'] ?></td>
                        <td align='center'><?php echo $arr['assname'] ?></td>
                        <td align='center'><?php echo $arr['x1_pertime'] ?> </td>
                        <td align="center">
                            <?php
                                                  IF($arr['x1']=="C"){
                                                    echo'<a class="btn btn-success btn-xs">';
                                                  } ELSE 
                                                  if($arr['x1']=='F'){
                                                    echo'<a class="btn btn-warning btn-xs">';
                                                  }else{
                                                    echo'<a class="btn btn-danger btn-xs">';

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
                    </tr>
                    <?php
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
