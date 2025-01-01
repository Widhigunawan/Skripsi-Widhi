<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ?  AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $method, $address, $total_products, $cart_total]);

   if ($cart_total == 0) {
      $message[] = 'belanjaanmu kosong';
   } elseif ($order_query->rowCount() > 0) {
      $message[] = 'belanjanan sudah ada!';
   } else {
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $method, $address, $total_products, $cart_total, $placed_on]);

      if (strtolower($method) === 'dana') {
         // Jika metode pembayaran adalah DANA, arahkan ke halaman dengan QR Code
         header('location: qr_code_page.php');
         exit();
      }

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'order placed successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<style>
    .btn {
            background-color: brown; /* Ganti warna background sesuai keinginan Anda */
            color: white; /* Ganti warna teks sesuai keinginan Anda */
            padding: 10px 20px; /* Menyesuaikan padding agar tombol terlihat lebih baik */
            border: none; /* Menghapus border pada tombol */
            cursor: pointer; /* Menampilkan kursor tangan saat mengarahkan ke tombol */
            font-size: 16px; /* Menyesuaikan ukuran font teks */
        }
</style>
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
   <p> <?= $fetch_cart_items['name']; ?> <span>(<?= 'Rp'.$fetch_cart_items['price'].' x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">belanjaanmu kosong!</p>';
   }
   ?>
   <div class="grand-total">total belanja : <span>Rp<?= $cart_grand_total; ?></span></div>
</section>

<section class="checkout-orders">

   <form action="" method="POST">

      <h3>PESANAN</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Nama :</span>
            <input type="text" name="name" placeholder="" class="box" required>
         </div>
         <div class="inputBox">
            <span>Nomor HP :</span>
            <input type="number" name="number" placeholder="" class="box" required>
         </div>
    
         <div class="inputBox">
            <span>Metode Pembayaran :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               <option value="dana">Dana</option>
            </select>
         </div>
         <div class="inputBox">
            <span>alamat :</span>
            <input type="text" name="flat" placeholder=""class="box" required>
         </div>
      
         
      </div>

      <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="Buat Pesanan">

   </form>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>