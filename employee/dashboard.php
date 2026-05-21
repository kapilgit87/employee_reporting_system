<?php
session_start();

if(!isset($_SESSION['id']))
{
    header('location:../login.php');
}

if($_SESSION['role'] != 'employee')
{
    header('location:../login.php');
}

include('../db/db.php');

$id = $_SESSION['id'];

$query = "SELECT * FROM tasks WHERE employee_id='$id'";
$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body{
            background: #f4f4f4;
            padding: 30px;
        }

        .container{
            max-width: 900px;
            margin: auto;
        }

        h2{
            color: #333;
            margin-bottom: 10px;
        }

        h3{
            margin-bottom: 20px;
            color: #555;
        }

        .task-box{
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }

        .task-box p{
            margin-bottom: 10px;
            color: #444;
        }

        .task-box a{
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .task-box a:hover{
            background: #0056b3;
        }

        .logout{
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout:hover{
            background: darkred;
        }

        hr{
            margin: 20px 0;
        }

    </style>
</head>

<body>

<div class="container">

    <h2>Employee Dashboard</h2>

    <h3>Welcome <?php echo $_SESSION['name']; ?></h3>

    <hr>

    <?php

    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
    ?>

        <div class="task-box">

            <p><b>Task ID :</b> <?php echo $row['task_id']; ?></p>

            <p><b>Task :</b> <?php echo $row['task_name']; ?></p>

            <p><b>Assign Date :</b> <?php echo $row['assign_date']; ?></p>

            <p><b>Deadline :</b> <?php echo $row['deadline']; ?></p>

            <p><b>Tentative Date :</b> 
            <?php echo $row['tentative_date']; ?></p>

            <p><b>Status :</b> <?php echo $row['status']; ?></p>

            <a href="task_status.php?id=<?php echo $row['task_id']; ?>">
                Update Task
            </a>

        </div>

    <?php
        }
    }
    else
    {
        echo "<p>No Tasks Available</p>";
    }
    ?>

    <a class="logout" href="../logout.php">Logout</a>

</div>

</body>
</html>