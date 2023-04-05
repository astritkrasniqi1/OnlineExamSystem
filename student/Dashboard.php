<?php 
    @include 'config.php';

    session_start();

    if(!isset($_SESSION['studentUsername'])){
        header('Location: login.php');
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="studentDashboard.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>
<body>
    <?php @include 'studentNavbar.php' ?>
    <div class="overview" style="flex-wrap:wrap;">
        <a href="#" class=""><div>
        <i class="fa-solid fa-hourglass-half" style="color:#f7b092;"></i>&nbsp;
            <div class="col-auto">
            <span>Upcomming Exam</span>
            <h5></h5>
            </div>  
        </div>
        </a>
        
        <a href="#" class=""><div>
        <i class="fa-regular fa-calendar-days"style="color:#93ccad;"></i>&nbsp;
            <div class="col-auto"><span>Exam Schedule</span>
            <h5></h5></div>
            
        </div>
        </a>
        <a href="#" class="">
            <div>
            <i class="fa-solid fa-chart-simple" style="color:#a3abb6;"></i>&nbsp;
            <div class="col-auto"><span>Average Grade</span>
            <h5>8.69</h5></div>    
            </div>
        </a>
        
    </div>
    <div class="studentExam">
        <div class="studentExamResultsContainer">

        </div>
        <div class="startExamContainer">
            <div class="studentExamSettings">
                <div>
                    <i class="fa-solid fa-calendar-check"></i>
                    <div>
                        <span>
                            Friday, 14 October 2020
                        </span>
                        <span>
                            08:00 
                        </span>
                    </div>
                </div>
                <div>
                <i class="fa-regular fa-clock"></i>
                <div>
                    <span>
                        Duration
                    </span>
                    <span>
                        2 hours
                    </span>
                </div>


                </div>

            </div>
            <div class="studentExamJoin">
                <button> Join Now</button>

            </div>
        </div>
    </div>


<script>
        $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').addClass('active');
            $('nav .logo-container ul li a.exams').removeClass('active');
            $('nav .logo-container ul li a.subjects').removeClass('active');
            $('nav .logo-container ul li a.students').removeClass('active');
    })

</script>
    
</body>
</html>