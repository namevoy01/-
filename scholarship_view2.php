<?php
session_start();
include 'config.php';

$Scholar_ID = $_GET['Scholar_ID']; // รับ id ทุนจาก URL
$query = mysqli_query($conn, "SELECT * FROM scholarships WHERE Scholar_ID = '{$Scholar_ID}'");
$scholarship = mysqli_fetch_assoc($query);

$image_path =  $scholarship['Scho_Picture'];
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>รายละเอียดทุนการศึกษา | ระบบศิษย์เก่า</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <style>
    /* ใช้ CSS เดิมแบบตัดมาจากไฟล์ก่อนหน้า (เช่น .top-bar, .menu-bar, .logout ฯลฯ) */

    body {
      background-color: #f5f9fc;
      font-family: 'Kanit', sans-serif;
      margin: 0;
      padding: 0;
    }

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

    .header-title h1 {
      font-size: 36px;
      color: white;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.4);
    }

    .menu-bar a, .logout a {
      padding: 14px 24px;
      border-radius: 16px;
      text-decoration: none;
      font-size: 18px;
      transition: background 0.3s;
    }

    .menu-bar a {
      background-color: white;
      color: #004488;
    }

    .menu-bar a:hover {
      background-color: #e6f2ff;
    }

    .logout a {
      background-color: #004488;
      color: white;
      display: flex;
      align-items: center;
    }

    main {
      padding: 60px;
    }

    .container {
      display: flex;
      gap: 50px;
      max-width: 1200px;
      margin: 0 auto;
      background: white;
      border-radius: 25px;
      padding: 40px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .left-panel {
      flex: 1;
      text-align: center;
    }

    .left-panel img {
      width: 100%;
      max-width: 400px;
      border-radius: 20px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
      object-fit: cover;
    }

    .right-panel {
      flex: 2;
    }

    .right-panel h2 {
      color: #00a0d1;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .info-group {
      display: grid;
      grid-template-columns: 200px 1fr;
      row-gap: 15px;
      column-gap: 30px;
      font-size: 18px;
    }

    .info-group .label {
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .info-group {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

<div class="top-bar">
  <div class="logo">
    <img src="assets/image/logo.png" alt="โลโก้คณะ">
  </div>
  <div class="header-title">
    <h1>รายละเอียดทุนการศึกษา</h1>
  </div>
  <div class="menu-bar">
    <a href="index2.php">ข่าวสาร</a>
    <a href="scholarship_index2.php">ทุน</a>
    <a href="#">รางวัล</a>
    <a href="#">บุคลากร/เจ้าหน้าที่</a>
  </div>
  <div class="logout">
    <a href="logout.php"><img src="assets/image/emoji_profile.png" alt="Logout" width="20">Logout</a>
  </div>
</div>

<main>
  <div class="container">
    <div class="left-panel">
    <img src="<?= htmlspecialchars($image_path) ?>" alt="ภาพทุน">

    </div>

    <div class="right-panel">
      <h2><?php echo $scholarship['Scho_NameTH']; ?></h2>
      <div class="info-group">
        <div class="label">คำอธิบาย:</div><div><?php echo nl2br($scholarship['Scho_Info']); ?></div>
        <div class="label">วันที่เริ่มรับสมัคร:</div><div><?php echo $scholarship['Scho_Start']; ?></div>
        <div class="label">วันสิ้นสุดรับสมัคร:</div><div><?php echo $scholarship['Scho_End']; ?></div>
        <div class="label">จำนวนนิสิตที่เปิดรับ:</div><div><?php echo $scholarship['Scho_Number_Student']; ?> คน</div>
        <div class="label">ติดต่อ:</div><div><?php echo $scholarship['Scho_Contact']; ?></div>
      </div>
    </div>
  </div>
</main>

</body>
</html>
