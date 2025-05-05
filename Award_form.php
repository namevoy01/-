<?php
session_start();
include 'config.php';

$Award_ID = $_GET['Award_ID'] ?? '';
$data = ['Award_NameTH'=>'','Award_Info'=>'','Award_Day'=>'','Award_Picture'=>''];

if ($Award_ID) {
    $stmt = $conn->prepare("SELECT * FROM award WHERE Award_ID = ?");
    $stmt->bind_param("i", $Award_ID);
    $stmt->execute();
    $res = $stmt->get_result();
    $data = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title><?= $Award_ID ? 'แก้ไขรางวัล' : 'เพิ่มรางวัล' ?></title>
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
        input[type="date"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border 0.2s;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="number"]:focus,
        textarea:focus {
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

        img {
            margin-bottom: 15px;
            border-radius: 12px;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?= $Award_ID ? 'แก้ไขรางวัล' : 'เพิ่มรางวัลใหม่' ?></h2>
        <form method="POST" action="Award_save.php" enctype="multipart/form-data">
            <input type="hidden" name="Award_ID" value="<?= $Award_ID ?>">
            
            <label>ชื่อรางวัล:</label>
            <input type="text" name="Award_NameTH" required value="<?= htmlspecialchars($data['Award_NameTH']) ?>">

            <label>รายละเอียด:</label>
            <textarea name="Award_Info" rows="5"><?= htmlspecialchars($data['Award_Info']) ?></textarea>

            <label>วันที่เปิดรับ:</label>
            <input type="date" name="Award_Day" value="<?= $data['Award_Day'] ?>">

            <label>รูปภาพ:</label>
            <?php if ($data['Award_Picture']): ?>
                <img src="<?= $data['Award_Picture'] ?>" alt="รูปวันที่ได้รับรางวัล"><br>
            <?php endif; ?>
            <input type="file" name="image">

            <button type="submit">💾 บันทึก</button>
            <a href="Award.php">ยกเลิก</a>
        </form>
    </div>
</body>
</html>
