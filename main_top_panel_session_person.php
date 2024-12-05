<div id="top">
    <!-- .navbar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
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
                        <i class="fa fa-lock"></i>
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
                            <?php echo @$_SESSION['showname'];?>
                        </a>
                    </li>
                    <li>
                        <a href="sys_login_history_hospcode.php" target="_blank">
                            <?php echo @$_SESSION['hospname'];?>
                        </a>
                    </li>
                    <li>
                        <a>เลขวิทยุ :
                            <i class="fa fa-calendar">
                            </i>&nbsp;
                            <?php echo @$_SESSION['showv'];?>
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
        <!-- <button class="btn btn-primary btn-sm text-muted" type="button">
            <i class="fa fa-search"></i>
        </button> -->
        <!--         </span>  -->
        <!--               </div> -->
        <!--             </form><!-- /.main-search -->
        <!--           </div><!-- /.search-bar -->
        <!-- /.main-bar -->
    </header>
    <!-- /.head -->
</div>
<!-- /#top -->