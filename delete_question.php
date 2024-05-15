<?php
include "database.php";
session_start();

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the necessary data (quesid) is provided
    if (isset($_POST["quesid"])) {
        $quesid = $_POST["quesid"];

        // Prepare and execute the SQL queries using prepared statements
        $sql = "DELETE FROM Answers WHERE QuestionID = ?";
        $delsql = "DELETE FROM QuizQuestion WHERE QuestionID = ?";
        $dellast = "DELETE FROM Question WHERE QuestionID = ?";

        // Use prepared statements to prevent SQL injection
        $stmt1 = mysqli_prepare($conn, $sql);
        $stmt2 = mysqli_prepare($conn, $delsql);
        $stmt3 = mysqli_prepare($conn, $dellast);

        if ($stmt1 && $stmt2 && $stmt3) {
            mysqli_stmt_bind_param($stmt1, "s", $quesid);
            mysqli_stmt_bind_param($stmt2, "s", $quesid);
            mysqli_stmt_bind_param($stmt3, "s", $quesid);

            // Execute the prepared statements
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_execute($stmt3);

            // Check if any rows were affected
            if (mysqli_affected_rows($conn) > 0) {
                echo "Question and associated data deleted successfully";
                
            } else {
                echo "No records found for the provided question ID";
            }
        } else {
            echo "Error: Unable to prepare SQL statements";
        }

        // Close the prepared statements
        mysqli_stmt_close($stmt1);
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt3);
    } else {
        echo "Error: Question ID not provided";
    }
} else {
    echo "Error: Invalid request method";
}
