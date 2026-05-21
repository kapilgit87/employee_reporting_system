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

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $department = $_POST['department'];

    if($name != "" && $email != "" && $password != "" && $department != "")
    {
        $query = "INSERT INTO employees(name,email,password,department,role)
        VALUES('$name','$email','$password','$department','employee')";

        mysqli_query($conn,$query);

        echo "Employee Added Successfully";
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
    <title>Add Employee</title>

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

        input{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

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
            text-decoration: none;
            color: #007bff;
        }

        .back:hover{
            text-decoration: underline;
        }

    </style>

</head>

<body>

<div class="form-box">

    <h2>Add Employee</h2>

    <form method="POST">

        <div class="form-group">
            <input type="text" name="name" placeholder="Employee Name">
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Email">
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password">
        </div>

        <div class="form-group">
            <input type="text" name="department" placeholder="Department">
        </div>

        <button type="submit" name="submit">Add Employee</button>

    </form>

    <a class="back" href="dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>