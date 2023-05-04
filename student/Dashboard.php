<?php 
    @include '../config.php';

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
        <div class="filters">
       
        <div>
            <select>
                <option>All</option>
            </select>
            <button>
                Filter&nbsp;<i class="bi bi-filter"></i>
            </button>
        </div>
    </div>
        </div>
        <div class="studentExamResultsContainer">
            <h2 class="chartHeading">Statistic</h2>
            <div class="studentStats">
            
                <div class="chartContainer">
                    <canvas class="my-chart"></canvas>
                </div>
               
            </div>

        </div>
        <div class="startExamContainer">
            <div class="studentExamSettings">
                <div>
                    <i class="fa-solid fa-calendar-check" style="color:blue; border-radius:50% "></i>
                    <div >
                        <span style="font-size: 15px; ">
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
                    <span>
                        2 hours
                    </span>
                </div>


                </div>

            </div>
            <div class="studentExamJoin" style="margin: 100px 0 5px 150px;">
                <button style="border:none; backgound-color:blue; " > <span style="color:wige;">Join Now</span>  </button>

            </div>
        </div>
    </div>
    


<script>
        $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').addClass('active');
            $('nav .logo-container ul li a.results').removeClass('active');
            $('nav .logo-container ul li a.profile').removeClass('active');
    })

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="chart.js"></script>
    
</body>
</html>