<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รางวัลที่ได้รับ</title>
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
        <h2>รายการรางวัลที่ได้รับ</h2>
        <a href="Award_form.php" class="add-btn">+ เพิ่มรางวัลใหม่</a>

        <table>
            <thead>
                <tr>
                    <th><center>ลำดับ</center></th>
                    <th><center>รูป</center></th>
                    <th style="width: 180px;"><center>ชื่อรางวัล</center></th>
                    <th><center>รายละเอียด</center></th>
                    <th><center>วันที่ได้รับรางวัล</center></th>
                    <th><center>วันที่แก้ไขล่าสุด</center></th>
                    <th><center>จัดการข้อมูล</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM award ORDER BY Award_Created DESC");
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $row['Award_ID'] ?></td>
                    <td>
                        <?php if ($row['Award_Picture']): ?>
                            <img src="<?= $row['Award_Picture'] ?>" alt="รูปวันที่ได้รับรางวัล">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['Award_NameTH']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['Award_Info'])) ?></td>
                    <td><?= $row['Award_Day'] ?></td>
                    <td><?= $row['Award_updated'] ?></td>
                    <td class="actions">
                        <button type="submit" class="btn-edit"><a href="Award_form.php?Award_ID=<?= $row['Award_ID'] ?>">📝แก้ไข </a><br>
                        <button type="submit" class="btn-delete"><a href="Award_delete.php?Award_ID=<?= $row['Award_ID'] ?>" onclick="return confirm('ยืนยันการลบ?')">🗑️ ลบ</a><br>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
