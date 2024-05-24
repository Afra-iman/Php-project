<?php

include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = null;
}

if(isset($_POST['add_to_cart'])){

   if(!isset($user_id)){
      header('location:login.php');
      exit();
   }

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $book_format = $_POST['book_format']; 

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already Added to Cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image,book_format) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image','$book_format')") or die('query failed');
      $message[] = 'Product Added to Cart!';
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Page</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Search Page</h3>
   <p> <a href="home.php">Home</a> / Search </p>
</div>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search" placeholder="Search books..." class="box">
      <input type="submit" name="submit" value="search" class="btn">
   </form>
</section>

<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
   ?>
   <form action="" method="post" class="box">
      <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_product['name']; ?></div>
      <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
      <input type="number"  class="qty" name="product_quantity" min="1" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
      <div class="inputBox" style="font-size: 1.8rem; display: flex;justify-content: space-between;">
            <span style="margin-right: 10px;">Book Format </span>
            <div style="margin-right: 10px;">
               <input type="radio" id="ecopy" name="book_format" value="e-copy"  style="margin-right: 10px;" required>
               <label for="ecopy">E-Copy</label>
            </div>
            <div style="margin-right: 10px;">
               <input type="radio" id="hardcopy" name="book_format" value="hard-copy"   style="margin-right: 10px;" required>
               <label for="hardcopy">Hard Copy</label>
            </div>
         </div>
      <input type="submit" class="btn" value="add to cart" name="add_to_cart">
      <a href="uploaded_pdfs/<?php echo $fetch_product['limited_pdf']; ?>" target="_blank" class="btn" style= "background-color: blue;">Preview</a>
   </form>
   <?php
            }
         }else{
            echo '<p class="empty">No Result Found!</p>';
         }
      }else{
         echo '<p class="empty">Search Something!</p>';
      }
   ?>
   </div>
  

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>