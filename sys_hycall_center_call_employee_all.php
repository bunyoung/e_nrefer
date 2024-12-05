<p>
<div class="rows boxed">
    <div class="container-fluid">
        <div class="panel-group">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class='fa fa-wheelchair fa-1x'></i> ผู้ป่วยที่ รอรับบริการศูนย์เปล ประจำวันที่
                    <?php echo $d_end; ?>
                </div>
                <p>
                    <?php
#SQL
$sql ="SELECT
  *
 FROM v_monitor
     WHERE x1='F' ";
$result_sql = mysqli_query( $conn,$sql);
?>
                <table id="adataTable" class="cell-border compact stripe" style="width:100%">
                    <thead>
                        <tr>
                            <td>วันที่</td>
                            <td>HN</td>
                            <td>ชื่อ-สกุล </td>
                            <td>รับจาก </td>
                            <td>ไปส่งที่</td>
                            <td>อุปกรณ์ที่มี</td>
                            <td>เพิ่ม</td=>
                            <td>เปล</td>
                            <td>เร่งด่วน</td>
                            <td>เริ่ม</td>
                            <td>รับ</td>
                            <td align='center'>ปิด</td>
                            <td align='center'>ใช้เวลา</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                        <tr valign='top'>
                            <td><?php echo $arr['hdate']; ?> </td>
                            <td><?php echo $arr['hn']; ?> </td>
                            <td><?php echo $arr['patients'] ?></td>
                            <td><?php echo $arr['fplace'] ?></td>
                            <td><?php echo $arr['tplace'] ?></td>
                            <td><?php echo $arr['hassnamea']?></td>
                            <td><?php echo $arr['hassnameb']?></td>
                            <td>
                                <?php
                               IF($arr['pers']==""){
                                 echo '<i class="fa fa-bell-slash" style="color:red"></i> ';}
                               ELSE {
                                 echo ''.$arr['name'];} ;
                               ?>
                            </td>

                            <td>
                                <?php
                              IF($arr['hyass']=="13") {
                                 echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                                 class="btn btn-danger btn-grad">';
                              }
                              else
                              // กรณีที่มอบหมายงานไปแล้ว
                              IF($arr['hyass']=="6"){
                                echo'<a href="#" data-toggle="modal"
                                    data-id="'.$arr['hyitem'].'"
                                    class="btn btn-warning btn-grad">';
                              }
                              else
                              // จบภาระกิจ
                              if($arr['hyass']=='7'){
                                 echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                       class="btn btn-warning btn-grad">';
                              }else
                              // กรณีที่มีการร้องขอ
                              IF($arr['hyass']=='14'){
                                echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                      class="btn btn-success btn-grad">';
                              }else
                              IF($arr['hyass']<> '13') {
                                 if($arr['hyass']<>'6'){
                                    if($arr['hyass']<>'7'){
                                       if($arr['hyass']<>'14'){
                                         echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                        class="btn btn-info btn-grad">';
                                       }
                                    }
                                 }
                              }
                             {
                            }
                            IF($arr['hyass']=="13") {
                              echo '<i class="fa fa-wheelchair-alt" aria-hidden="true"></i> '.$arr['assname'];
                              echo'</a>';

                            }else
                              // กรณีที่มอบหมายงานไปแล้ว
                            IF($arr['hyass']=="6"){
                              echo '<i class="fa fa-wheelchair"></i>  '.$arr['assname'];
                              echo'</a>';

                            }else
                              // จบภาระกิจ
                            if($arr['hyass']=='7'){
                              echo '<i class="fa fa-user-o"></i>  '.$arr['assname'];
                              echo'</a>';

                            }else
                            // กรณีที่มีการร้องขอ
                            IF($arr['hyass']=='14'){
                              echo '<i class="fa fa-user"></i>  '.$arr['assname'];
                              echo'</a>';
                            }else
                              IF($arr['hyass']<> '13') {
                                 if($arr['hyass']<>'6'){
                                    if($arr['hyass']<>'7'){
                                       if($arr['hyass']<>'14'){
                                          echo '<i class="fa fa-home"></i>  '.$arr['assname'];
                                          echo'</a>';
                                       }
                                    }
                                 }
                              }
                          ?>
                            </td>

                            <td><?php echo substr($arr['htime'],11,8); ?></td>
                            <td><?php echo $arr['x1_pertime'] ?></td>
                            <td><?php echo $arr['perfinish'] ?></td>

                            <td align="center">
                                <?php echo $arr['usetime']?>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>