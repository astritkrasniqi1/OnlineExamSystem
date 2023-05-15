<?php 
   @include '../../config.php';

    session_start();

    if(!isset($_SESSION['studentUsername'])){
        header('Location:../../login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="Profile.css" media="all" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body style="background:#f1f1f3;">
       <?php @include 'studentNavbar.php' ?>
       <?php require '../Backend/ManageProfile/StudentProfileLogic.php';?>
	
	<main>
		<section class="user-profile col-4">
			
			<div class="user-details">
            <?php while($professors = mysqli_fetch_array($Professors)) {
          ?>
				<h1><?php echo $professors['professorName'] ?></h1>
				<p><?php echo $professors['Email'] ?></p>
				<button class="edit-profile" onclick="toggleEditProfile()">Edit Profile</button>
                <?php }?>
			</div>
            <?php $userData = mysqli_fetch_array($studenti);?>
            <section class="EditProfile" style="display:none;">
                <label>First Name</label>
                <input type="text" value="<?php echo $userData['FirstName'];?>" placeholder="First Name" class="form-control"/>
                <label>Last Name</label>
                <input type="email" value="<?php echo $userData['LastName'];?>" placeholder="Last Name" class="form-control"/>
                <label>Email</label>
                <input type="phone" placeholder="Email" value="<?php echo $userData['Email'];?>" class="form-control"/>
                <label>Username</label>
                <input type="text" placeholder="Username" value="<?php echo $userData['Username'];?>" class="form-control"/>
        </section>
		</section>
		
	<section class="exam-history col-8" >
            <div class="Position">
             <button class="overview"><i class="bi bi-book"></i>&nbsp;Overview</button>
             <button class="change-password"><i class="bi bi-key"></i>&nbsp;Change Password</button>
            </div>
			<h2>Exam History</h2>
            <?php if(mysqli_num_rows($ExamHistory) == 0){?>
        <span class="text-danger">No results</span>
      <?php } 
        if(mysqli_num_rows($ExamHistory)> 0){
        ?>
			<table>
				<thead>
					<tr>
							<th>Exam Name</th>
							<th>Date Started</th>
							<th>Score</th>
							<th>Action</th>
					</tr>
				</thead>
				<tbody>
                <?php while($Exams = mysqli_fetch_array($ExamHistory)) {
                       ?>
					<tr> 
						<td><?php echo $Exams['Title'] ?></td>
						<td><?php echo $Exams['StartDate'] ?></td>
						<td>90%</td>
						<td><a href="#">View Result</a></td>
					</tr>
                    <?php }}?>

				</tbody>
			</table>
		</section>
	</main>
</body>

<script>
        $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').removeClass('active');
            $('nav .logo-container ul li a.results').removeClass('active');
            $('nav .logo-container ul li a.profile').addClass('active');
    })
        const overviewBtn = document.querySelector('.overview');
const passwordBtn = document.querySelector('.change-password');

overviewBtn.classList.add('active');

overviewBtn.addEventListener('click', () => {
  overviewBtn.classList.add('active');
  passwordBtn.classList.remove('active');
});

passwordBtn.addEventListener('click', () => {
  passwordBtn.classList.add('active');
  overviewBtn.classList.remove('active');
});
   
        const editProfileButton = document.querySelector('.edit-profile');
        const editProfileSection = document.querySelector('.EditProfile');

editProfileButton.addEventListener('click', () => {
  if (editProfileSection.style.display === 'none') {
    editProfileSection.style.display = 'flex';
  } else {
    editProfileSection.style.display = 'none';
  }
});
</script>
</html>