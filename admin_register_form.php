<?php
session_start();
include 'config.php';

// คำสั่ง real escape ดักการ Hack ใน mysql
$username = mysqli_real_escape_string($conn, $_POST['username']);
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$surname = mysqli_real_escape_string($conn, $_POST['surname']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);

// ตรวจสอบการอัปโหลดไฟล์รูปภาพ
$image_name = $_FILES['image']['name'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_size = $_FILES['image']['size'];
$image_error = $_FILES['image']['error'];

// กำหนดโฟลเดอร์ที่เก็บไฟล์
$image_folder = 'uploaded_image/' . $image_name;

// ตรวจสอบว่าไฟล์ไม่มีข้อผิดพลาด และขนาดไม่เกินที่กำหนด (2MB)
if($image_error === 0){
    if($image_size > 2000000){  // 2MB
        $_SESSION['message'] = 'Image size is too large!';
        header("location:{$base_url}/admin_register_form.php");
        exit;
    } else {
        // คำสั่ง real escape ดักการ Hack ใน mysql
        if(!empty($username) && !empty($fullname) && !empty($surname) && !empty($password) && !empty($phone)) {
            // การแฮชรหัสผ่า
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // คำสั่ง SQL เพื่อบันทึกข้อมูลลงในฐานข้อมูล
            $query = mysqli_query($conn, "INSERT INTO admin (username, password, fullname, surname, phone, image) 
            VALUES('{$username}','{$hash}','{$fullname}','{$surname}','{$phone}','{$image_name}')") or die ('query failed');

            if($query) {
                // ย้ายไฟล์ที่อัปโหลดไปยังโฟลเดอร์
                move_uploaded_file($image_tmp_name, $image_folder);
                $_SESSION['message'] = 'Register Complete!';
                header("location:{$base_url}/admin_login.php");
                exit;
            } else {
                $_SESSION['message'] = 'Register could not be saved!';
                header("location:{$base_url}/admin_register_form.php");
                exit;
            }
        } else {
            $_SESSION['message'] = 'Input is required!';
            header("location:{$base_url}/admin_register_form.php");
            exit;
        }
    }
} else {
    $_SESSION['message'] = 'Error uploading image!';
    header("location:{$base_url}/admin_register_form.php");
    exit;
}
?>
