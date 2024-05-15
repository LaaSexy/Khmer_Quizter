<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>SenQuiz</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

    .josefin-sans {
        font-family: "Josefin Sans", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    .logo {
        display: flex;
        align-items: center;
        padding-bottom: 20px;
    }

    .logo:hover {
        cursor: pointer;
    }

    .logo h1 {
        font-weight: 700;
        padding-left: 20px;
        margin: 0;
        font-size: 32px;
        margin-top: 5px;
    }

    .logo img {
        width: 55px;
    }

    nav {
        display: flex;
        background-color: #D9D9D9;
        padding: 20px;
        box-shadow: 0 0 0.5rem black;
        padding-bottom: 0;
        position: sticky;
        top: 0;
        z-index: 9;
    }

    .homepage {
        margin-left: 100px;
        margin-right: 20px;
    }

    .home i {
        font-size: 40px;
        transition: 0.3s;
    }

    .first {
        margin-left: 50px;
    }

    .home {
        display: flex;
        align-items: center;
        padding-bottom: 20px;
        border-bottom: 5px solid transparent;
        transition: 0.3s;
        margin: 0 30px;
    }

    .home h1 {
        font-size: 32px;
        padding-left: 10px;
        margin: 0;
        margin-top: 10px;
        transition: 0.3s;
    }

    .home:hover i,
    .home:hover h1 {
        color: #CE0037;
        transition: 0.3s;
    }

    .home:hover {
        border-bottom: 5px solid #CE0037;
        transition: 0.3s;
    }

    .home:hover {
        cursor: pointer;
    }

    .onpage {
        border-bottom: 5px solid #CE0037;
    }

    .onpage h1,
    .onpage i {
        font-weight: 700;
        color: #CE0037;
    }

    .menu {
        margin-left: auto;
    }

    .dropdown {
        border: #CE0037 solid 2px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        transition: 0.4s;
    }

    .dropdown:hover {
        cursor: pointer;
        background-color: #CE0037;
        transition: 0.4s;
    }

    .dropdown i {
        font-size: 35px;
        color: #CE0037;
        transition: 0.4s;
    }

    .dropdown i:hover {
        color: white;
        transition: 0.4s;
    }

    .dropdown-menu {
        position: absolute;
        right: 20px;
        margin-top: 6px;
    }

    .dropdown-content h1 {
        font-size: 20px;
        margin: 0;
    }

    .dropdown-content i {
        margin-right: 10px;
    }

    .dropdown-content:hover {
        cursor: pointer;
        background-color: #FFCEDB;
        color: #CE0037;
        transition: 0.3s;
    }

    .dropdown-content {
        align-items: left;
        justify-content: left;
        padding-left: 20px;
        transition: 0.3s;
    }

    .name h1 {
        font-size: 20px;
    }

    .email h1 {
        font-size: 15px;
        font-weight: 300;
    }

    .pagetitle {
        text-align: center;
        padding: 30px;
        display: none;
    }

    .pagetitle h1 {
        font-weight: 700;
        color: #CE0037;
    }

    @media screen and (max-width: 670px) {
        .home h1 {
            display: none;
        }

        .homepage {
            margin-left: 0px;
        }

        .home {
            margin: 0px 12px;
        }
    }

    @media screen and (max-width: 900px) {
        .home h1 {
            display: none;
        }

        .homepage {
            margin-left: 100px;
            margin-right: 100px;
        }
    }

    @media screen and (max-width: 1060px) {
        .home h1 {
            display: none;
        }

        .homepage {
            margin: 0 12px;
        }

        .logo h1 {
            display: none;
        }
    }


    @media screen and (max-width: 1400px) {
        .home h1 {
            display: none;
        }

        .pagetitle {
            display: block;
        }
    }
</style>

<body>
    <nav>
        <div class="logo">
            <img src="logo.png">
            <h1 class="josefin-sans">SenQuiz</h1>
        </div>
        <div class="home homepage  <?php if ($currentPage === 'home.php') echo 'onpage'; ?>">
            <i class="fa-solid fa-house"></i>
            <h1 class="josefin-sans">Home</h1>
        </div>
        <?php

        $role = $_SESSION['Role'];
        if ($role === "Guest") {
            echo "";
        } else {
            echo " <div class='home activity";
            if ($currentPage === 'activity.php') echo ' onpage';
            echo "'><i class='fa-solid fa-clock-rotate-left'></i>";
            echo "<h1 class='josefin-sans'>Activity</h1></div>";
        }


        ?>
        <div class="home findquiz  <?php if ($currentPage === 'findquiz.php') echo 'onpage'; ?>">
            <i class="fa-solid fa-magnifying-glass"></i>
            <h1 class="josefin-sans">Find Quiz</h1>
        </div>
        <?php
        if ($role === "Guest") {
            echo "";
        } else {
            echo " <div class='home myquiz ";
            if ($currentPage === 'myquiz.php') echo ' onpage';
            echo "'><i class='fa-solid fa-book'></i>";
            echo "<h1 class='josefin-sans'>My Quiz</h1></div>";
        }


        ?>

        <div class="menu">
            <div class="dropdown"><i class="bi bi-list"></i></div>
            <div class="dropdown-menu py-3 josefin-sans">
                <div class="name px-3">
                    <h1><?php
                        echo $_SESSION["Username"];
                        ?></h1>
                </div>
                <div class="email px-3">
                    <h1><?php
                        echo $_SESSION["Email"];
                        ?></h1>
                </div>
                <hr class="px-3">
                <?php
                if ($_SESSION['Role'] === "Guest") {
                } else {
                    echo " <div class='dropdown-content py-2 d-flex settingg'>
                    <i class='bi bi-gear'></i>
                    <h1>Settings</h1>
                </div>";
                }
                ?>

                <div class='dropdown-content py-2 d-flex' id='logout'>


                    <?php
                    if ($_SESSION['Role'] === "Guest") {

                        echo "<i class='bi bi-person-fill-add'></i><h1>Sign in<h1>";
                    } else {
                        echo " <i class='bi bi-box-arrow-left'></i><h1>Log out</h1>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </nav>
    <div class="pagetitle josefin-sans">
        <h1><?php if ($currentPage === 'home.php') {
                echo 'Home';
            } elseif ($currentPage === 'activity.php') {
                echo 'Activity';
            } elseif ($currentPage === 'findquiz.php') {
                echo 'Find Quiz';
            } elseif ($currentPage === 'myquiz.php') {
                echo 'My Quiz';
            };

            ?></h1>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.logo').click(function() {
            window.location = "home.php";
        })
        $('.homepage').click(function() {
            window.location = "home.php";
        })
        $('.activity').click(function() {
            window.location = "activity.php";
        })
        $('.findquiz').click(function() {
            window.location = "findquiz.php";
        })
        $('.myquiz').click(function() {
            window.location = "myquiz.php";
        })
        $('.dropdown').click(function() {
            $('.dropdown-menu').toggle();
        })
        $('.menu').mouseleave(function() {
            $('.dropdown-menu').hide();
        })
        $('.settingg').click(function() {
            window.location = "change.php";
        })
        document.getElementById("logout").addEventListener("click", function() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "logout.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    window.location.href = "index.php";
                }
            };
            xhr.send();
        });


    })
</script>

</html>