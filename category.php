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

$currentPage = 'home.php';
include_once 'nav.php';
?>
<style>
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

    .detail .image-container {
        max-width: 500px;
    }

    .carde {
        transition: 0.3s;
        border-radius: 20px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    .carde:hover {
        cursor: pointer;
        transform: translateY(-10px);
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
        transition: 0.3s;
    }

    .quiztitle {
        font-weight: 700;
        font-size: 30px;
    }

    .titlle {
        align-items: center;
        justify-content: space-between;
    }

    .titlle i {
        font-size: 30px;
        color: red;
    }

    .close:hover {
        cursor: pointer;
        color: #CE0037;
    }

    .numofques {
        background-color: #D9D9D9;
        color: #515151;
        width: 20%;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        padding-top: 3px;
    }

    .contentbody div {
        margin: 8px 0;
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

    .card-display {
        border-radius: 20px;

    }

    .createaccountnoti {
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(37, 37, 37, 0.445);
        height: 100%;
        display: none;
    }

    .createaccountnoti .row {
        width: 30%;
        margin: auto;
        background-color: white;
        text-align: center;
        padding: 20px;
        border-radius: 20px;
    }

    .signuptext {
        font-size: 15px;
    }

    .signinbtn button {
        background-color: #CE0037;
        color: white;
        font-size: 20px;
        padding: 5px 25px;
        border-radius: 10px;
        font-weight: 700;
        border: none;
        box-shadow: 0 0 0.3rem black;
        transition: 0.3s;
    }

    .signinbtn button:hover {
        background-color: white;
        color: #CE0037;
        transition: 0.3s;
    }

    .closehere i {
        font-size: 30px;
        color: red;
    }

    .closehere i:hover {
        color: #CE0037;
        cursor: pointer;
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

    .viewmorebtn {
        padding: 5px 20px;
        background-color: #FFCEDB;
        color: #CE0037;
        border: 2px solid #CE0037;
        border-radius: 10px;
        font-weight: 700;
    }

    .image-container {
        max-width: 310px;
        max-height: 180px;
        min-height: 200px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px 5px 0 0;
        border-radius: 20px;
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

    @media screen and (max-width: 670px) {
        .image-container {
            max-width: 500px;
            max-height: 200px;
            min-height: 200px;
            overflow: hidden;
        }

        .box {
            width: 100%;
        }

        .createaccountnoti .row {
            width: 100%;
        }

        .join {
            padding-left: 0;
            padding-right: 0;
        }
    }

    @media screen and (max-width: 994px) {
        .image-container {
            max-width: 500px;
            max-height: 200px;
            min-height: 200px;
            overflow: hidden;
        }

        .createaccountnoti .row {
            width: 60%;
        }

        .box {
            width: 80%;
        }
    }

    @media screen and (max-width: 1400px) {
        .image-container {
            max-width: 600px;
            max-height: 200px;
            min-height: 200px;
            overflow: hidden;
        }

        .card {
            margin-top: 20px;
        }

        .pagetitle {
            padding-top: 20px;
            padding-bottom: 0;
        }


    }
</style>
<?php

function displayQuizzes($conn, $type, $part)
{
    $displayQuery = "SELECT Quiz.*, UserAccount.*, COUNT(QuizQuestion.QuestionID) AS question_count 
    FROM Quiz 
    JOIN UserAccount ON Quiz.CreatorID = UserAccount.UserID 
    LEFT JOIN QuizQuestion ON Quiz.QuizID = QuizQuestion.QuizID
    WHERE Type = '$type'
    GROUP BY Quiz.QuizID
    HAVING question_count > 0;
    ";
    $result = mysqli_query($conn, $displayQuery);

    if ($result) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        shuffle($rows);
        $count = 0;

        if (count($rows) > 0) {
            echo "<div class='show'id='$part'>";
            echo "<div class='row mt-3 josefin-sans card-title' >
            <div class='d-flex justify-content-between'>
            <h1>$type</h1>
            </div>
           
    </div>
    <div class='row cards'>";
            foreach ($rows as $row) {

                $QuizID = $row['QuizID'];
                $Quiztitle = $row['QuizTitle'];
                $Author = $row['Username'];
                $image = $row['Image'];
                $QuizCode = $row['QuizCode'];
                $play = $row['Play'];
                $getquestionamount = "SELECT QuestionID from QuizQuestion where QuizID = '$QuizID'";
                $resultt = mysqli_query($conn, $getquestionamount);
                if ($resultt) {
                    $numRows = mysqli_num_rows($resultt);
                }
                echo "<div class='col-xxl-3 mt-3 col-lg-4 col-md-6 col-12 text-center'>
                 
                     <div class='card carde'>
                     <input type='text' style='display:none' value='$QuizCode'>
                     <input type='text' style='display:none' value='$QuizID'>
                     <input type='text' style='display:none' value='$numRows'>
                     <input type='text' style='display:none' value='$play'>
                      <div class='image-container'>";
                echo " <img src='$image' class='images' alt=''></div>";
                echo " <div class='card-body'>
                <h5 class='card-title text-start quiztitles'>$Quiztitle</h5>
                <h6 class='text-start authorname'>By $Author</h6>
                <h6 class=' authorname plays'>$play plays</h6>
            </div></div></div>";
                $count++;
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "";
        }
    } else {
        echo "";
    }
}
$type = $_GET['Type'];
$part = $_GET['Part'];

?>
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

                <div class='text-start quizcodee josefin-sans'>123</div>
                <div class='text-start numofques josefin-sans'></div>
                <button type="button" class="leaderbutton josefin-sans">Leaderboard</button><br>
                <button type="button" class="play josefin-sans my-3" data-quiz=""> <i class="bi bi-play-fill"></i> Play</button>
            </div>
        </div>
    </div>




</div>
<div class="quizes container">
    <div class="col-12 button"><button type='button'><i class="bi bi-backspace-fill"></i> Leave</button></div>
    <?php
    displayQuizzes($conn, $type, $part)

    ?>
</div>
<?php

include_once "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".closehere i").click(function() {
            $('.createaccountnoti').fadeOut(300)
        })

        $('.carde').click(function() {
            var quizcode = $(this).children().eq(0).val();
            var quizid = $(this).children().eq(1).val();
            var numofques = $(this).children().eq(2).val();
            var image = $(this).children().eq(4).children().eq(0).attr("src");
            var titles = $(this).find('.quiztitles').html();
            var author = $(this).find('.authorname').html(); // Corrected line
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

            function displayNotification(message) {
                var modal = document.getElementById("notificationModal");
                var notificationMessage = document.getElementById("notificationMessage");
                notificationMessage.innerHTML = message;
                modal.style.display = "block";
                var closeButton = document.getElementsByClassName("close")[0];
                closeButton.onclick = function() {
                    modal.style.display = "none";
                }
                setTimeout(function() {
                    modal.style.display = "none";
                }, 1000);
            }
            document.getElementById('copyIcon').addEventListener('click', function() {
                var quizCode = document.getElementById('quizCode');
                var range = document.createRange();
                range.selectNode(quizCode);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand('copy');
                window.getSelection().removeAllRanges();
                displayNotification("Quiz code copied");

            });
        });
        $('.detail .quizcodee i').click(function() {
            $(this).select();
            document.execCommand('copy');
            alert('Text copied to clipboard');
        });
        $('.show').eq(0).show();
        $('.show').eq(1).fadeIn(500);
        $('#changepf').click(function() {
            window.location = "changepf.php";
        })
        $('.createquiz').click(function() {
            $.ajax({
                type: "GET",
                url: "check_role.php",
                success: function(response) {
                    if (response === "Guest") {
                        Swal.fire({
                            title: 'Unable to create quiz!',
                            text: 'Sign in to create quiz',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonText: 'Sign in',
                            cancelButtonText: 'back',
                            confirmButtonColor: '#3085d6'
                        }).then((result) => {
                            if (result.value) {
                                window.location = "index.php";
                            } else {

                            }

                        });
                    } else {
                        window.location = "create.php";
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    })
    var currentIndex = 0;
    $('.button').click(function() {
        history.back();
    })
    $(window).scroll(function() {
        var windowHeight = $(window).height();
        var documentHeight = $(document).height() - 400;
        var scrollTop = $(window).scrollTop();
        if (scrollTop + windowHeight >= documentHeight) {
            if (currentIndex < $('.show').length) {
                $('.show').eq(currentIndex).fadeIn(700);
                currentIndex++;
            }


        }
    });
</script>