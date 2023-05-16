<?php
@include '../../../config.php';

if(isset($_POST['submitExam'])){
$studentExamId = $_GET['examId'];
$questionId = $_POST['questionId'];
$subject = $_POST['subject'];
$professor = $_POST['professor'];
$questionPoints = $_POST['questionPoints'];
$questionName = $_POST['question'];
$checkedAnswers = $_POST['checkedAnswer'];
$answerTitle = $_POST['answer'];
$totalPoints = $_POST['totalPoints'];
$student = $_SESSION['studentID'];
$updateStudentExam = "UPDATE studentexam set EndTime = NOW() where Id = $studentExamId and Student='{$student}'";
$updateStudentExamResult = mysqli_query($conn, $updateStudentExam);

foreach ($checkedAnswers as $checkedAnswer) {
    $updateStudentAnswers = "UPDATE studentanswers SET SelectedAnswer = '1' WHERE Id = '{$checkedAnswer}'";
    mysqli_query($conn, $updateStudentAnswers);
}


header("location: Results.php?examId={$studentExamId}");

}


?>