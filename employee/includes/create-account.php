<?php
	include '../connect.php';
	include 'functions.php';

	if(isset($_POST['signup'])){
		$form_erorrs = array();
		$required_fields = array('email','username','password');
		$form_erorrs = array_merge($form_erorrs , check_empty_fields($required_fields));
		$fields_to_check_length = array('username' => 4,'password' =>6);
		$form_erorrs = array_merge($form_erorrs , check_min_length($fields_to_check_length));
		$form_erorrs = array_merge($form_erorrs , check_email($_POST));

		if(empty($form_erorrs)){
			$email = $_POST['email'];
			$username = $_POST['username'];
			$password = $_POST['password'];


			$hashed_password = password_hash($password , PASSWORD_DEFAULT);

			try{
				$sqlInsert = "INSERT INTO users (username,email,password,join_date)
							VALUES(:username, :email, :password, now())";
							
				$statment = $db->prepare($sqlInsert);	
				$statment->execute(array(':username' => $username,':email' => $email,':password' => $hashed_password));

				if($statment->rowCount() == 1){
					$results = "<p style='padding : 20px; color : green;'>Registration sucssesful </P>";
				}
				header("location: login.php");
			}catch(PDOException $e){
				$results = "<p style='padding-top : 10px; color : red;'>An Error Occured:" .$e->getMessage(). "</P>";
				echo " <p style='padding-buttom : 10px; color : red;text-align:center;'> This user or email is exist </p>";
			}
		}
	}

?>


<!DOCTYPE html>
<head>
	<title>Create Account</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap-social.css" rel="stylesheet" type="text/css">	
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">	
	<link href="css/frontend.css" rel="stylesheet" type="text/css">	
</head>
	<body class="templatemo-bg-image-1">
	<div class="container">
		<div class="col-md-12">		


		<?php if(isset($results) )    echo "$results";   ?>	
		<?php if(!empty($form_erorrs)) echo show_errors($form_erorrs);  ?>
			<form class="form-horizontal templatemo-login-form-2" role="form" action="" method="post">
				<div class="row">
					<div class="col-md-12">
						<h1>انشاء حساب جديد</h1>
					</div>
				</div>
				<div class="row">
					<div class="templatemo-one-signin col-md-12">
				        <div class="form-group">
				          <div class="col-md-12">		          	
				            <label for="username" class="control-label" >أسم المستخدم</label>
				            <div class="templatemo-input-icon-container">
				            	<i class="fa fa-user"></i>
				            	<input type="text" class="form-control" id="username" name="username" placeholder="" required>
				            </div>		            		            		            
				          </div>              
				        </div>
				        <div class="form-group">
				          <div class="col-md-12">
				            <label for="email" class="control-label">البريد الالكترونى</label>
				            <div class="templatemo-input-icon-container">
				            	<i class="fa fa-book"></i>
				            	<input type="email" class="form-control" id="email" name="email" placeholder="" required>
				            </div>
				          </div>
				        </div>
				        <div class="form-group">
				          <div class="col-md-12">
				            <label for="password" class="control-label">كلمه السر</label>
				            <div class="templatemo-input-icon-container">
				            	<i class="fa fa-lock"></i>
				            	<input type="password" class="form-control" id="password" name="password" placeholder="" required>
				            </div>
				          </div>
				        </div>
				        <div class="form-group">
			          		<div class="col-md-12">
			            		<input type="submit" value="أنشى حساب" name="signup" class="btn btn-info">
			            		<a href="login.php" class="pull-right">سجل الدخول</a>
			          		</div>
			        	</div>	
					</div>
				</div>				 	
		      </form>		      		      
		</div>
	</div>
</body>
</html>