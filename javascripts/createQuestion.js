document.querySelectorAll(".correct-icon").forEach((icon) => {
  icon.addEventListener("click", function () {
    const answerNumber = this.dataset.answer;
    const isCorrectInput = document.getElementById("iscorrect" + answerNumber);
    if (this.classList.contains("text-success")) {
      this.classList.remove("text-success");
      this.classList.add("text-danger");
      isCorrectInput.value = "0";
    } else {
      document.querySelectorAll(".correct-icon").forEach((icon) => {
        icon.classList.remove("text-success");
        icon.classList.add("text-danger");
        document.getElementById("iscorrect" + icon.dataset.answer).value = "0";
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
    event.preventDefault();
    var question = document.getElementById("question").value;
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
      xhr.open("POST", "createquestion.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            var response = xhr.responseText;
            if (response === "Create Success!") {
              $(".quiz").hide(300);
              $(".mrquestion").show(300);
              displaySessionQuiz();
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
const inputElement = document.getElementById("image-upload");
inputElement.addEventListener("change", handleFiles);
function handleFiles() {
  const fileList = this.files;
  const previewElement = document.getElementById("image-preview");
  $("#image-preview").show();
  if (fileList.length > 0) {
    previewElement.src = URL.createObjectURL(fileList[0]);
  }
}

document.getElementById("create").addEventListener("click", function (event) {
  event.preventDefault();
  var QuizName = document.getElementById("quizname").value;
  var Quiztype = document.getElementById("quiztype").value;
  var imageInput = document.getElementById("image-upload");
  var image = imageInput.files[0];
  var formData = new FormData();
  if (!QuizName) {
    Swal.fire({
      title: "Invalid quiz name!",
      text: "Please name your quiz.",
      icon: "info",
      confirmButtonText: "Continue",
      confirmButtonColor: "#3085d6",
    });
    return;
  }
  if (!image) {
    Swal.fire({
      title: "No image choosen!",
      text: "Please select an image.",
      icon: "info",
      confirmButtonText: "Continue",
      confirmButtonColor: "#3085d6",
    });
    return;
  }

  formData.append("QuizName", QuizName);
  formData.append("Quiztype", Quiztype);
  formData.append("image", image);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "createquiz.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var response = xhr.responseText;
        if (response === "Create Success!") {
          $(".quiz").hide(300);
          $(".mrquestion").show(300);
          displaySessionQuiz();
          getTableLength();
        } else if (response === "Invalid request!") {
          alert("Fail!");
        } else if (response === "Error uploading image.") {
          alert("Error uploading image.");
        } else {
          console.log(response);
        }
      } else {
        alert("Error occurred: " + q);
      }
    }
  };

  xhr.send(formData);
});

$(".leaveBtn").click(function () {
  window.location = "home.php";
});

function displaySessionQuiz() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "get_session_quiz.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var sessionQuiz = JSON.parse(xhr.responseText);
      document.getElementById("session-quiz").textContent = sessionQuiz;
    }
  };
  xhr.send();
}

function getTableLength() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "getquestionnumbers.php", true);
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
        $(".correct-icon").removeClass("text-success").addClass("text-danger");
      }
    }
  };
  xhr.send();
}
$("#finish").click(function () {
  window.location = "myquiz.php";
});
