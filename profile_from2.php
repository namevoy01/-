<?php
session_start();
include 'config.php';

if(empty($_SESSION[WP . 'checklogin'])) {
    $_SESSION['message'] = 'You are not authorized';
    header("location:{$base_url}/login.php");
    exit();
}

// ดึงข้อมูลประเภทเพศ
$sqlgen = "SELECT * FROM gender_type";
$result_gen = mysqli_query($conn, $sqlgen);

// ดึงข้อมูลผู้ใช้จากเซสชัน
$st_ID = $_SESSION[WP . 'st_ID'];

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sqlstudent = "SELECT st.*, g.gen_name
    FROM student st
    LEFT JOIN gender_type g ON g.gen_id = st.gen_id  
    WHERE st_ID = '$st_ID'";

$result = mysqli_query($conn, $sqlstudent);

if (!$result) {
    die("เกิดข้อผิดพลาดในการ query: " . mysqli_error($conn));
}

$stu = mysqli_fetch_object($result);
$chkgenid = $stu->gen_id;

// ดึงชื่อไฟล์ภาพจากฐานข้อมูล
$image_name = $stu->st_pic;
$image_path = 'uploaded_image/' . $image_name;  

// ตรวจสอบว่ามีไฟล์ภาพหรือไม่
if(empty($image_name) || !file_exists($image_path)) {
    $image_path = 'assets/image/default_avatar.png'; // ใช้ภาพเริ่มต้น
}
?> 

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <title>แก้ไขข้อมูลส่วนตัว</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Kanit', sans-serif;
    }
    
    body {
      margin: 0;
      background: #f5f9fc;
      padding: 40px;
      color: #333;
    }

    h2 {
      text-align: center;
      color: #004488;
      margin-bottom: 30px;
      font-size: 32px;
    }

    .back-button {
      display: block;
      width: 220px;
      background-color: #004488;
      color: white;
      padding: 12px;
      text-align: center;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      margin: 0 auto 20px;
      text-decoration: none;
      transition: background-color 0.3s;
    }

    .back-button:hover {
      background-color: #003366;
    }

    form {
      background: white;
      max-width: 900px;
      margin: auto;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: space-between;
    }

    .form-group {
      width: 48%;
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: 500;
      margin-bottom: 5px;
      color: #004488;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="date"],
    .form-group select,
    .form-group input[type="file"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
    }

    .form-group select {
      appearance: none;
      background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
      background-repeat: no-repeat;
      background-position: right 10px center;
    }

    .profile-pic-container {
      width: 100%;
      text-align: center;
      margin-bottom: 20px;
    }

    .profile-pic-preview {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin: 10px auto;
      border: 3px solid #eee;
      display: block;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    button[type="submit"] {
      width: 100%;
      background-color: #00a0d1;
      color: white;
      padding: 14px;
      border: none;
      border-radius: 10px;
      font-size: 18px;
      font-weight: 500;
      cursor: pointer;
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #0088b3;
    }

    @media (max-width: 768px) {
      .form-group {
        width: 100%;
      }
    }
  </style>
</head>

<body>
<h2>แก้ไขข้อมูลส่วนตัว</h2>
<a href="profile.php" class="back-button">← กลับไปหน้าข้อมูลส่วนตัว</a>

<form method="post" action="profile_save.php" enctype="multipart/form-data">
<input type="hidden" name="st_ID" value="<?php echo $st_ID; ?>">
    <div class="profile-pic-container">
        <label>รูปโปรไฟล์:</label>
        <img src="<?php echo $image_path; ?>" alt="รูปโปรไฟล์" class="profile-pic-preview">
        <input type="file" name="st_pic" accept="image/*">
    </div>

    <div class="form-group">
        <label>ชื่อ - นามสกุล (ภาษาไทย):</label>
        <input type="text" name="st_name_th" value="<?php echo !empty($stu->st_name_th) ? htmlspecialchars($stu->st_name_th) : ''; ?>" required>
    </div>

    <div class="form-group">
        <label>ชื่อเล่น:</label>
        <input type="text" name="st_nickname" value="<?php echo !empty($stu->st_nickname) ? htmlspecialchars($stu->st_nickname) : ''; ?>">
    </div>

    <div class="form-group">
        <label>ชื่อ - นามสกุล (ภาษาอังกฤษ):</label>
        <input type="text" name="st_name_en" value="<?php echo !empty($stu->st_name_en) ? htmlspecialchars($stu->st_name_en) : ''; ?>">
    </div>

    <div class="form-group">
        <label>เพศ:</label>
        <select name="gen_id">
            <option value="0">กรุณาเลือกเพศ</option>
            <?php 
            // รีเซ็ตพอยเตอร์ของผลลัพธ์
            mysqli_data_seek($result_gen, 0);
            while($gen = mysqli_fetch_object($result_gen)){ ?>
                <option value="<?php echo $gen->gen_id; ?>" <?php echo ($gen->gen_id == $chkgenid) ? 'selected' : ''; ?>>
                    <?php echo $gen->gen_name; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label>วัน/เดือน/ปีเกิด:</label>
        <input type="date" name="st_brith" value="<?php echo !empty($stu->st_brith) ? $stu->st_brith : ''; ?>">
    </div>

    <div class="form-group">
        <label>ที่อยู่ปัจจุบัน:</label>
        <input type="text" name="st_address" value="<?php echo !empty($stu->st_address) ? htmlspecialchars($stu->st_address) : ''; ?>">
    </div>

    <div class="form-group">
        <label>อีเมล:</label>
        <input type="email" name="st_Email" value="<?php echo !empty($stu->st_Email) ? htmlspecialchars($stu->st_Email) : ''; ?>">
    </div>

    <div class="form-group">
        <label>เบอร์โทรศัพท์:</label>
        <input type="text" name="st_phone" value="<?php echo !empty($stu->st_phone) ? htmlspecialchars($stu->st_phone) : ''; ?>">
    </div>

    <div class="form-group">
        <label>บัญชีโซเชียลมีเดีย:</label>
        <input type="text" name="st_social_media" value="<?php echo !empty($stu->st_social_media) ? htmlspecialchars($stu->st_social_media) : ''; ?>">
    </div>

    <button type="submit">บันทึกข้อมูล</button>
</form>
</body>
</html>