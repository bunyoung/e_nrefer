<?php session_start();?>
<?php 
// include('main_script.php') ;
include('main_top_panel_head.php');
?>

<link rel="stylesheet" type="text/css" href="style.css">
<style>
    #navcolor {
        background-color: #2068AA
    }

    #navlink a:link {
        color: #BCCAD4;
    }

    #navlink a:visited {
        color: #4A474B;
    }

    div.img-resize img {
        margin-top: 5px;
        margin-bottom: 5px;
        margin-left: -23px;
        width: 105px;
        height: 100px;
        float: left;
    }

    div.img-logo img {
        margin-top: 10px;
        margin-bottom: 5px;
        margin-right: -23px;
        width: 80px;
        height: 80px;
        float: right;
    }

    div.img-logistic img {
        margin-top: 15px;
        margin-bottom: 5px;
        margin-right: -23px;
        width: 120px;
        height: 80px;
        float: right;
        border-radius: 50%;
    }
    </style>
<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> เข้าสู่ระบบ (ใช้เลข รหัสที่ได้รับไป จากศูนย์ควบคุม)</strong>
                </div>
                <div class="panel-body">
                    <form role="form" action="sys_hycall_login_authen_user.php" method="POST">
                        <fieldset>
                            <div class="row">
                                <div class="center-block" align="center">
                                    <img class="profile-img" src="img/hy.png" alt="" style="width:100px;height:100px;">
                                </div>
                            </div>
                            <div class="row"></div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-10 col-md-offset-1 ">
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
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>