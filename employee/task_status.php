<?php
session_start();
include('../db/db.php');

if(!isset($_SESSION['id']))
{
    header('location:../login.php');
}

if($_SESSION['role'] != 'employee')
{
    header('location:../login.php');
}

$employee_id = $_SESSION['id'];

$task_id = $_GET['id'];

$check = mysqli_query($conn,"SELECT * FROM tasks WHERE task_id='$task_id' AND employee_id='$employee_id'");
$task = mysqli_fetch_assoc($check);

if(!$task)
{
    echo "Invalid Task";
    exit;
}

if(isset($_POST['update']))
{
    $status = $_POST['status'];
    $tentative_date = $_POST['tentative_date'];

    $query = "UPDATE tasks 
              SET status='$status', tentative_date='$tentative_date' 
              WHERE task_id='$task_id'";

    mysqli_query($conn,$query);

    echo "Task Updated Successfully";
     header("Location:dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Task</title>

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

        .task-form{
            background: white;
            width: 400px;
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

        label{
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #444;
        }

        input,
        select{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        input:focus,
        select:focus{
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

        .info{
            background: #f8f8f8;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            color: #333;
        }

    </style>
</head>

<body>

<div class="task-form">

    <h2>Update Task</h2>

    <form method="POST">

        <div class="info">
            <b>Task:</b> <?php echo $task['task_name']; ?>
        </div>

        <div class="info">
            <b>Deadline:</b> <?php echo $task['deadline']; ?>
        </div>

        <div class="form-group">
            <label>Tentative Date</label>

            <input type="date" 
                   name="tentative_date" 
                   value="<?php echo $task['tentative_date']; ?>">
        </div>

        <div class="form-group">

            <label>Status</label>

            <select name="status">

                <option <?php if($task['status']=="Pending") echo "selected"; ?>>
                    Pending
                </option>

                <option <?php if($task['status']=="In Progress") echo "selected"; ?>>
                    In Progress
                </option>

                <option <?php if($task['status']=="Completed") echo "selected"; ?>>
                    Completed
                </option>

            </select>

        </div>

        <button type="submit" name="update">
            Update Task
        </button>

    </form>

</div>

</body>
</html>