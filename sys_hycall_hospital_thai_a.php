<style>
.border {
    font-family: K2D;
    font-weight: bolder;
    font-style: unset;
    display: block;
    padding: 10px 10px 10px 10px;
    width: AUTO;
    font-size: 20px;
    text-align: center;
    border-radius: 3%;
}

.btborder {
    font-family: K2D;
    font-style: unset;
    display: block;
    padding: 20px 10px 10px 10px;
    width: AUTO;
    font-size: 18px;
    word-spacing: 1.5em;
    color: #004D40;
}
</style>
<style type="text/css">
a:link {
text-decoration:none;
}
a:visited {
text-decoration:none;
}
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

.cell-hyphens {
    word-wrap: break-word;
    max-width: 1px;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
}
</style>
<?php
    include('./db/connection_thairefer.php');
    include('main_script.php');
?>
<?php
$date_curr_dmy_defult=date('Y-m-d') ;
$d_default=$date_curr_dmy_defult;
?>
<style>
table {
    font-family: 'K2D';
    font-size: 18px;
}
</style>

<body>
    <div class="container-fluid" style="padding: 2px 2px 2px;">
        <div class="commenta justify-content-md-center">
            <table id="dataTable-x" class="display dataTable" role="grid" style="widht:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll;font-size 16px;  
                           white-space: word-wrap: break-word; cellspacing:0;">
                <thead style="margin-top:0px;background-color:#214574;color:#F1F8E9">
                    <tr>
                        <td>
                            <center>ลำดับที่</center>
                        </td>
                        <td>
                            <center>เลขที่ใบ Refer</center>
                        </td>
                        <td>
                            <center>ชื่อ-สกุล ผู้ป่วย</center>
                        </td>
                        <td>
                            <center>IDcard</center>
                        </td>
                        <td>
                            <center>วันที่ Refer</center>
                        </td>
                        <td>
                            <center>เวลา</center>
                        </td>
                        <td>
                            <center>ต้นทาง</center>
                        </td>
                        <td>
                            <center>จุดส่งต่อ</center>
                        </td>
                        <td>
                            <center>แผนก</center>
                        </td>
                        <td>
                            <center>แพทย์ผู้ตรวจ</center>
                        </td>
                        <td>
                            <center>วินิจฉัยโรค</center>
                        </td>
                        <td>
                            <center>อาการสำคัญ</center>
                        </td>
                        <td>
                            <center>การรักษา</center>
                        </td>
                        <td>
                            <center>Status</center>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $i=1;

                $sql="SELECT *,h.hospname FROM referout_reply r
                            INNER JOIN hospcode h ON h.hospcode=r.hcode
                            INNER JOIN clinicgroup g on g.ClinicGroup_id=r.clinicgroup
                            WHERE r.referout_date='$date_curr_dmy_defult' 
                            Order by station_name ASC,referout_time DESC " ;
				$query=mysqli_query($conr,$sql);
				While($rs=mysqli_fetch_array($query)) {
					$year=substr($rs["referout_date"],0,4)+543;
					$month=substr($rs["referout_date"],5,2);
					$date=substr($rs["referout_date"],8,2);
					$day=$date.'-'.$month."-".$year;
					$date = date("Y-m-d");
					$rfpatients=$rs['pname'].''.$rs['fname'].'  '.$rs['lname'];
                    $rfidcard=$rs['cid'];
                    $rflocation=$rs['station_name'];
                    $mmd=$rs['memodiag'];
                    $clig=$rs['ClinicGroup'].'  '.$rs['ClinicGroup_name']
                    
					//   ค้นหารายชื่อผู้ป่วย กรณีไม่มีชื่อในตาราง
                    ?>
                    <td align="center">
                        <?php $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                    </td>
                    <td>
                        <center><?php echo $rs['referout_no']; ?></center>
                    </td>
                    <td>
                        <?php echo $rfpatients; ?>
                    </td>
                    <td>
                        <?php echo $rfidcard; ?>
                    </td>
                    <td>
                        <center><?php echo $day; ?></center>
                    </td>
                    <td>
                        <center><?php echo $rs['referout_time'];?></center>
                    </td>
                    <td>
                        <?php echo $rs['hosptype'].'-'.$rs['hospname'];?>
                    </td>
                    <td>    
                        <?php echo $rflocation;?>
                    </td>
                    <td>    
                        <?php echo $rs['ClinicGroup_id'].' - '.$rs['ClinicGroup_name'];?>
                    </td>
                    <td>    
                        <?php echo $rs['doctor_name'];?>
                    </td>

                    <td>
                    <?php
                            echo  trim(substr($mmd,0,50));
                            if(strlen($mmd) > 50){
                                echo '<a href="#myModal_approve_refer" data-toggle="modal" data-id="'.$rs['referout_no'].'"><br>
                                            มีต่อ  .... 
                                        </a>';
                            }else{
                                echo '';
                        }
                        ?>
                    </td>
                    <td>

                        <?php
                           echo  substr($rs['cc'],0,100);
                           if(strlen($rs['cc']) > 100){
                            echo '<a href="#myModal_approve_refera" data-toggle="modal" data-id="'.$rs['referout_no'].'"><br>
                                            มีต่อ  .... 
                                     </a>';
                            }else{
                                echo '';
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                           echo substr($rs['memodiag'],0,50);
                           if(strlen($rs['memo']) > 50){
                                echo '<a href="#myModal_approve_referb" data-toggle="modal" data-id="'.$rs['referout_no'].'"><br>
                                           มีต่อ .... 
                                        </a>';
                            }else{
                                echo '';
                            }
                        ?>
                    </td>
                    <td>
                        <?php echo '';?>
                    </td>
                </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
    // $('#dataTable-z').dataTable({
    //     "bFilter": false
    // });

    $(document).ready(function() {
        $('#dataTable-x').dataTable({
            "lengthMenu": [
                [20, 40, 60, 80, -1],
                [20, 40, 60, 80, "All"]
            ],
        });
    });
    </script>
</body>

<!---MODAL -->
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_approve_refer').on('show.bs.modal', function(e) {
        var rid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_thairef.php', //Here you will fetch records 
            data: {
                'rid': rid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_rc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_approve_refer" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title" style="color:#004225">
                    <i class="fa fa-group">
                    </i> : วินิจฉัยโรค
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_rc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_approve_refera').on('show.bs.modal', function(e) {
        var rid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_thairef_a.php', //Here you will fetch records 
            data: {
                'rid': rid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_ac').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_approve_refera" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title" style="color:#004225">
                    <i class="fa fa-group">
                    </i> : อาการสำคัญ
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_ac">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#myModal_approve_referb').on('show.bs.modal', function(e) {
        var rid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_thairef_b.php', //Here you will fetch records 
            data: {
                'rid': rid
            }, //Pass $id
            success: function(data) {
                $('.fetched-data_bc').html(data);
                //Show fetched data from database
            }
        });
    });
});
</script>
<div class="modal fade" id="myModal_approve_referb" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title" style="color:#004225">
                    <i class="fa fa-group">
                    </i> : การรักษา
                </h5>
            </div>
            <div class="modal-body">
                <div class="fetched-data_bc">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด
                </button>
            </div>
        </div>
    </div>
</div>