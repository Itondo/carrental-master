<!--Mobile Detector-->
<?php
require_once "isMobile/Mobile_Detect.php";
$detect = new Mobile_Detect;
$isMobile = false;
$navColor = "";
$btnColor = "";
$fixed = "";
$container = "container";
if ($detect->isMobile() || $detect->isTablet() ) {
    $isMobile = true;
    $btnColor = 'color: #428bca !important;';
    $navColor = "background-color: #428bca !important; color:white !important;";
    $fixed = "position:fixed !important; top:0; left:0; width: 100%; z-index:2;";
    $container = "";
} 

?>
<!--End Mobile Detector-->





<header class="<?php $isMobile ? 'fixed-top' : '' ?> shadowed" style="<?php echo $fixed ?>">
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default  <?php $isMobile ? 'fixed-top shadowed' : ''?>" style="<?php echo $navColor ?>">
    <div class="<?php echo $container ?>">
      <div class="navbar-header" style="padding-left:2rem !important;">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button" style="color:white !important; border: none !important; font-weight:600; top: -2px !important;">EzRent &nbsp; <i class='fa fa-car fa-sm'></i> </button>
        
        
      </div>
              <?php 
      // if ($isMobile) {
          
      //     echo "
      //     <span class='navbar-text' style='position:absolute; text-align:left;color:white; left: 5% !important; top: 5px !important; font-weight:600;'>EzRent &nbsp; <i class='fa fa-car fa-sm'></i></span>
      //     ";
      // }
      ?>
      <div class="header_wrap">
  
        <div class="user_login" style="margin-right:45px;">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>
<?php

$email=$_SESSION['login'];
$sql ="SELECT id, FullName, UserType FROM tblusers WHERE EmailId=:email ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
	{

	 echo htmlentities($result->FullName); }}?>
   <p style="display:none;" id="session_user_email" name="session_user_email"><?php echo $_SESSION['login']; ?></p>
  <p style="display:none;" id="session_user_id" name="session_user_id"><?php echo $result->id; ?></p>
  <p style="display:none;" id="session_user_type" name="session_user_type"><?php echo $result->UserType; ?></p>
  <?php
    if($_SESSION['utype'] == '0' && !empty($_SESSION['verified_at'])){
  ?>
<i class="fa fa-check-circle" aria-hidden="true" style="color: skyblue; font-size: 15px;"></i>
  <?php
    }
   ?>
   <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
           <?php if($_SESSION['login']){?>
            <li><a href="profile.php">Profile Settings</a></li>
              <li><a href="update-password.php">Update Password</a></li>
                 <?php if ($_SESSION['utype'] == '0') {
                echo "
                          <li><a href='manage-bookings.php' id='manage-bookings'>Manage Bookings</a></li>
                          <li><a href='my-vehicles.php' id='my-vehicles'>My Vehicles</a></li>
                          <li><a href='add-vehicle.php' id='add-vehicles'>Add Vehicle</a></li>
                          <li><a href='locations.php' id='view-locations'>Booking Locations</a></li>
                
                
                ";
                
            } else  {
            echo "
            
            
            <li><a href='my-booking.php'>My Booking</a></li>
            <li><a href='post-testimonial.php'>Post a Testimonial</a></li>
          <li><a href='my-testimonials.php'>My Testimonial</a></li>
            ";
            } ?>
            <li><a href="logout.php">Sign Out</a></li>
         
            <?php } else { ?>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Log-in</a></li>
              <!-- <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Sign</a></li>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Booking</a></li>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Post a Testimonial</a></li>
          <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Testimonial</a></li>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Sign Out</a></li> -->
            <?php } ?>
          </ul>
            </li>
          </ul>
        </div>
        <!-- <div class="header_search">
          <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
          <form action="#" method="get" id="header-search-form">
            <input type="text" placeholder="Search..." class="form-control">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div> -->
         <?php 
            if( $detect->isMobile() || $detect->isTablet() ){
                echo '<div class="ml-3  p-1" style="font-size:9px !important; color:#428bca;"></div>';
            }
        ?>
        
        
      </div>
      <div class="collapse navbar-collapse" id="navigation" style="background-color:#428bca; !important;" >
        <ul class="nav navbar-nav">
          <li><a href="index.php" id="nav-home-button">Home</a></li>
          <li><a href="car-listing.php" id="nav-about-us-button">About Us</a></li>
          <!-- <li><a href="page.php?type=aboutus">Car Listing</a> -->
          <!-- <li><a href="page.php?type=faqs">FAQs</a></li> -->
          <li><a href="contact-us.php" id="nav-contact-us-button">Contact Us</a></li>
         <?php 
            if( $detect->isMobile() || $detect->isTablet() ){
                echo '<li> <a href="admin/">Admin Login</a></li><br/>';
                echo '<style="color:white !important;">';
                include('subscribe.php');
                echo '</style>';
            }
        ?>
          
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end -->

</header>
<?php $isMobile ? '<br><br><br><div style="margin-top:20rem;></div>' : '' ?>

<script src="assets/js/jquery.min.js"></script>
<script>
	// <?php
	// 	if(empty($_SESSION['verified_at'])){
	// ?>
	// 	$('#add-vehicles').attr('href', '#');
	// 	$('#manage-bookings').attr('style', 'background-color: white; color: black;');
	// 	$('#my-vehicles').attr('style', 'background-color: white; color: black;');
	// 	$('#add-vehicles').attr('style', 'background-color: white; color: black;');
		
	// <?php
	// 	}
	?>
	// $('#add-vehicles').click(function() {
	// 	<?php
	// 		if(!empty($_SESSION['verified_at'])){
	// 	?>
	// 		$('#add-vehicles').attr('href', 'add-vehicle.php');
	// 	<?php
	// 		}else{
	// 	?>
	// 		alert("Your lender account has not been verified. Only verified lenders are allowed to upload their vehicles.");
	// 	<?php
	// 		}
	// 	?>
	// });
	// $('#manage-bookings').click(function() {
	// 	<?php
	// 		if(!empty($_SESSION['verified_at'])){
	// 	?>
	// 		$('#manage-bookings').attr('href', 'manage-bookings.php');
	// 	<?php
	// 		}else{
	// 	?>
	// 		alert("Your lender account has not been verified. Only verified lenders are allowed to manage bookings.");
	// 	<?php
	// 		}
	// 	?>
	// });
	// $('#my-vehicles').click(function() {
	// 	<?php
	// 		if(!empty($_SESSION['verified_at'])){
	// 	?>
	// 		$('#my-vehicles').attr('href', 'my-vehicles.php');
	// 	<?php
	// 		}else{
	// 	?>
	// 		alert("Your lender account has not been verified. Only verified lenders are allowed to view their vehicles.");
	// 	<?php
	// 		}
	// 	?>
	// });
</script>