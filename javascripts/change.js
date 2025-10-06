$(document).ready(function () {
  // Change Username
  $(".leaveBtn").click(function () {
    window.location = "home.php";
  });
  $("#confirmUsername")
    .off("click")
    .on("click", function () {
      var newname = $("#newUsername").val().trim();

      if (!newname) {
        Swal.fire({
          title: "Invalid Name!",
          text: "Name can't be empty",
          icon: "error",
          confirmButtonText: "I understand",
          confirmButtonColor: "#ef4444",
        });
        return;
      }

      var formData = new FormData();
      formData.append("new_name", newname);

      $.ajax({
        type: "POST",
        url: "changename.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          console.log("Username Response:", response);

          // Update username in real-time
          $(".username-display").text(newname);

          // Clear input
          $("#newUsername").val("");

          // Hide modal using Bootstrap method
          var modal = bootstrap.Modal.getInstance(
            document.getElementById("usernameModal")
          );
          modal.hide();

          // Show success message
          Swal.fire({
            title: "Changed Successfully!",
            text: "Username changed successfully",
            icon: "success",
            confirmButtonText: "Confirm",
            confirmButtonColor: "#10b981",
          });
        },
        error: function (xhr, status, error) {
          console.error(error);
          Swal.fire({
            title: "Error!",
            text: "Something went wrong",
            icon: "error",
            confirmButtonText: "OK",
            confirmButtonColor: "#ef4444",
          });
        },
      });
    });

  // Change Password
  $("#confirmPassword")
    .off("click")
    .on("click", function () {
      var currentPassword = $("#currentPassword").val();
      var newPassword = $("#newPassword").val();

      if (!currentPassword || !newPassword) {
        Swal.fire({
          title: "Change Password Failed!",
          text: "Fill all the requirements to change password",
          icon: "error",
          confirmButtonText: "I understand",
          confirmButtonColor: "#ef4444",
        });
        return;
      }

      $.ajax({
        type: "POST",
        url: "changepassword.php",
        data: {
          current_password: currentPassword,
          new_password: newPassword,
        },
        success: function (response) {
          console.log("Password Response:", response);

          // Clear inputs
          $("#currentPassword").val("");
          $("#newPassword").val("");

          // Hide modal using Bootstrap method
          var modal = bootstrap.Modal.getInstance(
            document.getElementById("passwordModal")
          );
          modal.hide();

          // Show appropriate message
          if (response.trim() === "Password changed successfully") {
            Swal.fire({
              title: "Changed Successfully!",
              text: "Password changed successfully",
              icon: "success",
              confirmButtonText: "Confirm",
              confirmButtonColor: "#10b981",
            });
          } else if (response.trim() === "Current password does not match") {
            Swal.fire({
              title: "Change Password Failed!",
              text: "Current password doesn't match",
              icon: "error",
              confirmButtonText: "Confirm",
              confirmButtonColor: "#ef4444",
            });
          } else {
            Swal.fire({
              title: "Error!",
              text: response || "Something went wrong",
              icon: "error",
              confirmButtonText: "OK",
              confirmButtonColor: "#ef4444",
            });
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
          Swal.fire({
            title: "Error!",
            text: "Something went wrong",
            icon: "error",
            confirmButtonText: "OK",
            confirmButtonColor: "#ef4444",
          });
        },
      });
    });

  // Logout with confirmation
  $(".logout-btn").click(function () {
    Swal.fire({
      title: "Are you sure?",
      text: "You will be logged out",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#ef4444",
      cancelButtonColor: "#6b7280",
      confirmButtonText: "Yes, log out",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.isConfirmed) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "logout.php", true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            window.location.href = "index.php";
          }
        };
        xhr.send();
      }
    });
  });

  // Clear form inputs when modal is hidden
  $("#usernameModal").on("hidden.bs.modal", function () {
    $("#newUsername").val("");
  });

  $("#passwordModal").on("hidden.bs.modal", function () {
    $("#currentPassword").val("");
    $("#newPassword").val("");
  });
});

// Toggle password visibility
function togglePassword(inputId) {
  var input = document.getElementById(inputId);
  var icon = input.nextElementSibling.querySelector("i");

  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("bi-eye-fill");
    icon.classList.add("bi-eye-slash-fill");
  } else {
    input.type = "password";
    icon.classList.remove("bi-eye-slash-fill");
    icon.classList.add("bi-eye-fill");
  }
}
