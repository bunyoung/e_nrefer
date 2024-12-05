<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
if(!isset($_SESSION)) 
{  
    session_start(); 
}
$hcode=$_SESSION['hcode'];
require_once("./db/connection.php");
include('main_script.php');
?>
<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<body style="font-family:K2D;font-size:18px;">
    <div class="container-fluid" style="margin: 2px 2px 2px;padding: 2px 2px 2px;">
        <div class="commenta justify-content-md-center">
            <table id="dataTablec" class="display dataTable" role="grid" style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           font-family:K2D;font-size:18px;">
                <thead style="font-family:K2D;font-size:18px;margin-top:0px;background-color:#96d9df;color:#442266">
                    <tr align="center">
                        <td>No.</td>
                        <td>Ref No.</td>
                        <td>Requested <br>Time</td>
                        <td>Edited <br>Time</td>
                        <td>Refer Type</td>
                        <td>Priority</td>
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
                        <td>Status</td>

                        <!-- <td>ขั้นตอนส่งต่อ</td> -->
                        <?php
                                if($did==null) {
                                    echo '<td><center>Edit</center></td> 
                                              <td><center>Delete</center></td>';
                                }elseif($did<>null){
                                    echo '<td style="background-color:#E74C3C;color:#ffff;">
                                             <center>Approve <br>Refer</center></td>';
                                }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    $csql="
                    SELECT 
                        rf_id,
                        rf_birthdate,rf_hn,rf_patients,rf_id,rf_hos_send_to,rf_status,hosp_recive_status,
                        hosp_recive_rem,rfgroup,rf_date,rf_time,rf_opdipd,rf_sex,
                        rfchar,rffast,rf_placename,rf_hn,pttypename,hossendto_name,rf_first_edit,
                        m_depname,docsend_prename,docsend_name,docsend_surname,norf,rf_no_thairefer,rf_ptype_expire,rf_place_money,rf_pttype
                    FROM v_rf_detail 
                    WHERE rf_hospital='$hcode' AND end_refer_end='N' AND rf_date = '$d_default'
                                   Order by rf_id DESC";
                    $cquery=mysqli_query($conn,$csql);
                    $rsn = mysqli_num_rows($cquery);
                    $i=1;
                    while($crs=mysqli_fetch_array($cquery)) {
                        $year=substr($crs["rf_birthdate"],6,4);
                        $month=substr($crs["rf_birthdate"],3,2);
                        $date=substr($crs["rf_birthdate"],0,2);
                        $day=$year."-".$month."-".$date;
                        $date = date("Y-m-d");
                        $age=($date - $day);
                        $rfhn=$crs['rf_hn'];
                        $rfpatients=$crs['rf_patients'];
                        $rfno=$crs['rf_id'];
                        $hp = $crs['rf_hos_send_to'];
                        IF($crs['rf_status']=='0'){
                            $f = 'รออนุมัติ';
                        } 
                        if($crs['rf_status']=='1'){      
                            $f = 'รอตอบรับ';
                        }
                        if($crs['rf_status']=='2'){      
                            $f = 'อนุมัติ Auto';
                        }
                        if($crs['rf_status']=='3' && $crs['rf_no_refer']<>''){   
                            $f = 'รอปลายทาง<br>ตอบรับ';
                        }
                        if($crs['rf_status']=='4' && $crs['rf_no_refer']<>'') {
                            if($crs['hosp_recive_status']=='Y'){
                                if($crs['hosp_recive_rem']=='1'){
                                    $f='รอส่ง<br>ผู้ป่วย';
                                }else{
                                    if($crs['hosp_recive_rem']=='2'){
                                        $f='ปฎิเสธรับ';
                                    }
                                }
                            }
                        }
					   ?>
                    <?php
                    $bc='';
                    if($crs['rfgroup'] =='1'){
                        $bc = "color: #4E008E";
                    }else{
                        if($crs['rfgroup']=='2'){
                            $bc = "color: #A6093D";
                        }else{
                            if($crs['rfgroup']=='3'){
                                $bc = "color: #D539B5";
                            }else{
                                $bc = "color: #009681";
                            }
                        }
                    }
                    ?>

                    <tr id="<?php echo $rfno; ?>" style="<?php echo $bc; ?>">
                        <td>
                            <center>
                                <?php  $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                            </center>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-" style="width:95%;background-color:#07272D;color:#E8EAF6"
                                    type="button" data-toggle="dropdown"><?php echo $crs['norf']; ?>
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu"
                                    style="background-color:#9CDBD9;border:0.2px dotted;border-color:#005151;font-family:K2D;font-size:20px;">
                                    <li>
                                        <a href="print_refer_out04.php?id=<?php echo $crs['rf_id'];?> &hos=<?php echo $hp; ?>"
                                            target=_blank><i class="fa fa-print" style='color: red'></i>
                                            สายรัดข้อมือคนไข้ Refer
                                        </a>
                                    </li>
                                    <li>
                                        <a href="print_refer_out01.php?id=<?php echo $crs['rf_id'];?> &hos=<?php echo $hp; ?>"
                                            target=_blank><i class="fa fa-print" style='color: red'></i>
                                            สลิป ผู้ป่วยส่งรักษาต่อ
                                        </a>
                                    </li>
                                    <li>
                                        <?php
                                    if(empty($crs['rf_no_thairefer']) || empty($crs['rf_ptype_expire']) || empty($crs['rf_place_money']) || empty($crs['rf_pttype']))
                                    {
                                        ?>
                                        <a href="print_refer_out06.php?id=<?php echo $crs['rf_id'];?>" target=_blank><i
                                                class="fa fa-print" style='color: red'></i>
                                            ใบ Refer ผู้ป่วยส่งรักษาต่อ</a>
                                        <?php
                                    }
                                    else
                                    {
                                      ?>
                                        <a href="print_refer_out02.php?id=<?php echo $crs['rf_id'];?>" target=_blank><i
                                                class="fa fa-print" style='color: red'></i>
                                            ใบ Refer ผู้ป่วยส่งรักษาต่อ</a>
                                        <?php  
                                    }
                                    ?>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td><?php echo $crs['rf_time'];?> </td>
                        <td><?php echo $crs['rf_first_edit']; ?></td>
                        <td style="width:5%">
                            <?php 
                            if($crs['rfgroup']=='1' && $crs['rf_opdipd']=='I' && $crs['time'] >= '48') {
                                ?>
                            <a class="btn btn-" style="width:90%;background-color:#943ca6;color:#E8EAF6;" type="button"
                                data-toggle="dropdown"><?php echo $crs['rfchar']; ?>
                            </a>
                            <?php
                            }else{
                                echo $crs['rfchar'];                               
                            }
                            ?>
                        </td>
                        <td><?php echo $crs['rffast'];?> </td>
                        <td><?php echo $crs['rf_placename'];?> </td>
                        <td><?php echo $crs['rf_hn']; ?></td>
                        <td><?php echo $rfpatients; ?></td>
                        <td>
                            <center><?php echo $crs['rf_sex']; ?></center>
                        </td>
                        <td>
                            <center><?php echo $age; ?></center>
                        </td>
                        <td>
                            <center><?php echo $crs['pttypename']; ?></center>
                        </td>
                        <td><?php echo $crs['hossendto_name']; ?></td>
                        <td style="width:10%">
                            <?php echo $crs['docsend_prename'].''.$crs['docsend_name'].'  '.$crs['docsend_surname']; ?>
                        <td><?php echo $crs['m_depname']; ?></td>
                        <td>
                            <center>
                                <?php
                            if($crs['rf_status']=='1' || $crs['rf_status'] =='0'){
                                echo '
                                  <a href="#myModal_approve_moph" data-toggle="modal" data-id="'.$crs['rf_id'].'">
                                        <i class="fa fa-reply fa-2x" style="color:#DD2C00;"></i>
                                  </a>';
                            }else{
                                    if($crs['rf_status']=='4' && $crs['hosp_recive_rem']=='1'){
                                        echo '<a href="sys_hycall_send_refer.php?sid='.$crs['rf_id'].' ">
                                        <span class="border">
                                        <i class="fa fa-solid fa-forward fa-2x" style="color:#004D40;"></i>
                                        </span></a>';                                      
                                    }else{
                                        if($crs['rf_status']=='5'){
                                            if($crs['hosp_recive_status']<>'Y'){
                                                echo '<span class="border"><i class="fa fa-check fa-2x" style="color:#004D40;"></i></span>';
                                              }else{
                                                echo '<span class="border"><i class="fa fa-check fa-2x" style="color:#F50057;"></i></span>';
                                              }  
                                            }else{
                                            echo '<span class="border"><i class="fa fa fa-close fa-2x" style="color:#F50057;"></i></span>';
                                        }
                                    }
                            }
                            ?>
                            </center>
                        </td>
                        <!--  สิ้นสุดส่วนช่องขั้นตอนมูล-->

                        <!-- ส่วนกรณีที่มีการแก้ไข หรือ ลบ และไม่ผ่านการ Login มาจากแพทย์ -->
                        <td style="font-size:16px;width:100px;">
                            <center>
                                <?php
                                if(empty($crs['rf_no_thairefer']) || empty($crs['rf_ptype_expire']) || empty($crs['rf_place_money']) || empty($crs['rf_pttype'])){
                                    ?>
                                <a class="btn btn-danger"
                                    href="sys_hycall_center_now_edit.php?id=<?php echo $crs['rf_id'];?>"
                                    style="font-family:'K2D';font-size:16px;"></i> Edit/Audit
                                </a>
                                <?php 
                                }else{
                                    ?>
                                <a class="btn btn-success"
                                    href="sys_hycall_center_now_edit.php?id=<?php echo $crs['rf_id'];?>"
                                    style="font-family:'K2D';font-size:16px;"></i> Edit/Audit
                                </a>
                                <?php
                                }
                                 ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <a href="#" class="btn btn-danger btn-grad remove">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
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
        $('#dataTablec').dataTable({
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
    $('#myModal_approve_moph').on('show.bs.modal', function(e) {
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

<div class="modal fade" id="myModal_approve_moph" role="dialog">
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

<!-- Time interval  -->
<script type="text/javascript">
setTimeout(function() {
    location.reload();
}, 240000);
</script>

<!-- Confirm Delete-->
<script type="text/javascript">
$(".remove").click(function() {
    var id = $(this).parents("tr").attr("id");
    if (confirm(' ยืนยันรบการข้อมูลนี้ใช่ไหม ?')) {
        $.ajax({
            url: 'sys_hycall_monitor_now_delete.php',
            type: 'GET',
            data: {
                id: id
            },
            error: function() {
                alert('ไม่สามารถทำการลบข้อมูลนี้ได้ .. ');
            },
            success: function(data) {
                $("#" + id).remove();
                alert("ลบรายการข้อมูลให้เรียบร้อยแล้ว ..");
            }
        });
    }
});
</script>

</html>