<?php
session_start();

if(isset($_SESSION['role']))
{
    if($_SESSION['role'] == 'management')
    {
        header('location:admin/dashboard.php');
    }
    else
    {
        header('location:employee/dashboard.php');
    }
}
else
{
    header('location:login.php');
}
?>