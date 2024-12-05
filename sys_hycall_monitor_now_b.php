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

 #ตรวจสอบสิทธิการเข้าใช้งาน
 if ($_SESSION['hosname']=="") 
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
<style>
.commenta {
    width: 100%;
    /* height: 900px;
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
            <table id="dataTable-t" class="display dataTable"
            style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
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
                                    dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $rs['norf']; ?>
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
                                    <li>
                                        <a href="print_refer_out07.php?id=<?php echo $crs['rf_id'];?> &hos=<?php echo $hp; ?>"
                                            target=_blank><i class="fa fa-print" style='color: red'></i>
                                            ใบสรุปการรักษาผู้ป่วย
                                        </a>
                                    </li>

                                    <li><a href="print_refer_out02.php?id=<?php echo $rs['rf_id'];?>" target=_blank><i
                                                class="fa fa-print" style='color: red'></i>
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
                        <td align="center"><?php echo $rs['rf_date'].'<br>'.$rs['rf_time']; ?></td>
                        <td align="center"><?php echo $rs['hosp_recive_date'].' <br>'.$rs['hosp_recive_time'];?> </td>
                        <td align="center"><?php echo $sthd;?><br><?php echo $rs['sento_hos_time'];?> </td>
                        <td align="center"><?php echo $rs['end_rec_date'].'<br>'.$rs['end_rec_time'];?> </td>
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
                            <!-- <td>
                            <center>
                                <?php
                                    echo $rs['docme_prename'].''.$rs['docme_name'].'  '.$rs['docme_surname']; ?>
                            </center>
                        </td> -->
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
            <span><i class="fa fa-check fa-2x" style="color:#004D40;"></i> :ปลายทางรับผู้ป่วยเรียบร้อย</span>
        </div>
    </div>
    </span>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable-t').dataTable({
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