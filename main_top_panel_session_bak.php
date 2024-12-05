      <div id="top">
          <!-- .navbar -->
          <nav class="navbar navbar-inverse">
              <div class="container-fluid">

                  <!-- Brand and toggle get grouped for better mobile display -->
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
                      <div <?php if (strpos( @$_SESSION['privilage'], "[admin]")==FALSE  ){echo 'style="visibility: hidden"';}?>
                          class="btn-group">
                          <a href="sys_admin.php" data-toggle="tooltip" data-original-title="ตั้งค่าระบบ"
                              data-placement="bottom" class="btn btn-metis-6 btn-sm">
                              <i class="fa fa-gears"></i>
                          </a>
                      </div>

                      <div class="btn-group">
                          <a id="boxed-layout" data-placement="bottom" data-original-title="Layout"
                              data-toggle="tooltip" class="btn btn-default btn-sm toggle-right"> <span
                                  class="glyphicon glyphicon-resize-horizontal"></span>
                          </a>
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
                      <div class="btn-group">
                          <a href="logout.php" data-toggle="tooltip" data-original-title="Logout"
                              data-placement="bottom" class="btn btn-metis-2 btn-sm">
                              <i class="fa fa-lock"></i>
                          </a>
                      </div>
                  </div>
                  <div class="collapse navbar-collapse navbar-ex2-collapse">
                      <!-- .nav -->
                      <ul class="nav navbar-nav">
                          <li class="active">
                              <center>
                                  <img class="media-object img-circle user-img" alt="User Picture" src="img/hy.png"
                                      WIDTH=55 HEIGHT=55>
                              </center>
                          </li>
                          <li class="active">
                              <a href="dashboard.php"><?php echo @$rsd['CLIENT_NAME']; ?></a>
                          </li>
                          <li> <a href="sys_login_history_hospcode.php" target="_blank">LOGIN :
                                  <?php echo @$_SESSION['name'];?></a> </li>
                          <li> <a href="sys_login_history_hospcode.php"
                                  target="_blank"><?php echo @$_SESSION['name'];?></a> </li>
                          <li><a>Last Access : <i class="fa fa-calendar"></i>&nbsp;<?php echo $rsd2['last_login'];?>
                              </a> </li>
                      </ul><!-- /.nav -->
                  </div>
              </div><!-- /.container-fluid -->
          </nav>
          <!-- </div> -->

          <nav class="navbar navbar-expand-lg navbar-inverse bg-success">
              <div class="container-fluid">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle pull-right" data-toggle="offcanvas"
                          data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#"></a>
                  </div>
                  <ul class="nav navbar-nav">
                      <li><a href="dashboard.php"><i class="fa fa-home fa-1x"></i>หน้าหลัก</a></li>
                      <li><a href="sys_hycall_center_now.php"><i class="fa fa-bell fa-1x"></i>เรียกเปล</a></li>
                      <li><a href="#"><i class="fa fa-arrow-circle-o-right fa-1x"></i>ส่งกลับ</a></li>
                      <li><a href="sys_hycall_center_view.php" target="_blank"><i
                                  class="fa fa-ils fa-1x"></i>Monitor</a></li>
                  </ul>
              </div>
          </nav>
      </div>