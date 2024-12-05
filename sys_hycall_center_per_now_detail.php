<tbody>
<?php
require_once("db/connection.php");
require_once("db/date_format.php");

#SQL
$sql ="SELECT
    *
 FROM v_monitor
 WHERE x1 not in ('F','X','C') ORDER BY hyass";
$result_sql = mysqli_query( $conn,$sql);

$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                    <tr valign='top'>
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
                                   echo'<a href="#myModal_change_person" data-toggle="modal"
                                   data-id="'.$arr['hyitem'].'"
                                 class="btn btn-success btn-grad">';
                               }
                            if($arr['pers']<>""){
                              echo '<i class="fa fa-user"></i>  '.$arr['name'];
                              echo'</a>';
                            };
                            ?>
                        </td>

                        <td><center>
                            <?php
                              IF($arr['fasts_color']=="R") {
                                 echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                                 class="btn btn-danger btn-grad">';
                              }
                              else
                              // กรณีที่มอบหมายงานไปแล้ว
                              IF($arr['fasts_color']=="Y"){
                                echo'<a href="#" data-toggle="modal"
                                    data-id="'.$arr['hyitem'].'"
                                    class="btn btn-warning btn-grad">';
                              }
                              else
                              // จบภาระกิจ
                              if($arr['fasts_color']=='G'){
                                 echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                       class="btn btn-success btn-grad">';
                              }else
                              // กรณีที่มีการร้องขอ
                              IF($arr['fasts_color']=='C'){
                                echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                      class="btn btn-success btn-grad">';
                              }else
                              IF($arr['fasts_color']<> 'R') {
                                 if($arr['fasts_color']<>'Y'){
                                    if($arr['fasts_color']<>'G'){
                                       if($arr['fasts_color']<>'C'){
                                         echo'<a href="#" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                        class="btn btn-default btn-grad">';
                                       }
                                    }
                                 }
                              }
                             {
                            }
                            echo '<i class="fa fa-wheelchair-alt" aria-hidden="true"></i> '.$arr['fasts_name'];
                            echo'</a>';
                          ?>
                          </center>
                        </td>

                        <td><?php echo substr($arr['htime'],11,8); ?></td>
                        <td><?php echo $arr['x1_pertime'] ?></td>
                        <td align="center">
                            <?php
                                /*
                                X1=’W’ = ระหว่างดำเนินการ  modal:     myModal_receive_wait
                                                                       program : sys_hycall_center_wait.php
                                X1=’R’ = เปลรับเรื่อง
                                X1=’E’ = จนท 0 เปล ดำเนินการ
                                X1=’F’ = จบงาน    ให้ Update สถานะเจ้าหน้าที่เป็น พร้อม
                                */
                                IF($arr['x1']=="W") {
                                    echo'<a href="#myModal_receive_wait" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                                 class="btn btn-info btn-grad">';
                                }
                                else
                                // กรณีที่มอบหมายงานไปแล้ว
                                IF($arr['x1']=="R"){
                                  echo'<a href="#myModal_receive_finish" data-toggle="modal"
                                          data-id="'.$arr['hyitem'].'"
                                          class="btn btn-warning btn-grad">';
                                }
                                else
                                // จบภาระกิจ
                                if($arr['x1']=='E')
                                {
                                    echo'<a href="#myModal_receive_end" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                         class="btn btn-danger btn-grad">';
                                }
                                // กรณีที่มีการร้องขอ
                                IF($arr['x1']=='W')
                                {
                                    echo '<i class="fa fa-plus-square"></i>  จ่ายงาน';
                                }
                                else

                                // กรณีที่มอบหมายงานไปแล้ว
                                if($arr['x1']=='R')
                                {
                                    echo '<i class="fa fa-plus-square"></i>  รับงาน';
                                }

                                // กรณีที่จบงาน
                                if($arr['x1']=='E')
                                {
                                    echo '<i class="fa fa-plus-square"></i>  ปิดงาน ';
                                    echo'</a>';
                                }
                                ?>
                        </td>
                        <td align="center">
                            <!-- รายการที่จะทำการยกเลิก -->
                            <?php
                                IF(($arr['x1']=='W' OR $arr['x1']=='R' OR $arr['x1']=='E')) {
                                    echo'<a href="#myModal_receive_cancel" data-toggle="modal"
                                    data-id="'.$arr['hyitem'].'" class="btn btn-danger btn-grad">';}
                                IF(($arr['x1']=='W' OR $arr['x1']=='R' OR $arr['x1']=='E')) {
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
