<?php
	include('./db/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-refer</title>
</head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}
</style>
<?php
    require_once("db/connection.php");
    require_once('db/connect_pmk.php');
?>
<?php
$date_start_d_defult = '01/';
$date_start_m_defult = date('m/');
$date_start_y_defult = date('Y') + 543;
$date_start_dmy_defult = $date_start_d_defult . $date_start_m_defult . $date_start_y_defult;
$date_end_dm_defult = date('d/m/');
$date_end_y_defult = date('Y') + 543;
$date_end_dmy_defult = $date_end_dm_defult . $date_end_y_defult;
$date_end_dm_defult = date('d/m/');
$date_end_y_defult = date('Y') + 543;
$date_end_dmy_defult = $date_end_dm_defult . $date_end_y_defult;
$d_start_post = $_POST['d_start'];
$d_end_post = $_POST['d_end'];
IF (!empty($d_start_post)) {
    $d_start = $d_start_post;
} ELSE {
    $d_start = $date_start_dmy_defult;
}
IF (!empty($d_end_post)) {
    $d_end = $d_end_post;
} ELSE {
    $d_end = $date_end_dmy_defult;
}
$d_start_cal = substr($d_start, 6, 4) . substr($d_start, 3, 2) . substr($d_start, 0, 2);
$d_end_cal = substr($d_end, 6, 4) . substr($d_end, 3, 2) . substr($d_end, 0, 2);
$date_m = $d_end;
?>
<?php
$did=null;
if($did==null){
    $did=$_GET['id'];
}
?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 if($did<>''){
    $_SESSION['ih'] = 'หัวหน้าแผนกยืนยัน';
 }else{
    $_SESSION['ih'] = 'แสดงคนไข้ที่ได้ผ่านการ Refer เรียบร้อยแล้ว';
 }
 $hcode=$_SESSION['hcode'];

 #ตรวจสอบสิทธิการเข้าใช้งาน
 if ($_SESSION['hosname']=="") 
{
    echo (
        "<script>
                Swal.fire({
                    title: 'ไม่พบสิทธิ [admin]'',
                    text: 'ข้อความนี้สำหรับแจ้งให้ผู้ใช้งานทราบ',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
           });
           window.location.href='dashboard.php';
        </script>");
}

?>
<style>
table {
    font-family: 'sarabun';
    font-size: 18px;
}
</style>
<?php
// include('main_top_panel_head.php');
// include('main_top_menu_session.php');
?>
<?php     
//    include ("main_script.php")
?>

<body class="Full-Width">
    <?php     
   include ("main_script.php")
?>
    <div class="row">
        <div class="col-md-1">
            <?php
        include('sys_hycall_center_now_smenu.php');
        ?>
        </div>
        <div class="col-md-11" style="font-family: 'sarabun'; margin-top:0px;">
            <?php
            include('sys_hycall_monitor_shead.php');
            ?>
            <table id="dataTable" class="display dataTable" role="grid"
                style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll; max-width: 80%; display: block; white-space: word-wrap: break-word;" cellspacing="0">
                <thead style="font-family: 'sarabun'; margin-top:0px;background-color:#F2F4F4">
                    <tr align="center">
                        <td>ลำดับ</td>
                        <td>Ref No.</td>
                        <td>วันที่</td>
                        <td>เวลา</td>
                        <td>ประเภทส่งต่อ</td>
                        <td>ประเภทสถานพยาบาล</td>
                        <td>HN</td>
                        <td>ชื่อ - สกุล</td>
                        <td>เพศ</td>
                        <td>
                            <center>อายุ (ปี)</center>
                        </td>
                        <td>สถานพยาบาลปลายทาง</td>
                        <td>แพทย์ผู้ส่งต่อ</td>
                        <td>กลุ่มงานที่ส่งต่อ</td>
                        <td>สถานะขั้นตอนข้อมูล </td>
                    </tr>
                </thead>
                <tbody style="font-family:sarabun;font-size:16px; background-color:#b9cfed; color:#01295c;">
                    <?php
                    $i=0;
                    $sql="
                    SELECT 
                    * 
                    FROM v_rf_detail 
                    WHERE rf_status<>'5' AND rf_hospital='$hcode'
                        Order by rf_id DESC";
                    $query=mysqli_query($conn,$sql);
                    $i=1;
                    while($rs=mysqli_fetch_array($query)) {
                        $year=substr($rs["rf_birthdate"],6,4);
                        $month=substr($rs["rf_birthdate"],3,2);
                        $date=substr($rs["rf_birthdate"],0,2);
                        $day=$year."-".$month."-".$date;
                        $date = date("Y-m-d");
                        $age=($date - $day);
                        $rfhn=$rs['rf_hn'];
                        $rfpatients=$rs['rf_patients'];
                        $rfno=$rs['rf_id'];
                        
				        //     Field = rf_status
                        //    0. รออนมัติ
                        //     1. อนุมัติการ Refer
                        //     2.รอปลายทาง ตอบรับ
                        //     3.ปลายทาง ตอบรับ/ปฎิเสธ 
                        //     4.ตอบรับ Refer 
                        //     5.ตอบรับ Refer 
                        //     6.เตรียมการส่งผู้ป่วย 
                        
                        IF($rs['rf_status']=='0'){
                            $f = 'รออนุมัติ';
                        } 
                        if($rs['rf_status']=='1' && $rs['rf_no_refer']==''){      
                            $f = 'อนุมัติ Refer';
                        }
                        if($rs['rf_status']=='2' && $rs['rf_no_refer']==''){      
                            $f = 'อนุมัติ Auto';
                        }
                        if($rs['rf_status']=='3' && $rs['rf_no_refer']<>''){   
                            $f = 'รอปลายทาง<br>ตอบรับ';
                        }
                        if($rs['rf_status']=='4' && $rs['rf_no_refer']<>'') {
                            if($rs['hosp_recive_status']=='Y'){
                                if($rs['hosp_recive_rem']=='1'){
                                    $f='รอส่ง<br>ผู้ป่วย';
                                }else{
                                    if($rs['hosp_recive_rem']=='2'){
                                        $f='ปฎิเสธรับ';
                                    }
                                }
                            }
                        }
					   ?>
                    <?php
                    $st='';
                    if($rs['rf_status']=='0' && $did <> null){
                       $st="style=background-color:#aed7ea";
                    }
                    ?>
                    <tr <?php echo $st;?>>
                        <td>
                            <center>
                                <?php  $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                            </center>
                        </td>
                        <td>
                            <?php echo $rs['rf_no_refer'].'-'.$rs['rf_short']; ?>
                        </td>
                        <td><?php echo $rs['rf_date']; ?></td>
                        <td><?php echo $rs['rf_time'];?> </td>
                        <td>
                            <center>
                                <?php
                                if($rs['rfgroup']=='1'){
                                    echo '<a href="#" class="btn  btn-"
                                    style="background-color:#330000;color:#ffff ;width:250px;">'
                                    .$rs['rfevent'].
                                '</a>';
                                }
                                if($rs['rfgroup']=='2'){
                                     echo '<a href="#" class="btn btn-" 
                                     style="background-color:#f25022;color:#ffff ;width:250px;">'
                                     .$rs['rfevent'].
                                '</a>';
                                }
                                ?>
                            </center>
                        </td>
                        <td><?php echo $rs['namehostype'] ;?> </td>
                        <td><?php echo $rs['rf_hn']; ?></td>
                        <td><?php echo $rfpatients; ?></td>
                        <td>
                            <center><?php echo $rs['rf_sex']; ?></center>
                        </td>
                        <td>
                            <center><?php echo $age; ?></center>
                        </td>
                        <td><?php echo $rs['hossendto_name']; ?></td>
                        <td><?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                        <td><?php echo $rs['m_depname']; ?></td>

                        <!--  ส่วนช่อง ขั้นตอนมูล
                             $rs['hosp_recive_rem']=='1          = ยินดีรับ Refer
                             $rs['hosp_recive_rem']=='2'        = ปฎิเสธการ Refer
                            -->
                        <td>
                            <center>
                                <?php
                                    if($rs['rf_status']=='1'){
                                        echo '<a href="#" class="btn btn-danger btn-grad"  disabled
                                                        style="font-weight:300;font-size:16px;width:120px;">'.$f.'
                                                 </a>';
                                    }else{
                                        if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']=='1'){
                                            echo '<a href="sys_hycall_send_refer.php?sid='.$rs['rf_id'].' "  
                                                        class="btn btn-danger btn-grad" 
                                                        style="font-weight:bold;font-size:16px;width:120px;">'.$f.'
                                                    </a>';
                                        }else{
                                            if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']=='2'){
                                                echo '<a href="#" class="btn btn-warning btn-grad" 
                                                          style="font-weight:bold;font-size:16px;width:120px;">'.$f.'
                                                       </a>';
                                            }else{
                                                echo '<a href="#" class="btn btn-success btn-grad" 
                                                  style="font-weight:bold;font-size:16px;width:120px;">'.$f.'
                                             </a>';
                                            }           
                                        }
                                    }
                                    ?>
                            </center>
                        </td>
                    </tr>
                    <?php 
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>

    <!---MODAL -->
    <!-- Approve ส่งคนไข้ หลังจากยืนยันการรับ -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#myModal_approve_send_refer').on('show.bs.modal', function(e) {
            var sid = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'post',
                url: 'sys_hycall_send_refer.php', //Here you will fetch records 
                data: {
                    'sid': sid
                }, //Pass $id
                success: function(data) {
                    $('.fetched-data_rc').html(data);
                    //Show fetched data from database
                }
            });
        });
    });
    </script>
    <div class="modal fade" id="myModal_approve_send_refer" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content modal-xl">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;
                    </button>
                    <h5 class="modal-title">
                        <i class="fa fa-group">
                        </i> : เตรียมความพร้อมคนไข้ก่อนดำเนินการเคลื่อนย้าย
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="fetched-data_rc">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Approve ส่งคนไข้ หลังจากยืนยันการรับ -->
    <!---END MODAL APPROVE -->

    <script type="text/javascript">
    $(document).ready(function() {
        $('#myModal_approve_confirm_refer').on('show.bs.modal', function(e) {
            var rid = $(e.relatedTarget).data('id');
            $.ajax({
                type: 'post',
                url: 'sys_hycall_monitor_confirm.php', //Here you will fetch records 
                data: {
                    'rid_p': rid
                }, //Pass $id
                success: function(data) {
                    $('.fetched-data_rc').html(data);
                    //Show fetched data from database
                }
            });
        });
    });
    </script>
    <div class="modal fade" id="myModal_approve_confirm_refer" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;
                    </button>
                    <h5 class="modal-title">
                        <i class="fa fa-group">
                        </i> : ขออนุมัติ Refer Out
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="fetched-data_rc">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!---END MODAL APPROVE -->

    <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').dataTable({
            "lengthMenu": [
                [10, 20, 50, 60, -1],
                [10, 20, 50, 60, "All"]
            ],
        });
    });


    $('#example').dataTable({
        "bFilter": false
    });
    </script>

</body>

</html>

<!-- $('#example').dataTable( {
    "order": [],
    "columnDefs": [ {
      "targets"  : 'no-sort',
      "orderable": false,
    }]
}); -->

<!-- การ ปิด ช่อง ค้นหาข้อมูล  Search -->
<!-- 
$('#example').dataTable( {
	"bFilter": false
} ); -->