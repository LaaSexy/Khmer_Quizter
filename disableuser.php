<?php
include "database/database.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["userid"])) {
    $userid = $_GET["userid"];
    $query = "SELECT Status FROM UserAccount WHERE UserID = $userid";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentStatus = $row['Status'];
        $newStatus = ($currentStatus == 'disabled') ? 'enabled' : 'disabled';
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

mysqli_close($conn);
?>
