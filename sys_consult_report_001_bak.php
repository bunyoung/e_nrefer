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

    /* .table {
        width: 100%;
        margin-bottom: 20px;
    }

    .table-striped tbody>tr:nth-child(odd)>td,
    .table-striped tbody>tr:nth-child(odd)>th {
        background-color: #f9f9f9;
    } */

    /* @media print {
        #print {
            display: none;
        }
    } */

    /* #print {
        width: 100px;
        height: 30px;
        font-size: 18px;
        background: white;
        border-radius: 4px;
        margin-left: 10px;
        cursor: hand;
    } */
    </style>

</head>

<body onLoad="window.print()">
    <?php
	    $result= mysqli_query($conn,"select * from v_asmonitor_b where hyitem='$htem' ") 
                 or die (mysqli_error());
        $row=mysqli_fetch_array ($result);
    ?>

    <div id="header">
        <br />
        <!-- <div class="row"> -->
        <div class="col-md-4">
            <img src="img/hy.png"
                style="margin-top:-20px;float:left; margin-right:100px; margin-bottom:-6px; width:100px; height:100px;">
        </div>
        <div class="col-md-6">
            <h5 style="font-weight:bold;margin-top:-10px;text-align:center;">รหัสงาน<h3>
                    <h5 style="font-weight:bold;font-size:20px;margin-top:-10px;text-align:center;">
                        <?php echo $row['dgroup'].'-'.$row['hyitem'];?></h5>
                    <hr style="font-weight:bold;margin-top:-10px;text-align:center;">
        </div>
        <!-- </div> -->
    </div>

    <div class="container-fluid">
        <br />
        <hr>
        <center>
            <h4 style="margin-top:-14px;">ใบมอบหมายงาน<?php echo $row['assname'];?></h4>
        </center>
        <table class="cell-border table-condensed table-sm">
        <tr>
                <th width="40%">ประเภท</th>
                <td><?php echo $row['assname'];?> </td>
            </tr>
            <tr>
                <th width="40%">เตรียมรับ</th>
                <td><?php echo $row['hostype'];?> </td>
            </tr>
            <tr>
                <th width="40%">จำนวน</th>
                <td><?php echo $row['peramt'].' '.$row['unit'];?></td>
            </tr>
            <tr>
                <th width="40%">รายละเอียดเพิ่มเติม</th>
                <td><?php echo $row['assetdet'];?></td>
            </tr>
            <!-- <tr>
                <th width="40%">ผู้ป่วย</th>
                <td><?php echo $row['hn'].' '.$row['ptname'];?></td>
            </tr> -->
            <tr>
                <th width="40%">สถานที่รับ</th>
                <td><?php echo $row['nfplace'];?></td>
            </tr>
            <tr>
                <th width="40%">สถานที่ส่ง</th>
                <td><?php echo $row['ntplace'];?></td>
            </tr>
            <tr>
                <th width="40%">วันที่ร้องขอ</th>
                <td><?php echo $row['hdate'];?></td>
            </tr>
            <tr>
                <th width="40%" t>เวลาร้องขอ</th>
                <td><?php echo trim($row['htime']);?> น.</td>
            </tr>
            <tr>
                <th width="40%">เวลาจ่ายงาน</th>
                <td><?php echo trim($row['x1_pertime']);?> น.</td>
            </tr>

            <tr>
                <th width="40%">ร้องขอ-จ่ายงาน</th>
                <td><?php echo trim($row['metime']);?> นาที</td>
            </tr>
            <tr>
                <th width="40%">ผู้รับงาน</th>
                <td><?php echo $row['name'];?></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
            <tr>
                <th width="40%">ลายเซ็นต์</th>
                <td>..................................</td>
            </tr>
            <tr>
                <th width="40%"></th>
                <td>ผู้ขอใช้บริการ</td>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
            <tr>
                <th width="40%">ลายเซ็นต์</th>
                <td>..................................</td>
            </tr>
            <tr>
                <th width="40%"></th>
                <td>ผู้รับปลายทาง</td>
            </tr>

            <tr>
                <th></th>
                <td></td>
            </tr>
            <tr>
                <th width="40%">วันที่พิมพ์</th>
                <td><?php echo $d_default.' '.$time;?> น.</td>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
            <tr>
                <th></th>
                <td></td>
            </tr>
        </table>
        <br />
        <br />
    </div>
</body>


</html>