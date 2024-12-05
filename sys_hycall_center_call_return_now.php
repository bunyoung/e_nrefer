<!DOCTYPE html>
<?php
include("db/connection.php");
?>

<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php
#SQL
$sql ="SELECT * FROM v_monitor
WHERE hdate = '$d_default' and x1 ='F' and usereturn = '0' And x2 is null";
$result_sql = mysqli_query( $conn,$sql);
?>

<head>
    <?php include('main_script.php');?>
</head>

<body>
    <div class="inner bg-light lter" style="margin-top:-40px;">
        <div class="col-md-12">
            <div class="box">
                <header>
                    <div class="icons"><i class="fa fa-user" aria-hidden="true"></i>
                    </div>

                    <h5 id="div1">ทะเบียนผู้ป่วยที่อยู่ระหว่างการดำเนินการเคลื่อนย้าย (รอส่งกลับ)
                        ประจำวันที่_
                        <a class="text-success">
                            <?PHP echo $d_default; ?>
                        </a>
                    </h5>
                </header>
                <br>
                <!-- <div id="collapse4" class="body" style="overflow:scroll"> -->
                <table id="sdataTable" class="table table-bordered table-condensed table-hover table-striped"
                    style="width:100%;">
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
                            <td><?php echo $arr['sicka'].' '.$arr['sickb'].' '.$arr['sickc'].' '
                                                .$arr['sickd'].' '.$arr['sicke'].' '.$arr['sickf'].' '
                                                .$arr['sickg'].' '.$arr['ems'].' '.$arr['sickh'].' '.$arr['covidgp']; ?>
                            </td>
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
        </div>
    </div>
</body>
<script type="text/javascript" src="./assets/js/jquery.js"> </script>
<script type="text/javascript" src="./assets/js/jquery.min.js"> </script>
<script type="text/javascript" src="./assets/js/jquery-ui.min.js"> </script>
<script type="text/javascript" src="./assets/lib/moment/min/moment.min.js"> </script>
<script type="text/javascript" src="./assets/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="./assets/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="./assets/js/jquery.tablesorter.min.js">
</script>
<script type="text/javascript" src="./assets/js/jquery.ui.touch-punch.min.js">
</script>
<script type="text/javascript" src="./assets/lib/bootstrap/dist/js/bootstrap.min.js">
</script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    $('#sdataTable').dataTable({
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

</html>
<!--- มอบหมายงาน 0 เปล -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_receive_wait').on('show.bs.modal', function(e) {
        var jhyitem = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_center_end_finish_patients.php', //Here you will fetch records
            data: {
                'hyid': jhyitem
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //แสดงรายการข้อมูจาก database
            }
        });
    });
});
</script>

<div class="modal fade" id="myModal_receive_wait">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title text-default">
                    <i class="fa fa-user">
                    </i> : ส่งคนไข้กลับหน่วยงานเดิม
                </h5>
            </div>
            <div class="modal-body text-default">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                </button>
            </div>
        </div>
    </div>
</div>