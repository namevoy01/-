<?php
session_start();
include 'config.php';

// ตัวอย่าง message (ลบทิ้งใน production)
$_SESSION['message'] = $_SESSION['message'] ?? 'กรุณากรอกข้อมูลให้ถูกต้อง';
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Srinakharinwirot University Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body, html {
      height: 100%;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .left-side {
      flex: 1;
      background: url('assets/image/bg_login.png') no-repeat center center;
      background-size: cover;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      position: relative;
      padding: 40px;
    }

    .university-name {
      position: absolute;
      top: 30px;
      left: 40px;
      font-size: 28px;
      font-weight: bold;
      color: white;
      background: rgba(0,0,0,0.3);
      padding: 5px 15px;
      border-radius: 5px;
    }

    .left-side h1 {
      font-size: 72px;
      margin-bottom: 10px;
    }

    .underline {
      width: 80px;
      height: 6px;
      background-color: white;
      border-radius: 10px;
      margin: 10px 0 30px;
    }

    .left-side p {
      max-width: 500px;
      font-size: 20px;
      line-height: 1.6;
    }

    .right-side {
      flex: 1;
      background-color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
      position: relative;
    }

    .login-wrapper {
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .logo {
      width: 250px;
      margin: 0 auto 30px;
      display: block;
    }

    .right-side h2 {
      color: #00a0d1;
      font-size: 42px;
      margin-bottom: 30px;
    }

    .form-input {
      width: 100%;
      margin-bottom: 20px;
    }

    .form-input input {
      width: 100%;
      padding: 18px;
      border: none;
      background: #f7f7f7;
      border-left: 6px solid #00a0d1;
      font-size: 18px;
      outline: none;
    }

    .form-input input::placeholder {
      color: #bbb;
    }

    .signup-link {
      margin-bottom: 25px;
      color: #555;
      font-size: 18px;
    }

    .signup-link a {
      color: #00a0d1;
      text-decoration: none;
    }

    .signup-link a:hover {
      text-decoration: underline;
    }

    .login-btn {
      background-color: #18a5d1;
      color: white;
      padding: 18px 50px;
      border: none;
      border-radius: 30px;
      font-size: 20px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .login-btn:hover {
      background-color: #0d90bd;
    }

    /* ✅ Alert Styling */
    .alert {
      position: relative;
      padding: 14px 40px 14px 20px;
      background-color: #d0efff;
      color: #004b6d;
      border-left: 6px solid #00a0d1;
      border-radius: 10px;
      margin-bottom: 25px;
      font-size: 16px;
      text-align: left;
    }

    .alert .close-btn {
      position: absolute;
      top: 10px;
      right: 16px;
      background: none;
      border: none;
      font-size: 20px;
      cursor: pointer;
      color: #0077aa;
    }

    .alert .close-btn:hover {
      color: #003344;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .left-side,
      .right-side {
        flex: unset;
        height: auto;
      }

      .right-side {
        padding: 20px;
      }

      .logo {
        width: 200px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left-side">
      <div class="university-name">Srinakharinwirot University</div>
      <h1>WELCOME</h1>
      <div class="underline"></div>
      <p>
        Welcome to the Srinakharinwirot University Faculty of Education website. <br />
        This is our alumni system. Thank you for visiting!
      </p>
    </div>

    <div class="right-side">
      <div class="login-wrapper">

        <!-- ✅ Alert Message -->
        <?php if (!empty($_SESSION['message'])): ?>
          <div class="alert">
            <?php echo $_SESSION['message']; ?>
            <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
          </div>
          <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <img src="assets/image/logo.png" alt="University Logo" class="logo">
        <h2>Login Account</h2>

        <form action="<?php echo $base_url . '/login-form.php' ?>" method="post">
          <div class="form-input">
            <input type="text" name="username" placeholder="Username" required>
          </div>
          <div class="form-input">
            <input type="password" name="password" placeholder="Password" required>
          </div>
          <div class="signup-link">
            <a href="<?php echo $base_url . '/register.php'; ?>">ยังไม่มีบัญชี?</a>
          </div>
          <button class="login-btn" type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
