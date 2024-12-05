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

    <!-- นำเข้า  CSS จาก Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- นำเข้า  CSS จาก dataTables -->
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">

    <!-- นำเข้า  Javascript จาก  Jquery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- นำเข้า  Javascript  จาก   dataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js">
    </script>

    <script type="text/javascript">
    //คำสั่ง Jquery เริ่มทำงาน เมื่อ โหลดหน้า Page เสร็จ 
    $(function() {
        //กำหนดให้  Plug-in dataTable ทำงาน ใน ตาราง Html ที่มี id เท่ากับ example
        $('#example').dataTable();
    });
    </script>
</head>
<style>
.modal-body {
    height: 350px;
    overflow-y: auto;
}

@media (min-height: 500px) {
    .modal-body {
        height: 400px;
    }
}

@media (min-height: 800px) {
    .modal-body {
        height: 600px;
    }
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
    $_SESSION['ih'] = 'แสดงคนไข้ Refer';
 }
 $hcode=$_SESSION['hcode'];

 #ตรวจสอบสิทธิการเข้าใช้งาน
if ($_SESSION['hosname']=="") 
{
    echo (
        "<SCRIPT LANGUAGE='JavaScript'>
            window.alert('ไม่พบสิทธิ [admin]')
            window.location.href='dashboard.php';
        </SCRIPT>");
}
?>
<style>
table {
    font-family: 'sarabun';
    font-size: 18px;
}
</style>
<?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
?>
<?php     
        include ("main_script.php")
?>

<body class="Full-Width">
    <div class="row" style="background-color:#F2F4F4">
        <div class="col-md-1">
            <?php
        include('sys_hycall_center_now_smenu.php');
        ?>
        </div>
        <div class="col-md-11" style="font-family: 'sarabun'; margin-top:0px;background-color:#F2F4F4">
            <div class="table-responsive-sm">
                <?php
                        include('sys_hycall_monitor_shead.php');
                        ?>

                <table id="example" class="table table-sm table-bordered" style="width:100%;">
                    <thead style="background-color:#004D40;color:#F7F5F2;font-family:sarabun;font-size:19px;">
                        <tr align="center">
                            <td>#</td>
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
                            <td>สถานะ <br>ขั้นตอนข้อมูล </td>
                            <!-- <td>ขั้นตอนส่งต่อ</td> -->
                            <?php
                                if($did==null) {
                                    echo '<td><center>แก้ไข</center></td> 
                                    <td><center>ลบ</center></td>';
                                }elseif($did<>null){
                                    echo '<td style="background-color:#E74C3C;color:#ffff;"><center>Approve <br>Refer</center></td>';
                                }
                                ?>
                        </tr>
                    </thead>
                    <tbody style="font-family:sarabun;font-size:16px; background-color:#b9cfed; colo:#01295c;">
                        <?php
				$i=0;
				if($did<>null)
				{
					$sql="
					SELECT 
					* 
					FROM v_rf_detail 
					WHERE rf_date between '$d_start' AND '$d_end' AND 
								dochead_code = '$did'
					Order by rf_id DESC";
				}else{
					$sql="
					SELECT 
					* 
					FROM v_rf_detail 
					WHERE rf_date between '$d_start' AND '$d_end' Order by rf_id DESC";
				}
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
                                                        $f='เตรียมส่งคนไข้';
                                                    }else{
                                                        if($rs['hosp_recive_rem']=='2'){
                                                            $f='ปฎิเสธการรับ';
                                                        }
                                                    }
                                                }
                                            }
                                        }   
                                    }  
                                }
                            }
                        //  }                                                          
					   ?>
                        <?php
                        $st='';
                        if($rs['rf_rfev']=='1') {
                            $st="backgrond-color:#A2D9CE;color:#D5F5E3;font-weight:400;";
                        }
                        if($rs['rf_no_refer']<>'') {
                            $st="background-color:#F5CBA7;color:#145A32;font-weight:400;";
                        }    
                        if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']=='1') {
                            $t="background-color:#E9F7EF;color:#145A32;font-weight:400;";
                        }    
                        if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']=='2') {
                            $st="background-color:#FAE5D3;color:#145A32;font-weight:400;";
                        }
                        ?>
                        <tr style=<?php echo $st;?>>
                            <td>
                                <center>
                                    <?php
                            if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']=='1') 
                            {
                                echo '<i class="fa fa-ambulance" aria-hidden="true" style="color:#0B5345;"></i>';
                            }else{
                                if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']<>'1') {
                                    echo '<i class="fa fa-ambulance" aria-hidden="true" style="color:#82E0AA;"></i>';
                                }
                            }
                            ?>
                                </center>
                            </td>
                            <td>
                                <center>
                                    <?php    $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                                </center>
                            </td>
                            <?php
                            if($did==null) {?> <td> <?php echo $rs['rf_no_refer']; ?></td>
                            <?php
                            }
                            ?>
                            <td><?php echo $rs['rf_date']; ?></td>
                            <td><?php echo $rs['rf_time'];?> </td>
                            <td>
                                <center>
                                    <?php
                                    if($rs['rf_rfev']=='1')
                                    {
                                    ?>
                                    <a href="#" class="text  text-primary" style="width:100px;">
                                        <?php echo $rs['rfevent']; ?>
                                    </a>
                                    <?php
                                    }else{
                                        if($rs['rf_rfev']=='2')
                                        {
                                        ?>
                                    <a href="#" class="text text-warning" style="width:100px;">
                                        <?php echo $rs['rfevent']; ?>
                                    </a>
                                    <?php
                                }else{
                                    ?>
                                    <a href="#" class="text text-danger" style="width:100px;">
                                        <?php echo 'ไม่ระบุประเภท'; ?>
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                                </center>
                            </td>
                            <td><?php echo $rs['rf_hn']; ?></td>
                            <td><?php echo $rfpatients; ?></td>
                            <td>
                                <center><?php echo $rs['rf_sex']; ?></center>
                            </td>
                            <td>
                                <center><?php echo $age; ?></center>
                            </td>
                            <td>
                                <?php echo $rs['hossendto_name']; ?>
                            </td>
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
                                                        style="font-weight:bold;font-size:16px;width:100px;">'.$f.'
                                                    </a>';
                                    }else{
                                        if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']=='1'){
                                            echo '<a href="#myModal_approve_send_refer"  data-toggle="modal" data-id="'.$rs['rf_id'].'"  
                                                         class="btn btn-danger btn-grad" 
                                                          style="font-weight:bold;font-size:16px;width:100px;">'.$f.'
                                                       </a>';
                                        }else{
                                            if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']=='2'){
                                                echo '<a href="#" class="btn btn-warning btn-grad" 
                                                          style="font-weight:bold;font-size:16px;width:100px;">'.$f.'
                                                       </a>';
                                            }else{
                                                echo '<a href="#" class="btn btn-success btn-grad" 
                                                  style="font-weight:bold;font-size:16px;width:100px;">'.$f.'
                                             </a>';
                                            }           
                                        }
                                    }
                                    ?>
                                </center>
                            </td>
                            <!--  ส่้นสุดส่วนช่องขั้นตอนมูล-->

                            <!--  ส่วนการแก้ไข / ลบ-->
                            <?php
                            if($did==null) 
                            {
                                if($rs['rf_rfev']=='1')
                                {
                                    echo'<td>
                                            <center>
                                                    <a href="#" class="btn btn-danger btn-grad">
                                                        EDIT</center></td>';
                                    echo'<td>
                                                <center><a href="#" class="btn btn-danger btn-grad"><i class="fa fa-trash" aria-hidden="true"></i>
                                                </center></td>';
                                }else{
                                    echo'<td>
                                            <center>
                                                    <a href="#" class="btn btn-warning btn-grad">
                                                        EDIT</center></td>';
                                    echo'<td>
                                                <center><a href="#" class="btn btn-danger btn-grad" ><i class="fa fa-trash" aria-hidden="true"></i>
                                                </center></td>';
                                }    
                            }else{
                                if($did <> null && $rs['rf_status']<>'1' ){
                                    echo'<td style="background-color:#F4ECF7;color:#34495E;">
                                    <center>
                                    <a href="#myModal_approve_confirm_refer" data-toggle="modal" data-id="'.$rs['rf_id'].'" 
                                        class="btn btn-danger"
                                    style="color:#ffff;font-weight:bold;font-size:16px">
                                        ยืนยันอนุม้ติ
                                    </a></center></td>';
                                }else{
                                    if($did <> null && $rs['rf_status']='1' ){
                                        echo'<td style="background-color:#F4ECF7;color:#34495E;">
                                        <center>
                                        <a href="#" 
                                            class="btn btn-danger"
                                        style="color:#ffff;font-weight:bold;font-size:16px" disabled>
                                            ยืนยันอนุม้ติ
                                        </a></center></td>';  
                                    }
                                }                                
                           }                        
                           ?>
                            <!--  สิ้นสุดส่วนการแก้ไข / ลบ-->

                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-sm-1">
                        <label for="">อธิบายการ Refer</label>
                    </div>
                    <div class="col-sm-1">
                        <label for=""><i class="fa fa-square-o" aria-hidden="true"
                                style="background-color:#2196F3;font-size:16px;"> </i>
                            Refer Back
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <label for=""><i class="fa fa-square-o" aria-hidden="true"
                                style="background-color:#FF8A65;font-size:16px;"></i>
                            ออกเลขแล้ว
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <label for=""><i class="fa fa-square-o" aria-hidden="true"
                                style="background-color:#138D75;font-size:16px;"></i>
                            ปลายทาง
                        </label>
                    </div>

                    <div class="col-sm-2">
                        <label for=""><i class="fa fa-square-o" aria-hidden="true"
                                style="background-color:black;font-size:16px;"></i>
                            ระหว่างดำเนินการ
                        </label>
                    </div>
                </div>
            </div>
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
                <div class="modal-dialog">
                    <!-- role="document"> -->
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

            <!-- <script type="text/javascript">
            $(document).ready(function() {
                $('#dataTable').dataTable({
                    "oLanguage": {
                        "sSearch": "ค้นหา:"
                    }
                });
            });
            </script> -->

</body>

</html>

<!-- การ ปิด การทำงาน ของปุ่ม sort -->
<!-- <tr class="info">
		<th>#</th>
	        <th>first name</th>
	        <th>last name</th>
	        <th>email</th>
	        <th class='no-sort'>gender</th><-- ปิดการ sort -->
<!-- </tr> -->

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

<!-- การ ปิด การ แสดงตัวเลือก  Show entries -->
<!-- $(".dataTables_length").hide(); -->