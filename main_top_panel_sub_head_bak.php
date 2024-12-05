<!-- วันที่ปัจจุบัน -->
<?php
$date_curr_dm_defult=date('d/m/') ;
$date_curr_y_defult=date('Y')+543 ;
$date_curr_dmy_defult=$date_curr_dm_defult.$date_curr_y_defult;
$d_default=$date_curr_dmy_defult;
?>

<?php
$dward = $_GET['place'];
$pl='';
$sqw="SELECT * FROM places WHERE placecode='$dward' ";
$query=mysqli_query($conn,$sqw);
$rw=mysqli_fetch_array($query);
$pl=$rw['fullplace'];   
?>
    <link rel="stylesheet" href="style.css" />
<section id="mediatation">
    <div>
        <img src="img/web.png" id="topic-cover  " >
    </div>
</section>

<nav class="my_navbar scGridLabelFont2" style="background-color:#eab600;color:black;font-size:28px;">
    <div class="container-fluid">
        <div class="col-md-1" style="margin-left:-60px;margin-top:8px;">
            <a href="#">
                <div class="img-logo"><img src="img/web.png" ; /></div>
            </a>
        </div>

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <p>
            <h1 class="otto" >
                SMART HY-DISPLAY by HYs-MEST &copy;2022
            </h1>
</p>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#"
                    style="color:#464E2E;font-weight:normal;font-size:80px;font-weight:bold;margin-top:60px;margin-left:-150px;"><?php echo $pl;?></a>
                </li>
                <li class="active"><a href="#"
                    style="color:#541212;font-weight:normal;font-size:60px;font-weight:bold;margin-top:65px;">
                        <?php echo $d_default.'  '.date('H:s').' น.';?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
