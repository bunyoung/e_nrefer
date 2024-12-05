<!doctype html>
<?php
	if(!isset($_SESSION)) {  session_start();  }
	if (@$_SESSION['sess_userid'] <> session_id().@$_SESSION['web_login'].@$_SESSION['username']) {
		header("Location: dashboard.php"); exit(); 
	}
  
	require_once("db/connection.php");

    #ดึงประวัติเข้าใช้งาน กรณี login 
	$sql2 = "SELECT concat(DATE_FORMAT(log_time,'%d/%m/'),DATE_FORMAT(log_time,'%Y')+543,' ',DATE_FORMAT(log_time,'%T')) as last_login FROM sys_log_login WHERE username ='".@$_SESSION['username']."' AND status = 'Success' ORDER BY log_time DESC limit 1,1";	// Download data LAST LOGIN
	$resultd2 = mysqli_query($conn,$sql2)or die(mysql_error()); 
	$rsd2=mysqli_fetch_array ($resultd2, MYSQL_ASSOC );
    
?>
<html class="no-js">

<head>
    <meta charset="UTF-8">
    <title>E-Hycenter</title>

    <link rel="shortcut icon" type="image/x-icon" href="img/logo.gif" />

    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/lib/font-awesome-4.6.3/css/font-awesome.css">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="assets/css/main.css">


    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="assets/css/metisMenu.min.css">
    <link rel="stylesheet" href="assets/lib/jquery-inputlimiter/jquery.inputlimiter.1.0.css">
    <link rel="stylesheet" href="assets/lib/bootstrap-daterangepicker/daterangepicker-bs3.css">

    <link rel="stylesheet" href="assets/css/chosen.min.css">
    <link rel="stylesheet" href="assets/css/jquery.tagsinput.css">
    <link rel="stylesheet" href="assets/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-switch.min.css">


    <!--TABLE-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap.css">

    <!--FORMS-->
    <link rel="stylesheet" href="assets/css/uniform.default.min.css">

    <script>
    less = {
        //         env: "development",
        relativeUrls: false,
        rootpath: "assets/"
    };
    </script>
    <link rel="stylesheet" href="assets/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
    <script src="assets/js/less.min.js"></script>


    <!--Modernizr-->
    <script type="text/javascript" src="assets/lib/modernizr/modernizr.min.js"></script>

    <!--Chart-->
    <script type="text/javascript" src="assets/lib/highcharts/lib/highcharts.js"></script>
    <script type="text/javascript" src="assets/lib/highcharts/lib/highcharts-3d.src.js"></script>
    <script type="text/javascript" src="assets/lib/highcharts/lib/modules/data.js"></script>
    <script type="text/javascript" src="assets/lib/highcharts/lib/modules/exporting.js"></script>
    <!-- ประมวลผลหน้าเวบ -->
    <?php
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime =  $mtime[1] + $mtime[0];
		$starttime = $mtime;
		?>

    <!-- PRELOADER -->
    <style type="text/css">
    /* Preloader */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #f7f7f7;
        /* change if the mask should be a color other than white */
        z-index: 99;
        /* makes sure it stays on top */
    }

    #status {
        width: 230px;
        height: 230px;
        position: absolute;
        left: 50%;
        /* centers the loading animation horizontally on the screen */
        top: 50%;
        /* centers the loading animation vertically on the screen */
        /*background-image:url(../img/status.gif);*/
        /* path to your loading animation */
        background-repeat: no-repeat;
        background-position: center;
        margin: -100px 0 0 -100px;
        /* is width and height divided by two */
    }
    </style>



    <!-- Preloader Page -->
    <div id="preloader">
        <div id="status">
            <img src="img/logo.png" width="210" />
            <span style="padding-left: 60px; color: #999999;">กรุณารอสักครู่...</span>
        </div>
    </div>

    <!-- Background& Color scripts -->
    <script src="assets/js/style-switcher.min.js"></script>

</head>

<body class="boxed">

    <div class="bg-blue dker" id="wrap">

        <script>
        $(function() {
            Metis.dashboard();
        });
        </script>



        <?php
		
		if (@$_SESSION['sess_userid'] <> session_id().@$_SESSION['web_login'].@$_SESSION['username']) {
			require("main_top_panel.php"); 
		}ELSE{
			require("main_top_panel_session_history.php");
		}
	  
	?>

        <div id="content3">
            <div class="outer">
                <div class="inner bg-light lter">


                    <div class="col-lg-12">
                        <div class="box">
                            <header>
                                <div class="icons">
                                    <i class="fa fa-table"></i>
                                </div>
                                <h5>ตารางแสดงข้อมูลประวัติการเข้าใช้งาน ระบบโปรแกรม E-Refer ของ <a
                                        class="text-success"><?php echo @$_SESSION['hospname'];?></a></h5>
                            </header>
                            <div class="panel-body" style="overflow:scroll">
                                <table id="dataTable"
                                    class="table table-bordered table-condensed table-hover table-striped">
                                    <thead>
                                        <tr>

                                            <th>วันที่เข้าใช้งาน</th>
                                            <th>HOSPCODE</th>
                                            <th>HOSPNAME</th>
                                            <th>LOGIN</th>
                                            <th>OS</th>
                                            <th>IP</th>
                                            <th>BROWSER</th>
                                            <th>STATUS</th>
                                            <th>LOGOUT</th>
                                            <th>วันที่ออกจากระบบ</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php  
                      
          $hospcode=@$_SESSION['hospcode'];	
	      $sql_f43_main_t = "SELECT 
							hospcode,
							IF(hospname is null or hospname='',hospcode,hospname) as hospname,
							username,
							os,
							ip,
							browser,
							`status`,
							log_time,
							logout,
							logout_time						
							FROM sys_log_login
							WHERE web_login='_E-HOS Accounting_' and hospcode='$hospcode' 
							ORDER BY id DESC ";	// Download data F43
		$result_f43_t = mysql_query($sql_f43_main_t, $conn);									  
		while($rs_f43_t=mysql_fetch_array($result_f43_t)) 
		{
							
		?>

                                        <tr <?php IF($rs_f43_t['status']!='Success'){echo 'class="danger"';}?>>

                                            <td><?php echo $rs_f43_t['log_time']; ?></td>
                                            <td><?php echo $rs_f43_t['hospcode']; ?></td>
                                            <td><?php echo $rs_f43_t['hospname']; ?></td>
                                            <td><?php echo $rs_f43_t['username']; ?></td>
                                            <td><?php echo $rs_f43_t['os']; ?></td>
                                            <td><?php echo $rs_f43_t['ip']; ?></td>
                                            <td><?php echo $rs_f43_t['browser']; ?></td>
                                            <td><?php echo $rs_f43_t['status']; ?></td>
                                            <td><?php echo $rs_f43_t['logout']; ?></td>
                                            <td><?php echo $rs_f43_t['logout_time']; ?></td>

                                        </tr>
                                        <?php         
										
		}
							
		?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--ประมลผลหน้าเวบ -->
                        <?php
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$endtime = $mtime;
	$totaltime = ($endtime - $starttime);
	?>
                        <span class="help-block" style="color: #c8c8c8; font-size: 12px;"><i class="fa fa-clock-o"></i>
                            ใช้เวลาในการประมวลผลหน้านี้ <?php echo number_format($totaltime, 4);?> วินาที </span>

                        <!--
	            <div class="row">
	              <div class="col-lg-12">
	                <div class="box">
	                <header>
	                    <div class="icons">
	                      <i class="fa fa-info-circle"></i>
	                    </div>
	                <h5><b></b>คำอธิบายเกี่ยวกับโปรแกรม</b></h5>
	                </header>
	                                    <ol class="list-ordered">
                                      <li>ต้องทำการ LOGIN ก่อน จึงสามารถดูรายละเอียดรายบุคคลได้</li>
                                      <li>รายละเอียดรายบุคคลสามารถดูได้ เฉพาะสถานบริการของตนเองเท่านั้น</li>
                                      <li>เกณฑ์คุณภาพข้อมูล 90%</li>
                                      <li>การประมวลผล จะประมวลผลทุกวันศุกร์ สัปดาห์ละ 1 ครั้ง </li>
                                      <li>หลักเกณฑ์หัวข้อในการตรวจ  <a href="error_code.php" target="_blank"><i class="fa fa-hand-o-right "></i> รายละเอียดคลิก</a></li>
                                      <li>ประวัติการเข้าใช้งาน  <a href="sys_login_history.php" target="_blank"><i class="fa fa-male "></i> รายละเอียดคลิก</a></li>
                                    </ol>
	                </div>
	              </div>
	            </div>  -->
                        <!--เลื่อนขึ้นบน -->
                        <a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
                            <i class="fa fa-angle-double-up"></i> Back To Top
                        </a>
                    </div> <!-- กรอบนอกสุด -->

                    <hr>

                </div><!-- /.inner -->
            </div><!-- /.outer -->



            <script>
            $(function() {
                Metis.MetisTable();
                Metis.metisSortable();
            });
            </script>

        </div><!-- /#content -->


        <?php 
		require("main_footer_panel.php");
	?>
    </div>
    <!--jQuery 
      
 -->


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


    <script>
    $(document).ready(function() {
        $('#dataTable').dataTable();
    });
    </script>

</body>

<!-- Preloader -->
<script type="text/javascript">
//<![CDATA[
$(window).load(function() { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(500).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(800).css({
        'overflow': 'visible'
    });
})
//]]>
</script>

</html>