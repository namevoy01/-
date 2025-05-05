<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>บุคลากร/เจ้าหน้าที่</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f8ff;
            color: #333;
            padding: 40px;
        }

        h2 {
            color: #007acc;
            text-align: center;
            margin-bottom: 30px;
        }

        .add-btn {
            display: inline-block;
            background-color: #007acc;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 20px;
            transition: background 0.3s;
        }

        .add-btn:hover {
            background-color: #005f9e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 50, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #d0ecff;
            color: #004c99;
        }

        tr:hover {
            background-color: #f1faff;
        }

        img {
            max-width: 100px;
            border-radius: 8px;
        }

        .actions a {
            margin-right: 10px;
            color: #007acc;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .center {
            max-width: 1100px;
            margin: 0 auto;
        }

        .btn-edit {
            background-color: #c8f7c5;
            color: #1a531b;
            padding: 6px 12px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-edit:hover {
            background-color: #a6e6a2;
        }

        .btn-delete {
            background-color: #ffd4d4;
            color: #8b0000;
            padding: 6px 12px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }

        .btn-delete:hover {
            background-color: #ffbaba;
        }
        table td:nth-child(2) {
            width: 180px;
            white-space: normal;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="center">
        <h2>บุคลากร/เจ้าหน้าที่</h2>
        <a href="teacher_form.php" class="add-btn">+ เพิ่มบุคลากร/เจ้าหน้าที่</a>

        <table>
            <thead>
                <tr>
                    <th><center>รหัส</center></th>
                    <th><center>รูปภาพ</center></th>
                    <th style="width: 180px;"><center>ชื่อ (TH)</center></th>
                    <th><center>ชื่อ (EN)</center></th>
                    <th><center>นามสกุล (TH)า</center></th>
                    <th><center>นามสกุล (EN)</center></th>
                    <th><center>อีเมล</center></th>
                    <th><center>ตำแหน่ง</center></th>
                    <th><center>แผนก</center></th>
                    <th><center>สถานที่ทำงาน/center></th>
                    <th><center>เบอร์โทร</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM teacher_01 ORDER BY teach_creat DESC");
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $row['teacher_id'] ?></td>
                    <td>
                        <?php if ($row['image_url']): ?>
                            <img src="<?= $row['image_url'] ?>" alt="รูปบุคลากร">
                        <?php endif; ?>
                    </td>
                    <td><?= $row['firstname_TH'] ?></td>
                    <td><?= $row['firstname_EN'] ?></td>
                    <td><?= $row['lastname_EN'] ?></td>
                    <td><?= $row['Email'] ?></td>
                    <td><?= $row['position'] ?></td>
                    <td><?= $row['department'] ?></td>
                    <td><?= $row['Workplace'] ?></td>
                    <td><?= $row['phone_number'] ?></td>
                    
                    <td class="actions">
                        <button type="submit" class="btn-edit"><a href="teacher_form.php?teacher_id=<?= $row['teacher_id'] ?>">📝แก้ไข </a><br>
                        <button type="submit" class="btn-delete"><a href="delete_teacher.php?teacher_id=<?= $row['teacher_id'] ?>" onclick="return confirm('ยืนยันการลบ?')">🗑️ ลบ</a><br>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
