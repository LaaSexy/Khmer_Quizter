<?php
include "database/database.php";

if (isset($_GET['code'])) {
    $quizCode = $_GET['code'];
    $query = "SELECT * FROM Quiz WHERE QuizCode = '$quizCode'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $quizID = $row['QuizID'];
            echo $quizID;
        } else {
            echo "not_exists";
        }
    } else {
        echo "error";
    }
    mysqli_close($conn);
} else {
    echo "missing_code";
}
