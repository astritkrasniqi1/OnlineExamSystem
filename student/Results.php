<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js"></script>
    <link rel="stylesheet" href="results.css">
</head>
<body>
    <?php include 'studentNavbar.php' ?>    

<div style="margin: 1.5rem 8rem;">
                <div class="title-examSelect-container">
                    <h2>
                    <?php
                          $currentPage = basename($_SERVER['PHP_SELF']);
                          $pageTitle = str_replace(".php", "", $currentPage);
                          echo $pageTitle;  
                    ?>
                    </h2>
                        <select name="" id="">
                            <option value="">Exam 1</option>
                            <option value="">Exam 2</option>
                        </select>
               </div>
               
               <div class="examScore">
                    <span style="font-size: 20px;">Your score</span>
                    <div class="box">
                        <div class="chart" data-percent="90">90%</div>
                    </div>
                </div>

                <div>
                <div style="margin-top:2rem;"><span style="font-size:1.5rem; border-bottom:3px solid #f7b092;">Answer Key</span></div>
                    <div class="answerKeyContainer row">
                        <div class="questionContainer col-5 ">
                            <div><span>Question 1</span></div>
                            <div><p>What are cells?</p></div>
                        </div>
                        <div class="answersContainer col-7">
                            <div>
                                <span>A</span>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis nesciunt minus veniam laborum saepe, doloremque aut placeat. Qui eos, corporis quidem eveniet reiciendis, sapiente quod quas blanditiis ad, libero repudiandae!</p>
                            </div>
                            <div class="correct">
                                <span>B</span>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium soluta distinctio id est, expedita nostrum voluptatem consectetur minus. Enim animi tempora suscipit mollitia rem veritatis non nam unde placeat minima?</p>
                            </div>
                            <div>
                                <span>C</span>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia corporis, quaerat nostrum veritatis eius beatae eum suscipit totam facere esse quis quasi cum aut libero tempore nam saepe exercitationem ad.</p>
                            </div>
                            <div class="incorrect">
                                <span>D</span>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eius ratione vero voluptate quibusdam voluptates, impedit aspernatur perspiciatis vitae necessitatibus adipisci magni ex iure temporibus facere quisquam? Impedit, facere dolore!</p>
                            </div>
                        </div>
                    </div>
                </div>


</div>

</body>
<script>
      $(document).ready(function() {
            $('nav .logo-container ul li a.dashboard').removeClass('active');
            $('nav .logo-container ul li a.results').addClass('active');
            $('nav .logo-container ul li a.profile').removeClass('active');
    })
    $(function() {
    $('.chart').easyPieChart({
        size: 250,  
        barColor: "#2ed15a",
        scaleLength: 0,
        lineWidth: 10,
        trackColor: "#f5f5f5",
        lineCap: "circle",
        animate: 2000,
    });
});

// Get all the answer key divs
const answerKeyDivs = document.querySelectorAll('.answerKeyContainer .answersContainer div');

// Loop through each div and set the height of the span to match the height of the p
answerKeyDivs.forEach(div => {
  const p = div.querySelector('p');
  const span = div.querySelector('span');
  span.style.height = `${p.offsetHeight}px`;
});

</script>
</html>