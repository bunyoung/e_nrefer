<?php     
require("main_top_panel_head_admin.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <title>ระบบงาน</title>
</head>
<?php include ("main_script.php");?>
<script src="assets/js/style-switcher.min.js"></script>

<body>
    <p>
    <div class="cotainer">
        <script>
        $(function() {
            Metis.dashboard();
        });
        </script>

        <!-- <div class="row justify-content-center"> -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">ล็อคอินเข้าสู่ระบบ</div>
                <div class="card-body">
                    <form action="authen.php" method="post">
                        <div class="form-group row">
                            <label for="email_address" class="col-md-4 col-form-label text-md-right">รหัสผู้ใช้</label>
                            <div class="col-md-6">
                                <input type="text" id="email_address" class="form-control" name="username" required
                                    autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">รหัสผ่าน</label>
                            <div class="col-md-6">
                                <input type="password" id="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                ล็อคอิน
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</body>

</html>