
<?php
session_start();
include "database/database.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["quizid"])) {
        $quizid = $_GET["quizid"];
        $query = "SELECT COUNT(*) AS num_questions FROM QuizQuestion WHERE QuizID = '$quizid'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $tableLength = $row["num_questions"];
            echo $tableLength + 1;
        } else {
            echo "0"; 
        }
    } else {
        echo "Error: Quiz ID not provided.";
    }
} else {
    echo "Invalid request.";
}
