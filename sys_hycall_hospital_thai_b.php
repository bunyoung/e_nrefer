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
</head>

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
    require_once("db/connection.php");
    // require_once('db/connect_pmk.php');
?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 if($did<>''){
    $_SESSION['ih'] = 'หัวหน้าแผนกยืนยัน';
 }else{
    $_SESSION['ih'] = 'แสดงคนไข้ Refer';
 }
 $hcode=$_SESSION['hcode'];
 
?>
<style>
table {
    font-family: 'K2D';
    font-size: 18px;
}
</style>
<?php
include('main_script.php');
?>

<body style="font-family: K2D;font-size:18px;">
    <div class="container-fluid" style="margin: 2px 2px 2px;padding: 2px 2px 2px;">
        <div class="commenta justify-content-md-center">
            <table id="dataTable-y" class="display dataTable" role="grid" style="width:100%;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px; 
                           overflow-x: scroll; overflow-y: scroll;  white-space: word-wrap: break-word;"
                cellspacing="0">
                <thead style="margin-top:0px;background-color:#214574;color:#F1F8E9">
                    <tr>
                        <td>
                            <center>No.</center>
                        </td>
                        <td>
                            <center>Ref No.</center>
                        </td>
                        <td>
                            <center>Date</center>
                        </td>
                        <td>
                            <center>Time</center>
                        </td>
                        <td>
                            <center>Refer Type</center>
                        </td>
                        <td>
                            <center>HN</center>
                        </td>
                        <td>
                            <center>Name</center>
                        </td>
                        <td>
                            <center>Sex</center>
                        </td>
                        <td>
                            <center>Age (Yr)</center>
                        </td>
                        <td>
                            <center>Origin</center>
                        </td>
                        <td>
                            <center>Doctor Refer</center>
                        </td>
                        <td>
                            <center>Department</center>
                        </td>
                        <td>
                            <center>Status</center>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <!-- ตรวจข้อมูลการ Refer -->
                    <?php
                $i=0;
                $sql="SELECT * FROM v_rf_detail  WHERE rf_hos_send_to = '$hcode' AND end_refer_end='N'  AND 
                                rf_no_thairefer <> '' AND rf_ptype_expire<>'' AND rf_place_money<>'' AND rf_pttype<>'' AND
                                hosp_recive_status<>'Y' ORDER BY substr(rf_date,7,4), substr(rf_date,4,2) DESC,substr(rf_date,1,2) DESC,rf_hos_send_to ASC";
				$query=mysqli_query($conn,$sql);

                // สิ้นสุดการตรวจสอบ
				$i=1;
                $f = 'Auto';
				While($rs=mysqli_fetch_array($query)) {
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
                    if($rs['hosp_recive_status']=='Y'){
                        echo '<tr style="font-size:17px;background-color:#B5E3D8;color:#034638"> ';
                    }else{
                        echo '<tr style="font-size:17px;color:#1D3C34"> ';
                    }
                    ?>
                    <td align="center">
                        <?php $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-" style="width:90%;background-color:#07272D;color:#E8EAF6"
                                dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $rs['rf_no_refer']; ?>
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
                            </d </td>
                    <td>
                        <center><?php echo $rs['rf_date']; ?></center>
                    </td>
                    <td>
                        <center><?php echo $rs['rf_time'];?></center>
                    </td>
                    <td>
                        <center><?php echo $rs['pttypename'];?> </center>
                    </td>
                    <td>
                        <center><?php echo $rs['rf_hn']; ?></center>
                    </td>
                    <td>
                        <center><?php echo $rfpatients; ?></center>
                    </td>
                    <td>
                        <center><?php echo $rs['rf_sex']; ?></center>
                    </td>
                    <td>
                        <center><?php echo $age; ?></center>
                    </td>
                    <td>
                        <center>
                            <?php echo $rs['hosname']; ?>
                        </center>
                    </td>
                    <td>
                        <center><?php echo $rs['docsend_prename'].''.$rs['docsend_name'].'  '.$rs['docsend_surname']; ?>
                        </center>
                    </td>
                    <td>
                        <center><?php echo $rs['m_depname']; ?></center>
                    </td>
                    <td>
                        <center>
                            <?php 
                        if($rs['rf_no_refer']<>'' && $rs['hosp_recive_status']<>'Y')
                        {
                            echo '<a href="#myModal_approve_wait" data-toggle="modal" data-id="'.$rs['rf_id'].'">
                            <span class="glyphicon glyphicon-repeat" style="color:#DD2C00;"></span> 
                                        </a>';
                        }else{
                            if($rs['rf_no_refer']<>'' && $rs['hosp_recive_status']=='Y'){
                                echo '<span class="glyphicon glyphicon-ok"></span>';
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
            <!-- <div class="row-fluid">
                <div class=" btborder">
                    <span> <i class="fa fa-mobile fa-2x" style="color:#DD2C00;"></i> รอยืนยันตอบรับ</span>
                    <span> <i class="fa fa-bed fa-2x" style="color:#186A3B;"></i> ตอบรับแล้ว</span>
                </div>
            </div> -->
        </div>
    </div>

    <script type="text/javascript">
    // $('#dataTable-z').dataTable({
    //     "bFilter": false
    // });

    $(document).ready(function() {
        $('#dataTable-y').dataTable({
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
    $('#myModal_approve_wait').on('show.bs.modal', function(e) {
        var rid = $(e.relatedTarget).data('id');
        $.ajax({
            type: 'post',
            url: 'sys_hycall_hospital_ref_wait.php', //Here you will fetch records 
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
<div class="modal fade" id="myModal_approve_wait" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="color:#004225;">
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
                <h5 class="modal-title">
                    <i class="fa fa-group">
                    </i> : ยืนยันการรับ Refer
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

</html>