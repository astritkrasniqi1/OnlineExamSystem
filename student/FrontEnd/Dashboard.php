<?php 
    @include '../../config.php';

    session_start();

    if(!isset($_SESSION['studentUsername'])){
        header('Location: ../../login.php');
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <title>Document</title>
</head>
<body style="background:#f1f1f3;">
    <?php @include 'studentNavbar.php' ?>
    <?php require '../Backend/ManageExam/joinExamLogic.php';?>

    <div style="margin:1.5rem 8rem;">
        <h2>Dashboard</h2>
    </div>

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
    <div class="studentExamResultsContainer col-8">
        <div class="statisticsOverview">
        <div class="studentStats">
            <h3 style="margin:0;padding:0;">Statistics</h3>
            <div class="chartContainer">
                <div class="chart">
                    <canvas class="my-chart"></canvas>
                </div>
            </div>
            </div>
        <div class="CompletedExamsContainer">
            <h3 style="margin:0; padding:0;">Recent Exams</h3>
             <div class="CompletedExams">
                <div class="progressContainer">
                    <div class="info">
                        <span>Exam Name</span>
                        <span>73/100</span>
                    </div>
                    <progress type="progress" class="" value="73" max="100"></progress>
                </div>
                <div class="progressContainer">
                    <div class="info">
                        <span>Exam Name</span>
                        <span>53/100</span>
                    </div>
                    <progress type="progress" value="53" max="100"></progress>
                </div>
                <div class="progressContainer">
                    <div class="info">
                        <span>Exam Name</span>
                        <span>94/100</span>
                    </div>
                    <progress type="progress" value="94" max="100"></progress>
                </div>
                <div class="progressContainer">
                    <div class="info">
                        <span>Exam Name</span>
                        <span>64/100</span>
                    </div>
                    <progress type="progress" value="64" max="100"></progress>
                </div>
            </div>
            </div>
        </div>
            <div class="studentTable">
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
        </div>
    <div class="startExamContainer col-3">
    <h3 style="margin:0;">Today's exam</h3>
    <div class="startExam">
            <div class="studentExamSettings" style="margin:0;">
                <div>
                <select class="selectExam" name="" id="" style="width:100%;padding:10px;border-radius:5px;">
                    <option value="0" selected disabled>Select exam</option>
                    <?php $todaysExam = "SELECT e.Id AS ExamId, e.Title AS ExamName from exam e 
                                        WHERE DATE(StartDate) = DATE(NOW()) AND e.Status = '1'";

                            $todaysExamResult = mysqli_query($conn, $todaysExam);
                            if(mysqli_num_rows($todaysExamResult) > 0){
                                while($todaysExamRow = mysqli_fetch_assoc($todaysExamResult)){
                        ?>
                        <option class="exam" value="<?php echo $todaysExamRow['ExamId'] ?>">
                            <?php echo $todaysExamRow['ExamName'] ?>
                        </option>
                        <?php 
                                }
                            }
                        ?>
                    </select>
                </div>                   
                <div>
                    <i class="fa-solid fa-calendar-check" style="color:#93ccad; border-radius:50% "></i>
                    <div >
                        <span style="font-size: 15px; " class="examDate">
                            Friday, 14 October 2020
                        </span>
                        <span style="font-size: 13px;">
                          08:00 - 10:00AM
                        </span>
                    </div>
                </div>
                <div>
                <i class="fa-regular fa-clock" style="color:#f7b092;"></i>
                <div>
                    <span>
                        Duration
                    </span>
                    <span class="examDuration">
                        2 hours
                    </span>
                </div>
                </div>
                <div>
                <i class="fa-solid fa-book" style="color:#e96d7f;"></i>
                <div>
                    <span>
                        Subject
                    </span>
                    <span style="font-size: 13px; " class="subjectName">
                        Subject Name
                    </span>
                </div>
                </div>
                <div>
                <i class="fa-solid fa-user-tie" style="color:#111965;"></i>
                <div>
                    <span>
                        Professor
                    </span>
                    <span style="font-size: 13px; " class="professorName">
                        Professor Name
                    </span>
                </div>
                </div>
            </div>
            <div class="studentExamJoin" style="margin:5rem 0 0 0 ;">
                <button style="border: 1px solid gray;background:none;">Next Time</button>
            <form action="" method="post">
                <input type="text" hidden class="examId" name="examId">
                <button type="submit" name="joinExamBtn" style="border:none;"><i class="fa-solid fa-arrow-right"></i>&nbsp;Join Now</a>
            </form>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
    $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').addClass('active');
            $('nav .logo-container ul li a.results').removeClass('active');
            $('nav .logo-container ul li a.profile').removeClass('active');
    })
    function getProgressValue(progress){
       var progressValue = progress.val();
       if(progressValue >= 85){
            progress.addClass('excellent');
       }
       else if(progressValue >= 70 && progressValue < 85){
            progress.addClass("veryGood");
       } 
       else if(progressValue >= 60 && progressValue < 70){
            progress.addClass("good");
       }
       else if(progressValue >= 50 && progressValue < 60){
            progress.addClass("bad");
       }
    }

    $(document).ready(function(){
        $('progress').each(function(){
            getProgressValue($(this));
        })
    })

    $(document).ready(function(){
    $('.selectExam').change(function(){
        var examId = $('.exam').val();
        $.ajax({
            type: "POST",
            url: "../Backend/ManageExam/selectExamLogic.php",
            data: { examId: examId },
            success: function(response){
                var data = JSON.parse(response);
                $('.subjectName').html(data.Subject);
                $('.professorName').html(data.Professor);
                $('.examDate').html(data.StartDate);
                $('.examDuration').html(data.Duration + ' Min');
                $('.examId').val(data.ExamId);
            }
        });
    });
});

$(document).ready(function(){

})


</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="chart.js"></script>
    
</body>
</html>