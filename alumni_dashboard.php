<?php 
require_once("config.php");

    $sqlallalu="SELECT count(*) as allalu FROM alumni_education";
    $result_allalu = mysqli_query($conn,$sqlallalu);
    $dataall_alu = mysqli_fetch_object($result_allalu);
    $val_allalu = $dataall_alu->allalu;
    
    /// ดึงจำนวนนิสิตศึกษาอยู่ในระดับปริญญาตรี เพื่อแสดงใน Card ที่ 2
    $sqlBachelor="SELECT count(*) as alu_Bachelor FROM alumni_education where Qu_id=2 GROUP BY Qu_id";
    $result_Bachelor = mysqli_query($conn,$sqlBachelor);
    $dataBachelor = mysqli_fetch_object($result_Bachelor);
    $val_Bachelor = $dataBachelor ? $dataBachelor->alu_Bachelor : 0;

    /// ดึงจำนวนนิสิตศึกษาอยู่ในระดับปริญญาโท เพื่อแสดงใน Card ที่ 3
    $sqlMaster="SELECT count(*) as alu_Master FROM alumni_education where Qu_id=3 GROUP BY Qu_id";
    $result_Master = mysqli_query($conn,$sqlMaster);
    $dataMaster = mysqli_fetch_object($result_Master);
    $val_Master = $dataMaster ? $dataMaster->alu_Master : 0;
    
    /// ดึงจำนวนนิสิตศึกษาอยู่ในระดับปริญญาโท เพื่อแสดงใน Card ที่ 4
    $sqlDoctoral="SELECT count(*) as alu_Doctoral FROM alumni_education where Qu_id=4 GROUP BY Qu_id";
    $result_Doctoral = mysqli_query($conn,$sqlDoctoral);
    $dataDoctoral = mysqli_fetch_object($result_Doctoral);
    $val_Doctoral = $dataDoctoral ? $dataDoctoral->alu_Doctoral : 0;

    /// ดึงจำนวนพนักงานที่ยังทำงานอยู่ เพื่อแสดงใน Card ที่ 5
    $sqlact="SELECT count(*) as alu_actived  FROM alumni_education where edu_status = 'actived'";
    $result_act = mysqli_query($conn,$sqlact);
    $dataact = mysqli_fetch_object($result_act);
    $val_active = $dataact ? $dataact->alu_actived : 0;

    /// ดึงจำนวนพนักงานที่ไม่ทำงาน เพื่อแสดงใน Card ที่ 6
    $sqlunact="SELECT count(*) as alu_unactived  FROM alumni_education where edu_status = 'unactived'";
    $result_unact = mysqli_query($conn,$sqlunact);
    $dataunact = mysqli_fetch_object($result_unact);
    $val_unactive = $dataunact ? $dataunact->alu_unactived : 0;
    
    // เตรียมข้อมูลเป็น array สำหรับ chart.js
    $sqlbarchart = "SELECT q.Qu_name_TH AS Qu_name_TH, COUNT(a.edu_id) AS total 
    FROM alumni_education a
    INNER JOIN alumni_qualification q ON a.Qu_id = q.Qu_id 
    GROUP BY a.Qu_id";
    $resultbarchart = mysqli_query($conn, $sqlbarchart);
    
    $labels = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($resultbarchart)) {
        $labels[] = $row['Qu_name_TH'];
        $data[] = $row['total'];
    }
    // จำนวนพนักงานที่เพิ่มขึ้นรายปี
    $sqllinechart = "SELECT YEAR(CRdate) AS year, COUNT(*) AS total 
        FROM alumni_education 
        GROUP BY YEAR(CRdate) 
        ORDER BY year";

    $resultlinechart = mysqli_query($conn,$sqllinechart);
    $labelsln = [];
    $dataln = [];

    while ($row = mysqli_fetch_assoc($resultlinechart)) {
        $labelsln[] = $row['year'];
        $dataln[] = $row['total'];
    }

    /// สัดส่วน พนักงานตามตำแหน่งใน roll
    $sql_Qu = "SELECT q.Qu_name_TH AS Qu_name_TH, COUNT(a.edu_id) AS total 
    FROM alumni_education a
    INNER JOIN alumni_qualification q ON a.Qu_id = q.Qu_id
    GROUP BY Qu_name_TH";

    $result_Qu = $conn->query($sql_Qu);

    $Qu_labels = [];
    $Qu_data = [];

    while ($row = $result_Qu->fetch_assoc()) {
    $Qu_labels[] = $row['Qu_name_TH'];
    $Qu_data[] = $row['total'];
    }

    /// สัดส่วนพนักงาน actived/unactived
    $sql_status = "SELECT edu_status, COUNT(*) as total 
                  FROM alumni_education 
                  WHERE edu_status IN ('actived', 'unactived') 
                  GROUP BY edu_status";

    $result_status = $conn->query($sql_status);

    $status_labels = [];
    $status_data = [];

    while ($row = $result_status->fetch_assoc()) {
        // แปลงสถานะเป็นชื่อภาษาไทย
        $name = $row['edu_status'] === 'actived' ? 'กำลังศึกษาต่อ' : 'จบการศึกษา';
        $status_labels[] = $name;
        $status_data[] = $row['total'];
    }
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แดชบอร์ดระบบข้อมูลศิษย์เก่า</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <!-- เพิ่มใน <head> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<?php include("template/HW_menu.php"); ?>
<div class="container py-4">

  <!-- แถวที่ 1 -->
  <div class="row mb-4">
    <div class="col-12">
      <h1>📊 ยินดีต้อนรับ เข้าสู่ Dashboard</h1>
      <p class="text-muted">คุณสามารถเข้าถึงเมนูและจัดการข้อมูลต่าง ๆ ได้จากที่นี่</p>
    </div>
  </div> <!-- end of <div class="row mb-4"> -->

  <!-- แถวที่ 2 (Card กล่องข้อมูล) -->
  <div class="row g-4">
    <div class="col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">👥 นิสิตเก่าทั้งหมด</h5>
          <p class="card-text fs-4 text-primary"><?= $val_allalu ?> คน</p>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">👤 จำนวนนิสิตระดับปริญญาตรี</h5>
          <p class="card-text fs-4 text-primary"><?= $val_Bachelor ?> คน</p>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">👤 จำนวนนิสิตระดับปริญญาโท</h5>
          <p class="card-text fs-4 text-primary"><?= $val_Master ?> คน</p>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">👤 จำนวนนิสิตระดับปริญญาเอก</h5>
          <p class="card-text fs-4 text-primary"><?= $val_Doctoral ?> คน</p>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">🧑‍💼 นิสิตที่กำลังศึกษาต่อ</h5>
          <p class="card-text fs-4 text-primary"><?= $val_active ?> คน</p>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5 class="card-title">👥 นิสิตที่จบการศึกษา</h5>
          <p class="card-text fs-4 text-primary"><?= $val_unactive ?> คน</p>
        </div>
      </div>
    </div>
  </div>

  <!-- แถวที่ 3 barchart-->
  <div class="row mb-4">
    <div class="col-6">
        <canvas id="lineChart"></canvas>
    </div>
    <div class="col-6">
        <canvas id="barChart"></canvas>
    </div>
  </div> <!-- end of row 3  -->


  <!-- แถวที่ 5 pie chart -->
  <div class="row mb-4">
    <div class="col-4">
        <canvas id="pieChart1"></canvas>
    </div>
    <div class="col-4">
        <canvas id="pieChart2"></canvas>
    </div>
  </div> <!-- end of row 5  -->

  <!-- แถวที่ 6 Doughnut Chart -->
  <div class="row mb-4">
    <div class="col-4">
        <canvas id="doughnutChart1"></canvas>
    </div>
    <div class="col-4">
        <canvas id="doughnutChart2"></canvas>
    </div>
  </div> <!-- end of row 6  -->
  
  <!-- แถวที่ 7 mix Chart -->
  <div class="row mb-4">
    <div class="col-4">
        <canvas id="polarChart"></canvas>
    </div>
    <div class="col-4">
        <canvas id="radarChart"></canvas>
    </div>
    <div class="col-4">
        <canvas id="scatterplotChart"></canvas>
    </div>
  </div> <!-- end of row 5  -->  
</div>
</div> <!-- end of <div class="container py-4"> -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx1 = document.getElementById('barChart').getContext('2d');
const chartbar = new Chart(ctx1, {
  type: 'bar',
  data: {
    labels: <?= json_encode($labels, JSON_UNESCAPED_UNICODE) ?>,
    datasets: [{
      label: 'จำนวนนิสิตเก่า',
      data: <?= json_encode($data) ?>,
      borderWidth: 1,
      backgroundColor: 'rgba(54, 162, 235, 0.7)',
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 1
        }
      }
    }
  }
});


////////////////// ที่ดึงข้อมูลมาจากฐานข้อมูล
const ctx3 = document.getElementById('lineChart').getContext('2d');
  const lineChart = new Chart(ctx3, {
    type: 'line',
    data: {
      labels: <?= json_encode($labelsln) ?>,
      datasets: [{
        label: 'จำนวนนิสิตเก่าที่เพิ่มรายปี',
        data: <?= json_encode($dataln) ?>,
        borderColor: 'rgb(75, 192, 192)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        fill: true,
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          stepSize: 1
        }
      }
    }
  });


// pie chart ที่ดึงจากฐานข้อมูล ข้อมูลจำนวนนิสิตเก่าแต่ระดับวุติการศึกษา
const ctxQu = document.getElementById('pieChart1').getContext('2d');
new Chart(ctxQu, {
  type: 'pie',
  data: {
    labels: <?= json_encode($Qu_labels, JSON_UNESCAPED_UNICODE) ?>,
    datasets: [{
      data: <?= json_encode($Qu_data) ?>,
      backgroundColor: [
        '#4dc9f6', '#f67019', '#f53794', '#537bc4', '#acc236', '#166a8f'
      ]
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom'
      }
    }
  }
});

// Pie Chart: สถานะการศึกษา
const ctxStatus = document.getElementById('pieChart2').getContext('2d');
new Chart(ctxStatus, {
  type: 'pie',
  data: {
    labels: <?= json_encode($status_labels, JSON_UNESCAPED_UNICODE) ?>,
    datasets: [{
      data: <?= json_encode($status_data) ?>,
      backgroundColor: [
        '#36a2eb', '#ff6384'
      ]
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom'
      }
    }
  }
});


// Doughnut Chart: วุติการศึกษา
const ctxDoughnutroll = document.getElementById('doughnutChart1').getContext('2d');
new Chart(ctxDoughnutroll, {
  type: 'doughnut',
  data: {
    labels: <?= json_encode($Qu_labels, JSON_UNESCAPED_UNICODE) ?>,
    datasets: [{
      data: <?= json_encode($Qu_data) ?>,
      backgroundColor: [
        '#4dc9f6', '#f67019', '#f53794', '#537bc4', '#acc236', '#166a8f'
      ]
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom'
      }
    }
  }
});

// Doughnut Chart: สถานะการศึกษา
const ctxDoughnutstatus = document.getElementById('doughnutChart2').getContext('2d');
new Chart(ctxDoughnutstatus, {
  type: 'doughnut',
  data: {
    labels: <?= json_encode($status_labels, JSON_UNESCAPED_UNICODE) ?>,
    datasets: [{
      data: <?= json_encode($status_data) ?>,
      backgroundColor: [
        '#4dc9f6', '#f67019', '#f53794', '#537bc4', '#acc236', '#166a8f'
      ]
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom'
      }
    }
  }
});

</script>
</body>
</html>
