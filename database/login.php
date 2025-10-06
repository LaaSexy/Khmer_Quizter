<?php
session_start();
include "database.php"; 

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM UserAccount WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc(); 
        if (password_verify($password, $user['Password'])) {
            if ($user['Status'] === "Enable" || $user['Status'] === "enabled") {
                $_SESSION['UserID'] = $user['UserID'];
                $_SESSION['Username'] = $user['Username'];
                $_SESSION['Email'] = $user['Email'];
                $_SESSION['Role'] = $user['Role'];
                $_SESSION['Profile'] = $user['Profile']; 
                echo "Login successful!";
            } else {
                echo "Account Disabled!";
            }
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "Email doesn't exist!";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request!";
}
