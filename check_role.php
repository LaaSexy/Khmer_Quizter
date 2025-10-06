<?php
include "database/database.php";
session_start();

if (isset($_SESSION['Role'])) {
    $userRole = $_SESSION['Role'];
    echo $userRole;
} else {
    echo "Guest";
}
?>
