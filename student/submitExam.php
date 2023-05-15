<?php
@include '../config.php';

if(isset($_POST['submitExam'])){
$studentExamId = $_GET['examId'];
$questionId = $_POST['questionId'];
$subject = $_POST['subject'];
$professor = $_POST['professor'];
$questionPoints = $_POST['questionPoints'];
$questionName = $_POST['question'];
$answerId = $_POST['answerId'];
$checkedAnswer = $_POST['checkedAnswer'];
$answerTitle = $_POST['answer'];
$totalPoints = $_POST['totalPoints'];
$student = $_SESSION['studentID'];
$updateStudentExam = "UPDATE studentexam set EndTime = now() where Id = $studentExamId";
$updateStudentExamResult = mysqli_query($conn, $updateStudentExam);

$resultsTable = "INSERT into results (StudentExamId, Subject, Professor, Student, StudentQuestionId, StudentAnswerId, Score, Created_at)
values('{$studentExamId}', '{$subject}', '{$professor}', '{$student}', '{$questionId}', '{$answerId}', '{$totalPoints}', NOW())";

$result = mysqli_query($conn, $resultsTable);

header("location: Dashboard.php");

}


?>