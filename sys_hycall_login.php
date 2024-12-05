<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<?php include('main_script.php') ?>
<?php require("main_top_panel_head.php"); ?>
<script src="assets/js/style-switcher.min.js"></script>

<body>
    <div class="container" style="margin-top:40px">
	<script>
        $(function() {
            Metis.dashboard();
        });
        </script>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> เข้าสู่ระบบ</strong>
                    </div>

                    <div class="panel-body">
                        <form role="form" action="sys_user_hycall_authen.php" method="POST">
                            <fieldset>
                                <div class="row">
                                    <div class="center-block" align="center">
                                        <img class="profile-img" src="img/login.jpg">
                                    </div>
                                </div>
                                <div class="row"></div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                </span>
                                                <input class="form-control" placeholder="Username" name="login"
                                                    id="txt-user" type="text" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="glyphicon glyphicon-lock"></i>
                                                </span>
                                                <input class="form-control" placeholder="Password" name="psword"
                                                    id="txt-pass" type="password" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger btn-grad btn-rect">เข้าสู่ระบบ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>

    <script type="text/javascript" src="assets/js/jquery.flot.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.flot.selection.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.flot.resize.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/lib/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="assets/lib/fullcalendar/dist/fullcalendar.min.js"></script>

    <!--TABLE  -->
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.ui.touch-punch.min.js"></script>

    <!--Bootstrap -->
    <script type="text/javascript" src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- MetisMenu -->
    <script type="text/javascript" src="assets/js/metisMenu.min.js"></script>

    <!-- Screenfull -->
    <script type="text/javascript" src="assets/js/screenfull.min.js"></script>

    <!-- Metis core scripts -->
    <script type="text/javascript" src="assets/js/core.min.js"></script>
    <!-- Metis demo scripts -->
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script src="assets/js/style-switcher.min.js"></script>

    <!-- Screenfull -->
    <script type="text/javascript" src="assets/js/screenfull.min.js"> </script>
</body>

</html>