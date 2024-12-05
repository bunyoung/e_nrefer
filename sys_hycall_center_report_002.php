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
        $sick = $rs['sicka'].' '.$rs['sickb'].' '.$rs['sickc'].$rs['sickd'].' '.$rs['sicke'].' '.$rs['sickf'].$rs['sickg'];
    ?>
    <div align="center">
            <img src="img/hy.png" width="70px" height="60px">
        </div>
        <div class="col-md-12">
            <h6 style="font-weight:bold;font-size:16px;margin-top:10px;text-align:center;">รหัสงาน<h6>
        </div>
    </div>
    <center>
        <img src="barcode39.php?barcode=<?php echo $rs['hyitem'].'&width=200&height=40';?>" />
    </center>
    <div class="container">
        <center>
            <h4 style="margin-top:10px;">ใบรับเคลื่อนย้ายผู้ป่วย</h4>
        </center>
        <br> 
        <table class="styled-table" style="font-size:12px;margin-top:0px;">
            <tr>
                <th width="10%">วันที่</th>
                <td><?php echo $rs['hdate'];?></td>
            </tr>
            <tr>
                <th>หน่วยงานร้องขอ</th>
                <td><?php echo $rs['cplace'];?></td>
            </tr>
            <tr>
                <th>ผู้ร้องขอ</th>
                <td><?php echo $rs['namepmk'];?></td>
            </tr>
            <tr>
                <th></th>
                <td>.....................................................</td>
            </tr>
            <tr>
                <th>สถานที่รับ</th>
                <td><?php echo $rs['fplace'];?></td>
            </tr>
            <tr>
                <th></th>
                <td>.....................................................</td>
            </tr>
            <tr>
                <th>สถานที่ส่ง</th>
                <td><?php echo $rs['tplace'];?></td>
            </tr>
            <tr>
                <th></th>
                <td>.....................................................</td>
            </tr>           
            <tr>
                <th></th>
                <td><img align="center" src="barcode39.php?barcode=<?php echo $rs['hn'].'&width=200&height=40';?>" /> </td>
            </tr>
            <tr>
                <th>ชื่อ-สกุล ผู้ป่วย</th>
                <td><?php echo $rs['patients'];?></td>
            </tr>
            <tr>
                <th>บปช</th>
                <td><?php echo '********'.substr($rs['idcard'],7,6);?></td>
            </tr>
            <tr>
                <th>อายุ</th>
                <td><?php echo $rs['old'];?> ปี</td>
            </tr>
            <tr>
                <th>AN</th>
                <td style="font-weight: bold;"><?php echo $rs['an'];?></td>
            </tr>
            <tr>
                <th>เตียง</th>
                <td><?php echo $rs['bedno'];?></td>
            </tr>
            <tr>
                <th>OPD/WARD</th>
                <td><?php echo $rs['fplace'];?></td>
            </tr>
            <tr>
                <th>ความเร่งด่วน</th>
                <td><?php echo $rs['fasts_name'];?></td>
            </tr>
            <tr>
                <th>ชนิดรถ</th>
                <td><?php echo $rs['hassnamea'];?></td>
            </tr>
            <tr>
                <th>อุปกรณ์ต้องการเพิ่ม</th>
                <td><?php echo $rs['hassname'];?></td>
            </tr>
            
             <tr>
                <th></th>
                <td>.....................................................</td>
            </tr>
            <tr>
                <th>ผู้ป่วยเฉพาะ</th>
                <td><?php echo $rs['sicka'].' '.$rs['sickb'].' '.$rs['sickc'].' '.$rs['sickd'].' '.$rs['sicke'].' '.$rs['sickf'].' '.$rs['sickg'].' '.$rs['sicki'].' '.$rs['sickj']; ?></td>
            </tr>
            <tr>
                <th>จุดประสงค์เพื่อ</th>
                <td><?php echo $rs['assname'];?></td>
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
                <td><?php echo $rs['name'];?></td>
            </tr>
        </table>
        <br /><br />
        <div class="rs">
            <label class="col-lg-2" class="col-lg-2"
                style="font-size:11px;margin-left: -12px;">ลายเซ็นต์.....................................................</label>
        </div>
        <div class="rs">
            <label class="col-lg-2" class="col-lg-2"
                style="font-size:11px;">เจ้าหน้าที่ต้นทาง  (<?php echo $rs['fplace'];?> )</label>
        </div>
        <br />

        <div class="rs">
            <label class="col-lg-2" class="col-lg-2"
                style="font-size:11px;margin-left: -12px;">ลายเซ็นต์....................................................</label>
        </div>
        <div class="rs">
            <label class="col-lg-2" style="font-size:11px;">เจ้าหน้าที่ปลายทาง (<?php echo $rs['tplace'];?> )</label>
        </div>
        <br />
        <div class="rs">
            <label class="col-lg-2" style="font-size:10px;margin-left: -12px;">วันที่พิมพ์
                :<?php echo $d_default.' '.$time;?> น. </label>
        </div>
    </div>
</body>

</html>