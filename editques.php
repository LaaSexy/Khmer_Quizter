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
include_once "nav.php";
$quesid = $_GET['quesid'];
$editques = "SELECT * FROM Question  WHERE QuestionID = '$quesid'";
$result = mysqli_query($conn, $editques);
?>
<style>
    .back {
        background-color: white;
        color: #CE0037;
        border: none;
        font-size: 25px;
        font-weight: 700;
        padding: 10px 25px;
        transition: 0.2s;
        border-radius: 15px;
        box-shadow: 0 0 0.2rem black;
    }

    .back:hover {
        background-color: #CE0037;
        color: white;
        transition: 0.2s;
    }

    .quesss {
        box-shadow: 0 0 0.2rem black;
        padding: 25px;
        border-radius: 20px;
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

    .answer {
        display: flex;
        justify-content: center;
        align-items: center;
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

    .answer h4 {
        margin: 0;
        margin-right: 10px;

    }

    .answer i {
        font-size: 30px;
        margin-left: 10px;
        color: #CE0037;
    }

    .change {
        background-color: #CE0037;
        color: white;
        font-size: 25px;
        padding: 5px 20px;
        border: none;
        border-radius: 20px;
        font-weight: 700;
        box-shadow: 0 0 0.3rem black;
        transition: 0.2s;
    }

    .change:hover {
        background-color: white;
        color: #CE0037;
        transition: 0.2s;
    }

    input[type=number] {
        width: 40%;
    }

    .duration {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .duration h1 {
        margin: 0;
        margin-right: 10px;
    }

    @media screen and (max-width: 670px) {

        .questioning {
            width: 80%;
            margin: auto;
        }


    }
</style>
<div class="container mt-3 josefin-sans">
    <div class="row">
        <div class="col-12">
            <button class="back"><i class="bi bi-backspace-fill"></i> Back</button>
        </div>
    </div>
</div>
<div class="container quesss mt-3 josefin-sans">
    <div class="row">
        <div class="col-12">
            <div class="row">


                <?php
                if ($result) {
                    if ($row = mysqli_fetch_assoc($result)) {
                        $question = $row['Question'];
                        $duration = $row['Duration'];
                        echo "<div class='col-12 text-center my-4'><div class='questioning'><input type='text' value='$question' id='question'></div></div>";
                        echo "<div class='col-12 text-center my-4' style='display:none;'><div class='questioning'><input type='text'  value='$quesid' id='quesid'></div></div>";
                        echo "<div class='col-12 text-center my-4'><div class='questioning duration'><h1>Duration</h1><input type='number' value='$duration' id='time'></div></div>";
                        $getanswer = "SELECT * From Answers Where QuestionID = '$quesid'";
                        $resultt = mysqli_query($conn, $getanswer);
                        if ($resultt) {
                            $answers = 1;
                            while ($rows = mysqli_fetch_assoc($resultt)) {

                                $answer = $rows['Answer'];
                                $iscorrect = $rows['is_correct'];
                                $answerid = $rows['AnswerID'];
                                echo "<div class='col-12 col-md-6 mt-2 answer'><h4>Answer $answers </h4><input type='text' value='$answer' id='answer$answers'><input type='text' value='$answerid' style='display:none' id='answerid$answers'><input type='text' style='display:none;' class='correctbox' placeholder='Answer here' id='iscorrect$answers' value='$iscorrect'>
                                <i class='bi bi-check-square-fill correct-icon' data-answer='$answers'></i></div>";
                                $answers++;
                            }
                        }
                    }
                }

                ?>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <button class="change" id="change">Change</button>
        </div>
    </div>
</div>





<script>
    $(document).ready(function() {
        $('.back').click(function() {
            history.back();
        })
        $('.correctbox').each(function() {
            if ($(this).val() == 1) {
                $(this).siblings('.correct-icon').addClass('text-success');
            }
        });

        function handleCorrectIconClick(icon) {
            const answerNumber = icon.dataset.answer;
            const isCorrectInput = document.getElementById('iscorrect' + answerNumber);

            // If the icon is already checked (text-success class), uncheck it
            if (icon.classList.contains('text-success')) {
               
            } else {
                // Reset all icons to red
                document.querySelectorAll('.correct-icon').forEach(icon => {
                    icon.classList.remove('text-success');
                    icon.classList.add('text-danger');
                    document.getElementById('iscorrect' + icon.dataset.answer).value = '0'; // Set all iscorrect input values to 0
                });

                // Toggle color of clicked icon
                icon.classList.remove('text-danger');
                icon.classList.add('text-success');
                isCorrectInput.value = '1'; // Set iscorrect input value to 1
            }
        }



        document.querySelectorAll('.correct-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                // Call the function when an icon is clicked
                handleCorrectIconClick(this);
            });
        });


        document.getElementById("change").addEventListener("click", function(event) {
            event.preventDefault();
            console.log("change")
            var iscorrect1 = document.getElementById("iscorrect1") ? document.getElementById("iscorrect1").value : null;
            var iscorrect2 = document.getElementById("iscorrect2") ? document.getElementById("iscorrect2").value : null;
            var iscorrect3 = document.getElementById("iscorrect3") ? document.getElementById("iscorrect3").value : null;
            var iscorrect4 = document.getElementById("iscorrect4") ? document.getElementById("iscorrect4").value : null;
            var duration = document.getElementById("time").value;
            var question = document.getElementById("question").value;
            var quesid = document.getElementById("quesid").value;
            var answer1 = document.getElementById("answer1") ? document.getElementById("answer1").value : null;
            var answer2 = document.getElementById("answer2") ? document.getElementById("answer2").value : null;
            var answer3 = document.getElementById("answer3") ? document.getElementById("answer3").value : null;
            var answer4 = document.getElementById("answer4") ? document.getElementById("answer4").value : null;
            var answerid1 = document.getElementById("answerid1") ? document.getElementById("answerid1").value : null;
            var answerid2 = document.getElementById("answerid2") ? document.getElementById("answerid2").value : null;
            var answerid3 = document.getElementById("answerid3") ? document.getElementById("answerid3").value : null;
            var answerid4 = document.getElementById("answerid4") ? document.getElementById("answerid4").value : null;



            // Check conditions
            if ((iscorrect1 === "0" && iscorrect2 === "0" && iscorrect3 === "0" && iscorrect4 === "0") || !duration) {
                if (iscorrect1 === "0" && iscorrect2 === "0" && iscorrect3 === "0" && iscorrect4 === "0") {
                    alert("Please pick the correct answer.");
                }
                if (!duration) {
                    alert("The Duration can't be empty.");
                }
                return; // Stop further execution
            }

            var formData = new FormData();
            formData.append('question', question);
            formData.append('quesid', quesid);
            formData.append('answer1', answer1);
            formData.append('answer2', answer2);
            formData.append('answer3', answer3);
            formData.append('answer4', answer4);
            formData.append('answerid1', answerid1);
            formData.append('answerid2', answerid2);
            formData.append('answerid3', answerid3);
            formData.append('answerid4', answerid4);
            formData.append('iscorrect1', iscorrect1);
            formData.append('iscorrect2', iscorrect2);
            formData.append('iscorrect3', iscorrect3);
            formData.append('iscorrect4', iscorrect4);
            formData.append('duration', duration);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "updatequestion.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === "Update Success!") {
                            Swal.fire({
                                title: 'Update Successful!',
                                icon: 'success',
                                confirmButtonText: 'Confirm',
                                confirmButtonColor: 'green'
                            })

                        } else if (response === "Invalid request!") {
                            alert("Fail!");
                            Swal.fire({
                                title: 'Update Fail!',
                                icon: 'error',
                                confirmButtonText: 'Confirm',
                                confirmButtonColor: 'red'
                            })
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
        });

    })
</script>