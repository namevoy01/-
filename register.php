<?php
session_start();
include 'config.php';

$sqlst= "SELECT * FROM student";
$result_st = mysqli_query($conn,$sqlst);

$sqlgen= "SELECT * FROM gender_type";
$result_gen = mysqli_query($conn,$sqlgen);

$sqlB= "SELECT * FROM user_branch";
$result_branch = mysqli_query($conn,$sqlB);

$sqlteacher= "SELECT * FROM teacher_01";
$result_teacher = mysqli_query($conn,$sqlteacher);

$sql_st= "SELECT st.* ,gdt.* ,tea.* ,b.* FROM student st 
LEFT JOIN gender_type gdt ON gdt.gen_id = st.gen_id
LEFT JOIN teacher_01 tea ON tea.teacher_id = st.teacher_id
LEFT JOIN user_branch b ON b.B_ID = st.B_ID";
$result = mysqli_query($conn,$sql_st);

$st = mysqli_fetch_object($result);
$chkB_ID = $st->B_ID;
$chkteacher_ID = $st->teacher_id;
$chkgenid = $st->gen_id;
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ลงทะเบียน</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }

    form.container {
      display: flex;
      flex-direction: row;
      width: 100%;
      height: 100vh;
    }

    .left, .right {
      flex: 1;
      padding: 40px;
      overflow-y: auto;
    }

    .left {
      background-color: #fff;
    }

    .right {
      background: url('assets/image/bg_login.png') no-repeat center center;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .right-content {
      background: rgba(255,255,255,0.9);
      padding: 30px;
      border-radius: 20px;
      width: 100%;
      max-width: 600px;
    }

    h2, h3 {
      color: #189edc;
    }

    .avatar {
      width: 150px;
      height: 150px;
      background-color: #ddd;
      border-radius: 20px;
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .input,
    select {
      width: 100%;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 12px;
      border: 1px solid #ccc;
      background-color: #f2f2f2;
      font-size: 16px;
    }

    .row {
      display: flex;
      gap: 20px;
      width: 100%;
      margin-bottom: 20px;
    }

    .row .input,
    .row select {
      flex: 1;
    }

    .submit-btn {
      margin-top: 30px;
      width: 100%;
      padding: 16px;
      background-color: #14a6d8;
      color: white;
      font-size: 18px;
      font-weight: bold;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      transition: 0.3s;
    }

    .submit-btn:hover {
      background-color: #118bb8;
    }

    @media screen and (max-width: 960px) {
      form.container {
        flex-direction: column;
        height: auto;
      }

      .row {
        flex-direction: column;
        gap: 10px;
      }

      .right-content {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<?php if (!empty($_SESSION['message'])): ?>
  <div class="alert alert-warning my-3">
    <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
  </div>
<?php endif; ?>

<form class="container" action="register-form.php" method="POST" enctype="multipart/form-data">
  <!-- LEFT -->
  <div class="left">
    <h2>ลงทะเบียน</h2>
    <div class="avatar">
      <input type="file" name="st_pic" required />
    </div>

    <input type="text" name="username" placeholder="ชื่อผู้ใช้" class="input" required />
    <input type="password" name="password" placeholder="รหัสผ่าน" class="input" required />


    <div class="row">
      <select name="gen_id" class="input" required>
        <option disabled selected>เพศ</option>
        <?php while($gt = mysqli_fetch_object($result_gen)) { ?>
          <option value="<?php echo $gt->gen_id ?>" <?php echo ($gt->gen_id == $chkgenid) ? 'selected' : ''; ?>>
            <?php echo $gt->gen_name ?>
          </option>
        <?php } ?>
      </select>

      <select name="teacher_ID" class="input" required>
        <option disabled selected>อาจารย์ที่ปรึกษา</option>
        <?php while($tea = mysqli_fetch_object($result_teacher)) { ?>
          <option value="<?php echo $tea->teacher_id ?>" <?php echo ($tea->teacher_id == $chkteacher_ID) ? 'selected' : ''; ?>>
            <?php echo $tea->firstname_TH . ' ' . $tea->lastname_TH ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <select name="B_ID" class="input" required>
      <option disabled selected>วิชาเอก</option>
      <?php while($b = mysqli_fetch_object($result_branch)) { ?>
        <option value="<?php echo $b->B_ID ?>" <?php echo ($b->B_ID == $chkB_ID) ? 'selected' : ''; ?>>
          <?php echo $b->B_NameTH ?>
        </option>
      <?php } ?>
    </select>
  </div>

  <!-- RIGHT -->
  <div class="right">
    <div class="right-content">
      <h2>รายละเอียดเพิ่มเติม</h2>
      <div class="row">
        <input type="text" name="st_name_th" placeholder="ชื่อ (ภาษาไทย)" class="input" required />
        <input type="text" name="st_name_en" placeholder="ชื่อ (ภาษาอังกฤษ)" class="input" required />
      </div>
      <div class="row">
        <input type="text" name="st_nickname" placeholder="ชื่อเล่น" class="input" required />
        <input type="text" name="st_IDcard" placeholder="รหัสนิสิต" class="input" required />
      </div>
      <div class="row">
        <input type="text" name="st_phone" placeholder="เบอร์โทร" class="input" required />
        <input type="text" name="st_phone_parent" placeholder="เบอร์ผู้ปกครอง" class="input" required />
      </div>

      <div class="row">
        <input type="date" name="st_brith" placeholder="วันเกิด" class="input" />
      </div>

      <h3>ที่อยู่</h3>
      <input type="text" name="address_detail" placeholder="ที่อยู่โดยละเอียด" class="input" />

      <div class="row">
        <input type="text" name="district" placeholder="แขวง/ตำบล" class="input" />
        <input type="text" name="area" placeholder="เขต/อำเภอ" class="input" />
      </div>

      <div class="row">
        <input type="text" name="road" placeholder="ถนน" class="input" />
        <input type="text" name="zipcode" placeholder="รหัสไปรษณีย์" class="input" />
      </div>

      <button type="submit" class="submit-btn">สมัครสมาชิก</button>
    </div>
  </div>
</form>

</body>
</html>
