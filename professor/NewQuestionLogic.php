<?php
    $servername = "127.0.0.1:3308";
    $username = "root";
    $password = "";
    $dbname = "onlineexam";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if(isset($_POST['saveQuestion'])){
        $question = isset($_POST['question']) ? $_POST['question'] : '';
        $points = isset($_POST['points']) ? $_POST['points'] : '1';
        $professorId = $_SESSION['professorID'];
       // Get the last exam ID
    $lastExamIdQuery = "SELECT Max(Id) from exam";
    $lastExamIdResult = mysqli_query($conn, $lastExamIdQuery);
    $lastExamId = mysqli_fetch_array($lastExamIdResult)[0];

    // Get the subject of the last exam
    $subjectQuery = "SELECT Subject from exam where Id=$lastExamId";
    $subjectResult = mysqli_query($conn, $subjectQuery);
    $subject = mysqli_fetch_array($subjectResult)[0];
        $sql_question = "INSERT INTO questions (ExamId, Subject, Professor, Title, Points, Created_at)
        VALUES (".$lastExamId.", '".$subject."', '".$professorId."', '".$question."', ".$points.", NOW())";


        if(mysqli_query($conn, $sql_question)){
            $question_id = mysqli_insert_id($conn); // Get the ID of the inserted question
           
            // Check if answer1 is not empty
            if(!empty($_POST['answer1'])){
                $answer1 = $_POST['answer1'];
                $is_correct1 = isset($_POST['correct-answer-1']) ? '1' : '0';

                $sql_answer1 = "INSERT INTO answers (QuestionId, Professor, Title, Status, Created_at)
                VALUES ($question_id, $professorId, '$answer1', $is_correct1, NOW())";
                mysqli_query($conn, $sql_answer1);
            }
           
            // Check if answer2 is not empty
            if(!empty($_POST['answer2'])){
                $answer2 = $_POST['answer2'];
                $is_correct2 = isset($_POST['correct-answer-2']) ? '1' : '0';

                $sql_answer2 = "INSERT INTO answers (QuestionId, Professor, Title, Status, Created_at)
                VALUES ($question_id, $professorId, '$answer2', $is_correct2, NOW())";
                mysqli_query($conn, $sql_answer2);
            }

            // Check if answer3 is not empty
            if(!empty($_POST['answer3'])){
                $answer3 = $_POST['answer3'];
                $is_correct3 = isset($_POST['correct-answer-3']) ? '1' : '0';

                $sql_answer3 = "INSERT INTO answers (QuestionId, Professor, Title, Status, Created_at)
                VALUES ($question_id, $professorId, '$answer3', $is_correct3, NOW())";
                mysqli_query($conn, $sql_answer3);
            }

            // Check if answer4 is not empty
            if(!empty($_POST['answer4'])){
                $answer4 = $_POST['answer4'];
                $is_correct4 = isset($_POST['correct-answer-4']) ? '1' : '0';

                $sql_answer4 = "INSERT INTO answers (QuestionId, Professor, Title, Status, Created_at)
                VALUES ($question_id, $professorId, '$answer4', $is_correct4, NOW())";
                mysqli_query($conn, $sql_answer4);
            }

            ?>
            <script>
                Swal.fire(
                    'Question saved successfully',
                    '',
                    'success'
                )
            </script>
            <?php
        }
    }  
?>
