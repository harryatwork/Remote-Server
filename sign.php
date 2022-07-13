<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title>Vdofy</title>
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.pngs" type="image/png" />
	<!-- Vector CSS -->
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&amp;family=Roboto&amp;display=swap" />
	<!-- Icons CSS -->
	<link rel="stylesheet" href="assets/css/icons.css" />
	<!-- App CSS -->
	<link rel="stylesheet" href="assets/css/app.css" />
	
	
	<link href="assets/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
	<link href="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	
	
</head>

<body class="bg-theme bg-theme1">
    <div class="wrapper">
        
        <input type="hidden" id="sub_id" value="0" />
        
        <div class="section-authentication-login d-flex align-items-center justify-content-center">
			<div class="row">
				<div class="col-12 col-lg-10 mx-auto" style="margin-top: 35px;">
					<div class="card radius-15">
						<div class="row no-gutters">
							<div class="col-lg-6">
								<div class="card-body p-md-5">
									<div class="text-center">
										<img src="assets/images/general/logo.png" class="logo-icon-2" alt="" style="width:250px;" />
										<h3 class="mt-4 font-weight-bold">Welcome</h3>
									</div>
								    <form action="backend_functions/logincheck.php" method="post" id="logincheck" ></form>
									<div class="form-group mt-4">
										<label>Email Address</label>
										<input type="text" id="login_form_email" form="logincheck" class="form-control" placeholder="Enter your email address" />
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" id="login_form_password" form="logincheck" class="form-control" placeholder="Enter your password" />
									</div>
									<div class="btn-group mt-3 w-100">
										<button type="button" form="logincheck" class="btn btn-light btn-block login_submit_btn">Log In</button>
										<button type="button" form="logincheck" class="btn btn-light login_submit_btn"><i class="lni lni-arrow-right"></i>
										</button>
									</div>
									<hr>
									<div class="login_form_error_message" style="display:none;text-align: center;font-size: 11px;background: #0c2255;padding: 5px 0px;border-radius: 7px">
									    <p>Email or Password seems to be incorrect. <br/> Please try again.</p>
									</div>
									<div class="login_form_error_message_2" style="display:none;text-align: center;font-size: 11px;background: #0c2255;padding: 5px 0px;border-radius: 7px">
									    <p>Email and Password are mandatory</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<img src="assets/images/login-images/login-frent-img.jpg" class="card-img login-img h-100" alt="...">
							</div>
						</div>
						<!--end row-->
					</div>
				</div>
			</div>
		</div>
        
        

    </div>
    
<?php include("foot.php"); ?>

<?php include("modals.php"); ?>

<?php include("script.php"); ?>

    </body>
</html>