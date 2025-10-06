<?php
session_start();
include "database/database.php";

if (!isset($_SESSION['Username'])) {
    $_SESSION['Username'] = "Guest";
    $_SESSION['Email'] = "guest";
    $_SESSION['Role'] = 'Guest';
    $_SESSION['UserID'] = 11;
    $_SESSION['Profile'] = "https://media.valorant-api.com/agents/22697a3d-45bf-8dd7-4fec-84a9e28c69d7/displayicon.png";
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="./assets/Khmer_Quizter.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/change.css">
    <title>Khmer Quizter</title>
</head>
<nav>
    <button class="leave leaveBtn josefin-sans"><i class="bi bi-backspace-fill"></i> Leave</button>
</nav>
<div class="profile-container">
    <div class="profile-card">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-avatar-wrapper">
                <div class="profile-avatar">
                    <img src="<?php echo $_SESSION['Profile']; ?>" alt="Profile">
                </div>
                <div class="profile-info">
                    <h1 class="username-display"><?php echo $_SESSION['Username']; ?></h1>
                    <div class="profile-email">
                        <i class="bi bi-envelope-fill"></i>
                        <span><?php echo $_SESSION['Email']; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <!-- Username Setting -->
            <div class="setting-item">
                <div class="setting-row">
                    <div class="setting-left">
                        <div class="setting-icon icon-red">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="setting-info">
                            <p class="setting-label">Username</p>
                            <p class="setting-value username-display"><?php echo $_SESSION['Username']; ?></p>
                        </div>
                    </div>
                    <button class="change-btn btn-red" data-bs-toggle="modal" data-bs-target="#usernameModal"><i class="bi bi-person-fill"></i> Change Username</button>
                </div>
            </div>

            <!-- Email Setting -->
            <div class="setting-item">
                <div class="setting-row">
                    <div class="setting-left">
                        <div class="setting-icon icon-purple">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="setting-info">
                            <p class="setting-label">Email Address</p>
                            <p class="setting-value"><?php echo $_SESSION['Email']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password Setting -->
            <div class="setting-item">
                <div class="setting-row">
                    <div class="setting-left">
                        <div class="setting-icon icon-blue">
                            <i class="bi bi-lock-fill"></i>
                        </div>
                        <div class="setting-info">
                            <p class="setting-label">Password</p>
                            <p class="setting-value">••••••••</p>
                        </div>
                    </div>
                    <button class="change-btn btn-red" data-bs-toggle="modal" data-bs-target="#passwordModal"><i class="bi bi-lock-fill"></i> Change Password</button>
                </div>
            </div>

            <!-- Logout Section -->
            <div class="logout-section">
                <button class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    Log Out
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Change Username Modal -->
<div class="modal fade" id="usernameModal" tabindex="-1" aria-labelledby="usernameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usernameModalLabel">Change Username</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newUsername" class="form-label">New Username</label>
                    <input type="text" class="form-control" id="newUsername" placeholder="Enter new username">
                </div>
                <button type="button" class="btn-modal-submit btn-submit-red" id="confirmUsername">Confirm Change</button>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Current Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password">
                        <button type="button" class="password-toggle-btn" onclick="togglePassword('currentPassword')">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                        <button type="button" class="password-toggle-btn" onclick="togglePassword('newPassword')">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn-modal-submit btn-submit-red" id="confirmPassword">Confirm Change</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="javascripts/change.js"></script>
