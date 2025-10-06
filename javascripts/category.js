$(document).ready(function () {
  $(".closehere i").click(function () {
    $(".createaccountnoti").fadeOut(300);
  });

  $(".carde").click(function () {
    var quizcode = $(this).children().eq(0).val();
    var quizid = $(this).children().eq(1).val();
    var numofques = $(this).children().eq(2).val();
    var image = $(this).children().eq(4).children().eq(0).attr("src");
    var titles = $(this).find(".quiztitles").html();
    var author = $(this).find(".authorname").html();
    var play = $(this).children().eq(3).val();

    $(".detail").fadeIn(300);
    $(".detail").css("display", "flex");
    $(".detail .quiztitle").html(titles);
    $(".detail img").attr("src", image);
    $(".detail .authorr").html(author);
    $(".detail .plays").html(play + " plays");
    $(".detail .quizcodee").html(
      "QuizCode : " +
        "<span id='quizCode'>" +
        quizcode +
        "</span>" +
        " <i class='bi bi-copy' id='copyIcon'></i>"
    );

    $(".detail .numofques").html(numofques + " Questions");
    $(".detail .play").attr("data-quiz", quizid);
    $(".detail .play").click(function () {
      var url = "play.php?quizid=" + quizid;
      window.location.href = url;
    });
    $(".detail .leaderbutton").click(function () {
      var url = "leaderboard.php?scorequiz=" + quizid;
      window.location.href = url;
    });
    $(".close").click(function () {
      $(".detail").fadeOut(300);
    });

    function displayNotification(message) {
      var modal = document.getElementById("notificationModal");
      var notificationMessage = document.getElementById("notificationMessage");
      notificationMessage.innerHTML = message;
      modal.style.display = "block";
      var closeButton = document.getElementsByClassName("close")[0];
      closeButton.onclick = function () {
        modal.style.display = "none";
      };
      setTimeout(function () {
        modal.style.display = "none";
      }, 1000);
    }
    document.getElementById("copyIcon").addEventListener("click", function () {
      var quizCode = document.getElementById("quizCode");
      var range = document.createRange();
      range.selectNode(quizCode);
      window.getSelection().removeAllRanges();
      window.getSelection().addRange(range);
      document.execCommand("copy");
      window.getSelection().removeAllRanges();
      displayNotification("Quiz code copied");
    });
  });
  $(".detail .quizcodee i").click(function () {
    $(this).select();
    document.execCommand("copy");
    alert("Text copied to clipboard");
  });
  $(".show").eq(0).show();
  $(".show").eq(1).fadeIn(500);
  $("#changepf").click(function () {
    window.location = "changepf.php";
  });
  $(".createquiz").click(function () {
    $.ajax({
      type: "GET",
      url: "check_role.php",
      success: function (response) {
        if (response === "Guest") {
          Swal.fire({
            title: "Unable to create quiz!",
            text: "Sign in to create quiz",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Sign in",
            cancelButtonText: "back",
            confirmButtonColor: "#3085d6",
          }).then((result) => {
            if (result.value) {
              window.location = "index.php";
            } else {
            }
          });
        } else {
          window.location = "create.php";
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      },
    });
  });
});
var currentIndex = 0;
$(".button").click(function () {
  history.back();
});
$(window).scroll(function () {
  var windowHeight = $(window).height();
  var documentHeight = $(document).height() - 400;
  var scrollTop = $(window).scrollTop();
  if (scrollTop + windowHeight >= documentHeight) {
    if (currentIndex < $(".show").length) {
      $(".show").eq(currentIndex).fadeIn(700);
      currentIndex++;
    }
  }
});
