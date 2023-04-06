<?php 
    @include 'config.php';

    session_start();

    if(!isset($_SESSION['professorUsername'])){
        header('Location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Exam</title>
    <link rel="stylesheet" href="newExam.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body style="background:#f1f1f3;">
    <?php require 'NewExamLogic.php' ?>
    <?php require 'NewQuestionLogic.php' ?>
    <?php @include 'navbar.php' ?>


<div class="newExamContainer">
    <div class="create-exam-container">
            <form action="" method="post">
                <input type="text" id="exam-title" required name="exam-title" placeholder="Enter exam title">
                    <select id="subject" name="subject" required>
                        <option value="0" selected disabled>Select Subject</option>
                        <?php $subjectTable = "SELECT Id, Name from subject";
                                $resultSubjectTable = mysqli_query($conn,$subjectTable);
                                if(mysqli_num_rows($resultSubjectTable) > 0){
                                    while($subjectRow = mysqli_fetch_array($resultSubjectTable)){
                                ?>
                                <option value="<?php echo $subjectRow['Id']?>"><?php echo $subjectRow['Name']?></option>
                                <?php } }?>
                    </select>

            <h5 style="margin-top: 100px;border-bottom:1px solid lightgray;width:90%;">Exam Settings</h5>        

            <label for="start-date">Start Date:</label>
            <input type="datetime-local" id="start-date" name="startDate" required>

            <label for="duration">Duration (minutes):</label>
            <input type="number" id="duration" name="duration" required>
            <button id="create-exam" name="createExam" type="submit">Create Exam</button>
            </form>
        </div>
        <div class="exam-table">
            <form action="" method="post">
                <div style="display:flex; flex-direction:column;">
                    <label for="">From:</label>
                    <input type="datetime-local" name="From" value="<?php echo date('Y-m-d H:i:s'); ?>" >
                </div>
                <div style="display:flex; flex-direction:column;">
                    <label for="">To:</label>
                    <input type="datetime-local" name="To" value="<?php echo date('Y-m-d H:i:s'); ?>">
                </div>
            </form>
                <?php
                    if(mysqli_num_rows($resultExamTable) == 0){
                ?>
                        <span class="text-danger">No results</span>
                        
                <?php 
                    }
                    elseif(mysqli_num_rows($resultExamTable)> 0){
                    ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Professor</th>
                            <th scope="col">Title</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody id="exam-table-body">
                         <?php while($examRow = mysqli_fetch_array($resultExamTable)) {
                        ?>
                        <tr>
                            <td><?php echo $examRow['Id'] ?></td>
                            <td><?php echo $examRow['SubjectName'] ?></td>
                            <td><?php echo $examRow['Professor'] ?></td>
                            <td><?php echo $examRow['Title'] ?></td>
                            <td><?php echo $examRow['StartDate'] ?></td>
                            <td><?php echo $examRow['Duration'] ?> Min</td>

                            <td><?php if($examRow['Status'] == '0'){
                                echo '<span>Inactive</span>';
                                } else if($examRow['Status'] == '1'){
                                    echo '<span>Active</span>';
                                } else {
                                    echo '<span>New</span>';
                            } ?> </td>
                            <td>
                                <button id="updateExam"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</button>
                            </td>
                        </tr>
                        <?php } }?>
                    </tbody>
            </table>
        </div>
        <div class="update-exam-form">
                <form id="updateExam-form" method="POST">
                    <div class="close-button">
                        <i class="fa-solid fa-x"></i>
                    </div>
                    <input type="number" hidden id="examId" name="examId">

                    <label for="examTitle" >Exam Title:</label>
                    <input type="text" id="examTitle" name="examTitle" required>

                    <label for="Subject" >Subject:</label>
                    <select id="Subject" name="Subject" required>
                        <option value="0" selected disabled>Select Subject</option>
                        <?php $subjectTable = "SELECT Id, Name from subject";
                                $resultSubjectTable = mysqli_query($conn,$subjectTable);
                                if(mysqli_num_rows($resultSubjectTable) > 0){
                                    while($subjectRow = mysqli_fetch_array($resultSubjectTable)){
                                ?>
                                <option value="<?php echo $subjectRow['Id']?>"><?php echo $subjectRow['Name']?></option>
                                <?php } }?>
                    </select>

                    <label for="StartDate">Start Date:</label>
                    <input type="datetime-local" id="StartDate" name="StartDate" required>

                    <label for="Duration">Duration:</label>
                    <input type="number" id="Duration" name="Duration"  required>

                    <div class="save-button">
                            <button name="update-exam" id="update-exam-btn" type="submit">Save</button>
                    </div>
                </form>
            </div>

        <div class="exam-title">
            <button id="add-question"><i class='bx bx-plus'></i>&nbsp;Add Question</button>

            <div id="add-question-form">
                <form id="question-form" method="post">
                    <div class="close-btn">
                        <i class="fa-solid fa-x"></i>
                    </div>
                    <label for="question" >Question:</label>
                    <input type="text" id="question" name="question" required>

                    <label for="answer1">Answer 1:</label>
                    <input type="text" id="answer1" name="answer1" required>
                    <div class="form-row">
                        <div>
                            <input type="checkbox" name="correct-answer-1" id="answer1-correct" onclick="handleCheckboxClick(this)"  >
                            <label for="answer1-correct">Correct Answer</label>
                        </div>
                    </div>

                    <label for="answer2">Answer 2:</label>
                    <input type="text" id="answer2" name="answer2"  required>
                    <div class="form-row">
                        <div>
                            <input type="checkbox" name="correct-answer-2" id="answer2-correct" onclick="handleCheckboxClick(this)" >
                            <label for="answer2-correct">Correct Answer</label>
                        </div>
                    </div>

                    <label for="answer3">Answer 3:</label>
                    <input type="text" id="answer3" name="answer3" >
                    <div class="form-row">
                        <div>
                            <input type="checkbox" name="correct-answer-3" id="answer3-correct" onclick="handleCheckboxClick(this)"  >
                            <label for="answer3-correct">Correct Answer</label>
                        </div>
                    </div>

                    <label for="answer4">Answer 4:</label>
                    <input type="text" id="answer4" name="answer4" >
                    <div class="form-row">
                        <div>
                            <input type="checkbox" name="correct-answer-4" id="answer4-correct" onclick="handleCheckboxClick(this)"  >
                            <label for="answer4-correct">Correct Answer</label>
                        </div>
                        <div>
                            <label for="points-input">Points:</label>
                            <input type="number" id="points-input" min="0" name="points" required>
                        </div>
                    </div>
                    <div class="save-button">
                            <button name="saveQuestion" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <div class="question-table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Question</th>
                            <th scope="col">Answer 1</th>
                            <th scope="col">Answer 2</th>
                            <th scope="col">Answer 3</th>
                            <th scope="col">Answer 4</th>
                            <th scope="col">Correct Answer</th>
                            <th scope="col">Points</th>
                        </tr>
                    </thead>
                    <tbody id="question-table-body">
                    </tbody>
                </table>
            </div>

            <div class="completeExamContainer">
                <form action="" method="post">
                    <button class="completeExam" name="completeExam">Complete Exam &nbsp;<i class="fa-solid fa-check"></i></button>
                </form>
            </div>
        </div>
    </div>


</body>

<script>
    $(document).ready(function() {
        $('nav .logo-container ul li a.dashboard').removeClass('active');
        $('nav .logo-container ul li a.exams').addClass('active');
        $('nav .logo-container ul li a.subjects').removeClass('active');
        $('nav .logo-container ul li a.students').removeClass('active');
    })


    const addQuestionButton = document.getElementById('add-question');
    const addQuestionPopup = document.getElementById('add-question-form');
    const closeBtn = document.querySelector('.close-btn');
    const examTableTdList = document.querySelectorAll('.exam-table table tbody tr td span');  

    examTableTdList.forEach((td) => {
        if (td.textContent === 'New') {
        td.style.backgroundColor = '#ddf1fb';
        td.style.color = '#53b7ec';
        td.style.border = '1px solid #53b7ec';
        } else if (td.textContent === 'Inactive') {
        td.style.backgroundColor = '#fbe2e5';
        td.style.color = '#e96d7f';
        td.style.border = '1px solid #e96d7f';
        }else if (td.textContent === 'Active') {
        td.style.backgroundColor = '#e9f5ef';
        td.style.color = '#93ccad';
        td.style.border = '1px solid #93ccad';
        }
    });

    addQuestionButton.addEventListener('click', () => {
        addQuestionPopup.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
        addQuestionPopup.style.display = 'none';
    });


    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', () => {
    // If this checkbox is checked, disable all the other checkboxes
    if (checkbox.checked) {
      checkboxes.forEach((otherCheckbox) => {
        if (otherCheckbox !== checkbox) {
          otherCheckbox.disabled = true;
        }
      });
    } else {
      // If this checkbox is unchecked, enable all the checkboxes
      checkboxes.forEach((otherCheckbox) => {
        otherCheckbox.disabled = false;
      });
    }
    });
    });

    $(document).on('click', '#updateExam', function(){
    // get the values from the table row
    var examId = $(this).closest('tr').find('td:eq(0)').text().trim();
    var subjectId = $(this).closest('tr').find('td:eq(1)').text().trim();
    var examTitle = $(this).closest('tr').find('td:eq(3)').text().trim();
    var startDate = $(this).closest('tr').find('td:eq(4)').text().trim();
    var duration = $(this).closest('tr').find('td:eq(5)').text().trim().replace(" Min", "");
  
    // set the values to the update exam form inputs
    $('#examId').val(examId);
    $('#examTitle').val(examTitle);
    $('#Subject option').filter(function() {
        return $(this).text() === subjectId;
    }).prop('selected', true);  
    $('#StartDate').val(startDate);
    $('#Duration').val(duration);
  
    $('.update-exam-form').show();
    });

    $(document).on('click', '.close-button', function(){
        $('.update-exam-form').hide();
    })

    /*Update exam with ajax*/

    $(document).ready(function() {
  $('#updateExam-form').on('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    var examId = $('#examId').val();
    var examTitle = $('#examTitle').val();
    var subjectId = $('#Subject option:selected').val();
    var startDate = $('#StartDate').val();
    var duration = $('#Duration').val();

    $.ajax({
      type: 'POST',
      url: 'EditExamLogic.php',
      data: {
        'examId': examId,
        'examTitle': examTitle,
        'Subject': subjectId,
        'StartDate': startDate,
        'Duration': duration,
        'update-exam': true
      },
      success: function(response) {
        if (response == 'success') {
          $('.update-exam-form').hide();
          Swal.fire({
            title: 'Exam updated successfully',
            icon: 'success'
          }).then(function() {
            location.reload();
          });
        } else {
          Swal.fire({
            title: 'Error',
            text: 'An error occurred while updating the exam.',
            icon: 'error'
          });
        }
      }
    });
  });
});




</script>

</html>