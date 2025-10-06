<?php
session_start();
include 'database.php';

if (isset($_POST['email'], $_POST['password'], $_POST['username'], $_POST['confirmPassword'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($email) || empty($password) || empty($username) || empty($confirmPassword)) {
        echo "All fields are required!";
    } elseif ($password !== $confirmPassword) {
        echo "Passwords do not match!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $email = mysqli_real_escape_string($conn, $email);
        $getemail = "SELECT * FROM UserAccount WHERE Email = '$email'";
        $result = mysqli_query($conn, $getemail);

        if ($result === false) {
            die("Database query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            echo "Email already exists!";
        } else {
            $createuser = "INSERT INTO UserAccount (Username,Email,Password) VALUES ('$username','$email','$hashedPassword')";
            if (mysqli_query($conn, $createuser)) {
                echo "Create successful!";
            } else {
                echo "Failed to create user: " . mysqli_error($conn);
            }
        }
    }
} else {
    echo "Invalid request!";
}

mysqli_close($conn);
?>
