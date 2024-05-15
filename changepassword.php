<?php
include "database.php";
session_start();

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the necessary data (current_password and new_password) is provided
    if (isset($_POST["current_password"]) && isset($_POST["new_password"])) {
        // Retrieve the current password and new password from the POST data
        $currentPassword = $_POST["current_password"];
        $newPassword = $_POST["new_password"];
       
        $sql = "SELECT Password FROM UserAccount WHERE UserID = '{$_SESSION['UserID']}'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // User found, retrieve the password
            $row = $result->fetch_assoc();
            $storedPassword = $row["Password"];
            
            // Verify if the current password matches the stored password
            if (password_verify($currentPassword, $storedPassword)) {
                // Current password matches, proceed to update the password
                // Hash the new password before updating it in the database
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                
                // Update the password in the database
                $updateSql = "UPDATE UserAccount SET Password = '$hashedPassword' WHERE UserID = '{$_SESSION['UserID']}'";
                if ($conn->query($updateSql) === TRUE) {
                    echo "Password changed successfully";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                // Current password does not match the stored password
                echo "Current password does not match";
            }
        } else {
            // User not found
            echo "Error: User not found";
        }
    } else {
        // Current password or new password not provided
        echo "Error: Current password or new password not provided";
    }
} else {
    // Invalid request method
    echo "Error: Invalid request method";
}
?>
