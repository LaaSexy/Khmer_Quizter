$(document).ready(function () {
  $(".back").click(function () {
    history.back();
  });
  $(".addquestion").click(function () {
    var quizid = $("#quizidhere").val();
    console.log(quizid);
    var url = "addquestion.php?quizid=" + quizid;
    window.location.href = url;
  });
  $(".eques .edit").click(function () {
    var quesid = $(this).siblings().eq(2).val();
    console.log(quesid);
    var url = "editques.php?quesid=" + quesid;
    window.location.href = url;
  });
  $(".delete").click(function () {
    var quesid = $(this).siblings().eq(2).val();
    var QuizID = $(this).siblings().eq(3).val();
    Swal.fire({
      title: "Delete Question!",
      text: "Do you want to delete this quesion?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      confirmButtonColor: "red",
    }).then((result) => {
      if (result.value) {
        var formData = new FormData();
        formData.append("quesid", quesid);
        formData.append("quizid", QuizID); // Corrected field name

        $.ajax({
          type: "POST",
          url: "delete_question.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            console.log(response);
            window.location.reload();
          },
          error: function (xhr, status, error) {
            console.error(error);
          },
        });
      } else {
        // Perform any alternative action or do nothing
      }
    });
  });
});
