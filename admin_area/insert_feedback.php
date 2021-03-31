<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<script src="https://cdn.tiny.cloud/1/3t0kkagjt5frf45slydtbeojv5gynrgik4aet76ymo4gbugi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

<div class="row" ><!-- 1 row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts --> 

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li class="active">

<i class="fa fa-dashboard" ></i> Dashboard / Insert Feedback
</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends --> 

</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Insert Feedback

</h3>

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Title : </label>

<div class="col-md-6">

<input type="text" name="feedback_title" class="form-control">

</div>

</div><!-- form-group Ends -->



<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Image : </label>

<div class="col-md-6">

<input type="file" name="feedback_image" class="form-control">

</div>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Description : </label>

<div class="col-md-6">

<textarea name="feedback_desc" class="form-control" rows="10" cols="19">



</textarea>

</div>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Button : </label>

<div class="col-md-6">

<input type="text" name="feedback_button" class="form-control">

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Url : </label>

<div class="col-md-6">

<input type="url" name="feedback_url" class="form-control">

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="submit" value="Insert Feedback" class="btn btn-primary form-control">

</div>

</div><!-- form-group Ends -->


</form><!-- form-horizontal Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->

<?php

if(isset($_POST['submit'])){

$feedback_title = $_POST['feedback_title'];

$feedback_desc = $_POST['feedback_desc'];

$feedback_button = $_POST['feedback_button'];

$feedback_url = $_POST['feedback_url'];

$feedback_image = $_FILES['feedback_image']['name'];

$tmp_image = $_FILES['feedback_image']['tmp_name'];

$sel_feedback = "select * from store";

$run_feedback = mysqli_query($con,$sel_feedback);

$count = mysqli_num_rows($run_feedback);

if($count == 4){

echo "<script>alert('You Have already Inserted 4 feedback columns')</script>";

}
else{

move_uploaded_file($tmp_image,"feedback_images/$feedback_image");

$insert_feedback = "insert into store (feedback_title,feedback_image,feedback_desc,feedback_button,feedback_url) values ('$feedback_title','$feedback_image','$feedback_desc','$feedback_button','$feedback_url')";

$run_feedback = mysqli_query($con,$insert_feedback);

if($run_feedback){

echo "<script>alert('New Feedback Column Has Been Inserted')</script>";

echo "<script>window.open('index.php?view_feedback','_self')</script>";

}

}

}

?>

<?php } ?>