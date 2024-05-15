<?php
// Start session (if needed)
session_start();
include 'database.php';
// Dummy database connection
// Check if the form data is received
if (isset($_POST['email'], $_POST['password'], $_POST['username'], $_POST['confirmPassword'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate form data
    if (empty($email) || empty($password) || empty($username) || empty($confirmPassword)) {
        echo "All fields are required!";
    } elseif ($password !== $confirmPassword) {
        echo "Passwords do not match!";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists in the database
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Prepare the SQL query
        $getemail = "SELECT * FROM UserAccount WHERE Email = '$email'";
        
        // Execute the query
        $result = mysqli_query($conn, $getemail);
        
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            echo "Email already exists!";
        }else {
            // Insert the new user into the database
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $createuser = "INSERT INTO UserAccount (Username,Email,Password)VALUES('$username','$email','$hash')";
            try {
                mysqli_query($conn, $createuser);
                echo "Create successful!";
            } catch (error) {
                echo "fail!";
            }
        }
    }
} else {
    echo "Invalid request!";
}

// Close the database connection
$conn = null;
