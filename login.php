<?php
session_start();
include('db/db.php');

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email != "" && $password != "")
    {
        $query = "SELECT * FROM employees 
                  WHERE email='$email' 
                  AND password='$password'";

        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            $employee_id = $row['id'];

            $visit_query = "INSERT INTO visits (employee_id, login_time)
                            VALUES ('$employee_id', NOW())";

            mysqli_query($conn, $visit_query);
            $_SESSION['visit_id'] = mysqli_insert_id($conn);
    

            if($row['role'] == 'management')
            {
                header('location:admin/dashboard.php');
            }
            else
            {
                header('location:employee/dashboard.php');
            }
            exit();
        }
        else
        {
            echo "Invalid Email or Password";
        }
    }
    else
    {
        echo "All fields are required";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>

<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f4f4f4;
    }

    form{
        background: #fff;
        padding: 30px;
        width: 320px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    form input{
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        font-size: 14px;
    }

    form input:focus{
        border-color: #007bff;
    }

    form button{
        width: 100%;
        padding: 12px;
        border: none;
        background: #007bff;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
    }

    form button:hover{
        background: #0056b3;
    }
</style>
</head>

<body>


<form method="POST">
    <h3>Employee Reporting System</h3>
    <input type="email" name="email" placeholder="Enter Email">
    <br><br>

    <input type="password" name="password" placeholder="Enter Password">
    <br><br>

    <button type="submit" name="login">Login</button>

</form>


</body>
</html>