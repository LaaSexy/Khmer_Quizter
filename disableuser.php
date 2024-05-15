<?php
// Assuming you have established a database connection
include "database.php";
// Query to fetch user data from the database

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["userid"])) {
    $userid = $_GET["userid"];

    // Fetch current status of the user
    $query = "SELECT Status FROM UserAccount WHERE UserID = $userid";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentStatus = $row['Status'];

        // Toggle the status
        $newStatus = ($currentStatus == 'disabled') ? 'enabled' : 'disabled';

        // Update the user's status in the database
        $updateQuery = "UPDATE UserAccount SET Status = '$newStatus' WHERE UserID = $userid";
        if (mysqli_query($conn, $updateQuery)) {
            echo "User status toggled successfully.";
        } else {
            echo "Error updating user status: " . mysqli_error($conn);
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
