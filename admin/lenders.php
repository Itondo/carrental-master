

<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');
	if(strlen($_SESSION['alogin'])==0)
		{	
	header('location:index.php');
	}
	else{
	if(isset($_REQUEST['eid']))
		{
	$eid=intval($_GET['eid']);
$date="0000-00-00";
	$sql = "UPDATE tblusers SET verified_at=:date WHERE  id=:eid";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':date',$date, PDO::PARAM_STR);
	$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
	$query -> execute();

	$msg="Lender Application denied.";
	}


	if(isset($_REQUEST['aeid']))
		{
	$aeid=intval($_GET['aeid']);
	$sql = "UPDATE tblusers SET verified_at = CURDATE() WHERE id=:aeid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':aeid',$aeid, PDO::PARAM_STR);
	$query->execute();

	$msg="Application confirmed";
	}

	if(isset($_REQUEST['rid'])){
		$rid = intval($_GET['rid']);
		$status = 3;

		$sql = "UPDATE tblusers SET Status=:status WHERE  id=:rid";
		$query = $dbh->prepare($sql);
		$query -> bindParam(':status',$status, PDO::PARAM_STR);
		$query-> bindParam(':rid',$rid, PDO::PARAM_STR);
		$query -> execute();
		$msg = "Vehicle has been returned.";
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
	<title>EZRent |Admin Manage testimonials   </title>

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
	<link rel="stylesheet" href="css/manage-lender.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
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
		
		
	<script src="js/jquery.min.js"></script>
		<!-- lightbox stuff -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

	<!---->
</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Manage Lender Applications</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Application Info</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Name</th>
											<th>Status</th>
											<th>Registration date</th>
											<th>1st Vehicle OR</th>
											<th>1st Vehicle CR</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
									<tr>
										<th>#</th>
											<th>Name</th>
											<th>Status</th>
											<th>Registration date</th>
											<th>1st Vehicle OR</th>
											<th>1st Vehicle CR</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT id, FullName, verified_at, regdate from tblusers where usertype = 0 order by id desc";
										$query = $dbh -> prepare($sql);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
										foreach($results as $result)
										{				
									?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->FullName);?></td>
								
											<td>
											<?php 
												if($result->verified_at==null)
												{
												echo htmlentities('Pending');
												} else if ($result->verified_at!=0000-00-00) {
												echo htmlentities('Accepted');
												} else {
												    
												echo htmlentities('Denied');
												}
											?>
											</td>
										
													<td><?php echo htmlentities($result->regdate);?></td>
												
													<td>
														<a href="lenders.php?lender_or=<?php echo $result->id; ?>" class="btn btn-primary" id="lender_or"><span class="fa fa-image"></span> &nbsp;&nbsp;View OR</a>
														<button type="button" id="lender-trigger-me-or" data-toggle="modal" data-target="#lender-view-or-modal"></button>
													</td>
													<td>
														<a href="lenders.php?lender_cr=<?php echo $result->id; ?>" class="btn btn-primary" id="lender_cr"><span class="fa fa-image"></span> &nbsp;&nbsp;View CR</a>
														<button type="button" id="lender-trigger-me-cr" data-toggle="modal" data-target="#lender-view-cr-modal"></button>
													</td>
										<?php
											if($result->verified_at == null) {
										?>
											<td>
												<a href="lenders.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Confirm this application')"> Confirm</a>/
												<a href="lenders.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Cancel this application')"> Cancel</a>
											</td>
		                                    <?php
											}else{
										?>
											<td>N/A</td>
										<?php
											}
										?>
									
								
									
										
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
	<div class="modal fade" id="lender-view-or-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
					$sql = "SELECT vehicle.vehicle_or FROM tblvehicles vehicle inner join tblusers user on vehicle.user_id = user.id WHERE user.id = :user_id order by user.id limit 1";
					$query = $dbh->prepare($sql);
					$query->bindParam(':user_id',$_REQUEST['lender_or'], PDO::PARAM_STR);
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
	<div class="modal fade" id="lender-view-cr-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
					$sql = "SELECT vehicle.vehicle_cr FROM tblvehicles vehicle inner join tblusers user on vehicle.user_id = user.id WHERE user.id = :user_id order by user.id limit 1";
					$query = $dbh->prepare($sql);
					$query->bindParam(':user_id',$_REQUEST['lender_cr'], PDO::PARAM_STR);
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

	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script>
		<?php
			if(isset($_REQUEST['rid'])){
		?>
			console.log(<?php echo $_REQUEST['rid']; ?>)
			window.location = window.location.pathname;
		<?php
			}

			if(isset($_REQUEST['rate_id'])){
		?>
			$.ajax({
				type: "GET",
				url: "lenders.php?rate_id=<?php $_REQUEST['rate_id'] ?>",
				success: function(data) {
					$("#trigger-me").click();
				}
			});
			console.log(<?php echo $_REQUEST['rate_id']; ?>);
		<?php
			}
		?>
	</script>
	
	<!-- MODAL -->
	<div class="modal fade" tabindex="-1" role="dialog" id="ratingModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="font-family: 'Montserrat', sans-serif;">
			<div class="modal-body text-center">
				<h3 class="display-5 text-center">Rate Customer</h3>
				
				<?php
					$sql = "SELECT user.FullName, booking.userEmail FROM tblusers user INNER JOIN tblusers booking on user.EmailId = booking.userEmail WHERE booking.id = :rate_id;";
					$query = $dbh->prepare($sql);
					$query->bindParam(':rate_id',$_REQUEST['rate_id'], PDO::PARAM_STR);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
				?>
				<span class="glyphicon glyphicon-user" aria-hidden="true" style="font-size: 50px; padding-top: 2px;"></span>
				
				<h5 class="display-5 text-center"><strong><?php echo $results[0]->FullName;?></strong></h5>
				<h5 class="display-6 text-center"><strong><?php echo $results[0]->userEmail;?></strong></h5>
				<hr class="dashed">
				<div class="rating">
				<button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align" name="first_star" value="first_star" id="first_star">
					<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px; padding-top: 2px;"></span>
				</button>
				<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align" name="second_star" value="second_star" id="second_star">
					<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px; padding-top: 2px;"></span>
				</button>
				<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align" name="third_star" value="third_star" id="third_star">
					<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px; padding-top: 2px;"></span>
				</button>
				<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align" name="fourth_star" value="fourth_star" id="fourth_star">
					<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px; padding-top: 2px;"></span>
				</button>
				<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align" name="fifth_star" value="fifth_star" id="fifth_star">
					<span class="glyphicon glyphicon-star" aria-hidden="true" style="font-size: 20px; padding-top: 2px;"></span>
				</button>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" name="submit_rating" value="<?php echo $_REQUEST['rate_id']; ?>" id="submit_rating" onclick="submitRating();">Submit Rating</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>

	<!-- END MODAL -->

	<!-- SCRIPT IN MOVING RATINGS -->
	<script>
		$('#first_star').click(function (event) {

			// Don't follow the link
			event.preventDefault();

			// Log the clicked element in the console
			document.getElementById('first_star').className = "btn btn-warning btn-sm";
			document.getElementById('second_star').className = "btn btn-default btn-sm";
			document.getElementById('third_star').className = 'btn btn-default btn-sm';
			document.getElementById('fourth_star').className = 'btn btn-default btn-sm';
			document.getElementById('fifth_star').className = 'btn btn-default btn-sm';
			
		});
		$('#second_star').click(function (event) {

			// Don't follow the link
			event.preventDefault();

			// Log the clicked element in the console
			document.getElementById('first_star').className = "btn btn-warning btn-sm";
			document.getElementById('second_star').className = "btn btn-warning btn-sm";
			document.getElementById('third_star').className = 'btn btn-default btn-sm';
			document.getElementById('fourth_star').className = 'btn btn-default btn-sm';
			document.getElementById('fifth_star').className = 'btn btn-default btn-sm';
			
		});
		$('#third_star').click(function (event) {

			// Don't follow the link
			event.preventDefault();

			// Log the clicked element in the console
			document.getElementById('first_star').className = "btn btn-warning btn-sm";
			document.getElementById('second_star').className = "btn btn-warning btn-sm";
			document.getElementById('third_star').className = 'btn btn-warning btn-sm';
			document.getElementById('fourth_star').className = 'btn btn-default btn-sm';
			document.getElementById('fifth_star').className = 'btn btn-default btn-sm';
			
		});
		$('#fourth_star').click(function (event) {

			// Don't follow the link
			event.preventDefault();

			// Log the clicked element in the console
			document.getElementById('first_star').className = "btn btn-warning btn-sm";
			document.getElementById('second_star').className = "btn btn-warning btn-sm";
			document.getElementById('third_star').className = 'btn btn-warning btn-sm';
			document.getElementById('fourth_star').className = 'btn btn-warning btn-sm';
			document.getElementById('fifth_star').className = 'btn btn-default btn-sm';
			
		});
		$('#fifth_star').click(function (event) {

			// Don't follow the link
			event.preventDefault();

			// Log the clicked element in the console
			document.getElementById('first_star').className = "btn btn-warning btn-sm";
			document.getElementById('second_star').className = "btn btn-warning btn-sm";
			document.getElementById('third_star').className = 'btn btn-warning btn-sm';
			document.getElementById('fourth_star').className = 'btn btn-warning btn-sm';
			document.getElementById('fifth_star').className = 'btn btn-warning btn-sm';
			
		});
	</script>
	<script>
		var rating = 0;
		function submitRating() {
			if (document.getElementById('first_star').className === "btn btn-warning btn-sm") {
				rating = 1;
			}
			if (document.getElementById('second_star').className === "btn btn-warning btn-sm") {
				rating = 2;
			}
			if (document.getElementById('third_star').className === "btn btn-warning btn-sm") {
				rating = 3;
			}
			if (document.getElementById('fourth_star').className === "btn btn-warning btn-sm") {
				rating = 4;
			}
			if (document.getElementById('fifth_star').className === "btn btn-warning btn-sm") {
				rating = 5;
			}
			$.ajax({
				type: "POST",
				url: "../insert_rating.php",
				data: {
					rating: rating,
					rental: "<?php echo $_SESSION['alogin']; ?>",
					booking_id: "<?php echo $_REQUEST['rate_id']; ?>",
					rate_type: 0
				},
				success: function(data) {
					console.log(data);
					window.location = window.location.pathname;
				}
			});
		}
	</script>
<script>

    $("img").on("error", function () {
    $(this).attr("src", "../img/error.png");
});
</script>
<script>
	<?php
		if(isset($_REQUEST['lender_or'])) {
	?>
		$('#lender-trigger-me-or').click();
	<?php
		}

		if(isset($_REQUEST['lender_cr'])){
	?>
		$('#lender-trigger-me-cr').click();
	<?php
		}
	?>
</script>
</body>
</html>
<?php } ?>
