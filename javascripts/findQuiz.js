$(document).ready(function () {
  $(".carde").click(function () {
    var quizcode = $(this).children().eq(0).val();
    var quizid = $(this).children().eq(1).val();
    var numofques = $(this).children().eq(2).val();
    var image = $(this).children().eq(4).children().eq(0).attr("src");
    var titles = $(this).find(".quiztitles").html();
    var author = $(this).find(".mrauthor").html(); // Corrected line
    var play = $(this).children().eq(3).val();
    console.log(quizcode + quizid + image + titles, author);
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
});
