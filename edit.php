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
if ($_SESSION['Role'] !== "Admin") {
    $currentPage = 'myquiz.php';
    include_once "nav.php";
} else {
    $currentPage = 'quizes.php';
    include_once "nav2.php";
}


$quizid = $_GET['quizid'];
$amountofques = "SELECT QuestionID from QuizQuestion where QuizID = '$quizid'";
$result = mysqli_query($conn, $amountofques);
if ($result) {
    $numQues = mysqli_num_rows($result);
}

$getquizquestion = "SELECT * from Quiz Where QuizID = '$quizid'";
$resultquiz = mysqli_query($conn, $getquizquestion);
if ($resultquiz) {
    while ($row = mysqli_fetch_assoc($resultquiz)) {
        $QuizTitle = $row['QuizTitle'];
    }
}
?>
<style>
    .quiz {
        box-shadow: 0 0 0.2rem black;
        padding: 20px;
        border-radius: 15px;
        background-color: #FFCEDB;

    }

    .quiz h1 {
        font-weight: 800;
    }

    .eques {
        box-shadow: 0 0 0.2rem black;
        padding: 20px;
        border-radius: 15px;
    }

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

    .addquestion {
        padding: 5px 20px;
        font-size: 25px;
        font-weight: 700;
    }

    .back:hover {
        background-color: #CE0037;
        color: white;
        transition: 0.2s;
    }

    .edit {
        background-color: yellow;

    }
</style>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <button class="back"><i class="bi bi-backspace-fill"></i> Back</button>
        </div>
    </div>
</div>
<div class="container quiz mt-3 josefin-sans">
    <div class="row">
        <div class='col-12 text-center'>
            <h1>
                <?php
                echo $QuizTitle;
                ?>
            </h1>
            <input type="text" id="quizidhere" value="<?php echo $quizid ?>" style="display:none">
        </div>
    </div>

</div>
<div class="container py-2 josefin-sans">
    <div class="row">
        <div class="col-12">
            <h2>
                <?php
                echo $numQues;
                ?>
                Questions
            </h2>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Question</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="understoodBtn">Delete</button>
            </div>
        </div>
    </div>
</div>



<div class="container josefin-sans">
    <div class="row">


        <?php
        $getallquestion = "SELECT * from QuizQuestion join Question on QuizQuestion.QuestionID = Question.QuestionID where QuizID = '$quizid'";
        $resultquestion = mysqli_query($conn, $getallquestion);
        if ($resultquestion) {
            $index = 1;
            while ($row = mysqli_fetch_assoc($resultquestion)) {
                $question = $row['Question'];
                $questionid = $row['QuestionID'];
                echo " <div class='col-12 text-start eques my-3'><h3>";
                echo $index . ". ";
                echo $question;

                echo " </h3><button class='edit btn btn-warning mx-2'>Edit</button><button class='delete btn btn-danger' >Delete</button> <input type='text' value='$questionid' style='display:none'><input type='text' id='quizid' value='$quizid' style='display:none'></div>";
                $index++;
            }
        }


        ?>
    </div>
    <div class="row text-center mt-3 josefin-sans">
        <div class="col-12"><button class="addquestion btn btn-success"><i class="bi bi-plus-circle-fill"></i> Add Question</button></div>
    </div>
</div>
<br><br><br><br>
<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="confirmDialog.js"></script>
<script>
    $(document).ready(function() {



        $('.back').click(function() {
            history.back();
        })
        $('.addquestion').click(function() {
            var quizid = $("#quizidhere").val();
            console.log(quizid)
            var url = "addquestion.php?quizid=" + quizid;
            window.location.href = url;
        })
        $('.eques .edit').click(function() {
            var quesid = $(this).siblings().eq(2).val();
            console.log(quesid)
            var url = "editques.php?quesid=" + quesid;
            window.location.href = url;
        })
        $('.delete').click(function() {
            var quesid = $(this).siblings().eq(2).val()
            var QuizID = $(this).siblings().eq(3).val()
            // console.log(quesid);
            Swal.fire({
                title: 'Delete Question!',
                text: 'Do you want to delete this quesion?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.value) {
                    var formData = new FormData();
                    formData.append('quesid', quesid);
                    formData.append('quizid', QuizID); // Corrected field name

                    $.ajax({
                        type: 'POST',
                        url: 'delete_question.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Handle the response from the server
                            console.log(response);
                            // alert("Question Deleted!")
                            window.location.reload();
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



        })
    })
</script>