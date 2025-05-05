<?php
session_start();
include 'config.php';

//คำสั่ง real escape ดักการHack ใน mysql
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($username) && !empty($password)) {
    $query = mysqli_query($conn, "SELECT * FROM student WHERE username='{$username}'");
    $row = mysqli_num_rows($query);

    if($row === 1) {
        $user = mysqli_fetch_assoc($query); //ข้อมูลจากdatabase

        //เช็ค รหัสผ่านจากฐานข้อมูลกับที่ล็อคอินมามันตรงกันไหม
        if(password_verify($password, $user['password'])) {

            //เก็บ Session Login
            $_SESSION[WP . 'checklogin'] = true;
            $_SESSION[WP . 'st_ID'] = $user['st_ID'];
            $_SESSION[WP . 'fullname'] = $user['fullname'];

            header("location:{$base_url}/index2.php");
        } else {
            //กรณี อีเมล และ รหัสผ่าน ไม่ตรงกันให้ขึ้นว่า Email or Password is invalid! และส่งไปหน้า login
            $_SESSION['message'] = 'Email or Password is invalid!';
            header("location:{$base_url}/login.php");

        }
    } else {
        //กรณีไม่พบ Email อยู่ในฐานข้อมูลให้ขึ้นว่า Email not found และส่งไปหน้า login
        $_SESSION['message'] = 'Email not found!';
        header("location:{$base_url}/login.php");
    }
} else {
    //กรณีที่ไม่ได้กรอก อีเมล หรือ หรัสผ่าน จะให้ขึ้นแจ้งว่า Email or Password is required! และส่งไปหน้า login
    $_SESSION['message'] = 'Email or Password is required!';
    header("location:{$base_url}/login.php");
}
?>