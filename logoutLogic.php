<?php 
    @include 'config.php';

    session_start();

    $sql = "SELECT * FROM users";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        if($row['UserType'] == '0'){
            $updateProfessor = "UPDATE users SET Status='0' WHERE Id='{$_SESSION['professorID']}'";
            mysqli_query($conn, $updateProfessor);
            session_unset();
            session_destroy(); 
        }
        else if($row['UserType'] == '1'){
            $updateStudent = "UPDATE users SET Status='0' WHERE Id='{$_SESSION['studentID']}'";
            mysqli_query($conn, $updateStudent);
            session_unset();
            session_destroy();
        }
 
    }


    header('location:login.php');

?>