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


$currentPage = 'home.php';
include_once 'nav.php';
?>
<style>
    .changename {
        box-shadow: 0 0 0.2rem black;
        padding: 25px;
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

    .back:hover {
        background-color: #CE0037;
        color: white;
        transition: 0.2s;
    }

    .name {
        justify-content: start;
        align-items: center;
    }

    .logg {
        justify-content: center;
        align-items: center;
    }

    .name h1 {
        font-size: 30px;
        margin: 0;
    }

    .change {
        background-color: #CE0037;
        color: white;
        font-weight: 700;
        border: none;
        padding: 5px 10px;
        border-radius: 20px;
        box-shadow: 0 0 0.2rem black;
        transition: 0.2s;
    }

    .change:hover {
        background-color: white;
        color: #CE0037;
        transition: 0.2s;
    }

    .logg button {
        padding: 10px 20px;
        font-size: 30px;
    }

    .changethename {
        position: fixed;
        top: 0;
        z-index: 10;
        background-color: rgba(37, 37, 37, 0.445);
        width: 100%;
        height: 100%;
        display: flex;
    }

    .changethepassword {
        position: fixed;
        top: 0;
        z-index: 10;
        background-color: rgba(37, 37, 37, 0.445);
        width: 100%;
        height: 100%;
        display: flex;
    }

    .biox {
        background-color: white;
        width: 50%;
        margin: auto;
        text-align: center;

        padding: 25px;
        border-radius: 25px;
    }

    .biox input[type=text],
    .biox input[type=password] {
        width: 50%;
        background-color: #D9D9D9;
        font-size: 20px;
        border-radius: 20px;
        border: none;
        outline: none;
        padding: 10px 25px;
    }

    .biox h1 {
        font-size: 25px;
    }

    .close i {
        font-size: 30px;
        color: red;
    }

    .closepass i {
        font-size: 30px;
        color: red;
    }

    .closepass i:hover {
        cursor: pointer;
    }

    .confirmchangename {
        background-color: #CE0037;
        color: white;
        font-weight: 700;
        border: none;
        padding: 5px 20px;
        border-radius: 20px;
        box-shadow: 0 0 0.2rem black;
        transition: 0.2s;
        font-size: 25px;
    }

    .confirmchangepassword {
        background-color: #CE0037;
        color: white;
        font-weight: 700;
        border: none;
        padding: 5px 20px;
        border-radius: 20px;
        box-shadow: 0 0 0.2rem black;
        transition: 0.2s;
        font-size: 25px;
    }

    .confirmchangepassword:hover {
        background-color: white;
        color: #CE0037;
        transition: 0.2s;
    }

    .confirmchangename:hover {
        background-color: white;
        color: #CE0037;
        transition: 0.2s;
    }

    .close i:hover {
        cursor: pointer;
    }

    @media screen and (max-width: 670px) {
        .biox {
            width: 100%;
        }
    }
</style>

<div class="changethename">

    <div class="biox josefin-sans">
        <div class="text-end close">
            <i class="bi bi-x-square-fill"></i>
        </div>
        <h1>Your new name</h1>
        <input type="text" name="new_name" placeholder="New name" class="newname"><br>
        <!-- Include a hidden input field to identify the form -->
        <input type="hidden" name="form_type" value="change_name_form">
        <input type="button" value="Confirm" class="mt-4 confirmchangename">
    </div>

</div>
<div class="changethepassword">

    <div class="biox josefin-sans">
        <div class="text-end closepass">
            <i class="bi bi-x-square-fill"></i>
        </div>
        <h1>Change password</h1>
        <input type="password" name="new_name" placeholder="Current password" class="cpassword"><br>
        <input type="password" name="new_name" placeholder="New password" class="mt-4 npassword"><br>
        <input type="button" value="Confirm" class="mt-4 confirmchangepassword">
    </div>

</div>
<div class="container changename mt-5 josefin-sans">
    <button class="back"><i class="bi bi-backspace-fill"></i> Back</button>
    <div class="row mt-3">
        <div class="col-xxl-3 col-md-3">

        </div>
        <div class="col-xxl-9 col-md-9 col-12 josefin-sans name d-flex">
            <h1>Username:</h1>
            <h1 class="mx-2 usernamehere"><?php echo $_SESSION['Username'] ?></h1>
            <button class="change mx-3 changeuser">Change Username</button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xxl-3 col-md-3">

        </div>
        <div class="col-xxl-9 col-md-9 col-12 josefin-sans name d-flex">
            <h1>Email:</h1>
            <h1 class="mx-2"><?php echo $_SESSION['Email'] ?></h1>

        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xxl-3 col-md-3">

        </div>
        <div class="col-xxl-9 col-md-9 col-12 josefin-sans name d-flex">
            <button class="change mx-3 changepasss">Change Password</button>

        </div>
    </div>
    <br><br>
    <div class="row mt-5">
        <div class=" col-12 josefin-sans logg d-flex">
            <button class="change mx-3">Log out</button>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('.changethename').hide()
        $('.changethepassword').hide()
        $('.back').click(function() {
            history.back();
        })
        $('.logg button').click(function() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "logout.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    window.location.href = "index.php";
                }
            };
            xhr.send();
        })
        $('.changepasss').click(function() {
            $('.changethepassword').fadeIn(100)
        })
        $('.changeuser').click(function() {
            $('.changethename').fadeIn(100)
        })
        $('.close i').click(function() {
            $('.changethename').fadeOut(100)
        })
        $('.closepass i').click(function() {
            $('.changethepassword').fadeOut(100)
        })
        $('.confirmchangename').click(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            var newname = $(this).siblings().eq(2).val();
            if (!newname) {
                Swal.fire({
                    title: 'Invalid Name!',
                    text: "Name can't be empty",
                    icon: 'error',
                    confirmButtonText: 'I understand',
                    confirmButtonColor: 'red'
                })
                return
            }
            console.log(newname);
            var formData = new FormData();
            formData.append('new_name', newname);

            $.ajax({
                type: 'POST',
                url: 'changename.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Changed Successful!',
                        text: "Name change successfully",
                        icon: 'success',
                        confirmButtonText: 'Confirm',
                        confirmButtonColor: 'green'
                    })

                    $('.usernamehere').html(newname)
                    $('.changethename').fadeOut(100)
                    $('.newname').val("");

                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });
        $('.confirmchangepassword').click(function() {
            // Get the input values
            var currentPassword = $('.cpassword').val();
            var newPassword = $('.npassword').val();
            if (!currentPassword || !newPassword) {
                Swal.fire({
                    title: 'Change Password Fail!',
                    text: "Fill all the requirment to change password",
                    icon: 'error',
                    confirmButtonText: 'I understand',
                    confirmButtonColor: 'red'
                })
                return
            }
            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: 'changepassword.php',
                data: {
                    current_password: currentPassword,
                    new_password: newPassword
                },
                success: function(response) {
                    if (response === "Password changed successfully") {
                        Swal.fire({
                            title: 'Changed password successful!',
                            icon: 'success',
                            confirmButtonText: 'Confirm',
                            confirmButtonColor: 'green'
                        })
                        $('.changethepassword').fadeOut(100)
                        $('.cpassword').val("");
                        $('.npassword').val("");
                    } else if (response === "Current password does not match") {
                        Swal.fire({
                            title: 'Change Password Fail!',
                            text: "current password doesn't match",
                            icon: 'error',
                            confirmButtonText: 'Confirm',
                            confirmButtonColor: 'red'
                        })
                    }

                    // You can update the UI or display a message here
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });

    })
</script>