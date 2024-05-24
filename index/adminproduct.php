<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $category = $_POST['category'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $pdf_file = $_FILES['pdf_file']['name'];
   $pdf_file_size = $_FILES['pdf_file']['size'];
   $pdf_file_tmp_name = $_FILES['pdf_file']['tmp_name'];
   $pdf_file_folder = 'uploaded_pdfs/' . $pdf_file;
   $limited_pdf = $_FILES['limited_pdf']['name'];
   $limited_pdf_size = $_FILES['limited_pdf']['size'];
   $limited_pdf_tmp_name = $_FILES['limited_pdf']['tmp_name'];
   $limited_pdf_folder = 'uploaded_pdfs/' . $limited_pdf;

   

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'Book Name Already Added';
   }else{
         if($image_size > 2000000){
            $message[] = 'Image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Book Added Successfully!';
      }
   if (!empty($pdf_file)) {
      if ($pdf_file_size > 10000000) {
         $message[] = 'PDF file size is too large';
      } else {
         move_uploaded_file($pdf_file_tmp_name, $pdf_file_folder);
      }
   }

   if($limited_pdf_size > 10000000) {
      $message[] = 'Limited PDF file size is too large';
   } else {
      move_uploaded_file($limited_pdf_tmp_name, $limited_pdf_folder);
   }
   $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image, pdf_file,category,limited_pdf) VALUES('$name', '$price', '$image', '$pdf_file', '$category','$limited_pdf')") or die('query failed');
   if(!$add_product_query){
      $message[] = 'Book Could Not Be Added!';
   }
} 
}


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   $delete_file_query = mysqli_query($conn, "SELECT pdf_file FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_file = mysqli_fetch_assoc($delete_file_query);
   $delete_limited_pdf_query = mysqli_query($conn, "SELECT limited_pdf FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_limited_pdf = mysqli_fetch_assoc($delete_limited_pdf_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   unlink('uploaded_pdfs/'.$fetch_delete_image['pdf_file']);
   unlink('uploaded_pdfs/'.$fetch_delete_limited_pdf['limited_pdf']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $update_category = $_POST['update_category'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', category = '$update_category' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = isset($_POST['update_old_image']) ? $_POST['update_old_image'] : '';

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         if(file_exists('uploaded_img/'.$update_old_image)){
            unlink('uploaded_img/'.$update_old_image);
         }
      }
   }
   $update_pdf = $_FILES['update_pdf']['name'];
   $update_pdf_tmp_name = $_FILES['update_pdf']['tmp_name'];
   $update_pdf_folder = 'uploaded_pdfs/'.$update_pdf;
   $update_old_pdf = isset($_POST['update_old_pdf']) ? $_POST['update_old_pdf'] : '';

   if(!empty($update_pdf)){
      mysqli_query($conn, "UPDATE `products` SET pdf_file = '$update_pdf' WHERE id = '$update_p_id'") or die('query failed');
      move_uploaded_file($update_pdf_tmp_name, $update_pdf_folder);
      if(file_exists('uploaded_pdfs/'.$update_old_pdf)){
         unlink('uploaded_pdfs/'.$update_old_pdf);
      }
   }

   $update_L_pdf = $_FILES['update_pdf_2']['name'];
   $update_L_pdf_tmp_name = $_FILES['update_pdf_2']['tmp_name'];
   $update_L_pdf_folder = 'uploaded_pdfs/'.$update_L_pdf;
   $update_old_L_pdf = isset($_POST['update_old_limited_pdf']) ? $_POST['update_old_limited_pdf'] : '';

   if(!empty($update_L_pdf)){
      mysqli_query($conn, "UPDATE `products` SET limited_pdf = '$update_L_pdf' WHERE id = '$update_p_id'") or die('query failed');
      move_uploaded_file($update_L_pdf_tmp_name, $update_L_pdf_folder);
      if(file_exists('uploaded_pdfs/'.$update_old_L_pdf)){
         unlink('uploaded_pdfs/'.$update_old_L_pdf);
      }
   }
   header('location:admin_products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Books</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- Add product  -->

<section class="add-products">

   <h1 class="title">Shop Books</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add Book</h3>
      <label for="category">Select Category:</label>
      <select name="category" class="box" required>
      <option value="">Select...</option>
      <option value="Fantasy">Fantasy</option>
      <option value="Thriller">Thriller</option>
      <option value="Horror">Horror</option>
      <option value="Romance">Romance</option>
      <option value="Science-fiction">Science-fiction</option>
      </select>
      <input type="text" name="name" class="box" placeholder="Enter Book Name" required>
      <input type="number" min="0" name="price" class="box" placeholder="Enter Book Price" required>
      <label for="image">Choose image to upload:</label>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <label for="pdf_file">Choose file to upload</label>
      <input type="file" name="pdf_file" accept="application/pdf" class="box" required>
      <label for="pdf_file">Choose limited file to upload</label>
      <input type="file" name="limited_pdf" accept="application/pdf" class="box" required>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>


<!-- show products  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <div class="category"><?php echo $fetch_products['category']; ?></div>
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
         <a href="uploaded_pdfs/<?php echo $fetch_products['pdf_file']; ?>" target="_blank" class="pdf-btn">View PDF</a>
         <a href="uploaded_pdfs/<?php echo $fetch_products['limited_pdf']; ?>" target="_blank" class="pdf-btn" style="background:#e4007c">View Limt PDF</a>
         <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete This Product?');">Delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No Books Added Yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <label for="update_category">Select Category:</label>
      <select name="update_category" class="box" required>
         <option value="">Select...</option>
         <option value="Fantasy" <?php if($fetch_update['category'] == 'Fantasy') echo 'selected'; ?>>Fantasy</option>
         <option value="Thriller" <?php if($fetch_update['category'] == 'Thriller') echo 'selected'; ?>>Thriller</option>
         <option value="Horror" <?php if($fetch_update['category'] == 'Horror') echo 'selected'; ?>>Horror</option>
         <option value="Romance" <?php if($fetch_update['category'] == 'Romance') echo 'selected'; ?>>Romance</option>
         <option value="Science-fiction" <?php if($fetch_update['category'] == 'Science-fiction') echo 'selected'; ?>>Science-fiction</option>
      </select>
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter Book Name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Enter Book Price">
      <label for="image">Choose image to upload:</label>
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <label for="file" >Choose file to upload:</label>
      <input type="file" name="update_pdf" accept="application/pdf" class="box">
      <label for="file" >Choose limited file to upload:</label>
      <input type="file" name="update_pdf_2" accept="application/pdf" class="box">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>