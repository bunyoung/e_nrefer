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
<<?php
require_once("db/connection.php");
require_once('db/connect_pmk.php');
?> <?php
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
?> <?php
if(!isset($_SESSION)) {  
    session_start(); 
 }

 #ตรวจสอบสิทธิการเข้าใช้งาน
if ($_SESSION['hosname']=="") 
{
    echo (
        "<SCRIPT LANGUAGE='JavaScript'>
            window.alert('ไม่พบสิทธิ [admin]')
            window.location.href='dashboard.php';
</SCRIPT>");
}
?> <?php
if($_POST['EDIT']) {
    $idf=$_POST['rfid'];
    $rfn=$_POST['norf'];
    $sqlu="UPDATE rf_detail SET rf_no_refer='$rfn',rf_linestatus='1' 
    WHERE rf_id='$idf'; ";
    $result_sqlu=mysqli_query($conn,$sqlu);
    if ($result_sqlu== TRUE) {
        $error1 = ' UPDATE successfully ';
        $error2 = ' ออกเลข Refer เลขที่ '.$idf.' เรียบร้อยแล้ว';
    }else{
        $error1 = ' UPDATE ERROR ';
        $error2 = ' ไม่สามารถดำเนินการได้ กรุณาติดต่อผู้ดูแลระบบ';
    }
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('".$error1.$error2."')
    </SCRIPT>");
}
?> <?php
$did=null;
if($did==null){
    $did=$_GET['id'];
}
include('main_top_panel_head.php');
include('main_top_menu_session.php');
?> <style>
    table {
    font-family: 'sarabun';
    font-size: 18px;
    }
    </style>
    <html class="no-js">

    <head>
        <?php     
        include ("main_script.php")
    ?>
    </head>


    <body class="Full-Width">
        <!-- <div class="outer"> -->
        <div class="alert alert-info" style="font-family: 'sarabun'; font-size: 19px;">
            <form class="form-inline" action="sys_hycall_monitor_now.php" name="ins_fund_main" method="POST" target="">
                <span>
                    <i class="fa fa-clock-o">
                    </i>&nbsp;&nbsp; ค้นหาข้อมูล ระหว่างวันที่:
                    <input data-provide="datepicker" data-date-language="th-th" type="text" name="d_start"
                        value="<?php echo $d_start; ?>" class="form-control autotab" placeholder="วัน / เดือน / ปี" />
                    ถึงวันที่:
                    <input data-provide="datepicker" data-date-language="th-th" type="text" name="d_end"
                        value="<?php 	echo $d_end; ?>" class="form-control autotab" placeholder="วัน / เดือน / ปี" />
                    <button type="submit" class="btn btn-info btn-grad" value="submit"> แสดงข้อมูล </button>
                    <span>
            </form>
        </div>

        <table class="table table-bordered" id="example">
            <thead>
                <tr class="info">
                    <th>ลำดับ</th>
                    <th>Ref No.</th>
                    <th>วันที่</th>
                    <th>เวลา</th>
                    <th>ประเภทส่งต่อ</th>
                    <th>HN</th>
                    <th>ชื่อ - สกุล</th>
                    <th>เพศ</th>
                    <th>อายุ (ปี)</th>
                    <th>รพ. ปลายทาง</th>
                    <th>แพทย์ผู้ส่งต่อ</th>
                    <th>กลุ่มงานที่ส่งต่อ</th>
                    <th>สถานะอนุมัติ</th>
                    <th>ขั้นตอนส่งต่อ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
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
                <tr>
                    <td>
                        <center>
                            <?php    $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                        </center>
                    <td>
                        <?php echo $rs['rf_no_refer']; ?>
                    </td>

                    <td><?php echo $rs['rf_date']; ?></td>
                    <td><?php echo 'เวลา';?> </td>
                    <td><a class="text text-danger"><?php echo $rs['rfevent']; ?></a></td>
                    <td><?php echo $rs['rf_hn']; ?></td>
                    <td><?php echo $rfpatients; ?></td>
                    <td><?php echo $rs['rf_sex']; ?></td>
                    <td><?php echo $age; ?></td>
                    <td>
                        <?php echo $rs['hossendto_name']; ?>
                    </td>
                    <td><?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                    <td><?php echo $rs['m_depname']; ?></td>
                    </td>
                    <td>
                        <?php 
						   IF($rs['rf_hotlevel']=='1'){
							   // echo'<a href="sys_refer_send_to_line.php?id='.$rs['rf_id'].'">';
							   echo '<a href="#" class="btn btn-warning" style="font-size:19px;" disabled>อนุมัติอัตโนมัติ </a>' ;
						   }else{    
								   echo '<a href="#myModal_create_no_book" data-toggle="modal" data-id="'.$rs['rf_id'].'" 
								   class="btn btn-primary btn-grad" style="font-size:19px;" > รออนุมัติ หน.แผนก</a>';
						   }
						   ?>
                    </td>

                    <td>
                        <?php 
						   IF($rs['rf_hotlevel']=='1'){
							   echo '<a href="#myModal_create_no_book" data-toggle="modal" data-id="'.$rs['rf_id'].'" 
										class="btn btn-primary btn-grad" style="font-size:19px;">';
							   }else{    
								   echo'<a href="sys_refer_send_to_line.php?id='.$rs['rf_id'].'" 
										   class="btn btn-warning btn-grad" style="font-size:19px">';
							   }

							   IF($rs['rf_hotlevel']=='1'){
								   echo '----------------' ;
							   }else{
								   echo 'รอ ออกเลข Refer';
						   }  
						   echo'</a>'; 
						   ?>
                    </td>
                    <td><?php echo $age; ?></td>
                    <td><?php echo $age; ?></td>

                </tr>
            </tbody>
            <?php } ?>
        </table>
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