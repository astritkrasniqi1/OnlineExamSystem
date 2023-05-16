<?php 
    @include '../../../config.php';

    $examId='';

if(isset($_GET['examId'])){
    $examId = $_GET['examId'];
   }
   else{
    $examId = $_POST['examId'];
}


   $MaxPoints = "Select Sum(Points) as MaxPoints from studentquestions where StudentExamId = '{$examId}'";

   $Score = "Select Sum(Points) as Score from studentquestions as sq join studentanswers as sa 
    on sa.StudentQuestionId = sq.Id where sq.StudentExamId = '{$examId}' and sa.Status = '1' and sa.SelectedAnswer='1'";

   $scoreResult = mysqli_query($conn, $Score);

   $scoreRow = mysqli_fetch_array($scoreResult);

   $maxPointsResult = mysqli_query($conn, $MaxPoints);

   $maxPointsRow = mysqli_fetch_array($maxPointsResult);

   $answers = "SELECT a.Title as AnswerTitle, a.QuestionId as QuestionId, a.AnswerId as AnswerId, a.Status as Status, a.SelectedAnswer as SelectedAnswer, q.Title as QuestionTitle
   FROM studentanswers a
   JOIN studentquestions q ON a.StudentQuestionId = q.Id
   WHERE q.StudentExamId = '$examId'";
   $answerResult = mysqli_query($conn, $answers);

?>