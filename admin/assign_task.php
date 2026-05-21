<?php
session_start();
include('../db/db.php');

if(!isset($_SESSION['id']))
{
    header('location:../login.php');
}

if($_SESSION['role'] != 'management')
{
    header('location:../login.php');
}

if(isset($_POST['assign']))
{
    $employee_id = $_POST['employee_id'];
    $task_name = $_POST['task_name'];
    $deadline = $_POST['deadline'];

    if($employee_id != "" && $task_name != "" && $deadline != "")
    {
        $query = "INSERT INTO tasks(employee_id,task_name,assign_date,deadline,status)
        VALUES('$employee_id','$task_name',CURDATE(),'$deadline','Pending')";

        mysqli_query($conn,$query);

        echo "Task Assigned Successfully";
    }
    else
    {
        echo "All Fields Required";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Task</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body{
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box{
            background: white;
            width: 420px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group{
            margin-bottom: 15px;
        }

        select,
        input{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            font-size: 14px;
        }

        select:focus,
        input:focus{
            border-color: #007bff;
        }

        button{
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover{
            background: #0056b3;
        }

        .back{
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .back:hover{
            text-decoration: underline;
        }

    </style>

</head>

<body>

<div class="form-box">

    <h2>Assign Task</h2>

    <form method="POST">

        <div class="form-group">

            <select name="employee_id">

                <option value="">Select Employee</option>

                <?php

                $emp = mysqli_query($conn,"SELECT * FROM employees WHERE role='employee'");

                while($row = mysqli_fetch_assoc($emp))
                {
                ?>

                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['name']; ?>
                </option>

                <?php } ?>

            </select>

        </div>

        <div class="form-group">
            <input type="text" name="task_name" placeholder="Task Name">
        </div>

        <div class="form-group">
            <input type="date" name="deadline">
        </div>

        <button type="submit" name="assign">Assign Task</button>

    </form>

    <a class="back" href="dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>