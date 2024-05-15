<?php
include "database.php";

// Check if the quiz code parameter is provided
if (isset($_GET['code'])) {
    $quizCode = $_GET['code'];

    // Perform a database query to check if the quiz code exists
    // Replace 'your_table_name' with the actual table name where quiz codes are stored
    $query = "SELECT * FROM Quiz WHERE QuizCode = '$quizCode'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if the quiz code exists in the database
        if (mysqli_num_rows($result) > 0) {
            // Quiz code exists, fetch the QuizID
            $row = mysqli_fetch_assoc($result);
            $quizID = $row['QuizID'];
            // Return the QuizID
            echo $quizID;
        } else {
            // Quiz code does not exist
            echo "not_exists";
        }
    } else {
        // Query failed
        echo "error";
    }


    // Close the database connection
    mysqli_close($conn);
} else {
    // Quiz code parameter not provided
    echo "missing_code";
}
