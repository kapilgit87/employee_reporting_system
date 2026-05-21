<?php
session_start();
include('../db/db.php');

if($_SESSION['role'] != 'management')
{
    header('location:../login.php');
    exit;
}

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM tasks WHERE task_id='$id'");

header("location:report.php");
?>