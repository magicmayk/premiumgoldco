<?php

session_start();


include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

?>
  <!-- MAIN -->
  <main>
    <!-- HERO -->
    <div class="nero">
      <div class="nero__heading">
        <span class="nero__bold">shop NOW</span>
      </div>
      <p class="nero__text">
      </p>
    </div>
  </main>


<div id="content" ><!-- content Starts -->
<div class="container" ><!-- container Starts -->

<div class="col-md-12" ><!--- col-md-12 Starts -->



</div><!--- col-md-12 Ends -->

<div class="wrapper4">
<h1><p class="product-heading"><b>BRACELETS</b></p></h1>
</div>

<?php getCategory1() ?>

<?php function getCategory1(){

/// getProducts function Code Starts ///

global $db;

$aWhere = array();

/// Manufacturers Code Starts ///

if(isset($_REQUEST['man'])&&is_array($_REQUEST['man'])){

foreach($_REQUEST['man'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'manufacturer_id='.(int)$sVal;

}

}

}

/// Manufacturers Code Ends ///

/// Products Categories Code Starts ///

if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'p_cat_id='.(int)$sVal;

}

}

}

/// Products Categories Code Ends ///

/// Categories Code Starts ///

if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

foreach($_REQUEST['cat'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'cat_id='.(int)$sVal;

}

}

}

/// Categories Code Ends ///

$per_page=12;

if(isset($_GET['page'])){

$page = $_GET['page'];

}else {

$page=1;

}

$start_from = ($page-1) * $per_page ;

$sLimit = " order by 1 DESC LIMIT $start_from,$per_page";

$sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):'').$sLimit;

$get_products = "select * from products WHERE p_cat_id ='5' ".$sWhere;

$run_products = mysqli_query($db,$get_products);

while($row_products=mysqli_fetch_array($run_products)){

$pro_id = $row_products['product_id'];

$pro_title = $row_products['product_title'];

$pro_price = $row_products['product_price'];

$pro_img1 = $row_products['product_img1'];

$pro_label = $row_products['product_label'];


$pro_psp_price = $row_products['product_psp_price'];

$pro_url = $row_products['product_url'];


if($pro_label == "Sale" or $pro_label == "Gift"){

$product_price = "<del> PHP$pro_price </del>";

$product_psp_price = "| PHP$pro_psp_price";

}
else{

$product_psp_price = "";

$product_price = "PHP$pro_price";

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
  <div class='col-md-3 col-sm-4 center-responsive' >
  
  <div class='product product-shop' >
  
  <a href='$pro_url' >
  
  <img src='admin_area/product_images/$pro_img1' class='img-responsive-product-single' >
  
  </a>
  
  <div class='text' >
  
  <h3><a href='$pro_url' ><p class='shop-title-text'>$pro_title</a></p></h3>
  
  <p class='price-text' > $product_price $product_psp_price </p>
  
  </div>
  
  
  
  </div>
  
  </div>
  ";
  }
  else{
    echo "
    <div class='col-md-3 col-sm-4 center-responsive' >
    
    <div class='product product-shop' >
    
    <a href='$pro_url' >
    
    <img src='admin_area/product_images/$pro_img1' class='img-responsive-product-single' >
    
    </a>
    
    <div class='text' >
    
    <h3><a href='$pro_url' ><p class='shop-title-text'>$pro_title</a></p></h3>
    
    <p class='price-text' > $product_price $product_psp_price </p>
    
    </div>
    
    $product_label
    
    
    </div>
    
    </div>
    ";
  
  }

}
/// getCategory1 function Code Ends ///

} ?>


</div><!-- row Ends -->

<center><!-- center Starts -->

<ul class="pagination" ><!-- pagination Starts -->

<?php ?>

</ul><!-- pagination Ends -->

</center><!-- center Ends -->



</div><!-- col-md-9 Ends --->



</div><!--- wait Ends -->

</div><!-- container Ends -->
</div><!-- content Ends -->



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>


</script>

</body>

</html>
