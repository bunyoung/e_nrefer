<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="script.js"></script>
    <!-- <link type="text/css" rel="stylesheet" href="jquery.autocomplete.css" />
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="jquery.autocomplete.js"></script> -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
</head>
<style>
@media screen and (min-width: 768px) {
    .modal-dialog {
        width: 1024px;
        /* New width for default modal */
    }

    .modal-sm {
        width: 350px;
        /* New width for small modal */
        display: inline-block;

    }

    .modal-lg {
        width: 900px;
        /* New width for large modal */
    }

    .centered {
        text-align: center;
        font-size: 0;
    }

    .centered>div {
        float: none;
        display: inline-block;
        text-align: left;
        font-size: 13px;
    }

}

/* กำหนด highlight */
tr.custom--success td {
    background-color: #3399ff !important;
    /*custom color here*/
}

tr.custom--success1 td {
    background-color: #3399ff !important;
    /*custom color here*/
}

/*กำหนด cursor ให้เป็นรูป pointer สำหรับ click table*/
.table-hover tbody tr:hover>td {
    cursor: pointer;
}

.finger img {
    cursor: pointer;
}

/* กำหนดให้ modal อยู่กลางจอ */
.modal-dialog {
    position: absolute;
    top: 50px;
    right: 100px;
    bottom: 0;
    left: 0;
    z-index: 10040;
    overflow: auto;
    overflow-y: auto;
}

th {
    background-color: #0099FF;
    color: white;
}

tr {
    line-height: 25px;
    min-height: 25px;
    height: 25px;
}
</style>
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
$SQLplb = mysqli_query($conn,"SELECT placecode,fullplace
            FROM places ORDER BY fullplace") OR die(mysqli_error());

$SQLplc = mysqli_query($conn,"SELECT placecode,fullplace
            FROM places ORDER BY fullplace") OR die(mysqli_error());

$SQLpld = mysqli_query($conn,"SELECT id,unit
FROM sys_unit WHERE status ='0'ORDER BY unit") OR die(mysqli_error());

$SQLass = mysqli_query($conn,"SELECT assetid,assname
FROM sys_asset  Where asstype='0'
ORDER BY assname") OR die(mysqli_error());

// $SQLpmk = mysqli_query($conn,"SELECT hn,name
// FROM sys_ipdtrans  ORDER BY hn") OR die(mysqli_error());
?>

<body>
    <p>
    <div class="container-fluid">
        <div class="row">
            <form action="sys_hycurr_db.php" method="POST" target="" name="formq" id="formq">
                <input type="hidden" name=ddate id=ddate value=<?php echo $d_default;?>>

                <div class="col-md-8">
                    <a href="#">
                        <div class="panel panel-default">
                            <div class="panel-heading"><span class="glyphicon glyphicon-send"></span>
                    </a>
                    บริการงานเคลื่อนย้ายสิ่งของ
                </div>
                <div class="panel-body">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="opd" class="label-control">หน่วยงานบริการ ผู้ป่วยนอก /
                                            ใน</label>
                                        <select name="assfplace" class="form-control select2" id="place">
                                            <option value=""></option>
                                            <?php 
                                                    $strSQL2 = "SELECT * FROM places WHERE pt_place_type_code IN ('1','2') 
                                                    AND DEL_FLAG IS NULL
                                                    ORDER BY PLACECODE ASC"; 
                                                    $objParse2 = oci_parse($objConnect, $strSQL2);  
                                                    oci_execute ($objParse2,OCI_DEFAULT);   
                                                    while($objResult2 = oci_fetch_array($objParse2,OCI_BOTH)) 
                                                    { 
                                                    ?>
                                            <option value="<?=$objResult2["PLACECODE"];?>">
                                                <?=$objResult2["PLACECODE"]." - ".$objResult2["HALFPLACE"];?>
                                            </option>
                                            <?php
                                                    }                                                                  
                                                ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="hn">HN/AN ชื่อ-สกุล</label>
                                        <select class="form-control select2" name="hn" id="state">
                                            <option value="">ชื่อ-สกุล</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="pcr">PCR/unit</label>
                                        <input type="text" class="form-control input-sm" name="pcr" value="">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="pcr">LPRC/unit</label>
                                        <input type="text" class="form-control input-sm" name="lprc" value="">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="ffp">FFP/unit</label>
                                        <input type="text" class="form-control input-sm" name="ffp" value="">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="crp">CRPunit</label>
                                        <input type="text" class="form-control input-sm" name="crp" value="">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="plasma">PLASMA/unit</label>
                                        <input type="text" class="form-control input-sm" name="plasma" value="">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="pca">PC/unit</label>
                                        <input type="text" class="form-control input-sm" name="pca" value="">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="cryo">Cryo/unit</label>
                                        <input type="text" class="form-control input-sm" name="crto" value="">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="pcb">PC/unit</label>
                                        <input type="text" class="form-control input-sm" name="pcb" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="oth">อื่นๆ:</label>
                                        <input type="text" class="form-control input-sm" name="oth" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="desc">ความต้องการในการบริการ</label>
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
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="assdet">รายละเอียดเพิ่มเติมสำหรับรายการ</label>
                                        <textarea class="form-control" name="assdet" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="asstplace">สถานที่ส่งปลายทาง</label>
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
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="idsend">จำนวน/หน่วย</label>
                                        <input type="text" class="form-control input-sm" name="notot" value="">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="unit">หน่วยนับ</label>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <!-- <label for="add" align="right"></label> -->
                                <input type="hidden" name="DADD" value="DADD">
                                <button type="submit" class="btn btn-success btn-grad">
                                    <span class="glyphicon glyphicon-ok-circle"></span>
                                    ลงบันทึกขอใช้บริการ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </form>

    <!-- ส่วนแสดงกราฟ -->

    <div class="col-md-4">
        <div class="panel panel-default">
            <a href="#">
                <div class="panel-heading panel-primary">
                    <span class="glyphicon glyphicon-send"></span>
            </a>
            บริการงานเคลื่อนย้ายสิ่งของ
        </div>
        <div class="panel-body">
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
            <div id="container" style="height: 350%"></div>
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
    <p>
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
            $("#place").on("change", function() {
                var placeid = $(this).val();
                if (placeid) {
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        cache: false,
                        data: {
                            placeid: placeid
                        },
                        success: function(data) {
                            $("#state").html(data);
                            // $('#city').html('<option value="">Select state</option>');
                        }
                    });
                }
            });
        });
        </script>
</body>

</html>