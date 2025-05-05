<?php
session_start();
include 'config.php';

$teacher_id = $_GET['teacher_id'] ?? '';
$data = [
    'firstname_TH' => '',
    'firstname_EN' => '',
    'lastname_TH' => '',
    'lastname_EN' => '',
    'Email' => '',
    'position' => '',
    'department' => '',
    'Workplace' => '',
    'phone_number' => '',
    'image_url' => ''
];

if ($teacher_id) {
    $stmt = $conn->prepare("SELECT * FROM teacher_01 WHERE teacher_id = ?");
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $data = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title><?= $teacher_id ? 'แก้ไขข้อมูลอาจารย์' : 'เพิ่มข้อมูลอาจารย์' ?></title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f8ff;
            color: #333;
            padding: 40px;
        }
        .container {
            max-width: 600px;
            background: #fff;
            margin: 0 auto;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 50, 0.1);
        }
        h2 {
            text-align: center;
            color: #007acc;
            margin-bottom: 25px;
        }
        label {
            font-weight: bold;
            color: #005f9e;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border 0.2s;
        }
        input:focus {
            border-color: #007acc;
            outline: none;
        }
        button {
            background-color: #007acc;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #005f9e;
        }
        a {
            display: inline-block;
            margin-left: 15px;
            color: #007acc;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?= $teacher_id ? 'แก้ไขข้อมูลอาจารย์' : 'เพิ่มข้อมูลอาจารย์ใหม่' ?></h2>
        <form method="POST" action="teacher_save.php" enctype="multipart/form-data">
            <input type="hidden" name="teacher_id" value="<?= $teacher_id ?>">

            <label>ชื่อ (ภาษาไทย):</label>
            <input type="text" name="firstname_TH" required value="<?= htmlspecialchars($data['firstname_TH']) ?>">

            <label>ชื่อ (ภาษาอังกฤษ):</label>
            <input type="text" name="firstname_EN" value="<?= htmlspecialchars($data['firstname_EN']) ?>">

            <label>นามสกุล (ภาษาไทย):</label>
            <input type="text" name="lastname_TH" value="<?= htmlspecialchars($data['lastname_TH']) ?>">

            <label>นามสกุล (ภาษาอังกฤษ):</label>
            <input type="text" name="lastname_EN" value="<?= htmlspecialchars($data['lastname_EN']) ?>">

            <label>อีเมล:</label>
            <input type="email" name="Email" value="<?= htmlspecialchars($data['Email']) ?>">

            <label>ตำแหน่ง:</label>
            <input type="text" name="position" value="<?= htmlspecialchars($data['position']) ?>">

            <label>ภาควิชา:</label>
            <input type="text" name="department" value="<?= htmlspecialchars($data['department']) ?>">

            <label>สถานที่ทำงาน:</label>
            <input type="text" name="Workplace" value="<?= htmlspecialchars($data['Workplace']) ?>">

            <label>เบอร์โทรศัพท์:</label>
            <input type="tel" name="phone_number" value="<?= htmlspecialchars($data['phone_number']) ?>">

            <label>รูปภาพ:</label>
            <?php if ($data['image_url']): ?>
                <img src="<?= $data['image_url'] ?>" alt="รูปบุคลากร]"><br>
            <?php endif; ?>
            <input type="file" name="image">

            <button type="submit">💾 บันทึก</button>
            <a href="teacher.php">ยกเลิก</a>
        </form>
    </div>
</body>
</html>
