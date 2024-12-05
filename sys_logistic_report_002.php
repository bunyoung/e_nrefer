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
        height: 10px;
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
	    $result= mysqli_query($conn,"select * from v_asmonitor_a where hyitem='$htem' ") 
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
                        <?php echo $row['dgroup'].'-'.$row['hyitem'];?>
                    </h5>
                    <hr style="font-weight:bold;margin-top:-10px;text-align:center;">
        </div>
    </div>

    <div class="container">
        <hr>
        <center>
            <h4 style="margin-top:-14px;">ใบรับ<?php echo $row['assname'];?></h4>
        </center>
        <!-- cell-border table-condensed table-sm -->
        <table class="styled-table" style="font-size:13px;">
            <tr>
                <th>วันที่</th>
                <td><?php echo $row['hdate'];?></td>
            </tr>
            <tr>
                <th>หน่วยงานร้องขอ</th>
                <td><?php echo $row['nfrompmkplace'];?></td>
            </tr>
            <tr>
                <th>สถานที่รับ</th>
                <td><?php echo $row['nfromplace'];?></td>
            </tr>
            <tr>
                <th>สถานที่ส่ง</th>
                <td><?php echo $row['ntplace'];?></td>
            </tr>
            <tr>
                <th>HN</th>
                <td><?php echo $row['hn'];?></td>
            </tr>
            <tr>
                <th width="10%"></th>
                <td><img src="barcode39.php?barcode=<?php echo $row['hn'].'&width=320&height=100';?>" /> </td>
            </tr>
            <tr>
                <th>ชื่อ-สกุล ผู้ป่วย</th>
                <td><?php echo $row['pname'];?></td>
            </tr>
            <tr>
                <th>ID</th>
                <td><?php echo $row['idcard'];?></td>
            </tr>
            <tr>
                <th>OPD/WARD</th>
                <td><?php echo $row['nfrompmkplace'];?></td>
            </tr>

            <tr>
                <th>รายการผลิตภัณฑ์</th>
            </tr>
            
            <!-- 1 -->
            <?php
              $plas=$row['pcr'];$untp=$row['idpcr'];
              $cyro=$row['lprc'];$ucry=$row['idlprc'];
            ?>
            <tr>
                <td width="4%">PRC     : 
                   <?php if($plas == 0){$plas='';  $untp='';}?>
                   <?php echo $plas;?>
                   <?php echo $untp;?>               
                </td>
                <td width="4%">LPRC  : 
                   <?php if($cyro == 0){$cyro='';  $ucry='';}?>
                   <?php echo $cyro;?>
                   <?php echo $ucry;?>
                </td>
            </tr>
            
            <!-- 2 -->
            <?php
              $plas=$row['ffp'];$untp=$row['idffp'];
              $cyro=$row['crp'];$ucry=$row['idcrp'];
            ?>
            <tr>
                <td width="4%">FFP     : 
                    <?php if($plas == 0){$plas='';  $untp='';}?>
                    <?php echo $plas;?>
                    <?php echo $untp;?>               
                </td>
                <td width="4%">CRP   : 
                   <?php if($cyro == 0){$cyro='';  $ucry='';}?>
                   <?php echo $cyro;?>
                   <?php echo $ucry;?>
                </td>
            </tr>
            
            <!-- 3 -->
            <?php
              $plas=$row['plasma'];$untp=$row['idplasma'];
              $cyro=$row['cryo'];$ucry=$row['idcryo'];
            ?>
            <tr>
                <td>PLATE : 
                    <?php if($plas == 0){$plas='';  $untp='';}?>
                    <?php echo $plas;?>
                    <?php echo $untp;?>
                </td>
                <td>Cryo : 
                <?php if($cyro == 0){$cyro='';  $ucry='';}?>
                    <?php echo $cyro;?>
                    <?php echo $ucry;?>
                </td>
            </tr>
            <?php
              $ldrc=$row['ldrc'];$idldrc=$row['idldrc'];
            ?>
            <tr>
                <td>LDRC : 
                    <?php if($ldrc == 0){$ldrc='';  $idldrc='';}?>
                    <?php echo $ldrc;?>
                    <?php echo $idldrc;?>
                </td>
            </tr>
            <tr>
                <th>รายละเอียดเพิ่มเติม</th>
                <td><?php echo $row['other'];?></td>
            </tr>
            <tr>
                <th>ความเร่งด่วน</th>
                <td><?php echo $row['drug_argent'];?></td>
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
                <td></td>
            </tr>
            <tr>
                <th>ลายเซ็นต์</th>
                <td>..................................</td>
            </tr>
            <tr>
                <th></th>
                <td>เจ้าหน้าที่ต้นทาง (<?php echo $row['nfromplace'];?>) </td>
            </tr>
            <tr>
                <th>ลายเซ็นต์</th>
                <td>..................................</td>
            </tr>
            <tr>
                <th></th>
                <td>เจ้าหน้าที่ปลายทาง (<?php echo $row['ntplace'];?>)</td>
            </tr>

            <tr>
                <th></th>
                <td></td>
            </tr>
        </table>
        <br />
        <div class="row">
            <label class="col-lg-2" style="font-size:10px;margin-right:center;">วันที่พิมพ์
                :<?php echo $d_default.' '.$time;?> น. </label>
        </div>
    </div>
</body>

</html>