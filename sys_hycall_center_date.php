<?php session_start();
$page=basename($_SERVER['PHP_SELF']);
	if (file_exists('_couter/'.$page.'.txt')) 
	{
		$fil = fopen('_couter/'.$page.'.txt', "r");
		$dat = fread($fil, filesize('_couter/'.$page.'.txt')); 
		#echo $dat+1;
		fclose($fil);
		$fil = fopen('_couter/'.$page.'.txt', "w");
		fwrite($fil, $dat+1);
	}
	else
	{
		$fil = fopen('_couter/'.$page.'.txt', "w");
		fwrite($fil, 1);
		#echo '1';
		fclose($fil);
	}
#read number	
$myFile = "_couter/".$page.".txt";
$lines = file($myFile);//file in to an array
$count= $lines[0]; //line 2
?>
<?php
require_once('db/date_format.php');
require_once('db/connect_pmk.php');
require_once("db/connection.php");
require_once('function/conv_date.php');
?>

<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>
<script>
function fncSubmit(strPage) {
    if (strPage == "pmk") {
        document.formq.action = "?page=regis&type=pmk";
    }
}
</script>

<!-- ดึงวันที่ปัจจุบัน -->

<html class="no-js">
<div class="" alt="">

    <head>

        <head>
            <?php
    include ('main_script.php');
    ?>
        </head>

        <!-- ใช้เรียกเวลาจาก server -->
        <script language="JavaScript1.2">
        function server_date(now_time) {
            current_time1 = new Date(now_time);
            current_time2 = current_time1.getTime() + 1000;
            current_time = new Date(current_time2);

            server_time.innerHTML = current_time.getDate() + "/" + (current_time.getMonth() + 1) + "/" + current_time
                .getYear() + " " + current_time.getHours() + ":" + current_time.getMinutes() + ":" + current_time
                .getSeconds();

            setTimeout("server_date(current_time.getTime())", 1000);
        }
        setTimeout("server_date('<?=$current_server_time?>')", 1000);
        </script>
        <?php
    $current_server_time = date("H:i:s");
?>
        <?php      

// สถานที่ ในการรับส่ง คนไข้
$idplacefrom = "";
$query1=mysqli_query($conn,"SELECT placecode,fullplace FROM places ORDER BY fullplace") OR die(mysqli_error());
while($row1=mysqli_fetch_array($query1))
{
    $idplacefrom .='<option value=" '.$row1['placecode'].'">'.$row1['fullplace'].'</option>';
}

// สถานที่ ในการรับส่ง คนไข้
$idplaceother = "";
$query5=mysqli_query($conn,"SELECT placecode,fullplace FROM places ORDER BY fullplace") OR die(mysqli_error());
while($row1=mysqli_fetch_array($query5))
{
    $idplaceother .='<option value=" '.$row1['placecode'].'">'.$row1['fullplace'].'</option>';
}

// ประเภทอุปกรณ์ และ อุปกรณ์เพิ่มเติม
$idhass="";
$query2 = mysqli_query($conn,"SELECT hassid,hassname FROM hass ORDER BY hassname") OR die(mysqli_error());
while($row2=mysqli_fetch_array($query2))
{
    $idhass .='<option value=" '.$row2['hassid'].'">'.$row2['hassname'].'</option>';
}

// ประเภทวิกฤต
$idfast="";
$query3 = mysqli_query($conn,"SELECT hyass,assname FROM hyass ORDER BY assname") OR die(mysqli_error());
while($row3=mysqli_fetch_array($query3))
{
    $idfast .='<option value=" '.$row3['hyass'].'">'.$row3['assname'].'</option>';
}

?>

    <body class="boxed">
        <?php
        // include ("main_script_loading.php");
        ?>
        <div class="boxed-wrapper">
            <div class="bg-blue dker" id="wrap">
                <?php
if (@$_SESSION['sess_userid'] <> session_id().@$_SESSION['web_login'].@$_SESSION['username']) {
require("main_top_panel.php"); 
}ELSE{
require("main_top_panel_session.php");
}
?>
                <div class="boxed">
                    <div class="bg-blue dker" id="wrap">
                        <script>
                        $(function() {
                            Metis.dashboard();
                        });
                        </script>
                        <!--เริ่มเนื้อหาตรงนี้  -->
                        <div id="content3">
                            <div class="outer">
                                <div class="inner bg-light lter">
                                    <!-- <div class="col-lg-12"> -->

                                    <!-- เริ่ม Box 1 -->
                                    <form class="form-horizontal" action="sys_hycurr_db.php" method="POST" target=""
                                        name="formq" id="formq">
                                        <span>
                                            <div class="box">
                                                <header>
                                                    <div class="icons">
                                                        <i class="glyphicon glyphicon-list-alt"></i>
                                                    </div>
                                                    <h5><i class="fa-user-check"></i>&nbsp;เรียกบริการศูนย์เปล
                                                    </h5>
                                                </header>
                                                <p>
                                                    <input type="hidden" name=ddate id=ddate
                                                        value=<?php echo $d_default;?>>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="pull-right">ประจำวันที่ :<a
                                                                class="text text-danger">
                                                                <?php echo $d_default; ?> เวลา :
                                                                <?php echo $current_server_time?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label for="shn" class="control-label col-lg-2"><i
                                                            class="fa fa-search fa-lg"></i>&nbsp; เลขที่ HN :</label>
                                                    <div class="col-lg-2">
                                                        <input type="text" id="shn" name="shn" placeholder="เลข HN"
                                                            class="form-control input-sm" value="<?php echo $hn; ?>">
                                                    </div>
                                                    <div class="col-lg-1">
                                                        <input class="btn btn-success btn-grad btn-rect" name="Search"
                                                            type="submit" id="Search" value="PMK"
                                                            onclick="JavaScript:fncSubmit('pmk')" />
                                                    </div>

                                                    <!--Start SQL-->
                                                    <?php
                                        if ($_REQUEST['type'] == 'pmk') {
                                            $strSQL = "SELECT 
                                            hn,(prename||name||' '||surname) as n
                                            FROM v_patients 
                                            WHERE hn='".$_REQUEST['shn']."' ";
                                            $objParse = oci_parse($objConnect, $strSQL);
                                            oci_execute($objParse, OCI_DEFAULT);
                                            while ($objResult = oci_fetch_array($objParse, OCI_BOTH)) {
                                                $hn = $objResult["HN"];
                                                $na = $objResult['N'];
                                            }
                                        }
                                    ?>
                                                    <label for="shn" class="control-label col-lg-2"> HN : </label>
                                                    <div class="col-lg-2">
                                                        <input type="text" class="form-control input-sm input-sm"
                                                            name="hn" id="hn" value="<?php echo $hn; ?>" readonly>
                                                    </div>
                                                    <div class="col-lg-3 pull-right">
                                                        <button type="button" class="btn btn-info btn-grad btn-rect"
                                                            data-toggle="modal"
                                                            data-target="sys_hycall_center_date.php">นัดรับผู้ป่วย</button>
                                                    </div>

                                                </div>
                                                <!-- <hr> -->

                                                <!-- เริ่มการตรวจสอบคนไข้ -->
                                                <?php        
                                                $chn = @$_POST['shn'];
                                                $pl="";
                                                $place_type="";
                                                if($chn <> "")
                                                {    
                                                  $srcSQL = "SELECT hn,pla_placecode FROM ipdtrans
                                                             WHERE TO_DATE(TO_CHAR(datedisch,'yyyy-mm-dd'),'yyyy-mm-dd') is null 
                                                                   AND hn='".$chn."' ";
                                                  $objParse = oci_parse($objConnect, $srcSQL);
                                                  oci_execute($objParse);
                                                  $Num_rows = oci_fetch_all($objParse,$result);

                                                  if($Num_rows > 0) {
                                                    $place_type='IPD';  
                                                    $objParse = oci_parse($objConnect, $srcSQL);
                                                    oci_execute($objParse);
                                                    while ($objResult = oci_fetch_array($objParse, OCI_BOTH)) 
                                                    {
                                                     $pl = $objResult["PLA_PLACECODE"];
                                                    }
                                                  } else {
                                                    $srcSQL = "SELECT
                                                    DISTINCT(b.hn) as hn,a.pla_placecode FROM opds a
                                                    INNER JOIN v_patients b ON b.run_hn =a.pat_run_hn AND b.year_hn = a.pat_year_hn
                                                    WHERE b.hn='".$chn."'AND
                                                        to_date(to_char(a.opd_date,'YYYY-MM-DD'),'YYYY-MM-DD') = TRUNC(sysdate) ";
                                                  $objParse = oci_parse($objConnect, $srcSQL);
                                                  oci_execute($objParse);
                                                  $Num_rows = oci_fetch_all($objParse,$result);

                                                  if($Num_rows > 0) {
                                                    $place_type='OPD';
                                                    $objParse = oci_parse($objConnect, $srcSQL);
                                                    oci_execute($objParse);
                                                    while ($objResult = oci_fetch_array($objParse, OCI_BOTH)) 
                                                    {
                                                     $pl = $objResult["PLA_PLACECODE"];
                                                    }
                                                  }
                                                 }
                                               ?>
                                                <input type="hidden" name="place_type" value="<?php echo $place_type?>">

                                                <!-- // มาตรวจสอบข้อมูลแผนกในระบบ ศูนย์เปล Mysql -->
                                                <?php 
                                                 $idplacefrom = "";
                                                 $query5=mysqli_query($conn,"SELECT placecode,fullplace FROM places WHERE placecode= '".$pl."'
                                                              ORDER BY fullplace") OR die(mysqli_error());
                                                 while($row5=mysqli_fetch_array($query5))
                                                 {
                                                  $idplacefrom .='<option value=" '.$row5['placecode'].'">'.$row5['fullplace'].'</option>';
                                                 }
                                                }
                                               ?>
                                                <!-- หน่วยที่ขอ -->
                                                <div class="form-group">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">Panel Heading</div>

                                                        <label for="idplacefrom" class="col-lg-2 col-form-label"
                                                            align="right">หน่วยร้องขอ :
                                                        </label>
                                                        <div class="col-lg-3">
                                                            <select class="form-control input-sm select2"
                                                                name="idplacefrom" requied>
                                                                <?php echo $idplacefrom;?>
                                                            </select>
                                                        </div>
                                                        <label for="shn" class="control-label col-lg-2">
                                                            <i class="fa fa-user fa-lg"></i>&nbsp; ชื่อ นามสกุล :
                                                        </label>
                                                        <div class="col-lg-4">
                                                            <input type="hidden" name="nname" id="nname"
                                                                value="<?php echo $na; ?>">
                                                            <input type="text" class="form-control input-sm" id="nname"
                                                                value="<?php echo $na; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- ตรวจสอบคนไข้มาในวันนี้ หรือ ยังนอนอยู่ใน Ward หรือไม่-->
                                            <?php
                                                
                                                if($idplacefrom == "") {
                                                    echo '<script type="text/javascript">
                                                               swal("", "ไม่พบคนไข้ที่ค้นหา ในการใช้บริการ ในวันนี้ !!", "success");
                                                               </script>';
                                                    
                                                         echo '<meta http-equiv="refresh" content="5;url=sys_hycall_center_now.php" />';
                                                } 
                                                ?>
                                            <!-- สิ้นสุดการตรวจสอบคนไข้ -->

                                            <!-- ด่วน วิกฤติ -->
                                            <div class="form-group">
                                                <label for="betype" class="col-lg-2 col-form-label" align="right"><a
                                                        class="text text-danger"><strong>ด่วน
                                                            วิกฤติ :</strong></a></label>
                                                <div class="col-lg-10">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="s1"
                                                            id="inlineRadio1" value="S1">
                                                        <label class="form-check-label" for="inlineRadio1">ย้าย
                                                            ผป.วิกฤติไป ICU</label>
                                                        <input class="form-check-input" type="radio" name="s1"
                                                            id="inlineRadio2" value="S2">
                                                        <label class="form-check-label" for="inlineRadio2">เข้า
                                                            OR
                                                            Emergency</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="s1"
                                                                id="inlineRadio1" value="S3">
                                                            <label class="form-check-label" for="inlineRadio1">ESI-L1
                                                                (หยุดหายใจ/หัวใจหยุดเต้น/ชัก/Shock)</label>
                                                            <input class="form-check-input" type="radio" name="s1"
                                                                id="inlineRadio2" value="S4">
                                                            <label class="form-check-label" for="inlineRadio2">STEMI
                                                                เข้ารับทำ PCI</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ด่วนหัตถการ -->
                                            <div class="form-group">
                                                <label for="betype" class="col-lg-2 col-form-label" align="right"><a
                                                        class="text text-danger"><strong>ด่วน หัตถการ
                                                            :</strong></a></label>
                                                <div class="col-lg-10">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="vd1" id="V1"
                                                            value="V1">
                                                        <label class="form-check-label" for="inlineRadio1">ย้าย
                                                            Intervention </label>
                                                        <input class="form-check-input" type="radio" name="vd1"
                                                            id="inlineRadiV2o2" value="V2">
                                                        <label class="form-check-label" for="inlineRadio2">เข้า OR
                                                            CAG</label>
                                                        <input class="form-check-input" type="radio" name="vd1" id="V3"
                                                            value="V3">
                                                        <label class="form-check-label" for="inlineRadio2">เข้า OR
                                                            U/S,CT Emergency</label>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="vd1"
                                                                id="V4" value="V4">
                                                            <label class="form-check-label"
                                                                for="inlineRadio1">Scope</label>
                                                            <input class="form-check-input" type="radio" name="vd1"
                                                                id="V5" value="V5">
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">Hemodiarysis Emer.</label>
                                                            <input class="form-check-input" type="radio" name="vd1"
                                                                id="V6" value="V6">
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">เจ็บท้องจะคลอด/น้ำเดิน</label>
                                                            <input class="form-check-input" type="radio" name="vd1"
                                                                id="V7" value="V7">
                                                            <label class="form-check-label"
                                                                for="inlineRadio1">ESI-L2(V/S Charge ที่จะนำสู่ภาวะ
                                                                Strok) เข้า OR เล็ก</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- ประเภทอุปกรณ์  -->
                                            <div class="form-group">
                                                <label for="idhass" class="col-lg-2 col-form-label"
                                                    align="right">อุปกรณ์ที่ขอ :</label>
                                                <div class="col-lg-3">
                                                    <select class="form-control input-sm select2" name="idhass" requied>
                                                        <?php echo $idhass;?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <!-- อุปกรณ์เพิ่มเติม -->
                                                <label for="bidhass" class="col-lg-2 col-form-label"
                                                    align="right">อุปกรณ์เพิ่มเติม :</label>
                                                <div class="col-lg-3">
                                                    <select class="form-control input-sm select2" name="bidhass"
                                                        requied>
                                                        <?php echo $idhass;?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <!-- ไปส่งที่ -->
                                                <label for="idsend" class="col-lg-2 col-form-label"
                                                    align="right">ไปส่งที่ : </label>
                                                <div class="col-lg-3">
                                                    <select class="form-control input-sm select2" name="idsend" requied>
                                                        <?php echo $idplaceother; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- ไปส่งที่ -->
                                                <label for="idfast" class="col-lg-2 col-form-label" align="right">ประเภท
                                                    การรับ : </label>
                                                <div class="col-lg-3">
                                                    <select class="form-control input-sm select2" name="idfast" requied>
                                                        <?php echo $idfast; ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="ADD" value="ADD">
                                                <div class="col-lg-3 pull-right">
                                                    <button type="submit" class="btn btn-danger btn-grad btn-rect">
                                                        เรียกศูนย์เปล</button>
                                                </div>

                                            </div>
                                            <!-- <hr>
                                                <div class="form-group">
                                                    <label for="datep" class="col-lg-2"
                                                       >นัดรับผู้ป่วย วันที่ : </label>
                                                    <div class="col-lg-2">
                                                        <input type="text" id="datep" name="datep"
                                                            placeholder="วันที่รับนัดผู้ป่วย"
                                                            class="form-control input-sm" value="<?php echo $hn; ?>">
                                                    </div>

                                                    <label for="datep" class="col-lg-3">เวลา : </label>
                                                    <div class="col-lg-2">
                                                        <input type="text" id="datep" name="datep" placeholder="เวลา"
                                                            class="form-control input-sm" value="<?php echo $hn; ?>">
                                                    </div>
                                                </div> -->
                                            <!-- สถานที่รับ -->
                                            <!-- <div class="form-group">
                                                    <label for="name" class="col-lg-2 col-form-label"
                                                        align="right">ไปรับที่ :
                                                    </label>
                                                    <div class="col-lg-3">
                                                        <select class="form-control input-sm select2" name="idplacefrom"
                                                            requied>
                                                            <?php echo $idplaceother; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="didhass" class="col-lg-2 col-form-label"
                                                        align="right">อุปกรณ์ที่ขอ :</label>
                                                    <div class="col-lg-3">
                                                        <select class="form-control input-sm select2" name="didhass"
                                                            requied>
                                                            <?php echo $idhass;?>
                                                        </select>
                                                    </div>

                                                    <label for="dbidhass" class="col-lg-2 col-form-label"
                                                        align="right">อุปกรณ์เพิ่มเติม :</label>
                                                    <div class="col-lg-2">
                                                        <select class="form-control input-sm select2" name="dbidhass"
                                                            requied>
                                                            <?php echo $idhass;?>
                                                        </select>
                                                    </div>
 -->
                                </div>

                                <!--ประมลผลหน้าเวบ -->
                                <!-- <hr> -->
                                <?php
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$endtime = $mtime;
$totaltime = ($endtime - $starttime);
?>
                                <span class="help-block" style="color: #c8c8c8; font-size: 12px;">
                                    <i class="fa fa-clock-o">
                                    </i> ใช้เวลาในการประมวลผลหน้านี้
                                    <?php echo number_format($totaltime, 4);?> วินาที
                                </span>
                                <span class="help-block" style="color:#a9b0aa; font-size: 12px;">
                                    <i class="fa fa-hand-o-right ">
                                    </i> หน้านี้ถูกเปิดดูทั้งหมด
                                    <?php echo $count;?> ครั้ง
                                </span>
                                <!--เลื่อนขึ้นบน -->
                                <a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
                                    <i class="fa fa-angle-double-up">
                                    </i> Back To Top
                                </a>
                            </div>
                        </div>
                    </div>
                    <script>
                    $(function() {
                        Metis.MetisTable();
                        Metis.metisSortable();
                    });
                    </script>
                </div><!-- /#content -->
                <?php 
		require("main_footer_panel.php");
	?>
            </div>
            <script type="text/javascript" src="assets/js/jquery.js">
            </script>
            <script type="text/javascript" src="assets/js/jquery.min.js">
            </script>
            <script type="text/javascript" src="assets/js/jquery-ui.min.js">
            </script>
            <script type="text/javascript" src="assets/lib/moment/min/moment.min.js">
            </script>
            <script type="text/javascript" src="assets/lib/fullcalendar/dist/fullcalendar.min.js">
            </script>
            <!--TABLE  -->
            <script type="text/javascript" src="assets/js/jquery.dataTables.min.js">
            </script>
            <script type="text/javascript" src="assets/js/dataTables.bootstrap.js">
            </script>
            <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js">
            </script>
            <script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js">
            </script>
            <!--Bootstrap -->
            <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js">
            </script>
            <!-- MetisMenu -->
            <script type="text/javascript" src="assets/js/metisMenu.min.js">
            </script>
            <!-- Screenfull -->
            <script type="text/javascript" src="assets/js/screenfull.min.js">
            </script>
            <!-- Metis core scripts -->
            <script type="text/javascript" src="assets/js/core.min.js">
            </script>
            <script type="text/javascript">
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ]

                });
            });
            </script>

            <script src="plugins/select2/select2.full.min.js"></script>
            <script>
            $(function() {
                $(".select2").select2();
            });
            </script>
    </body>
    <?php 
    // oci_close($objConnect);
    ?>

</html>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>