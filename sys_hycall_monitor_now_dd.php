<html lang="en">
<?php
    require_once("db/connection.php");
    // require_once('db/connect_pmk.php');
?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];
?>
<style>
.commenta {
    width: 100%;
    /*height: 900px;
    padding: 4px 0px;
    margin: 0px 1px; */
    /* background-color: #81D4FA; */
    /* border-top-left-radius: 1px 1px; */
    /* border-top-right-radius: 1px 1px; */
    /* opacity: 0.1; */
    /* border: 0px dotted #F0F2F5; */
    /* inset: 10px 30% 20px 0; */
}
</style>

<body style="font-family:K2D;font-size:18px;">
    <div class="container-fluid" style="margin: 2px 2px 2px;padding: 2px 2px 2px;">
        <div class="justify-content-md-center">
            <table id="dataTable-p" class="display dataTable" style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll;  white-space: word-wrap: break-word;font-weight:normal;
                           font-family:K2D;font-size:18px;">
                <thead style="font-family:K2D;font-size:18px;margin-top:0px;background-color:#96d9df;color:#442266">
                    <tr align="center" style="font-weight:normal;">
                        <td>Ref No.</td>
                        <td>Date</td>
                        <td>Time</td>
                        <td>Refer Type</td>
                        <td>ความเร่งด่วน</td>
                        <td>Service<br>Unit</td>
                        <td>HN</td>
                        <td style="width:10%;">Name</td>
                        <td>Sex</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    $sql="
                    SELECT 
                    rf_id,
                    rf_birthdate,rf_hn,rf_patients,rf_id,rf_hos_send_to,rf_status,hosp_recive_status,
                    hosp_recive_rem,rfgroup,rf_date,rf_time,rf_opdipd,rf_sex,
                    rfchar,rffast,rf_placename,rf_hn,pttypename,hossendto_name,
                    m_depname,docsend_prename,docsend_name,docsend_surname,norf
        FROM v_rf_detail 
                    WHERE rf_hospital='$hcode' AND end_refer_end='N' AND rfgroup='1' Order by rf_id DESC";
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
                                <button class="btn btn-" style="width:90%;background-color:#07272D;color:#E8EAF6"
                                    dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $rs['norf']; ?>
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
                        <td>

                            <?php 
                            if($rs['rfgroup']=='1' && $rs['rf_opdipd']=='I' ) 
                            {
                                ?>
                            <a class="btn btn-" style="width:90%;background-color:#943ca6;color:#E8EAF6"
                                dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $rs['rfchar']; ?>
                            </a>
                            <?php
                            }

                            if($rs['rfgroup']=='1' && $rs['rf_opdipd']=='H' ) 
                            {
                                ?>
                            <a class="btn btn-" style="width:90%;background-color:#1B5E20;color:#E8EAF6"
                                dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $rs['rfchar']; ?>
                            </a>
                            <?php
                            }

                            if($rs['rf_opdipd']<>'H' && $rs['rf_opdipd']<>'I') 
                            {
                                ?>
                            <a class="btn btn-" style="width:90%;color: #4E008E" ; dropdown-toggle" type="button"
                                data-toggle="dropdown"><?php echo $rs['rfchar']; ?>
                            </a>
                            <?php
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
                        <td><?php echo $rs['hossendto_name']; ?></td>
                        <td style="width:10%">
                            <?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                        <td>
                            <center><?php echo $rs['pttypename']; ?></center>
                        </td>
                        <td><?php echo $rs['m_depname']; ?></td>
                        <td>
                            <center>
                                <?php
                            if($rs['rf_status']=='1' || $rs['rf_status'] =='0'){
                                echo '
                                <a href="#myModal_approve_moc" data-toggle="modal" data-id="'.$rs['rf_id'].'">
                                    <i class="fa fa-reply fa-2x" style="color:#DD2C00;"></i>
                                </a>';
                            }else{
                                if($rs['rf_status']=='0'){
                                    echo '<span class="border"><i class="fa fa-spinner fa-2x" style="color:#F50057;"></i></span>';
                                }else{
                                    if($rs['rf_status']=='4' && $rs['hosp_recive_rem']=='1'){
                                        echo '
                                        <a href="sys_hycall_send_refer.php?sid='.$rs['rf_id'].' ">
                                            <span class="border">
                                                <i class="fa fa-solid fa-forward fa-2x" style="color:#004D40;"></i>
                                            </span>
                                        </a>';                                      
                                    }else{
                                        if($rs['rf_status']=='5'){
                                            echo '<span class="border"><i class="fa fa-check fa-2x" style="color:#F50057;"></i></span>';
                                        }else{
                                            echo '<span class="border"><i class="fa fa fa-close fa-2x" style="color:#F50057;"></i></span>';
                                        }
                                    }
                                }
                            }
                            ?>
                            </center>
                        </td>
                        <!--  สิ้นสุดส่วนช่องขั้นตอนมูล-->

                        <!-- ส่วนกรณีที่มีการแก้ไข หรือ ลบ และไม่ผ่านการ Login มาจากแพทย์ -->
                        <?php
                        if($did==null) 
                        {
                            if($rs['rf_rfev']=='1')
                            {
                                echo'<td  style="font-size:16px;width:100px;">
                                        <center>
                                                <a href="#" class="btn btn-danger btn-grad">
                                                    EDIT</center></td>';
                                echo'<td>
                                            <center><a href="#" class="btn btn-danger btn-grad">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            </center></td>';
                            }else{
                                echo'<td  style="font-size:16px;width:20px;">
                                        <center>
                                                <a href="#" class="btn btn-warning btn-grad">
                                                    EDIT</center></td>';
                                echo'<td  style="font-size:16px;width:20px;">
                                            <center><a href="#" class="btn btn-danger btn-grad" >
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            </center></td>';
                            }    
                        }
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
    <div class="row-fluid" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                        overflow-x: scroll;  max-width: 100%; display: block;margin:2px 4px;
                        padding:6px;font-size:16;font-size:16px;color:black;">
        <div class=" btborder">
            <span><i class="fa fa-reply fa-2x" style="color:#DD2C00;"></i>:รอตอบรับ</span>
            <span><i class="fa fa-solid fa-forward fa-2x" aria-hidden="true" style="color:#004D40;"></i>
                เตรียมส่งผู้ป่วย</span>
            <span><i class="fa fa-solid fa-ban fa-2x" style="color:#DD2C00;"></i>:ไม่อนุมัติ</span>
            <span><i class="fa fa-mobile fa-2x" style="color:#00C853;"></i>:ปลายทางตอบรับ</span>
            <span><i class="fa fa-clock-o fa-2x" style="color:#00C853;"></i>:รออนุมัติ</span>
        </div>
    </div>
    </span>

    <script type="text/javascript">
    $(document).ready(function() {
        var table = $('#dataTable-p').DataTable({
            "ajax": "dataTable-p.php",
            columns: [{
                    "data": "name"
                },
                {
                    "data": "position"
                },
                {
                    "data": "office"
                },
                {
                    "data": "extn"
                },
                {
                    "data": "start_date"
                },
                {
                    "data": "salary"
                }
            ],
            drawCallback: function() {
                console.log('fred')
            }
        });

        // $('#change').on('click', function() {
        //     table.cell(2, 1).data('XXX');
        // })

        // $('#reload').on('click', function() {
        //     table.ajax.reload();
        // })
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable-p').dataTable({
            "lengthMenu": [
                [20, 40, 60, -1],
                [20, 40, 60, "All"]
            ],
        });
    });
    </script>
</body>
<!---MODAL -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_approve_moc').on('show.bs.modal', function(e) {
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
<div class="modal fade" id="myModal_approve_moc" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="color:##212121;">
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