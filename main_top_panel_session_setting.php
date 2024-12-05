<div id="top">
    <!-- .navbar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <header class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                </button>
            </header>
            <div class="topnav">
                <div class="btn-group">
                    <a href="logout.php" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom"
                        class="btn btn-metis-2 btn-sm">
                        <i class="fa fa-lock">
                        </i>
                    </a>
                </div>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <!-- .nav -->
                <ul class="nav navbar-nav">
                    <li class="active">
                        <img class="media-object img-circle user-img" alt="User Picture" src="img/hy.png" WIDTH=55
                            HEIGHT=55>
                    </li>
                    <li class="active">
                        <a href="dashboard.php">
                            <?php echo @$rsd['CLIENT_NAME']; ?>
                        </a>
                    </li>
                    <li>
                        <a href="sys_login_history_person.php" target="_blank">LOGIN :
                            <?php echo @$_SESSION['name'];?>
                        </a>
                    </li>
                    <li>
                        <a href="sys_login_history_hospcode.php" target="_blank">
                            <?php echo @$_SESSION['hospname'];?>
                        </a>
                    </li>
                    <li>
                        <a>Last Access :
                            <i class="fa fa-calendar">
                            </i>&nbsp;
                            <?php echo $rsd2['last_login'];?>
                        </a>
                    </li>
                </ul>
                <!-- /.nav -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- /.navbar -->
    <header class="head">
        <!--           <div class="search-bar"> -->
        <!--             <form class="main-search" action=""> -->
        <!--               <div class="input-group"> -->
        <!--                 <input type="text" class="form-control" placeholder="Live Search ..."> -->
        <!--                 <span class="input-group-btn"> -->
        <!--             <button class="btn btn-primary btn-sm text-muted" type="button"> -->
        <!--                 <i class="fa fa-search"></i> -->
        <!--             </button> -->
        <!--         </span>  -->
        <!--               </div> -->
        <!--             </form><!-- /.main-search -->
        <!--           </div><!-- /.search-bar -->
        <div class="main-bar" id="main-bar">
            <span>
                <h5>
                    <i class="fa fa-cogs">
                    </i>&nbsp;ตั้งค่าการทำงาน ระบบโปรแกรม งานศูนย์เปล
                </h5>
                <div>
                    <?PHP
            	IF(!empty($y_process))
            	{echo ' <span class="label label-danger label-glad label-xs"><i class="fa fa-spinner fa-2x fa-pulse"></i> ขณะนี้มีการประมวลผลรายงานทั้งหมดใหม่  </span> ';} 
            	IF(!empty($y_send_cloud))
            	{echo ' <span class="label label-info label-glad label-xs"><i class="fa fa-spinner fa-2x fa-pulse"></i> ขณะนี้มีการส่งข้อมูลไปยัง EHOS Cloud  </span> ';} 
            	IF(!empty($y_compare_cloud))
            	{echo ' <span class="label label-warning label-glad label-xs"><i class="fa fa-spinner fa-2x fa-pulse"></i> ขณะนี้มีการปรับปรุงข้อมูล กับ EHOS Cloud  </span> ';}
            	?>
                </div>
            </span>
        </div>
        <!-- /.main-bar -->
    </header>
    <!-- /.head -->
</div>
<!-- /#top -->