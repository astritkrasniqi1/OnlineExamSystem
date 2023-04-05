<?php
 $servername = "127.0.0.1:3308";
 $username = "root";
 $password = "";
 $dbname = "onlineexam";
 
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 if(isset($_POST['addSubject'])){
    $subjectName=isset($_POST['subjectName']) ? $_POST['subjectName'] : '';
    $sql="INSERT INTO subject (Name,Created_at)values( '$subjectName',NOW())";
    if(mysqli_query($conn,$sql)){
        ?>
        <script>
            Swal.fire(
                'Subject created successfully',
                '',
                'success'
            )
    </script>
<?php 
     }
} 
$subjectTable = "SELECT Id, Name, Created_at from subject";
$resultSubjectTable = mysqli_query($conn,$subjectTable);

?>