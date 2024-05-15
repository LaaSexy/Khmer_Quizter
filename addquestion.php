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

$currentPage = 'myquiz.php';
// include_once 'nav.php';
$quizid = $_GET['quizid'];
$_SESSION['QuizID'] = $quizid;
$selectquiz = "SELECT * FROM Quiz where QuizID = '$quizid'";
$result = mysqli_query($conn, $selectquiz);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $quiztitle = $row['QuizTitle'];
        $getquestionamount = "SELECT QuestionID from QuizQuestion where QuizID = '$quizid'";
        $resultt = mysqli_query($conn, $getquestionamount);
        if ($resultt) {
            $numQues = mysqli_num_rows($resultt);
        }
?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="icon" type="image/png" href="logo.png">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

            .josefin-sans {
                font-family: "Josefin Sans", sans-serif;
                font-optical-sizing: auto;
                font-style: normal;
            }

            .questioning {
                width: 40%;
                margin: auto;
            }

            .questioning h1 {
                font-size: 25px;
            }

            .questioning input {
                width: 100%;
                background-color: #D9D9D9;
                font-size: 20px;
                border-radius: 5px;
                border: none;
                outline: none;
                padding: 10px 25px;
            }

            .answer h1 {
                font-size: 25px;
                margin-right: 10px;
            }

            .answer {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .answer input {
                width: 70%;
                background-color: #D9D9D9;
                font-size: 20px;
                border-radius: 5px;
                border: none;
                outline: none;
                padding: 10px 25px;
            }

            .answer i {
                font-size: 30px;
                margin-left: 10px;
                color: #CE0037;
            }

            .duration {
                justify-content: center;
                align-items: center;
                margin-top: 2%;
            }

            .duration h1 {
                margin: 0;
                margin-right: 10px;
            }

            .duration input {
                width: 50%;
            }

            .answer i:hover {
                cursor: pointer;
            }

            nav {
                background-color: #D9D9D9;
                padding: 20px;
                box-shadow: 0 0 0.3rem black;
            }

            .leave {
                font-size: 30px;
                font-weight: 700;
                color: white;
                background-color: #CE0037;
                padding: 5px 20px;
                border: none;
                border-radius: 20px;
                transition: 0.3s;
                box-shadow: 0 0 0.3rem black;
            }

            .leave:hover {
                color: #CE0037;
                background-color: white;
                transition: 0.3s;
            }

            .main {
                box-shadow: 0 0 0.2rem black;
                padding: 20px;
                border-radius: 20px;
            }

            #finish {
                /* display: none; */
                background-color: #63FF72;
                margin-right: 25px;
                color: white;

            }

            #finish:hover {
                background-color: #9EFFA8;
                color: #02760E;
            }

            @media screen and (max-width: 670px) {

                .questioning {
                    width: 80%;
                    margin: auto;
                }

                .answer h1 {
                    font-size: 15px;
                    margin-bottom: 0;
                }

            }
        </style>
        <nav>
            <button class="leave leaveBtn josefin-sans"><i class="bi bi-backspace-fill"></i> Leave</button>
        </nav>
        <form class="mrquestion">
            <div class="container main mt-5">
                <div class="row py-3">
                    <div class="col-12">
                        <h1 class="text-end px-4 ques"></h1>
                    </div>
                    <div class="col-12 text-center">

                        <h1 id="session-quiz" class="josefin-sans"><?php echo $quiztitle ?></h1>
                        <h2 class="josefin-sans">Creating a question</h2>
                    </div>
                    <div class="col-12 text-center questioning josefin-sans mt-3">
                        <h1 class="text-start">Question</h1>
                        <input type="text" placeholder="Question here" id='question'>
                        <div class="duration d-flex">
                            <h1>Duration</h1><input type="number" id="time" value="30">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-xxl-6 col-sm-12 answer text-center josefin-sans mt-3">
                            <h1 class="text-start">Answer 1 : </h1>
                            <input type="text" placeholder="Answer here" id="answer1">
                            <input type="text" style="display:none;" placeholder="Answer here" id="iscorrect1" value="0">
                            <i class="bi bi-check-square-fill correct-icon" data-answer="1"></i>
                        </div>
                        <div class="col-xxl-6 col-sm-12 answer text-center josefin-sans mt-3">
                            <h1 class="text-start">Answer 2 :</h1>
                            <input type="text" placeholder="Answer here" id="answer2">
                            <input type="text" style="display:none;" placeholder="Answer here" id="iscorrect2" value="0">
                            <i class="bi bi-check-square-fill correct-icon" data-answer="2"></i>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-xxl-6 col-sm-12 answer text-center josefin-sans mt-3">
                            <h1 class="text-start">Answer 3 : </h1>
                            <input type="text" placeholder="Answer here" id="answer3">
                            <input type="text" style="display:none;" placeholder="Answer here" id="iscorrect3" value="0">
                            <i class="bi bi-check-square-fill correct-icon" data-answer="3"></i>
                        </div>
                        <div class="col-xxl-6 col-sm-12 answer text-center josefin-sans mt-3">
                            <h1 class="text-start">Answer 4 :</h1>
                            <input type="text" placeholder="Answer here" id="answer4">
                            <input type="text" style="display:none;" placeholder="Answer here" id="iscorrect4" value="0">
                            <i class="bi bi-check-square-fill correct-icon" data-answer="4"></i>
                        </div>
                    </div>


                </div>
            </div>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="text" style="display: none;" value="<?php echo $quizid ?>" id="getquiz">
                        <button class="leave josefin-sans finish" id="finish" type="button">Finish <i class="bi bi-check-all"></i></button>
                        <button class="leave createquestion josefin-sans" id="createquestion">Create <i class="bi bi-check-square-fill"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
     
        <script>
            $(document).ready(function() {
           

                getTableLength();
                document.querySelectorAll('.correct-icon').forEach(icon => {

                    icon.addEventListener('click', function() {
                        const answerNumber = this.dataset.answer;
                        const isCorrectInput = document.getElementById('iscorrect' + answerNumber);

                        // If the icon is already checked (text-success class), uncheck it
                        if (this.classList.contains('text-success')) {
                            this.classList.remove('text-success');
                            this.classList.add('text-danger');
                            isCorrectInput.value = '0'; // Set iscorrect input value to 0
                        } else {
                            // Reset all icons to red
                            document.querySelectorAll('.correct-icon').forEach(icon => {
                                icon.classList.remove('text-success');
                                icon.classList.add('text-danger');
                                document.getElementById('iscorrect' + icon.dataset.answer).value = '0'; // Set all iscorrect input values to 0
                            });

                            // Toggle color of clicked icon
                            this.classList.remove('text-danger');
                            this.classList.add('text-success');
                            isCorrectInput.value = '1'; // Set iscorrect input value to 1
                        }



                    });
                });
                document.getElementById("createquestion").addEventListener("click", function(event) {
                    event.preventDefault();
                    var iscorrect1 = document.getElementById("iscorrect1").value;
                    var iscorrect2 = document.getElementById("iscorrect2").value;
                    var iscorrect3 = document.getElementById("iscorrect3").value;
                    var iscorrect4 = document.getElementById("iscorrect4").value;
                    var duration = document.getElementById("time").value;
                    var question = document.getElementById("question").value;
                    if (!question) {
                        Swal.fire({
                            title: 'Invalid Question!',
                            text: "Question can't be empty",
                            icon: 'error',
                            confirmButtonText: 'I understand',
                            confirmButtonColor: 'red'
                        })
                        return
                    }
                    var answer1 = document.getElementById("answer1").value;
                    var answer2 = document.getElementById("answer2").value;
                    var answer3 = document.getElementById("answer3").value;
                    var answer4 = document.getElementById("answer4").value;

                    if ((answer1 === "" && answer2 === "" && answer3 === "") ||
                        (answer1 === "" && answer2 === "" && answer4 === "") ||
                        (answer1 === "" && answer3 === "" && answer4 === "") ||
                        (answer2 === "" && answer3 === "" && answer4 === "")) {
                        Swal.fire({
                            title: 'Insufficient answers!',
                            text: "Please provide at least 2 answers",
                            icon: 'error',
                            confirmButtonText: 'I understand',
                            confirmButtonColor: 'red'
                        });
                        return;
                    }
                    // If none of the iscorrect inputs are set to 1, show alert and stop form submission
                    if (iscorrect1 === "0" && iscorrect2 === "0" && iscorrect3 === "0" && iscorrect4 === "0") {
                        Swal.fire({
                            title: 'No correct answer!',
                            text: 'Please pick the correct answer',
                            icon: 'error',
                            confirmButtonText: 'I understand',
                            confirmButtonColor: 'red'
                        })
                    } else if (!duration) {
                        Swal.fire({
                            title: 'Invalid Duration!',
                            text: "The Duration can't be empty",
                            icon: 'error',
                            confirmButtonText: 'I understand',
                            confirmButtonColor: 'red'
                        })
                    } else {
                        event.preventDefault();


                        var formData = new FormData();

                        formData.append('question', question);
                        formData.append('answer1', answer1);
                        formData.append('answer2', answer2);
                        formData.append('answer3', answer3);
                        formData.append('answer4', answer4);
                        formData.append('iscorrect1', iscorrect1);
                        formData.append('iscorrect2', iscorrect2);
                        formData.append('iscorrect3', iscorrect3);
                        formData.append('iscorrect4', iscorrect4);
                        formData.append('duration', duration);

                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "addques.php", true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4) {
                                if (xhr.status === 200) {
                                    var response = xhr.responseText;
                                    if (response === "Create Success!") {
                                 


                                        getTableLength();
                                    } else if (response === "Invalid request!") {
                                        alert("Fail!");
                                    } else if (response === "Error uploading image.") {
                                        alert("Error uploading image.");
                                    } else {
                                        console.log(response);
                                    }
                                } else {
                                    alert("Error occurred: " + xhr.status);
                                }
                            }
                        };

                        xhr.send(formData);
                    }


                });
                $('.leaveBtn').click(function() {
                    window.location = "home.php";
                })

                function getTableLength() {
                    var xhr = new XMLHttpRequest();
                    var quizid = $('#getquiz').val(); // Assuming you have an element with the id 'getquiz' that contains the quizid
                    xhr.open("GET", "getquestionnumber.php?quizid=" + quizid, true); // Include quizid in the URL
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var tableLength = xhr.responseText;
                            if (tableLength == 1) {
                                $('.ques').html("Question " + tableLength);
                            } else {
                                $('.ques').html("Question " + tableLength);
                                $('#finish').show();
                                $('#question').val("");
                                $('#answer1').val("");
                                $('#answer2').val("");
                                $('#answer3').val("");
                                $('#answer4').val("");
                                $('#iscorrect1').val("0");
                                $('#iscorrect2').val("0");
                                $('#iscorrect3').val("0");
                                $('#iscorrect4').val("0");
                                $('.correct-icon').removeClass("text-success").addClass("text-danger");
                            }
                        }
                    };
                    xhr.send();
                }
                $('#finish').click(function() {
                    window.location = "myquiz.php";
                })

            })
        </script>

<?php

        $_SESSION['questionnum'] = $numQues + 1;
    }
}
?>