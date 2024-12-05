<?php
	include('./db/connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-refer</title>
    <style>
    .badge-primary {
        color: #ebeef0;
        background-color: #B23CFD;
    }

    .badge-secondary {
        color: #ebeef0;
        background-color: #2abe74;
    }

    .badge-success {
        color: #ebeef0;
        background-color: #b9fd3c;
    }

    .badge-danger {
        color: #ebeef0;
        background-color: #e93e9c;
    }

    .badge-warning {
        color: #ebeef0;
        background-color: #5f3cfd;
    }

    .badge-info {
        color: #ebeef0;
        background-color: #fd3c46;
    }

    .badge-light {
        color: #ebeef0;
        background-color: #3cfdbd;
    }

    .badge-dark {
        color: #ebeef0;
        background-color: #064118;
    }
    </style>
</head>

<style>
.border {
    font-family: 'K2D';
    /* font-style: unset; */
    /* display: block; */
    padding: 10px 10px 10px 10px;
    width: AUTO;
    /* background: #651FFF; */
    font-size: 20px;
    text-align: center;
}
</style>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

.tab {
    font-family: 'K2D';
    font-size: 18px;
    overflow: hidden;
    /* border: none; */
    background-color: #448AFF;
    padding: 5px 5px 5px 5px;
    color: #0D47A1;
}

.tab a {
    color: #fffcf1;
}

.tab button:hover {
    background-color: #440099;
}

.tab button.active {
    background-color: #034638;
}
</style>
</head>

<?php
    require_once("db/connection.php");
?>
<?php
if(!isset($_SESSION)) {  
    session_start(); 
 }
 $hcode=$_SESSION['hcode'];
?>
<style>
table {
    font-family: 'K2D';
    font-size: 16px;
}
</style>

<?php include('main_script.php');
?>

<body>
    <?php
     require_once('main_top_panel_head.php');
    require_once('main_top_menu_session.php');
    require_once('main_top_menu_smenu.php');
    ?>
    <div class="box" style="border:5px solid #90CAF9;font-family:K2D;font-size:18px;margin-top:0px;">
        <div class="tab">
            <ul class="nav nav-tabs">
            <li>
                    <a href="#" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                        aria-controls="nav-home" aria-selected="true">Refer IN (ThaiRefer)
                    </a>
                </li>

                <li class="active">
                    <a href="#tab1primary" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                        role="tab" aria-controls="nav-home" aria-selected="true">
                        คนไข้ Refer IN
                    </a>
                </li>
                <!-- <li>
                    <a href="#tab2primary" class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" role="tab"
                        aria-controls="nav-home" aria-selected="true">
                        รับคนไข้แล้ว
                    </a>
                </li>
            </ul> -->
        </div>

        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1primary">
                    <?php include("sys_hycall_hospital_thai_a.php");?>
                </div>
                <div class="tab-pane fade" id="tab2primary">
                    <?php include("sys_hycall_hospital_thai_b.php");?>
                </div>
            </div>
        </div>
        <?php include('main_hycall_footer.php');?>
    </div>
</body>

</html>