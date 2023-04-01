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
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <?php @include 'navbar.php' ?>
</body>

<section>
 <div class="pageTitleContainer">  
    <div>
        <h2>
             <?php
                $currentPage = basename($_SERVER['PHP_SELF']);
                $pageTitle = str_replace(".php", "", $currentPage);
                echo $pageTitle;  
             ?>
        </h2>
     </div>
</div> 
</section>

<script>
    $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').removeClass('active');
            $('nav .logo-container ul li a.exams').removeClass('active');
            $('nav .logo-container ul li a.students').addClass('active');
            $('nav .logo-container ul li a.subjects').removeClass('active');
    })
</script>
</html>