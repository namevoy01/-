<?php
include 'config.php';

$sql = "SELECT Scholar_ID, Scho_NameTH, Scho_Info, Scho_Start, Scho_End, Scho_Picture, Scho_Contact
        FROM scholarships 
        ORDER BY Scho_Start DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ทุนการศึกษาทั้งหมด</title>
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
            color: #333;
        }

        /* --- Header --- */
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

        .header-title {
            flex: 1;
            text-align: center;
        }

        .header-title h1 {
            font-size: 36px;
            color: white;
            font-weight: bold;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.4);
        }

        .menu-bar {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
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

        .login {
            display: flex;
            align-items: center;
            margin-left: auto;
            margin-top: 20px;
        }

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
            margin-left: 30px;
        }

        .login a img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        /* --- Scholarships Display --- */
        h2 {
            text-align: center;
            color: #007acc;
            margin: 40px 0 20px;
            font-size: 32px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px 40px;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 6px 14px rgba(0,0,0,0.06);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin: 0;
            font-size: 20px;
            color: #005fa3;
        }

        .card p {
            font-size: 14px;
            margin: 8px 0;
            color: #444;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007acc;
            font-weight: bold;
        }

        .card a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="top-bar">
        <div class="logo">
            <img src="assets/image/logo.png" alt="โลโก้คณะ">
        </div>
        <div class="header-title">
            <h1>Alumni ระบบจัดการข้อมูลศิษย์เก่า</h1>
        </div>
        <div class="menu-bar">
            <a href="index.php">ข่าวสาร</a>
            <a href="scholarship_index.php">ทุน</a>
            <a href="Award_index.php">รางวัล</a>
            <a href="#">บุคลากร/เจ้าหน้าที่</a>
            
        </div>
        <div class="login">
            <a href="login.php"><img src="assets/image/emoji_profile.png" alt="Login">Login</a>
        </div>
    </div>

    <!-- Scholarships -->
    <h2>ทุนการศึกษาทั้งหมด</h2>
    <div class="grid">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="card">
                <?php if ($row['Scho_Picture']): ?>
                    <img src="<?= htmlspecialchars($row['Scho_Picture']) ?>" alt="ภาพทุน">
                <?php endif; ?>
                <h3><?= htmlspecialchars($row['Scho_NameTH']) ?></h3>
                <p><?= mb_substr(strip_tags($row['Scho_Info']), 0, 100) ?>...</p>
                <p>📅 <?= $row['Scho_Start'] ?> - <?= $row['Scho_End'] ?></p>
                <p>Telephone : <?= $row['Scho_Contact'] ?></p>
                <a href="scholarship_view.php?Scholar_ID=<?= $row['Scholar_ID'] ?>">ดูรายละเอียด</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
