<?php
session_start();
include 'config.php';

if(empty($_SESSION[WP . 'checklogin'])) {
    $_SESSION['message'] = 'You are not authorized';
    header("location:{$base_url}/login.php");
    exit();
}

// ดึงข้อมูลจากฐานข้อมูล
$user_id = $_SESSION[WP . 'st_ID'];
$query = mysqli_query($conn, "SELECT * FROM student WHERE st_ID='{$user_id}'");
$user = mysqli_fetch_assoc($query);

// ดึงชื่อไฟล์ภาพจากฐานข้อมูล
$image_name = $user['st_pic'];
$image_path = 'uploaded_image/' . $image_name;  
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ข้อมูลศิษย์เก่า | ระบบศิษย์เก่า</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Kanit', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #f5f9fc;
      max-width: 100%;
      overflow-x: hidden;
    }

    /* ส่วนหัว */
    .top-bar {
      background: url('assets/image/bg_header.png') no-repeat center center;
      background-size: cover;
      color: white;
      padding: 30px 50px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .logo img {
      height: 140px;
    }

    /* ส่วนหัวเรื่อง */
    .header-title {
      flex: 1;
      text-align: center;
      margin-top: 10px;
    }

    .header-title h1 {
      font-size: 36px;
      color: white;
      font-weight: bold;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.4);
      margin: 0;
    }

    /* เมนูคำสั่ง */
    .menu-bar {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      margin-top: 30px; /* เพิ่มระยะห่างจาก header */
    }

    .menu-bar a {
      padding: 14px 24px;
      background-color: white;
      color: #004488;
      text-decoration: none;
      font-size: 18px;
      border-radius: 16px;
      transition: background 0.3s;
    }

    .menu-bar a:hover {
      background-color: #e6f2ff;
    }

    /* ปรับการจัดระยะห่างของปุ่ม Logout */
    .logout {
    display: flex;
    align-items: center;
    margin-left: auto;  /* ทำให้ปุ่ม logout อยู่ทางขวาสุด */
    margin-top: 20px;  /* เพิ่มระยะห่างจากเมนูคำสั่ง */
    }

    /* ปรับขนาดรูปภาพในปุ่ม Logout */
    .logout a img {
    width: 20px;   /* กำหนดความกว้างของรูปภาพ */
    height: 20px;  /* กำหนดความสูงของรูปภาพ */
    margin-right: 10px; /* ระยะห่างระหว่างรูปและข้อความ */
    }

    /* ปรับการจัดระยะห่างของเมนูคำสั่ง */
    .menu-bar {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 30px; /* เพิ่มระยะห่างจาก header */
    }

    /* หากต้องการเพิ่มระยะห่างระหว่างปุ่ม Logout กับเมนูคำสั่ง */
    .logout a {
    padding: 14px 24px;
    background-color: #004488;
    color: white;
    text-decoration: none;
    border-radius: 16px;
    transition: background 0.3s;
    font-size: 20px;
    display: flex;
    align-items: center;
    margin-left: 30px;  /* เพิ่มระยะห่างระหว่างปุ่ม logout และเมนู */
    }

    /* ข่าวสารประชาสัมพันธ์ */
    .news-section {
      display: flex;
      justify-content: space-between;
      margin: 40px 50px;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .news-text {
      flex: 1;
      padding: 20px;
    }

    .news-text h2 {
      font-size: 32px; /* ขนาดตัวหนังสือใหญ่ */
      margin: 0;
      padding-bottom: 10px;
      border-bottom: 3px solid #004488; /* ขีดเส้นสีฟ้า */
    }

    .news-text p {
      font-size: 16px;
      line-height: 1.6;
    }

    .news-box {
      flex: 1;
      background-color: #A3C9FF; /* สีฟ้าอ่อน */
      border-radius: 15px;
      display: flex;
      justify-content: space-between;
      padding: 20px;
    }

    .news-box .left {
      flex: 1;
      padding: 10px;
      color: white;
      background-color: #004488;
      border-radius: 15px;
      margin-right: 20px;
    }

    .news-box .right {
      flex: 1;
      background-color: #CCE0FF; /* สีฟ้าอ่อนสำหรับพื้นหลังของรูป */
      border-radius: 15px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .news-box img {
      max-width: 100%;
      max-height: 100%;
      border-radius: 15px;
    }

    @media (max-width: 768px) {
      .news-section {
        flex-direction: column;
        margin: 20px;
      }

      .news-box {
        flex-direction: column;
      }

      .news-box .left {
        margin-right: 0;
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>

  <!-- ส่วนหัว -->
  <div class="top-bar">
    <div class="logo">
      <img src="assets/image/logo.png" alt="โลโก้คณะ">
    </div>

    <!-- หัวเรื่อง -->
    <div class="header-title">
      <h1>Alumni ระบบจัดการข้อมูลศิษย์เก่า</h1>
    </div>

    <div class="menu-bar">
      <a href="index2.php">ข่าวสาร</a>
      <a href="scholarship_index2.php">ทุน</a>
      <a href="Award_index2.php">รางวัล</a>
      <a href="#">บุคลากร/เจ้าหน้าที่</a>
      <a href="profile.php">โปรไฟล์</a>
    </div>

    <div class="logout">
      <a href="logout.php"><img src="assets/image/emoji_profile.png" alt="Logout">Logout</a>
    </div>
  </div>
  </div>

  <!-- ข่าวสารประชาสัมพันธ์ -->
  <div class="news-section">
    <div class="news-text">
      <h2>ข่าวสารประชาสัมพันธ์</h2>
      <p>
        สวัสดีครับทุกท่าน! ขอต้อนรับเข้าสู่ระบบศิษย์เก่าของคณะเรา ในที่นี้คุณจะได้ทราบข่าวสารเกี่ยวกับกิจกรรมล่าสุด ทุนการศึกษา และโอกาสการทำงานที่เปิดให้กับศิษย์เก่า หากคุณมีข้อสงสัยสามารถติดต่อสอบถามได้ทุกเมื่อ
      </p>
    </div>
    <div class="news-box">
      <div class="left">
        <p>ข้อความที่ต้องการแสดงบนพื้นที่นี้ เช่น การประกาศข่าวสารต่างๆ เพิ่มเติม หรือข้อมูลที่สำคัญเกี่ยวกับศิษย์เก่า</p>
      </div>
      <div class="right">
        <img src="https://www.example.com/path/to/image.jpg" alt="ภาพข่าวสาร">
      </div>
    </div>
  </div>

</body>
</html>
