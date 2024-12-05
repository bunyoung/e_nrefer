<?php session_start();?>
<?php include('main_script.php') ?>
<link rel="stylesheet" type="text/css" href="style.css">
    <div class="container" style="margin-top:40px">
    	<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong> เข้าสู่ระบบ</strong>
					</div>

					<div class="panel-body">
						<form role="form" action="sys_user_hycall_opd_authen.php" method="POST">
							<fieldset>
								<div class="row">
									<div class="center-block" align="center">
										<img class="profile-img"
											src="img/login.jpg">
									</div>
								</div>
								<div class="row"></div>
								<br>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span>
												<input class="form-control" placeholder="Username" name="login" id="txt-user" type="text" autofocus>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control" placeholder="Password" name="psword" id="txt-pass' type="password" value="">
											</div>
										</div>
										<div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-grad btn-rect">เข้าสู่ระบบ                                            </button>
                                    </div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
                </div>
			</div>
		</div>
	</div>
