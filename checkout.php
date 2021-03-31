<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");


?>


  <!-- MAIN -->
<br><br>



<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->




<div class="col-md-12" ><!-- col-md-12 Starts -->

<?php


if(!isset($_SESSION['customer_email'])){

include("customer/customer_login.php");


}

else{

$c_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$c_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_confirm_code = $row_customer['customer_confirm_code'];

if(!empty($customer_confirm_code)){
  echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
}

else
{
include("payment_options.php");
}
}




?>


</div><!-- col-md-12 Ends -->


</div><!-- container Ends -->
</div><!-- content Ends -->



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
