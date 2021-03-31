<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<?php

if(isset($_GET['delete_reviews'])){

$delete_id = $_GET['delete_reviews'];

$delete_review = "delete from reviews where id='$delete_id'";

$run_delete = mysqli_query($con,$delete_review);

if($run_delete){

echo "<script>alert('Review Deleted')</script>";

echo "<script>window.open('index.php?view_reviews','_self')</script>";


}


}



?>



<?php }  ?>