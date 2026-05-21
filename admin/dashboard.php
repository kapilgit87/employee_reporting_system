<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('location:../login.php');
}

if($_SESSION['role'] != 'management')
{
    header('location:../login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Management Dashboard</title>

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
            max-width: 700px;
            margin: auto;
        }

        h2{
            color: #333;
            margin-bottom: 10px;
        }

        h3{
            color: #555;
            margin-bottom: 20px;
        }

        .card{
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }

        .link{
            display: block;
            padding: 12px 15px;
            margin-bottom: 12px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
            transition: 0.3s;
        }

        .link:hover{
            background: #0056b3;
        }

        .logout{
            background: red;
        }

        .logout:hover{
            background: darkred;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Management Dashboard</h2>

    <h3>Welcome <?php echo $_SESSION['name']; ?></h3>

    <div class="card">

        <a class="link" href="add_employee.php">Add Employee</a>

        <a class="link" href="assign_task.php">Assign Task</a>

        <a class="link" href="report.php">View Reports</a>

        <a class="link logout" href="../logout.php">Logout</a>

    </div>

</div>

</body>
</html>

