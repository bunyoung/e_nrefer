<html class="no-js">

<head>
<?php
require_once("./db/connection.php");
?>
<?php
include ("main_script.php");
?>
<?php
$idf=$_POST['idf'];

$sql = "SELECT
*
FROM rf_detail
WHERE rf_id='$idf'; ";
$result_sql = mysqli_query($conn,$sql);
$rs=mysqli_fetch_array ($result_sql);
#show variable
$rfid=$rs['rf_id'];
$rf_hn=$rs['rf_hn'];
$rf_pat=$rs['rf_patients'];
$rf_no_refer=$rs['rf_no_refer'];
?>
</head>

<body>
 
<div class="bg-blue dker" id="wrap">
    <div id="content3">
            <div class="inner bg-light lter">
                <div class="col-lg-12">
                    <!-- <div class="box"> -->
                        <header>
                            <div class="icons">
                                <i class="fa fa-user">
                                </i>
                            </div>
                            <h5>ออกเลขที่ Refer :
                                <a class="text text-success">
                                    <?php echo $rf_pat.'  -  '.$idf;?>
                                </a>
                            </h5>
                        </header>
                        <p>
                        <form class="form-horizontal" action="sys_hycall_monitor_now.php" method=POST target="">
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-2">ชื่อ-สกุล
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" id="name" name="name" placeholder="ชื่อ-สกุล"
                                        class="form-control" value="<?php echo $rf_pat;?>">
                                </div>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="username" class="control-label col-lg-2">เลขที่ Refer Out
                                </label>
                                <div class="col-lg-4">
                                    <input type="text" id="norf" name="norf" placeholder="เลข Refer" class="form-control"
                                        value="<?php echo $rf_no_refer;?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2">
                                </label>
                                <input type="hidden" name="rfid" value="<?php echo $idf;?>">
                                <input type="hidden" name="EDIT" value="EDIT">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary btn-grad btn-rect">ออกเลข Refer
                                    </button>
                                </div>
                            </div>
                            <!-- /.row -->
                        </form>
                        </p>
                    <!-- </div> -->
                </div>
                <!-- กรอบนอกสุด -->
                <hr>
            <!-- </div> -->
            <!-- /.inner -->
        <!-- </div> -->
        <!-- /.outer -->
    </div>
    <!-- /#content -->
</div>