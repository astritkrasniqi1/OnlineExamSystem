<?php 
    $servername = "127.0.0.1:3308";
    $username = "root";
    $password = "";
    $dbname = "onlineexam";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if(isset($_POST['createExam'])){
        $examTitle = isset($_POST['exam-title']) ? $_POST['exam-title'] : '';
        $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
        $startDate = isset($_POST['startDate']) ? date('Y-m-d H:i:s', strtotime($_POST['startDate'])) : '';
        $duration = isset($_POST['duration']) ? $_POST['duration'] : '';
        $professorId = $_SESSION['professorID'];

        $sql = "INSERT INTO exam (Subject, Professor, Title, StartDate, Duration,Status, Created_at) 
        VALUES ('$subject', '$professorId', '$examTitle', '$startDate', '$duration', '' , NOW())";
        if(mysqli_query($conn,$sql)){
            ?>
            <script>
                Swal.fire(
                    'Exam created successfully',
                    '',
                    'success'
                )
            </script> 
<?php 
        }
    }
        
?>