<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Refer</title>
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
<!-- ทำ Refresh หากไม่มีการเลื่อน Mouse -->
<script>
    var time = new Date().getTime();
    $(document.body).bind("mousemove keypress", function(e) {
        time = new Date().getTime();
    });

    function refresh() {
        if (new Date().getTime() - time >= 180000)
            window.location.reload(true);
        else
            setTimeout(refresh, 30000);
    }

    setTimeout(refresh, 10000);
</script>
<?php
include('db/connection.php'); ?>
<body>
    <p>
    <div class="table-responsive-sm">
        <table id="a_Table" class="table row-border compact stripe" style="width:100%;margin-top: 10px;">
            <thead>
                <tr>
                    <td align='center'><strong>ลำดับ</strong></td>
                    <td align='center'><strong>CONS NO.</strong> </td>
                    <td><strong>AN </strong></td>
                    <td><strong>HN </strong></td>
                    <td><strong>ผู้ป่วย </strong></td>
                    <td><strong>เพศ </strong></td>
                    <td><strong>อายุ(ปี) </strong></td>
                    <td><strong>WARD</strong></td>
                    <td><strong>เตียง</strong></td>
                    <td><strong>วันที่ขอ</strong></td>
                    <td><strong>เวลาขอ</strong></td>
                    <td><strong>กลุ่มงาน-หน่วยงานที่ขอ Consult</strong></td>
                    <td><strong>จุดประสงค์การปรึกษา</strong></td>
                    <td><strong>ความเร่งด่วน</td>
                    <td><strong>Message Consult</td>
                    <td align='center'><strong>สถานะ</strong></td>
                </tr>
            </thead>
            <tbody>
                <?php
            #SQL
            $sql="SELECT * FROM v_consult_detail WHERE mdoc=$user_id and status='S' ORDER BY cons_id DESC";
            $result_sql = mysqli_query($conn,$sql);
            $i=1;
            WHILE($arr=mysqli_fetch_array($result_sql)) {
            ?>
                <tr style:"margin-top:0;">
                    <td>
                        <center>
                            <?php    
                        $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else if(strlen($n)=='3'){echo '0';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}
                    ?>
                        </center>
                    </td>
                    <td>
                        <?php
                    if($arr['status']=='S'){
                        echo'<a href="print_consult_a4.php?id='.$arr['cons_id'].' data-toggle="modal" data-id="'.$arr['cons_id'].'" target="_blank"
                        class="btn btn-success btn-grad DISABLED">';
                    }
                    echo '<i class="fa fa-print fa-2x" aria-hidden="true" style="font-size:15px;"></i>'.' '.$arr['mcode'].'-'.$arr['cons_id'];
                    echo'</a>';        
                    ?>
                    </td>
                    <td><?php echo $arr['an']; ?> </td>
                    <td><?php echo $arr['hn']; ?> </td>
                    <td><?php echo $arr['pname']; ?> </td>
                    <td><?php echo $arr['sex']; ?> </td>
                    <td><?php echo $arr['age']; ?> </td>
                    <td><?php echo $arr['fullplace']; ?> </td>
                    <td><?php echo $arr['beds']; ?> </td>
                    <td><?php echo $arr['cons_date']; ?> </td>
                    <td><?php echo $arr['cons_time']; ?> </td>
                    <td><?php echo $arr['m_depname'].'-'.$arr['s_ename']; ?> </td>
                    <td><?php echo $arr['ftext']; ?> </td>
                    <td><?php echo $arr['e_fast']; ?> </td>
                    <td><?php echo $arr['eoption']; ?> </td>
                    <td><?php
                    IF($arr['status']=='S') 
                    {
                        echo'<a href="#myModal_receive_consult" data-toggle="modal"
                            data-id="'.$arr['cons_id'].'" class="btn btn-warning btn-grad">';
                    }
                    IF($arr['status']=='S') 
                    {
                        echo'<i class="fa fa-times-circle-o" style="font-size:15px;">Consults </i>';
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
    <script type="text/javascript" src="assets/js/jquery.js"> </script>
    <script type="text/javascript" src="assets/js/jquery.min.js"> </script>
    <script type="text/javascript" src="assets/js/jquery-ui.min.js"> </script>
    <script type="text/javascript" src="assets/lib/moment/min/moment.min.js"> </script>
    <!--TABLE  -->
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"> </script>
    <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    function getRefresh() {
        $("#auto").show("slow");
        $("#autoRefresh").load("sys_hycall_center_asset_nowa.php", '', callback);
    }

    function callback() {
        $("#autoRefresh").fadeIn("slow");
        setTimeout("getRefresh();", 2500);
    }
    $(document).ready(getRefresh);
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#a_Table').dataTable({
            "processing": true,
            "pageLength": 10,
            "ordering": true,
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

    <script type="text/javascript">
    $(document).ready(function() {
        $('#myModal_receive_consult').on('show.bs.modal', function(e) {
            var hy_cons = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'post',
                url: 'sys_hycall_center_consult_now.php', //Here you will fetch records
                data: {
                    'hy_cons': hy_cons
                }, //Pass $id
                success: function(data) {
                    $('.fetched-data_rc').html(data);
                    //แสดงรายการข้อมูจาก database
                }
            });
        });
    });
    </script>

    <div class="modal fade" id="myModal_receive_consult">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                    <h5 class="modal-title">
                        <i class="fa fa-user">
                        </i> : รับ Consult
                    </h5>
                </div>
                <div class="modal-body text-default">
                    <div class="fetched-data_rc">
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม</button>
                </div> -->
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
    $(document).ready(function() {
        $('#myModal_receive_comment').on('show.bs.modal', function(e) {
            var hy_v = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'post',
                url: 'sys_consult_report_002.php', //Here you will fetch records
                data: {
                    'hy_vs': hy_v
                }, //Pass $id
                success: function(data) {
                    $('.fetched-data_rc').html(data);
                    //แสดงรายการข้อมูจาก database
                }
            });
        });
    });
    </script>

    <div class="modal fade" id="myModal_receive_comment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                    <h5 class="modal-title">
                        <i class="fa fa-user">
                        </i> : รับ Consult
                    </h5>
                </div>
                <div class="modal-body text-default">
                    <div class="fetched-data_rc"> </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>