<?php
    @include '../config.php';

    $examId = $_POST['examId'];

    $examNumber = 'Select Nr, Jump, MaxQuestions from examNumber';
    $examNumberResult = mysqli_query($conn, $examNumber);

    $examNumberRow = mysqli_fetch_array($examNumberResult);
    $questionNumber = 1 + $examNumberRow['Nr'];

    $examQuestionCount = "Select Count() as questionCount, from questions where examId = '{$examId}'";

    $examQuestionCountResult = mysqli_query($conn, $examQuestionCount);
    $examQuestionCountRow = mysqli_fetch_array($examQuestionCountResult);

    $jump = $examQuestionCountRow['questionCount']/10;

    if($jump <= 1){
       $selectStudentExam =  "select Id, Subject, Professor, Title, StartDate, Duration from where examId = '{$examId}'";
       $selectStudentExamResult = mysqli_query($conn, $selectStudentExam);
       $selectStudentExamRow = mysqli_fetch_array($selectStudentExamResult);
       $insertStudentExam = "Insert into studentexam(ExamId,Subject,Professor,Student,Title, StartTime,ExamStartDate)
                            values('{$examId}', '{$selectStudentExamRow['Subject']}', 
                            '{$selectStudentExamRow['Professor']}', '{$selectStudentExamRow['Title']}', 
                            '{$selectStudentExamRow['StartDate']}',
                            )
       "; 
    }

    $examNumberUpdate = "Update examNumber set Nr = '{$questionNumber}', Jump = '{$jump}'";
?>