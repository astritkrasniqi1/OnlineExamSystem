<?php
@include '../../../config.php';

session_start();


if(isset($_POST['saveAnswer'])){
    $answer = isset($_POST['answer']) ? $_POST['answer'] : '';
    $answerStatus = isset($_POST['answerStatus']) ? $_POST['answerStatus'] : '0'; // set answerStatus to 0 if checkbox is unchecked
    $questionIdForAddAnswer = isset($_POST['questionIdForAddAnswer']) ? $_POST['questionIdForAddAnswer'] : '';
    $professorId = $_SESSION['professorID'];

    // Insert the new answer 
    $sql_question = "INSERT INTO answers (QuestionId, Professor, Title, Status, Created_at)
                     VALUES ('{$questionIdForAddAnswer}', '{$professorId}', '{$answer}', '{$answerStatus}', NOW())";

    mysqli_query($conn, $sql_question);
}
?>
