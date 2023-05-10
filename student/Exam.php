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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="exam.css"/>
    <title>Exam</title>
</head>
<body style="background:#f1f1f3;">
    <?php @include 'studentNavbar.php'?>
    <div style="margin:1.5rem 8rem;" class="mainContainer">
    <div class="secondaryContainer col-9">
        <?php for($i=0; $i<=2; $i++){?>
        <div class="examContainer">
            <div class="questionContainer">
                <div class="questionPoints">
                    <span>Question number</span>
                    <span>5 points</span>
                </div>
                <div class="questionTitle">
                    <p>Question Lorem ipsum dolor sit amet consectetur adipisicing eli ?</p>
                </div>
            </div>

            <div class="answerContainer">
                <?php for($j=0; $j<=3; $j++){?>
                <div class="answer">
                    <input type="checkbox" class="form-check-input col-2">
                    <div class="col-12">
                        <span><?php if($j==0){ echo 'A';}
                            else if($j==1)
                        { echo 'B';}
                        else if($j==2)
                        { echo 'C';}
                        else if($j==3)
                        { echo 'D';}?></span>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima esse vel tempora architecto aliquam modi magni voluptate tenetur sit voluptates dolorum obcaecati neque harum vitae ducimus, repellendus incidunt illum beatae!</p>
                    </div>
                </div>
            <?php }?>
            </div>
        </div>
        <?php }?>

        <div class="submitExamContainer">
            <form action="" method="post">
                <button>Submit exam</button>
            </form>
        </div>
    </div>
    <div class="examStatusContainer col-3">
        <div>

            <h2 style="margin:0;padding:0;border-bottom:1px solid lightgray">Exam Name</h2>
            <div id="timer">
            </div>
        <div>
            <div class="examSpecifications">
                <i class="fa-regular fa-clock" style="color:#f7b092; border-radius:50% "></i>
                    <div>
                        <span style="font-size: 15px; ">
                            Start time - End time
                        </span>
                        <span style="font-size: 13px;">
                          12:00 - 13:20
                        </span>
                    </div>
                </div>
            <div class="examSpecifications">
                <i class="fa-solid fa-book" style="color:#e96d7f;"></i>
                <div>
                    <span>
                        Subject
                    </span>
                    <span style="font-size: 13px; ">
                        Subject Name
                    </span>
                </div>
            </div>
            <div class="examSpecifications">
                    <i class="fa-solid fa-user-tie" style="color:#53b7ec;"></i>
                <div>
                    <span>
                        Professor
                    </span>
                    <span style="font-size:13px;">
                        Professor name
                    </span>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>






    <script>
        $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').removeClass('active');
            $('nav .logo-container ul li a.results').removeClass('active');
            $('nav .logo-container ul li a.profile').removeClass('active');
        })
        const answerNumber = document.querySelectorAll('.examContainer .answerContainer .answer .col-12');
        answerNumber.forEach(div => {
        const p = div.querySelector('p');
        const span = div.querySelector('span');
        span.style.height = `${div.offsetHeight}px`;
        });

        const FULL_DASH_ARRAY = 283;
const WARNING_THRESHOLD = 10;
const ALERT_THRESHOLD = 5;

const COLOR_CODES = {
  info: {
    color: "green"
  },
  warning: {
    color: "orange",
    threshold: WARNING_THRESHOLD
  },
  alert: {
    color: "red",
    threshold: ALERT_THRESHOLD
  }
};

const TIME_LIMIT =7200;
let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let remainingPathColor = COLOR_CODES.info.color;

document.getElementById("timer").innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="base-timer-label" class="base-timer__label">${formatTime(
    timeLeft
  )}</span>
</div>
`;

startTimer();

function onTimesUp() {
  clearInterval(timerInterval);
}

function startTimer() {
  timerInterval = setInterval(() => {
    timePassed = timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    document.getElementById("base-timer-label").innerHTML = formatTime(
      timeLeft
    );
    setCircleDasharray();
    setRemainingPathColor(timeLeft);

    if (timeLeft === 0) {
      onTimesUp();
    }
  }, 1000);
}

function formatTime(time) {
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  return `${minutes}:${seconds}`;
}

function setRemainingPathColor(timeLeft) {
  const { alert, warning, info } = COLOR_CODES;
  if (timeLeft <= alert.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(warning.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(alert.color);
  } else if (timeLeft <= warning.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(info.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(warning.color);
  }
}

function calculateTimeFraction() {
  const rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray() {
  const circleDasharray = `${(
    calculateTimeFraction() * FULL_DASH_ARRAY
  ).toFixed(0)} 283`;
  document
    .getElementById("base-timer-path-remaining")
    .setAttribute("stroke-dasharray", circleDasharray);
}
    </script>
</body>
</html>