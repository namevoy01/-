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
    .login {
    display: flex;
    align-items: center;
    margin-left: auto;  /* ทำให้ปุ่ม logout อยู่ทางขวาสุด */
    margin-top: 20px;  /* เพิ่มระยะห่างจากเมนูคำสั่ง */
    }

    /* ปรับขนาดรูปภาพในปุ่ม Logout */
    .login a img {
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
    .login a {
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

    .sub-news-container {
  display: flex;
  justify-content: space-between;
  margin: -20px 50px 40px 50px;
  gap: 20px;
}

.sub-news-box {
  flex: 1;
  background-color: #ffffff;
  border-left: 6px solid #004488;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}

.sub-news-box h3 {
  color: #004488;
  font-size: 20px;
  margin-bottom: 10px;
}

.sub-news-box p {
  font-size: 16px;
  color: #333;
}


.news-type-buttons {
  display: flex;
  justify-content: center;
  gap: 25px;
  margin-bottom: 30px; /* เพิ่มระยะห่างด้านล่าง */
}

.news-type {
  background-color: #004488;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 20px;
  font-size: 16px;
  cursor: pointer;
  transition: background 0.3s;
}

.news-type:hover {
  background-color: #0066aa;
}

.sub-news-container {

  justify-content: space-between;
  margin: 0 50px 40px 50px;
  gap: 20px;
  margin-top: 30px; /* เพิ่มระยะห่างจากปุ่ม */
}

@media (max-width: 768px) {
  .sub-news-container {
    flex-direction: column;
    margin: 20px;
  }
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
      <a href="index.php">ข่าวสาร</a>
      <a href="scholarship_index.php">ทุน</a>
      <a href="#">รางวัล</a>
      <a href="#">บุคลากร/เจ้าหน้าที่</a>
    </div>

    <div class="login">
      <a href="login.php"><img src="assets/image/emoji_profile.png" alt="Login">Login</a>
    </div>
  </div>
  </div>

<!-- ข่าวสารประชาสัมพันธ์ -->
<div class="news-section">
  <div class="news-text">
    <h2>ข่าวสารประชาสัมพันธ์</h2>
    <p>
      สวัสดีครับทุกท่าน! ขอต้อนรับเข้าสู่ระบบศิษย์เก่าของคณะเรา ในที่นี้คุณจะได้ทราบข่าวสารเกี่ยวกับกิจกรรมล่าสุด ทุนการศึกษา และโอกาสการทำงานที่เปิดให้กับศิษย์เก่า หากคุณมีข้อสงสัยสามารถติดต่อสอบถามได้ทุกเมื่อ
      สวัสดีครับทุกท่าน! ขอต้อนรับเข้าสู่ระบบศิษย์เก่าของคณะเรา ในที่นี้คุณจะได้ทราบข่าวสารเกี่ยวกับกิจกรรมล่าสุด ทุนการศึกษา และโอกาสการทำงานที่เปิดให้กับศิษย์เก่า หากคุณมีข้อสงสัยสามารถติดต่อสอบถามได้ทุกเมื่อ
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

<!-- ปุ่มประเภทข่าว – ย้ายมาไว้ใต้หัวข้อข่าว -->
<div class="news-type-buttons">
  <button class="news-type">ข่าวทั่วไป</button>
  <button class="news-type">ข่าวกิจกรรม</button>
  <button class="news-type">ข่าวรับสมัคร</button>
</div>

<!-- กล่องข่าวย่อย -->
<div class="sub-news-container">
  <div class="sub-news-box">
    <h3>ข่าวย่อย 1</h3>
    <p>รายละเอียดข่าวย่อยที่ 1 เช่น กิจกรรมย่อย กำหนดการ ฯลฯ</p>
    <div class="sub-news-image">
      <img src="images/news1.jpg" alt="ภาพข่าวย่อย 1">
    </div>
  </div>
  <div class="sub-news-box">
    <h3>ข่าวย่อย 2</h3>
    <p>รายละเอียดข่าวย่อยที่ 2 เช่น ข่าวทุนย่อย หรืออื่น ๆ</p>
    <div class="sub-news-image">
      <img src="images/news2.jpg" alt="ภาพข่าวย่อย 2">
    </div>
  </div>
</div>

</body>
</html>
