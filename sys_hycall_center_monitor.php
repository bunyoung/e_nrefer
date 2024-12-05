<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e_consult</title>
</head>
<?php include('main_top_panel_head.php'); ?>
<?php include('main_script.php'); ?>
<?php include('db/connection.php'); ?>
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

<body>
    <p>
    <div class="table-responsive-sm">
        <table id="b_Table" class="table row-border compact stripe" style="width:100%;">
            <thead>
                <tr>
                    <td align='center'><strong>ลำดับ</strong></td>
                    <td align='center'><strong>CNS.NO</strong></td>
                    <td><strong>AN </strong></td>
                    <td><strong>HN </strong></td>
                    <td><strong>ชื่อ-สกุล </strong></td>
                    <td><strong>เพศ </strong></td>
                    <td><strong>อายุ </strong></td>
                    <td><strong>WARD</strong></td>
                    <!-- <td><strong>เตียง</strong></td> -->
                    <!-- <td><strong>วันที่</strong></td> -->
                    <!-- <td><strong>สิทธิ </strong></td> -->
                    <td><strong>กลุ่มงานหลัก</strong></td>
                    <!-- <td><strong>ประวัติการตรวจร่างกาย</strong></td> -->
                    <!-- <td><strong>ห้องปฏิบัติการณ์</strong></td>
                    <td><strong>การรักษา</strong></td> -->
                    <!-- <td><strong>แพทย์ผู้รักษา</strong></td>
                    <td><strong>ชื่ออาจารย์แพทย์</strong></td>
                    <td><strong>แพทย์ยืนยัน</strong></td> -->
                    <td><strong>จุดประสงค์การปรึกษา</strong></td>
                    <!-- <td><strong>การวินิจฉัย 1</strong></td> -->
                    <!-- <td><strong>การวินิจฉัย 2</strong></td> -->
                    <!-- <td><strong>การวินิจฉัย 3</strong></td> -->
                    <td><strong>เพิ่มเติม</strong></td>
                    <td align='center'><strong>สถานะ</strong></td>
                </tr>
            </thead>
            <tbody>
                <?php
            #SQL
            $sql="SELECT ecd.*, 
            em.m_depname,es.s_ename,
            dd.prename AS prea, dd.name AS namea, dd.surname AS surnamea,
            dd1.prename AS preb,dd1.name AS nameb,dd1.surname AS surnameb,
            dd2.prename AS prec,dd2.name AS namec,dd2.surname AS sunamec,
            i.icd_desc AS icd_desca,i1.icd_desc AS icd_descb,
            i2.icd_desc AS icd_descc,pt.name as ptname
            FROM e_cons_detail ecd 
            LEFT JOIN e_mdepart em ON em.m_depid=ecd.hdep
            LEFT JOIN e_smdepart es ON es.s_edepart= ecd.sdep
            LEFT JOIN doc_dbfs dd ON dd.doc_code=ecd.hdoc
            LEFT JOIN doc_dbfs dd1 ON dd1.doc_code=ecd.fdoc
            LEFT JOIN doc_dbfs dd2 ON dd2.doc_code=ecd.mdoc
            LEFT JOIN icd10s i ON i.code=ecd.icda
            LEFT JOIN icd10s i1 ON i1.code=ecd.icdb
            LEFT JOIN icd10s i2 ON i2.code=ecd.icdc
            LEFT JOIN pt_types pt ON pt.type_id = ecd.pt_types
            ORDER BY cons_id DESC";
            $result_sql = mysqli_query($conn,$sql);
            $i=1;
            While($arr=mysqli_fetch_array($result_sql)) {
            ?>
                <tr style:"margin-top:0;">
                    <td>
                        <center>
                            <?php    
                        $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else if(strlen($n)=='3'){echo '0';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}
                    ?>
                        </center>
                    </td>
                    <td><?php echo $arr['cons_id']; ?></td>
                    <td><?php echo $arr['an']; ?> </td>
                    <td><?php echo $arr['hn']; ?> </td>
                    <td><?php echo $arr['pname']; ?> </td>
                    <td><?php echo $arr['sex']; ?> </td>
                    <td><?php echo $arr['age']; ?> </td>
                    <td><?php echo $arr['places']; ?> </td>
                    <!-- <td><?php echo $arr['beds']; ?> </td> -->
                    <!-- <td><?php echo $arr['date_admit']; ?> </td> -->
                    <!-- <td><?php echo $arr['pt_types']; ?> </td> -->
                    <td><?php echo $arr['m_depname'].'-'.$arr['s_ename']; ?> </td>
                    <!-- <td><?php echo $arr['a1']; ?> </td> -->
                    <!-- <td><?php echo $arr['a2']; ?> </td> -->
                    <!-- <td><?php echo $arr['a3']; ?> </td> -->
                    <!-- <td><?php echo $arr['hdoc']; ?> </td> -->
                    <!-- <td><?php echo $arr['mdoc']; ?> </td> -->
                    <!-- <td><?php echo $arr['fdoc']; ?> </td> -->
                    <!-- <td><?php echo $arr['exp']; ?> </td> -->
                    <!-- <td><?php echo $arr['icda']; ?> </td> -->
                    <!-- <td><?php echo $arr['icdb']; ?> </td> -->
                    <td><?php echo $arr['icdc']; ?> </td>
                    <td><?php echo $arr['ftext']; ?> </td>
                    <td>
                        <?php

                        IF($arr['status']=='N') {
                            echo'<a href="#myModal_receive_monitor" data-toggle="modal"
                            data-id="'.$arr['cons_id'].'" class="btn btn-danger btn-grad">';
                        }else{
                            echo '<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                            echo'</a>';
                        }
                        IF($arr['status']=='N') {
                            echo '<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                            echo'</a>';
                        }

                        // กรณี่ที่มีการ Consult แล้ว
                        IF($arr['status']=='C') {
                            echo'<a href="#myModal_receive_monitor" data-toggle="modal"
                            data-id="'.$arr['cons_id'].'" class="btn btn-danger btn-grad">';
                        }else{
                            echo '<i class="fa fa-times-circle-o" style="font-size:15px;"></i>';
                            echo'</a>';
                        }
                        IF($arr['status']=='C') {
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
    <script type="text/javascript" src="assets/js/jquery.min.js"> </script>
    <script type="text/javascript" src="assets/js/jquery-ui.min.js"> </script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"> </script>
    <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    function getRefresh() {
        $("#auto").show("slow");
        $("#autoRefresh").load("sys_hycall_center_monitor.php", '', callback);
    }

    function callback() {
        $("#autoRefresh").fadeIn("slow");
        setTimeout("getRefresh();", 2500);
    }
    $(document).ready(getRefresh);
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#b_Table').dataTable({
            "processing": true,
            "pageLength": All,
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
        $('#myModal_receive_monitor').on('show.bs.modal', function(e) {
            var hitem = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'post',
                url: 'sys_hycall_center_consult_monitor.php', //Here you will fetch records
                data: {
                    'hyitems': hitem
                },
                success: function(data) {
                    $('.fetched-data_rc').html(data);
                }
            });
        });
    });
    </script>

    <div class="modal fade" id="myModal_receive_monitor" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">
                        <i class="fa fa-group"></i> : ยกเลิกรายการร้องขอ
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="fetched-data_rc"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิดฟอร์ม
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>