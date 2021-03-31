<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<div class="row"><!-- 1 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<ol class="breadcrumb"><!-- breadcrumb Starts  --->

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Approve Reviews

</li>

</ol><!-- breadcrumb Ends  --->

</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->


<div class="row"><!-- 2 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

<i class="fa fa-money fa-fw"></i> View Reviews

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<div class="table-responsive"><!-- table-responsive Starts -->

<table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

<thead><!-- thead Starts -->

<tr>
<th>No.</th>
<th>Name:</th>
<th>Content:</th>
<th>Rating:</th>
<th>Submit Date:</th>


</tr>

</thead><!-- thead Ends -->


<tbody><!-- tbody Starts -->

<?php

$i = 0;

$get_reviews = "select * from reviews WHERE approved = '0'";

$run_reviews = mysqli_query($con,$get_reviews);

while ($row_reviews = mysqli_fetch_array($run_reviews)) {

$review_id = $row_reviews['id'];

$page_id = $row_reviews['page_id'];

$review_name = $row_reviews['name'];

$review_content = $row_reviews['content'];

$review_rating = $row_reviews['rating'];

$submit_date = $row_reviews['submit_date'];

$i++;

?>

<tr>

<td><?php echo $i; ?></td>


<td  ><?php echo $review_name; ?></td>

<td><?php echo $review_content; ?></td>

<td><?php echo $review_rating; ?></td>

<td><?php echo $submit_date; ?></td>

<td>

<a href="index.php?delete_reviews=<?php echo $review_id; ?>" >

<i class="fa fa-trash-o" ></i> Delete

</a>

</td>



<td>
<form method="POST" action="">
<input type="submit" name="approve" value="Approve" class="btn-primary form-control" >
</form>
</td>



</tr>

<?php } ?>

</tbody><!-- tbody Ends -->

</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->

<?php

if(isset($_POST['approve'])){

$update_reviews = "update reviews set approved='1' where id='$review_id'";

$run_reviews = mysqli_query($con,$update_reviews);

if($run_reviews){

echo "<script>alert('One Review has been Updated. ')</script>";

echo "<script>window.open('index.php?view_reviews','_self')</script>";

}

}


?>



<?php } ?>