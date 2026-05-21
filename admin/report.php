<?php
session_start();

if(!isset($_SESSION['role']))
{
    header('location:../login.php');
    exit;
}

if($_SESSION['role'] != 'management')
{
    header('location:../login.php');
    exit;
}

include('../db/db.php');

echo "<h2>Task Reports</h2>";

$query = "SELECT tasks.*, employees.name 
          FROM tasks 
          INNER JOIN employees 
          ON tasks.employee_id = employees.id";

$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
        echo "Task ID : ".$row['task_id']."<br>";
        echo "Employee ID : ".$row['employee_id']."<br>";
        echo "Employee Name : ".$row['name']."<br>";
        echo "Task Name : ".$row['task_name']."<br>";
        echo "Deadline : ".$row['deadline']."<br>";
        echo "Status : ".$row['status']."<br>";

        echo "<a href='edit_task.php?id=".$row['task_id']."'>Edit</a> | ";
        echo "<a href='delete_task.php?id=".$row['task_id']."' onclick='return confirm(\"Are you sure?\")'>Delete</a>";

        echo "<hr>";
    }
}
else
{
    echo "No Tasks Found";
}

echo "<hr>";
echo "<h2>Employee Visits Report</h2>";

$query2 = "SELECT visits.*, employees.name 
           FROM visits 
           INNER JOIN employees 
           ON visits.employee_id = employees.id
           ORDER BY visits.id DESC";

$result2 = mysqli_query($conn,$query2);

if(mysqli_num_rows($result2) > 0)
{
    while($row = mysqli_fetch_assoc($result2))
    {
        echo "Employee Name : ".$row['name']."<br>";
        echo "Login Time : ".$row['login_time']."<br>";

        if($row['logout_time'] == NULL)
        {
            echo "Logout Time : Still Active<br>";
        }
        else
        {
            echo "Logout Time : ".$row['logout_time']."<br>";
        }

        echo "<hr>";
    }
}
else
{
    echo "No Visit Records Found";
}


?>

   <a class="back" href="dashboard.php">Back to Dashboard</a>