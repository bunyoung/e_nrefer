<div id="top">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <header class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" 
                    data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </header>
            <div class="topnav">
                <div class="btn-group">
                    LOGIN :
                </div>
                <div class="btn-group">
                    <form id="login" class="form-inline" action="authen.php" method="post">
                        <input class="form-control input-sm" name="username" type="text" placeholder="รหัส รพ."
                            tabindex="1">
                        <input class="form-control input-sm" name="password" type="password" placeholder="PASSWORD"
                            tabindex="2">
                        <input type="hidden" id="show_ip" name="page" value="<?php    echo $page; ?>" />
                        <input type="hidden" id="show_ip" name="show_ip" value="<?php    echo $show_ip; ?>" />
                        <input type="hidden" id="user_os" name="user_os" value="<?php    echo $user_os; ?>" />
                        <input type="hidden" id="user_browser" name="user_browser"
                            value="<?php echo $user_browser; ?>" /> <button data-placement="bottom" type="submit"
                            data-toggle="tooltip" data-original-title="Login" class="btn btn-metis-1 btn-sm" id="Login">
                            <i class="fa fa-unlock"></i>
                        </button>
                    </form>
                </div>
                <div class="btn-group">
                    <a id="boxed-layout" data-placement="bottom" data-original-title="Layout" data-toggle="tooltip"
                        class="btn btn-default btn-sm toggle-right"> <span
                            class="glyphicon glyphicon-resize-horizontal"></span> </a>
                </div>
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip"
                        class="btn btn-default btn-sm" id="toggleFullScreen">
                        <i class="fa fa-arrows-alt"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="คู่มือการใช้งาน" data-toggle="tooltip"
                        class="btn btn-info btn-sm" id="manual" href="manual/manual.pdf" target="_blank">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <img class="media-object img-circle user-img" alt="User Picture" src="img/hy.png" WIDTH=55
                            HEIGHT=55>
                    </li>
                    <li class="active">
                        <a href="dashboard.php"><?php echo $rsd['CLIENT_NAME']; ?></a>
                    </li>
                    <li>
                         <a> online : <?php echo 'ผู้ใช้งานทั่วไป'; ?> </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row-fluid">
        <div class="span12">
            <div id="div3" class="span12">
                <div class="text-center">
                    <ul class="stats_box">
                        <li>
                            <div class="icons collapse in">
                                <a class="btn btn-primary btn-rect btn-line" href="sys_hycall_center_now.php" target=""
                                    data-toggle="tooltip" title="เรียกเปล">
                                    <img src="img/2.jpg" alt="AEC" style="width:90px;height:90px;">
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="icons collapse in">
                                <a class="btn btn-primary btn-rect btn-line" href="#" target="" data-toggle="tooltip"
                                    title="ส่งกลับ">
                                    <img src="img/3.jpg" alt="REPORT" style="width:90px;height:90px;">
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="icons collapse in">
                                <a class="btn btn-primary btn-rect btn-line" href="#" target="" data-toggle="tooltip"
                                    title="Monitor">
                                    <img src="img/4.jpg" alt="analyze" style="width:90px;height:90px;">
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>