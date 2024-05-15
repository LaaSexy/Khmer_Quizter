<?php
include "database.php";
session_start();

// Assuming you have stored the user's role in the session under the key 'Role'
if (isset($_SESSION['Role'])) {
    // Retrieve the user's role from the session
    $userRole = $_SESSION['Role'];

    // Return the user's role as the response
    echo $userRole;
} else {
    // If the user's role is not set in the session, assume it's Guest
    echo "Guest";
}
?>
