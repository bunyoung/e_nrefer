   <!doctype html>
   <html>

   <head>
       <meta http-equiv="refresh" content="60;" />
       <style>
       .btn-red {
           background-color: #ff0000;
           color: white;
       }

       .btn-orange {
           background-color: #ff8c00;
           color: white;
       }

       .btn-yellow {
           background-color: #FFFF00;
           color: black;
       }

       .btn-green {
           background-color: #00331a;
           color: white;
       }

       .btn-skyblue {
           background-color: #87eeb;
           color: white;
       }

       }
       </style>
   </head>

   <body>
       <p>
       <div class="container-fluid">
           <div class="panel-group">
               <!-- <div class="panel panel-info"> -->
               <!-- <div class="panel-heading">
                       <i class='fa fa-wheelchair fa-1x'></i> รายการเวชภัณฑ์และสิ่งของ ประจำวันที่
                       <?php Echo $d_end .'  เวลา : '.date("H:i:s"); ?>
                   </div> -->
               <p>
               <table id="asdataTable" class="cell-border compact stripe">
                   <thead>
                       <tr>
                           <td align='center'><strong>ลำดับ</strong></td>
                           <td align='center'><strong>เลขที่อ้างอิง</strong></td>
                           <td><strong>เวชภัณฑ์และสิ่งของ </strong></td>
                           <td><strong>รายละเอียด </strong></td>
                           <td><strong>แฟ้มผู้ป่วย </strong></td>
                           <td><strong>ชื่อ-สกุล </strong></td>
                           <td><strong>รับจาก </strong></td>
                           <td><strong>ไปส่งที่</strong></td>
                           <td><strong>จำนวน</strong></td>
                           <td><strong>ดำเนินการโดย</strong></td>
                           <td><strong>เวลาขอ</strong></td>
                           <td><strong>เวลารับงาน</strong></td>
                           <td><strong>เวลาจ่ายงาน</strong></td>
                           <td align='center'><strong>ยืนยัน</strong></td>
                           <td align='center'><strong>ยกเลิก</strong></td>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
require_once("db/connection.php");
require_once("db/date_format.php");
require_once("main_script.php");

#SQL
$sql ="SELECT * FROM v_asmonitor WHERE dgroup <> 'D' AND x1 not in ('F','X','C') ORDER BY assname";
$result_sql = mysqli_query($conn,$sql);
$i=1;
while($arr=mysqli_fetch_array($result_sql)) {
?>
                       <tr style:"margin-top:0";>
                           <td>
                               <center>
                                   <?php    
                                            $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else if(strlen($n)=='3'){echo '0';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}
                                        ?>
                               </center>
                           </td>

                           <td>
                               <center>
                                    <?php
                                    IF($arr['asscolor']=="R") {
                                        echo'<a href="sys_logistic_report_002.php?id='.$arr['hyitem'].' data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                        class="btn btn-red btn-grad DISABLED">';
                                    }else{
                                        IF($arr['asscolor']=="G"){
                                            echo'<a href="sys_logistic_report_001.php?id='.$arr['hyitem'].' data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                            class="btn btn-green btn-grad DISABLED">';
                                        }else{
                                            IF($arr['asscolor']=="O"){
                                                echo'<a href=".php?id='.$arr['hyitem'].' data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                                class="btn btn-orange btn-grad DISABLED">';
                                            }else{
                                                echo'<a href="sys_logistic_report_001.php?id='.$arr['hyitem'].' data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                                class="btn btn-yellow  btn-grad DISABLED">';
                                            }
                                        }
                                    }
                                    echo '<i class="fa fa-print fa-2x" aria-hidden="true" style="font-size:15px;"></i>'.' '.$arr['dgroup'].'-'.$arr['hyitem'];
                                    echo'</a>';        
                                    ?>
                               </center>
                           </td>

                           <td><?php echo $arr['assname']; ?> </td>
                           <td><?php echo $arr['assetdet']; ?> </td>
                           <td><?php echo $arr['hn']; ?> </td>
                           <td><?php echo $arr['pname']; ?> </td>
                           <td><?php echo $arr['nfromplace'] ?></td>
                           <td><?php echo $arr['ntplace'] ?></td>
                           <td style="margin:left" ;><?php echo $arr['peramt'].'  '.$arr['unit'] ?></td>
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
                           <td><?php echo $arr['htime']; ?></td>
                           <td><?php echo $arr['x1_pertime'] ?></td>
                           <td><?php echo $arr['perto'] ?></td>
                           <td align="center">
                               <?php
                                /*
                                X1=’W’ = ระหว่างดำเนินการ  modal: myModal_receive_wait
                                                           program : sys_hycall_center_wait.php
                                X1=’R’ = เปลรับเรื่อง
                                X1=’E’ = จนท 0 เปล ดำเนินการ
                                X1=’F’ = จบงานให้ Update สถานะเจ้าหน้าที่เป็น พร้อม
                                */
                                IF($arr['x1']=="W") {
                                    echo'<a href="#myModal_receive_ass_wait" data-toggle="modal" data-id="'.$arr['hyitem'].'"
                                         class="btn btn-info btn-grad">';
                                }
                                else
                                // กรณีที่มอบหมายงานไปแล้ว
                                IF($arr['x1']=="R"){
                                  echo'<a href="#myModal_receive_ass_finish" data-toggle="modal"
                                        data-id="'.$arr['hyitem'].'"
                                        class="btn btn-warning btn-grad">';
                                }
                                else
                                // จบภาระกิจ
                                if($arr['x1']=='E')
                                {
                                    echo'<a href="#myModal_receive_ass_end" data-toggle="modal" data-id="'.$arr['hyitem'].'"
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
                                    IF(($arr['x1']=='W' OR $arr['x1']=='R' OR $arr['x1']=='E')) 
                                    {
                                        echo'<a href="#myModal_receive_cancel" data-toggle="modal"
                                            data-id="'.$arr['hyitem'].'" class="btn btn-danger btn-grad">';
                                    }
                                    IF(($arr['x1']=='W' OR $arr['x1']=='R' OR $arr['x1']=='E')) 
                                    {
                                        echo'<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                                        echo'</a>';
                                    }
                                    ?>
                           </td>

                           <!-- พิมพ์ -->
                           <!-- <td align="center">
                               <?php
                                        echo'<a href="sys_logistic_report_001.php?id='.$arr['hyitem'].' " target="_blank" class="btn btn-danger btn-grad">';
                                        echo'<i class="fa fa-print fa-2x" aria-hidden="true" style="font-size:15px;"></i>';
                                        echo'</a>';
                                    // }
                                    ?>
                           </td> -->
                           <!-- <td align="center">
                               <?php
                                        echo'<a href="sys_logistic_report_002.php?id='.$arr['hyitem'].' " target="_blank" class="btn btn-danger btn-grad">';
                                        echo'<i class="fa fa-print fa-2x" aria-hidden="true" style="font-size:15px;"></i>';
                                        echo'</a>';
                                    // }
                                    ?>
                           </td> -->
                       </tr>
                       <?php
                    }
                    ?>
                   </tbody>
               </table>
           </div>
       <!-- </div> -->
       <!-- </div> -->
       <script type="text/javascript">
       function getRefresh() {
           $("#auto").show("slow");
           $("#autoRefresh").load("sys_hycall_center_asset_now.php", '', callback);
       }

       function callback() {
           $("#autoRefresh").fadeIn("slow");
           setTimeout("getRefresh();", 1500);
       }
       $(document).ready(getRefresh);
       </script>
       </div>
   </body>

   </html>