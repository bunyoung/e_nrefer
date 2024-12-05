<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>r-Refer</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: K2D;
        font-size: 18px;
        font-weight: 900px;
        /* overflow-y: hidden; */
        /* Hide vertical scrollbar */
        overflow-x: hidden;
        /* text-shadow: 0 -1px 0 #555; */
        color: #20272F;
        /* Hide horizontal scrollbar */
    }
    </style>
</head>
<?php
    include('main_script.php');
    include('./db/connection.php');
?>
<?php
    include("main_top_panel_head_static.php");
    ?>

<body>
    <!-- 1 -->
    <div class="row" style="padding:10px 0px 0px 0px;font-weight:90;">
        <div class="col-md-5" style="padding: 0px 0px 0px 5px">
            <center>
                <?php 
                             include('main_chart_pttype.php'); ?>
            </center>
        </div>
        <div class="col-md-7" style="padding: 0px 0px 0px 5px">
            <center>
                <?php  
                            include('main_chart_table_pttype.php'); ?>
            </center>
        </div>
    </div>

    <!-- 2 -->
    <div class="row">
        <div class="col-md-5" style="padding: 0px 0px 0px 5px">
            <center>
                <?php
                            include('main_refer_credit.php'); 
                            ?>
            </center>
        </div>
        <div class="col-md-7" style="padding: 0px 0px 0px 5px">
            <center>
                <?php 
                            include('main_refer_table_credit.php'); 
                            ?>
            </center>
        </div>
    </div>

    <!-- 3 -->
    <div class="row">
        <div class="col-md-5" style="padding: 0px 0px 0px 5px">
            <center>
                <?php 
                            include('main_seven_colorbed.php'); ?>
            </center>
        </div>
        <div class="col-md-7" style="padding: 0px 0px 0px 5px">
            <center>
                <?php
                             include('main_seven_table_colorbed.php'); ?>
            </center>
        </div>
    </div>

    <!-- 4 -->
    <div class="row">
        <div class="col-md-5" style="padding: 0px 0px 0px 5px">
            <center>
                <?php 
                            include('main_refer_paida.php');
                             ?>
            </center>
        </div>
        <div class="col-md-7" style="padding: 0px 0px 0px 5px">
            <center>
                <?php 
                            include('main_refer_table_paida.php'); 
                            ?>
            </center>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5" style="padding: 0px 0px 0px 5px">
            <center>
                <?php 
                            include('main_refer_los.php'); 
                            ?>
            </center>
        </div>
        <div class="col-md-7" style="padding: 0px 0px 0px 5px">
            <center>
                <?php 
                            include('main_refer_table_los.php'); 
                            ?>
            </center>
        </div>
    </div>

    <!-- Doctor staff -->
    <div class="row">
        <div class="col-md-5" style="padding: 0px 0px 0px 5px">
            <center>
                <?php
                             include('main_docter_staff.php'); 
                            ?>
            </center>
        </div>
        <div class="col-md-7" style="padding: 0px 0px 0px 5px">
            <center>
                <?php 
                            include('main_docter_table_staff.php'); 
                            ?>
            </center>
        </div>
    </div>
</body>

</html>