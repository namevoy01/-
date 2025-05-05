<?php
session_start();
include 'config.php';
//ดึงข้อมูลจาก database ดึงปีมาแสดง
$sql = "SELECT YEAR(Scho_Start) AS year, COUNT(*) AS Scho_Number_Student
        FROM scholarships
        GROUP BY YEAR(Scho_Start)
        ORDER BY year ASC";

$result = $conn->query($sql);

$years = [];
$totals = [];

while ($row = $result->fetch_assoc()) {
    $years[] = $row['year'];
    $totals[] = $row['Scho_Number_Student'];
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Segoe UI', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #007acc;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a:hover {
            background-color: #005f9e;
        }
        .card-title {
            font-size: 1rem;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar py-4">
            <div class="sidebar-sticky">
                <h5 class="text-center mb-4">Admin Panel</h5>
                <a href="home_admin.php">🏠 Dashboard</a>
                <a href="scholarship.php">🎓 จัดการทุนการศึกษา</a>
                <a href="news_manage.php">📰 จัดการข่าวสาร</a>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-10 ms-sm-auto px-md-4">
            <nav class="navbar navbar-light sticky-top px-3">
                <span class="navbar-brand mb-0 h4">Dashboard</span>
            </nav>

            
            <div class="row my-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h6 class="card-title">จำนวนทุนทั้งหมด</h6>
                            <h4>25</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h6 class="card-title">เปิดรับปีนี้</h6>
                            <h4>10</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h6 class="card-title">รอเปิดรับ</h6>
                            <h4>5</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-body">
                            <h6 class="card-title">หมดเขตล่าสุด</h6>
                            <h4>3</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="row">
                <div class="col-md-8">
                    
                    <div class="card mb-4">
                        <div class="card-header">จำนวนทุนที่เปิดรับในแต่ละปี</div>
                        <div class="card-body">
                            <canvas id="ScholarshipbarChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">ประเภทการรับทุน</div>
                        <div class="card-body">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<!-- ส่วน JavaScript สำหรับแสดงกราฟ -->
<script>
const ctx = document.getElementById('ScholarshipbarChart').getContext('2d'); // ตอนนี้ตรงกับ id แล้ว
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($years) ?>,
        datasets: [{
            label: 'จำนวนรางวัล',
            data: <?= json_encode($totals) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'จำนวนรางวัล'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'ปีที่ได้รับรางวัล'
                }
            }
        }
    }
});
</script>




</body>
</html>