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
    <?php
            include ('main_script.php');
        ?>
    <!-- ใช้เรียกเวลาจาก server -->
    <script language="JavaScript1.2">
    function server_date(now_time) {
        current_time1 = new Date(now_time);
        current_time2 = current_time1.getTime() + 1000;
        current_time = new Date(current_time2);
        server_time.innerHTML = current_time.getDate() + "/" + (current_time.getMonth() + 1) + "/" +
            current_time
            .getYear() + " " + current_time.getHours() + ":" + current_time.getMinutes() + ":" + current_time
            .getSeconds();
        setTimeout("server_date(current_time.getTime())", 1000);
    }
    setTimeout("server_date('<?=$current_server_time?>')", 1000);
    </script>
    <?php
            $current_server_time = date("H:i:s");
        ?>

    <body>
        <script>
        $(function() {
            Metis.dashboard();
        });
        </script>
        <!--เริ่มเนื้อหาตรงนี้  -->
        <p>
            <!-- ส่วนย่อย -->
        <form class="form-horizontal" action="sys_hycurr_db.php" method="POST" target="" name="formq" id="formq">
            <div class="col-lg-4">
                <p>
                <div class="panel-group">
                    <div class="panel panel-info">
                        <div class="panel-heading"><a class="text text-success"><strong>ค้นหา ผู้ป่วย</strong></a>
                        </div>
                        <p>
                            <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>

                        <div class="form-group">
                            <label for="shn" class="control-label col-lg-1"></label>
                            <div class="col-lg-8">
                                <input type="text" id="shn" name="shn" placeholder="เลข HN"
                                    class="form-control round-input" value="<?php echo $hn; ?>">
                            </div>
                            <div class="col-lg-2">
                                <input type="submit" class="btn btn-success btn-grad" id="Search" value="ค้นหา"
                                    onclick="JavaScript:fncSubmit('pmk')" />
                            </div>
                        </div>

                        <!-- แสดงรูปภาพ -->
                        <div class="container">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="col-lg-2">
                                        <label for="pc" class="control-label col-lg-1"></label>
                                        <img src="ViewImage.php?hn=<?= $_REQUEST['shn'] ?>" alt="SEARCH"
                                            style="width:80px;height:90px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <p>
                <div class="panel-group">
                    <div class="panel panel-info">
                        <div class="panel-heading"><a class="text text-warning"><strong>ประจำวันที่
                                    <?php echo $d_default; ?>:
                                    <?php echo $current_server_time?></div>
                        <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                        </strong>
                        </a>
                        <?php
                                        $na="";
                                        $hn="";
                                        $pl="";
                                        $place_type="";
                                        $idplacefrom = "";
                                        $fromplace = "";

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
                        <?php      
                             $chn = @$_POST['shn'];
                             // if($chn <>''){    
                             if(isset($chn)){    
                                $srcSQL = "SELECT hn,pla_placecode FROM ipdtrans
                                                WHERE TO_DATE(TO_CHAR(datedisch,'yyyy-mm-dd'),'yyyy-mm-dd') is null 
                                                AND hn='".$chn."' ";
                                $objParse = oci_parse($objConnect, $srcSQL);
                                                oci_execute($objParse);
                                $num_rows = oci_fetch_all($objParse,$result);
                                if($Num_rows > 0) {
                                    $place_type='IPD';  
                                    $objParse = oci_parse($objConnect, $srcSQL);
                                    oci_execute($objParse);
                                    while ($objResult = oci_fetch_array($objParse, OCI_BOTH)) {
                                        $pl = $objResult["PLA_PLACECODE"];
                                        return ;
                                     }
                                } else {
                                    $srcSQL = "SELECT
                                    DISTINCT(b.hn) as hn,a.pla_placecode FROM opds a
                                    INNER JOIN v_patients b ON b.run_hn =a.pat_run_hn AND b.year_hn = a.pat_year_hn
                                    WHERE b.hn='".$chn."' AND to_date(to_char(a.opd_date,'YYYY-MM-DD'),'YYYY-MM-DD') = TRUNC(sysdate) ";
                                    $objParse = oci_parse($objConnect, $srcSQL);
                                              oci_execute($objParse);
                                    $Num_rows = oci_fetch_all($objParse,$result);
                                    if($Num_rows > 0) {
                                        $place_type='OPD';
                                        $objParse = oci_parse($objConnect, $srcSQL);
                                       oci_execute($objParse);
                                       while ($objResult = oci_fetch_array($objParse, OCI_BOTH)) {
                                                $pl = $objResult["PLA_PLACECODE"];
                                        }
                                    }
                                }
                               ?>
                        <input type="hidden" name="place_type" value="<?php echo $place_type?>" required>
                        <?php
                                $query5=mysqli_query($conn,"SELECT placecode,fullplace FROM places WHERE placecode= '".$pl."'
                                   ORDER BY fullplace") OR die(mysqli_error());
                                while($row5=mysqli_fetch_array($query5)) {
                                    $idplacefrom =$row5['placecode'];  
                                    $fromplace=$row5['fullplace'];
                                }
                            }
                           if(empty($idplacefrom)) {
                                echo '<script type="text/javascript">
                                        swal("", "ไม่พบคนไข้ที่ค้นหา ในการใช้บริการ ในวันนี้ !!", "error");
                                </script>';
                                return false;
                           }
                           ?>
                        <!-- หน่วยที่ขอ -->
                        <input type="hidden" name="idplacefrom" value="<?php echo $idplacefrom;?>">
                        <div class="form-group">
                            <p>
                                <label for="shn" class="control-label col-lg-2" align="right"> ไปรับผู้ป่วยที่ :
                                </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" autocomplete="off"
                                    value="<?php echo $fromplace; ?>" required readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shn" class="control-label col-lg-2"> HN : </label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="hn" id="hn" autocomplete="off"
                                    value="<?php echo $hn; ?>" required readonly>
                            </div>
                            <label for="shn" class="control-label col-lg-2">ชื่อ-สกุล
                                :</label>
                            <div class="col-lg-5">
                                <input type="hidden" name="nname" id="nname" value="<?php echo $na; ?>">
                                <input type="text" class="form-control" id="nname" value="<?php echo $na; ?>" readonly
                                    required>
                            </div>
                        </div>
                        <!-- สิ้นสุดการตรวจสอบคนไข้ -->
                        <hr>
                        <div class="form-group ">
                            <label class="col-form-label col-lg-2" align="right"> ความเร่งด่วน : </label>
                            <div class="col-lg-8">
                                <div class="form-check form-check-inline">
                                    <label for="default" class="btn btn-danger">ด่วนที่สุด (15 นาที) <input
                                            type="checkbox" id="default" name="qa" value="ด่วนที่สุด"></label>
                                    <label for="primary" class="btn btn-warning">ด่วน (25 นาที) <input type="checkbox"
                                            id="primary" name="qb" value="ด่วน"></label>
                                    <label for="primary" class="btn btn-success">ทั่วไป (35 นาที)<input type="checkbox"
                                            id="primary" name="qc" value="ทั่วไป"></label>
                                </div>
                            </div>
                        </div>

                        <!-- อุปกรณ์ -->
                        <div class="form-group">
                            <label for="bidhass" class="col-form-label col-lg-2" align="right">ชนิดรถเข็น :</label>
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="ca" value="รถเข็นนั่ง" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        รถเข็นนั่ง
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="cb" value="รถเข็นนอน" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        รถเข็นนอน
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="cc" value="รถเข็นนอนเด็ก" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        รถเข็นนอนเด็ก
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- อุปกรณ์เพิ่มเติม -->
                            <label for="sidhass" class="col-lg-2 col-form-label" align="right">อุปกรณ์เสริม
                                :</label>
                            <div class="col-lg-3">
                                <input class="form-check-input" type="checkbox" name="da" value="ออกซิเจน" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    ออกซิเจน
                                </label>
                                <input class="form-check-input" type="checkbox" name="db" value="เสาน้ำเกลือ" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    เสาน้ำเกลือ
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sidhass" class="col-lg-2 col-form-label" align="right">ผู้ป่วย :</label>
                            <div class="col-lg-3">
                                <input class="form-check-input" type="checkbox" name="sa" value="CRE" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    CRE
                                </label>
                                <input class="form-check-input" type="checkbox" name="sb" value="PUI/COVID-19" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    PUI/COVID-19
                                </label>
                            </div>
                        </div>
                        <!-- ไปส่งที่ -->
                        <div class="form-group">
                            <label for="idsend" class="col-lg-2 col-form-label" align="right">ไปส่งที่ : </label>
                            <div class="col-lg-5">
                                <select class="form-control input-sm select2" name="idplaceother" required>
                                    <!-- <option value="">(เลือกรายการที่ต้องการ)</option> -->
                                    <?php
$query5=mysqli_query($conn,"SELECT placecode,fullplace FROM places ORDER BY fullplace") OR die(mysqli_error());
while($row1=mysqli_fetch_array($query5))
                                                                {
                                                                    ?>
                                    <option value="<?php echo $row1['placecode'];?>">
                                        <?php echo '['.$row1['placecode'].']'.'  '.$row1['fullplace'];?>
                                    </option>
                                    <?php
                                                                        }
                                                                        ?>
                                </select>
                            </div>
                            <input type="hidden" name="ADD" value="ADD">
                            <div class="col-lg-5 pull-right">
                                <button type="submit" class="btn btn-danger btn-grad">
                                    <i class="fa fa-bell"></i>
                                    เรียกศูนย์เปล</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
        $(function() {
            Metis.MetisTable();
            Metis.metisSortable();
        });
        </script>
