<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['signup'])){
    
  $type=$_POST['usertype'];
  $fname=$_POST['fullname'];
  $email=$_POST['emailid']; 
  $lat = 0;
  $lng = 0;

  if($type == "0") {
    $lat = $_POST['lender_lat'];
    $lng = $_POST['lender_lng'];
  }
  $password=md5($_POST['password']); 

  $sql="INSERT INTO  tblusers(UserType,FullName,EmailId,ContactNo,Password,LenderLat,LenderLng) VALUES(:type,:fname,:email,:mobile,:password, :lat, :lng)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':type',$type,PDO::PARAM_STR);
  $query->bindParam(':fname',$fname,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
  $query->bindParam(':password',$password,PDO::PARAM_STR);
  $query->bindParam(':lat',$lat,PDO::PARAM_STR);
  $query->bindParam(':lng',$lng,PDO::PARAM_STR);
  $query->execute();


    echo "<script>alert('Registration Success! You may now log in.');</script>";

}

?>


<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

function checkAvailabilityLender() {
  $("#loaderIcon").show();
  jQuery.ajax({
    url: "check_availability_lender.php",
    data:'fullname='+$("#fullname").val(),
    type: "POST",
    success:function(data){
      $("#lender-availability-status").html(data);
      $("#loaderIcon").hide();
    },
    error:function (){}
  });
}


</script>



<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}

    $(document).on('change', 'input[name="usertype"]:radio', function() {

        if ($(this).val() == "0") {
            $('#ocPhoto').show();
            $('#lender-availability-status').attr('style', 'font-size: 12px;');
        } else {
            $('#ocPhoto').hide();
            $('#lender-availability-status').hide();
        }
    });


</script>


<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" action="#" onSubmit="return valid();" enctype="multipart/form-data">
                  
                  <div class="form-group text-center my-3 mb-5">
                    <h6>Register As</h6>
                  </div>
                <div class="form-group text-center my-3">
                 <i class="fa fa-car"></i>&nbsp;Lender &nbsp;<input class="usertype-button" id="lender" value="0" type="radio" name="usertype"  required="required">
                 <span class="m-auto" style="margin-left:20px; margin-right:20px;">OR</span>
                 
                 <i class="fa fa-key"></i>&nbsp;Renter &nbsp; <input class="usertype-button" id="renter" value="1" type="radio" name="usertype"  required="required">
                </div>
                     
         
         <hr style="width:50%;">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" onBlur="checkAvailabilityLender()" placeholder="Full Name" id="fullname" required="required">
                  <span id="lender-availability-status" style="font-size:12px;"></span> 
                </div>
                      <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="11" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                </div>
                <div id="ocPhoto" class="form-group" style="display:none;">
                    <input type="text" id="lender-autocomplete-address" class="form-control" placeholder="Lender Address" require="required">
                    <div id="lenderMap"></div>
                    <input type="hidden" id="lender_lat" name="lender_lat">
                    <input type="hidden" id="lender_lng" name="lender_lng">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
       
                
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>