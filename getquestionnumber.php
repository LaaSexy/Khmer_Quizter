
<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["quizid"])) {
        $quizid = $_GET["quizid"];

        // Query to get the number of questions for the specified quizid
        $query = "SELECT COUNT(*) AS num_questions FROM QuizQuestion WHERE QuizID = '$quizid'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $tableLength = $row["num_questions"];
            echo $tableLength + 1; // Return the table length to JavaScript
        } else {
            echo "0"; // Return 0 if no questions found or an error occurred
        }
    } else {
        echo "Error: Quiz ID not provided.";
    }
} else {
    echo "Invalid request.";
}
