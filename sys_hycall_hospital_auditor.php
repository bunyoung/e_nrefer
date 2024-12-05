<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
    require_once("./db/connection.php");
?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];
?>
<?php
include('main_script.php');
?>

<body>
    <?php
include('main_top_panel_head.php');
include('main_top_menu_session.php');
include('main_top_menu_smenu.php');
?>
    <div class="row-fluid"
        style="font-family: K2D;font-size:18px;font-weight:10px;background-color:#0D47A1;color:#A7E6D7;text-align:center;">
        <label for=""><i class="fa fa-desktop fa-1x" aria-hidden="true"
                style="color:#84FFFF"></i><?php echo '  ('.$hcode.')  ';?> Refer Audit :: รายการข้อมูล Refer Audit
        </label>
    </div>
    <div class="panel-body"
        style="background:#f8e3c4; font-family: K2D; font-size: 18px;font-weight:bold; color:#9f20c0;">
        <div class="row">
            <div class="col-md-1">
                <a class="text txt-" style="color:#f7e5b2;font-size: 18px;font-weight:bold;color:#5c55b7">หมายเหตุ Audit </a>
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;"> A</a> ยืนยันรับ Refer
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;">
                    B</a> ข้อมูลผู้ป่วยถึงปลายทาง
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;"> C</a> Audit รายบุคคล
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;"> D</a> Audit ภาพรวม
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;"> F</a> Audit Full
            </div>
        </div>
    </div>

    <div class="panel panel-"
        style="font-family:K2D;font-weight:bold;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;font-size:18px;">
        <div class="container-fluid" style="margin: 2px 2px 2px;padding: 2px 2px 2px;">
            <!-- <div class="justify-content-md-center"> -->
            <table id="dataTable_audit" class="display dataTable" style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll;  white-space: word-wrap: break-word;"
                cellspacing="0">
                <thead style="font-family: K2D;font-size:18px;margin-top:0px;background-color:#3875a1;color:#F1F8E9">
                    <tr align="center">
                        <td>No.</td>
                        <td>Ref No.</td>
                        <td>Date</td>
                        <td>Time</td>
                        <td>Refer Type</td>
                        <td>ความเร่งด่วน</td>
                        <td>Service Unit</td>
                        <td>HN</td>
                        <td>Name</td>
                        <td>Sex</td>
                        <td>
                            <center>Age (Yr)</center>
                        </td>
                        <td>Medical Rights</td>
                        <td>Destination</td>
                        <td>Doctor Refer</td>
                        <td style="background-color:#f8e3c4;color:#e64e4b">A</td>
                        <td style="background-color:#f8e3c4;color:#e64e4b">B</td>
                        <td style="background-color:#f8e3c4;color:#e64e4b">C</td>
                        <td style="background-color:#f8e3c4;color:#e64e4b">D</td>
                        <td style="background-color:#f8e3c4;color:#e64e4b">F</td>
                    </tr>
                </thead>
                <tbody style="font-family: K2D;font-size:17px;font-weight:30px;">
                    <?php
                    $i=0;
                    $sql="SELECT 
                                rf_id,
                                rf_birthdate,rf_hn,rf_patients,rf_id,rf_hos_send_to,rf_status,hosp_recive_status,
                                hosp_recive_rem,rfgroup,rf_date,rf_time,rf_opdipd,
                                rfchar,rffast,rf_placename,rf_hn,pttypename,hossendto_name,
                                m_depname,docsend_prename,docsend_name,docsend_surname,norf,
                                rf_date,rf_time,hosp_recive_date,hosp_recive_time,end_rec_date_system,sento_hos_time,end_rec_date,end_rec_time,
                                sento_hos_date,  rf_sex,pttypename,hossendto_name,docme_prename,docme_name,docsend_surname
                                FROM v_rf_detail 
                                WHERE rf_hospital='$hcode' AND end_refer_end='Y' 
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
                    <?php
                    $bc='';
                    if($rs['rfgroup'] =='1'){
                        $bc = "color: #4E008E";
                    }else{
                        if($rs['rfgroup']=='2'){
                            $bc = "color: #A6093D";
                        }else{
                            if($rs['rfgroup']=='3'){
                                $bc = "color: #D539B5";
                            }else{
                                $bc = "color: #009681";
                            }
                        }
                    }
                    ?>

                    <tr style="<?php echo $bc; ?>">
                        <td>
                            <center>
                                <?php  $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                            </center>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-" style="width:95%;background-color:#07272D;color:#E8EAF6;"
                                    dropdown-toggle type="button" data-toggle="dropdown"><?php echo $rs['norf']; ?>
                                    <span class="caret"></span></button>
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
                                    <li><a href="print_refer_out02.php?id=<?php echo $rs['rf_id'];?>" target=_blank><i
                                                class="fa fa-print" style='color: red'></i>
                                            ใบ Refer ผู้ป่วยส่งรักษาต่อ</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $rs['rf_date']; ?></td>
                        <td><?php echo $rs['rf_time'];?> </td>

                        <td style="width:5%">
                            <?php 
                            if($rs['rfgroup']=='1' && $rs['rf_opdipd']=='I' && $rs['time'] >= '48') {
                                ?>
                            <a class="btn btn-" style="width:90%;background-color:#943ca6;color:#E8EAF6;" type="button"
                                data-toggle="dropdown"><?php echo $rs['rfchar']; ?>
                            </a>
                            <?php
                            }else{
                                echo $rs['rfchar'];                               
                            }
                            ?>
                        </td>
                        <td><?php echo $rs['rffast'];?> </td>
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
                        <td>
                            <?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                        </td>
                        <td style="font-size:16px;">
                            <center>
                                <a class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;"
                                    href="sys_hycall_hospital_auditor_a.php?id=<?php echo $rs['norf'];?>">
                                    A
                                </a>
                            </center>
                        </td>
                        <td style="font-size:16px;">
                            <center>
                                <a class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;""
                                    href=" sys_hycall_hospital_auditor_b.php?id=<?php echo $rs['norf'];?>">
                                    B
                                </a>
                            </center>
                        <td style="font-size:16px;">
                            <center>
                                <a class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;""
                                    href=" sys_hycall_hospital_auditor_c.php?id=<?php echo $rs['norf'];?>">C
                                </a>
                            </center>
                        <td style="font-size:16px;">
                            <center>
                                <a class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;""
                                    href=" sys_hycall_hospital_auditor_d.php?id=<?php echo $rs['norf'];?>">D
                                </a>
                            </center>
                        </td>
                        <td style="font-size:16px;">
                            <center>
                                <a class="btn btn-" style="background-color:#6b1fb1;color:#f7e5b2;"
                                    href="sys_hycall_hospital_auditor_f.php?id=<?php echo $rs['norf'];?>">F
                                </a>
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
    <br>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable_audit').dataTable({
            "lengthMenu": [
                [20, 40, 60, -1],
                [20, 40, 60, "All"]
            ],
        });
    });
    </script>
</body>

<!---MODAL -->
<!-- ยืนยันการ Refer -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_approve_moa').on('show.bs.modal', function(e) {
        var rid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_hospital_ref_con.php', //Here you will fetch records 
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

<div class="modal fade" id="myModal_approve_moa" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="color:#212121;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times; </button>
                <h5 class="modal-title" style="color:black;">
                    <i class="fa fa-group"> </i> : ยืนยันการรับ Refer
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด </button>
            </div>
        </div>
    </div>
</div>

</html>