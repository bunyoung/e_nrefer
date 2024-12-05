<!doctype html>
<html>

<head>
    <style>
    #navcolor {
        background-color: #0c89d1;
    }

    #navlink a:link {
        color: #FFFFFF;
    }

    #navlink a:visited {
        color: #FFFFFF;
    }

    div.img-resize img {
        width: 60px;
        height: auto;
    }
    </style>
    <style>
    #h3 {
        color: white;
    }
    </style>
</head>
<?php
    include('main_script.php');
?>

<body>
    <div id="page-wrapper">
        <div class="container-fluid" id="navcolor">
            <ul class="nav navbar-nav ">
                <div class="col-lg-1">
                    <li class="active">
                        <center>
                            <a href="dashboard.php">
                                <div class="img-resize"><img src="img/hy.png" /></div>
                            </a>
                        </center>
                    </li>
                </div>
                <div class="col-lg-11" style="color: #FFFFFF;">
                    <h3><strong>&nbsp;&nbsp;หน่วยเคลื่อนย้าย ผู้ป่วย เวชภัณฑ์และสิ่งของ </strong></h3>
                </div>
            </ul>
        </div>
        <nav class="navbar navbar-default " data-offset-top="197">
            <ul class="nav navbar-nav">
                <li><a href="#><i class=" fa fa-user fa-lg" aria-hidden="true"></i>
                        ส่วนงานโครงสร้างระบบโปรแกรม ก่อนดำเนินการ
                    </a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log out &nbsp;</a></li>
                <li></li>
            </ul>
        </nav>
</body>

</html>