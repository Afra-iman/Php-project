<?php

include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = null;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>About Us</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>Why Choose Us?</h3>
         <p><b>Diverse Selection:</b> We offer a vast collection of books across various genres, ensuring that there’s something for every reader.</p>
         <p><b>Quality Service:</b> Our user-friendly platform makes it easy to browse, select, and purchase books. We’re committed to providing a seamless shopping experience.</p>
         <p><b>Affordability:</b> We believe that everyone should have access to books, so we strive to keep our prices competitive.</p>
         <p><b>Convenience:</b> With just a few clicks, you can have your favorite books delivered right to your doorstep or device.</p>
         <p><b>Customer Support:</b> Our dedicated customer service team is always ready to assist you with any queries or issues.</p>
         <p><b>Passion for Reading:</b> As avid readers ourselves, we understand what book lovers want and need. We’re constantly updating our collection based on trends, popular demand, and timeless classics.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">Client's Reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>"The well-curated & Incredible finds await at this bookstore! From classics to contemporary reads, 
            there's something for everyone"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>John doe</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>“The variety of books available in both e-copy and hardcopy is impressive. 
            I found some rare editions I've been looking for. Five stars!”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Linda Moore</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>“I love that I can get an e-copy of a book instantly and don't have to wait for shipping. 
            But when I want a physical book, their shipping is fast!”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jane Smith</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>“Great selection and fast delivery for hardcopies. 
            The e-copy feature is a lifesaver for last-minute book club reads.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Maria Rodriguez</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>“The hardcopy books arrived in perfect condition and the e-copies downloaded instantly. Couldn't ask for more.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Robert</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>“As an avid reader, I appreciate the flexibility this webpage offers. 
            The hardcopies are great for my home library and the e-copies for travel.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jennifer Davis</h3>
      </div>

      <div class="box">
         <img src="images/pic-7.jpg" alt="">
         <p>“Excellent webpage for any book lover. 
            The wide range of genres and formats ensures there's something for everyone.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>William Taylor</h3>
      </div>

      <div class="box">
         <img src="images/pic-8.jpg" alt="">
         <p>“I'm new to e-books, but this webpage made the transition easy.
             I still buy hardcopies of my favorites for keepsakes.”</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Michael Wilson</h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">Greate Authors</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>David Dawn</h3>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Collen Hoover</h3>
      </div>

      <div class="box">
         <img src="images/author-3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Floyde Leong</h3>
      </div>

      <div class="box">
         <img src="images/author-4.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Ann Sepino</h3>
      </div>

      <div class="box">
         <img src="images/author-5.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Ben</h3>
      </div>

      <!-- <div class="box">
         <img src="images/author-6.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Stephny</h3>
      </div> -->

   </div>

</section>
<?php include 'footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>