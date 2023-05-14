<?php
    @include '../config.php';


if(isset($_POST['joinExamBtn'])){
    $examId = isset($_POST['examId']) ? $_POST['examId'] : ''; 

    $selectExam = "SELECT Subject, Professor, Title, StartDate, Duration FROM exam WHERE Id='{$examId}'";
    $selectExamResult = mysqli_query($conn, $selectExam);

    $selectExamRow = mysqli_fetch_array($selectExamResult);
    
    $insertStudentExam = "INSERT INTO studentexam(ExamId, Subject, Professor, Student, Title, StartTime, Status, ExamStartDate, Created_at) 
                    VALUES('{$examId}', '{$selectExamRow['Subject']}', '{$selectExamRow['Professor']}', '{$_SESSION['studentID']}', '{$selectExamRow['Title']}', NOW(), '1' ,'{$selectExamRow['StartDate']}', NOW())";
    
    $insertStudentExamResult = mysqli_query($conn, $insertStudentExam);
    $insertedStudentExamId = mysqli_insert_id($conn); // Get the ID of the newly inserted student exam
    
    $selectQuestions = "SELECT Id, ExamId, Subject, Professor, Title, Points FROM questions WHERE ExamId='{$examId}'";
    $selectQuestionsResult = mysqli_query($conn, $selectQuestions);
    
    while($selectQuestionsRow = mysqli_fetch_array($selectQuestionsResult)){
        $insertStudentQuestion = "INSERT INTO studentquestions(QuestionId, StudentExamId, ExamId, Subject, Professor, Title, Points, Created_at)
            VALUES('{$selectQuestionsRow['Id']}', '{$insertedStudentExamId}', '{$examId}', '{$selectQuestionsRow['Subject']}', '{$selectQuestionsRow['Professor']}', '{$selectQuestionsRow['Title']}', '{$selectQuestionsRow['Points']}', NOW())";
        mysqli_query($conn, $insertStudentQuestion);
        $insertedStudentQuestionId = mysqli_insert_id($conn); // Get the ID of the newly inserted student question
    
        $selectAnswers = "SELECT Id, QuestionId, Professor, Title, Status FROM answers WHERE QuestionId='{$selectQuestionsRow['Id']}'";
        $selectAnswersResult = mysqli_query($conn, $selectAnswers);
    
        while($selectAnswersRow = mysqli_fetch_array($selectAnswersResult)){
            $insertStudentAnswers = "INSERT INTO studentanswers(StudentQuestionId, QuestionId, AnswerId, Professor, Title, Status, Created_at)
            VALUES('{$insertedStudentQuestionId}', '{$selectAnswersRow['QuestionId']}', '{$selectAnswersRow['Id']}', '{$selectAnswersRow['Professor']}', '{$selectAnswersRow['Title']}', '{$selectAnswersRow['Status']}', NOW())";
            mysqli_query($conn, $insertStudentAnswers);
        }
    }

    header("location: http://localhost/Online-Exam-System/student/Exam.php?examId={$insertedStudentExamId}");
}
    

?>