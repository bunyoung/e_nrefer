<!doctype html>
<html>

<head>
    <style>
    #navcolor {
        background-color: #66189B
    }

    #navlink a:link {
        color: #370000;
    }

    #navlink a:visited {
        color: #4A474B;
    }

    div.img-resize img {
        margin-top: 8px;
        margin-bottom: 8px;
        margin-left: -25px;
        width: 60px;
        height: 60px;
        float: left;
    }

    div.img-logo img {
        margin-top: 8px;
        margin-bottom: 8px;
        margin-right: -20px;
        width: 60px;
        height: 60px;
        float: right;
    }

    div.img-logistic img {
        margin-top: 15px;
        margin-bottom: 5px;
        margin-right: -23px;
        width: 60px;
        height: 40px;
        float: right;
        border-radius: 60%;
    }
    </style>
</head>

<?php
    include('main_script.php');
?>

<body>
    <div class="container-fluid" id="navcolor">
        <div class="col-md-1">
            <div class="img-resize"><img src="img/hy.png" /></div>
        </div>
        <div class="col-md-8" style="color: #E7E3EB; 
            text-shadow: 1px 1px 1px #A405EE, 0 0 18px #4B454E, 0 0 5px white;opacity: 10; 
            margin-top:22px;margin-right: -35px; font-weight:normal;font-size: 25px;">
            ศูนย์สนับสนุนการบริการทางการแพทย์ (HYs-MEST).  โรงพยาบาลหาดใหญ่ : Trusted Support, We Can
            </p>
        </div>
        <!-- <div class="col-md-4">
            <div class="img-logistic"><img src="img/logo.jpg" /></div>
        </div> -->
        <div class="col-md-3">
            <a href="http://www.hatyaihospital.go.th">
                <div class="img-logo"><img src="img/hyh.png" /></div>
            </a>
        </div>
    </div>
</body>

</html>