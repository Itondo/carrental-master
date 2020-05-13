<?php
if(isset($_POST['emailsubscibe']))
{
$subscriberemail=$_POST['subscriberemail'];
$sql ="SELECT SubscriberEmail FROM tblsubscribers WHERE SubscriberEmail=:subscriberemail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':subscriberemail', $subscriberemail, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<script>alert('Already Subscribed.');</script>";
}
else{
$sql="INSERT INTO  tblsubscribers(SubscriberEmail) VALUES(:subscriberemail)";
$query = $dbh->prepare($sql);
$query->bindParam(':subscriberemail',$subscriberemail,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Subscribed successfully.');</script>";
}
else
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
}
?>


<?php 
if( !$detect->isMobile() && !$detect->isTablet() ){
    echo '
<footer>
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">';
        
        if (!$detect->isMobile() && !$detect->isTablet()) { include('subscribe.php'); }
    
        echo '</div>
        <div class="col-md-3 col-md-6">
          <h6>Links</h6>
          <ul>
          <li><a href="car-listing.php">About Us</a></li>
            <li><a href="contact-us.php">Contact us</a></li>
            <!-- <li><a href="page.php?type=privacy">Privacy</a></li> -->
            <li><a href="page.php?type=terms">Terms of use</a></li>
            <li><a href="admin/">Admin Login</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-push-6 text-right">
          <p class="copy-right">Copyright &copy; 2019 EZRent</a></p>
        </div>
        <div class="col-md-6 col-md-pull-6 ">
          <div class="footer_widget">
            <p>Follow us on:</p>
            <ul>
              <li><a href="https://facebok.com/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="https://twitter.com/"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
              <li><a href="https://instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

';


} 
  ?>
  
  <script>

    $("img").on("error", function () {
    $(this).attr("src", "../img/error.png");
});
</script>
  
  
  

