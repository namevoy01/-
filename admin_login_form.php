<?php
session_start();
include 'config.php';

// คำสั่ง real escape ดักการ Hack ใน mysql
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($username) && !empty($password)) {

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='{$username}'");
    $row = mysqli_num_rows($query);

    if($row === 1) {
        $user = mysqli_fetch_assoc($query); // ข้อมูลจาก database

        $_SESSION[WP . 'checklogin'] = true;
        $_SESSION[WP . 'Admin_ID'] = $user['Admin_ID'];
        $_SESSION[WP . 'fullname'] = $user['fullname'];

        header("location:{$base_url}/admin_dashboard.php");

    } else {
        $_SESSION['message'] = 'Email not found!';
        header("location:{$base_url}/admin_login.php");
    }

} else {
    $_SESSION['message'] = 'Email or Password is required!';
    header("location:{$base_url}/admin_login.php");
}
?>
