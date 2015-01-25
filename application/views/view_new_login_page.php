<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">

<!-- Bootstrap Stylesheet 
<link rel="stylesheet" href="bootstrap/css/bootstrap-login.min.css" media="screen">-->

<link rel="stylesheet" href='<?=base_url().'bootstrap/css/bootstrap-login.css'?>' media="screen">

<link rel="stylesheet" href='<?=base_url().'assets/css/fonts/icomoon/style.css'?>' media="screen">

<!--<link rel="stylesheet" href="assets/css/login-style.css" media="screen"> -->
<link rel="stylesheet" href='<?=base_url().'assets/css/login-style.css'?>' media="screen">
<link rel="stylesheet" href='<?=base_url().'assets/css/rotating-card.css'?>' media="screen">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'>


<title>Organizing and Extending the Memory of your Brain</title>

</head>

<body style="background-color: #E5E9ED;">

	<div style="background-image: url(<?=base_url().'assets/images/layout/bg/mac_bg.png'?>); background-size: cover; background-repeat: no-repeat" id="height_change">

		<div id="for_padding_top" class="col-sm-5">

			<div id="login-wrap"> <!-- start of the login wrap -->
				<div id="login-ribbon"><i class="icon-lock"></i></div>

				<div id="login-buttons">
					<div class="btn-wrap">
						<button type="button" class="btn btn-inverse" data-target="#login-form"><i class="icon-key"></i></button>
					</div>
					<div class="btn-wrap">
						<button type="button" class="btn btn-inverse" data-target="#register-form"><i class="icon-edit"></i></button>
					</div>
					<div class="btn-wrap">
						<button type="button" class="btn btn-inverse"data-target="#forget-form"><i class="icon-question-sign"></i></button>
					</div>
				</div>

				<div id="login-inner">
					<div id="login-circle">

						<!-- Login -->				
						<section id="login-form" class="login-inner-form active" data-angle="0">
							<h1>Login</h1>
							<form data-toggle="validator" class="form-vertical" action="<?=base_url().'index.php/main/login_validation'?>" method="POST">
								<div class="control-group">
									<?php echo validation_errors(); ?>
								</div>

								<div class="control-group">
									<input type="text" placeholder="Email" name="email" class="big">
									<input type="password" placeholder="Password" name="password" class="big">
								</div>
								<div class="control-group">
									<label class="checkbox">
										<input type="checkbox" class="uniform"> Remember me
									</label>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-success btn-block btn-large">Login</button>
								</div>
							</form>

						</section>
						<!-- Regisster -->
						<section id="register-form" class="login-inner-form" data-angle="90">
							<h1>Register Now!</h1>
							<form id="register_form" class="form-vertical" action="<?=base_url().'index.php/main/register_validation'?>" method="POST">

								<div class="control-group">
									<?php echo validation_errors(); ?>
								</div>

								<div class="control-group">
									<label class="control-label">Email</label>
									<div class="controls">
										<input type="email" name="email" id="email" data-error="Hey, that email address is invalid" required>
										<div data-bv-emailaddress-message="The value is not a valid email address"></div>
									</div>
								</div>


								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" name="password" data-minlength="5" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">First Name</label>
									<div class="controls">
										<input type="text" name="firstname" required>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Last Name</label>
									<div class="controls">
										<input type="text" name="lastname" required>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label">Major</label>
									<div class="controls">
										<select class="form-control" id="major" name="major" required>
											<option disabled="disabled" selected="">- Major -</option>
											<?php
											foreach ($major_selection as $major) {
												echo "<option>" . $major->cat_name . "</option>";
											}
											?>
											<option>- Cannot find your major? -</option>

										</select>
									</div>
								</div>



								<div class="form-actions">
									<button type="submit" class="btn btn-danger btn-block btn-large">Register</button>
								</div>
							</form>
						</section>

						<!-- Reset Password -->
						<section id="forget-form" class="login-inner-form" data-angle="180">
							<h1>Reset Password</h1>
							<form class="form-vertical" action="user_management/resetpassword.php">
								<div class="control-group">
									<div class="controls">
										<input type="text" class="big" placeholder="Enter Your Email...">
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-danger btn-block btn-large">Reset</button>
								</div>
							</form>
						</section>
					</div>
				</div>
			</div> <!-- end of the login wrap -->


		</div><!-- for padding top -->

		<div id="for_padding_top_2" class="col-sm-6">
			<div class="description">
				<h2 style="color: white;">Organizing & Extending Your Brain</h2>
				<br>
				<h5 style="color:#E6E6E6; font-weight: 300;">Your personal knowledge management system will help your to keep and organize your knowledge extremely effectively! It is also an awesome social network, where you can see what your peers are learning. The most most fantastic part, it will find your knowledge blind spot and give you recommended knowledge!</h5>
			</div>
			<div class="buttons" style="float: right;">
				<button class="btn btn-simple btn-neutral">
					<i class="fa fa-search"> Learn More</i>
				</button>
				<button class="btn btn-simple btn-neutral">
					<i class="fa fa-envelope"> Contact Author</i>
				</button>
			</div>
		</div><!--  end of intro -->

	</div> <!-- end of section one -->




	<!-- start of the rotation section -->
	<div style="background-color: #E5E9ED; height: 500px;">

		<div class="row col-sm-12" style="padding-top: 0px;">

			<h5 class="title">
				More about the system
				<br>
				<small>FYP of Evian, Yiyun ZHOU</small>
			</h5>

			<div class="col-sm-2 col-md-3"></div>

			<div class="col-sm-3 col-md-2">
				<div class="card-container">
					<div class="card">
						<div class="front">
							<div class="content">
								<div class="main">
									<h3 class="name">Author</h3>
									<p class="profession">Evian, Yiyun ZHOU</p>
									<h5 style="font-size: 14px;"><i class="fa fa-map-marker fa-fw text-muted"></i> HKBU</h5>
									<h5 style="font-size: 14px;"><i class="fa fa-building-o fa-fw text-muted"></i> COMP - IS</h5>
									<h5 style="font-size: 14px;"><i class="fa fa-envelope-o fa-fw text-muted"></i> evian720@yahoo.com.hk</h5>
								</div>
								<div class="footer">
									<div class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
							</div>
						</div> <!-- end front panel -->

						<div class="back">
							<div class="header">
								<h5 class="motto">Knowledge is Power -- Francis Bacon</h5>
							</div> 
							<div class="content">
								<div class="main">
									<h4 style="font-size: 18px;" class="text-center">Edution</h4>
									<p style="font-size: 14px; text-align: center;">HKBU: 2011-2014</p>
									<h4 style="font-size: 18px;" class="text-center">Interest</h4>
									<p style="font-size: 14px; text-align: center;">Sports, Photography, Technology</p>
								</div>
							</div>
							<div class="footer">
								<div class="social-links text-center">
									<a href="https://www.facebook.com/evian.zhou" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
								</div>
							</div>
						</div> <!-- end back panel -->
					</div> <!-- end card -->
				</div> <!-- end card-container -->
			</div>

			<div class="col-sm-1"></div>

			<div class="col-sm-3 col-md-2">
				<div class="card-container">
					<div class="card">
						<div class="front">
							<div class="content">
								<div class="main">
									<h3 class="name">System</h3>
									<p class="profession">Your Personal KM</p>
									<h5 style="font-size: 14px;" class="text-center"> - FYP of BSc COMP STD</h5>
									<h5 style="font-size: 14px;"> - Development Starts: Spet. 2014</h5>
									<h5 style="font-size: 14px;"> - Development Ends: -</h5>
								</div>
								<div class="footer">
									<div class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
							</div>
						</div> <!-- end front panel -->

						<div class="back">
							<div class="header">
								<h5 class="motto">Any fool can know. The point is to understand. -- Albert Einstein</h5>
							</div> 
							<div class="content">
								<div class="main">
									<h4 style="font-size: 18px;">Technology</h4>
									<p style="font-size: 14px; text-align: center;"> - Bootstrap</p>
									<p style="font-size: 14px; text-align: center;"> - Javascript/jQuery</p>
									<p style="font-size: 14px; text-align: center;"> - Codeigniter</p>
									<p style="font-size: 14px; text-align: center;"> - D3.js</p>
								</div>
							</div>
							<div class="footer">
								<div class="social-links text-center">
									<a href="https://www.facebook.com/evian.zhou" class="facebook"><i class="fa fa-facebook fa-fw"></i></a>
								</div>
							</div>
						</div> <!-- end back panel -->
					</div> <!-- end card -->
				</div> <!-- end card-container -->
			</div>
		</div>
	</div><!-- start of the rotation section -->


	<div style="background-color: #2f2f2f; height: 300px" id="black">
		<div style="padding-top: 50px;text-align: center;">
			<div class="row col-sm-12">
				<div class="col-sm-2 col-sm-offset-2">
					<p><i class="fa fa-user"></i></p>
					<h1>349</h1>
					<hr>
					<h4>users</h4>
				</div>		

				<div class="col-sm-2">
					<p><i class="fa fa-cloud"></i></p>
					<h1>8</h1>
					<hr>
					<h4>area</h4>
				</div>

				<div class="col-sm-2">
					<p><i class="fa fa-graduation-cap"></i></p>
					<h1>61</h1>
					<hr>
					<h4>major</h4>
				</div>

				<div class="col-sm-2">
					<p><i class="fa fa-file-pdf-o"></i></p>
					<h1>2,988</h1>
					<hr>
					<h4>knowledge</h4>
				</div>
			</div>



		</div>
	</div><!-- /black -->



	<div style="background-color: #FFFFFF; height: 50px;" class="col-sm-12">
		<div style="text-align: center; padding-top: 15px;">
			<a href="http://101.78.175.101:8580/fyp/knowledge_hub" style="color: black;  font-size: 14px;">@Organizing & Extending the Memory of Your Brain</a>
		</div>
	</div>



      
	



    

<!-- Core Scripts -->
<script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
<script src='<?=base_url().'bootstrap/js/bootstrapValidator.js'?>'></script>
<script src='<?=base_url().'bootstrap/js/bootstrap.js'?>'></script>
<script src='<?=base_url().'assets/js/libs/jquery.placeholder.min.js'?>'></script>
<!-- Login Script -->
<script src='<?=base_url().'assets/js/login.js'?>'></script>

<script type="text/javascript">

$(document).ready(function() {
	$('#email').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            }
        }
    });

	$('#major').change( function() {
        var value = $(this).val();
        if (!value || value == '- Cannot find your major? -') {

           var other = prompt( "Please input your major:" );

           if (!other) return false;
           $(this).append('<option value="'
                             + other
                             + '" selected="selected">'
                             + other
                             + '</option>');
        }
    });

});

</script>



</body>

</html>
