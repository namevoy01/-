<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link rel="stylesheet" href="assets/css/login1.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
         /* ปรับแต่งการแสดงผลของปุ่มแจ้งเตือน */
    .alert .btn-close {
   position: absolute;
   top: 0px;
   right: 10px;
   border: none;
   color: #fff;
   font-size: 18px;
   cursor: pointer;
   z-index: 1080; /* เพิ่ม z-index ให้สูงกว่า alert */
}

    .alert .btn-close:hover {
   color: #fff;
}

    .alert {
   background: linear-gradient(to right, #ff7e5f, #feb47b); /* สีไล่ */
   color: #fff;
   padding: 15px;
   border-radius: 400px;
   position: absolute; /* ทำให้ alert อยู่ติดกับตำแหน่งบนสุด */
   top: 0; /* ตำแหน่งที่ด้านบนสุดของหน้า */
   left: 50%; /* จัดให้อยู่กลางหน้า */
   transform: translateX(-50%); /* ทำให้ alert อยู่กลางโดยใช้การแปลงตำแหน่ง */
   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   width: 100%; /* กว้างเต็มหน้าจอ */
   max-width: 400px; /* จำกัดความกว้างของ alert */
   z-index: 1000; /* ค่า z-index สูงพอสำหรับ alert */
   margin-top: 30px; /* เพิ่มช่องว่างจากขอบบนของหน้าจอ */
}


         /* ฟอร์มล็อกอิน */
         .container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding-top: 20px;
         }

         .input-field {
            position: relative;
            margin-bottom: 20px;
         }

         .input-field input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
         }

         .input-field label {
            position: absolute;
            top: -10px;
            left: 10px;
            font-size: 19px;
            background-color: #fff;
            padding: 0 5px;
            color: #333;
         }

         .button button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
         }
      </style>
   </head>
   <body>
      <!-- แสดงข้อความแจ้งเตือนหากมี -->
      <?php if (!empty($_SESSION['message'])): ?>
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <!-- ปุ่มปิดของ alert -->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         <?php unset($_SESSION['message']); ?>
      <?php endif; ?>

      <div class="container">
         <header>Login</header>
         <form action="<?php echo $base_url . '/admin_login_form.php' ?>" method="post">
            <div class="input-field">
               <input type="text" name="username" class="form-control" required>
               <label>Username</label>
            </div>
            <div class="input-field">
               <input class="form-control" name="password" type="password" required>
               <span class="show"></span>
               <label>Password</label>
            </div>
            <div class="button">
               <div class="inner"></div>
               <button>LOGIN</button>
            </div>
         </form>
         <div class="auth"></div>
         <div class="signup">
            Not a member? <a href="<?php echo $base_url . '/admin_register.php'; ?>">Signup now</a>
         </div>
      </div>

      <!-- ตรวจสอบให้แน่ใจว่าได้รวมสคริปต์ JavaScript ของ Bootstrap -->
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   </body>
</html>
