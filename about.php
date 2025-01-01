<?php

@include 'config.php';

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
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/produk2nobg.png" alt="">
         <h3>Mengapa Memilih Kami ?</h3>
         <p>Kami menawarkan berbagai produk makanan,minuman, sembako, rokok . Dengan harga yang terjangkau 
             dan pilihan yang beragam, kami berkomitmen untuk memenuhi kebutuhan sehari-hari Anda dengan kualitas yang handal. 
             Toko Klentong kami adalah tempat yang nyaman dan bersahaja untuk berbelanja, 
             memberikan Anda kemudahan dalam mencari semua yang Anda butuhkan dalam satu tempat.</p>
         
      </div>

      <div class="box">
         <img src="images/gambarnobg.png" alt="">
         <h3>Apa yang Kami Sediakan ?</h3>
         <p>Menyediakan berbagai macam kebutuhan pokok yang dapat memudahkan hidup Anda. Dari sembako, snack, minuman, rokok. Menjual barang-barang yang mungkin tidak pernah Anda pikirkan, tetapi bisa menjadi tambahan yang berharga dalam rutinitas harian Anda. Jadi, jangan ragu untuk menjelajahi rak-rak kami yang penuh kejutan, karena Anda tidak pernah tahu apa yang mungkin Anda temukan di Warung Mak WiiD !</p>
         <a href="shop.php" class="btn">Warung kami</a>
      </div>

   </div>

</section>

<!--<section class="reviews">

   <h1 class="title">Review Pembeli</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

   </div>

</section> -->









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>