

<?php

$db = mysqli_connect("localhost","root","","ecom_store");

/// IP address code starts /////
function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }
/// IP address code Ends /////


// items function Starts ///

function items(){

global $db;

$ip_add = getRealUserIp();

$get_items = "select * from cart where ip_add='$ip_add'";

$run_items = mysqli_query($db,$get_items);

$count_items = mysqli_num_rows($run_items);

echo $count_items;

}


// items function Ends ///

// total_price function Starts //

function total_price(){

global $db;

$ip_add = getRealUserIp();

$total = 0;

$select_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($db,$select_cart);

while($record=mysqli_fetch_array($run_cart)){

$pro_id = $record['p_id'];

$pro_qty = $record['qty'];


$sub_total = $record['p_price']*$pro_qty;

$total += $sub_total;






}

echo "$" . $total;



}



// total_price function Ends //

// getPro function Starts //

function getPro(){

global $db;

$get_products = "select * from products order by 1 DESC LIMIT 0,3";

$run_products = mysqli_query($db,$get_products);

while($row_products=mysqli_fetch_array($run_products)){

$pro_id = $row_products['product_id'];

$pro_title = $row_products['product_title'];

$pro_price = $row_products['product_price'];

$pro_img1 = $row_products['product_img1'];

$pro_label = $row_products['product_label'];

$manufacturer_id = $row_products['manufacturer_id'];

$get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

$run_manufacturer = mysqli_query($db,$get_manufacturer);

$row_manufacturer = mysqli_fetch_array($run_manufacturer);

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

<div class='col-lg-6 col-sm-6 single' >

<div class=' product-content height-constraint' >

<div class = 'product-overlay'></div>
<img src='admin_area/product_images/$pro_img1' class='img-responsive product-image' >

<div class='product-details fadeIn-top'>

<h3><a href='$pro_url' >$pro_title</a></h3>

<p> $product_price $product_psp_price </p>
</div>
</a>




</div>

</div>

";
  }

else {


  echo "

<div class='col-lg-6 col-sm-6 single' >

$product_label
<div class=' product-content height-constraint' >

<div class = 'product-overlay'></div>
<img src='admin_area/product_images/$pro_img1' class='img-responsive product-image' >

<div class='product-details fadeIn-top'>

<h3><a href='$pro_url' >$pro_title</a></h3>

<p> $product_price $product_psp_price </p>
</div>
</a>




</div>

</div>

";
  }

}

}

// getPro function Ends //


// getCat function Starts //



function getCat(){

  global $db;
   
  $get_categories = "select * from product_categories order by 1 DESC LIMIT 0,4";

  $run_categories = mysqli_query($db,$get_categories);



  for ($x = 1; $x <= 4; $x++) {
  $row_categories=mysqli_fetch_array($run_categories);
  
  $p_cat_id = $row_categories['p_cat_id'];
  
  $cat_title = $row_categories['p_cat_title'];
  
  $cat_img1 = $row_categories['p_cat_image'];
 
  $p_cat_url = $row_categories['p_cat_url'];

  $cat_title_image = $row_categories['p_cat_title_image'];
  

  echo "
  
  <div class='col-lg-6 col' >
  
  <div class='product contahover  img-fluid' >
  
  <a href='category-$x.php' >
  
  <img src='admin_area/other_images/$cat_img1' class='imagehover img-responsive' >
  <div class='middle'>
  <img src='admin_area/other_images/$cat_title_image'>
  </div>
  </a>
  
  
  </div>
  
  </div>

  ";
  
  
  }
  
  }



// getCat function Ends //


// getRev function Starts //

function getRev(){

  global $db;
  $get_feedback = "select * from store order by 1 ASC LIMIT 0,3";
  $run_feedback = mysqli_query($db,$get_feedback);
  while($row_feedback = mysqli_fetch_array($run_feedback)){

  $feedback_id = $row_feedback['feedback_id'];

  $feedback_title = $row_feedback['feedback_title'];

  $feedback_image = $row_feedback['feedback_image'];

  $feedback_desc = $row_feedback['feedback_desc'];

  $feedback_button = $row_feedback['feedback_button'];

  $feedback_url = $row_feedback['feedback_url'];

  echo " <div class='col-lg-4'>
  
  <img src='admin_area/feedback_images/$feedback_image' class='reviewHeight img-responsive'>
  
  <h2 align='center'> $feedback_title </h2>
  
  <p> $feedback_desc </p>
  
  <center>

  
  
  
  </div>";

}

}


// getRev function Ends //


/// getProducts Function Starts ///

function getProducts(){

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

$get_products = "select * from products  ".$sWhere;

$run_products = mysqli_query($db,$get_products);

while($row_products=mysqli_fetch_array($run_products)){

$pro_id = $row_products['product_id'];

$pro_title = $row_products['product_title'];

$pro_price = $row_products['product_price'];

$pro_img1 = $row_products['product_img1'];

$pro_label = $row_products['product_label'];

$manufacturer_id = $row_products['manufacturer_id'];

$get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

$run_manufacturer = mysqli_query($db,$get_manufacturer);

$row_manufacturer = mysqli_fetch_array($run_manufacturer);

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
/// getProducts function Code Ends ///

}

/// getProducts Function Ends ///


/// getPaginator Function Starts ///

function getPaginator(){

/// getPaginator Function Code Starts ///

$per_page = 6;

global $db;

$aWhere = array();

$aPath = '';

/// Manufacturers Code Starts ///

if(isset($_REQUEST['man'])&&is_array($_REQUEST['man'])){

foreach($_REQUEST['man'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'manufacturer_id='.(int)$sVal;

$aPath .= 'man[]='.(int)$sVal.'&';

}

}

}

/// Manufacturers Code Ends ///

/// Products Categories Code Starts ///

if(isset($_REQUEST['p_cat'])&&is_array($_REQUEST['p_cat'])){

foreach($_REQUEST['p_cat'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'p_cat_id='.(int)$sVal;

$aPath .= 'p_cat[]='.(int)$sVal.'&';

}

}

}

/// Products Categories Code Ends ///

/// Categories Code Starts ///

if(isset($_REQUEST['cat'])&&is_array($_REQUEST['cat'])){

foreach($_REQUEST['cat'] as $sKey=>$sVal){

if((int)$sVal!=0){

$aWhere[] = 'cat_id='.(int)$sVal;

$aPath .= 'cat[]='.(int)$sVal.'&';

}

}

}

/// Categories Code Ends ///

$sWhere = (count($aWhere)>0?' WHERE '.implode(' or ',$aWhere):'');

$query = "select * from products ".$sWhere;

$result = mysqli_query($db,$query);

$total_records = mysqli_num_rows($result);

$total_pages = ceil($total_records / $per_page);

echo "<li><a href='shop.php?page=1";

if(!empty($aPath)){ echo "&".$aPath; }

echo "' >".'First Page'."</a></li>";

for ($i=1; $i<=$total_pages; $i++){

echo "<li><a href='shop.php?page=".$i.(!empty($aPath)?'&'.$aPath:'')."' >".$i."</a></li>";

};

echo "<li><a href='shop.php?page=$total_pages";

if(!empty($aPath)){ echo "&".$aPath; }

echo "' >".'Last Page'."</a></li>";

/// getPaginator Function Code Ends ///

}

/// getPaginator Function Ends ///



  







































?>
