<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
    <link rel="stylesheet" href="newSubject.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body style="background:#f1f1f3;">
    <?php @include 'navbar.php' ?>



    <form action="add_subject.php" method="post">
		<label for="subject_name">Subject Name:</label>
		<input type="text" id="subject_name" name="subject_name" required>
		
		<label for="description">Description:</label>
		<textarea id="description" name="description" required></textarea>
		
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required>

		
		<input type="submit" value="Add Subject">
	</form>
	
	<?php


   
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$subject_name = $_POST['subject_name'];
			$description = $_POST['description'];
            $category = $_POST['category'];
			
			
			// qetu lidhja me databaze edhe insertimi i te dhenave vazhdonnnnn
			
			echo "<p>Subject added successfully!</p>";
		}
	?>

    </body>

    <script>
    $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').removeClass('active');
            $('nav .logo-container ul li a.exams').removeClass('active');
            $('nav .logo-container ul li a.subjects').addClass('active');
            $('nav .logo-container ul li a.students').removeClass('active');
    })
</script>

</html>