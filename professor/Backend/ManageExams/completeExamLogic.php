<?php
    @include '../../../config.php';

    $examId = isset($_POST['examIdToCompleteExam']) ? $_POST['examIdToCompleteExam'] : '';

    $sql = "Update exam set Status = '1' where Id = '{$examId}'";

    $sql1 = "Update exam set Status='0' where Status = '1' and Id != '{$examId}'"; 

    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);

?>