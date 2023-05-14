<?php
 @include '../config.php';

// check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // retrieve the subject ID and updated information from the form data
  $subjectId = $_POST['editSubjectId'];
  $subjectName = $_POST['editSubjectName'];
  $createdAt = $_POST['editSubjectCreatedAt'];

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die("Error: Connection failed. " . mysqli_connect_error());
  }

  // update the subject information in the database
  $query = "UPDATE subjects SET Name='$subjectName', Created_at='$createdAt' WHERE Id='$subjectId'";

  if (mysqli_query($conn, $query)) {
    echo "Subject updated successfully.";
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }

  // close the database connection
  mysqli_close($conn);
}
?>