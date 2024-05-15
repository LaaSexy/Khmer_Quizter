<?php
include_once "database.php";
session_start();
if (!isset($_SESSION['Username'])) {
    $_SESSION['Username'] = "Guest";
    $_SESSION['Email'] = "guest";
    $_SESSION['Role'] = 'Guest';
    $_SESSION['Profile'] = "https://media.valorant-api.com/agents/22697a3d-45bf-8dd7-4fec-84a9e28c69d7/displayicon.png";
}
if (isset($_SESSION['Role']) === "Admin") {
    header("Location: record.php");
    exit;
}
$currentPage = 'home.php';
include_once 'nav.php';
if (isset($_GET['quizid'])) {
    $quizid = $_GET['quizid'];
} else {
    header("Location: home.php");
    exit;
}
?>
<style>
    .mainn {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .main2 {
        display: block;
    }

    .maining {
        box-shadow: 0 0 0.3rem black;
        border-radius: 15px;
        margin-top: 50px;
        /* display: none; */
    }

    .image-container {
        max-width: 310px;
        max-height: 180px;
        min-height: 200px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 20px;
        margin: 20px;
        border: #CE0037 5px solid;
    }

    .image-container img {
        border-radius: 5px 5px 0 0;
        width: 100%;
        height: 100%;
        display: block;
    }

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

    .plays h1 {
        background-color: #FFCEDB;
        font-size: 15px;
        text-align: center;
        padding: 10px 10px;
        border-radius: 10px;
        color: #CE0037;
    }

    .plays {
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .creator h1 {
        font-size: 20px;
    }

    .ques h1 {
        background-color: #D9D9D9;
        font-size: 15px;
        text-align: center;
        padding: 10px 10px;
        border-radius: 10px;
        color: #515151;
    }

    .ques {
        display: flex;
        justify-content: left;
        align-items: center;
    }

    .start {
        margin-bottom: 50px;
    }

    .start button {
        background-color: #63FF72;
        color: #02760E;
        border: none;
        padding: 8px 30px;
        font-size: 30px;
        font-weight: 700;
        border-radius: 15px;
        transition: 0.3s;
        box-shadow: 0 0 0.3rem black;
    }

    .start button:hover {
        background-color: #C5FFCA;
        transition: 0.3s;
    }

    .quiztitle {
        text-wrap: nowrap;
    }

    .showing {
        box-shadow: 0 0 0.3rem black;
        border-radius: 15px;
        margin-top: 40px;
        display: none;
    }

    .congrats {
        box-shadow: 0 0 0.3rem black;
        border-radius: 15px;
        display: none;
    }

    .image2 {
        max-width: 100px;
        max-height: 180px;
        min-height: 20px;
    }

    .answerbutton button {
        padding: 10px 50px;
        width: 100%;
        font-size: 20px;
        background-color: #FFCEDB;
        border: none;
        color: #CE0037;
        border-radius: 10px;
        margin: 20px;
        transition: 0.3s;
        font-weight: 700;
    }

    .answerbutton button:hover {
        background-color: #CE0037;
        color: #FFCEDB;
        transition: 0.3s;
    }

    #questionContainer {
        font-size: 25px;
        margin-top: 20px;
    }

    #answerContainer {
        margin-bottom: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .main3 {
        width: 50%;
        margin: auto;
    }

    .congratss h1 {
        font-size: 20px;
        color: #515151;
    }

    .view {
        border: none;
        padding: 10px 30px;
        background-color: #CE0037;
        color: white;
        border-radius: 10px;
        font-weight: 700;
        font-size: 20px;
        margin-bottom: 50px;
        box-shadow: 0 0 0.3rem black;
        transition: 0.3s;

    }

    .button-trov button {
        background-color: #63FF72;
        color: #02760E;
    }

    .button-trov button:hover {
        background-color: #63FF72;
        color: #02760E;
    }

    .button-khos button {
        background-color: red;
        color: white;
    }

    .button-khos button:hover {
        background-color: red;
        color: white;
    }

    .view:hover {
        background-color: white;
        color: #CE0037;
        transition: 0.3s;

    }
    #questionContainer{
        user-select: none;
    }


    @media screen and (max-width: 1400px) {
        .quiztitle {
            text-align: center;
        }

        .creator {
            text-align: center;
        }

        .ques {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
</style>
<div class="container maining josefin-sans">
    <div class="row">
        <div class="col-12 button"><button type='button'><i class="bi bi-backspace-fill backk"></i> Leave</button></div>
        <div class="col-12 text-center mainn">
            <?php
            $getquiz = "SELECT * From Quiz join UserAccount on Quiz.CreatorID = UserAccount.UserID where QuizID = '$quizid'";
            $result = mysqli_query($conn, $getquiz);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // Quiz code exists, fetch the QuizID
                    $row = mysqli_fetch_assoc($result);
                    $QuizTitle = $row['QuizTitle'];
                    $Creator = $row['Username'];
                    $Image = $row['Image'];
                    $play = $row['Play'];
                    // Return the QuizID
                    $getquestionamount = "SELECT QuestionID from QuizQuestion where QuizID = '$quizid'";
                    $resultt = mysqli_query($conn, $getquestionamount);
                    if ($resultt) {
                        $numRows = mysqli_num_rows($resultt);
                    }
            ?>


                    <div class="image-container">
                        <img src="<?php echo $Image; ?>">
                    </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-xxl-2 col-12 quiztitle">
                    <h1><?php echo $QuizTitle ?></h1>
                </div>
                <div class="col-3">

                </div>
                <div class="col-xxl-2 col-12 plays">
                    <h1><?php echo $play  ?> plays</h1>
                </div>
                <div class="col-2">

                </div>
            </div>
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-xxl-2 col-12 creator">
                    <h1>By <?php echo $Creator ?></h1>
                </div>
                <div class="col-3">

                </div>
                <div class="col-3">

                </div>
                <div class="col-1">

                </div>
            </div>
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-xxl-2 col-12 ques">
                    <h1><?php echo $numRows ?> Ques</h1>
                </div>
                <div class="col-3">

                </div>
                <div class="col-3">

                </div>
                <div class="col-1">

                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center start">
                    <button type='button ' id="startButton"> <i class="bi bi-play-fill"></i> Start</button>
                </div>
            </div>
    <?php



                } else {
                    // Quiz code does not exist
                    echo "not_exists";
                }
            }
    ?>
        </div>
    </div>
</div>
<div class="container showing josefin-sans">
    <div class="row">
        <div class="col-12 button"><button type='button'><i class="bi bi-backspace-fill"></i> Leave</button></div>
        <div class="col-12 mainn">
            <div class="image-container image2">
                <img src="<?php echo $Image; ?>">
            </div>
            <h1><?php echo $QuizTitle ?></h1>
        </div>
        <div class="col-12 text-center">
            <h3 id="questionNumber"></h3>
        </div>
        <div class="col-12 timer text-center">

        </div>
        <div class="col-12 text-center  ">
            <h1 id="questionContainer"></h1>
        </div>
        <div class="row mt-5" id="answerContainer">

            <!-- <div class="col-3 answer1">
                <h1>a</h1>
            </div>
            <div class="col-3 answer2">
                <h1>b</h1>
            </div>
            <div class="col-3 answer3">
                <h1>c</h1>
            </div>
            <div class="col-3 answer4">
                <h1>d</h1>
            </div> -->
        </div>
    </div>
</div>
<div class="congrats container josefin-sans mt-4">
    <div class="row">
        <div class="col-12 button"><button type='button'><i class="bi bi-backspace-fill"></i> Leave</button></div>
        <div class="col-12 mainn main2 text-center">
            <div class="image-container main3">
                <img src="<?php echo $Image; ?>">
            </div>
            <h1 class="mt-3"><?php echo $QuizTitle ?></h1>
        </div>
        <div class="col-12 text-center congratss">
            <h1>Congratulation you completed the quiz!</h1>
        </div>
        <div class="col-12 text-center congratss">
            <h1 class='yourscore'></h1>
        </div>
        <div class="col-12 text-center congratss">

            <a type="button" class="view" href="leaderboard.php?scorequiz=<?php echo $quizid; ?>"><i class="fa-solid fa-chart-simple"></i> View Leaderboard</a>


        </div>
    </div>

</div>
<script>
    var currentQuestionIndex = 0;
    var score = 0;
    var questions; // Define 'questions' outside of any function scope
    $(document).ready(function() {
        var timer; // Variable to store the timer

        $('.button button').click(function() {
            window.location = "home.php";
        });

        $('#startButton').click(function() {
            console.log('hello');
            score = 0;
            if (document.fullscreenEnabled) {
                // Enter fullscreen mode
                var element = document.documentElement; // Fullscreen the entire document
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    /* Firefox */
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullscreen) {
                    /* Chrome, Safari and Opera */
                    element.webkitRequestFullscreen();
                } else if (element.msRequestFullscreen) {
                    /* IE/Edge */
                    element.msRequestFullscreen();
                }
            }
            $('.maining').hide();
            $('.showing').show();
            startQuiz();

        });

        // Function to start the quiz
        function startQuiz() {
            $.ajax({
                url: 'fetch_question.php',
                method: 'GET',
                data: {
                    quizid: '<?php echo $quizid; ?>'
                },
                success: function(response) {
                    questions = JSON.parse(response);
                    console.log(questions);
                    currentQuestionIndex = 0; // Initialize current question index
                    displayQuestion(currentQuestionIndex); // Display the first question
                    startTimer(questions[currentQuestionIndex].duration); // Start the timer for the first question
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while fetching questions. Please try again later.');
                }
            });

        }

        // Function to start the timer
        function startTimer(time) {
            var correctAnswer = $('#answerContainer').find('[data-answer="1"]');
            var timeLeft = time // Initial time (in seconds)
            timer = setInterval(function() {
                $('.timer').text('Time left: ' + timeLeft + ' seconds');
                timeLeft--; // Decrement time left

                // Check if time is up
                if (timeLeft < 0) {
                    correctAnswer.addClass("button-trov")
                    clearInterval(timer); // Stop the timer
                    setTimeout(function() {
                        displayNextQuestion();
                    }, 2000);
                }
            }, 1000); // Update timer every 1 second
        }

        // Function to display the next question
        function displayNextQuestion() {
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                displayQuestion(currentQuestionIndex);
                startTimer(questions[currentQuestionIndex].duration);
            } else {
                $('.congrats').show();
                $('.showing').hide();
                $('.yourscore').html("Your Score : <span class='text-success'>" + score + "/" + currentQuestionIndex + "</span>")
                $.ajax({
                    url: 'score.php', // URL to the script that fetches questions from the database
                    method: 'GET',
                    data: {
                        score: score,
                        UserID: '<?php echo $_SESSION['UserID'] ?>',
                        quizid: '<?php echo $quizid; ?>',

                    }, // Pass quizid to identify the quiz
                    success: function(response) {
                        // alert("success")
                        $('.congrats').show();
                        $('.showing').hide();
                        $('.yourscore').html("Your Score : <span class='text-success'>" + score + "/" + currentQuestionIndex + "</span>")

                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An error occurred while fetching questions. Please try again later.');
                    }
                });
            }
        }


        // Function to display a question and its answers
        function displayQuestion(index) {
            var question = questions[index];
            // startTimer(parseInt(question.duration));
            // Get the length of the total questions
            var totalQuestions = questions.length;

            // Get the index of the current question
            var currentQuestionNumber = index + 1;

            // Display the current question number and total number of questions
            $('#questionNumber').text('Question ' + currentQuestionNumber + ' of ' + totalQuestions);

            $('#questionContainer').html(question.question_text); // Display question text
            $('#answerContainer').html(''); // Clear previous answers
            question.answers.forEach(function(answer) {
                // Append a button for each answer
                $('#answerContainer').append("<div class='col-xxl-3 col-lg-4 col-md-6 col-12 text-center answerbutton' data-answer='" + answer.iscorrect + "'><button>" + answer.answer_text + "</button></div>");

            });
            checkAnswer(); // Attach click event listener after displaying the answers
        }

        // Function to check the selected answer
        function checkAnswer(selectedAnswer) {
            $('.answerbutton').off('click').on('click', function() { // Remove previous click event handlers before attaching a new one
                var selectedAnswer = $(this).data('answer');
                var correctAnswer = $('#answerContainer').find('[data-answer="1"]');
                var clickedAnswer = $(this);
                clearInterval(timer);
                console.log("click");
                if (selectedAnswer === 1) {
                    clickedAnswer.addClass("button-trov");
                    score++;
                    console.log(score);
                    setTimeout(function() {
                        if (currentQuestionIndex < questions.length) {
                            displayNextQuestion();
                        } else {}
                    }, 2000);
                } else {
                    clickedAnswer.addClass("button-khos")
                    correctAnswer.addClass("button-trov")
                    setTimeout(function() {
                        displayNextQuestion();
                    }, 2000);
                }
            });
        }
    });
</script>