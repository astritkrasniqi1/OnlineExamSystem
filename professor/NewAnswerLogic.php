<?php
    include '../config.php';
    
    session_start();

    if(isset($_POST['saveAnswer'])){
        $answer = isset($_POST['answer']) ? $_POST['answer'] : '';
        $answerStatus = isset($_POST['answerStatus']) ? $_POST['answerStatus'] : '';
        $questionIdForAddAnswer = isset($_POST['questionIdForAddAnswer']) ? $_POST['questionIdForAddAnswer'] : '';
        $professorId = $_SESSION['professorID'];

        // Insert the new answer 
        $sql_question = "INSERT INTO answers (QuestionId, Professor, Title, Status, Created_at)
                         VALUES ('{$questionIdForAddAnswer}', '{$professorId}', '{$answer}', '{$answerStatus}', NOW())";

        if(mysqli_query($conn, $sql_question)){
?>
            <script>
                Swal.fire(
                    'Answer saved successfully',
                    '',
                    'success'
                )
            </script>
<?php
        } else {
            echo "Error: " . $sql_question . "<br>" . mysqli_error($conn);
        }
    }
?>