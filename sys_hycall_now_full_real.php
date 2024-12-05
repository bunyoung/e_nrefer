<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Refer</title>
    <?php
    require_once("./db/connection.php");
?>

    <?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
//  $hcode=$_SESSION['hcode'];
 $hcode='10682';

 #ตรวจสอบสิทธิการเข้าใช้งาน
 if ($hcode=="") 
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
    <?php
include('main_top_panel_head.php');
include('main_script.php');
include('main_top_menu_session.php');
?>
    <?php

$pid = $_REQUEST['id'];

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$dend=$date_curr_dmy_defult;

$d_start = $_POST['d_start']; $d_end = $_POST['d_end'];
?>
    <!-- calll SQL -->
    <html class="no-js">
    <div class="" alt="">

<body>
    <script>
    $(document).ready(function() {
        $("#export_to_excel").click(function() {
            $("#dataTable-t").table2excel({
                exclude: ".noExl",
                name: "E-Hy center",
                filename: "การ Refer ผู้ป่วย ตั้งแต่_<?php echo $d_start; ?>_ถึงวันที่_<?php echo $d_end; ?>.xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
    </script>
    <div class="box success">
        <header>
            <div class="icons">
                <button id="export_to_excel" class="btn btn-success btn-xs btn-grad">
                    <i class="fa fa-file-excel-o" style="font-size:18px;"></i></button>
            </div>
            <h5 style="padding:17px 10px 15px 15px;font-size:19px;">สรุปงานการ Refer <a class="text-primary"> </a>
                ประจำเดือน
                <a class="text-default"><?php 
                        echo $d_start;
                        echo ' - ' ;
                        echo $d_end;
                    ?>
                </a>
            </h5>
        </header>
        <div class="container-fluid" style="margin: 2px 2px 2px;padding: 2px 2px 2px;">
            <div class="justify-content-md-center">
                <table id="dataTable-t" class="display dataTable" style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll;  white-space: word-wrap: break-word;font-weight:normal;
                           font-family:K2D;font-size:18px;">
                    <thead style="background-color:#96d9df;color:#442266">
                        <tr align="center" style="font-weight:bold;font-size:20px;">
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
                            <td>การรักษาปัจจุบัน</td>
                            <td>แผนกการรักษาแจ้งปลายทาง</td>
                            <td>ประวัติผู้ป่วยปัจจุบัน </td>
                            <td>สถานะ <br>ขั้นตอนข้อมูล </td>
                        </tr>
                    </thead>
                    <tbody style="font-family:sarabun;font-size:16px; background-color:#b9cfed; colo:#01295c;">

                        <!-- ตรวจข้อมูลการ Refer -->
                        <?php
                    $i=0;
                        $sql="SELECT * FROM v_rf_detail 
                        WHERE substr(rf_date,1,2) BETWEEN substr('$d_start',1,2)  AND substr('$d_end',1,2) AND 
                                      substr(rf_date,4,2) BETWEEN substr('$d_start',4,2)  AND substr('$d_end',4,2) AND  
								      substr(rf_date,7,4) BETWEEN substr('$d_start',7,4)  AND substr('$d_end',7,4) 
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
                   
                    $f='Success';
                    
					//   ค้นหารายชื่อผู้ป่วย กรณีไม่มีชื่อในตาราง
					// if($rs['rf_patients']=='')
					// {
					// 	$vpl="
					// 	SELECT distinct(NAME,PRENAME),SURNAME 
					// 	FROM v_patients 
					// 	WHERE HN='$rfhn' ";
					// 	$objParse = oci_parse($objConnect, $vpl);  
					// 	oci_execute ($objParse,OCI_DEFAULT); 
					// 	while($objResult = oci_fetch_array($objParse,OCI_BOTH)) 
					// 	{ 
					// 		$rfpatients=$objResult['PRENAME'].''.$objResult['NAME'].'  '.$objResult['SURNAME'];
					// 	}                                                          
                    // }
                    ?>
                        <?php
                    if($rs['rf_rfev']=='1') 
                    {?> <tr style="backgrond-color:#A2D9CE;color:#117A65;font-weight:400;"> <?php }
                    if($rs['rf_no_refer']<>'') {?>
                        <tr style="background-color:#E8F8F5;color:#145A32;font-weight:400;"><?php }
                    if($rs['hosp_recive_status']=='Y') {?>
                        <tr style="color:#1D8348;font-weight:400; background-color:#D5F5E3;"><?php }
                    ?>

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
                            <td><?php echo $rs['rf_his_takecare_now']; ?></td>
                            <td><?php echo $rs['rf_exp_takecare_hosp_end']; ?></td>
                            <td><?php echo $rs['rf_his_patient']; ?></td>
                           
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
                                                         class="btn btn-success btn-grad" 
                                                          style="font-weight:bold;font-size:16px;width:100px;">'.$f.'
                                                       </a>';
                                        }else{
                                            if($rs['hosp_recive_status']=='Y' && $rs['hosp_recive_rem']=='2'){
                                                echo '<a href="#" class="btn btn-success btn-grad" 
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
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable-t').dataTable({
            "lengthMenu": [
                ["All", 80, 100, -1],
                ["All"
                    80, 100, 200
                ]
            ],
            "ordering": false,
        });
    });
    </script>
</body>

</html>