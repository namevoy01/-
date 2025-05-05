<?php
session_start();
include 'config.php';

$st_IDcard = mysqli_real_escape_string($conn, $_POST['st_IDcard']);
$B_ID = mysqli_real_escape_string($conn, $_POST['B_ID']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$st_name_th = mysqli_real_escape_string($conn, $_POST['st_name_th']);
$st_nickname = mysqli_real_escape_string($conn, $_POST['st_nickname']);
$st_name_en = mysqli_real_escape_string($conn, $_POST['st_name_en']);
$gen_id = mysqli_real_escape_string($conn, $_POST['gen_id']);
$st_brith = mysqli_real_escape_string($conn, $_POST['st_brith']);
$st_Email = mysqli_real_escape_string($conn, $_POST['st_Email']);
$teacher_ID = mysqli_real_escape_string($conn, $_POST['teacher_ID']);
$st_phone_parent = mysqli_real_escape_string($conn, $_POST['st_phone_parent']);
$st_phone = mysqli_real_escape_string($conn, $_POST['st_phone']);

$st_ID = $_SESSION[WP . 'st_ID'];
$image_name = $_FILES['st_pic']['name'];
$image_tmp_name = $_FILES['st_pic']['tmp_name'];
$image_size = $_FILES['st_pic']['size'];
$image_error = $_FILES['st_pic']['error'];
$image_folder = 'uploaded_image/' . $image_name;

if ($image_error === 0) {
    if ($image_size > 2000000) {
        $_SESSION['message'] = 'Image size is too large!';
        header("location:{$base_url}/register2.php");
        exit;
    } else {
        if (!empty($username) && !empty($st_IDcard) && !empty($st_name_th) && !empty($password) && !empty($st_name_en)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // 1. เพิ่มข้อมูลนักเรียนใหม่
            $queryStudent = mysqli_query($conn, "
                INSERT INTO student (st_IDcard, B_ID, username, password, gen_id, st_brith, st_Email, teacher_ID, st_phone_parent, st_phone, st_name_th, st_nickname, st_name_en, st_pic) 
                VALUES ('$st_IDcard', '$B_ID', '$username', '$hash', '$gen_id', '$st_brith', '$st_Email', '$teacher_ID', '$st_phone_parent', '$st_phone', '$st_name_th', '$st_nickname', '$st_name_en', '$image_name')
            ");

            if ($queryStudent) {
                $st_id = mysqli_insert_id($conn); 

                // 3. ตรวจสอบว่ามีเลขบัตรประชาชนในตาราง alumni แล้วหรือยัง
                $checkAlumni = mysqli_query($conn, "SELECT Alu_id FROM alumni WHERE st_IDcard = '$st_IDcard'");
                if (mysqli_num_rows($checkAlumni) > 0) {
                    $row = mysqli_fetch_assoc($checkAlumni);
                    $alu_id = $row['Alu_id'];
                } else {
                    // 4. ถ้ายังไม่มีให้เพิ่ม
                    mysqli_query($conn, "INSERT INTO alumni (st_IDcard) VALUES ('$st_IDcard')");
                    $alu_id = mysqli_insert_id($conn);
                }

                // 5. เพิ่มข้อมูลใน alumni_education
                $crID = $_SESSION['ss_st_id'];
                $sql_aluedu =  "INSERT INTO alumni_education (Alu_id, st_ID, CRdate, CrID) VALUES ('$alu_id', '$st_id', NOW(), '$crID')";
                $result = mysqli_query($conn,$sql_aluedu);

                move_uploaded_file($image_tmp_name, $image_folder);
                $_SESSION['message'] = 'Register Complete!';
                header("location:{$base_url}/login.php");
                exit;
            } else {
                $_SESSION['message'] = 'Register could not be saved!';
                header("location:{$base_url}/register2.php");
                exit;
            }
        } else {
            $_SESSION['message'] = 'All fields are required!';
            header("location:{$base_url}/register2.php");
            exit;
        }
    }
} else {
    $_SESSION['message'] = 'Error uploading image!';
    header("location:{$base_url}/register2.php");
    exit;
}
?>
