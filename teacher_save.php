<?php 
session_start();
include 'config.php';

$teacher_id = $_POST['teacher_id'] ?? null;
$firstname_TH = $_POST['firstname_TH'];
$firstname_EN = $_POST['firstname_EN'];
$lastname_TH = $_POST['lastname_TH'];
$lastname_EN = $_POST['lastname_EN'];
$Email = $_POST['Email'];
$position = $_POST['position'];
$department = $_POST['department'];
$Workplace = $_POST['Workplace'];
$phone_number = $_POST['phone_number'];
$image_url = '';

// จัดการอัปโหลดภาพ
if (!empty($_FILES['image']['name'])) {
    $filename = 'teach_image/' . time() . '_' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $filename);
    $image_url = $filename;
}

if ($teacher_id) {
    // UPDATE
    $sql = "UPDATE teacher_01 SET firstname_TH=?, firstname_EN=?, lastname_TH=?, lastname_EN=?, Email=?, position=?, department=?, Workplace=?, phone_number=?";
    $params = [$firstname_TH, $firstname_EN, $lastname_TH, $lastname_EN, $Email, $position, $department, $Workplace, $phone_number];
    
    if ($image_url) {
        $sql .= ", image_url=?";
        $params[] = $image_url;
    }

    $sql .= " WHERE teacher_id=?";
    $params[] = $teacher_id;

    $types = str_repeat("s", count($params) - 1) . "i";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);
} else {
    // INSERT
    $sql = "INSERT INTO teacher_01 (firstname_TH, firstname_EN, lastname_TH, lastname_EN, Email, position, department, Workplace, phone_number, image_url)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $firstname_TH, $firstname_EN, $lastname_TH, $lastname_EN, $Email, $position, $department, $Workplace, $phone_number, $image_url);
}

$stmt->execute();
$stmt->close();
$conn->close();

header("Location: teacher.php");
exit();
?>
