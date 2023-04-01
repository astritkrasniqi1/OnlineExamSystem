<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Exam</title>
    <link rel="stylesheet" href="newExam.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body style="background:#f1f1f3;">
    <?php @include 'navbar.php' ?>

    <div class="container">
        <div class="exam-title">
            <div class="title">
                <input type="text" id="exam-title" name="exam-title" placeholder="Enter exam title">
                <select id="subject">
                    <option value="">Select Subject</option>
                </select>
            </div>

            <button id="add-question">Add Question</button>

            <div id="add-question-form" class="hidden">
                <form id="question-form">
                    <label for="question">Question:</label>
                    <input type="text" id="question" required>

                    <label for="answer1">Answer 1:</label>
                    <input type="text" id="answer1" required>
                    <div class="form-row">
                        <div>
                            <input type="radio" name="correct-answer" id="answer1-correct" value="1">
                            <label for="answer1-correct">Correct Answer</label>
                        </div>
                    </div>

                    <label for="answer2">Answer 2:</label>
                    <input type="text" id="answer2" required>
                    <div class="form-row">
                        <div>
                            <input type="radio" name="correct-answer" id="answer2-correct" value="2">
                            <label for="answer2-correct">Correct Answer</label>
                        </div>
                    </div>

                    <label for="answer3">Answer 3:</label>
                    <input type="text" id="answer3">
                    <div class="form-row">
                        <div>
                            <input type="radio" name="correct-answer" id="answer3-correct" value="3">
                            <label for="answer3-correct">Correct Answer</label>
                        </div>
                    </div>

                    <label for="answer4">Answer 4:</label>
                    <input type="text" id="answer4">
                    <div class="form-row">
                        <div>
                            <input type="radio" name="correct-answer" id="answer4-correct" value="4">
                            <label for="answer4-correct">Correct Answer</label>
                        </div>
                        <div>
                            <label for="points-input">Points:</label>
                            <input type="number" id="points-input" name="points" min="0">
                        </div>
                    </div>

                    <button type="submit">Save</button>
                </form>
            </div>

            <div class="question-table">
                <table>
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Answer 1</th>
                            <th>Answer 2</th>
                            <th>Answer 3</th>
                            <th>Answer 4</th>
                            <th>Correct Answer</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody id="question-table-body">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="exam-settings">
            <h2>Exam Settings</h2>
            <label for="start-time">Start Time:</label>
            <input type="time" id="start-time" required>

            <label for="end-time">End Time:</label>
            <input type="time" id="end-time" required>

            <label for="duration">Duration (minutes):</label>
            <input type="number" id="duration" required>

            <button id="create-exam">Create Exam</button>
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


    const addQuestionBtn = document.getElementById('add-question');
    const addQuestionForm = document.getElementById('add-question-form');

    addQuestionBtn.addEventListener('click', () => {
        addQuestionForm.classList.toggle('hidden');
    });
</script>

</html>