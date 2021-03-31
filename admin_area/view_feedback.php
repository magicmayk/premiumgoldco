<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>




<div class="row" ><!-- 1 row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts --> 

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li class="active">

<i class="fa fa-dashboard" ></i> Dashboard / View Feedbacks

</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends --> 

</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> View Feedbacks

</h3>

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<?php

$get_feedback = "select * from store";

$run_feedback = mysqli_query($con,$get_feedback);

while($row_feedback = mysqli_fetch_array($run_feedback)){

$feedback_id = $row_feedback['feedback_id'];

$feedback_title = $row_feedback['feedback_title'];

$feedback_image = $row_feedback['feedback_image'];

$feedback_desc = substr($row_feedback['feedback_desc'],0,400);

$feedback_button = $row_feedback['feedback_button'];

$feedback_url = $row_feedback['feedback_url'];


?>

<div class="col-lg-4 col-md-4"><!-- col-lg-4 col-md-4 Starts -->

<div class="panel panel-primary"><!-- panel panel-primary Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title" align="center">

<?php echo $feedback_title; ?>

</h3>

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<img src="feedback_images/<?php echo $feedback_image; ?>" class="img-responsive">

<br>

<p><?php echo $feedback_desc; ?></p>

</div><!-- panel-body Ends -->

<div class="panel-footer"><!-- panel-footer Starts -->

<a href="index.php?delete_feedback=<?php echo $feedback_id; ?>" class="pull-left">

<i class="fa fa-trash-o"></i> Delete

</a>

<a href="index.php?edit_feedback=<?php echo $feedback_id; ?>" class="pull-right">

<i class="fa fa-pencil"></i> Edit

</a>

<div class="clearfix"> </div>

</div><!-- panel-footer Ends -->

</div><!-- panel panel-primary Ends -->

</div><!-- col-lg-4 col-md-4 Ends -->

<?php } ?>

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->




<?php } ?>