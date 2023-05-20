<?php
@include '../../../config.php';

if(isset($_POST['submitResultsBtn'])){
    $examId = isset($_POST['examId']) ? $_POST['examId'] : '';

    $maxPoints ="SELECT SUM(Points) as MaxPoints from studentquestions sq
    join studentexam se on sq.StudentExamId = se.Id where se.ExamId = $examId";

    $maxResult= mysqli_query($conn, $maxPoints);
    $maxRow = mysqli_fetch_array($maxResult);

    $selectResultsTable = "SELECT se.Id as ExamId, u.Id as StudentId, CONCAT(FirstName, ' ', LastName) as StudentName from studentexam se 
    join users u on se.Student = u.Id
    where se.ExamId = $examId";

    $selectResults= mysqli_query($conn, $selectResultsTable);
    

    

    

}

?>
