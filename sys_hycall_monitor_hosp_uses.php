<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-refer</title>
    <script src="assets/js/bootstrap-timepicker.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</head>

<?php
include('db/connection.php');
?>
<?php
include('main_script.php');
?>

<?php
$SQLe=mysqli_query($conn,"
SELECT 
    hoscode5,
    hosname 
FROM rf_hospital 
WHERE  hosname NOT LIKE 'สำนักงานสาธารณสุข%' AND 
        postcode IN ('90110') AND 
        hoscode5 NOT IN ( SELECT hcode FROM rf_users ) ORDER BY hoscode5");
?>

<body>
    <div id="content3" style="font-family:sarabun;font-size: 16px; font-weight:normal">
        <form class="form-horizontal" action="insert_regis_hosdb.php" method=POST target="">
            <div class="form-group">
                <label for="" class="col-md-3">ชื่อโรงพยาบาลของท่าน*</label>
                <div class="col-md-2">
                    <select class="form-control select2" style="width:500px" name="hoseid" id="hoseid" required>
                        <option value="" selected readonly>(เลือกรายการ)</option>
                        <?php
                        WHILE($row=mysqli_fetch_array($SQLe))
                        {
                        ?>
                        <option value="<?php echo $row['hoscode5'];?>">
                            <?php echo '['.$row['hoscode5'].']'.' - '.$row['hosname'];?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <label for="" class="col-md-3">Line Token</label>
                <div class="col-md-7">
                    <input type="text" id="line" name="line" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-md-3">โทรศัพท์ </label>
                <div class="col-md-3">
                    <input type="text" id="phone" name="phone" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-md-3">รหัสเข้าระบบ </label>
                <div class="col-md-6">
                    <a class="btn btn-danger" style="font-size: 18px;font-weight:bold;">ใช้ เลขรหัส
                        รพ.เท่านั้น </a>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-3">รหัสผ่าน*</label>
                <div class="col-md-3">
                    <input type="password" id="" name="tpass" class="form-control" required>
                </div>
            </div>
            <!-- /.row -->
            <div class="form-group">
                <label class="col-md-3"> </label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-grad">ยืนยันสมัคร !!!</button>
                </div>
            </div>
        </form>
        </p>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <!-- <script src="assets/js/notify.js"></script> -->
    <!-- <script src="assets/js/bootstrap-timepicker.min.js"></script> -->

    <script>
    $(document).ready(function() {
        $('.select2').select2({
            // dropdownParent: $("#myModal_hospital")
            // closeOnSelect: true
            // tags: true,
            // tokenSeparators: [',', ' ']
        });
    });
    </script>
</body>

</html>