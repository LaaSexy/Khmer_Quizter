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
    header("Location: record.php");
    exit;
}

$currentPage = 'myquiz.php';
include_once 'nav.php';
?>
<style>
    .card {
        border-radius: 20px;
        box-shadow: 0 0 0.15rem black;
        width: 100%;
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

    .image-container img {
        border-radius: 20px;
        width: 100%;
        /* Make sure the image doesn't exceed the container width */
        height: 100%;
        /* Make sure the image doesn't exceed the container height */
        display: block;
        /* Ensure the image is displayed as a block element */

    }

    .ccc {
        display: none;
    }

    .plays {
        background-color: #FFCEDB;
        color: #CE0037;
        text-align: center;
        width: 40%;
        padding: 5px 10px;
        border-radius: 10px;
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

    .rawr {
        justify-content: space-between;
        align-items: center;
    }

    .modals {
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
    .modal-contents {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
        text-align: center;

        /* Could be more or less, depending on screen size */
    }

    .carde:hover {
        cursor: pointer;
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

    .edit {
        text-align: center;
        margin: 0;
        width: 30%;
        background-color: yellow;
        padding: 5px 10px;
        border-radius: 15px;
        transition: 0.2s;
    }

    .edit:hover {
        cursor: pointer;
        background-color: black;
        color: yellow;
        transition: 0.2s;
    }

    .delques {
        margin: 0;
        background-color: red;
        color: white;
        padding: 5px 15px;
        border-radius: 15px;
        transition: 0.2s;
        box-shadow: 0 0 0.1rem black;

    }

    .delques:hover {
        cursor: pointer;
        background-color: white;
        color: red;
        transition: 0.2s;

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
<div id="notificationModal" class="modals">
    <div class="modal-contents">
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
                <div class="col-12 d-flex rawr">
                    <div class='text-start quizcodee josefin-sans'>By $Author</div>
                    <h6 class='authorname edit'>Edit Quiz</h6>
                </div>
                <div class="col-12 d-flex rawr mt-1">
                    <div class='text-start numofques josefin-sans'></div>
                    <h6 class='authorname delques'>Delete Quiz</h6>
                </div>
                <button type="button" class="leaderbutton josefin-sans">Leaderboard</button><br>
                <button type="button" class="play josefin-sans my-3" data-quiz=""> <i class="bi bi-play-fill"></i> Play</button>
            </div>
        </div>
    </div>

</div>

<div class="container ">
    <div class="row">




        <?php
        $displayquestion = "SELECT * FROM Quiz JOIN UserAccount ON Quiz.CreatorID = UserAccount.UserID where UserID = {$_SESSION['UserID']} ";

        // Execute the query
        $result = mysqli_query($conn, $displayquestion);

        // Check if the query was successful
        if ($result) {
            // Display the result
            while ($row = mysqli_fetch_assoc($result)) {
                $QuizID = $row['QuizID'];
                $Quiztitle = $row['QuizTitle'];
                $QuizCode = $row['QuizCode'];
                $Author = $row['Username'];
                $image = $row['Image'];
                $play = $row['Play'];
                $getquestionamount = "SELECT QuestionID from QuizQuestion where QuizID = '$QuizID'";
                $resultt = mysqli_query($conn, $getquestionamount);
                if ($resultt) {
                    $numQues = mysqli_num_rows($resultt);
                }
                echo "<div class='col-xxl-3 col-lg-4 col-md-6 mt-5 text-center ccc'>
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
            // Query failed
            echo "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);

        ?>


    </div>
</div>
<br><br><br><br><br>
<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {

        $('.ccc').fadeIn(700)
        $('.carde').click(function() {
            var thiscard = $(this).parent();
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
            $('.detail .edit').click(function() {
                var url = "edit.php?quizid=" + quizid;
                window.location.href = url;
            })
            $('.detail .delques').click(function() {
                Swal.fire({
                    title: 'Delete Quiz!',
                    text: 'Do you want to delete this quiz?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: 'red'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'POST',
                            url: 'delete_quiz.php', // Adjust the URL to your delete_quiz.php endpoint
                            data: {
                                quizId: quizid
                            }, // Pass the quiz ID to the server
                            success: function(response) {
                                thiscard.remove()
                                $('.detail').fadeOut();
                            },
                            error: function(xhr, status, error) {
                                // Handle errors
                                console.error(error);
                            }

                        });
                    } else {
                        // User clicked "No" or outside the modal
                        // Perform any alternative action or do nothing
                    }
                });




            });

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
    });
</script>

<?php
include_once "footer.php";
?>