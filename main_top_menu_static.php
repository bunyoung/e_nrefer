<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> e-Refer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="date_time.js"></script>
</head>

<?php 
$date_start_m_defult='01/';
$date_start_y_defult=date('Y')+543;
$date_start_dmy_defult=$date_start_d_defult.$date_start_m_defult.$date_start_y_defult;
// 01/m/y+543

$date_end_dm_defult=date('d/m/');
$date_end_y_defult=date('Y')+543;
$date_end_dmy_defult=$date_end_dm_defult.$date_end_y_defult;

$date_curr_dm_defult=date('d/m/');
$date_curr_y_defult=date('Y')+543;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
// วันที่ปัจจุบัน
$d_default=$date_curr_dmy_defult;
?>
<body>
    <div class="top" style="padding:0px 0px 0px">
        <nav class="collapse navbar-collapse" id="myNavbar" style="background-color:#1976D2;">
            <header class=" navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </header>
            <div class="top-nav">
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <i class="fa fa-bar-chart fa-2x" aria-hidden="true" style="color:#ec6a45;width:55px;height:50px;margin-top: 7px;
                                border:0px;float:left;"></i>
                        </li>
                        <li style="margin-top: 15px;left: 5px; color:#ffff;font-family:'K2D';font-size:20px;margin-top:12px;">
                            ประจำวันที่ : <span style="color:#C6FF00"> <?php echo $d_default; ?></span>
                            <i class="fa fa-clock-o" aria-hidden="true" style="color:#FFFF8D;"></i>
                            <span id="date_time" style="color:#C6FF00"></span>
                        </li>
                    </ul>
                    <script type="text/javascript">
                            window.onload = date_time('date_time');
                    </script>
                    <!-- <ul class="nav navbar-nav navbar-right">
                       <li>
                            <a class="text text-metis-4 btn-grad" href="dashboard.php"
                                style="color:#FFFF8D;font-size:22px;">
                                <i class="fa fa-sign-out fa-lg"> </i>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" ></script>
</body>

</html>
<!-- Modal ส่วนการดูประวัติการใช้งาน-->
<div class="modal fade" id="hisModaluse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" style="font-family:'sarabun';font-size: 18px;color:#222831">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">ข้อมูลประวัติการเข้าสู่ระบบ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-family:'sarabun';font-size: 18px;color:#222831">
                <div class="row-fluid">
                    <h4><?php echo '['.$_SESSION['hcode'].']  '.$_SESSION["hosname"];?></h4>
                    <hr>
                    <div class="row-fluid">
                        <table id="sataTable" class="table table-sm table-bordered" style="width:100%;">
                            <thead
                                style="background-color:#3498DB;color:#F7F5F2;font-family:'sarabun';font-size:16px;font-size:Bold;">
                                <tr align="center">
                                    <td>ลำดับ</td>
                                    <td>IP address</td>
                                    <td>Login</td>
                                    <td>สถานะ</td>
                                    <td>Logout</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                While($rs=mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php    $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                                        </center>
                                    </td>
                                    <td>
                                        <center><?php echo $rs['ipaddress']; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $rs['logintime'];?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $rs['status']; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $rs['logouttime']; ?></center>
                                    </td>
                                </tr>
                                <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- สิ้นสุด -->

<!-- Modal ติดตัังระบบการเชือมต่อ-->
<div class="modal fade" id="hisModalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" style="font-family:'sarabun';font-size: 16px;color:#222831">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">เปลี่ยนรหัสผ่าน</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <h4><?php echo '['.$_SESSION['hcode'].']  '.$_SESSION["hosname"];?></h4>
                    <hr>
                    <form action="insert_regis_hosdb.php" method="POST">
                        <div class="form-group row">
                            <label for="" class="col-sm-3">รหัสผ่านเดิม :</label>
                            <div class="col-sm-2">
                                <input type="password" class="form-control form-control" name="oldpassw" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">รหัสผ่านใหม่ :</label>
                            <div class="col-sm-2">
                                <input type="password" class="form-control form-control" name="npasswa" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">ยืนยันอีกครั้ง :</label>
                            <div class="col-sm-2">
                                <input type="password" class="form-control form-control" name="npasswb" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="hosuser" id="" value="pw">
                            <input type="hidden" name="hoseid" id="" value="<?php echo $_SESSION['hcode']; ?>" <div
                                class="col-sm-10">
                            <label class="col-sm-3 col-form-label col-form-label"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-primary"
                                    style="color:#FAFAFA;font-size:20px;background-color:#0b0111;" type="submit">
                                    <i class="fa fa-hospital-o" aria-hidden="true" style="color:#FFEB3B;"></i>
                                    เปลี่ยนรหัสผ่าน
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->

<!-- Modal ขอเปิดใช้ระบบโปรแกรม -->
<div class="modal fade" id="certModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" style="font-family:'sarabun';font-size: 18px;color:#222831">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">ใบคำขอเปิดใช้ระบบโปรแกรม RMC refer </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-family:'sarabun';font-size: 18px;color:#222831">
                <div class="row-fluid" style="text-align:center;">
                    <h4><?php echo '['.$_SESSION['hcode'].']  '.$_SESSION["hosname"];?></h4>
                    <hr>
                    <?php
                    $cs='';
                    $sql="SELECT * FROM rf_cert WHERE hcode='$hcode' ";
                    $rss=mysqli_query($conn,$sql);
                    while($rs=mysqli_fetch_array($rss)){
                        $hospital = $rs['hospital'];
                        $cstat=$rs['cert_status'];
                        if($cstat == 'N' || $cstat==''){
                            $cs="รออนุมัติตอบกลับ";
                        }else{
                            $cs="อนุมัติเปิดใช้ระบบ";
                        }
                    }
                    ?>

                    <form action=" insert_regis_hosdb.php" method="POST">
                        <div class="form-group row">
                            <label for="" class="col-md-12" style="text-align:center;">
                                <strong> คำขอดำเนินการ </strong> <br><br> ด้วยทาง
                                รพ.:<?php echo '['.$_SESSION['hcode'].']  '.$_SESSION["hosname"];?>
                                จะขอดำเนินการเปิดใช้ระบบงานการเคลื่อนย้ายคนไข้
                                Refer<br>จึงขออนุญาตเปิดใช้ระบบงานส่วนนี้ <br> จึงแจ้งความประสงค์มาดังกล่าว
                            </label>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12" style="text-align:center;">
                                <input type="checkbox" class="form-control form-control" name="cert" <?php 
                                    if($cstat=='Y'){
                                        ?> checked readonly <?php
                                    }else{
                                        ?> unchecked <?php
                                    } ?>>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-12" style="text-align:center;">สถานะการขออนุมัติ</label>
                        </div>

                        <div class="form-group row">
                            <input type="hidden" name="hosuser" id="" value="cert">
                            <input type="hidden" name="hcode" id="" value="<?php echo $_SESSION['hcode']; ?>"
                                class="col-sm-10">
                            <label class="col-sm-4 col-form-label col-form-label"></label>
                            <div class="col-sm-12">
                                <?php
                                if($cstat=='N' || $cstat==''){
                                ?>
                                <button class="btn btn-primary"
                                    style="color:#FAFAFA;font-size:20px;background-color:#0033AA; text-align:center;"
                                    type="submit">
                                    <i class="fa fa-list-alt" aria-hidden="true" style="color:#FFEB3B;"></i>
                                    ยืนยันขอเปิดใช้ระบบ
                                </button>
                                <?php
                                }else{
                                    ?>
                                <button class="btn btn-primary disabled"
                                    style="color:#FAFAFA;font-size:20px;background-color:#DD2C00; text-align:center;"
                                    type="">
                                    <i class="fa fa-list-alt" aria-hidden="true" style="color:#FFEB3B;"></i>
                                    ได้ดำเนินการเปิดใช้ระบบให้แล้ว
                                </button>
                                <?php                                    
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->

<!-- Modal ติดตัังระบบการเชือมต่อ-->
<div class="modal fade" id="hisModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" style="font-family:'sarabun';font-size: 18px;color:#222831">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">ลงทะเบียนสำหรับการเชื่อมต่อ (Link Security)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-family:'sarabun';font-size: 18px;color:#222831">
                <div class="row-fluid">
                    <h4><?php echo '['.$_SESSION['hcode'].']  '.$_SESSION["hosname"];?></h4>
                    <hr>

                    <?php
                    $sql="SELECT * FROM rf_users WHERE hcode='$hcode' ";
                    $rss=mysqli_query($conn,$sql);
                    while($rs=mysqli_fetch_array($rss)){
                        $hospital = $rs['hospital'];
                        $tel=$rs['telephone'];
                        $address=$rs['address'];
                        $user=$rs['user'];
                        $email=$rs['email'];
                        $headweb=$rs['headweb'];
                        $his=$rs['hisprogram'];
                        $hdata=$rs['hisdatabase'];
                        $hisuser=$rs['hisuser'];
                        $hip=$rs['hisip'];
                        $hispassword=$rs[hispassword];
                        $token=$rs['token'];
                        $dbn=$rs['dataname'];
                    }
                    ?>

                    <form action="insert_regis_hosdb.php" method="POST">
                        <div class="form-group row">
                            <label for="" class="col-sm-3">ชื่อแสดงหัวเวบ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control" name="headweb"
                                    value="<?php echo $headweb; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">สถานที่ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control" name="address"
                                    value="<?php echo $address; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">โทรศัพท์ :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control" name="tel"
                                    value="<?php echo $tel; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Email :</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control" name="email"
                                    value="<?php echo $email;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3">Line Token</label>
                            <div class="col-md-7">
                                <input type="text" id="line" name="line" class="form-control"
                                    value="<?php echo $token; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">โปรแกรมระบบ HIS :</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="his" id="" required>
                                    <option value="">--- เลือกโปรแกรม ---</option>
                                    <option value='hosxp' <?php if($his=="hosxp"){echo "selected";}?>>Hos Xp</option>
                                    <option value='pmk' <?php if($his=="pmk"){echo "selected";}?>>PMK</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">ฐานข้อมูลที่ใช้ :</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="dbase" id="" required>
                                    <option value="">--- เลือกโปรแกรม ---</option>
                                    <option value='mysql' <?php if($hdata=="mysql"){echo "selected";}?>>Mysql</option>
                                    <option value='oracle' <?php if($hdata=="oracle"){echo "selected";}?>>Oracle
                                    </option>
                                    <option value='postgressql' <?php if($hdata=="postgressql"){echo "selected";}?>>
                                        PostgresSql</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">IP Address Server :</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control" name="dip"
                                    value="<?php echo $hip; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">DB Name :</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control" name="dbn"
                                    value="<?php echo $dbn;?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">User Database :</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control" name="dsu"
                                    value="<?php echo $hisuser;?>" required>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="" class="col-sm-3">รหัสผ่าน : </label>
                            <div class="col-sm-2">
                                <input type="password" class="form-control form-control" name="dpass"
                                    value="<?php echo $hispassword;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="hosuser" id="" value="euse">
                            <input type="hidden" name="hcode" id="" value="<?php echo $_SESSION['hcode']; ?>"
                                class="col-sm-10">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-2">
                                <button class="btn btn-primary"
                                    style="color:#FAFAFA;font-size:20px;background-color:#0b0111;" type="submit">
                                    <i class="fa fa-hospital-o" aria-hidden="true" style="color:#FFEB3B;"></i>
                                    ลงทะเบียนข้อมูล
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->

<!-- Modal แสดงรายการผู้เข้าร่วมโครงการ-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" style="font-family:'sarabun';font-size: 18px;color:#222831">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ผู้ที่เข้าโครงการ Refer Out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-family:'sarabun';font-size: 18px;color:#222831">
                <div class="row-fluid">
                    <table id="sataTable" class="table table-sm table-bordered" style="width:100%;">
                        <thead
                            style="background-color:#3498DB;color:#F7F5F2;font-family:'sarabun';font-size:16px;font-size:Bold;">
                            <tr align="center">
                                <td>ลำดับ</td>
                                <td>รหัส</td>
                                <td>ชื่อโรงพยาบาล</td>
                                <td>โทรศัพท์</td>
                                <td>Token</td>
                                <td>สรุป <br>Refer (คน)</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            $sql="
                                SELECT * FROM v_view_users
                                        Order by hcode";
                            $qu=mysqli_query($conn,$sql);

                            // สิ้นสุดการตรวจสอบ
                            $i=1;
                            $f = 'Auto';
                            While($rh=mysqli_fetch_array($qu)) {
                            ?>
                            <tr>
                                <td>
                                    <center>
                                        <?php    $n=$i++; if(strlen($n)=='1'){echo '0000';echo $n;}else if(strlen($n)=='2'){echo '000';echo $n;}else if(strlen($n)=='3'){echo '00';echo $n;} else if(strlen($n)=='4'){echo '00';echo $n;}else if(strlen($n)=='5'){echo '0';echo $n;}else{echo $n;}?>
                                    </center>
                                </td>
                                <td>
                                    <center><?php echo $rh['hcode']; ?></center>
                                </td>
                                <td><?php echo $rh['hosname'];?> </td>
                                <td><?php echo $rh['telephone']; ?></td>
                                <td><?php echo $rh['token']; ?></td>
                                <td>
                                    <center><?php echo $rh['tot']; ?></center>
                                </td>
                            </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- </html> -->