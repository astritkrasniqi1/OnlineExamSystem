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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="professorDashboard.css" media="all" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body style="background:#f1f1f3;">
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
        <a href="#" class=""><div>
            <i class="fa-solid fa-user-graduate" style="color:#f7b092;"></i>&nbsp;
            <div class="col-auto">
            <span>Total Students</span>
            <h5>400</h5>
            </div>  
        </div>
        </a>
        
        <a href="#" class=""><div>
        <i class="fa-solid fa-user-check" style="color:#53b7ec;"></i>&nbsp;
            <div class="col-auto"><span>Active Students</span>
            <h5>400</h5></div>
            
        </div>
        </a>
        <a href="#" class="">
            <div>
            <i class="fa-solid fa-user-xmark" style="color:#e96d7f;"></i>&nbsp;
            <div class="col-auto"><span>Offline Students</span>
            <h5>400</h5></div>    
            </div>
        </a>
        <a href="#" class="">
            <div>
            <i class="fa-solid fa-user-plus" style="color:#93ccad;"></i>&nbsp;
            <div class="col-auto"><span>New Students</span>
            <h5>400</h5></div>    
            </div>
        </a>
        <a href="#" class=""><div>
        <i class="fa-solid fa-newspaper" style="color:#b9b1e5;"></i> &nbsp;
            <div class="col-auto"><span>Active Exams</span>
            <h5>400</h5></div>
            
        </div>
        </a>
        <a href="#" class=""><div>
        <i class="fa-solid fa-book" style="color:#a3abb6;"></i>&nbsp;
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


    <div class="studentTable">
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
                <tr>
                <td scope="row">1</td>
                <td>Mark</td>
                <td>mark25@gmail.com</td>
                <td><span>Active</span></td>
                </tr>
                <tr>
                <td scope="row">2</td>
                <td>Jacob</td>
                <td>jacob_1@gmail.com</td>
                <td><span>Offline</span></td>
                </tr>
                <tr>
                <td scope="row">3</td>
                <td>Larry the Bird</td>
                <td>larry_bird@gmail.com</td>
                <td><span>Active</span></td>
                </tr>
            </tbody>
        </table>
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

    const tdList = document.querySelectorAll('td span');
  
    tdList.forEach((td) => {
        if (td.textContent === 'Active') {
        td.style.backgroundColor = '#ddf1fb';
        td.style.color = '#53b7ec';
        td.style.border = '1px solid #53b7ec';
        } else if (td.textContent === 'Offline') {
        td.style.backgroundColor = '#fbe2e5';
        td.style.color = '#e96d7f';
        td.style.border = '1px solid #e96d7f';
        }
    });
</script>
</html>