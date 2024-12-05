<?php
	require_once('./db/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="refresh" content="180">
    <title>E-refer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"> </script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>
</head>
<script>
    var elem = document.documentElement;

function openFullscreen() {
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) {
        /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) {
        /* IE11 */
        elem.msRequestFullscreen();
    }
}

function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) {
        /* Safari */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        /* IE11 */
        document.msExitFullscreen();
    }
}
</script>
<?php
    require_once("./db/connection.php");
    require_once('./db/connect_pmk.php');
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
<style>
table {
    font-family: 'sarabun';
    font-size: 19px;
}
</style>
<?php
require_once('main_top_panel_head.php');
// include('main_top_menu_session.php');
?>
<?php     
        require_once ("main_script.php")
?>

<body>
    <div class="contaier-fluid">
        <div class="mast-heade justify-content-md-center" style="margin: 2px 10px 2px;padding: 2px 2px 2px;">
            <table id="dataTable" class="table table-bordered table-condensed" role="grid"
                style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;font-family: 'sarabun'; margin-top:0px;background-color:#F2F4F4"
                ; white-space: word-wrap: break-word; cellspacing="0">
                <thead style="font-family: 'sarabun'; margin-top:0px;background-color:#367E18;color:#F1F8E9">
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
                        <td>หน่วยงาน</th>
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
                    </tr>
                </thead>
                <tbody style="font-family:sarabun;font-size:16px; background-color:#b9cfed; colo:#01295c;">

                    <!-- ตรวจข้อมูลการ Refer -->
                    <?php
                    $i=0;
                        $sql="
                        SELECT *
                        FROM v_rf_detail 
                        WHERE rf_date = '$d_end' 
                        Order by rf_id DESC";

                        $query=mysqli_query($conn,$sql);
				$i=1;
                $f = '';
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
                    //     0. รออนมัติ
                    //     1. อนุมัติโดยหัวหน้าแผนก
                    //     2.อนุมัติ Auto
                    //     3.ออกเลข Refer 
                    //     4.ตอบรับ Refer 

                    $cl ='#229443';
                    if($rs['expire_group']=='U')  {
                        $f='Unapproved ';
                        $cl ='#bb3030';
                    }else{
                        if($rs['expire_group']=='A')  {
                            $f='Approved ';
                        }else{
                            if($rs['expire_group']=='C')  {
                                $f='Cancelled';
                                $cl ='#bb3030';
                            }else{
                                $f='In Progress';     
                                $cl ='#fb9b41';
                            }
                        }
                    }
                    
					//   ค้นหารายชื่อผู้ป่วย กรณีไม่มีชื่อในตาราง
					if($rs['rf_patients']=='')
					{
						$vpl="
						SELECT PRENAME,NAME,SURNAME FROM v_patients WHERE HN='$rfhn' ";
						$objParse = oci_parse($objConnect, $vpl);  
						oci_execute ($objParse,OCI_DEFAULT); 
						while($objResult = oci_fetch_array($objParse,OCI_BOTH)) 
						{ 
							$rfpatients=$objResult['PRENAME'].''.$objResult['NAME'].'  '.$objResult['SURNAME'];
						}                                                          
                    }
                    ?>
                    <tr>
                        <td>
                            <center>
                                <?php $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
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
                            <?php echo $rs['rfevent']; ?>
                        </td>
                        <td><?php echo $rs['rf_placename']; ?></td>
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
                             $rs['hosp_recive_rem']=='2'        = ปฎิเสธการ Refer   -->

                        <td>
                            <center>
                                <?php echo '<a href="./my_ward/index.php" target="_blank" class="btn btn-" style="background-color:'.$cl.';color:#f6f0f7;font-size:18px; " btn-grad"
                                    font-weight:bold;width:100px;">'.$f.'
                                </a>';
                                ?>
                            </center>
                        </td>
                    </tr>
                    <?php 
                        }
                        ?>
                </tbody>
            </table>
            <script type="text/javascript" src="assets/js/jquery.js"></script>
            <script type="text/javascript" src="assets/js/jquery.min.js"></script>
            <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
            <script type="text/javascript" src="assets/lib/moment/min/moment.min.js"></script>
            <!--TABLE  -->
            <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
            <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
            <script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js"></script>
            <!--Bootstrap -->
            <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- Screenfull -->
            <script type="text/javascript" src="assets/js/screenfull.min.js"></script>
            <script>
            $(document).ready(function() {
                $('#dataTable').dataTable();
            });
            </script>
        </div>
</body>

</html>