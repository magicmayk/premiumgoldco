<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<script src="https://cdn.tiny.cloud/1/3t0kkagjt5frf45slydtbeojv5gynrgik4aet76ymo4gbugi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({ selector:'textarea' });</script>
  
<?php

if(isset($_GET['edit_feedback'])){

$edit_id = $_GET['edit_feedback'];

$get_feedback = "select * from store where feedback _id='$edit_id'";

$run_feedback = mysqli_query($con,$get_feedback);

$row_feedback = mysqli_fetch_array($run_feedback);

$feedback_id = $row_feedback['feedback_id'];

$feedback_title = $row_feedback['feedback_title'];

$feedback_image = $row_feedback['feedback_image'];

$feedback_desc = $row_feedback['feedback_desc'];

$feedback_button = $row_feedback['feedback_button'];

$feedback_url = $row_feedback['feedback_url'];

$new_s_image = $row_feedback['feedback_image'];


}

?>  

<div class="row" ><!-- 1 row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts --> 

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li class="active">

<i class="fa fa-dashboard" ></i> Dashboard / Edit Feedback

</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends --> 

</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Edit Feedback

</h3>

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Title : </label>

<div class="col-md-6">

<input type="text" name="feedback_title" class="form-control" value="<?php echo $feedback_title; ?>">

</div>

</div><!-- form-group Ends -->



<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Image : </label>

<div class="col-md-6">

<input type="file" name="feedback_image" class="form-control">

<br>

<img src="feedback_images/<?php echo $feedback_image; ?>" width="70" height="70" >

</div>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Description : </label>

<div class="col-md-6">

<textarea name="feedback_desc" class="form-control" rows="10" cols="19">

<?php echo $feedback_desc; ?>

</textarea>

</div>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Button : </label>

<div class="col-md-6">

<input type="text" name="feedback_button" class="form-control" value="<?php echo $feedback_button; ?>">

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Feedback Url : </label>

<div class="col-md-6">

<input type="url" name="feedback_url" class="form-control" value="<?php echo $feedback_url; ?>">

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="update" value="Update Feedback" class="btn btn-primary form-control">

</div>

</div><!-- form-group Ends -->


</form><!-- form-horizontal Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->

<?php

if(isset($_POST['update'])){

$feedback_title = $_POST['feedback_title'];

$feedback_desc = $_POST['feedback_desc'];

$feedback_button = $_POST['feedback_button'];

$feedback_url = $_POST['feedback_url'];

$feedback_image = $_FILES['feedback_image']['name'];

$tmp_image = $_FILES['feedback_image']['tmp_name'];

if(empty($feedback_image)){

$feedback_image = $new_s_image;

}

move_uploaded_file($tmp_image,"feedback_images/$feedback_image");

$update_feedback = "update store set feedback_title='$feedback_title',feedback_image='$feedback_image',feedback_desc='$feedback_desc',feedback_button='$feedback_button',feedback_url='$feedback_url' where feedback_id='$feedback_id'";

$run_feedback = mysqli_query($con,$update_feedback);

if($run_feedback){

echo "<script>alert('One Feedback Column Has Been Updated')</script>";

echo "<script>window.open('index.php?view_feedback','_self')</script>";

}

}

?>

<?php } ?>