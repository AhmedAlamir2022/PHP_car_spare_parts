<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{

if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from reports  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Report is deleted  successfully";

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
  <title>Car Spare Parts |Admin Manage Reports   </title>
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
            <h2 class="page-title">Manage Reports </h2><br><br>

<?php 
//Query for Listing count
$brand=$_POST['brand'];
$sql = "SELECT id from reports where reports.branch_name=:brand ";
$query = $dbh -> prepare($sql);
$query -> bindParam(':brand',$brand, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
?>
<p><span><?php echo htmlentities($cnt);?> results</span></p>
</div>
</div>

  <div class="panel panel-default">
              <div class="panel-heading">Report Details</div>
              <div class="panel-body">
              <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
              else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
  <thead>
                    <tr>
                      <th>#</th>
                      <th>Employee Name</th>
                      <th>Employee Branch </th>
                      <th>Number Of Orders</th>
                      <th>Number Of Bookings</th>
                      <th>Quantity </th>
                      <th>Details Of Product 1 </th>
                      <th>Details Of Product 2 </th>
                      <th>Details Of Product 3 </th>
                      <th>Details Of Product 4 </th>
                      <th>General Details </th>
                      <th>Total Price </th>
                      <th>Creation Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Employee Name</th>
                      <th>Employee Branch </th>
                      <th>Number Of Orders</th>
                      <th>Number Of Bookings</th>
                      <th>Quantity </th>
                      <th>Details Of Product 1 </th>
                      <th>Details Of Product 2 </th>
                      <th>Details Of Product 3 </th>
                      <th>Details Of Product 4 </th>
                      <th>General Details </th>
                      <th>Total Price </th>
                      <th>Creation Date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $sql = "SELECT reports.emp_name,tblbrands.BrandName,reports.details,reports.num_orders,reports.num_bookings,reports.quantity,reports.pro_1,reports.pro_2,reports.pro_3,reports.pro_4,reports.t_price,reports.creation_date,reports.id from reports join tblbrands on tblbrands.id=reports.branch_name where reports.branch_name=:brand ";
                    $query = $dbh -> prepare($sql);
                    $query -> bindParam(':brand',$brand, PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
                    {  ?> 
                    <tr>
                      <td><?php echo htmlentities($cnt);?></td>
                      <td><?php echo htmlentities($result->emp_name);?></td>
                      <td><?php echo htmlentities($result->BrandName);?></td>
                      <td><?php echo htmlentities($result->num_orders);?></td>
                      <td><?php echo htmlentities($result->num_bookings);?></td>
                      <td><?php echo htmlentities($result->quantity);?></td>
                      <td><?php echo htmlentities($result->pro_1);?></td>
                      <td><?php echo htmlentities($result->pro_2);?></td>
                      <td><?php echo htmlentities($result->pro_3);?></td>
                      <td><?php echo htmlentities($result->pro_4);?></td>
                      <td><?php echo htmlentities($result->details);?></td>
                      <td><?php echo htmlentities($result->t_price);?></td>
                      <td><?php echo htmlentities($result->creation_date);?></td>
                      <td><a href="reports.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
                    </tr>
                    <?php $cnt=$cnt+1; }} ?>    
                  </tbody>
                  </div>
            </div>
      <?php  ?>
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
