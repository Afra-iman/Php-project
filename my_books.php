<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Our Shop</h3>
   <p> <a href="home.php">Home</a> / My Books</p>
</div>

<section class="products">

   <h1 class="title">My Collection</h1>

   <div class="box-container">

   <?php  
   $select_orders = mysqli_query($conn, "SELECT * FROM `book_ordered` WHERE user_id = '$user_id' AND payment_status = 'completed' AND book_format = 'e-copy'") or die('query failed');
   if(mysqli_num_rows($select_orders) > 0){
      while($fetch_order = mysqli_fetch_assoc($select_orders)){
         $book_name = $fetch_order['product_name'];
         $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE name = '$book_name'") or die('query failed');
         if($fetch_products = mysqli_fetch_assoc($select_product)){

?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <a href="uploaded_pdfs/<?php echo $fetch_products['pdf_file']; ?>" target="_blank" class="btn" style= "background-color: purple;">Read</a>
     </form>
      <?php
         }
      }
   }
      else{
         echo '<p class="empty">No Books Added Yet!</p>';
      }
      ?>
   </div>

</section>
<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>