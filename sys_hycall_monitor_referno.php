<?php
	include('./db/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>E-refer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
    </script>
</head>

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
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $_SESSION['ih'] = 'ออกเลข Refer';
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
<?php
$did=null;
if($did==null){
    $did=$_GET['id'];
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
    <div class="row">
        <div class="col-md-1" >
            <?php
                    include('sys_hycall_center_now_smenu.php');
                ?>
        </div>
        <div class="col-md-11">
            <div class="table-responsive-sm">
                <?php
            include('sys_hycall_monitor_shead.php');
            ?>
                <table id="dataTable" class="table table-sm table-bordered" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;width:100%;">
                    <thead style="background-color:#21325E;color:#F7F5F2;font-family:sarabun;font-size:18px;
                    box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
                        <tr>
                            <center>
                                <td>ลำดับ</td>
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
                                <td>แพทย์ผู้ส่งต่อ</td>
                                <td>กลุ่มงานที่ส่งต่อ</td>
                                <td style="background-color:#cc0000;color:#ffffff;">
                                    <center>
                                        ออกเลข Refer
                                    </center>
                                </td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ตรวจข้อมูลการ Refer -->
                        <?php
                        $i=0;
                        $sql="
                        SELECT * 
                        FROM v_rf_detail 
                        WHERE  rf_conf_doctor_id IN('1')
                                         AND rf_hospital='$hcode'
                                         AND rf_no_refer=''
                                         Order by rf_id DESC";
				$query=mysqli_query($conn,$sql);
                // สิ้นสุดการตรวจสอบ

				$i=1;
                $f = 'Auto';
				while($rs=mysqli_fetch_array($query)) {
					$year=substr($rs["rf_birthdate"],6,4);
					$month=substr($rs["rf_birthdate"],3,2);
					$date=substr($rs["rf_birthdate"],0,2);
					$day=$year."-".$month."-".$date;
					$date = date("Y-m-d");
					$age=($date - $day);
					$rfhn=$rs['rf_hn'];
					$rfpatients=$rs['rf_patients'];
                    if($rs['rf_rfev']=='1'){
                        $f='Auto';
                    }else{
                        $f='Manual';
                    }    
                    
					//   ค้นหารายชื่อผู้ป่วย กรณีไม่มีชื่อในตาราง
					if($rs['rf_patients']=='')
					{
						$vpl="
						SELECT PRENAME,NAME,SURNAME 
						FROM v_patients 
						WHERE HN='$rfhn' ";
						$objParse = oci_parse($objConnect, $vpl);  
						oci_execute ($objParse,OCI_DEFAULT); 
						while($objResult = oci_fetch_array($objParse,OCI_BOTH)) 
						{ 
							$rfpatients=$objResult['PRENAME'].''.$objResult['NAME'].'  '.$objResult['SURNAME'];
						}                                                          
						}
				?>
                        <tr style="font-family:sarabun;font-size:16px;">
                            <td>
                                <center>
                                    <?php    $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                                </center>
                            </td>
                            <td><?php echo $rs['rf_date']; ?></td>
                            <td><?php echo $rs['rf_time'];?> </td>
                            <td>
                                <center>
                                    <?php
                                    if($rs['rfevent']<>'')
                                    {
                                        ?>
                                    <a href="#" class="text text-info">
                                        <?php echo $rs['rfevent']; ?>
                                    </a>
                                    <?php
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

                            <?php
                            // rf_hotlevel =2 เป็นการ Refer Out, 3= เป็นการ Refer Back
                            if($rs['rf_rfev']=='1' || $rs['rf_status']=='0' &&  $rs['rf_no_refer']=='')
                            {
                                echo'<td>
                                    <center>
                                    <a href="#myModal_approve_no_refer" data-toggle="modal" data-id="'.$rs['rf_id'].'" class="btn btn-danger btn-grad" 
                                         style="color:white ;font-weight:bold;">
                                         ออกเลข REF</center></a></td>';
                            }else{
                                if($rs['rf_no_refer']<>'' )
                                {
                                    echo'<td>
                                        <center>
                                        <a href="#" class="text text-success" 
                                             style="color:green;font-weight:bold;">
                                             ออกเลข REFแล้ว</center></a></td>';
                                }       
                            }    
                        ?>
                        </tr>
                        <?php } ?>
                        </tbdody>
                </table>
            </div>

            <!---MODAL -->
            <script type="text/javascript">
            $(document).ready(function() {
                $('#myModal_approve_no_refer').on('show.bs.modal', function(e) {
                    var rid = $(e.relatedTarget).data('id');
                    $.ajax({
                        type: 'post',
                        url: 'sys_hycall_monitor_approve.php', //Here you will fetch records 
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

            <div class="modal fade" id="myModal_approve_no_refer" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;
                            </button>
                            <h5 class="modal-title">
                                <i class="fa fa-group">
                                </i> : ออกเลข Refer ให้กับคนไข้ Refer Out
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
                    "oLanguage": {
                        "sSearch": "ค้นหา:"
                    }
                });
            });
            </script>
</body>

</html>