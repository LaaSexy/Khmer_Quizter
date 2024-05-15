<?php
include "database.php";
session_start();
$currentPage = 'home.php';
include_once "nav.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $QuizID = $_GET['scorequiz'];
    $query = "SELECT *,
    COUNT(*) AS PlayCount,
     MAX(Score) AS MaxScore
    FROM Quiz 
    JOIN Score ON Quiz.QuizID = Score.QuizID 
    JOIN UserAccount ON Score.UserID = UserAccount.UserID 
    WHERE Quiz.QuizID = '$QuizID' 
    GROUP BY UserAccount.UserID, UserAccount.UserName
    ORDER BY MaxScore DESC;";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result); // Fetch the first row
        if ($row) { // Check if a row was fetched
?>
            <style>
                .button button {
                    padding: 10px 30px;
                    font-size: 25px;
                    border: none;
                    border-radius: 15px;
                    font-weight: 700;
                    background-color: #CE0037;
                    color: white;
                    margin: 20px;
                    transition: 0.3s;
                    box-shadow: 0 0 0.3rem black;
                }

                .button button:hover {
                    background-color: white;
                    color: #CE0037;
                    transition: 0.3s;
                }

                .image-container {
                    max-width: 310px;
                    max-height: 180px;
                    min-height: 200px;
                    overflow: hidden;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: grey;
                    margin: auto;
                    border: #CE0037 5px solid;
                }

                .image-container img {
                    border-radius: 5px 5px 0 0;
                    width: 100%;
                    height: 100%;
                    display: block;
                }

                .container {
                    background-color: white;
                    box-shadow: 0 0 0.2rem black;
                    border-radius: 20px;
                    margin-top: 5%;
                }

                .ttitle h1 {
                    font-size: 25px;
                }

                .table {
                    max-height: 250px;
                    overflow-y: scroll;
                }
            </style>
            <div class="container">
                <div class="row">
                    <div class="col-12 button"><button type='button'><i class="bi bi-backspace-fill"></i> Leave</button></div>
                    <div class="col-12">
                        <div class="image-container">
                            <img src="<?php echo $row['Image'] ?>">
                        </div>
                    </div>
                    <div class="col-12 text-center ttitle">
                        <h1><?php echo $row['QuizTitle'] ?></h1>
                    </div>
                    <div class="col-12 table">
                        <table class="table text-center table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Rank</th>
                                    <th>Player's Name</th>
                                    <th>Score</th>
                                    <th>Attempt</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $rank = 1;
                                do {
                                ?>
                                    <tr>
                                        <td><?php echo $rank; ?></td>
                                        <td><?php echo $row['Username']; ?></td>
                                        <td><?php
                                            $score = $row['MaxScore'];
                                            $getquestionamount = "SELECT QuestionID from QuizQuestion where QuizID = '$QuizID'";
                                            $resultt = mysqli_query($conn, $getquestionamount);
                                            if ($resultt) {
                                                $numRows = mysqli_num_rows($resultt);
                                                if ($score > $numRows) {
                                                    $score = $numRows;
                                                }
                                            }

                                            echo $score;



                                            ?></td>
                                        <td><?php echo $row['PlayCount']; ?></td>
                                        <td><?php echo $row['Date']; ?></td>
                                    </tr>
                                <?php
                                    $rank++; // Increment rank
                                } while ($row = mysqli_fetch_assoc($result));
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php

        } else {
        ?>
            <style>
                .button button {
                    padding: 10px 30px;
                    font-size: 25px;
                    border: none;
                    border-radius: 15px;
                    font-weight: 700;
                    background-color: #CE0037;
                    color: white;
                    margin: 20px;
                    transition: 0.3s;
                    box-shadow: 0 0 0.3rem black;
                }

                .button button:hover {
                    background-color: white;
                    color: #CE0037;
                    transition: 0.3s;
                }

                .image-container {
                    max-width: 310px;
                    max-height: 180px;
                    min-height: 200px;
                    overflow: hidden;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: grey;
                    margin: auto;
                    border: #CE0037 5px solid;
                }

                .image-container img {
                    border-radius: 5px 5px 0 0;
                    width: 100%;
                    height: 100%;
                    display: block;
                }

                .container {
                    background-color: white;
                    box-shadow: 0 0 0.2rem black;
                    border-radius: 20px;
                    margin-top: 5%;
                }

                .ttitle h1 {
                    font-size: 25px;
                }

                .table {
                    height: 250px;
                    overflow-y: scroll;
                }
            </style>
            <div class="container josefin-sans">
                <div class="row">
                    <div class="col-12 button"><button type='button'><i class="bi bi-backspace-fill"></i> Leave</button></div>
                    <h1 class="text-center">No user have took this quiz yet.</h1>
                </div>
            </div>
<?php
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
    }
}
?>
<script>
    $('.button').click(function() {
        history.back();
    })
</script>