<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="css/style.css">

        <link rel="icon" href="Favicon.png">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <title>Run 2nd the Challenge</title>
    </head>
    <body class="boxed">
	<?php 
	include('main_script.php');
	?>
      <?php 
    include('main_top_panel_head.php');
	include('main_script.php');
	?>
        <p>
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">ล็อคอินเข้าสู่ระบบ</div>
                        <div class="card-body">
                            <form action="sys_hycall_person_authen.php" method="post">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">รหัสผู้ใช้</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="username" required autofocus>
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
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>