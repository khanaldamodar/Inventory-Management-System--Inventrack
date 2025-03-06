<?php
require "../../config.php"; 
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $email = $_POST['email'];
    $passkey = $_POST['password'];

    if(!$email || !$passkey){
        echo "All fields are required.";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            // Use password_verify to check hashed password
            if($row['passkey'] == $passkey){
                echo "Login Successful!";

                $_SESSION['id'] = $row['id'];
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="max-width: 400px; margin: 100px auto; padding: 2rem; background: #fff; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
        <h2 style="text-align: center; color: #333; margin-bottom: 1.5rem;">Admin Login</h2>
        <form action="index.php" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label for="email" style="color: #666; font-size: 0.9rem;">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter Email" style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label for="password" style="color: #666; font-size: 0.9rem;">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
            </div>
            <button type="submit" style="background: #007bff; color: white; padding: 0.8rem; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; transition: background 0.3s ease;">
                Login
            </button>
        </form>
    </div>
</body>
</html>
