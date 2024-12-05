<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="script.js"></script>
    <link type="text/css" rel="stylesheet" href="jquery.autocomplete.css" />
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="jquery.autocomplete.js"></script>
</head>

<?php
require_once('db/date_format.php');
require_once("db/connection.php");
require_once('function/conv_date.php');
require_once('db/connect_pmk.php');
include('main_script.php');
?>

<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>

<?php
// $SQLass = mysqli_query($conn,"SELECT assetid,assname
//           FROM sys_asset  Where asstype='0'
//           ORDER BY assname") OR die(mysqli_error());
?>

<body>
    <p>
    <div class="container-fluid">
        <form class="form-horizontal" action="sys_hycurr_db.php" method="POST" target="" name="formq" id="formq">
            <div class="col-md-3">
                <div class="inner bg-light lter">
                    <div class="box">
                        <header>
                            <div class="icons">
                                <i class='fa fa-user fa-1x'></i>
                            </div>
                            <h5>รายละเอียด คนไข้</h5>
                        </header>
                        <p>

                        <div class="form-group">
                            <label class="col-xs-4" align="right">ห้องตรวจ :</label>
                            <div class="col-xs-8">
                                <select name="places" class="form-control select2" id="places">
                                <option value=""></option>
                                <?php
                                    $strSQL2 = "SELECT * FROM places WHERE pt_place_type_code IN ('1','2') 
                                                WHERE DEL_FLAG IS NULL
                                                ORDER BY PLACECODE ASC"; 
                                    $objParse2 = oci_parse($objConnect, $strSQL2);  
                                    oci_execute ($objParse2,OCI_DEFAULT);   
                                    while($objResult2 = oci_fetch_array($objParse2,OCI_BOTH)) 
                                    { 
                                    ?>
                                      <option value="<?=$objResult2["PLACECODE"];?>">
                                      <?=$objResult2["PLACECODE"]."-".$objResult2["HALFPLACE"];?>
                                     </option>
                                    <?php
                                    }                                                                  
                                ?>
                                </select>                                  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4" align="right">HN :</label>
                            <div class="col-md-5">
                                <input type="text" id="shn" name="shn" placeholder="HN หรือ เลขบัตรประขาขน"
                                    class="form-control round-input" value="<?php echo $hn; ?>">
                            </div>
                            <div class="col-lg-3">
                                <input type="submit" class="btn btn-success btn-grad" value="S"
                                    onclick="JavaScript:fncSubmit('pmk')" />
                            </div>
                        </div>

                        <!-- ค้นหาคนไข้ -->
                    <?php
                    if ($_REQUEST['type'] == 'pmk') {
                        $strSQL="SELECT 
                            VP.HN,TO_CHAR(O.OPD_DATE,'dd-mm-yyyy') AS DD,O.PLA_PLACECODE,TO_CHAR(O.OPD_TIME,'HH:MM:SS'),
                            VP.ID_CARD,(VP.PRENAME||VP.NAME||' '||VP.SURNAME) AS pname,
                            P.FULLPLACE,TRUNC(months_between(sysdate, BIRTHDAY)/12) as age
                            FROM OPDS O
                            INNER JOIN V_PATIENTS VP ON (O.PAT_RUN_HN||'/'||O.PAT_YEAR_HN)=VP.HN 
                            INNER JOIN PLACES P ON P.PLACECODE=O.PLA_PLACECODE AND
                            TO_CHAR(O.OPD_DATE,'dd-mm-yyyy') = '04-08-2021'
                            WHERE HN='".$_REQUEST['shn']."' OR ID_CARD='".$_REQUEST['shn']."'";
                        $objParse = oci_parse($objConnect, $strSQL);
                        oci_execute($objParse);
                        $Num_Rows = oci_fetch_all($objParse, $Result);
                    
                        if(($Num_Rows)<1){
                            echo '<script type="text/javascript">
                                    swal("","ไม่พบรายการข้อมูลใช้บริการ ในขณะนี้ !!","error");
                                 </script>';
                        }else {
                            oci_execute($objParse,OCI_DEFAULT);
                            while($objResult = oci_fetch_array($objParse,OCI_BOTH))
                                {
                                    $prename=$objResult['PRENAME'];
                                    $name=$objResult['NAME'];
                                    $surname=$objResult['SURNAME'];
                                    $hn=$objResult['HN'];
                                    $na=$objResult['PNAME'];
                                    $old=$objResult['AGE'];
                                    $idcard=$objResult['ID_CARD'];
                                }
                        }
                        ?>
                    <?php
                    }
                    ?>
                    <hr>

                        <div class="form-group">
                            <label class="col-xs-4" align="right">HN :</label>
                            <div class="col-xs-5">
                                <label><?= $idcard ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4" align="right">AN :</label>
                            <div class="col-xs-5">
                                <label><?= $idcard ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-4" align="right">บปช :</label>
                            <div class="col-xs-5">
                                <label><?= $idcard ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-4" align="right">อายุ :</label>
                            <div class="col-xs-5">
                                <label> <?= $old ?> </label>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-2">
                                <label class="control-label col-lg-1"></label>
                                <img src="ViewImage.php?hn=<?= $hn ?>" alt="SEARCH" style="width:80px;height:90px;">
                            </div>
                        </div> -->
                    </div>

                </div>
            </div>


            <!-- รายละเอียดข้อมูลจากการค้นหา -->
            <div class="col-md-5">
                <div class="inner bg-light lter">
                    <div class="box">
                        <header>
                            <div class="icons">
                                <i class="fa fa-calendar fa-lg" aria-hidden="true"></i>
                            </div>
                            <h5>เคลื่อนย้ายเวชภัณฑ์และสิ่งของ วันที่:
                                <?php echo $d_default; ?>
                                <?php echo $current_server_time?>
                            </h5>
                        </header>
                        <p>
                            <?php
                    $SQLplb = mysqli_query($conn,"SELECT placecode,fullplace
                                FROM places ORDER BY fullplace") OR die(mysqli_error());

                    $SQLplc = mysqli_query($conn,"SELECT placecode,fullplace
                                FROM places ORDER BY fullplace") OR die(mysqli_error());

                    $SQLpld = mysqli_query($conn,"SELECT id,unit
                    FROM sys_unit WHERE status ='0'ORDER BY unit") OR die(mysqli_error());

                    $SQLpmk = mysqli_query($conn,"SELECT hn,name
                    FROM sys_ipdtrans  ORDER BY hn") OR die(mysqli_error());

                    
                    ?>
                        <div class="container-fluid">
                            <p>
                            <div class="col-md-12">
                                <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>
                                <div class="form-group">
                                    <label class="col-md-3" align="right">HN :</label>
                                    <div class="col-md-9">
                                        <input type="text" disabled id="shn" name="shn"
                                            placeholder="HN หรือ เลขบัตรประขาขน" class="form-control round-input"
                                            value="<?php echo $hn.' '.$na;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3" align="right"> รายการ :</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="assf" id="assf">
                                            <option value="" selected disabled>(เลือกรายการ)</option>
                                            <?php
                                            while($row1=mysqli_fetch_array($SQLass))
                                            {
                                            ?>
                                            <option value="<?php echo $row1['assetid'];?>">
                                                <?php echo $row1['assname'];?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- รายละเอียดรายการ -->
                                <div class="form-group">
                                    <label for="assdet" class="col-md-3 col-form-label" align="right">รายละเอียด :
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="assdet" rows="3"></textarea>
                                    </div>
                                    <div class="col-lg-1"></div>
                                </div>

                                <!-- ไปรับที่ -->
                                <div class="form-group">
                                    <label class="col-md-3 col-form-label" align="right">หน่วยร้องขอ :</label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="assfplace">
                                            <option value="" selected disabled>(เลือกรายการ)</option>
                                            <?php
                                        while($row1=mysqli_fetch_array($SQLplb))
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
                                    <label for="idsend" class="col-md-3 col-form-label" align="right">ส่งปลายทาง :
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control select2" name="asstplace">
                                            <option value="" selected disabled>(เลือกรายการ)</option>
                                            <?php
                                        while($row1=mysqli_fetch_array($SQLplc))
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
                                    <label for="idsend" class="col-md-3 col-form-label" align="right">จำนวน : </label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="notot" value="0">
                                    </div>
                                    <div class="col-md-3">หน่วยนับ : </div>
                                    <div class="col-md-4">
                                        <select class="form-control select2" name="unit">
                                            <option value="" selected disabled>(เลือก)</option>
                                            <?php
                                        while($rows=mysqli_fetch_array($SQLpld))
                                        {
                                        ?>
                                            <option value="<?php echo $rows['id'];?>">
                                                <?php echo $rows['unit'];?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 col-form-label" align="right"></label>
                                    <input type="hidden" name="DADD" value="DADD">
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success btn-grad"><i
                                                class="fa fa-bell"></i>
                                            ขอใช้บริการ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p>
                            <p>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!--ส่วนแสดงรายการ กราฟ  -->
        <div class="col-md-4">
            <div class="inner bg-light lter">
                <div class="box">
                    <header>
                        <div class="icons">
                            <i class="fa fa-clinic-medical fa-lg" aria-hidden="true"></i>
                        </div>
                        <h5>เคลื่อนย้ายเวชภัณฑ์และสิ่งของ วันที่:
                            <?php echo $d_default; ?>
                            <?php echo $current_server_time?>
                        </h5>
                    </header>
                    <?php
                    $sql = "SELECT * FROM v_logistic_pie where hdate = '$d_default' ";
                    
                    $result = mysqli_query($conn, $sql);
                    $content = [];
                    if (mysqli_num_rows($result) > 0) {
                        
                        while($row = mysqli_fetch_assoc($result)) {
                            $content[] = [
                                'name' => $row['assname'],
                                'value' => $row['tot']
                            ];
                        }
                    }

                    // mysqli_close($conn);
                    ?>
                    <div id="container" style="height: 450%"></div>
                    <script type="text/javascript" src="assets/js/echarts.min.js"></script>
                    <script type="text/javascript">
                    var dom = document.getElementById("container");
                    var myChart = echarts.init(dom);

                    var seriesData = <?=json_encode($content)?>;

                    option = {
                        title: {
                            text: 'รายงานแสดงยอดเบิกตามช่วงวัน',
                            subtext: 'วันที่ :<?php echo $d_default ;?>',
                            x: 'center'
                        },
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },

                        series: [{
                            name: 'รายงานแสดงยอดเบิกตามช่วงวัน',
                            type: 'pie',
                            data: seriesData,
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }]
                    };

                    if (option && typeof option === "object") {
                        myChart.setOption(option, true);
                    }
                    </script>

                </div>
            </div>
        </div>
    </div>
    <p>
    <p>
    <p>

        <!-- script for Program -->
        <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
        <script type="text/javascript">
        $(function() {
            $("#assf").change(function() {
                if (($(this).val() == 2) || ($(this).val() == 11)) {
                    $("#hn").removeAttr("disabled");
                    $("#hn").focus();
                } else {
                    $("#hn").attr("disabled", "disabled");
                }
            });
        });
        </script>
        <script src="assets/plugins/select2/select2.full.min.js"></script>

        <script>
        $(function() {
            $(".select2").select2();

            // ใช้สำหรับการทำ Multiple select
            // $(".js-example-basic-multiple-limit").select2({
            //     maximumSelectionLength: 2
            // });
        });
        </script>

        <script>
        function fncSubmit(strPage) {
            if (strPage == "pmk") {
                document.formq.action = "?page=regis&type=pmk";
            }
        }
        </script>

<script type="text/javascript">
$(document).ready(function() {
    $("#places").change(function() {
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


</body>

</html>