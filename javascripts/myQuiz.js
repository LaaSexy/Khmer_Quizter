$(document).ready(function () {
  const quizModal = new bootstrap.Modal(
    document.getElementById("quizDetailModal")
  );
  const notificationToast = new bootstrap.Toast(
    document.getElementById("notificationToast")
  );

  // Handle quiz card click
  $(".quiz-card").click(function () {
    const $this = $(this);
    const quizcode = $this.data("quizcode");
    const quizid = $this.data("quizid");
    const numofques = $this.data("numques");
    const plays = $this.data("plays");
    const image = $this.data("image");
    const title = $this.data("title");
    const author = $this.data("author");

    // Populate modal
    $("#quizDetailModal .quiztitle").text(title);
    $("#quizDetailModal .detail-image").attr("src", image);
    $("#quizDetailModal .authorr").text(author);
    $("#quizDetailModal .plays-display span").text(plays + " plays");
    $("#quizDetailModal #quizCode").text(quizcode);
    $("#quizDetailModal .numofques").text(numofques + " Questions");
    $("#quizDetailModal .play-btn").attr("data-quiz", quizid);

    // Show modal
    quizModal.show();

    // Play button
    $("#quizDetailModal .play-btn")
      .off("click")
      .on("click", function () {
        window.location.href = "play.php?quizid=" + quizid;
      });

    // Leaderboard button
    $("#quizDetailModal .leaderboard-btn")
      .off("click")
      .on("click", function () {
        window.location.href = "leaderboard.php?scorequiz=" + quizid;
      });

    // Edit button
    $("#quizDetailModal .edit-btn")
      .off("click")
      .on("click", function () {
        window.location.href = "edit.php?quizid=" + quizid;
      });

    // Delete button
    $("#quizDetailModal .delete-btn")
      .off("click")
      .on("click", function () {
        Swal.fire({
          title: "Delete Quiz!",
          text: "Do you want to delete this quiz?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it",
          cancelButtonText: "Cancel",
          confirmButtonColor: "#dc3545",
          cancelButtonColor: "#6c757d",
        }).then((result) => {
          if (result.value) {
            $.ajax({
              type: "POST",
              url: "delete_quiz.php",
              data: { quizId: quizid },
              success: function (response) {
                $this.closest(".quiz-item").fadeOut(300, function () {
                  $(this).remove();
                  // Check if no more quizzes
                  if ($(".quiz-item").length === 0) {
                    location.reload();
                  }
                });
                quizModal.hide();
                displayNotification("Quiz deleted successfully!");
              },
              error: function (xhr, status, error) {
                console.error(error);
                displayNotification("Error deleting quiz!");
              },
            });
          }
        });
      });

    // Copy quiz code
    setTimeout(() => {
      $("#copyIcon")
        .off("click")
        .on("click", function (e) {
          e.stopPropagation();
          const quizCodeText = $("#quizCode").text();
          navigator.clipboard
            .writeText(quizCodeText)
            .then(function () {
              displayNotification("Quiz code copied to clipboard!");
            })
            .catch(function () {
              // Fallback for older browsers
              const tempInput = document.createElement("input");
              tempInput.value = quizCodeText;
              document.body.appendChild(tempInput);
              tempInput.select();
              document.execCommand("copy");
              document.body.removeChild(tempInput);
              displayNotification("Quiz code copied to clipboard!");
            });
        });
    }, 100);
  });

  // Notification function
  function displayNotification(message) {
    $("#notificationMessage").text(message);
    $("#notificationToast")
      .removeClass("bg-success bg-danger bg-info")
      .addClass("bg-success text-white");
    notificationToast.show();
  }

  // Make displayNotification global
  window.displayNotification = displayNotification;
});
