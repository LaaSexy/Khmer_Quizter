$(document).ready(function () {
  $(".guest").click(function () {
    window.location = "home.php";
  });
  $(".buttons button").click(function () {
    $(this).parent().siblings().children().removeClass("active");
    $(this).addClass("active");
  });
  $(".gotologin").click(function () {
    $(".formlogin").siblings().hide(500);
    $(".formlogin").show(500);
    $(".logo").show(500);
    $(".empty").css("margin-top", "10%");
    $(".is-invalided").removeClass("is-invalided");
    $(".invalid-message").hide();
  });
  $(".register").click(function () {
    $(".formregis").siblings().hide(500);
    $(".formregis").show(500);
    $(".logo").show(500);
    $(".empty").css("margin-top", "10%");
    $(".is-invalided").removeClass("is-invalided");
    $(".invalided-password-feedback").hide();
    $(".invalided-email-feedback").hide();
  });
  $("#create").click(function () {
    $(".formregis").siblings().hide(500);
    $(".formregis").show(500);
    $(".logo").show(500);
    $(".register").addClass("active");
    $(".register").parent().siblings().children().removeClass("active");
    $(".empty").css("margin-top", "10%");
  });
  $(".about").click(function () {
    $(".aboutus").siblings().hide(500);
    $(".logo").hide(500);
    $(".aboutus").show(500);
    $(".empty").css("margin-top", "5%");
  });
});
$("#EmailLogin").on("input", function () {
  $("#EmailLogin").removeClass("is-invalided");
  $(".invalided-email-feedback").hide();
});
$("#passwordLogin").on("input", function () {
  $("#passwordLogin").removeClass("is-invalided");
  $(".invalided-password-feedback").hide();
});
document.getElementById("loginBtn").addEventListener("click", function () {
  var email = document.getElementById("EmailLogin").value;
  var password = document.getElementById("passwordLogin").value;
  if (!email) {
    $("#EmailLogin").addClass("is-invalided");
    $("#EmailLogin").focus();
    $(".invalided-email-feedback").show();
    $(".invalided-email-feedback").html("Email is empty");
    return;
  }
  if (!validateEmail(email)) {
    $("#EmailLogin").addClass("is-invalided");
    $("#EmailLogin").focus();
    $(".invalided-email-feedback").show();
    $(".invalided-email-feedback").html("Please Enter a valid email!!");
    return;
  }
  $("#EmailLogin").removeClass("is-invalided");
  $(".invalided-email-feedback").hide();
  if (!password) {
    $("#passwordLogin").addClass("is-invalided");
    $("#passwordLogin").focus();
    $(".invalided-password-feedback").show();
    $(".invalided-password-feedback").html("Password is empty");
    return;
  }
  $("#passwordLogin").removeClass("is-invalided");
  $(".invalided-password-feedback").hide();
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "database/login.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = xhr.responseText;
      if (response === "Login successful!") {
        window.location = "home.php";
      } else if (response === "Invalid username or password!") {
        $("#passwordLogin").addClass("is-invalided");
        $("#passwordLogin").focus();
        $(".invalided-password-feedback").show();
        $(".invalided-password-feedback").html("Incorrect Password!!");
      } else if (response === "Account Disabled!") {
        Swal.fire({
          title: "Account Disabled!",
          text: "Your account have been disabled",
          icon: "error",
          confirmButtonText: "Retry",
          confirmButtonColor: "red",
        });
      } else if (response === "Email doesn't exist!") {
        $("#EmailLogin").addClass("is-invalided");
        $("#EmailLogin").focus();
        $(".invalided-email-feedback").show();
        $(".invalided-email-feedback").html(
          "Can't Find user with this email!!"
        );
      } else {
        Swal.fire({
          title: "Login Failed!",
          text: "Please try again",
          icon: "error",
          confirmButtonText: "Retry",
          confirmButtonColor: "red",
        });
      }
    }
  };
  xhr.send("email=" + email + "&password=" + password);
});
$(".notititle i").click(function () {
  $(".notify").fadeOut(300);
});
$("#EmailRegis").on("input", function () {
  $("#EmailRegis").removeClass("is-invalided");
  $(".invalided-regis-email-feedback").hide();
});
$("#passwordRegis").on("input", function () {
  $("#passwordRegis").removeClass("is-invalided");
  $(".invalided-regis-password-feedback").hide();
});
$("#usernameRegis").on("input", function () {
  $("#usernameRegis").removeClass("is-invalided");
  $(".invalided-regis-username-feedback").hide();
});
$("#confirmRegis").on("input", function () {
  $("#confirmRegis").removeClass("is-invalided");
  $(".invalided-regis-cfpassword-feedback").hide();
});

function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}
document.getElementById("Register").addEventListener("click", function () {
  var email = document.getElementById("EmailRegis").value;
  var password = document.getElementById("passwordRegis").value;
  var username = document.getElementById("usernameRegis").value;
  var confirmPassword = document.getElementById("confirmRegis").value;
  if (!username) {
    $("#usernameRegis").addClass("is-invalided");
    $("#usernameRegis").focus();
    $(".invalided-regis-username-feedback").show();
    $(".invalided-regis-username-feedback").html("Username is empty");
    return;
  }
  $("#usernameRegis").removeClass("is-invalided");
  $(".invalided-regis-username-feedback").hide();
  if (!email) {
    $("#EmailRegis").addClass("is-invalided");
    $("#EmailRegis").focus();
    $(".invalided-regis-email-feedback").show();
    $(".invalided-regis-email-feedback").html("Email is empty");
    return;
  }
  if (!validateEmail(email)) {
    $("#EmailRegis").addClass("is-invalided");
    $("#EmailRegis").focus();
    $(".invalided-regis-email-feedback").show();
    $(".invalided-regis-email-feedback").html("Please Enter a valid email!!");
    return;
  }
  $("#EmailRegis").removeClass("is-invalided");
  $(".invalided-regis-email-feedback").hide();
  if (!password) {
    $("#passwordRegis").addClass("is-invalided");
    $("#passwordRegis").focus();
    $(".invalided-regis-password-feedback").show();
    $(".invalided-regis-password-feedback").html("Password is empty");
    return;
  }
  if (password.length < 8) {
    $("#passwordRegis").addClass("is-invalided");
    $("#passwordRegis").focus();
    $(".invalided-regis-password-feedback").show();
    $(".invalided-regis-password-feedback").html(
      "Password must be more than 8 character!!"
    );
    return;
  }
  $("#passwordRegis").removeClass("is-invalided");
  $(".invalided-regis-password-feedback").hide();
  if (!confirmPassword) {
    $("#confirmRegis").addClass("is-invalided");
    $("#confirmRegis").focus();
    $(".invalided-regis-cfpassword-feedback").show();
    $(".invalided-regis-cfpassword-feedback").html("Confirm Password is empty");
    return;
  }
  if (password !== confirmPassword) {
    $("#confirmRegis").addClass("is-invalided");
    $("#confirmRegis").focus();
    $(".invalided-regis-cfpassword-feedback").show();
    $(".invalided-regis-cfpassword-feedback").html("Password Doesn't match");
    return;
  }
  $("#confirmRegis").removeClass("is-invalided");
  $(".invalided-regis-cfpassword-feedback").hide();
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "database/register.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = xhr.responseText;
      if (response === "Create successful!") {
        Swal.fire({
          title: "Create Successful!",
          text: "Account created successfully",
          icon: "success",
          confirmButtonText: "Continue",
          confirmButtonColor: "green",
        });
        $(".notititle h4").css("color", "green");
        $(".formlogin").siblings().hide(500);
        $(".formlogin").show(500);
        $(".logo").show(500);
        $(".empty").css("margin-top", "10%");
        $(".login").parent().siblings().children().removeClass("active");
        $(".login").addClass("active");
        $(".empty").css("margin-top", "10%");
        $("#EmailRegis").val("");
        $("#passwordRegis").val("");
        $("#usernameRegis").val("");
        $("#confirmRegis").val("");
        $("#EmailRegis").removeClass("is-invalided");
        $(".invalided-regis-email-feedback").hide();
        $("#EmailLogin").val(email);
      } else {
        $("#EmailRegis").addClass("is-invalided");
        $("#EmailRegis").focus();
        $(".invalided-regis-email-feedback").show();
        $(".invalided-regis-email-feedback").html(response);
      }
    }
  };
  xhr.send(
    "email=" +
      email +
      "&password=" +
      password +
      "&username=" +
      username +
      "&confirmPassword=" +
      confirmPassword
  );
});
