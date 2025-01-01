<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'email pengguna sudah terdaftar!';
   }else{
      if($pass != $cpass){
         $message[] = 'konfirmasi kata sandi tidak sesuai!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)");
         $insert->execute([$name, $email, $pass, $image]);

         if($insert){
            if($image_size > 2000000){
               $message[] = 'ukuran gambar terlalu besar!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'pendaftaran berhasil!';
               header('location:login.php');
            }
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dafar</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

   <style>
      body{
        background-image: url('warung2.jpeg');}
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

<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
   
<section class="form-container">

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>Daftar</h3>
      <input type="text" name="name" class="box" placeholder="masukan nama" required>
      <input type="email" name="email" class="box" placeholder="masukan email" required>
      <input type="password" name="pass" class="box" placeholder="masukan kata sandi" required>
      <input type="password" name="cpass" class="box" placeholder="konfirmasi kata sandi" required>
      <input type="submit" value="Daftar!" class="btn" name="submit">
      <p>Sudah punya akun?<a href="login.php">Masuk!</a></p>
   </form>

</section>


</body>
</html>