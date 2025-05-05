<?php
session_start();
include 'config.php';

$Scholar_ID = $_POST['Scholar_ID'];
$Scho_NameTH = $_POST['Scho_NameTH'];
$Scho_Info = $_POST['Scho_Info'];
$Scho_Start = $_POST['Scho_Start'];
$Scho_End = $_POST['Scho_End'];
$Scho_Number_Student = $_POST['Scho_Number_Student'];
$Scho_Contact = $_POST['Scho_Contact'];
$Scho_Picture = '';

if ($_FILES['image']['name']) {
    $filename = 'Uploaded_Scholarship/' . time() . '_' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $filename);
    $Scho_Picture = $filename;
}

if ($Scholar_ID) {
    // UPDATE
    $sql = "UPDATE scholarships SET Scho_NameTH=?, Scho_Info=?, Scho_Start=?, Scho_End=?, Scho_Number_Student=?, Scho_Contact=?";
    $params = [$Scho_NameTH, $Scho_Info, $Scho_Start, $Scho_End, $Scho_Number_Student, $Scho_Contact];

    if ($Scho_Picture) {
        $sql .= ", Scho_Picture=?";
        $params[] = $Scho_Picture;
    }

    $sql .= " WHERE Scholar_ID=?";
    $params[] = $Scholar_ID;

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat("s", count($params)-1) . "i", ...$params);
} else {
    // INSERT
    $stmt = $conn->prepare("INSERT INTO scholarships (Scho_NameTH, Scho_Info, Scho_Start, Scho_End, Scho_Picture, Scho_Number_Student, Scho_Contact) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $Scho_NameTH, $Scho_Info, $Scho_Start, $Scho_End, $Scho_Picture, $Scho_Number_Student, $Scho_Contact);
}

$stmt->execute();
header("Location: scholarship.php");
