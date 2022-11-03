<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {
$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$cid=$_POST['cid'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$city=$_POST['city'];
$country=$_POST['country'];
$id=intval($_GET['id']);

$sql="update tblusers set FullName=:name,EmailId=:email,ContactNo=:mobile,cid=:cid,dob=:dob,Address=:address,City=:city,Country=:country where id=:id ";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':country',$country,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$msg="Data updated successfully";
echo "<script type='text/javascript'> document.location = 'reg-users.php'; </script>";
}
	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Car Spare Parts | Admin Edit User Info</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
	<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Edit User Information</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<div class="panel-body">
										<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
										<?php 
										$id=intval($_GET['id']);
										$sql ="SELECT * from tblusers where tblusers.id=:id";
										$query = $dbh -> prepare($sql);
										$query-> bindParam(':id', $id, PDO::PARAM_STR);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
										foreach($results as $result)
										{	?>

										<form method="post" class="form-horizontal" enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-sm-2 control-label">Full Name</label>
												<div class="col-sm-4">
												<input type="text" name="name" class="form-control" value="<?php echo htmlentities($result->FullName)?>" >
												</div>
												<label class="col-sm-2 control-label">Email Address</label>
												<div class="col-sm-4">
												<input type="text" name="email" class="form-control" value="<?php echo htmlentities($result->EmailId)?>" >
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Mobile Number</label>
												<div class="col-sm-4">
												<input type="text" name="mobile" class="form-control" value="<?php echo htmlentities($result->ContactNo)?>" >
												</div>
												<label class="col-sm-2 control-label">National Id</label>
												<div class="col-sm-4">
												<input type="text" name="cid" class="form-control" value="<?php echo htmlentities($result->cid)?>" >
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Date Of Birth</label>
												<div class="col-sm-4">
												<input type="text" name="dob" class="form-control" value="<?php echo htmlentities($result->dob)?>" >
												</div>
												<label class="col-sm-2 control-label">Address</label>
												<div class="col-sm-4">
												<input type="text" name="address" class="form-control" value="<?php echo htmlentities($result->Address)?>" >
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">City</label>
												<div class="col-sm-4">
												<input type="text" name="city" class="form-control" value="<?php echo htmlentities($result->City)?>" >
												</div>
												<label class="col-sm-2 control-label">Country</label>
												<div class="col-sm-4">
												<input type="text" name="country" class="form-control" value="<?php echo htmlentities($result->Country)?>" >
												</div>
											</div>
										</div>
										<div class="hr-dashed"></div>									
										</div>
									</div>
								</div>
							</div>								
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-body">
											<?php }} ?>
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2" >
													<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>