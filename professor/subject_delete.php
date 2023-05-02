<?php
include_once '../config.php';

if(isset($_GET['id'])){
    // Escape any special characters in the "id" parameter value to prevent SQL injection attacks
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Disable foreign key checks to allow deletion of the record with related foreign keys
    $query1 = "SET FOREIGN_KEY_CHECKS=0";
    mysqli_query($conn, $query1);

    // Delete the record with the specified ID from the "subject" table
    $query2 = "DELETE FROM subject WHERE Id='$id'";
    mysqli_query($conn, $query2);

    // Enable foreign key checks again
    $query3 = "SET FOREIGN_KEY_CHECKS=1";
    mysqli_query($conn, $query3);

    // Redirect to the subjects.php page after deletion
    header('Location: subjects.php');
    exit();
}
?>