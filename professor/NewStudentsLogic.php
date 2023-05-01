<?php
    @include '../config.php';
    if (mysqli_connect_error()) {
        echo "Failed to connect to MySQL: " .mysqli_connect_error();
        exit();
    }

    # Query the database
    $newStudents = "SELECT Id, CONCAT(FirstName,' ',LastName) as StudentName, Email, Status FROM users WHERE UserType = '1' AND DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL 5 DAY)";
    $NewstudentResultTable = mysqli_query($conn, $newStudents);
?>