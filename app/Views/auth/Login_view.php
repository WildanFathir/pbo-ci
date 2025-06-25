<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Login - SITOKO v1.0</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--inline styles related to this page-->
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <?php echo $css_js ?>
    </head>

	<body class="login-layout">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="center">
									<h1>
										<i class="icon-leaf green"></i>
										<span class="red">SITOKO</span>
										<span class="white">v1.0</span>
									</h1>
									<h4 class="blue">&copy; Wildan Company</h4>
								</div>
							</div>

							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-coffee green"></i>
													Login
												</h4>

												<div class="space-6"></div>

												<?php 
												$session = session();
												$info = $session->getFlashdata('info');
												if ($info) {
													echo $info;
												}
												?>

												<form name="form_login" method="post" action="<?php echo base_url('Auth_controller/proses'); ?>">
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																<input type="text" name="no_karyawan" class="span12" placeholder="No Karyawan" />
																<i class="icon-user"></i>
															</span>
														</label>

														<label>
															<span class="block input-icon input-icon-right">
																<input type="password" name="password" class="span12" placeholder="Password" />
																<i class="icon-lock"></i>
															</span>
														</label>

														<div class="space"></div>

														<div class="clearfix">
															<button type="submit" name="btn_login" value="1" class="width-35 pull-right btn btn-small btn-primary">
																<i class="icon-key"></i>
																Login
															</button>
														</div>

														<div class="space-4"></div>
													</fieldset>
												</form>
											</div><!--/widget-main-->

											<div class="toolbar clearfix center-white">
                                                <h6 class="text-white text-center">&copy; Dibuat : Wildan Fathir Qinthara</h6>
											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->
	</body>
</html>