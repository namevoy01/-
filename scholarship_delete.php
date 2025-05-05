<?php
session_start();
include 'config.php';


$Scholar_ID = $_GET['Scholar_ID'];
$stmt = $conn->prepare("DELETE FROM scholarships WHERE Scholar_ID = ?");
$stmt->bind_param("i", $Scholar_ID);
$stmt->execute();
header("Location: scholarship.php");
