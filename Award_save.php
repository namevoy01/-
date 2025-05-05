<?php
session_start();
include 'config.php';

$Award_ID = $_POST['Award_ID'];
$Award_NameTH = $_POST['Award_NameTH'];
$Award_Info = $_POST['Award_Info'];
$Award_Day = $_POST['Award_Day'];
$Award_Picture = '';

if ($_FILES['image']['name']) {
    $filename = 'Uploaded_Award/' . time() . '_' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $filename);
    $Award_Picture = $filename;
}

if ($Award_ID) {
    // UPDATE
    $sql = "UPDATE award SET Award_NameTH=?, Award_Info=?, Award_Day=?";
    $params = [$Award_NameTH, $Award_Info, $Award_Day];

    if ($Award_Picture) {
        $sql .= ", Award_Picture=?";
        $params[] = $Award_Picture;
    }

    $sql .= " WHERE Award_ID=?";
    $params[] = $Award_ID;

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat("s", count($params)-1) . "i", ...$params);
} else {
    // INSERT
    $stmt = $conn->prepare("INSERT INTO award (Award_NameTH, Award_Info, Award_Day, Award_Picture) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $Award_NameTH, $Award_Info, $Award_Day, $Award_Picture);

}

$stmt->execute();
header("Location: Award.php");
