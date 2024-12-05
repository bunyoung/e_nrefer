<!DOCTYPE html>
<html lang="en">
<?php
    require_once("./db/connection.php");
?>

<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $getid=$_GET['id'];
 $gethn=$_GET['hn'];
?>
<?php
include('main_script.php');
include('main_top_panel_heada.php');
include('main_top_menu_myreq.php');
?>

<style>
body {
    background-color: #F5F5F5;
    font-family: K2D;
    font-size: 18px;
}

.box {
    padding: 0px;
    border: none;
}
</style>

<?php
$sqls="SELECT * FROM  v_approve_success WHERE rf_idcard='$getid' and rf_hn='$gethn' " ;
$rsu=mysqli_query($conn,$sqls);
while($rw=mysqli_fetch_array($rsu)){
    $patient=$rw['rf_patients'];
    $hn=$rw['rf_hn'];
    $age=$rw['rf_age'];
    $sex=$rw['rf_sex'];
    $address=$rw['rf_maddress'];
    $idcard=$rw['rf_idcard'];
    $email = $rw['rf_mtel'];
    $stel=$rw['rf_stel'];
}
?>

<body style="font-family:K2D;font-size:18px;font-weight:0.1rem;">
    <div class="container-fluid">
        <div class="card border-info" style="font-family:'K2D';font-size:17px; margin-top:10px;">
            <div class="panel-heading" style="background-color:#004225;  color:#F4ECF7;font-size: 18px;">
                <span class="glyphicon glyphicon-send"></span>
                แสดงรายการส่งรักษาต่อ (e-Refer)
            </div>
            <div class="panel-body" style="background:#1B4D3E; font-family: 'K2D'; font-size: 18px;color:#E3DAC9">
                <div class="row">
                    <div class="col-sm-2"> ชื่อ-สกุล : <a class="text text-"
                            style="font-size:18px;font-weight:80px;color:#18FFFF"><?=$patient; ?></a>
                    </div>
                    <div class="col-sm-2"> HN : <a class="text text-"
                            style="font-size:18px;font-weight:80px;color:#18FFFF"><?=$hn; ?></a>
                    </div>
                    <div class="col-sm-1"> อายุ : <a class="text text-"
                            style="font-size:18px;font-weight:80px;color:#18FFFF"><?=$age; ?>&nbsp; ปี</a>
                    </div>
                    <div class="col-sm-1"> เพศ : <a class="text text-"
                            style="font-size:18px;font-weight:80px;color:#18FFFF"><?=$sex; ?></a>
                    </div>
                    <div class="col-sm-2">ID-Card : <a class="text text-"
                            style="font-size:18px;font-weight:80px;color:#18FFFF"><?=$idcard; ?></a>
                    </div>
                    <div class="col-sm-3">โทรศัพท์ : <a class="text text-"
                            style="font-size:18px;font-weight:80px;color:#18FFFF"><?=$stel; ?></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8"> ที่อยู่ปัจจุบัน : <a class="text text-"
                            style="font-size:18px;font-weight:80px;color:#18FFFF"><?=$address; ?></a>
                    </div>
                    <div class="col-sm-2"> Email : <a class="text text-"
                            style="font-size:18px;font-weight:80px;color:#18FFFF"><?=$email; ?></a>
                    </div>
                </div>
            </div>
            <p></p>
            <div class="justify-content-md-center" style="padding:10px 4px 6px 2px">
                <table id="dataTablea" class="display dataTable" role="grid" style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll;  white-space: word-wrap: break-word;font-weight:normal;
                           font-family:K2D;font-size:18px;">
                    <thead style="font-family:K2D;font-size:18px;margin-top:0px;background-color:#006B3C;color:#ffaa5e">
                        <tr align="center">
                            <td>No.</td>
                            <td>Ref No.</td>
                            <td>Date</td>
                            <td>Time</td>
                            <td>Referral Type</td>
                            <td>Priority</td>
                            <td>Service<br>Unit</td>
                            <td>Origin</td>
                            <td>Destination</td>
                            <td>Medical <br> Rights</td>
                            <td style="width:10%;">Doctor<br>Refer</td>
                            <td>Department</td>
                            <td>Status</td>
                            <!-- <td>Advice <br> Request</td> -->
                            <td>Referral Data</td>
                            <td>สรุปการรักษา</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $i=0;
                    $sql="SELECT *
                    FROM v_approve_success 
                    WHERE rf_idcard='$getid' and rf_hn='$gethn' Order by rf_id DESC";
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

                        <tr id="<?php echo $rfno; ?>" style="<?php echo $bc; ?>">
                            <td>
                                <center>
                                    <?php  $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                                </center>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-" style="width:95%;background-color:#2E5894;color:#E8EAF6"
                                        type="button" data-toggle="dropdown"><?php echo $rs['norf']; ?>
                                    </button>
                                </div>
                            </td>
                            <td><?php echo $rs['rf_date']; ?></td>
                            <td><?php echo $rs['rf_time'];?> </td>

                            <td style="width:5%">
                                <?php 
                            if($rs['rfgroup']=='1' && $rs['rf_opdipd']=='I' && $rs['time'] >= '48') {
                                ?>
                                <a class="btn btn-" style="width:90%;background-color:#943ca6;color:#E8EAF6;"
                                    type="button" data-toggle="dropdown"><?php echo $rs['rfchar']; ?>
                                </a>
                                <?php
                            }else{
                                echo $rs['rfchar'];                               
                            }
                            ?>
                            </td>
                            <td><?php echo $rs['rffast'];?> </td>
                            <td><?php echo $rs['rf_placename'];?> </td>
                            <td><?php echo $rs['hosname']; ?></td>
                            <td>
                                <center><?php echo $rs['hossendto_name']; ?></center>
                            </td>
                            <td>
                                <center><?php echo $rs['pttypename']; ?></center>
                            </td>
                            <td style="width:10%">
                                <?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                            <td><?php echo $rs['m_depname']; ?></td>
                            <td>
                                <center>
                                    <?php
                            if($rs['rf_status']=='1' || $rs['rf_status'] =='0')
                            {
                                echo '<a href="#myModal_approve_moa" data-toggle="modal" data-id="'.$rs['rf_id'].'">
                                <i class="fa fa-reply fa-2x" style="color:#DD2C00;"></i>
                                            </a>';
                            }
                            else
                            {
                            if($rs['rf_status']=='4' && $rs['hosp_recive_rem']=='1')
                            {
                                echo '<a href="sys_hycall_send_refer.php?sid='.$rs['rf_id'].' ">
                                <span class="border">
                                <i class="fa fa-solid fa-forward fa-2x" style="color:#004D40;"></i>
                                </span></a>';                                      
                            }
                            else
                            {
                            if($rs['rf_status']=='5')
                            {
                            if($rs['hosp_recive_status']<>'Y')
                            {
                            echo '<span class="border"><i class="fa fa-check fa-2x" style="color:#004D40;"></i></span>';
                            }
                            else
                            {
                            echo '<span class="border"><i class="fa fa-check fa-2x" style="color:#F50057;"></i></span>';
                            }  
                            }
                            else
                            {
                            echo '<span class="border"><i class="fa fa fa-close fa-2x" style="color:#F50057;"></i></span>';
                            }
                            }
                            }
                            ?>
                                </center>
                            </td>
                            <!-- <td>
                                <center>
                                    <a class="btn btn-danger" href="#myModal_approve_req" data-toggle="modal"
                                        data-id=<?php $rs['rf_id'];?>><span
                                            class="glyphicon glyphicon-registration-mark"></span>
                                        R
                                    </a>
                                </center>
                            </td> -->
                            <td style="font-size:16px;width:100px;">
                                <center>
                                    <a class="btn btn-success"
                                        href="print_refer_out02.php?id=<?php echo $rs['rf_id'];?>" target="_blank"
                                        style="font-family:'K2D';font-size:16px;"></i> PDF
                                    </a>
                                </center>
                            </td>
                            <td style="font-size:16px;width:100px;">
                                <center>
                                    <a class="btn btn-success"
                                        href="print_refer_out07.php?id=<?php echo $rs['rf_id'];?>" target="_blank"
                                        style="font-family:'K2D';font-size:16px;"></i> PDF
                                    </a>
                                </center>
                            </td>
                            <!-- <td>
                                <a class="btn btn-danger" href="#myModal_approve_req" data-toggle="modal" data-id=<?php $rs['rf_id'];?>>
                                Q
                                </a> -->
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
            $('#dataTablea').dataTable({
                "lengthMenu": [
                    [20, 40, 60, -1],
                    [20, 40, 60, "All"]
                ],
            });
        });
        </script>
</body>

</html>
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_approve_req').on('show.bs.modal', function(e) {
        var rid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_mymonitor_req.php', //Here you will fetch records 
            data: {
                'rid_p': rid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_approve_req" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="color:##212121;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times; </button>
                <h5 class="modal-title" style="color:black;font-size: 18px;">
                    <span class="glyphicon glyphicon-ok-sign"></span> : กรุณากรอกรายละเอียดที่ต้องการแจ้ง
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