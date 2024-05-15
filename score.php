<?php
include "database.php";
session_start();

// Check if the required parameters are set
if (isset($_GET['score']) && isset($_GET['UserID']) && isset($_GET['quizid'])) {
    // Sanitize input data
    $score = mysqli_real_escape_string($conn, $_GET['score']);
    $UserID = mysqli_real_escape_string($conn, $_GET['UserID']);
    $QuizID = mysqli_real_escape_string($conn, $_GET['quizid']);
    
    // Prepare and execute the SQL query
    $addScore = "INSERT INTO Score (QuizID, UserID, Score) VALUES ('$QuizID', '$UserID', '$score')";
    $result = mysqli_query($conn, $addScore);

    // Check if the query was successful
    if ($result) {
        // Return a success response
        echo json_encode(array('success' => true));
        $_SESSION['UserID'] = $UserID;
        $addplays= "UPDATE Quiz SET Play = Play + 1 WHERE QuizID = '$QuizID'";
        $add = mysqli_query($conn,$addplays);
        if($add){

        }
        else{
            
        }
    } else {
        // Return an error response
        echo json_encode(array('error' => 'Failed to add score to the database'));
    }
} else {
    // Return an error response if required parameters are missing
    echo json_encode(array('error' => 'Required parameters are missing'));
}
?>
