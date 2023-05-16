<?php 
    @include '../../../config.php';

$examId='';

if(isset($_POST['examId'])){
    $examId = $_POST['examId'];
}
else if(isset($_GET['examId'])){
    $examId = $_GET['examId'];
}
else{
    $examId = '';
}


   $MaxPoints = "Select Sum(Points) as MaxPoints from studentquestions where StudentExamId = '{$examId}'";

   $Score = "Select Sum(Points) as Score from studentquestions as sq join studentanswers as sa 
    on sa.StudentQuestionId = sq.Id where sq.StudentExamId = '{$examId}' and sa.Status = '1' and sa.SelectedAnswer='1'";

   $scoreResult = mysqli_query($conn, $Score);

   $scoreRow = mysqli_fetch_array($scoreResult);

   $maxPointsResult = mysqli_query($conn, $MaxPoints);

   $maxPointsRow = mysqli_fetch_array($maxPointsResult);


   $questions = "Select Id, Title from studentquestions where StudentExamId = '{$examId}'";
   $questionResult = mysqli_query($conn, $questions);
?>