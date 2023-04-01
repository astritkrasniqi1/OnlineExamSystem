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
    <link rel="stylesheet" href="subjects.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
    #inputForm {
      display: none;
    }
  </style>
</head>
<body>
    <?php @include 'navbar.php' ?>
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
               <button id="openFormButton"><i class='bx bx-plus'></i>&nbsp;Add New Subject</button>

               <form id="inputForm">
               <label for="name">Subject Name:</label>
               <input type="text" id="name" name="name" required>
               <br>
   
               <input type="submit" value="Add">
                </form>
               <script>
                document.getElementById("openFormButton").addEventListener("click", function() {
      document.getElementById("openFormButton").style.display = "none";
      document.getElementById("inputForm").style.display = "block";
    });
  </script>

        </div>

        


    <div class="filters">
        <div><input type="search" placeholder="Search subject" /></div>
        <div>
            <select>
                <option>All</option>
            </select>
            <button>
                Filter&nbsp;<i class="bi bi-filter"></i>
            </button>
        </div>
    </div>

    <div class="subjectTable">
    <table class="table ">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Subject Name</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">1</td>
      <td>Mathematic</td>
      
    </tr>
    <tr>
      <td scope="row">2</td>
      <td>Physic</td>
     

    </tr>
    <tr>
      <td scope="row">3</td>
      <td>English Language</td>
     
    </tr>
  </tbody>
</table>
</div>

<div class="subjectOverview" style="flex-wrap:wrap;">
        <div class="topSubjects">
            <div class="">
                <h3>Top subjects</h3>
            </div>
        
        </div>
        <div class="subjectCards">
        <a href="#" class="">
        <div> <i class="fa-solid fa-book" style="color:#f7b092;"></i>&nbsp;
            <div class="col-auto"><h6>Mathematic</h6></div></div>
        </a>
        
        <a href="#" class="">
      <div> <i class="fa-solid fa-book" style="color:#53b7ec;"></i>&nbsp;
            <div class="col-auto"><h6>Physic</h6> </div>
        </div>
        </a>
        
         <a href="#" class="">
            <div>
            <i class="fa-solid fa-book" style="color:#73e40d;"></i>&nbsp;
            <div class="col-auto"><h6>English Language</h6></div>    
            </div>
        </a>
      
    </div>
</section>




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