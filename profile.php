<?php
session_start();
include 'config.php';

if(empty($_SESSION[WP . 'checklogin'])) {
    $_SESSION['message'] = 'You are not authorized';
    header("location:{$base_url}/login.php");
    exit();
}

// ดึงข้อมูลจากฐานข้อมูล พร้อมกับข้อมูลเพศ
$user_id = $_SESSION[WP . 'st_ID'];
$query = mysqli_query($conn, "SELECT s.*, g.gen_name 
                              FROM student s
                              LEFT JOIN gender_type g ON s.gen_id = g.gen_id
                              WHERE s.st_ID='{$user_id}'");
$user = mysqli_fetch_assoc($query);

// ดึงชื่อไฟล์ภาพจากฐานข้อมูล
$image_name = $user['st_pic'];
$image_path = 'uploaded_image/' . $image_name;  

// ตรวจสอบว่ามีไฟล์ภาพหรือไม่
if(empty($image_name) || !file_exists($image_path)) {
    $image_path = 'assets/image/default_avatar.png'; // ใช้ภาพเริ่มต้น
}
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

    /* ส่วนเนื้อหา */
    main {
      padding: 60px;
      font-size: 20px;
    }

    .container {
      display: flex;
      gap: 50px;
      max-width: 1400px;
      margin: 0 auto;
    }

    .left-panel, .right-panel {
      background: white;
      border-radius: 25px;
      padding: 40px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .left-panel {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      text-align: center;
    }

    .left-panel img {
      width: 320px;
      height: 320px;
      border-radius: 50%;
      margin-bottom: 30px;
      object-fit: cover;
      background-color: #eee;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    .edit-button {
      margin-top: 30px;
      padding: 15px 35px;
      border: none;
      border-radius: 25px;
      background-color: #00a0d1;
      color: white;
      font-size: 20px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s;
    }

    .edit-button:hover {
      background-color: #0088b3;
    }

    .right-panel {
      flex: 2;
    }

    .right-panel h2 {
      color: #00a0d1;
      font-size: 28px;
      margin-bottom: 30px;
      border-bottom: 4px solid #00a0d1;
      display: inline-block;
      padding-bottom: 10px;
    }

    .info-group {
      display: grid;
      grid-template-columns: 260px 1fr;
      row-gap: 20px;
      column-gap: 30px;
      font-size: 20px;
    }

    .info-group .label {
      font-weight: bold;
    }

    .address-box {
      grid-column: 2 / 3;
      background-color: #f5f8fc;
      padding: 20px;
      border-radius: 12px;
      min-height: 100px;
      font-size: 20px;
    }

    .student-id {
      font-size: 28px;
      font-weight: bold;
      color: #004488;
      margin-top: 20px;
    }

    /* รองรับขนาดหน้าจอเล็ก */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .info-group {
        grid-template-columns: 1fr;
      }

      .address-box {
        grid-column: auto;
      }

      .left-panel img {
        width: 220px;
        height: 220px;
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
      <h1>Alumni ระบบศิษย์เก่า</h1>
    </div>

    <div class="menu-bar">
      <a href="#">ข่าวสาร</a>
      <a href="#">ทุน</a>
      <a href="#">รางวัล</a>
      <a href="profile.php">โปรไฟล์</a>
    </div>

    <div class="logout">
      <a href="logout.php"><img src="assets/image/emoji_profile.png" alt="Logout">Logout</a>
    </div>
  </div>

  <!-- เนื้อหา -->
  <main>
    <h1 style="font-size: 36px; margin-bottom: 40px;">
      ข้อมูลของศิษย์เก่า
    </h1>

    <div class="container">
      <div class="left-panel">
        <div>
            <img src="<?php echo $image_path; ?>" alt="รูปโปรไฟล์" class="img-fluid rounded-circle">
        </div>
        <h5 class="student-id"><?php echo $user['st_IDcard']; ?></h5>
        <a href="profile_from.php" class="edit-button">แก้ไขข้อมูลส่วนตัว</a>
      </div>

      <div class="right-panel">
        <h2>ข้อมูลส่วนตัว</h2>
        <div class="info-group">
          <div class="label">ชื่อ - นามสกุล TH</div><div><?php echo $user['st_name_th'] ? $user['st_name_th'] : '-'; ?></div> 
          <div class="label">ชื่อ - นามสกุล EN</div><div><?php echo $user['st_name_en'] ? $user['st_name_en'] : '-'; ?></div>
          <div class="label">ชื่อเล่น</div><div><?php echo $user['st_nickname'] ? $user['st_nickname'] : '-'; ?></div>
          <div class="label">เลขประจำตัวนักศึกษา</div><div><?php echo $user['st_IDcard'] ? $user['st_IDcard'] : '-'; ?></div>
          <div class="label">เพศ</div><div><?php echo $user['gen_name'] ? $user['gen_name'] : '-'; ?></div>
          <div class="label">วัน/เดือน/ปีเกิด</div><div><?php echo $user['st_brith'] ? $user['st_brith'] : '-'; ?></div>
          <div class="label">ที่อยู่ปัจจุบัน</div><div class="address-box"><?php echo $user['st_address'] ? $user['st_address'] : '-'; ?></div>
          <div class="label">Email</div><div><?php echo $user['st_Email'] ? $user['st_Email'] : '-'; ?></div>
          <div class="label">เบอร์โทรศัพท์</div><div><?php echo $user['st_phone'] ? $user['st_phone'] : '-'; ?></div>
          <div class="label">บัญชีโซเชียลมีเดีย</div><div><?php echo $user['st_social_media'] ? $user['st_social_media'] : '-'; ?></div>
          <div class="label">ปีที่เข้าเรียน</div><div><?php echo $user['st_year_in'] ? $user['st_year_in'] : '2018'; ?></div>
        </div>
      </div>
    </div>
  </main>

</body>
</html>