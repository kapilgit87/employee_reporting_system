<?php
session_start();
include('db/db.php');
if(isset($_SESSION['visit_id']))
{
    $visit_id = $_SESSION['visit_id'];

    $query = "UPDATE visits 
              SET logout_time = NOW() 
              WHERE id = '$visit_id'";

    mysqli_query($conn, $query);
}

session_destroy();

header('location:login.php');
exit();
?>