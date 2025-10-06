$(document).ready(function () {
  $(".back").click(function () {
    history.back();
  });
  $(".correctbox").each(function () {
    if ($(this).val() == 1) {
      $(this).siblings(".correct-icon").addClass("text-success");
    }
  });

  function handleCorrectIconClick(icon) {
    const answerNumber = icon.dataset.answer;
    const isCorrectInput = document.getElementById("iscorrect" + answerNumber);
    if (icon.classList.contains("text-success")) {
    } else {
      document.querySelectorAll(".correct-icon").forEach((icon) => {
        icon.classList.remove("text-success");
        icon.classList.add("text-danger");
        document.getElementById("iscorrect" + icon.dataset.answer).value = "0";
      });
      icon.classList.remove("text-danger");
      icon.classList.add("text-success");
      isCorrectInput.value = "1";
    }
  }

  document.querySelectorAll(".correct-icon").forEach((icon) => {
    icon.addEventListener("click", function () {
      handleCorrectIconClick(this);
    });
  });

  document.getElementById("change").addEventListener("click", function (event) {
    event.preventDefault();
    console.log("change");
    var iscorrect1 = document.getElementById("iscorrect1")
      ? document.getElementById("iscorrect1").value
      : null;
    var iscorrect2 = document.getElementById("iscorrect2")
      ? document.getElementById("iscorrect2").value
      : null;
    var iscorrect3 = document.getElementById("iscorrect3")
      ? document.getElementById("iscorrect3").value
      : null;
    var iscorrect4 = document.getElementById("iscorrect4")
      ? document.getElementById("iscorrect4").value
      : null;
    var duration = document.getElementById("time").value;
    var question = document.getElementById("question").value;
    var quesid = document.getElementById("quesid").value;
    var answer1 = document.getElementById("answer1")
      ? document.getElementById("answer1").value
      : null;
    var answer2 = document.getElementById("answer2")
      ? document.getElementById("answer2").value
      : null;
    var answer3 = document.getElementById("answer3")
      ? document.getElementById("answer3").value
      : null;
    var answer4 = document.getElementById("answer4")
      ? document.getElementById("answer4").value
      : null;
    var answerid1 = document.getElementById("answerid1")
      ? document.getElementById("answerid1").value
      : null;
    var answerid2 = document.getElementById("answerid2")
      ? document.getElementById("answerid2").value
      : null;
    var answerid3 = document.getElementById("answerid3")
      ? document.getElementById("answerid3").value
      : null;
    var answerid4 = document.getElementById("answerid4")
      ? document.getElementById("answerid4").value
      : null;

    if (
      (iscorrect1 === "0" &&
        iscorrect2 === "0" &&
        iscorrect3 === "0" &&
        iscorrect4 === "0") ||
      !duration
    ) {
      if (
        iscorrect1 === "0" &&
        iscorrect2 === "0" &&
        iscorrect3 === "0" &&
        iscorrect4 === "0"
      ) {
        alert("Please pick the correct answer.");
      }
      if (!duration) {
        alert("The Duration can't be empty.");
      }
      return;
    }

    var formData = new FormData();
    formData.append("question", question);
    formData.append("quesid", quesid);
    formData.append("answer1", answer1);
    formData.append("answer2", answer2);
    formData.append("answer3", answer3);
    formData.append("answer4", answer4);
    formData.append("answerid1", answerid1);
    formData.append("answerid2", answerid2);
    formData.append("answerid3", answerid3);
    formData.append("answerid4", answerid4);
    formData.append("iscorrect1", iscorrect1);
    formData.append("iscorrect2", iscorrect2);
    formData.append("iscorrect3", iscorrect3);
    formData.append("iscorrect4", iscorrect4);
    formData.append("duration", duration);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "updatequestion.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          var response = xhr.responseText;
          if (response === "Update Success!") {
            Swal.fire({
              title: "Update Successful!",
              icon: "success",
              confirmButtonText: "Confirm",
              confirmButtonColor: "green",
            });
          } else if (response === "Invalid request!") {
            alert("Fail!");
            Swal.fire({
              title: "Update Fail!",
              icon: "error",
              confirmButtonText: "Confirm",
              confirmButtonColor: "red",
            });
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
  });
});
