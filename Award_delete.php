<?php
session_start();
include 'config.php';


$Award_ID = $_GET['Award_ID'];
$stmt = $conn->prepare("DELETE FROM award WHERE Award_ID = ?");
$stmt->bind_param("i", $Award_ID);
$stmt->execute();
header("Location: Award.php");
