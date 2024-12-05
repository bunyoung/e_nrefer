<!doctype html>
<?php
require_once("./db/connection.php");
#variable from post
$rid=$_POST['rid_p'];
?>
<?php
$sql = "
SELECT *
FROM v_rf_detail
WHERE rf_id='$rid' ";
$result_sql = mysqli_query($conn,$sql);
$rs=mysqli_fetch_array ($result_sql);
// วันที่ + เวลา
$rfdate = $rs['rf_date'];
$rft=$rs['rf_time'];
// ประเถทการ Refer
$rfev = $rs['rfevent'];
//  hn
$rfhn=$rs['rf_hn'];
// ชื่อนามสกุล
$rfpt = $rs['rf_patients'];
// รพ ต้นทาง
$rff = $rs['hosname'];
// รพ ปลายทาง
$rfs = $rs['hossendto_name'];
?>

<body style="font-family:'Bai jamjuree';font-size:17px;">
    <p>
    <form class="form-horizontal" action="insert_regis_request_db.php" method="POST">
        <div class="form-group">
            <!-- <label class="control-label col-sm-2" style="color:black;"> EQ Request :
            </label> -->
            <div class="row" style="padding: 25px 0px 0px;">
                <center>
                    <div class="col-sm-12">
                        <textarea name="rqv" id="" cols="85" rows="10"></textarea>
                    </div>
                </center>
            </div>
        </div>
        <div class="form-group">
            <input type="hidden" name="rfid" value="<?php echo $rid;?>">
            <div class="col-sm-1">
                <button type="submit" class="btn btn-danger btn-grad"><span
                        class="glyphicon glyphicon-floppy-saved"></span> บันทึกข้อมูล !!! </button>
            </div>
        </div>
    </form>
</body>

</html>