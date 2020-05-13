<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_REQUEST['del']))
{
$delid=intval($_GET['del']);
$sql = "delete from tblvehicles WHERE id=:delid";
$query = $dbh->prepare($sql);
$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
$query -> execute();
$msg="Vehicle record deleted successfully";
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
	
	<title>EZRent |Admin Manage Vehicles   </title>

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
	<link rel="stylesheet" href="css/manage-vehicles.css">
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

						<h2 class="page-title">Manage Vehicles</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Vehicle Details</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Vehicle Title</th>
											<th>Brand </th>
											<th>Price Per day</th>
											<th>Fuel Type</th>
											<th>Model Year</th>
											<!-- <th>Action</th> -->
											<th>OR</th>
											<th>CR</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Vehicle Title</th>
											<th>Brand </th>
											<th>Price Per day</th>
											<th>Fuel Type</th>
											<th>Model Year</th>
											<!-- <th>Action</th> -->
											<th>OR</th>
											<th>CR</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

<?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id, tblvehicles.vehicle_or, tblvehicles.vehicle_cr from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand order by tblvehicles.id desc";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->VehiclesTitle);?></td>
											<td><?php echo htmlentities($result->BrandName);?></td>
											<td><?php echo htmlentities($result->PricePerDay);?></td>
											<td><?php echo htmlentities($result->FuelType);?></td>
												<td><?php echo htmlentities($result->ModelYear);?></td>
		<!-- <td><a href="edit-vehicle.php?id=<?php echo $result->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="manage-vehicles.php?del=<?php echo $result->id; ?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close" id="del"></i></a></td> -->
											<td>
												<a href="manage-vehicles.php?vehicle_or=<?php echo $result->id; ?>" class="btn btn-primary" id="vehicle_or"><span class="fa fa-image"></span> &nbsp;&nbsp;View OR</a>
												<button type="button" id="manage-vehicles-trigger-me-or" data-toggle="modal" data-target="#view-or-modal"></button>
											</td>
											<td>
												<a href="manage-vehicles.php?vehicle_cr=<?php echo $result->id; ?>" class="btn btn-primary" id="vehicle_cr"><span class="fa fa-image"></span> &nbsp;&nbsp;View CR</a>
												<button type="button" id="manage-vehicles-trigger-me-cr" data-toggle="modal" data-target="#view-cr-modal"></button>
											</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>

						

							</div>
						</div>

					

					</div>
				</div>

			</div>
		</div>
	</div>

	

	<!-- OR MODAL -->
	<div class="modal fade" id="view-or-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title-or"><strong>Vehicle OR Image</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button-modal-or">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
					$sql = "SELECT vehicle_or FROM tblvehicles WHERE id = :vehicle_id";
					$query = $dbh->prepare($sql);
					$query->bindParam(':vehicle_id',$_REQUEST['vehicle_or'], PDO::PARAM_STR);
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_OBJ);
				?>
				<img src="img/documents/<?php echo htmlentities($result[0]->vehicle_or);?>" alt="vehicle or" id="vehicle_image_or" style="display: block; width: 550px; height: 500px; margin: auto; padding: auto; border: 1px solid black;">
			</div>
			
			</div>
		</div>
	</div>
	<!-- END OR MODAL -->


	<!-- CR MODAL -->
	<div class="modal fade" id="view-cr-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title-cr"><strong>Vehicle CR Image</strong></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-button-modal-cr">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php
					$sql = "SELECT vehicle_cr FROM tblvehicles WHERE id = :vehicle_id";
					$query = $dbh->prepare($sql);
					$query->bindParam(':vehicle_id',$_REQUEST['vehicle_cr'], PDO::PARAM_STR);
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_OBJ);
				?>
				<img src="img/documents/<?php echo htmlentities($result[0]->vehicle_cr);?>" alt="vehicle cr" id="vehicle_image_cr" style="display: block; width: 550px; height: 500px; margin: auto; padding: auto; border: 1px solid black;">
			</div>
			
			</div>
		</div>
	</div>
	<!-- END CR MODAL -->

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
<script>
	<?php
		if(isset($_REQUEST['vehicle_or'])) {
	?>
		$('#manage-vehicles-trigger-me-or').click();
	<?php
		}

		if(isset($_REQUEST['vehicle_cr'])){
	?>
		$('#manage-vehicles-trigger-me-cr').click();
	<?php
		}
	?>

</script>
</html>
<?php } ?>
