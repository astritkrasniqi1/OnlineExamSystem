<?php 
    @include 'config.php';

    session_start();
    $update = "UPDATE users SET Status='0' WHERE ID='{$_SESSION['professorID']}'";
    mysqli_query($conn, $update);
    session_unset();
    session_destroy();

    header('location:login.php');

?>