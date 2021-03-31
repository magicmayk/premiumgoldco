<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

?>

<?php


$product_id = @$_GET['pro_id'];

$get_product = "select * from products where product_url='$product_id'";

$run_product = mysqli_query($con,$get_product);

$check_product = mysqli_num_rows($run_product);

if($check_product == 0){

echo "<script> window.open('index.php','_self') </script>";

}
else{



$row_product = mysqli_fetch_array($run_product);

$p_cat_id = $row_product['p_cat_id'];

$pro_id = $row_product['product_id'];

$pro_title = $row_product['product_title'];

$pro_price = $row_product['product_price'];

$pro_desc = $row_product['product_desc'];

$pro_img1 = $row_product['product_img1'];

$pro_img2 = $row_product['product_img2'];

$pro_img3 = $row_product['product_img3'];

$pro_label = $row_product['product_label'];

$pro_psp_price = $row_product['product_psp_price'];

$pro_features = $row_product['product_features'];

$pro_video = $row_product['product_video'];

$status = $row_product['status'];

$pro_url = $row_product['product_url'];

if($pro_label == ""){


}
else{

$product_label = "

<a class='label sale' href='#' style='color:black;'>

<div class='thelabel'>$pro_label</div>

<div class='label-background'> </div>

</a>

";

}

$get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";

$run_p_cat = mysqli_query($con,$get_p_cat);

$row_p_cat = mysqli_fetch_array($run_p_cat);

$p_cat_title = $row_p_cat['p_cat_title'];




?>

 
<br>
<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->

<div class="col-md-12"><!-- col-md-12 Starts -->

<div class="row" id="productMain"><!-- row Starts -->

<div class="col-sm-6"><!-- col-sm-6 Starts -->

<div id="mainImage"><!-- mainImage Starts -->

<div id="myCarousel" class="carousel slide" data-ride="carousel">

<ol class="carousel-indicators"><!-- carousel-indicators Starts -->

<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>
<li data-target="#myCarousel" data-slide-to="2"></li>

</ol><!-- carousel-indicators Ends -->

<!-- carousel-inner Starts -->
<div class="carousel-inner">

<div class="item active">
<center>
<img src="admin_area/product_images/<?php echo $pro_img1; ?>" class="img-responsive details_image">
</center>
</div>

<div class="item">
<center>
<img src="admin_area/product_images/<?php echo $pro_img2; ?>" class="img-responsive details_image">
</center>
</div>

<div class="item">
<center>
<img src="admin_area/product_images/<?php echo $pro_img3; ?>" class="img-responsive details_image">
</center>
</div>

</div>
<!-- carousel-inner Ends -->

<!-- left carousel-control Starts -->
<a href="#myCarousel" class="left carousel-control" data-slide="prev">

<span class="glyphicon glyphicon-chevron-left"> </span>

<span class="sr-only"> Previous </span>

</a>
<!-- left carousel-control Ends -->

<!-- right carousel-control Starts -->
<a class="right carousel-control" href="#myCarousel" data-slide="next">

<span class="glyphicon glyphicon-chevron-right"> </span>

<span class="sr-only"> Next </span>

</a>
<!-- right carousel-control Ends -->

</div>

</div><!-- mainImage Ends -->
<br>
<!--THUMBNAIL STARTS-->

<div class="row" ><!-- row Starts -->

<div class="col-xs-4" ><!-- col-xs-4 Starts -->

<a href="#" class="thumb " >

<img src="admin_area/product_images/<?php echo $pro_img1; ?>" class="img-responsive thumbs_image" >

</a>

</div><!-- col-xs-4 Ends -->

<div class="col-xs-4" ><!-- col-xs-4 Starts -->

<a href="#" class="thumb " >

<img src="admin_area/product_images/<?php echo $pro_img2; ?>" class="img-responsive thumbs_image" >

</a>

</div><!-- col-xs-4 Ends -->

<div class="col-xs-4" ><!-- col-xs-4 Starts -->

<a href="#" class="thumb " >

<img src="admin_area/product_images/<?php echo $pro_img3; ?>" class="img-responsive thumbs_image" >

</a>

</div><!-- col-xs-4 Ends -->


</div><!-- row Ends -->


<?php if (empty($product_label)){
      
      
  
      
}

else{

      echo $product_label;

}
      
      
      ?>

</div><!-- col-sm-6 Ends -->

<!--THUMBNAILS END-->

<div class="col-sm-6" ><!-- col-sm-6 Starts -->

<div class="details_container" ><!-- box Starts -->

<!-- product title-->
<div class="product_title">
 <h2><b><?php echo $pro_title; ?></h2></b>
</div>
<?php


if(isset($_POST['add_cart'])){

$ip_add = getRealUserIp();

$p_id = $pro_id;

$product_qty = $_POST['product_qty'];

$product_size = $_POST['product_size'];


$check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";

$run_check = mysqli_query($con,$check_product);

if(mysqli_num_rows($run_check)>0){

echo "<script>alert('This Product is already added in cart')</script>";

echo "<script>window.open('$pro_url','_self')</script>";

}
else {

$get_price = "select * from products where product_id='$p_id'";

$run_price = mysqli_query($con,$get_price);

$row_price = mysqli_fetch_array($run_price);

$pro_price = $row_price['product_price'];

$pro_psp_price = $row_price['product_psp_price'];

$pro_label = $row_price['product_label'];

if($pro_label == "Sale" or $pro_label == "Gift"){

$product_price = $pro_psp_price;

}
else{

$product_price = $pro_price;

}

$query = "insert into cart (p_id,ip_add,qty,p_price,size) values ('$p_id','$ip_add','$product_qty','$product_price','$product_size')";

$run_query = mysqli_query($db,$query);

echo "<script>window.open('$pro_url','_self')</script>";

}

}


?>

<form action="" method="post" class="form-horizontal" ><!-- form-horizontal Starts -->

<?php

if($status == "chains"){

?>

<div class="form-group"><!-- form-group Starts -->

<!--description of product-->
<div class="desc_wrapper">
<div class="desc_product">

<?php echo $pro_desc; ?>

</div>
</div>
<!-- end of description-->



<!-- start of materials -->
<div class="material_title">
 <b>Materials:</b>
</div>
<div class="feat_wrapper">

<div class="desc_product">

<?php echo $pro_features; ?>

</div>
</div>
<!--end of materials -->
<?php

if($pro_label == "Sale" or $pro_label == "Gift"){

echo "

<p class='pro_price'>
<b><del> PHP$pro_price </del></b>
<br>
Promo: <b>PHP$pro_psp_price</b>


</p>

";

}
else{

echo "

<p class='pro_price'>

 <b>PHP $pro_price</b>

</p>

";

}


?>
<br>

<!--start of order information-->
<div class="order_info_wrapper">
<label class="col-md-5 control-label" >Quantity </label>

<div class="col-md-7" ><!-- col-md-7 Starts -->

<select name="product_qty" class="form-control" >

<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>


</select>
</div> <!--order info wrapper end-->
</div><!-- col-md-7 Ends -->

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->
<div class="order_info_wrapper">
<label class="col-md-5 control-label" >Chain Length</label>

<div class="col-md-7" ><!-- col-md-7 Starts -->

<select name="product_size" class="form-control" required>

<option>18 inches</option>
<option>20 inches</option>
<option>24 inches</option>


</select>

</div><!-- col-md-7 Ends -->
</div> <!--order info wrapper ends-->

</div><!-- form-group Ends -->



<?php }else if($status== "rings"){ ?>


<div class="form-group"><!-- form-group Starts -->

<!--description of product-->
<div class="desc_wrapper">
<div class="desc_product">

<?php echo $pro_desc; ?>

</div>
</div>
<!-- end of description-->



<!-- start of materials -->
<div class="material_title">
 <b>Materials:</b>
</div>
<div class="feat_wrapper">

<div class="desc_product">

<?php echo $pro_features; ?>

</div>
</div>
<!--end of materials -->
<?php

if($pro_label == "Sale" or $pro_label == "Gift"){

echo "

<p class='pro_price'>
<b><del> PHP$pro_price </del></b>
<br>
Promo: <b>PHP$pro_psp_price</b>


</p>

";

}else{

echo "

<p class='pro_price'>

 <b>PHP $pro_price</b>

</p>

";

}

?>
<br>
<!--start of order information-->
<div class="order_info_wrapper">
<label class="col-md-5 control-label" >Quantity </label>

<div class="col-md-7" ><!-- col-md-7 Starts -->

<select name="product_qty" class="form-control" >

<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>


</select>
</div> <!--order info wrapper end-->
</div><!-- col-md-7 Ends -->

</div><!-- form-group Ends -->


<div class="form-group" ><!-- form-group Starts -->
<div class="order_info_wrapper">
<label class="col-md-5 control-label" >Ring Size</label>

<div class="col-md-7" ><!-- col-md-7 Starts -->

<select name="product_size" class="form-control" required>

<option>6 mm</option>
<option>7 mm</option>
<option>8 mm</option>
<option>9 mm</option>
<option>10 mm</option>


</select>

</div><!-- col-md-7 Ends -->
</div> <!--order info wrapper ends-->

</div><!-- form-group Ends -->


<?php }else{ ?>

      <div class="form-group"><!-- form-group Starts -->

<!--description of product-->
<div class="desc_wrapper">
<div class="desc_product">

<?php echo $pro_desc; ?>

</div>
</div>
<!-- end of description-->



<!-- start of materials -->
<div class="material_title">
 <b>Materials:</b>
</div>
<div class="feat_wrapper">

<div class="desc_product">

<?php echo $pro_features; ?>

</div>
</div>
<!--end of materials -->
<?php

if($pro_label == "Sale" or $pro_label == "Gift"){

echo "

<p class='pro_price'>
<b><del> PHP$pro_price </del></b>
<br>
Promo: <b>PHP$pro_psp_price</b>


</p>

";

}else{

echo "

<p class='pro_price'>

 <b>PHP $pro_price</b>

</p>

";

}

?>
<br>
<!--start of order information-->
<div class="order_info_wrapper">
<label class="col-md-5 control-label" >Quantity </label>

<div class="col-md-7" ><!-- col-md-7 Starts -->

<select name="product_qty" class="form-control" >

<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
<option>7</option>
<option>8</option>
<option>9</option>


</select>
</div> <!--order info wrapper end-->
</div><!-- col-md-7 Ends -->

</div><!-- form-group Ends -->


<?php } ?>

<br>

<p class="text-center buttons  " ><!-- text-center buttons Starts -->

<button class="btn btn-warning product_buttons" type="submit" name="add_cart">

<i class="fa fa-shopping-cart" ></i> Add to Cart

</button>
<br><br>

<button  class="button_link" type="submit" name="add_wishlist">

<i class="fa fa-heart" ></i> Add to Wishlist

</button>


<?php

if(isset($_POST['add_wishlist'])){

if(!isset($_SESSION['customer_email'])){

echo "<script>alert('You Must Login To Add Product In Wishlist')</script>";

echo "<script>window.open('checkout.php','_self')</script>";

}
else{

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$select_wishlist = "select * from wishlist where customer_id='$customer_id' AND product_id='$pro_id'";

$run_wishlist = mysqli_query($con,$select_wishlist);

$check_wishlist = mysqli_num_rows($run_wishlist);

if($check_wishlist == 1){

echo "<script>alert('This Product Has Been already Added In Wishlist')</script>";

echo "<script>window.open('$pro_url','_self')</script>";

}
else{

$insert_wishlist = "insert into wishlist (customer_id,product_id) values ('$customer_id','$pro_id')";

$run_wishlist = mysqli_query($con,$insert_wishlist);

if($run_wishlist){

echo "<script> alert('Product Has Inserted Into Wishlist') </script>";

echo "<script>window.open('$pro_url','_self')</script>";

}

}

}

}

?>

</p><!-- text-center buttons Ends -->

</form><!-- form-horizontal Ends -->

</div><!-- box Ends -->



</div><!-- col-sm-6 Ends -->


</div><!-- row Ends -->

<!--Customer reviews start-->

<?php

$get_product = "select * from products where product_url='$product_id'";

$run_product = mysqli_query($con,$get_product);

$row_product = mysqli_fetch_array($run_product);

$status = $row_product['status'];
?>



<div class="wrapper3">
            <h1>CUSTOMER REVIEWS</h1>
      </div>
		<div class="content home">
			<h2>Reviews</h2>
			<p>Check out the below reviews for our website.</p>

      <div class="reviews"></div>
            <script>
            const reviews_page_id = 1;
            fetch("reviews.php?page_id=" + reviews_page_id).then(response => response.text()).then(data => {
	      document.querySelector(".reviews").innerHTML = data;
	      document.querySelector(".reviews .write_review_btn").onclick = event => {
		event.preventDefault();
		document.querySelector(".reviews .write_review").style.display = 'block';     
		document.querySelector(".reviews .write_review input[name='name']").focus();
	      };
	      document.querySelector(".reviews .write_review form").onsubmit = event => {
		event.preventDefault();
		fetch("reviews.php?page_id=" + reviews_page_id, {
			method: 'POST',
			body: new FormData(document.querySelector(".reviews .write_review form"))
		}).then(response => response.text()).then(data => {
			document.querySelector(".reviews .write_review").innerHTML = data;
		});
	      };
            });
            
            </script>
           
	</div>

<!--Customer reviews end-->


<div class="wrapper5    ">
            <h1>YOU MAY ALSO LIKE</h1>
      </div>


<hr>

<div id="row row-same-height" class="row also-like-constraint"><!-- row same-height-row Starts -->


<?php

$get_products = "select * from products order by rand() LIMIT 0,4";

$run_products = mysqli_query($con,$get_products);

while($row_products = mysqli_fetch_array($run_products)) {

$pro_id = $row_products['product_id'];

$pro_title = $row_products['product_title'];

$pro_price = $row_products['product_price'];

$pro_img1 = $row_products['product_img1'];

$pro_label = $row_products['product_label'];


$pro_psp_price = $row_products['product_psp_price'];

$pro_url = $row_products['product_url'];


if($pro_label == "Sale" or $pro_label == "Gift"){

$product_price = "<del> $$pro_price </del>";

$product_psp_price = "| $$pro_psp_price";

}
else{

$product_psp_price = "";

$product_price = "$$pro_price";

}


if($pro_label == ""){


}
else{

$product_label = "

<a class='label sale' href='#' style='color:black;'>

<div class='thelabel'>$pro_label</div>

<div class='label-background'> </div>

</a>

";

}

if(empty($product_label)){
echo "

<div class='col-md-3 col-sm-6 center-responsive center-constraint ' >

<div class='product' >

<a href='$pro_url' >

<img src='admin_area/product_images/$pro_img1' class='img-responsive height-constraint' >

</a>

<div class='text' >

<h3><a href='$pro_url' >$pro_title</a></h3>

<p class='price-text' > $product_price $product_psp_price </p>

<p class='buttons' >

<a href='$pro_url' class='btn btn-default' >View details</a>

<a href='$pro_url' class='btn btn-warning'>

<i class='fa fa-shopping-cart'></i> Add to cart

</a>


</p>

</div>



</div>

</div>

";
}
else
{

      echo "

      <div class='col-md-3 col-sm-6 center-responsive center-constraint ' >
      
      <div class='product' >
      
      <a href='$pro_url' >
      
      <img src='admin_area/product_images/$pro_img1' class='img-responsive height-constraint' >
      
      </a>
      
      <div class='text' >
      
      <h3><a href='$pro_url' >$pro_title</a></h3>
      
      <p class='price-text' > $product_price $product_psp_price </p>
      
      <p class='buttons' >
      
      
      <a href='$pro_url' class='btn btn-warning'>
      
      <i class='fa fa-shopping-cart'></i> Add to cart
      
      </a>
      
      
      </p>
      
      </div>
      $product_label
      
      
      </div>
      
      </div>
      
      ";

}


}


?>

</div><!-- row same-height-row Ends -->

</div><!-- col-md-12 Ends -->


</div><!-- container Ends -->
</div><!-- content Ends -->


<br><br>
<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php } ?>
