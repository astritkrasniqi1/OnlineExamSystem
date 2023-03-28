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
    <title>Dashboard</title>
    <link rel="stylesheet" href="professorDashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body style="background: #f6f6f8">
    <?php @include 'navbar.php' ?>
<section>
        <div class="pageTitleContainer" >
               <div>
                    <h2>
                    <?php
                          $currentPage = basename($_SERVER['PHP_SELF']);
                          $pageTitle = str_replace(".php", "", $currentPage);
                          echo $pageTitle;  
                    ?>
                    </h2>
               </div>
               <div>
                    <a href="#"><i class='bx bx-plus'></i>&nbsp;Create New Exam</a>
               </div>

        </div>

    <div class="overview" style="flex-wrap:wrap;">
        <a href="#"><div>
            <i class='bx bx-user'></i>
            <div class="col-auto">
            <span>Total Students</span>
            <h5>400</h5>
            </div>  
        </div>
        </a>
        
        <a href="#"><div>
            <i class='bx bx-user'></i>
            <div class="col-auto"><span>Active Students</span>
            <h5>400</h5></div>
            
        </div>
        </a>
        <a href="#">
            <div>
            <i class='bx bx-user'></i>
            <div class="col-auto"><span>Active Exams</span>
            <h5>400</h5></div>    
            </div>
        </a>
        <a href="#"><div>
            <i class='bx bx-user'></i>
            <div class="col-auto"><span>New Students</span>
            <h5>400</h5></div>
            
        </div>
        </a>
        <a href="#" style="margin-top: 20px;background: #e96d7f;"><div>
            <i class='bx bx-user'></i>
            <div class="col-auto"><span>Subjects</span>
            <h5>400</h5></div>
            
        </div>
        </a>
    </div>

    <div class="recentExam">
        <h3>Recent Exam Results</h3>
        <div class="recentExamContent row">
        <div class="statsContainer col">
            <div class="title">
                <p>Exam</p>
            </div>
            <div class="content">
                <span>From: </span>
                <span>To: </span>
            </div>
        </div>
        <div class="statsContainer col">
            <div class="title"><p>Avarage Score</p></div>
            <div class="graphics col"><img class="img-thumbnail" src="https://cdn.pixabay.com/photo/2018/03/30/15/11/deer-3275594__480.jpg" alt=""></div>
        </div>
        <div class="statsContainer col">
            <div class="title"><p>Student Stats</p></div>
            <div class="graphics"><img class="img-thumbnail" src="https://img.freepik.com/free-vector/geometric-wallpaper-japanese-style_52683-34401.jpg?w=2000" alt=""></div>
        </div>
        </div>
    </div>

</section>
</body>


<script>
    $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').addClass('active');
            $('nav .logo-container ul li a.exams').removeClass('active');
            $('nav .logo-container ul li a.subjects').removeClass('active');
            $('nav .logo-container ul li a.students').removeClass('active');
    })
</script>
</html>