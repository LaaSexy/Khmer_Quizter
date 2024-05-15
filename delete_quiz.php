<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the quiz ID is provided
    if (isset($_POST["quizId"])) {
        $quizId = $_POST["quizId"];
       
        try {
            $trydelete = "DELETE FROM Quiz WHERE QuizID = '$quizId'";
            $resulte = mysqli_query($conn, $trydelete);
        } catch (Exception $e) {
            // Handle the exception here
            echo "Error: " . $e->getMessage();
        }
        
        // If the first delete operation was successful or no exception occurred
        $getQuestionsQuery = "SELECT QuestionID FROM QuizQuestion WHERE QuizID = '$quizId'";
        $result = mysqli_query($conn, $getQuestionsQuery);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $questionid = $row['QuestionID'];
                $deleteanswer = "DELETE FROM Answers WHERE QuestionID = '$questionid'";
                $results = mysqli_query($conn, $deleteanswer);
                if ($results) {
                    $deletequestion = "DELETE FROM QuizQuestion WHERE QuizID = '$quizId'";
                    $resultss = mysqli_query($conn, $deletequestion);
                    if ($resultss) {
                        $deletequestions = "DELETE FROM Question WHERE Question = '$questionid'";
                        $resultsss = mysqli_query($conn, $deletequestions);
                        if ($resultsss) {
                            $deletequiz = "DELETE FROM Quiz WHERE QuizID = '$quizId'";
                            $deletescore = "DELETE FROM Score WHERE QuizID = '$quizId'";
                            $resulttt = mysqli_query($conn, $deletescore);
                            $resultssss = mysqli_query($conn, $deletequiz);
                            if ($resultssss && $resulttt) {
                                echo "Quiz deleted successfully!";
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                        }
                    }
                }
            }
        }
        
        
       
        
    } else {
        echo "Error: Quiz ID is missing.";
    }
} else {
    // Invalid request method
    echo "Error: Invalid request method.";
}
