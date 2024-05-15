<?php

session_start();

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "quizapp";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Error: Connection failed. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if QuizName, Quiztype, and image are set
    if (isset($_POST["QuizName"]) && isset($_POST["Quiztype"]) && isset($_FILES["image"])) {
        $QuizName = $_POST["QuizName"];
        $Quiztype = $_POST["Quiztype"];

        // Handle the image upload
        $file_name = $_FILES["image"]["name"];
        $file_temp = $_FILES["image"]["tmp_name"];
        $upload_dir = "uploads/"; // Change this to your desired directory
        $target_file = $upload_dir . basename($file_name);

        // Generate a unique quiz code
        function generateQuizCode($length = 6) {
            $characters = '0123456789';
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $code;
        }

        $quizCode = generateQuizCode();

        // Check if the generated quiz code already exists
        $sql = "SELECT COUNT(*) AS count FROM Quiz WHERE QuizCode = '$quizCode'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['count'] > 0) {
                // If the quiz code already exists, generate a new one
                $quizCode = generateQuizCode();
            }
        }

        // Move the uploaded image to the destination directory
        if (move_uploaded_file($file_temp, $target_file)) {
            // Insert quiz details into the database
            $createquiz = "INSERT INTO Quiz (QuizTitle, Type, CreatorID, Image, QuizCode) VALUES ('$QuizName', '$Quiztype', '{$_SESSION['UserID']}', '$target_file', '$quizCode')";
            if (mysqli_query($conn, $createquiz)) {
                $quizID = mysqli_insert_id($conn);
                $_SESSION['QuizID'] = $quizID;
                $_SESSION['quiz'] = $QuizName;

                // Get the number of questions associated with the quiz
                $sql = "SELECT COUNT(*) AS table_length FROM QuizQuestion WHERE QuizID = $quizID";
                $result = mysqli_query($conn, $sql);
                if ($result !== false) {
                    $row = mysqli_fetch_assoc($result);
                    $tableLength = (int)$row['table_length'];
                    $_SESSION['questionnum'] = $tableLength + 1;
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                echo "Create Success!";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Invalid request.";
    }
}

// Close the database connection
mysqli_close($conn);

?>
