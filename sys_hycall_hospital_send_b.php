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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js">
    </script>
</head>

<style>
.border {
    font-family: sarabun;
    font-weight: bolder;
    font-style: unset;
    display: block;
    padding: 10px 10px 10px 10px;
    width: AUTO;
    font-size: 20px;
    text-align: center;
    border-radius: 3%;
}

.btborder {
    font-family: sarabun;
    font-style: unset;
    display: block;
    padding: 20px 10px 10px 10px;
    width: AUTO;
    font-size: 18px;
    word-spacing: 1.5em;
    color: #004D40;
}
</style>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

.cell-hyphens {
    word-wrap: break-word;
    max-width: 1px;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
}
</style>
<?php
    require_once("db/connection.php");
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
    $_SESSION['ih'] = 'แสดงคนไข้ Refer';
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
    font-size: 16px;
}
</style>
<?php 
include('main_script.php');
?>

<?php
    require_once("db/connection.php");
    require_once('db/connect_pmk.php');
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
    $_SESSION['ih'] = 'แสดงคนไข้ Refer';
 }
 $hcode=$_SESSION['hcode'];

 ?>
<style>
table {
    font-family: 'sarabun';
    font-size: 16px;
}
</style>
<?php 
// include('main_top_panel_head.php');
// include('main_top_menu_session.php');
// include('sys_hycall_center_now_smenu.php');

// include('main_top_panel_head.php');
// include('main_top_menu_session.php');
// include('main_top_menu_smenu.php');
?>

<body>
    <div class="container-fluid" style="margin: 2px 2px 2px;padding: 2px 2px 2px;color:black;">
        <div class="commenta justify-content-md-center">
            <table id="adataTableb" class="display dataTable" role="grid" style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll;  white-space: word-wrap: break-word;"
                cellspacing="0">
                <thead
                    style="font-family: sarabun;font-size:normal;margin-top:0px;background-color:#472183;color:#F1F8E9">
                    <tr>
                    <tr align="center">
                        <td>ลำดับ</td>
                        <?php
                            if($did==null) 
                            {
                                echo '<td>Ref No.</td>';
                            }
                            ?>
                        <td>วันที่</td>
                        <td>เวลา</td>
                        <td>ประเภทส่งต่อ</th>
                        <td>HN</td>
                        <td>ชื่อ - สกุล</td>
                        <td>เพศ</td>
                        <td>
                            <center>อายุ (ปี)</center>
                        </td>
                        <td>รพ. ปลายทาง</td>
                        <td>แพทย์<br>ผู้ส่งต่อ</td>
                        <td>กลุ่มงานที่ส่งต่อ</td>
                        <td>
                            <center><i class='fa fa-print fa-2x' style='color:#84FFFF'></i></center>
                        </td>
                        <td><i class="fa fa-hotel" style="font-size:40px;color:#84FFFF"></i></td>
                    </tr>
                </thead>
                <tbody style="font-family:sarabun;font-size:1.0em; font-weight:normal;">
                    <?php
				$i=0;
                $sql="
                SELECT 
                * 
                FROM v_rf_detail 
                WHERE hosp_recive_rem='1'  AND rf_hospital = '$hcode'  AND  end_refer_end='N' AND rf_status='4' Order by rf_id DESC";
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
                    //     1. อนุมัติโดยหัวหน้าแผนก
                    //     2.อนุมัติ Auto
                    //     3.ออกเลข Refer 
                    //     4.ตอบรับ Refer 
                    
                    IF($rs['rf_status']=='0'){
                        $f = 'รออนุมัติ';
                    }else{ 
                        if($rs['rf_status']=='1' && $rs['rf_no_refer']==''){      
                            $f = 'หน.อนมัติ';
                        }else{
                            if($rs['rf_status']=='2' && $rs['rf_no_refer']==''){      
                                $f = 'อนุมัติ Auto';
                            }else{
                                if($rs['rf_status']=='3' && $rs['rf_no_refer']<>''){   
                                    $f = 'รอปลายทาง';
                                }else{
                                    if($rs['rf_status']=='4' && $rs['rf_no_refer']<>'') {
                                        if($rs['hosp_recive_status']=='Y'){
                                            if($rs['hosp_recive_rem']=='1'){
                                                $f='Waiting Refer';
                                            }else{
                                                if($rs['hosp_recive_rem']=='2'){
                                                    $f='ปฎิเสธรับ';
                                                }
                                            }
                                        }
                                    }else{
                                        if($rs['rf_status']=='5'){
                                            $f='Refer Success';
                                        }
                                    }
                                }   
                            }  
                        }
                    }
				   ?>
                    <?php
                $st='';
                // if($rs['rf_status']=='4') {
                //     $st="color:#64A70B;font-weight:300";
                // }else{
                //     $st="color:#006064;font-weight:300;";
                // }
                ?>
                    <!-- <tr style=<?php echo $st;?>> -->
                    <tr>
                        <td>
                            <center>
                                <?php  $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                            </center>
                        </td>
                        <?php
                        if($did==null) {?>
                        <td style="width:13%;">
                            <?php echo $rs['rf_no_refer']; ?>
                        </td>
                        <?php
                            }
                            ?>
                        <td><?php echo $rs['rf_date']; ?></td>
                        <td><?php echo $rs['rf_time'];?> </td>
                        <td>
                            <center>
                                <?php
                            if($rs['rf_rfev']<>'')
                            {
                                echo $rs['rfchar'];
                            }
                            else
                            {
                                echo 'ไม่ได้ระบุ';
                            }
                            ?>
                            </center>
                        </td>
                        <td><?php echo $rs['rf_hn']; ?></td>
                        <td style="widht:10%;"><?php echo $rfpatients; ?></td>
                        <td>
                            <center><?php echo $rs['rf_sex']; ?></center>
                        </td>
                        <td>
                            <center><?php echo $age; ?></center>
                        </td>
                        <td>
                            <?php echo $rs['hossendto_name']; ?>
                        </td>
                        <!-- <a href="sys_hycall_send_refer.php?sid='.$rs['rf_id'].' "   -->
                        <td style="widht:10%;">
                            <?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                        <td><?php echo $rs['m_depname']; ?></td>
                        <td style="width:5%;">
                            <div class="dropdown">
                                <button class="btn btn-" style="<?php echo $st;?>" dropdown-toggle" type="button"
                                    data-toggle="dropdown">สำหรับพิมพ์
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="print_refer_out04.php?id=<?php echo $rs['rf_id'];?> &hos=<?php echo $hp; ?>"
                                            target=_blank><i class="fa fa-print" style='color: red'></i>
                                            สายรัดข้อมือคนไข้ Refer
                                        </a>
                                    </li>

                                    <li>
                                        <a href="print_refer_out01.php?id=<?php echo $rs['rf_id'];?>" target=_blank><i
                                                class="fa fa-print" style='color: blue'></i>
                                            สลิป ผู้ป่วยส่งรักษาต่อ
                                        </a>
                                    </li>
                                    <li><a href="print_refer_out02.php?id=<?php echo $rs['rf_id'];?>" target=_blank><i
                                                class="fa fa-print" style='color: blue'></i>
                                            ใบ Refer ผู้ป่วยส่งรักษาต่อ</a></li>
                                    <li><a href="print_refer_out03.php?id=<?php echo $rs['rf_id'];?>" target=_blank><i
                                                class="fa fa-print" style='color: blue'></i>
                                            ขอนุญาตใช้รถพยาบาล</a></li>
                                    <li><a href="print_refer_out04.php?id=<?php echo $rs['rf_id'];?>" target=_blank><i
                                                class="fa fa-print" style='color: blue'></i>
                                            รับแจ้งขอ Refer ผู้ป่วย</a></li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <center>
                                <?php
                                    if($rs['rf_status']=='1'){
                                        echo '<a href="#" class="btn btn-danger btn-grad"  disabled
                                                        style="font-weight:400;font-size:16px;width:100px;">'.$f.'
                                                 </a>';
                                    }else{
                                        if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']=='1' && $rs['rf_status']=='4')
                                        {
                                            ?>
                                <?php
                                            echo '<a href="sys_hycall_send_refer.php?sid='.$rs['rf_id'].' " class="btn btn-" 
                                            style="background-color:#B71C1C;color:#EDE7F6;font-weight:normal;font-size:16px;width:100px;">'.$f.'
                                            </a>';
                                        }else{
                                                echo '<a href="#" class="text text-success text-grad btn btn-"  
                                                style="background-color:#1B5E20;color:#EDE7F6;font-weight:normal;font-size:16px;width:100px;">'.$f.'
                                                </a>';
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
    <script>
    $(".dropdown-menu li a").click(function() {
        var selText = $(this).text();
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText +
            ' <span class="caret"></span>');
    });
    </script>

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
    <!---END MODAL APPROVE -->

    <script type="text/javascript">
    $(document).ready(function() {
        $('#adataTableb').dataTable({
            "lengthMenu": [
                [20, 40, 60, 80, -1],
                [20, 40, 60, 80, "All"]
            ],
        });
    });
    </script>
</body>

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

<?php include("sys_hycall_footer.php"); ?>

</html>