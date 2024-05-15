<?php
// Include your database connection code here
include_once "database.php";

// Check if quizid parameter is provided
if (isset($_GET['quizid'])) {
    // Sanitize input to prevent SQL injection
    $quizid = mysqli_real_escape_string($conn, $_GET['quizid']);

    // Query to fetch questions for the given quiz ID
    $query = "SELECT * FROM QuizQuestion Join Question on QuizQuestion.QuestionID= Question.QuestionID join Answers on Answers.QuestionID = Question.QuestionID WHERE quizid = '$quizid'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $questions = array();
        while ($row = mysqli_fetch_assoc($result)) {
            // If the question is not already in the array, add it
            if (!isset($questions[$row['QuestionID']])) {
                $questions[$row['QuestionID']] = array(
                    'question_id' => $row['QuestionID'],
                    'question_text' => $row['Question'],
                    'duration'=> $row['Duration'],
                    'answers' => array()
                );
            }
            // Add the answer to the question's answers array
            $questions[$row['QuestionID']]['answers'][] = array(
                'answer_text' => $row['Answer'],
                'iscorrect' => $row['is_correct']
            );
        }

        // Convert the questions array to JSON and output it
        echo json_encode(array_values($questions));
    } else {
        // Query failed
        echo json_encode(array('error' => 'Failed to fetch questions'));
    }
} else {
    // quizid parameter is missing
    echo json_encode(array('error' => 'Quiz ID parameter is missing'));
}

// Close the database connection
mysqli_close($conn);
