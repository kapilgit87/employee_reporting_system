<?php
session_start();
include('../db/db.php');

if($_SESSION['role'] != 'management')
{
    header('location:../login.php');
    exit;
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM tasks WHERE task_id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $task_name = $_POST['task_name'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    mysqli_query($conn,"UPDATE tasks 
    SET task_name='$task_name', deadline='$deadline', status='$status'
    WHERE task_id='$id'");

    header("location:report.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>

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
            background: #fff;
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

        label{
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
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

    </style>
</head>

<body>

<div class="form-box">

    <h2>Edit Task</h2>

    <form method="POST">

        <div class="form-group">
            <label>Task Name</label>
            <input type="text" name="task_name" value="<?php echo $row['task_name']; ?>">
        </div>

        <div class="form-group">
            <label>Deadline</label>
            <input type="date" name="deadline" value="<?php echo $row['deadline']; ?>">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>
                <option <?php if($row['status']=="In Progress") echo "selected"; ?>>In Progress</option>
                <option <?php if($row['status']=="Completed") echo "selected"; ?>>Completed</option>
            </select>
        </div>

        <button type="submit" name="update">Update</button>

    </form>

</div>

</body>
</html>