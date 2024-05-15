<?php
// Start session
session_start();
include "database.php"; // Include your database connection script

// Check if username and password are provided
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Prepare and execute the query to fetch user data based on the provided email
    $stmt = $conn->prepare("SELECT * FROM UserAccount WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided email exists
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc(); // Fetch user data

        // Verify the password
        if (password_verify($password, $user['Password'])) {
            // Authentication successful
            if ($user['Status'] === "Enable" || $user['Status'] === "enabled") {
                $_SESSION['UserID'] = $user['UserID'];
                $_SESSION['Username'] = $user['Username'];
                $_SESSION['Email'] = $user['Email'];
                $_SESSION['Role'] = $user['Role'];
                $_SESSION['Profile'] = $user['Profile']; // Assuming you have a column named 'id' for the user in your table
                echo "Login successful!";
            } else {
                echo "Account Disabled!";
            }
        } else {
            // Authentication failed
            echo "Invalid username or password!";
        }
    } else {
        // User with the provided email does not exist
        echo "Email doesn't exist!";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request
    echo "Invalid request!";
}
