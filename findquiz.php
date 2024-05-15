<?php
session_start();
include "database.php";

// Check if the user is not logged in
if (!isset($_SESSION['Username'])) {
    // Set default values for the session variables
    $_SESSION['Username'] = "Guest";
    $_SESSION['Email'] = "guest";
    $_SESSION['Role'] = 'Guest';
    $_SESSION['UserID'] = 11;
    $_SESSION['Profile'] = "https://media.valorant-api.com/agents/22697a3d-45bf-8dd7-4fec-84a9e28c69d7/displayicon.png";
}

// Redirect to admin page if user is an admin
if (isset($_SESSION['Role']) && $_SESSION['Role'] === "Admin") {
    header("Location: admin.php");
    exit;
}

$currentPage = 'findquiz.php';
include_once 'nav.php';
?>
<style>
    .find {
        box-shadow: 0 0 0.3rem black;
        padding: 20px;
        border-radius: 20px;
    }

    .meow {
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .meow i {
        font-size: 40px;
        color: #CE0037;
    }

    .meow input[type=text] {
        width: 30%;
        padding: 10px 30px;
        margin-left: 15px;
        border-radius: 10px;
        font-size: 20px;
        outline: none;
        border: 2px solid #ADADAD;
        font-weight: 700;
        transition: 0.3s;
    }

    .meow input[type=text]:focus {
        box-shadow: 0 0 0.3rem black;
        transition: 0.3s;
    }

    .meow input[type=submit] {
        margin-left: 10px;
        padding: 12px 25px;
        border-radius: 15px;
        color: white;
        background-color: #CE0037;
        font-size: 20px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
        box-shadow: 0 0 0.3rem black;
    }

    .meow input[type=submit]:hover {
        background-color: white;
        color: #CE0037;
        transition: 0.3s;
    }

    .card {
        box-shadow: 0 0 0.15rem black;
        width: 100%;
    }

    .image-container {
        border-radius: 20px;
        max-width: 310px;
        max-height: 180px;
        min-height: 200px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        /* Center horizontally */
        align-items: center;
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

    .detail {
        background-color: rgba(37, 37, 37, 0.445);
        position: fixed;
        top: 0;
        height: 100%;
        z-index: 10;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        display: none;

    }

    .carde {
        transition: 0.3s;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        border-radius: 20px;
    }

    .carde:hover {
        cursor: pointer;
        transform: translateY(-10px);
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        transition: 0.3s;
    }

    .detail .image-container {
        max-width: 500px;
    }

    .titlle {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .titlle i {
        font-size: 20px;
        color: red;
    }

    .titlle i:hover {
        color: #CE0037;
    }


    .play {
        padding: 7px 30px;
        border: none;
        font-size: 30px;
        font-weight: 700;
        background-color: #63FF72;
        color: #02760E;
        border-radius: 25px;
        box-shadow: 0 0 0.3rem black;
        transition: 0.3s;
    }

    .play:hover {
        background-color: #C5FFCA;
        transition: 0.3s;
    }

    .plays {
        background-color: #FFCEDB;
        color: #CE0037;
        text-align: center;
        width: 40%;
        padding: 5px 10px;
        border-radius: 10px;
    }

    .rawr {
        justify-content: space-between;
        align-items: center;
    }

    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 15;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal content */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
        text-align: center;

        /* Could be more or less, depending on screen size */
    }

    /* Close button */
    .close {
        text-align: left;
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    #copyIcon:hover {
        cursor: pointer;
    }

    .carde:hover {
        cursor: pointer;
    }

    .leaderbutton {
        padding: 5px 20px;
        border: none;
        background-color: #CE0037;
        color: white;
        border-radius: 20px;
        font-weight: 600;
        transition: 0.3s;
    }

    .leaderbutton:hover {
        color: #CE0037;
        transition: 0.3s;
        background-color: #FFCEDB;
    }

    @media screen and (max-width: 670px) {
        .image-container {
            max-width: 500px;
            max-height: 200px;
            min-height: 200px;
            overflow: hidden;
        }

        .meow input[type=text] {
            width: 100%;
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
<div id="notificationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="notificationMessage"></p>
    </div>
</div>
<div class="detail">



    <div class='col-xxl-3 col-lg-4 col-md-6 col-12 text-center'>
        <div class='card card-display'>
            <div class='titlle pt-3 px-3 d-flex'>
                <h5 class='card-title text-start quiztitle josefin-sans'>$Quiztitle</h5>
                <i class="bi bi-x-square-fill josefin-sans close"></i>
            </div>

            <div class='image-container'>
                <img src='uploads/222.jpg' class='images' alt=''>
            </div>
            <div class='card-body contentbody'>

                <div class="col-12 d-flex rawr">
                    <div class='text-start authorr josefin-sans'>By $Author</div>
                    <h6 class='authorname plays'></h6>
                </div>
                <div class='text-start quizcodee josefin-sans'>By $Author</div>
                <div class='text-start numofques josefin-sans'></div>
                <button type="button" class="leaderbutton josefin-sans">Leaderboard</button><br>
                <button type="button" class="play josefin-sans my-3" data-quiz=""> <i class="bi bi-play-fill"></i> Play</button>
            </div>
        </div>
    </div>

</div>
<div class="container find mt-3">
    <div class="row">
        <form action='findquiz.php' method="POST">
            <div class="col-12 meow text-center py-5">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="josefin-sans" placeholder="Search Quiz Name">
                <input type="submit" class="josefin-sans" value="Search">
            </div>
        </form>

    </div>
</div>
<div class="container">
    <div class="row">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $keyword = $_POST['search'];
            $query = "SELECT Quiz.*, UserAccount.*
            FROM Quiz 
            JOIN UserAccount ON Quiz.CreatorID = UserAccount.UserID 
            LEFT JOIN (
                SELECT QuizID, COUNT(*) AS question_count
                FROM QuizQuestion
                GROUP BY QuizID
            ) AS QuestionCount ON Quiz.QuizID = QuestionCount.QuizID
            WHERE QuizTitle LIKE ? AND question_count > 0;
            ";
            $keyword = "%$keyword%";
            $stmt = mysqli_prepare($conn, $query);

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "s", $keyword);

            // Execute statement
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);
            $numRows = mysqli_num_rows($result);
            // Check if any rows were returned
            if (mysqli_num_rows($result) > 0) {
                // Fetch and display the rows
                echo "<div class='col-12 mt-3'><h2>$numRows Quiz Found.</h2></div>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $QuizID = $row['QuizID'];
                    $QuizCode = $row['QuizCode'];
                    $Quiztitle = $row['QuizTitle'];
                    $Author = $row['Username'];
                    $image = $row['Image'];
                    $play = $row['Play'];
                    $getquestionamount = "SELECT QuestionID from QuizQuestion where QuizID = '$QuizID'";
                    $resultt = mysqli_query($conn, $getquestionamount);
                    if ($resultt) {
                        $numQues = mysqli_num_rows($resultt);
                    }
                    echo "<div class='col-xxl-3 col-lg-4 col-md-6 mt-3 text-center'>
             <div class='card carde'>
              <input type='text' style='display:none' value='$QuizCode'>
             <input type='text' style='display:none' value='$QuizID'>
             <input type='text' style='display:none' value='$numQues'>
             <input type='text' style='display:none' value='$play'>
             <div class='image-container'>";
                    echo " <img src='$image' class='images' alt=''></div>";
                    echo " <div class='card-body'>
            <h5 class='card-title text-start quiztitles'>$Quiztitle</h5>
            <h6 class='text-start mrauthor'>By $Author</h6>
            <h6 class='plays'>$play plays</h6>
        </div></div></div>";
                }
            } else {
                echo "<h2 class='mt-3'>No quiz found.</h2>";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('.carde').click(function() {
            var quizcode = $(this).children().eq(0).val();
            var quizid = $(this).children().eq(1).val();
            var numofques = $(this).children().eq(2).val();
            var image = $(this).children().eq(4).children().eq(0).attr("src");
            var titles = $(this).find('.quiztitles').html();
            var author = $(this).find('.mrauthor').html(); // Corrected line
            var play = $(this).children().eq(3).val();
            console.log(quizcode + quizid + image + titles, author);
            $('.detail').fadeIn(300);
            $('.detail').css('display', 'flex')
            $('.detail .quiztitle').html(titles)
            $('.detail img').attr("src", image)
            $('.detail .authorr').html(author)
            $('.detail .plays').html(play + " plays");
            $('.detail .quizcodee').html("QuizCode : " + "<span id='quizCode'>" + quizcode + "</span>" + " <i class='bi bi-copy' id='copyIcon'></i>")
            $('.detail .numofques').html(numofques + " Ques")
            $('.detail .play').attr("data-quiz", quizid)
            $('.detail .play').click(function() {
                var url = "play.php?quizid=" + quizid;
                window.location.href = url;
            })
            $('.detail .leaderbutton').click(function() {
                var url = "leaderboard.php?scorequiz=" + quizid;
                window.location.href = url;
            })
            $('.close').click(function() {
                $('.detail').fadeOut(300);
            })
            // Display notification message in modal
            function displayNotification(message) {
                var modal = document.getElementById("notificationModal");
                var notificationMessage = document.getElementById("notificationMessage");
                notificationMessage.innerHTML = message;
                modal.style.display = "block";

                // Close the modal when the user clicks on the close button
                var closeButton = document.getElementsByClassName("close")[0];
                closeButton.onclick = function() {
                    modal.style.display = "none";
                }

                // Close the modal after 3 seconds
                setTimeout(function() {
                    modal.style.display = "none";

                }, 1000); // 3000 milliseconds = 3 seconds
            }

            // Example usage:


            document.getElementById('copyIcon').addEventListener('click', function() {
                // Select the text inside the span element
                var quizCode = document.getElementById('quizCode');
                var range = document.createRange();
                range.selectNode(quizCode);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);

                // Copy the selected text to the clipboard
                document.execCommand('copy');

                // Remove the selection from the document
                window.getSelection().removeAllRanges();

                // Alert the user or perform any other action
                displayNotification("Quiz code copied");

            });
        });
    })
</script>