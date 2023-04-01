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
    <link rel="stylesheet" href="Subjects.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <?php @include 'navbar.php' ?>
</body>
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
                    <a href="newSubject.php"><i class='bx bx-plus'></i>&nbsp;Add New Subject</a>
               </div>

        </div>

    <div class="subjectoverview" style="flex-wrap:wrap;">
        <a href="#" class=""><div>
        <i class="fa-solid fa-book" style="color:#f7b092;"></i>&nbsp;
            <div class="col-auto"><h6>Computer Science</h6>
              <span>Programming languages</span>
        </div></div>
        </a>
        
        <a href="#" class="">
      <div>
        <i class="fa-solid fa-book" style="color:#53b7ec;"></i>&nbsp;
            <div class="col-auto"><h6>Mathematics</h6>
                <span>Calculus, algebra, geometry</span>
        </div>
            
        </div>
        </a>
        <a href="#" class="">
            <div>
            <i class="fa-solid fa-book" style="color:#e96d7f;"></i>&nbsp;
            <div class="col-auto"><h6>Sciences</h6>
                <span>Biology, chemistry, physics</span></div>    
            </div>
        </a>
        <a href="#" class="">
            <div>
            <i class="fa-solid fa-book" style="color:#93ccad;"></i>&nbsp;
            <div class="col-auto"><h6>Humanities</h6>
                <span>Philosophy,history,sociology</span></div>    
            </div>
        </a>
         <a href="#" class="">
            <div>
            <i class="fa-solid fa-book" style="color:#73e40d;"></i>&nbsp;
            <div class="col-auto"><h6>Languages</h6>
                <span>English,German,French</span></div>    
            </div>
        </a>
        <a href="#" class=""><div>
        <i class="fa-solid fa-book" style="color:#b9b1e5;"></i>&nbsp;
            <div class="col-auto"><h6>Medical</h6>
                <span>Anatomy,physiology,pathology</span></div>
            
        </div>
       
       
    </div>
    
    
</section>




<script>
    $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').removeClass('active');
            $('nav .logo-container ul li a.exams').removeClass('active');
            $('nav .logo-container ul li a.subjects').addClass('active');
            $('nav .logo-container ul li a.students').removeClass('active');
    })
</script>
</html>