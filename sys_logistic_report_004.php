<!doctype html>
<meta http-equiv="content-type" content=";text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php 
include('main_script.php');
include('db/connection.php');
?>
<html>
<?php
$htem=@$_GET['id'];
?>

<!-- // วันที่ปัจจุบัน    -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
$time = date("H:i:s");    
?>

<head>
    <title>Logistic Manage System</title>

    <style>
    .container {
        width: 100%;
        margin: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 0px;
        margin-top: 0px;
        margin-left: 0px;
        margin-right: 0px;
        padding: 0px;
    }

    .table-striped tbody>tr:nth-child(odd)>td,
    .table-striped tbody>tr:nth-child(odd)>th {
        background-color: #f9f9f9;
    }

    @media print {
        #print {
            display: none;
        }
    }

    #print {
        width: 100px;
        height: 10px;
        font-size: 9px;
        background: white;
        border-radius: 1px;
        margin-left: 0px;
        cursor: hand;
    }
    </style>

</head>

<body onLoad="window.print()">
    <?php
	    $result= mysqli_query($conn,"select * from v_asmonitor_d where hyitem='$htem' ") 
                 or die (mysqli_error());
        $row=mysqli_fetch_array ($result);
    ?>

    <div id="header">
        <div class="col-md-4">
            <img src="img/hy.png" style="margin-top:0px;float:left;margin-bottom:-6px; width:90px; height:90px;">
        </div>
        <div class="col-md-6">
            <h5 style="font-weight:bold;font-size:18px;margin-top:10px;text-align:center;">รหัสงาน<h5>
                    <h5 style="font-weight:bold;font-size:20px;margin-top:-10px;text-align:center;">
                        <?php echo $row['dgroup'].'-'.$row['hyitem'];?></h5>
                    <br>  
                    <!-- <hr style="font-weight:bold;margin-top:-10px;text-align:center;"> -->
        </div>
    </div>

    <div class="container">
        <br>
        <br>
        <center>
            <h4 style="margin-top:-12px;">ใบขอใช้บริการทำความสะอาด</h4>
        </center>
        <table class="styled-table" style="font-size:13px;">
            <tr>
                <th>ประเภท</th>
                <td>ขอใช้บริการทำความสะอาด</td>
            </tr>
            <tr>
                <th>หน่วยร้องขอ</th>
                <td><?php echo $row['ftplace'];?> </td>
            </tr>
            <tr>
                <th>ตึก</th>
                <td><?php echo $row['nbuild'];?></td>
            </tr>
            <tr>
                <th>ชั้น</th>
                <td><?php echo $row['floor'];?></td>
            </tr>
            <tr>
                <th>พื้นที่/ภาระกิจ</th>
                <td><?php echo $row['clean_place'];?></td>
            </tr>
            <tr>
                <th>ระดับความสะอาด</th>
                <td><?php echo $row['lvc'];?></td>
            </tr>
            <tr>
                <th>รายละเอียดเพิ่มเติม</th>
                <td><?php echo $row['assetdet'];?></td>
            </tr>
            <tr>
                <th>ความเร่งด่วน</th>
                <td><?php echo $row['clean_argent'];?></td>
            </tr>
            <tr>
                <th>วันที่ร้องขอ</th>
                <td><?php echo $row['hdate'];?></td>
            </tr>
            <tr>
                <th>เวลาร้องขอ</th>
                <td><?php echo trim($row['htime']);?> น.</td>
            </tr>
            <tr>
                <th>เวลาจ่ายงาน</th>
                <td><?php echo trim($row['x1_pertime']);?> น.</td>
            </tr>

            <tr>
                <th>ร้องขอ-จ่ายงาน</th>
                <td><?php echo trim($row['metime']);?> นาที</td>
            </tr>
            <tr>
                <th>ผู้รับงาน</th>
                <td><?php echo $row['name'];?></td>
            </tr>
            <tr>
                <th></th>
                <!-- <td></td> -->
            </tr>
            <tr>
                <th>ลายเซ็นต์</th>
                <br>
                <td>..................................</td>
            </tr>
            <tr>
                <th></th>
                <td>ผู้ขอใช้บริการ (<?php echo $row['ftplace'];?>)</td>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
        </table>
        <p>
            <hr>
        <div class="row">
            <label class="col-lg-2" style="font-weight:bold;" for="">ผลการประเมินประจำวันโดย
                (<?php echo $row['ftplace'];?>)</label>
        </div>
        <p>
        <p>
        <div class="row">
            <label class="col-lg-2" for=""><i class="fa fa-square-o fa fa-lg" aria-hidden="true"></i> ดีมาก</i>
                <i class="fa fa-square-o fa fa-lg" aria-hidden="true"></i> ดี</i>
                <i class="fa fa-square-o fa fa-lg" aria-hidden="true"></i> พอใช้</i>
                <i class="fa fa-square-o fa fa-lg" aria-hidden="true"></i> ควรปรับปรุง</i>
            </label>
        </div>
        <br>
        <div class="row">
            <label class="col-lg-2" style="font-weight:bold;" for="">ลงชื่อผู้ประเมิน
                ....................................</label>
        </div>
        <br>
        <div class="row">
            <label class="col-lg-2" style="font-weight:bold;" for="">วันที่......./....../..........
                เวลา..................</label>
        </div>

        <hr>
        <div class="row">
            <label class="col-lg-2" style="font-weight:bold;" for="">ผลการประเมินประจำวันโดยศูนย์ HYs-MEST</label>
        </div>
        <p>
        <p>
        <div class="row">
            <label class="col-lg-2" for=""><i class="fa fa-square-o fa fa-lg" aria-hidden="true"></i> ดีมาก</i>
                <i class="fa fa-square-o fa fa-lg" aria-hidden="true"></i> ดี</i>
                <i class="fa fa-square-o fa fa-lg" aria-hidden="true"></i> พอใช้</i>
                <i class="fa fa-square-o fa fa-lg" aria-hidden="true"></i> ควรปรับปรุง</i>
            </label>
        </div>
        <br>
        <div class="row">
            <label class="col-lg-2" style="font-weight:bold;" for="">ลงชื่อผู้ประเมิน
                ....................................</label>
        </div>
        <br>
        <div class="row">
            <label class="col-lg-2" style="font-weight:bold;" for="">วันที่......./....../..........
                เวลา..................</label>
        </div>
        <br />
        <div class="row">
            <label class="col-lg-2" style="font-size:10px;margin-right:center;">วันที่พิมพ์
                :<?php echo $d_default.' '.$time;?> น. </label>
        </div>
        <br />
    </div>
</body>


</html>