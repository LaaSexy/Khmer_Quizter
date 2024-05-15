<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are set
    if (isset($_POST["question"]) && isset($_POST["answer1"]) && isset($_POST["answer2"])) {
        // Retrieve form data
        $question = mysqli_real_escape_string($conn, $_POST['question']);
        $answer1 = isset($_POST['answer1']) ? mysqli_real_escape_string($conn, $_POST['answer1']) : '';
        $answer2 = isset($_POST['answer2']) ? mysqli_real_escape_string($conn, $_POST['answer2']) : '';
        $answer3 = isset($_POST['answer3']) ? mysqli_real_escape_string($conn, $_POST['answer3']) : '';
        $answer4 = isset($_POST['answer4']) ? mysqli_real_escape_string($conn, $_POST['answer4']) : '';
        $iscorrect1 = $_POST['iscorrect1'];
        $iscorrect2 = $_POST['iscorrect2'];
        $iscorrect3 = $_POST['iscorrect3'];
        $iscorrect4 = $_POST['iscorrect4'];
        $duration = $_POST['duration'];

        // Insert question into the database
        $createQuestionQuery = "INSERT INTO Question (Question, Duration) VALUES ('$question', '$duration')";
        if (mysqli_query($conn, $createQuestionQuery)) {
            $QuizID = $_SESSION['QuizID'];
            $QuestionID = mysqli_insert_id($conn);
            $inserting = "INSERT INTO quizquestion (QuizID,QuestionID) VALUES ('$QuizID','$QuestionID')";
            if (mysqli_query($conn, $inserting)) {
            }
            // Insert answers into the database
            $answers = array($answer1, $answer2, $answer3, $answer4);
            $isCorrectFlags = array($iscorrect1, $iscorrect2, $iscorrect3, $iscorrect4);
            for ($i = 0; $i < count($answers); $i++) {
                // Check if the answer is not empty before inserting
                if (!empty($answers[$i])) {
                    $isCorrect = $isCorrectFlags[$i] == '1' ? 1 : 0;
                    $insertAnswerQuery = "INSERT INTO Answers (QuestionID, Answer, is_correct) VALUES ('$QuestionID', '$answers[$i]', '$isCorrect')";
                    mysqli_query($conn, $insertAnswerQuery);
                }
            }
            echo "Create Success!";
        } else {
            echo "Error: " . $createQuestionQuery . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: Incomplete form data.";
    }
} else {
    echo "Invalid request.";
}
?>
