<?php
session_start();
include 'config.php';

$st_ID = $_POST['st_ID'];
$st_name_th = $_POST['st_name_th'];
$st_name_en = $_POST['st_name_en'];
$st_nickname = $_POST['st_nickname'];
$gen_id = $_POST['gen_id'];
$st_brith = $_POST['st_brith'];
$st_address = $_POST['st_address'];
$st_Email = $_POST['st_Email'];
$st_phone = $_POST['st_phone'];
$st_social_media = $_POST['st_social_media'];
$st_pic = '';

// จัดการอัปโหลดไฟล์รูปภาพ
if ($_FILES['st_pic']['name']) {
    $filename = 'st_image/' . time() . '_' . basename($_FILES['st_pic']['name']);
    move_uploaded_file($_FILES['st_pic']['tmp_name'], $filename);
    $st_pic = $filename;
}

if ($st_ID) {
    // UPDATE
    $sql = "UPDATE student SET st_name_th=?, st_name_en=?, st_nickname=?, gen_id=?, st_brith=?, st_address=?, st_Email=?, st_phone=?, st_social_media=?";
    $params = [$st_name_th, $st_name_en, $st_nickname, $gen_id, $st_brith, $st_address, $st_Email, $st_phone, $st_social_media];

    if ($st_pic) {
        $sql .= ", st_pic=?";
        $params[] = $st_pic;
    }

    $sql .= " WHERE st_ID=?";
    $params[] = $st_ID;

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat("s", count($params) - 1) . "i", ...$params);
} else {
    // INSERT
    $stmt = $conn->prepare("INSERT INTO student (
        st_name_th, st_name_en, st_nickname, gen_id, st_brith, st_address, st_Email, st_phone, st_social_media, st_pic
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssssi",$st_name_th, $st_name_en, $st_nickname, $gen_id, $st_brith, $st_address, $st_Email, $st_phone, $st_social_media, $st_pic);
}

$stmt->execute();


header("Location: profile.php");
exit;
