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
                    <a href="Exams.php"><i class='bx bx-plus'></i>&nbsp;Create New Exam</a>
               </div>

        </div>
    <div class="overview" style="flex-wrap:wrap;">
        <a href="#" class=""><div>
            <i class="fa-solid fa-user-graduate" style="color:#f7b092;"></i>&nbsp;
            <div class="col-auto">
            <span>Total Students</span>
            <h5>
                <!--The number of total students-->
                <?php
                    @include '../config.php';
                    $sql = "Select Count(*) as StudentCount from users where UserType='1'";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_array($result);
                        echo $row['StudentCount'];
                    }
                ?>
                <!---->
            </h5>
            </div>  
        </div>
        </a>
        
        <a href="#" class=""><div>
        <i class="fa-solid fa-user-check" style="color:#93ccad;"></i>&nbsp;
            <div class="col-auto"><span>Online Students</span>
            <h5>
                <!--The number of online students-->
                <?php
                    @include '../config.php';
                    $sql = "Select Count(*) as StudentCount from users where UserType='1' and Status='1'";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_array($result);
                        echo $row['StudentCount'];
                    }
                ?>
                <!---->
            </h5></div>
            
        </div>
        </a>
        <a href="#" class="">
            <div>
            <i class="fa-solid fa-user-xmark" style="color:#e96d7f;"></i>&nbsp;
            <div class="col-auto"><span>Offline Students</span>
            <h5>
                <!--The number of offline students-->
                <?php
                    @include '../config.php';
                    $sql = "Select Count(*) as StudentCount from users where UserType='1' and Status='0'";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_array($result);
                        echo $row['StudentCount'];
                    }
                ?>
                <!---->
            </h5></div>    
            </div>
        </a>
        <a href="#" class="">
            <div>
            <i class="fa-solid fa-user-plus" style="color:#53b7ec;"></i>&nbsp;
            <div class="col-auto"><span>New Students</span>
            <h5>
                <!--The number of new students-->
                <?php
                    @include '../config.php';
                    $sql = "Select Count(*) as StudentCount from users where UserType='1' and Created_at BETWEEN DATE_SUB(NOW(), INTERVAL 1 WEEK) AND NOW() ";
                    $result = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_array($result);
                        echo $row['StudentCount'];
                    }
                ?>
                <!---->
            </h5></div>    
            </div>
        </a>
        <a href="#" class=""><div>
        <i class="fa-solid fa-newspaper" style="color:#b9b1e5;"></i> &nbsp;
            <div class="col-auto"><span>Active Exams</span>
            <h5>
                <!--The number of active exams-->
                <?php 
                    @include '../config.php';
                    $sql = "Select Count(*) as ExamCount from exam where Status='1'";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)> 0){
                        $row = mysqli_fetch_array($result);
                        echo $row['ExamCount'];
                    }
                ?>
                <!---->
            </h5></div>
            
        </div>
        </a>
        <a href="subjects.php" class=""><div>
        <i class="fa-solid fa-book" style="color:#a3abb6;"></i>&nbsp;
            <div class="col-auto"><span>Subjects</span>
            <h5>
                <!--The number of subjects-->
                <?php 
                    @include '../config.php';
                    $sql = "Select Count(*) as SubjectCount from subject";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)> 0){
                        $row = mysqli_fetch_array($result);
                        echo $row['SubjectCount'];
                    }
                ?>
                <!---->
            </h5></div>
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
    <div style="margin:4rem 8rem 1rem 8rem;"><span style="font-size:1.5rem; border-bottom:3px solid #f7b092;">Online Students</span></div>

    <div class="filters">
        <div><input type="search" placeholder="Search student"/></div>
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
        <?php 
            @include '../config.php';
            $sql = "Select Id, Concat(FirstName, ' ', LastName) as StudentName, Email, Status from users where UserType='1' and Status='1'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) == 0){
        ?>
        <span class="text-danger">No online students</span>
        <?php } else{
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
                <?php while ($row = mysqli_fetch_array($result)){ ?>
                <tr>
                    <td><?php echo $row['Id']?></td>
                    <td><?php echo $row['StudentName']?></td>
                    <td><?php echo $row['Email']?></td>
                    <td><span><?php if($row['Status'] = '1'){
                            echo 'Online';
                        }
                        else{
                            echo 'Offline';
                        }
                     ?></span></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php }?>
    </div>




    
    <div style="margin:4rem 8rem 1rem 8rem;"><span style="font-size:1.5rem; border-bottom:3px solid #b9b1e5;">Active Exams</span></div>

    <div class="filters">
        <div><input type="search" placeholder="Search your exams"/></div>
        <div>
            <select>
                <option>All</option>
            </select>
            <button>
                Filter&nbsp;<i class="bi bi-filter"></i>
            </button>
        </div>
    </div>

    <div class="activeExamsTable">
        <?php 
            @include '../config.php';
            $sql = "Select Id, Title, Subject, Professor, StartDate, Duration, Status from exam where Status='1'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) == 0){
        ?>
        <span class="text-danger">No active exams</span>
        <?php } else{
         ?>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Exam Title</th>
                <th scope="col">Subject</th>
                <th scope="col">Professor</th>
                <th scope="col">Start Date</th>
                <th scope="col">Duration</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($result)){ ?>
                <tr>
                    <td><?php echo $row['Id']?></td>
                    <td><?php echo $row['Title']?></td>
                    <td><?php echo $row['Subject']?></td>
                    <td><?php echo $row['Professor']?></td>
                    <td><?php echo $row['StartDate']?></td>
                    <td><?php echo $row['Duration']?></td>
                    <td><span><?php if($row['Status'] = '1'){
                            echo 'Active';
                        }
                        else{
                            echo 'Inactive';
                        }
                     ?></span></td>
                     <td><a href="" class="edit"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php }?>
    </div>

</section>
</body>


<script>
    $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').addClass('active');
            $('nav .logo-container ul li a.exams').removeClass('active');
            $('nav .logo-container ul li a.subjects').removeClass('active');
            $('nav .logo-container ul li a.students').removeClass('active');
            $('nav .logo-container ul li a.results').removeClass('active');
            $('nav .logo-container ul li a.profile').removeClass('active');    
    })

    const studentTableTdList = document.querySelectorAll('.studentTable table tbody tr td span');
    const activeExamsTdList = document.querySelectorAll('.activeExamsTable table tbody tr td span');
  
    studentTableTdList.forEach((td) => {
        if (td.textContent === 'New') {
        td.style.backgroundColor = '#ddf1fb';
        td.style.color = '#53b7ec';
        td.style.border = '1px solid #53b7ec';
        } else if (td.textContent === 'Offline') {
        td.style.backgroundColor = '#fbe2e5';
        td.style.color = '#e96d7f';
        td.style.border = '1px solid #e96d7f';
        }else if (td.textContent === 'Online') {
        td.style.backgroundColor = '#e9f5ef';
        td.style.color = '#93ccad';
        td.style.border = '1px solid #93ccad';
        }
    });

    activeExamsTdList.forEach((td) => {
        if (td.textContent === 'Active') {
        td.style.backgroundColor = '#f1effa';
        td.style.color = '#b9b1e5';
        td.style.border = '1px solid #b9b1e5';
    }
    });
</script>
</html>