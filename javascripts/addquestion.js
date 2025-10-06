$(document).ready(function () {
  getTableLength();
  document.querySelectorAll(".correct-icon").forEach((icon) => {
    icon.addEventListener("click", function () {
      const answerNumber = this.dataset.answer;
      const isCorrectInput = document.getElementById(
        "iscorrect" + answerNumber
      );
      if (this.classList.contains("text-success")) {
        this.classList.remove("text-success");
        this.classList.add("text-danger");
        isCorrectInput.value = "0";
      } else {
        document.querySelectorAll(".correct-icon").forEach((icon) => {
          icon.classList.remove("text-success");
          icon.classList.add("text-danger");
          document.getElementById("iscorrect" + icon.dataset.answer).value =
            "0";
        });
        this.classList.remove("text-danger");
        this.classList.add("text-success");
        isCorrectInput.value = "1";
      }
    });
  });
  document
    .getElementById("createquestion")
    .addEventListener("click", function (event) {
      event.preventDefault();
      var iscorrect1 = document.getElementById("iscorrect1").value;
      var iscorrect2 = document.getElementById("iscorrect2").value;
      var iscorrect3 = document.getElementById("iscorrect3").value;
      var iscorrect4 = document.getElementById("iscorrect4").value;
      var duration = document.getElementById("time").value;
      var question = document.getElementById("question").value;
      if (!question) {
        Swal.fire({
          title: "Invalid Question!",
          text: "Question can't be empty",
          icon: "error",
          confirmButtonText: "I understand",
          confirmButtonColor: "red",
        });
        return;
      }
      var answer1 = document.getElementById("answer1").value;
      var answer2 = document.getElementById("answer2").value;
      var answer3 = document.getElementById("answer3").value;
      var answer4 = document.getElementById("answer4").value;

      if (
        (answer1 === "" && answer2 === "" && answer3 === "") ||
        (answer1 === "" && answer2 === "" && answer4 === "") ||
        (answer1 === "" && answer3 === "" && answer4 === "") ||
        (answer2 === "" && answer3 === "" && answer4 === "")
      ) {
        Swal.fire({
          title: "Insufficient answers!",
          text: "Please provide at least 2 answers",
          icon: "error",
          confirmButtonText: "I understand",
          confirmButtonColor: "red",
        });
        return;
      }
      if (
        iscorrect1 === "0" &&
        iscorrect2 === "0" &&
        iscorrect3 === "0" &&
        iscorrect4 === "0"
      ) {
        Swal.fire({
          title: "No correct answer!",
          text: "Please pick the correct answer",
          icon: "error",
          confirmButtonText: "I understand",
          confirmButtonColor: "red",
        });
      } else if (!duration) {
        Swal.fire({
          title: "Invalid Duration!",
          text: "The Duration can't be empty",
          icon: "error",
          confirmButtonText: "I understand",
          confirmButtonColor: "red",
        });
      } else {
        event.preventDefault();
        var formData = new FormData();
        formData.append("question", question);
        formData.append("answer1", answer1);
        formData.append("answer2", answer2);
        formData.append("answer3", answer3);
        formData.append("answer4", answer4);
        formData.append("iscorrect1", iscorrect1);
        formData.append("iscorrect2", iscorrect2);
        formData.append("iscorrect3", iscorrect3);
        formData.append("iscorrect4", iscorrect4);
        formData.append("duration", duration);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "addques.php", true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              var response = xhr.responseText;
              if (response === "Create Success!") {
                getTableLength();
              } else if (response === "Invalid request!") {
                alert("Fail!");
              } else if (response === "Error uploading image.") {
                alert("Error uploading image.");
              } else {
                console.log(response);
              }
            } else {
              alert("Error occurred: " + xhr.status);
            }
          }
        };
        xhr.send(formData);
      }
    });
  $(".leaveBtn").click(function () {
    window.location = "home.php";
  });
  function getTableLength() {
    var xhr = new XMLHttpRequest();
    var quizid = $("#getquiz").val();
    xhr.open("GET", "getquestionnumber.php?quizid=" + quizid, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var tableLength = xhr.responseText;
        if (tableLength == 1) {
          $(".ques").html("Question " + tableLength);
        } else {
          $(".ques").html("Question " + tableLength);
          $("#finish").show();
          $("#question").val("");
          $("#answer1").val("");
          $("#answer2").val("");
          $("#answer3").val("");
          $("#answer4").val("");
          $("#iscorrect1").val("0");
          $("#iscorrect2").val("0");
          $("#iscorrect3").val("0");
          $("#iscorrect4").val("0");
          $(".correct-icon")
            .removeClass("text-success")
            .addClass("text-danger");
        }
      }
    };
    xhr.send();
  }
  $("#finish").click(function () {
    window.location = "myquiz.php";
  });
});
