<?php
    @include '../../../config.php';

    $studentId = $_SESSION['studentID'];

    $Exams = "SELECT * FROM exam WHERE DATE_ADD(`StartDate`, INTERVAL `Duration` MINUTE) < NOW()";
$ExamHistory = mysqli_query($conn, $Exams);
$professor = "SELECT Id,CONCAT(FirstName,' ',LastName) as professorName,Email,Status FROM users where UserType = '0'";
$Professors = mysqli_query($conn, $professor);

    $user = "SELECT Id,FirstName, LastName,Email, Username ,Status FROM users where UserType = '1' and Id = '$studentId'";

    $studenti = mysqli_query($conn, $user);



?>