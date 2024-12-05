<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Refer</title>
    <style>
    .badge-primary {
        color: #ebeef0;
        background-color: #B23CFD;
    }

    .badge-secondary {
        color: #ebeef0;
        background-color: #2abe74;
    }

    .badge-success {
        color: #ebeef0;
        background-color: #b9fd3c;
    }

    .badge-danger {
        color: #ebeef0;
        background-color: #e93e9c;
    }

    .badge-warning {
        color: #ebeef0;
        background-color: #5f3cfd;
    }

    .badge-info {
        color: #ebeef0;
        background-color: #fd3c46;
    }

    .badge-light {
        color: #ebeef0;
        background-color: #3cfdbd;
    }

    .badge-dark {
        color: #ebeef0;
        background-color: #064118;
    }
    </style>
</head>

<style>
.border {
    font-family: 'K2D';
    font-style: unset;
    display: block;
    padding: 10px 10px 10px 10px;
    width: AUTO;
    /* background: #651FFF; */
    font-size: 20px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}

.tab {
    font-family: 'K2D';
    font-size: 16px;
    overflow: hidden;
    background-color: #1e3a29;
    color: #fffcf1;
}

.tab a {
    color: #fffcf1;
}

.tab button:hover {
    background-color: #440099;
}

.tab button.active {
    background-color: #034638;
}
</style>

<?php
    require_once("./db/connection.php");
    require_once("./db/date_format.php");
?>
<?php
// if(!isset($_SESSION)) {  
//     session_start(); 
//  }
//  $hcode=$_SESSION['hcode'];
?>
<style>
table {
    font-family: 'K2D';
    font-size: 16px;
    letter-spacing: -1.01px;
    font-weight: 100px;
}
</style>
<?php 
include('main_script.php'); 
?>
<?php
#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult='01/' ;
# $date_start_m_defult=date('m/');
$date_start_m_defult='01/';
$date_start_y_defult=date('Y')+543 ;
$date_start_dmy_defult	= $date_start_d_defult.$date_start_m_defult.$date_start_y_defult;
// 01/m/y+543

$date_end_dm_defult=date('d/m/') ;
$date_end_y_defult=date('Y')+543 ;
$date_end_dmy_defult=$date_end_dm_defult.$date_end_y_defult;
// d/m/y+543

$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;

// วันที่ปัจจุบัน
$d_default=$date_curr_dmy_defult;

$d_start_post = @$_POST['d_start'];
$d_end_post = @$_POST['d_end'];
IF(!empty($d_start_post)){
$d_start = $d_start_post ;
}ELSE{
$d_start = $date_start_dmy_defult;
}
IF(!empty($d_end_post) ){
$d_end = $d_end_post ;
}ELSE{
$d_end = $date_end_dmy_defult;
}
$d_start_cal = substr($d_start,0,2).substr($d_start,3,2).substr($d_start,6,4) ;
$d_end_cal =  substr($d_end,0,2).substr($d_end,3,2).substr($d_end,6,4) ;
$date_m= $d_end;
?>

<!-- วันที่ปัจจุบัน -->

<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<?php require("main_top_panel_head_drug.php");?>
<?php require("main_top_menu_session_b.php");?>

<body style="font-family:K2D;font-size:18px;">
    <script>
    $(document).ready(function() {
        $("#export_to_excel").click(function() {
            $("#dataTable-druga").table2excel({
                exclude: ".noExl",
                name: "E-Hy center",
                filename: "ภาระกิจงานศูนย์เปลตั้งแต่_<?php echo $d_start; ?>_ถึงวันที่_<?php echo $d_end; ?>.xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });
        });
    });
    </script>
    <div class="outer bg-light lter">
        <div class="row-fluid">
            <div class="span12">
                <div class="alert alert-warning">
                    <form class="form-inline" action="sys_hycall_monitor_drug_a.php" name="ins_fund_main" method="POST">
                        <span>
                            <i class="fa fa-clock-o">
                            </i>&nbsp;&nbsp; ค้นหาข้อมูล ระหว่างวันที่:
                            <input data-provide="datepicker" data-date-language="th-th" type="text" name="d_start"
                                value="<?php 	echo $d_start; ?>" class="form-control autotab"
                                placeholder="วัน / เดือน / ปี ระหว่างวันที่" />
                            ถึงวันที่:
                            <input data-provide="datepicker" data-date-language="th-th" type="text" name="d_end"
                                value="<?php 	echo $d_end; ?>" class="form-control autotab"
                                placeholder="วัน / เดือน / ปี ถึงวันที่" />

                            <button type="submit" class="btn btn-info" value="submit"> แสดงข้อมูล
                            </button>
                        </span>
                    </form>
                </div>
            </div>
        </div>

        <div id="content">
            <div class="inner bg-light lter">
                <div class="box success">
                    <header>
                        <div class="icons">
                            <button id="export_to_excel" class="btn btn-success btn-xs btn-grad"> <i
                                    class="fa fa-file-excel-o"></i></button>
                        </div>
                        <h5>สรุปรายการยาที่จัดส่งให้ รพ.ที่รับ Refer
                            <a class="text-primary"> </a> ประจำเดือน
                            <a class="text-defaalt"><?php echo $d_start;echo ' - ' ;echo $d_end;?></a>
                        </h5>
                    </header>

                    <div class="container-fluid" style="margin: 2px 2px 2px;padding: 2px 2px 2px;">
                        <div class="justify-content-md-center">
                            <table id="dataTable-druga" class="display dataTable" style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll;  white-space: word-wrap: break-word;font-weight:normal;
                           font-family:K2D;font-size:18px;">
                                <thead
                                    style="font-family:K2D;font-size:18px;margin-top:0px;background-color:#96d9df;color:#442266">
                                    <tr align="center" style="font-weight:normal;">
                                        <td>No.</td>
                                        <td>Ref No.</td>
                                        <td>Requested Date</td>
                                        <td>Received Date</td>
                                        <td>Departed Date</td>
                                        <td>Arrived Date</td>
                                        <td>Refer Type</td>
                                        <td>ความเร่งด่วน</td>
                                        <td>Service<br>Unit</td>
                                        <td>HN</td>
                                        <td style="width:10%;">Name</td>
                                        <td>Sex</td>
                                        <td>
                                            <center>Age (Yr)</center>
                                        </td>
                                        <td>Medical <br> Rights</td>
                                        <td>Destination</td>
                                        <td style="width:10%;">Doctor<br>Refer</td>
                                        <td>Department</td>
                                        <td>Final Status</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                    $i=0;
                    $sql="SELECT 
                                rf_id,
                                rf_birthdate,rf_hn,rf_patients,rf_id,rf_hos_send_to,rf_status,hosp_recive_status,
                                hosp_recive_rem,rfgroup,rf_date,rf_time,rf_opdipd,end_hos_patient,
                                rfchar,rffast,rf_placename,rf_hn,pttypename,hossendto_name,
                                m_depname,docsend_prename,docsend_name,docsend_surname,norf,
                                rf_date,rf_time,hosp_recive_date,hosp_recive_time,end_rec_date_system,sento_hos_time,end_rec_date,end_rec_time,
                                sento_hos_date,  rf_sex,pttypename,hossendto_name,docme_prename,docme_name,docsend_surname
                                FROM v_rf_detail 
                                WHERE rf_hospital='10682' AND end_refer_end='Y'  and 
                                rf_date between '$d_start' and '$d_end'
                                Order by  substr(end_rec_date,7,4) DESC,SUBSTR(end_rec_date,4,2) DESC,substr(end_rec_date,1,2) DESC";
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
                                                <?php  $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                                            </center>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-"
                                                    style="width:98%;background-color:hsl(174, 100%, 33%);color:#E8EAF6"
                                                    dropdown-toggle" type="button"
                                                    data-toggle="dropdown"><?php echo $rs['norf']; ?>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu"
                                                    style="background-color:#9CDBD9;border:0.2px dotted;border-color:#005151;">
                                                    <li>
                                                        <a href="print_refer_out04.php?id=<?php echo $rs['rf_id'];?> &hos=<?php echo $hp; ?>"
                                                            target=_blank><i class="fa fa-print" style='color: red'></i>
                                                            สายรัดข้อมือคนไข้ Refer
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="print_refer_out01.php?id=<?php echo $rs['rf_id'];?> &hos=<?php echo $hp; ?>"
                                                            target=_blank><i class="fa fa-print" style='color: red'></i>
                                                            สลิป ผู้ป่วยส่งรักษาต่อ
                                                        </a>
                                                    </li>
                                                    <li><a href="print_refer_out02.php?id=<?php echo $rs['rf_id'];?>"
                                                            target=_blank><i class="fa fa-print" style='color: red'></i>
                                                            ใบ Refer ผู้ป่วยส่งรักษาต่อ</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>

                                        <!-- ปรับวันที่ -->
                                        <?php
                        // $eyy = substr($rs['end_rec_date_system'],0,5)+543;
                        // $emm =substr($rs['end_rec_date_system'],5,2);
                        // $edd =substr($rs['end_rec_date_system'],8,2);
                        // $end_rec_sys = ($edd.'/'.$emm.'/'.$eyy);
                        // $ett = substr($rs['end_rec_date_system'],11,8);
                        $sthd ='';
                        if($rs['sento_hos_date']<>''){
                            $sthd = substr($rs['sento_hos_date'],0,2).'/'.substr($rs['sento_hos_date'],3,2).'/'.substr($rs['sento_hos_date'],6,4);
                        }
                        ?>
                                        <td align="center"><?php echo $rs['rf_date'].'<br>'.$rs['rf_time']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo $rs['hosp_recive_date'].' <br>'.$rs['hosp_recive_time'];?>
                                        </td>
                                        <td align="center">
                                            <?php echo $sthd;?><br><?php echo $rs['sento_hos_time'];?> </td>
                                        <td align="center">
                                            <?php echo $rs['end_rec_date'].'<br>'.$rs['end_rec_time'];?> </td>
                                        <td><?php echo $rs['rfchar'] ;?> </td>
                                        <td><?php echo $rs['rffast'] ;?> </td>
                                        <td><?php echo $rs['rf_placename'];?> </td>
                                        <td><?php echo $rs['rf_hn']; ?></td>
                                        <td><?php echo $rfpatients; ?></td>
                                        <td>
                                            <center><?php echo $rs['rf_sex']; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $age; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $rs['pttypename']; ?></center>
                                        </td>
                                        <td><?php echo $rs['hossendto_name']; ?></td>
                                        <td style="width:10%">
                                            <?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                                        <td><?php echo $rs['m_depname']; ?></td>
                                        <td>
                                            <center><?php echo $rs['end_hos_patient']; ?></center>
                                        </td>
                                        <td>
                                            <?php echo '<span class="border"><i class="fa fa-check fa-2x" style="color:#004D40;"></i></span>'; ?>
                                        </td>
                                        <?php
                        ?>
                                    </tr>
                                    <?php 
                        }
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="row-fluid" style="padding:6px;font-size:16px;font-size:16px;color:black;">
                        <div class=" btborder">
                            <span><i class="fa fa-check fa-2x" style="color:#004D40;"></i>
                                :ปลายทางรับผู้ป่วยเรียบร้อย</span>
                        </div>
                    </div>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable-druga').dataTable({
            "lengthMenu": [
                [20, 40, 60, -1],
                [20, 40, 60, "All"]
            ],
            "ordering": false,
        });
    });
    </script>
</body>

</html>