<?php 
   @include '../config.php';

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
    <link rel="stylesheet" href="Students.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body style="background:#f1f1f3;">
    <?php @include 'navbar.php' ?>
    <?php require 'studentsLogic.php'; ?>
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
</div>
    <div class="filters">
        <div><input type="search" placeholder="Search student" /></div>
        <div>
            <select>
                <option>All</option>
            </select>
            <button>
                Filter&nbsp;<i class="bi bi-filter"></i>
            </button>
        </div>
    </div>
<div class="Allstudents">
    <?php if(mysqli_num_rows($studentResultTable) == 0){?>
        <span class="text-danger">No results</span>
      <?php } 
        if(mysqli_num_rows($studentResultTable)> 0){
        ?>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Student Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
        <?php while($studentRow = mysqli_fetch_array($studentResultTable)) {
          ?>
          <tr>
            <td><?php echo $studentRow['Id'] ?></td>
            <td><?php echo $studentRow['StudentName'] ?></td>
            <td><?php echo $studentRow['Email']?></td>
            <td><?php if($studentRow['Status'] == '1'){
              echo 'Online';
            }
            else{
              echo 'Offline';
            } 
            ?></td>
          </tr>
          <?php } }?>
        </tbody>
</table>
</div>


<div style="margin:2rem 8rem 1rem 8rem;"><span style="font-size:1.5rem; border-bottom:3px solid #f7b092;">New Students</span></div>

<div class="filters">
        <div><input type="search" placeholder="Search student" /></div>
        <div>
            <select>
                <option>All</option>
            </select>
            <button>
                Filter&nbsp;<i class="bi bi-filter"></i>
            </button>
        </div>
    </div>

<div class="NewStudents">
    <table class="table ">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Student Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">1</td>
      <td>Mark</td>
      <td>mark25@gmail.com</td>
    </tr>
    <tr>
      <td scope="row">2</td>
      <td>Jacob</td>
      <td>jacob_1@gmail.com</td>

    </tr>
    <tr>
      <td scope="row">3</td>
      <td>Larry the Bird</td>
      <td>larry_bird@gmail.com</td>
    </tr>
  </tbody>
</table>
</div>
</section>
</body>


<script>
    $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').removeClass('active');
            $('nav .logo-container ul li a.exams').removeClass('active');
            $('nav .logo-container ul li a.students').addClass('active');
            $('nav .logo-container ul li a.subjects').removeClass('active');
    })
</script>
</html>