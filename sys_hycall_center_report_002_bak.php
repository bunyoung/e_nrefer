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
$date_curr_dm_defult=date('d/m/');
$date_curr_y_defult=date('Y')+543;
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
        height: 8px;
        font-size: 9px;
        background: white;
        border-radius: 1px;
        margin-left: 0px;
        cursor: hand;
    }
    </style>
</head>

<body onLoad="window.print();">
    <?php
	    $result= mysqli_query($conn,"select * from v_monitor where hyitem='$htem' ") 
                 or die (mysqli_error());
        $rs=mysqli_fetch_array ($result);
    ?>

    <div id="header">
        <div class="col-md-4">
            <img src="img/hy.png" style="margin-top:0px;float:left;margin-bottom:-6px; width:90px; height:90px;">
        </div>
        <div class="col-md-6">
            <h5 style="font-weight:bold;font-size:18px;margin-top:10px;text-align:center;">รหัสงาน<h5>
                    <h5 style="font-weight:bold;font-size:20px;margin-top:-10px;text-align:center;">
                        <?php echo $rs['hyitem'];?>
                    </h5>
                    <hr style="font-weight:bold;margin-top:-10px;text-align:center;">
        </div>
    </div>

    <div class="container">
        <hr>
        <center>
            <h4 style="margin-top:-14px;">ใบรับเคลื่อนย้ายผู้ป่วย</h4>
        </center>
        <!-- cell-border table-condensed table-sm -->
        <table class="styled-table" style="font-size:13px;margin-top:-30px;">
            <tr>
                <th>วันที่</th>
                <td><?php echo $rs['hdate'];?></td>
            </tr>
            <tr>
                <th>หน่วยงานร้องขอ</th>
                <td>..................................</td>
            </tr>
            <tr>
                <th>สถานที่รับ</th>
                <td><?php echo $rs['fplace'];?></td>
            </tr>
            <tr>
                <th>สถานที่ส่ง</th>
                <td><?php echo $rs['tplace'];?></td>
            </tr>
            <tr>
                <th></th>
                <td>..................................</td>
            </tr>

            <tr>
                <th>HN</th>
                <td><?php echo $rs['hn'];?></td>
            </tr>
            <tr>
                <th width="10%"></th>
                <td><img src="barcode39.php?barcode=<?php echo $rs['hn'].'&width=320&height=100';?>" /> </td>
            </tr>
            <tr>
                <th>ชื่อ-สกุล ผู้ป่วย</th>
                <td><?php echo $rs['patients'];?></td>
            </tr>
            <tr>
                <th>ID</th>
                <td><?php echo $rs['idcard'];?></td>
            </tr>
            <tr>
                <th>อายุ</th>
                <td><?php echo $rs['old'];?> ปี</td>
            </tr>

            <tr>
                <th>OPD/WARD</th>
                <td>..................................</td>
            </tr>
            <tr>
                <th></th>
                <td>..................................</td>
            </tr>

            <tr>
                <th>รายละเอียดเพิ่มเติม</th>
            </tr>
            <tr>
                <th>สถานะงาน</th>
                <td><?php echo $rs['fasts_name'];?></td>
            </tr>
            <tr>
                <th>ชนิดรถ/อุปกรณ์</th>
                <td><?php echo $rs['hassnamea'];?></td>
            </tr>
            <tr>
                <th></th>
                <td>..................................</td>
            </tr>

            <tr>
                <th>เวลาร้องขอ</th>
                <td><?php echo trim($rs['htime']);?> น.</td>
            </tr>
            <tr>
                <th>เวลาจ่ายงาน</th>
                <td><?php echo trim($rs['x1_pertime']);?> น.</td>
            </tr>

            <tr>
                <th>ร้องขอ-จ่ายงาน</th>
                <td><?php echo $rs['metime'];?> นาที</td>
            </tr>
            <tr>
                <th>ผู้รับงาน</th>
                <td><?php echo ว.$rs['pers'].' '.$rs['name'];?></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
            <tr>
                <th>ลายเซ็นต์</th>
                <td>..................................หน่วยงานต้นทาง</td>
            </tr>
            <br>
            <tr>
                <th></th>
                <td>เจ้าหน้าที่ต้นทาง </td>
            </tr>
            <br>
            <tr>
                <th>ลายเซ็นต์</th>
                <td>..................................หน่วยงานปลายทาง</td>
            </tr>
            <tr>
                <th></th>
                <td>เจ้าหน้าที่ปลายทาง</td>
            </tr>

            <tr>
                <th></th>
                <td></td>
            </tr>
        </table>
        <br />
        <div class="rs">
            <label class="col-lg-2" style="font-size:10px;margin-right:center;">วันที่พิมพ์
                :<?php echo $d_default.' '.$time;?> น. </label>
        </div>
    </div>
</body>

</html>