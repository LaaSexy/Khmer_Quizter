<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "quizapp";
$conn = "";

try {
    $conn = mysqli_connect(
        $db_server,
        $db_user,
        $db_pass,
        $db_name
    );


    if ($conn) {
    } else {
        echo "Error Connection";
    }
} catch (mysqli_sql_exception) {
    echo "Maybe the server is offline?";
}
