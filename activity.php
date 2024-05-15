<?php
session_start();
include "database.php";

// Check if the user is not logged in
if (!isset($_SESSION['Username'])) {
    // Set default values for the session variables
    header("Location: index.php");
    exit;
}
if ($_SESSION['Username'] === "Guest") {
    header("Location: index.php");
    exit;
}
// Redirect to admin page if user is an admin
if (isset($_SESSION['Role']) && $_SESSION['Role'] === "Admin") {
    header("Location: admin.php");
    exit;
}

$currentPage = 'activity.php';
include_once 'nav.php';

$UserID = $_SESSION['UserID'];
$getactivity = "SELECT Quiz.QuizTitle,Quiz.Play,Score.UserID,Score.QuizID,Username, Quiz.Image, MAX(Score) AS MaxScore, MAX(Date) AS LastDate
FROM Score
JOIN Quiz on Score.QuizID = Quiz.QuizID JOIN UserAccount on Score.UserID = UserAccount.UserID WHERE Score.UserID = '$UserID'
GROUP BY QuizID;


;

";

$result = mysqli_query($conn, $getactivity);
?>
<style>
    .card {
        box-shadow: 0 0 0.15rem black;
        width: 100%;
        border-radius: 20px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    .image-container {
        border-radius: 20px;
        max-width: 310px;
        max-height: 200px;
        min-height: 200px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        /* Center horizontally */
        align-items: center;
    }

    .plays {
        background-color: #FFCEDB;
        color: #CE0037;
        text-align: center;
        width: 40%;
        padding: 5px 10px;
        border-radius: 10px;
    }

    .image-container img {
        border-radius: 20px;
        border-radius: 5px 5px 0 0;
        width: 100%;
        /* Make sure the image doesn't exceed the container width */
        height: 100%;
        /* Make sure the image doesn't exceed the container height */
        display: block;
        /* Ensure the image is displayed as a block element */

    }

    @media screen and (max-width: 670px) {
        .image-container {
            max-width: 500px;
            max-height: 200px;
            min-height: 200px;
            overflow: hidden;
        }

    }

    @media screen and (max-width: 1400px) {
        .image-container {
            max-width: 600px;
            max-height: 200px;
            min-height: 200px;
            overflow: hidden;
        }
    }
</style>
<div class="container">
    <div class="row">
        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $QuizID = $row['QuizID'];
                $Quiztitle = $row['QuizTitle'];
                $Author = $row['Username'];
                $image = $row['Image'];
                $score = $row['MaxScore'];
                $play = $row['Play'];
                $getquestionamount = "SELECT QuestionID from QuizQuestion where QuizID = '$QuizID'";
                $resultt = mysqli_query($conn, $getquestionamount);
                if ($resultt) {
                    $numRows = mysqli_num_rows($resultt);
                    if ($score > $numRows) {
                        $score = $numRows;
                    }
                }
                echo "<div class='col-xxl-3 col-lg-4 col-md-6 mt-5 text-center ccc'>
         <div class='card'> <div class='image-container'>";
                echo " <img src='$image' class='images' alt=''></div>";
                echo " <div class='card-body'>
        <h5 class='card-title text-start'>$Quiztitle</h5>
        <h6 class='plays'>$play plays</h6>
        <h6 class='text-start'>Completed with <span style='color:green'>$score/$numRows</span></h6>
    </div></div></div>";
            }
        }
        ?>
    </div>
</div>