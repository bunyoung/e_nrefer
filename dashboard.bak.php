<!doctype html>
<?php
#write number
$page = basename($_SERVER['PHP_SELF']);
if (file_exists('_couter/' . $page . '.txt')) {
    $fil = fopen('_couter/' . $page . '.txt', "r");
    $dat = fread($fil, filesize('_couter/' . $page . '.txt'));
#echo $dat+1;
    fclose($fil);
    $fil = fopen('_couter/' . $page . '.txt', "w");
    fwrite($fil, $dat + 1);
} else {
    $fil = fopen('_couter/' . $page . '.txt', "w");
    fwrite($fil, 1);
#echo '1';
    fclose($fil);
}
#read number	
$myFile = "_couter/" . $page . ".txt";
$lines = file($myFile); //file in to an array
$count = $lines[0]; //line 2
?>
<?php
if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
    session_start();
} else {
    if (!isset($_SESSION)) {
        session_start();
    }
}
#life time session
$_SESSION['timestamp'] = time();
require_once("session_timeout.php");
#connect data
require_once("db/connection.php");
require_once("db/date_format.php");

#show name	
$sql = "SELECT CLIENT_NAME,CHWCODE,CLIENT_ID,CHWNAME,HOS_PROGRAM,DB_NAME,OFC_CSMBS_OPD FROM sys_webservice_url WHERE WEBSERVICE_TYPE=2";
$resultd = mysqli_query($conn, $sql)or die(mysql_error());
$rsd = mysqli_fetch_array($resultd, MYSQL_ASSOC);
$dbname = $rsd['DB_NAME'];
$client_name = $rsd['CLIENT_NAME'];
$hos_program = $rsd['HOS_PROGRAM'];
$csmbs_export = $rsd['OFC_CSMBS_OPD'];
#login infomation	
$sql2 = "SELECT concat(DATE_FORMAT(log_time,'%d/%m/'),DATE_FORMAT(log_time,'%Y')+543,' ',DATE_FORMAT(log_time,'%T')) as last_login
         FROM sys_log_login
         WHERE username ='" . @$_SESSION['username'] . "' AND status = 'Success' ORDER BY log_time DESC limit 1,1";
$resultd2 = mysqli_query($conn, $sql2)or die(mysql_error());
$rsd2 = mysqli_fetch_array($resultd2, MYSQL_ASSOC);
#check update program
?>
<?php
#SET DATE DEFULT FOR BEGIN CALULATE
$date_start_d_defult = '01/';
$date_start_m_defult = date('m/');
$date_start_y_defult = date('Y') + 543;
$date_start_dmy_defult = $date_start_d_defult . $date_start_m_defult . $date_start_y_defult;
$date_end_dm_defult = date('d/m/');
$date_end_y_defult = date('Y') + 543;
$date_end_dmy_defult = $date_end_dm_defult . $date_end_y_defult;
$date_end_dm_defult = date('d/m/');
$date_end_y_defult = date('Y') + 543;
$date_end_dmy_defult = $date_end_dm_defult . $date_end_y_defult;
//IF DATE SELECT
$d_start_post = $_POST['d_start'];
$d_end_post = $_POST['d_end'];
IF (!empty($d_start_post)) {
    $d_start = $d_start_post;
} ELSE {
    $d_start = $date_start_dmy_defult;
}
IF (!empty($d_end_post)) {
    $d_end = $d_end_post;
} ELSE {
    $d_end = $date_end_dmy_defult;
}
$d_start_cal = substr($d_start, 6, 4) . substr($d_start, 3, 2) . substr($d_start, 0, 2);
$d_end_cal = substr($d_end, 6, 4) . substr($d_end, 3, 2) . substr($d_end, 0, 2);
$date_m = $d_end;
?>
<?php
$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;
?>
<?php
require("db/check_client.php");
?>
<html class="no-js">

<head>
    <?php
      include ("main_script.php");
    ?>
</head>

<body>
    <?php
    //   include ("main_script_loading.php");
    ?>
    <div class="container-fluid">
        <header style="height:60px;">
            <div class="text-center">
                <h2>ระบบงานศูนย์เปล</h2>
            </div>
            <nav class="navbar navbar-inverse bs-dark">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Logo</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Homepage <span class="sr-only">(current)</span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Explores <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">News</a></li>
                                <li><a href="#">Sports</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Gallery</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Videos</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle navbar-img" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                Account
                                <img src="http://placehold.it/30x30" class="img-circle" alt="Profile Image" />
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Inbox</a></li>
                                <li><a href="#">Followers</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Settings</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!----------- !Navbar End ------------>

            <div class="row" style="text-align:center;">
                <h2>Bootstrap 3 Dark Inverse Theme</h2>
            </div>
            <section style="text-align:center; margin:10px auto;">
                <p>Designed by <a href="http://enfoplus.net">Prince J. Sargbah</a></p>
            </section>
    </div>
</body>

</html>