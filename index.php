<?php
session_start();
if (isset($_SESSION['Username'])) {
   header("location:home.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>SenQuiz</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

    .josefin-sans {
        font-family: "Josefin Sans", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    body {
        background-image: url(background.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
    }

    .black {
        background-color: black;
        position: fixed;
        background-size: cover;
        width: 100%;
        height: 100%;
        opacity: 0.7;
        color: transparent;
        z-index: -1;
    }

    .logo img {
        width: 100px;
    }

    .logo {
        text-align: center;
        align-items: center;
    }

    .main {
        z-index: 1;

    }

    .buttons button {
        margin: 0 20px;
        border-radius: 20px;
        background-color: transparent;
        border: none;
        color: white;
        font-size: 30px;
        font-weight: 700;
        padding: 10px 20px;
        transition: 0.3s;
    }

    .buttons button:hover {
        color: #CE0037;
        transition: 0.3s;
    }

    .buttons button.active {
        background-color: #CE0037;
    }

    .buttons button.active:hover {
        color: #CE0037;
        background-color: white;
    }



    .username {
        position: relative;
        display: inline-block;
        width: 400px;
        /* Ensure the container takes up only the space it needs */
    }

    .username input[type=text],
    .username input[type=password] {
        width: 100%;
        outline: none;
        border: none;
        font-size: 30px;
        border-radius: 30px;
        padding: 10px 40px;
        /* Adjust padding as needed */
        padding-left: 70px;
        padding-top: 15px;
        background-color: rgba(255, 255, 255, 0.487);
        transition: 0.3s;
    }

    .username input[type=text]:focus+i,
    .username input[type=password]:focus+i {
        transform: translateY(-60%);
        transition: 0.3s;
    }

    .username input[type=text]:focus,
    .username input[type=password]:focus {
        transform: translateY(-5px);
        transition: 0.3s;
        box-shadow: rgba(255, 255, 255, 0.2) 0px 7px 29px 0px;

    }

    .guest {
        background-color: white;
        color: #CE0037;
        padding: 5px 15px;
        margin-top: 20px;
        border-radius: 10px;
    }

    ::placeholder {
        color: rgb(37, 37, 37);
    }

    .username i {
        color: rgb(37, 37, 37);
        font-size: 30px;
        position: absolute;
        left: 20px;
        top: 55%;
        transform: translateY(-50%);
        transition: 0.3s;
    }

    .login {
        padding: 10px 50px;
        border-radius: 30px;
        background-color: #CE0037;
        border: none;
        color: white;
        font-weight: 700;
        font-size: 30px;
        border-bottom: 5px #FFCEDB solid;
        transition: 0.3s;
    }

    .login:hover {
        transform: translateY(-10px);
        transition: 0.3s;
        box-shadow: rgb(150, 150, 150) 0px 20px 30px -10px;
    }

    .regis {
        padding: 10px 50px;
        border-radius: 30px;
        background-color: #CE0037;
        border: none;
        color: white;
        font-weight: 700;
        font-size: 30px;
        border-bottom: 5px #FFCEDB solid;
        transition: 0.3s;
    }

    .regis:hover {
        transform: translateY(-10px);
        transition: 0.3s;
        box-shadow: rgb(150, 150, 150) 0px 20px 30px -10px;
    }

    .empty {
        margin-top: 10%;
    }

    #create {
        background-color: transparent;
        border: none;
        color: white;
        font-size: 20px;
        text-decoration: underline;
        font-weight: 500;
    }

    .formregis {
        display: none;
    }

    .dev-image img {
        width: 150px;
        border-radius: 50%;
        border: white 3px solid;
    }

    .dev-image h1 {
        font-size: 30px;
        color: white;
        font-weight: 700;
    }

    .dev-image h2 {
        font-size: 25px;
        color: white;
        font-weight: 400;
    }

    .aboutus {
        display: none;
    }

    @media screen and (max-width: 670px) {
        .buttons button {
            font-size: 20px;
        }
    }

    .notify {
        position: absolute;
        width: 100%;
        color: white;
        background-color: rgba(37, 37, 37, 0.4);
        height: 100%;
        z-index: 10;
        display: none;
    }

    .noticontent {
        background-color: white;
        border-radius: 15px;
        /* width: 40%; */
        margin: auto;
        margin-top: 20%;
    }

    .noticontent hr {
        color: black;
        margin: 0 20px;
        padding-top: 20px;

    }

    .notititle h4 {
        color: red;
        padding: 30px;
        padding-bottom: 10px;
    }

    .notititle i {
        color: red;
        padding: 30px;
        font-size: 30px;
    }

    .notititle {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .reasontext {
        color: black;
    }

    .invalid-message {
        color: #CE0037;
        display: none;
    }

    .is-invalided {
        border: red solid 2px !important;
        background-color: rgba(255, 86, 86, 0.425) !important;
        color: white;
    }

    .is-invalided::placeholder {
        color: rgb(255, 157, 157);
    }

    .is-invalided+i {
        color: rgb(255, 157, 157);
    }

    .snowflake {
        color: #FFCEDB;
        font-size: 0.5em;
        font-family: Arial;
        text-shadow: 0 0 1px #000;
    }

    @-webkit-keyframes snowflakes-fall {
        0% {
            top: -10%
        }

        100% {
            top: 100%
        }
    }

    @-webkit-keyframes snowflakes-shake {
        0% {
            -webkit-transform: translateX(0px);
            transform: translateX(0px)
        }

        50% {
            -webkit-transform: translateX(80px);
            transform: translateX(80px)
        }

        100% {
            -webkit-transform: translateX(0px);
            transform: translateX(0px)
        }
    }

    @keyframes snowflakes-fall {
        0% {
            top: -10%
        }

        100% {
            top: 100%
        }
    }

    @keyframes snowflakes-shake {
        0% {
            transform: translateX(0px)
        }

        50% {
            transform: translateX(80px)
        }

        100% {
            transform: translateX(0px)
        }
    }

    .snowflake {
        position: fixed;
        top: -10%;
        z-index: 9999;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        cursor: default;
        -webkit-animation-name: snowflakes-fall, snowflakes-shake;
        -webkit-animation-duration: 10s, 3s;
        -webkit-animation-timing-function: linear, ease-in-out;
        -webkit-animation-iteration-count: infinite, infinite;
        -webkit-animation-play-state: running, running;
        animation-name: snowflakes-fall, snowflakes-shake;
        animation-duration: 10s, 3s;
        animation-timing-function: linear, ease-in-out;
        animation-iteration-count: infinite, infinite;
        animation-play-state: running, running
    }

    .snowflake:nth-of-type(0) {
        left: 1%;
        -webkit-animation-delay: 0s, 0s;
        animation-delay: 0s, 0s
    }

    .snowflake:nth-of-type(1) {
        left: 10%;
        -webkit-animation-delay: 1s, 1s;
        animation-delay: 1s, 1s
    }

    .snowflake:nth-of-type(2) {
        left: 20%;
        -webkit-animation-delay: 6s, .5s;
        animation-delay: 6s, .5s
    }

    .snowflake:nth-of-type(3) {
        left: 30%;
        -webkit-animation-delay: 4s, 2s;
        animation-delay: 4s, 2s
    }

    .snowflake:nth-of-type(4) {
        left: 40%;
        -webkit-animation-delay: 2s, 2s;
        animation-delay: 2s, 2s
    }

    .snowflake:nth-of-type(5) {
        left: 50%;
        -webkit-animation-delay: 8s, 3s;
        animation-delay: 8s, 3s
    }

    .snowflake:nth-of-type(6) {
        left: 60%;
        -webkit-animation-delay: 6s, 2s;
        animation-delay: 6s, 2s
    }

    .snowflake:nth-of-type(7) {
        left: 70%;
        -webkit-animation-delay: 2.5s, 1s;
        animation-delay: 2.5s, 1s
    }

    .snowflake:nth-of-type(8) {
        left: 80%;
        -webkit-animation-delay: 1s, 0s;
        animation-delay: 1s, 0s
    }

    .snowflake:nth-of-type(9) {
        left: 90%;
        -webkit-animation-delay: 3s, 1.5s;
        animation-delay: 3s, 1.5s
    }
</style>

<body>
    <div class="notify">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-8 text-center noticontent">
                    <div class="notititle">
                        <h4 class='text-start'>Login Failed!</h4>
                        <i class="bi bi-x-square-fill"></i>
                    </div>
                    <hr>
                    <div class='reason text-start px-4'>
                        <p class='reasontext'>asd</p>
                    </div>
                    <br>
                    <br><br>
                </div>

            </div>
        </div>

    </div>


    <div class="black">
        .
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-xxl-6 col-sm-12 buttons josefin-sans mt-5 d-flex">
                <div class="col-xxl-4 text-center"><button class="login gotologin active">Login</button></div>
                <div class="col-xxl-4 text-center"><button class="register">Register</button></div>
                <div class="col-xxl-4 text-center"><button class="about">About</button></div>
            </div>
        </div>
        <div class="row empty">

        </div>
        <div class="logo">
            <img src="logo.png">
        </div>
        <div class="row">
            <div class="formlogin">
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <div class="username josefin-sans">
                            <input type="text" placeholder="Email" require id="EmailLogin" name="EmailLogin">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="invalided-email-feedback invalid-message fw-bold mt-1 mb-0">Email is empty</div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <div class="username josefin-sans">
                            <input type="password" placeholder="Password" require id="passwordLogin" name="passwordLogin">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <div class="invalided-password-feedback invalid-message fw-bold mt-1 mb-0">Password is empty</div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center josefin-sans">
                        <button id="loginBtn" class="login">Login</button>
                    </div>
                    <div class="col-12 text-center josefin-sans mt-3">
                        <input type="button" value="Create New Account" id="create">
                    </div>
                    <div class="col-12 text-center josefin-sans">
                        <button class="guest">Continue as guest</button>
                    </div>
                </div>
            </div>
            <div class="formregis">
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <div class="username josefin-sans">
                            <input type="text" placeholder="Username" require id="usernameRegis">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="invalided-regis-username-feedback invalid-message fw-bold mt-1 mb-0">Email is empty</div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <div class="username josefin-sans">
                            <input type="text" placeholder="Email" require id="EmailRegis">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="invalided-regis-email-feedback invalid-message fw-bold mt-1 mb-0">Email is empty</div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <div class="username josefin-sans">
                            <input type="password" placeholder="Password" require id="passwordRegis">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <div class="invalided-regis-password-feedback invalid-message fw-bold mt-1 mb-0">Email is empty</div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <div class="username josefin-sans">
                            <input type="password" placeholder="Confirm Password" require id="confirmRegis">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <div class="invalided-regis-cfpassword-feedback invalid-message fw-bold mt-1 mb-0">Email is empty</div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center josefin-sans">
                        <button class="regis" id="Register">Sign up</button>
                    </div>
                </div>
                <br>
                <br>
            </div>
            <div class="josefin-sans aboutus">

                <div class="col-12 dev-image text-center">
                    <img src="Untitled-23.jpg">
                    <h1 class="mt-3">Hen Sovatra</h1>
                    <h2>Coder and Designer</h2>
                </div>
                <div class="row">
                    <div class="col-xxl-5 col-12 dev-image text-center">
                        <img src="21.jpg">
                        <h1 class="mt-3">Kong Noraksovann</h1>
                        <h2>Designer</h2>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-xxl-5 col-12 dev-image text-center">
                        <img src="222.jpg">
                        <h1 class="mt-3">Vann Vichetra</h1>
                        <h2>Coder</h2>
                    </div>
                </div>
                <div class="col-12 dev-image text-center">
                    <img src="123.jpg">
                    <h1 class="mt-3">Tang Sivhuy</h1>
                    <h2>Idea Provider</h2>
                </div>
                <br>
                <br>
            </div>
        </div>

    </div>

    <div class="snowflakes" aria-hidden="true">

        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
        <div class="snowflake">
            <i class="bi bi-snow2"></i>
        </div>
    </div>
</body>
<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('.guest').click(function() {
            window.location = "home.php";
        })
        $('.buttons button').click(function() {
            $(this).parent().siblings().children().removeClass("active")
            $(this).addClass("active")
        });
        $('.gotologin').click(function() {
            $('.formlogin').siblings().hide(500);
            $('.formlogin').show(500)
            $('.logo').show(500)
            $('.empty').css("margin-top", "10%")
            $(".is-invalided").removeClass("is-invalided")
            $(".invalid-message").hide()
        })
        $('.register').click(function() {
            $('.formregis').siblings().hide(500);
            $('.formregis').show(500)
            $('.logo').show(500)
            $('.empty').css("margin-top", "10%")
            $(".is-invalided").removeClass("is-invalided")
            $(".invalided-password-feedback").hide()
            $(".invalided-email-feedback").hide()
        })
        $('#create').click(function() {
            $('.formregis').siblings().hide(500);
            $('.formregis').show(500)
            $('.logo').show(500)
            $('.register').addClass("active")
            $('.register').parent().siblings().children().removeClass("active")
            $('.empty').css("margin-top", "10%")
        })
        $('.about').click(function() {
            $('.aboutus').siblings().hide(500);
            $('.logo').hide(500)
            $('.aboutus').show(500)
            $('.empty').css("margin-top", "5%")
        })
    });
    $("#EmailLogin").on('input', function() {
        $("#EmailLogin").removeClass("is-invalided")
        $(".invalided-email-feedback").hide()
    })
    $("#passwordLogin").on('input', function() {
        $("#passwordLogin").removeClass("is-invalided")
        $(".invalided-password-feedback").hide()
    })
    document.getElementById("loginBtn").addEventListener("click", function() {
        var email = document.getElementById("EmailLogin").value;
        var password = document.getElementById("passwordLogin").value;
        if (!email) {
            $("#EmailLogin").addClass("is-invalided")
            $("#EmailLogin").focus();
            $(".invalided-email-feedback").show()
            $(".invalided-email-feedback").html("Email is empty")
            return
        }
        if (!validateEmail(email)) {
            $("#EmailLogin").addClass("is-invalided")
            $("#EmailLogin").focus();
            $(".invalided-email-feedback").show()
            $(".invalided-email-feedback").html("Please Enter a valid email!!")
            return
        }
        $("#EmailLogin").removeClass("is-invalided")
        $(".invalided-email-feedback").hide()
        if (!password) {
            $("#passwordLogin").addClass("is-invalided")
            $("#passwordLogin").focus();
            $(".invalided-password-feedback").show()
            $(".invalided-password-feedback").html("Password is empty")
            return
        }
        $("#passwordLogin").removeClass("is-invalided")
        $(".invalided-password-feedback").hide()
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "login.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                if (response === "Login successful!") {

                    window.location = "home.php";
                } else if (response === "Invalid username or password!") {
                    $("#passwordLogin").addClass("is-invalided")
                    $("#passwordLogin").focus();
                    $(".invalided-password-feedback").show()
                    $(".invalided-password-feedback").html("Incorrect Password!!")
                } else if (response === "Account Disabled!") {
                    Swal.fire({
                        title: 'Account Disabled!',
                        text: 'Your account have been disabled',
                        icon: 'error',
                        confirmButtonText: 'Retry',
                        confirmButtonColor: 'red'
                    })
                } else if (response === "Email doesn't exist!") {
                    $("#EmailLogin").addClass("is-invalided")
                    $("#EmailLogin").focus();
                    $(".invalided-email-feedback").show()
                    $(".invalided-email-feedback").html("Can't Find user with this email!!")
                } else {
                    Swal.fire({
                        title: 'Login Failed!',
                        text: 'Please try again',
                        icon: 'error',
                        confirmButtonText: 'Retry',
                        confirmButtonColor: 'red'
                    })
                }
            }
        };
        xhr.send("email=" + email + "&password=" + password);
    });
    $('.notititle i').click(function() {
        $('.notify').fadeOut(300);
    })
    $("#EmailRegis").on('input', function() {
        $("#EmailRegis").removeClass("is-invalided")
        $(".invalided-regis-email-feedback").hide()
    })
    $("#passwordRegis").on('input', function() {
        $("#passwordRegis").removeClass("is-invalided")
        $(".invalided-regis-password-feedback").hide()
    })
    $("#usernameRegis").on('input', function() {
        $("#usernameRegis").removeClass("is-invalided")
        $(".invalided-regis-username-feedback").hide()
    })
    $("#confirmRegis").on('input', function() {
        $("#confirmRegis").removeClass("is-invalided")
        $(".invalided-regis-cfpassword-feedback").hide()
    })

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    document.getElementById("Register").addEventListener("click", function() {
        var email = document.getElementById("EmailRegis").value;
        var password = document.getElementById("passwordRegis").value;
        var username = document.getElementById("usernameRegis").value;
        var confirmPassword = document.getElementById("confirmRegis").value;
        if (!username) {
            $("#usernameRegis").addClass("is-invalided")
            $("#usernameRegis").focus();
            $(".invalided-regis-username-feedback").show()
            $(".invalided-regis-username-feedback").html("Username is empty")
            return
        }
        $("#usernameRegis").removeClass("is-invalided")
        $(".invalided-regis-username-feedback").hide()
        if (!email) {
            $("#EmailRegis").addClass("is-invalided")
            $("#EmailRegis").focus();
            $(".invalided-regis-email-feedback").show()
            $(".invalided-regis-email-feedback").html("Email is empty")
            return
        }
        if (!validateEmail(email)) {
            $("#EmailRegis").addClass("is-invalided")
            $("#EmailRegis").focus();
            $(".invalided-regis-email-feedback").show()
            $(".invalided-regis-email-feedback").html("Please Enter a valid email!!")
            return
        }
        $("#EmailRegis").removeClass("is-invalided")
        $(".invalided-regis-email-feedback").hide()
        if (!password) {
            $("#passwordRegis").addClass("is-invalided")
            $("#passwordRegis").focus();
            $(".invalided-regis-password-feedback").show()
            $(".invalided-regis-password-feedback").html("Password is empty")
            return
        }
        if (password.length < 8) {
            $("#passwordRegis").addClass("is-invalided")
            $("#passwordRegis").focus();
            $(".invalided-regis-password-feedback").show()
            $(".invalided-regis-password-feedback").html("Password must be more than 8 character!!")
            return
        }
        $("#passwordRegis").removeClass("is-invalided")
        $(".invalided-regis-password-feedback").hide()
        if (!confirmPassword) {
            $("#confirmRegis").addClass("is-invalided")
            $("#confirmRegis").focus();
            $(".invalided-regis-cfpassword-feedback").show()
            $(".invalided-regis-cfpassword-feedback").html("Confirm Password is empty")
            return
        }
        if (password !== confirmPassword) {
            $("#confirmRegis").addClass("is-invalided")
            $("#confirmRegis").focus();
            $(".invalided-regis-cfpassword-feedback").show()
            $(".invalided-regis-cfpassword-feedback").html("Password Doesn't match")
            return;
        }
        $("#confirmRegis").removeClass("is-invalided")
        $(".invalided-regis-cfpassword-feedback").hide()
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "register.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                if (response === "Create successful!") {
                    Swal.fire({
                        title: 'Create Successful!',
                        text: "Account created successfully",
                        icon: 'success',
                        confirmButtonText: 'Continue',
                        confirmButtonColor: 'green'
                    })
                    $('.notititle h4').css("color", "green");
                    $('.formlogin').siblings().hide(500);
                    $('.formlogin').show(500)
                    $('.logo').show(500)
                    $('.empty').css("margin-top", "10%")
                    $('.login').parent().siblings().children().removeClass("active")
                    $('.login').addClass("active")
                    $('.empty').css("margin-top", "10%")
                    $('#EmailRegis').val("");
                    $('#passwordRegis').val("");
                    $('#usernameRegis').val("");
                    $('#confirmRegis').val("");
                    $("#EmailRegis").removeClass("is-invalided")
                    $(".invalided-regis-email-feedback").hide()
                    $("#EmailLogin").val(email)
                } else {
                    $("#EmailRegis").addClass("is-invalided")
                    $("#EmailRegis").focus();
                    $(".invalided-regis-email-feedback").show()
                    $(".invalided-regis-email-feedback").html(response)
                }
            }
        };
        xhr.send("email=" + email + "&password=" + password + "&username=" + username + "&confirmPassword=" + confirmPassword);
    });
</script>

</html>