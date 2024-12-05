<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
    background-color: #87eeeb;
    color: white;
}
</style>
<?php include('main_script.php');?>
<!-- ทำ Refresh หากไม่มีการเลื่อน Mouse -->
<script>
     var time = new Date().getTime();
     $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 180000) 
             window.location.reload(true);
         else 
             setTimeout(refresh, 30000);
     }

     setTimeout(refresh, 10000);
</script>

<onload=”javascript:setTimeout>

<!-- <onload=”javascript:setTimeout(“location.reload(true);”,90000);”> -->

    <p>
    <table id="d_table" class="cell-border row-border compact stripe" style="width:100%;">
        <thead>
            <tr>
                <td align='center'><strong>ลำดับ</strong></td>
                <td align='center'><strong>เลขที่อ้างอิง</strong></td>
                <td><strong>หน่วยร้องขอ </strong></td>
                <td><strong>ตึก</strong></td>
                <td><strong>ชั้น</strong></td>
                <td><strong>ตำแหน่งที่ต้องการ </strong></td>
                <td><strong>รายละเอียด </strong></td>
                <td><strong>ระดับความสะอาด </strong></td>
                <td><strong>ความเร่งด่วน </strong></td>
                <td><strong>วันที่ร้องขอ </strong></td>
                <td><strong>เวลา</strong></td>
                <td><strong>ดำเนินการโดย</strong></td>
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
$sql ="SELECT * FROM v_asmonitor_d WHERE dgroup='D' AND x1 not in ('F','X','C') ORDER BY assname";
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
                    IF($arr['dgroup']=="D") {
                        echo'<a href="sys_logistic_report_004.php?id='.$arr['hyitem'].' data-toggle="modal" data-id="'.$arr['hyitem'].'"
                        class="btn btn-skyblue btn-grad DISABLED" target="_blank">';
                    }else{
                        echo'<a href="sys_logistic_report_004.php?id='.$arr['hyitem'].' data-toggle="modal" data-id="'.$arr['hyitem'].'"
                        class="btn btn-skyblue btn-grad DISABLED" target="_blank">';
                    }
                    echo '<i class="fa fa-print fa-2x" aria-hidden="true" 
                        style="font-size:15px;"></i>'.' '.$arr['dgroup'].'-'.$arr['hyitem'];
                    echo'</a>';        
                    ?>
                    </center>
                </td>
                <td><?php echo $arr['ftplace'] ?></td>
                <td><?php echo $arr['nbuild']; ?> </td>
                <td><?php echo $arr['floor']; ?> </td>
                <td><?php echo $arr['clean_place']; ?> </td>
                <td><?php echo $arr['assetdet']; ?> </td>
                <td><?php echo $arr['lvc']; ?> </td>
                <td><?php echo $arr['clean_argent'] ?></td>
                <td><?php echo $arr['hdate']; ?></td>
                <td><?php echo $arr['htime']; ?></td>
                <td>
                    <?php
                IF($arr['pers']=="")
                {
                    echo '<i class="fa fa-bell-slash" style="color:red"></i> ';
                }else{
                    echo'<a href="#myModal_change_person" data-toggle="modal"
                    data-id="'.$arr['hyitem'].'"
                    class="btn btn-success btn-grad">';
                }
                if($arr['pers']<>"")
                {
                    echo '<i class="fa fa-user"></i>  '.$arr['name'];
                    echo'</a>';
                };
               ?>
                </td>
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
    <!-- </div> -->
    <script type="text/javascript" src="assets/js/jquery.js"> </script>
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
    <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js">
    </script>

    <script type="text/javascript">
    function getRefresh() {
        $("#auto").show("slow");
        $("#autoRefresh").load("sys_hycall_center_asset_nowc.php", '', callback);
    }

    function callback() {
        $("#autoRefresh").fadeIn("slow");
        setTimeout("getRefresh();", 2500);
    }
    $(document).ready(getRefresh);
    </script>


    <script type="text/javascript">
    $(document).ready(function() {
        $('#d_table').dataTable({
            "oLanguage": {
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sLast": "หน้าสุดท้าย",
                    "sNext": "ถัดไป",
                    "sPrevious": "ก่อนหน้า"
                },
                "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
                "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                "sSearch": "ค้นหา :"
            }
        });
    });
    </script>

</body>

</html>