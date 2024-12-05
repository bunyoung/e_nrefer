<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-hycenter</title>
</head>

<?php
// require_once('db/date_format.php');
require_once('db/connect_pmk.php');
require_once("db/connection.php");
require_once('function/conv_date.php');
include('main_script.php');
?>
<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>

<body>
    <div class="inner bg-light lter" style="margin-top:-20px;">
        <form class="form-horizontal" action="sys_hycurr_db.php" method="POST" target="" name="formq" id="formq">
            <div class="col-md-4">
                <div class="box">
                    <header>
                        <div class="icons">
                            <button id="export_to_excel2" class="btn btn-success btn-xs btn-grad">
                                <i class="fa fa-wheelchair-alt" aria-hidden="true"></i></button>
                        </div>
                        <h5 id="div1"><a class="text-success">ค้นหาข้อมูลผู้ป่วยจากระบบงาน โรงพยาบาล</a>
                        </h5>
                    </header>
                    <br>
                    <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                    <div class="form-group">
                        <div class="col-md-9">
                            <input type="text" id="shn" name="shn" placeholder="HN หรือ เลขบัตรประขาขน"
                                class="form-control round-input" value="<?php echo $hn; ?>" style="margin-left:10px;">
                        </div>
                        <div class="col-md-2">
                            <input type="submit" class="btn btn-success btn-grad" id="Search" value="แฟ้ม PMK"
                                onclick="JavaScript:fncSubmit('pmk')" />
                        </div>
                    </div>
                    <?php
                        if ($_REQUEST['type'] == 'pmk') {
                            $strSQL = "SELECT ID_CARD,HN,PRENAME,NAME,SURNAME,(PRENAME||NAME||' '||SURNAME) as n,
                                            trunc(months_between(sysdate, BIRTHDAY)/12) as age,TEL
                                        FROM v_patients
                                    WHERE HN='".$_REQUEST['shn']."' OR ID_CARD='".$_REQUEST['shn']."'  ";
                            $objParse = oci_parse($objConnect, $strSQL);
                            oci_execute($objParse);
                            $Num_Rows = oci_fetch_all($objParse, $Result);
                            if(($Num_Rows)<1){
                                echo '<script type="text/javascript">
                                swal("", "ไม่พบรายการข้อมูลใช้บริการ ในขณะนี้ !!" , "error");
                            </script>';
                            }else {
                            oci_execute($objParse,OCI_DEFAULT);
                            while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                                {
                                    $prename=$objResult['PRENAME'];
                                    $name=$objResult['NAME'];
                                    $surname=$objResult['SURNAME'];
                                    $hn=$objResult['HN'];
                                    $na=$objResult['N'];
                                    $old=$objResult['AGE'];
                                    $idcard=$objResult['ID_CARD'];
                                    $tel=$objResult['TEL'];
                                }
                            }
                            ?>
                    <?php
                        }
                        ?>
                    <?php 
                    include('main_control_patients.php'); 
                    ?>
                </div>
                <?php
                include('main_control_message.php');
                ?>

            </div>
            <div class="col-md-8">
                <div class="box">
                    <header>
                        <div class="icons">
                            <button id="export_to_excel2" class="btn btn-success btn-xs btn-grad">
                                <i class="fa fa-wheelchair-alt" aria-hidden="true"></i></button>
                        </div>
                        <h5 id="div1"><a class="text-success">รายละเอียดกรายการข้อมูล</a>
                        </h5>
                    </header>
                    <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                    </strong>
                    <p>
                    <div class="form-group">
                        <label for="shn" class="control-label col-md-2"> HN : </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control autotab" name="hn" id="hn" autocomplete="on"
                                value="<?php echo $hn; ?>" disabled>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="nname" autocomplete="off"
                                value="<?php echo $na; ?>" disabled>
                        </div>
                    </div>

                    <!-- สิ้นสุดการตรวจสอบคนไข้ -->
                    <?php
                  $SQLhyass = mysqli_query($conn,"SELECT hyass,assname
                                           FROM hyass
                                           Where asstatus <> '1'
                                           ORDER BY hyindex") OR die(mysqli_error());
                  $SQLfast = mysqli_query($conn,"SELECT *
                                           FROM fast_sick_a
                                           Where fasts_status <> '1'
                                           ORDER BY fasts_name") OR die(mysqli_error());
                  $SQLid = mysqli_query($conn,"SELECT hassid,hassname
                                           FROM hass Where hasstatus<>'1'
                                           ORDER BY hassname") OR die(mysqli_error());

                  $SQLcpl = mysqli_query($conn,"SELECT placecode,fullplace
                  FROM places ORDER BY hassindex") OR die(mysqli_error());

                  $SQLpl = mysqli_query($conn,"SELECT placecode,fullplace
                  FROM places ORDER BY hassindex") OR die(mysqli_error());

                  $SQLpla = mysqli_query($conn,"SELECT placecode,fullplace
                                           FROM places ORDER BY fullplace") OR die(mysqli_error());
                  $SQLplb = mysqli_query($conn,"SELECT placecode,fullplace
                                           FROM places ORDER BY fullplace") OR die(mysqli_error());
                  $SQLplc = mysqli_query($conn,"SELECT placecode,fullplace
                                           FROM places ORDER BY fullplace") OR die(mysqli_error());
                  $SQLida = mysqli_query($conn,"SELECT hassid,hassname
                                           FROM hass_one Where hasstatus<>'1'
                                           ORDER BY hassindex") OR die(mysqli_error());
                    $SQLuser = mysqli_query($conn,"SELECT u_user_id,name
                                    FROM user_pmk  WHERE u_user_id NOT IN ('rgst','create_use','ckgadmin','food','cc','labolink','lab')
                                    ORDER BY name") OR die(mysqli_error());

                    $SQLfast = mysqli_query($conn,"SELECT fasts_id,fasts_name
                                FROM fast_sick_a  WHERE fasts_status='0' ORDER BY hyorder") OR die(mysqli_error());
?>
                    <!-- <hr> -->
                    <div class="form-group">
                        <label for="sidhass" class="col-md-2 col-form-label" align="right">ผู้ป่วย :</label>
                        <div class="col-md-10">
                            <input class="form-check-input" type="checkbox" name="sa" value="CRE" />
                            <label class="form-check-label" for="flexCheckDefault">
                                CRE
                            </label>
                            <input class="form-check-input" type="checkbox" name="sb" value="PUI/COVID-19" />
                            <label class="form-check-label" for="flexCheckDefault">
                                PUI/COVID-19
                            </label>
                            <input class="form-check-input" type="checkbox" name="sc" value="TB" />
                            <label class="form-check-label" for="flexCheckDefault">
                                TB
                            </label>
                            <input class="form-check-input" type="checkbox" name="sd" value="NU" />
                            <label class="form-check-label" for="flexCheckDefault">
                                NEURO INTERVENTION
                            </label>
                            <input class="form-check-input" type="checkbox" name="st" value="ST" />
                            <label class="form-check-label" for="flexCheckDefault">
                                STROKE FASTRACK
                            </label>
                            <input class="form-check-input" type="checkbox" name="mi" value="MI" />
                            <label class="form-check-label" for="flexCheckDefault">
                                MI FASTRACK
                            </label>
                            <input class="form-check-input" type="checkbox" name="or" value="OR" />
                            <label class="form-check-label" for="flexCheckDefault">
                                เข้า OR ด่วนที่สุด
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sidhass" class="col-md-2 col-form-label" align="right"></label>
                        <div class="col-md-10">
                            <?php 
                                    if($surname=='EMS') {
                                       ?>
                            <input class="form-check-input" type="checkbox" checked name="ems" value="EMS" />
                            <button class="btn btn-danger" type="button">EMS</button>
                            <?php    
                                    }
                                    ?>
                        </div>
                    </div>

                    <!-- หน่วยร้องขอ -->
                    <div class="form-group">
                        <label for="idsend" class="col-md-2 col-form-label" align="right">หน่วยร้องขอ : </label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="callplace">
                                <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                                <?php
                       while($rs1=mysqli_fetch_array($SQLcpl))
                       {
                       ?>
                                <option value="<?php echo $rs1['placecode'];?>">
                                    <?php echo '['.$rs1['placecode'].']'.'  '.$rs1['fullplace'];?>
                                </option>
                                <?php
                       }
                       ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="idhyass" class="col-md-2 col-form-label" align="right">จุดประสงค์เพื่อ :
                        </label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="hyass">
                                <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                                <?php
                        while($row1=mysqli_fetch_array($SQLhyass))
                        {
                        ?>
                                <option value="<?php echo $row1['hyass'];?>">
                                    <?php echo '['.$row1['hyass'].']'.' '.$row1['assname'];?>
                                </option>
                                <?php
                        }
                     ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="idhyass" class="col-md-2 col-form-label" align="right">ความเร่งด่วน :
                        </label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="fast">
                                <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                                <?php
                        while($rs2=mysqli_fetch_array($SQLfast))
                        {
                        ?>
                                <option value="<?php echo $rs2['fasts_id'];?>">
                                    <?php echo '['.$rs2['fasts_id'].']'.' '.$rs2['fasts_name'];?>
                                </option>
                                <?php
                        }
                     ?>
                            </select>
                        </div>
                    </div>

                    <!-- อุปกรณ์ -->
                    <div class="form-group">
                        <label for="aidhass" class="col-md-2 col-form-label" align="right">วิธีการเคลื่อนย้าย
                            :</label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="aidhass">
                                <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                                <?php
                     while($row2=mysqli_fetch_array($SQLid))
                     {
                     ?>
                                <option value="<?php echo $row2['hassid'];?>">
                                    <?php echo '['.$row2['hassid'].']'.' '.$row2['hassname'];?>
                                </option>
                                <?php
                     }
                     ?>
                            </select>
                        </div>
                    </div>

                    <!-- อุปกรณ์เพิ่มเติม -->
                    <div class="form-group">
                        <label for="bidhass" class="col-md-2 col-form-label" align="right">อุปกรณ์ต้องการเพิ่ม
                            :</label>
                        <div class="col-md-8">
                            <select class="form-control  select2" name="bidhass">
                                <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                                <?php
                     while($row2=mysqli_fetch_array($SQLida))
                     {
                     ?>
                                <option value="<?php echo $row2['hassid'];?>">
                                    <?php echo '['.$row2['hassid'].']'.' '.$row2['hassname'];?>
                                </option>
                                <?php
                     }
                     ?>
                            </select>
                        </div>
                    </div>

                    <!-- ไปรับที่ -->
                    <div class="form-group">
                        <label for="idsend" class="col-md-2 col-form-label" align="right">สถานที่รับ :
                        </label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="fromplace">
                                <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                                <?php
                       while($row1=mysqli_fetch_array($SQLpl))
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
                    </div>

                    <!-- ไปรับที่ -->
                    <div class="form-group">
                        <label for="idsend" class="col-md-2 col-form-label" align="right">สถานที่่ส่ง : </label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="toplace">
                                <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                                <?php
                       while($row1=mysqli_fetch_array($SQLpla))
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
                    </div>

                    <div class="form-group">
                        <label for="idsuser" class="col-md-2 col-form-label" align="right">ผู้บันทึก : </label>
                        <div class="col-md-4">
                            <select class="form-control select2" name="suser">
                                <option value="" selected disabled>(เลือกรายการที่ต้องการ)</option>
                                <?php
                       while($rs=mysqli_fetch_array($SQLuser))
                       {
                       ?>
                                <option value="<?php echo $rs['u_user_id'];?>">
                                    <?php echo '['.$rs['u_user_id'].']'.'  '.$rs['name'];?>
                                </option>
                                <?php
                       }
                       ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="hn" value="<?php echo $hn; ?>" />
                        <input type="hidden" name="nname" value="<?php echo $na; ?>" />
                        <input type="hidden" name="nidcard" value="<?php echo $idcard; ?>" />
                        <input type="hidden" name="nold" value="<?php echo $old; ?>" />
                        <label for="idsend" class="col-md-2 col-form-label" align="right"></label>
                        <input type="hidden" name="ADD" value="ADD">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success btn-grad"><i class="fa fa-bell"></i>
                                เรียกศูนย์เปล</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<br>

</html>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->

<script type="text/javascript">
$(function() {
    $("#search_user").autocomplete({
        source: 'ajax-user-search.php',
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#sel_hyass").change(function() {
        var fssid = $(this).val();
        $.ajax({
            url: 'get_data.php',
            type: 'post',
            data: {
                fs: fssid
            },
            dataType: 'json',
            success: function(response) {
                var len = response.length;
                $("#sel_fast").empty();

                for (var i = 0; i < len; i++) {
                    var fasts_id = response[i]['fasts_id'];
                    var fasts_name = response[i]['fasts_name'];

                    $("#sel_fast").append("<option value='" + fasts_id + "'>" + fasts_name +
                        "</option>");
                }
            }
        });
    });
});
</script>

<script src="assets/plugins/select2/select2.full.min.js"></script>
<script>
$(function() {
    $(".select2").select2();
});
</script>