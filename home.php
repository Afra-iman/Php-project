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
      $message[] = 'Already Added to cart!';
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
   <title>Home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Hand Picked Book to your door.</h3>
      <p>Welcome to our online bookstore, a heaven for book lovers! 
         We offer a vast selection of books across various genres, including fiction, non-fiction, fantasy, thriller, romance, and many more. 
         Our user-friendly interface makes it easy for you to browse through our collection, read previews, and make purchases. 
         We also provide e-books and hard copies, catering to your reading preferences. 
         Our mission is to promote the joy of reading by making it accessible and convenient for everyone. 
         Enjoy exploring our diverse collection and immerse yourself in the world of literature right from the comfort of your home. 
         Happy reading!</p>
      <a href="about.php" class="white-btn">Discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">Latest Books</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 8") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
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
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      <a href="uploaded_pdfs/<?php echo $fetch_products['limited_pdf']; ?>" target="_blank" class="btn" style= "background-color: blue;">Preview</a>
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">No Books Added Yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">Load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>About us</h3>
         <p>We are a dedicated online bookstore committed to fostering the love of reading. 
            Our team is passionate about literature and understands the power of books to inspire, educate, and transform lives. 
            We strive to make a wide range of books accessible to readers worldwide, regardless of their age, background, or interests.</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Have Any Questions?</h3>
      <p>We understand that you might have questions while browsing our online bookstore. 
         Whether it's about a specific book, our delivery process, payment methods, or just a general inquiry, we're here to help!
         Our team is dedicated to providing you with the best customer service and ensuring your experience with us is smooth and enjoyable. 
         We value your questions and feedback as they help us improve and serve you better.
         Don't hesitate to reach out. We're always ready to assist you with any queries or concerns you might have.</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>
<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>