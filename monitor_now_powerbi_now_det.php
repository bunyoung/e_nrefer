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

<body style="font-family:K2D;font-size:18px;margin-top:0px;">
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
        <!-- <div id="collapse4" class="body" style="overflow:scroll"> -->
        <div class="container-fluid">
            <div class="justify-content-md-center">
                <table id="dataTable-t" style="width:100%;  font-family:K2D;font-size:16px;">
                    <thead style="background-color:#96d9df;color:#442266">
                        <tr align="center" style="font-weight:bold;font-size:16px;">
                            <td>No.</td>
                            <td>Ref No.</td>
                            <td>HN</td>
                            <td>Name</td>
                            <td>Requested Date</td>
                            <td>Edited Date</td>
                            <td>Received Date</td>
                            <td>Departed Date</td>
                            <td>Arrived Date</td>
                            <td>Refer Type</td>
                            <td>ความเร่งด่วน</td>
                            <td>Service<br>Unit</td>
                            <td>Medical <br> Rights</td>
                            <td>Destination</td>
                            <td>สถานพยาบาล<br>เรียกเก็บ</td>
                            <td>ICD-10</td>
                            <td>วันหมดอายุ</td>
                            <td style="width:10%;">Doctor<br>Refer</td>
                            <td>Department</td>
                            <td>ความพึงพอใจ</td>
                            <td>ระดับ</td>
                            <td>หมายเหตุ</td>
                            <td>เหตุผล <br>Refer Out</td>
                            <td>เพิ่มเติม <br> Refer Out</td>
                            <td>Final Status</td>
                            <td>Paid</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
        $sql="SELECT * FROM v_rf_detail 
                    WHERE rf_date='$dend'
                                order by rf_time DESC";
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
                        $hp = $rs['rf_hos_send_to'];
                        $rc_date = $rs['hosp_recive_date'];
                        $rc_time= $rs['hosp_recive_time'];
                        IF($rs['rf_status']=='0'){
                            $f = 'รออนุมัติ';
                        } 
                        if($rs['rf_status']=='1'){      
                            $f = 'รอตอบรับ';
                        }
                        if($rs['rf_status']=='2'){      
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
                        <tr style=color:#006064;font-weight:400;>
                            <td>
                                <center>
                                    <?php  $n=$i++; if(strlen($n)=='1'){echo '00';echo $n;}else if(strlen($n)=='2'){echo '0';echo $n;}else{echo $n;}?>
                                </center>
                            </td>
                            <td>
                                <?php echo $rs['norf']; ?>
                            </td>
                            <td>
                                <?php echo $rs['rf_hn']; ?>
                            </td>
                            <td>
                                <?php echo $rs['rf_patients']; ?>
                            </td>

                            <!-- ปรับวันที่ -->
                            <?php
                        $eyy = substr($rs['rf_expire_date'],0,5)+543;
                        $emm =substr($rs['rf_expire_date'],5,2);
                        $edd =substr($rs['rf_expire_date'],8,2);
                        $end_rec_sys = ($edd.'/'.$emm.'/'.$eyy);
                        $ett = substr($rs['rf_expire_date'],11,8);
                        $s_dd = substr($rs['sento_hos_date'],0,2).'/';
                        $s_mm= substr($rs['sento_hos_date'],3,2).'/';
                        $s_yy = substr($rs['sento_hos_date'],6,4)+543;
                        $shd =$s_dd.$s_mm.$s_yy;
                        if($rs['sento_hos_date']<>''){
                            $sthd = $shd;
                        }else{
                            $shd='';
                        }
                        ?>
                            <td align="center"><?php echo $rs['rf_date'];?><br> <?php echo $rs['rf_time']; ?></td>
                            <td align="center"><?php echo $rs['rf_date'];?><br> <?php echo $rs['rf_first_edit']; ?>
                            </td>
                            <td align="center"><?php echo $rs['hosp_recive_date'];?>
                                <br><?php echo $rs['hosp_recive_time'];?>
                            </td>
                            <td align="center"><?php echo $sthd;?><br><?php echo $rs['sento_hos_time'];?> </td>
                            <td align="center">
                                <?php echo $rs['end_rec_date'];?> <br> <?php echo $rs['end_rec_time'];?>
                            </td>
                            <td><?php echo $rs['rfchar'] ;?></td>
                            <td><?php echo $rs['rffast'] ;?></td>
                            <td><?php echo $rs['rf_placename'];?> </td>
                            <td>
                                <center><?php echo $rs['pttypename']; ?></center>
                            </td>
                            <td><?php echo $rs['hossendto_name']; ?></td>
                            <td><?php echo $rs['rf_place_money'];?></td>
                            <td><?php echo $rs['rf_icd10a'];?></td>
                            <td><?php echo $end_rec_sys; ?></td>
                            <td style="width:10%">
                                <?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                            </td>
                            <td><?php echo $rs['m_depname']; ?></td>
                            <td><?php echo $rs['satis']; ?></td>
                            <td><?php echo $rs['level']; ?></td>
                            <td><?php echo $rs['rf_remarkc']; ?></td>
                            <td><?php echo $rs['rf_name']; ?></td>
                            <td><?php echo $rs['rf_remchar']; ?></td>
                            <td>
                                <center><?php echo $rs['rf_status']; ?></center>
                            </td>
                            <td>
                                <center><?php echo $rs['rf_paid']; ?></center>
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
            "ordering": true,
        });
    });
    </script>
</body>

</html>